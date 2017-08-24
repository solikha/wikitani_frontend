<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    
class Importwni extends MY_Controller {

    var $mapping = '';
    var $countrymap = array(
        "G.D. Luxembourg" =>"Luxembourg",
        "NETHERLAND"=>"Netherlands",
        "Luxemburg"=>"Luxembourg",
        "Luxembourg"=>"Luxembourg",
        "GD Luxembourg"=>"Luxembourg",
        "Belanda"=>"Netherlands",
        "G.D.Luxembourg"=>"Luxembourg",
        "Belgiq"=>"Belgium",
        "Deurne"=>"Belgium",
        "G. D Luxembourg"=>"Luxembourg",
        "G D Luxemburg"=>"Luxembourg",
        "Bzelgium"=>"Belgium",
        "GD-Luxembourg"=>"Luxembourg",
        "Switzerland"=>"Switzerland",
        "belgium"=>"Belgium",
        "BELGIUM"=>"Belgium",
        "Belgium"=>"Belgium",
        "belgia"=>"Belgium",
        "G.D Luxembourg"=>"Luxembourg",
        "BELGIA"=>"Belgium",
        "Belgiul"=>"Belgium",
        "Belgia"=>"Belgium"
        );

    function __construct() {
        parent::__construct();
    }
    
    
    
    function getTableFields($tablename, $schemaname='public'){
        $sql = "
            SELECT column_name, data_type
            FROM information_schema.columns
            WHERE table_schema = :schemaname
            AND table_name = :tablename
       ";
       $params = array('schemaname'=>$schemaname, 'tablename'=>$tablename);
       $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
       return $qres;
    }
    
    function getSqlFieldsByTable($tbname){
        $fdlist = $this->getTableFields($tbname);
        $result = '';
        $last = '';
        if (is_array($fdlist)){
            foreach($fdlist as $field){
                if($last!==''){
                    $last = $last.', '; 
                }
                if($field['data_type']=='date'){
                    $xfield = "to_char(".$field['column_name'].", 'DD-MM-YYYY') as ".$field['column_name'];
                } else {
                    $xfield = $field['column_name'];
                }
                if (strlen($last.$xfield)>80){
                    $result = $result."\r\n".$last;
                    $last = '';
                }
                $last = $last.$xfield;
            }
            if ($last!==''){
                $result = $result."\r\n".$last;
            }
        }
        return $result;
    }
    
    
    
    function getSource(){
        $tableFields = $this->getSqlFieldsByTable('wni');
        $sql = 'select '.$tableFields.' from wni';
        $result = $this->mdb->QueryData('application', $sql, array(), 'record');
        return $result;
    }
    
    function prepareTarget(){
        $sql = "delete from app_wni;
        ";
        $this->mdb->ExecSQL('application', $sql, array());
    }
    
    function finalizeTarget(){
        $sql = "SELECT pg_catalog.setval('app_wni_id_seq', (select max(id) from app_wni), true);
        ";
        $this->mdb->ExecSQL('application', $sql, array());
    }
    
    function getLookup($luname, $value, $default=''){
        $sql = '';
        $result = $default;
        if($luname=='jenis_instansi'){
            $sql = 'select id, nama from jenis_instansi where nama = :nama';
            $params = array('nama'=>$value);
        } else if($luname=='negara'){
            if(isset($this->countrymap[$value])){
                $value = $this->countrymap[$value];
            }
            $sql = 'select countryid as id, countryname as nama 
            from country where countryname ilike :nama';
            $params = array('nama'=>$value);
        }
        if ($sql!==''){
            $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
            if (isset($qresult[0]['id'])){
                $result = $qresult[0]['id'];
            }
        }
        return $result;        
    }
    
    function prepareParams($row){
        $result = array();
        foreach($row as $key=>$value){
            if ($value!==null){
                if (isset($this->mapping[$key])){
                    $xvalue = $this->mapping[$key];
                    if ($xvalue){
                        if (is_array($xvalue)){
                            if (isset($xvalue['default'])){
                                $xdefault = $xvalue['default'];
                            } else {
                                $xdefault = '';
                            }
                            $vvalue = $this->getLookup($xvalue['lookup'], $value, $xdefault);
                            $result[$xvalue['field']] = $vvalue;
                        } else {
                            $result[$xvalue] = $value;
                        }
                    }
                } else {
                    //$result[$key] = $value;
                }
            }
        }
        return $result;
    }
    
    function importRow($row){
        $xparams = $this->prepareParams($row);
        $id = $xparams['id'];
        $appconfig = $this->ci->config->item('appconfig');
        $hashkey = $appconfig['hash-key'];

        $data_wni = json_encode($xparams);
        unset($xparams['id']);
        unset($xparams['hashid']);
        $params = array('id'=>$id, 'sys_hashkey'=>$hashkey, 'data_wni'=>$data_wni);
        $this->mdb->ExecSQL('application', $this->sql, $params);
    }
    
    function buildSQL(){
        /*$fields = '';
        $values = '';
        foreach($this->mapping as $name=>$value){
            if ($value){
                if ($fields!==''){
                    $fields = $fields.', ';
                    $values = $values.', ';
                }
                if (is_array($value)){
                    $fields = $fields.$value['field'];
                } else {
                    $fields = $fields.$value;
                }
                $values = $values.':'.$name;
            }
        }
        $this->sql = "insert into app_wni($fields) values ($values)";
        */
        $this->sql = "insert into app_wni(id, hashid, data_wni) 
            values (:id, md5('app_wni'||:sys_hashkey||cast(:id as character varying)), :data_wni)";
    }
    
    public function import(){
        $filename = $this->ci->config->item('basefolder').'import_wni.json';
        $json_data = file_get_contents($filename);
        $this->mapping = json_decode($json_data, true);
        $source = $this->getSource();
        $this->prepareTarget();
        $this->buildSQL();
        foreach($source as $row){
            $this->importRow($row);
        }
        $this->finalizeTarget();
        echo "finish";

    }
    
    public function update_no_berkas(){
        $this->load->model('m_number', 'num');
        $sql = "select id from wni_layanan order by id";
        $layanan = $this->mdb->QueryData('application', $sql, array(), 'record');
        $updsql = "update wni_layanan set layananidstr = :layananidstr where id = :id";
        foreach($layanan as $row){
            $row['layananidstr'] = $this->num->string_num($row['id']); 
            $this->mdb->ExecSQL('application', $updsql, $row);
        }
        //print_r($layanan);
        echo "finish...";
    }
}

