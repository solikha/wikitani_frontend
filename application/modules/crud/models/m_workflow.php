<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_workflow extends MY_Model {
    
    var $config_layanan=array();
    //var $mustache_loaded = false;
    
    public function __construct() {
        parent::__construct();
        $this->load->library('mustache');
    }
    
    function loadJSON($relpath, $ext='.json'){
        $base = $this->ci->config->item('basefolder');
        $filename = $base.$relpath.$ext;
        $fidata = file_get_contents($filename);
        $result = json_decode($fidata, true);
        return $result;
    }
    
    // public function mustache($template, $data){
    //     $cmds = array('human_time'=>function($value, Mustache_LambdaHelper $helper) {
    //         $thetime = ($helper->render($value));
    //         return $this->humanTime(trim($thetime));
    //     });
        
    //     $data['human_time'] = $cmds['human_time'];
    //     if ($this->mustache_loaded===false){
    //         $mconfig = array('escape'=>array('M_crud'=>'Process'));
    //         $this->load->library('mustache');
    //         $this->mustache_loaded = true;
    //     }
    //     $text = $this->mustache->render($template, $data);
    //     return $text;
    // }
    
    function stripParams($data, $list){
        foreach($list as $item){
            if (isset($data[$item])){
                unset($data[$item]);
            }
        }
        return $data;
    }
    
    function filterParams($data, $list){
        $result = array();
        foreach($list as $item){
            if (isset($data[$item])){
                $result[$item] = $data[$item];
            }
        }
        return $result;
    }
    
    function getLayanan($layananid, $sublayananid){
        $sql = "select a.id as layananid, b.id as sublayananid, 
            case when coalesce(b.nama_layanan, '') <> '' then b.nama_layanan else a.nama_layanan end as nama_layanan
            from layanan a
            left join layanan_sub b on b.layananid = a.id
            where a.id=:layananid and b.id = :sublayananid
        ";
        $params = array('layananid'=>$layananid, 'sublayananid'=>$sublayananid);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if(isset($result[0]['nama_layanan'])){
            return $result[0]['nama_layanan'];
        } else {
            return '';
        }
    }
    
    function getDataLayanan($hashid){
        $sql = "select * from wni_layanan where layananidhash = :hashid";
        $params = array('hashid'=>$hashid);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qresult[0])){
            return $qresult[0];
        } 
        return false;
    }
    
    function getLayananByHash($hashid){
        $sql = "select a.id as layananid, b.id as sublayananid, 
            case when coalesce(b.nama_layanan, '') <> '' then b.nama_layanan else a.nama_layanan end as nama_layanan
            from wni_layanan x 
            left join layanan a on x.layananid = a.id
            left join layanan_sub b on b.layananid = a.id
            where x.layananidhash = :hashid
        ";
        $params = array('hashid'=>$hashid);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if(isset($result[0]['nama_layanan'])){
            return $result[0]['nama_layanan'];
        } else {
            return '';
        }
    }
    
    function loadConfigLayanan($nm_layanan){
        $result = $this->loadJSON('workflow/'.$nm_layanan);
        $result['nama_layanan'] = $nm_layanan;
        return $result;
    }
    
    function getFieldLayanan(){
        $result = array();
        if (isset($this->config_layanan['controls']['edit']['form'])){
            $formname = $this->config_layanan['controls']['edit']['form'];
            $config = $this->loadJSON('crud/'.$formname.'/browse', '.query');
            if (isset($config['paramlist']) and is_array($config['paramlist'])){
                foreach($config['paramlist'] as $item){
                    if (isset($item['name'])){
                        array_push($result, $item['name']);
                    }
                }
            }
        }
        return $result;
    }
    
    function getDefaultWNI($wniid, $fields){
        /*$tableFields = $this->getSqlFieldsByTable('app_wni');
        $sql = 'select '.$tableFields.' from app_wni where id = :wniid';
        $params = array('wniid'=>$wniid);
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qres[0])){
            $qresult = $qres[0];
            $result = array();
            foreach($fields as $field){
                if (isset($qresult[$field])){
                    $result[$field] = $qresult[$field];
                }
            }
        }*/
        $sql = 'select id, hashid, data_wni from app_wni where id = :wniid';
        $params = array('wniid'=>$wniid);
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qres[0])){
            $qresult = json_decode($qres[0]['data_wni'], true);
            $result = array();
            foreach($fields as $field){
                if (isset($qresult[$field])){
                    $result[$field] = $qresult[$field];
                }
            }
        }
        return $result;
        
    }
    
    function layananBaru($params, $default, $username=''){
        //print_r($params); die;
        $sql = "
            select 0; 
            insert into wni_layanan(layananid, sublayananid, taskname, statusname, wniid, data_layanan, username,create_by) 
                values (:layananid, :sublayananid, :layanan_taskname, :statusname, :selected_id, :data_layanan, :username,:create_by); 
            update wni_layanan 
                set layananidhash = md5(:sys_hashkey||cast(currval('wni_layanan_id_seq') as character varying)) 
                where id = currval('wni_layanan_id_seq'); 

            select id as new_id, layananidhash as lyn_id, layananid, sublayananid
            from wni_layanan
            where id = currval('wni_layanan_id_seq');
        ";
        if($default==array()){
            $params['data_layanan'] = '{}';
        } else {
            $params['data_layanan'] = json_encode($default);
        }
        $params['username'] = $username;
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        $result = array();
        if (isset($qres[0])){
            $result = $qres[0];
            $this->load->model('m_number', 'num');
            $idstr = $this->num->string_num($result['new_id']);
            $updsql = "update wni_layanan set layananidstr = :layananidstr where id = :id";
            $this->mdb->ExecSQL('application', $updsql, array('id'=>$result['new_id'], 'layananidstr'=>$idstr));
        }
        return $result;
    }
    
    function getNextLink($linkname, $default='menu/layanan'){
        if (isset($this->config_layanan['controls'][$linkname]['link'])){
            return $this->config_layanan['controls'][$linkname]['link'];
        } else {
            return $default;
        }
    }
    
    function getWorkflowConfig($configname, $default=''){
        if (isset($this->config_layanan['config'][$configname])){
            return $this->config_layanan['config'][$configname];
        } else {
            return $default;
        }
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
    
    
    function getDefaultLayanan($params){
        $result = array();
        if (isset($this->config_layanan['config']['default-data'])){
            $result = $this->execute($this->config_layanan['config']['default-data'], $params);
        }
        return $result;
        
    }
    
    function afterCreateLayanan($params){
        if (isset($this->config_layanan['config']['after-create-process'])){
            $result = $this->execute($this->config_layanan['config']['after-create-process'], $params);
        }
    }
    
    function createProcess($params, $username=''){
        //print_r($params);die;
        $nm_layanan = $this->getLayanan($params['layananid'], $params['sublayananid']);
        $params['nama_layanan'] = $nm_layanan;
        //$list_fields = $this->getFieldLayanan($nm_layanan);
        //$default = $this->getDefaultWNI($params['selected_id'], $list_fields);
        
        $default = $this->getDefaultLayanan($params);        
        $layanan = $this->layananBaru($params, $default, $username);
        $params['new_id'] = $layanan['new_id'];
        
        //$this->addDefaultAttachment($nm_layanan, $params['selected_id'], $layanan['wni_layanan_id']);
        $this->afterCreateLayanan($params);
        return $layanan;
    }
    
    public function new_process($params, $username=''){
        
        $nm_layanan = $this->getLayanan($params['layananid'], $params['sublayananid']);
        $this->config_layanan = $this->loadConfigLayanan($nm_layanan);
        
        $taskname = $this->getWorkflowConfig('first-task');
        $params['layanan_taskname'] = $taskname;
        $params['statusname'] = 'proses';
		 $params['create_by'] = 'Admin';
        $layanan = $this->createProcess($params, $username);
        $lyn_id = $layanan['lyn_id'];
        $link = $this->getNextLink('edit');
        $result = array('success'=>1, 'islink'=>1,  'link'=>$link."?lyn_id=".$lyn_id);
        
        return $result;
        
    }
    
    public function new_process_byuser($params){
        
        //print_r($params);
        $sql = "select a.userid, a.username, a.fullname, a.isverified, b.wniid
          from sys_users a
          left join wni_user_link b on a.userid = b.userid
          where a.username = :sys_username
        ";
        $qres = $this->mdb->QueryData('application', $sql, array(), 'record');
        $result = array();
        if (isset($qres[0]['wniid'])){
            $nm_layanan = $this->getLayanan($params['layananid'], $params['sublayananid']);
            $this->config_layanan = $this->loadConfigLayanan($nm_layanan);
            $params['selected_id'] = $qres[0]['wniid'];
            $username = $qres[0]['username'];
            $taskname = $this->getWorkflowConfig('first-task-user');
            $params['layanan_taskname'] = $taskname;
            $params['statusname'] = 'draft';
             $params['create_by'] = 'User';
            $layanan = $this->createProcess($params, $username);
            $lyn_id = $layanan['lyn_id'];
            $link = $this->getNextLink('edit-user');
            $result = array('success'=>1, 'islink'=>1,  'link'=>$link."?lyn_id=".$lyn_id);
             
        }        
        return $result;
        
    }
    
    function evaluate($nextinfo, $params){
        if (is_array($nextinfo)){
            if ($nextinfo['type']=='condition'){
                return $this->evaluate_condition($nextinfo, $params);
            } else if ($nextinfo['type']=='method'){
                return $this->evaluate_method($nextinfo, $params);
            }
            return '';
        } else {
            return $nextinfo;
        }
    }

    function evaluate_condition($nextinfo, $params){
        $result = '';
        $default = '';
        if (isset($nextinfo['options']['default'])){
            $default = $nextinfo['options']['default'];
        }
        if (isset($nextinfo['fieldname'])){
            $fieldname = $nextinfo['fieldname'];
            
            if (isset($params[$fieldname])){
                $value = $params[$fieldname];
                if (isset($nextinfo['options'][$value])){
                    $result = $nextinfo['options'][$value];
                }
            }
        }
        return $result;
    }
    
    function evaluate_method($nextinfo, $params){
        return '';
    }
        
    function execute($command, $params){
        $result = null;
        if (isset($command['type'])){
            if (isset($command['params'])){
                $params = array_merge($command['params'], $params);
            }
            if ($command['type']=='sql'){
                $result = $this->execute_sql($command, $params);
            } else if ($command['type']=='method'){
                $result = $this->execute_method($command, $params);
            }
        }
        return $result;
    }
    
    function execute_method($command, $params){
        $objname = $command['objectname'];
        $methodname = $command['methodname'];
        $aliasname = getArrayDef($command, 'methodname', 'mobj');
        $this->load->model($objname, $aliasname);
        return $this->$aliasname->$methodname($params);
    }
    
    function getNextStep($taskname, $command){
        if (isset($this->config_layanan['flow'])){
            foreach($this->config_layanan['flow'] as $item){
                if ($item['start']==$taskname and $item['command']==$command){
                    if (isset($item['end'])){
                        return $item;
                    }
                }  
            }
        }
        throw new Exception("Flow tidak diketemukan!");
    }
    
    public function updateTask($nexttask, $hashid){
        $taskname = $nexttask['taskname'];
        if ($taskname){
            $sql = "update wni_layanan
                set taskname = :taskname,
                statusname=:statusname
                where layananidhash = :hashid
            ";
            
            $params = array('taskname'=>$taskname, 'statusname'=>getArrayDef($nexttask, 'statusname', 'proses'),
                'hashid'=>$hashid);
            $this->mdb->ExecSQL('application', $sql, $params);
        }
    }
    
    
    function doSaveData($lyn_id, $dataparams){
        $vsql = "select * from wni_layanan where layananidhash = :lyn_id";
        $vdata = $this->mdb->QueryData('application', $vsql, array('lyn_id'=>$lyn_id), 'record');
        if (isset($vdata[0])){
            
			if (!$vdata[0]['data_layanan']){
				$xdata = array();
			} else {
                $xdata = json_decode($vdata[0]['data_layanan'], true);
                if (!$xdata and ($vdata[0]['data_layanan']!='') and ($vdata[0]['data_layanan']!='{}') and ($vdata[0]['data_layanan']!='[]') ){
                    throw new Exception('Ada masalah dengan data layanan. Data tidak bisa disimpan.');
                }
            }
            $xdataparams = array_merge($xdata, $dataparams);
            $data_layanan = json_encode($xdataparams);
            $xparams = array('lyn_id'=>$lyn_id, 'data_layanan'=>$data_layanan);
            $xsql = "update wni_layanan 
                set data_layanan = :data_layanan
                where layananidhash = :lyn_id;
            ";
            $this->mdb->ExecSQL('application', $xsql, $xparams);
            
        }
    }

    
    function updateDataLayanan($params){
        $striplist = array('command', 'crudname', 'actionname', 'undefined', 'nama_layanan');
        if (isset($this->config_layanan['striplist'])){
            $striplist = array_merge($striplist, $this->config_layanan['striplist']);
        }
        $dataparams = $this->stripParams($params, $striplist);
        $lyn_id = $params['lyn_id'];
        $this->doSaveData($lyn_id, $dataparams); 
    }
    
    public function update_status($params){
        //print_r($params); die;
        $command = getArrayDef($params, 'command', '');
        if ($command){
            $data_layanan = $this->getDataLayanan($params['lyn_id']);
            $nm_layanan = $this->getLayanan($data_layanan['layananid'], $data_layanan['sublayananid']);
            //$nm_layanan = $this->getLayananByHash($params['lyn_id']);
            $this->config_layanan = $this->loadConfigLayanan($nm_layanan);
            if (isset($this->config_layanan['change-status'][$command])){
                $lyn_id = $params['lyn_id'];
                $taskname = $this->config_layanan['change-status'][$command];
                $nexttask = array(
                    'taskname'=>$taskname
                );
                //print_r($nexttask); die;
                $this->updateTask($nexttask, $lyn_id);
            }            
        }
        $result = array('success'=>1);
        return $result;
    } 
    
    public function do_process($params){
//        echo json_encode($params);die;
        $data_layanan = $this->getDataLayanan($params['lyn_id']);
        if ($data_layanan===false){
            //throw new Exception("Data tidak diketemukan!");
            $result = array('success'=>0, 'message' =>'Data tidak diketemukan.');
            return $result;
        }
        $nm_layanan = $this->getLayanan($data_layanan['layananid'], $data_layanan['sublayananid']);
        //$nm_layanan = $this->getLayananByHash($params['lyn_id']);
        $this->config_layanan = $this->loadConfigLayanan($nm_layanan);
        
        $baseview = "menu/home";
        if (isset($this->config_layanan['config']['base_adminview'])){
            $tpl = $this->config_layanan['config']['base_adminview'];
            $baseview = $this->mustache->render($tpl, $params);
             
        }
        
        $link = $baseview;
        
        /*if ($data_layanan['taskname']!==$params['taskname']){
            $result = array('success'=>0, 'message' =>'Data sudah diupdate oleh user lain.', 
                'showlink'=>1, 'islink'=>1, 'link'=>$link);
            return $result;
        }*/
        
        $lyn_id = $params['lyn_id'];
        $params['nama_layanan'] = $nm_layanan;
        $this->updateDataLayanan($params);
        $nexttask = $this->getNextStep($params['taskname'], $params['command']);
        $nexttask['taskname'] = $this->evaluate($nexttask['end'], $params);

        if (isset($nexttask['execute'])){
            $this->execute($nexttask['execute'], $params);
        }
        $this->updateTask($nexttask, $lyn_id, $params);
        
        
        $result = array('success'=>1, 'islink'=>1,  'link'=>$link."?lyn_id=".$lyn_id);
        return $result;
    }
    
	
}

