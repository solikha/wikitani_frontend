<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_pelanggan extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function loadDataStatus(){
        $sql = "select a.id, a.nama, a.alamat, b.nama as kota, a.status_zona as jobsite_status,
            coalesce(d.caption, '') as status_zona_caption, d.status_class
            from app_jobsite a
            left join app_kota b on a.kota_id = b.id
            left join app_zona_status d on d.category = 'jobsite' and a.status_zona = d.status
            where a.cust_id = :sys_cust_id
            ";
        $params = array();
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');

        $data = $this->getDefaultData();
        
        $sql = "select a.nama as nama_zona, a.terminal_id, a.hardware_id, a.status as status_zona,
                c.caption as cap_status_zona, b.id as jobsite_id,
                coalesce(c.status_class, e.status_class) as status_class,
                b.nama as nama_jobsite, b.alamat as alamat_jobsite
                from app_jobsite_zona a
                left join app_jobsite b on a.jobsite_id = b.id
                left join app_zona_status c on c.category = 'zona' and a.status = c.status
                left join app_zona_status d on d.category = 'jobsite' and b.status_zona = d.status
                left join app_zona_status e on e.category = 'zona' and e.status = 'none'
                where b.cust_id = :sys_cust_id
                order by nama_jobsite, a.id
            ";
        //$sql = "select :sys_cust_id";
        $params = array();
        $zresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        $vtemp = array();
        foreach($zresult as $row){
            if (!isset($vtemp[$row['jobsite_id']])){
                $vtemp[$row['jobsite_id']] = array();
            }
            array_push($vtemp[$row['jobsite_id']], $row);
        }
        foreach ($qresult as &$row){
            if (isset($vtemp[$row['id']])){
                $row['zona_info'] = $vtemp[$row['id']];
            } else {
                $row['zona_info'] = array();
            }
        }
        /*return $result;
         *
         */
        $data['jobsites'] = $qresult;
        //print_r($qresult); die;
        $this->load->view('v_status', $data);
        
        
    }
    
    function loadJobsiteList(){
        $sql = "select id, id as jobsite_id, cust_id
            from app_jobsite where cust_id = :sys_cust_id";
        $params = array();
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        return $qresult;
    }
    
    function showDataStatus(){
        $this->load->model('ccenter/m_ccenter', 'mcc');
        //$this->mcc->getJobsite();
        $arrjs = array();
        $jslist = $this->loadJobsiteList();
        foreach($jslist as $js){
            $xjs = $this->mcc->getJobsite($js['jobsite_id']);
            if (isset($xjs[0])){
                array_push($arrjs, $xjs[0]);
            }
        }
        //$dataStatus = $this->loadDataStatus();
        $data = $this->getDefaultData();
        $data['dataJobsite'] = $arrjs;
        //print_r($arrjs);
        $this->load->view('v_zona', $data);
    }
    
    function showAllStatus(){
        $this->load->model('ccenter/m_ccenter', 'mcc');
        //$this->mcc->getJobsite();
        $arrjs = array();
        $jslist = $this->mcc->getJobsite();
        foreach($jslist as $js){
            $xjs = $this->mcc->getJobsite($js['jobsite_id']);
            if (isset($xjs[0])){
                array_push($arrjs, $xjs[0]);
            }
        }
        //$dataStatus = $this->loadDataStatus();
        $data = $this->getDefaultData();
        $data['dataJobsite'] = $arrjs;
        //print_r($arrjs);
        $this->load->view('v_zona2', $data);
    }
    
}



?>
