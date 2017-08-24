<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
class M_process extends MY_Model
{
    // data process yang diload dari database
    var $procData = array();
    var $procNewData = array();
    
    // urutan process secara serial, untuk mengetahui progress
    // array of (nama=>'', bobot=>'')
    var $serialProcess = array();
    // current task
    var $currentTask = '';
    var $viewFolder='';
    
    var $procDef = array();
    var $procFlow = array();
    var $isclose = false;
    
    public function __construct()
    {
        parent::__construct();
        // setting timezone.
    }
    
//    function getProgress2(){
//        $total_count = 0;
//        $current_count = 0;
//        $total_bobot = 0;
//        $current_bobot = 0;
//        $calc = true;
//        foreach($this->serialProcess as $item){
//            if (is_array($item)){
//                if (isset($item['bobot'])){
//                    $bobot = $item['bobot'];
//                } else {
//                    $bobot = 1;
//                }
//                $nama = $item['nama'];
//            } else {
//                $nama = $item;
//                $bobot = 1;
//            }
//            $total_bobot = $total_bobot + $bobot;
//            $total_count = $total_count + 1;
//            if ($calc){
//                $current_bobot = $current_bobot+bobot;
//                $current_count = $current_count+1;
//            }
//            if($currenttask == $nama){
//                $calc = false;
//            }
//        }
//        return array('total_count'=>$total_count, 'current_count'=>$current_count,
//            'total_bobot'=>$total_bobot, 'current_bobot'=>$current_bobot);
//    }
    
    function getProgress($taskname, $stepname){
        return 'Process';
//        $total_count = 0;
//        $current_count = 0;
//        $total_bobot = 0;
//        $current_bobot = 0;
//        foreach($this->serialProcess as $item){
//            if (isset($item['bobot'])){
//                $bobot = $item['bobot'];
//            } else {
//                $bobot = 1;
//            }
//            if (isset($item['checked'])){
//                $checked = $item['checked'];
//            } else {
//                $checked = false;
//            }
//            $nama = $item['nama'];
//            $total_bobot = $total_bobot + $bobot;
//            $total_count = $total_count + 1;
//            if ($checked){
//                $current_bobot = $current_bobot+bobot;
//                $current_count = $current_count+1;
//            }
//            if($currenttask == $nama){
//                $calc = false;
//            }
//        }
//        return array('total_count'=>$total_count, 'current_count'=>$current_count,
//            'total_bobot'=>$total_bobot, 'current_bobot'=>$current_bobot);
    }
    
    public function viewProcess($taskname='', $procid=0, $stepname=''){
        $info = $this->getProcessInfo($procid);
        //print_r($info); die;
        if($taskname==''){
            $taskname = $info['taskname'];
            $stepname = $info['stepname'];
        } else if ($stepname==''){
            $stepname = $info['stepname'];
        }
        $info['taskname'] = $taskname;
        $info['stepname'] = $stepname;
        $status = $info['status'];
//        var_dump($taskname);
//        var_dump($stepname);
        if ($this->allowLoadView($status, $taskname, $stepname)){
            $this->loadProcessData($procid, $info);
//            var_dump($taskname);
//            var_dump($stepname);
            $data = array();
            $data['info'] = $info;
            $data['procData'] = $this->procData;
            //print_r($data); die;
            $result = $this->loadView($taskname, $stepname, $data);
        } else {
            throw new MgException('load error', 'Data task tidak diketemukan.');
        }
        return $result;
    }
    
    public function loadView($taskname, $stepname, $data){
            $viewname = $this->getViewName($taskname, $stepname);
            if($this->viewFolder!==''){
                $viewname = $this->viewFolder.'/'.$viewname;
            }
			//print_r($data); die;
            $this->load->view($viewname, $data);
            $this->load->view('process/vscripts', $data);
    }
    
    public function allowLoadView($status, $taskname, $stepname){
        $vstatus = $this->getStatusDef($taskname);
//        echo "taskname: "; var_dump($taskname);
//        echo "status: "; var_dump($status);
//        echo "vstatus: "; var_dump($vstatus);die;
        if ($vstatus==$status) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getProcessInfo($procid){
        //var_dump($procid);
        if((int)$procid === 0){
            //echo "xxx";
            $first = $this->getFirstTask();
            $result = $this->procDef;
            $result['taskname'] = $first['taskname'];
            $result['stepname'] = $first['stepname'];
            $result['status'] = $first['status'];
        } else {
            $sql = "select id, procname, createuser, createtime, taskname, stepname, 
                rolename, status, updateuser, updatetime, progress
                from app_process
                where id = :procid
                ";
            $params = array('procid'=>$procid);
            $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
            if(isset($qresult[0])){
                $result = $qresult[0];
            } else {
                $result = array();
            }
            if(!isset($result['taskname'])){
                $result['taskname'] = '';
            }
            if(!isset($result['stepname'])){
                $result['stepname'] = '';
            }
        }
        return $result;
    }
    
    public function saveProcessData($procid=0){
        $this->procNewData = $_POST;
        $this->checkProcessData();
        $this->loadProcessData($procid);
        $this->prepareTaskData($procid);
        
        $this->beforeSaveData();
        $this->saveData($procid);
        $this->afterSaveData();
        $result = array('success'=>1);
        if ($this->isclose){
            $result['isclose'] = true;
        } else if ($this->procNewData['stepname']!==''){
            $procid = $this->procNewData['procid'];
            $taskname = $this->procNewData['taskname'];
            $stepname = $this->procNewData['stepname'];
            $result['isclose'] = false;
            $result['url'] = 'process/view/'.$this->procDef['procname'].'/'.$procid;
            //$result['view'] = $this->viewProcess('', $procid);
        } else {
            $result['isclose'] = true;
        }
        return $result;
    }
    
    public function prepareTaskData($procid){
	
        $info = $this->getProcessInfo($procid);
		
        $this->procData = array_merge($info, $this->procData);
		//echo "xxx", var_dump($this->procNewData['cust_id']); die;
        $this->procNewData = array_merge($this->procData, $this->procNewData);
		//echo "xxx", var_dump($this->procNewData['cust_id']); die;
        if(!isset($this->procNewData['flowname'])){
            $this->procNewData['flowname'] = 'next';
        } else {
            if($this->procNewData['flowname']==''){
                $this->procNewData['flowname'] = 'next';
            }
        }
        $flowname = $this->procNewData['flowname'];
        if ($flowname=='save'){
            $this->isclose = true;
            $taskname = $this->procNewData['taskname'];
            $stepname = $this->procNewData['stepname'];
        } else {
            $this->isclose = false;
            $stepname = $this->getNextStep($this->procNewData['taskname'], $this->procNewData['stepname'], $flowname);
            if ($stepname===''){
                $taskname = $this->getNextTask($this->procNewData['taskname'], $flowname);
            } else {
                $taskname = $this->procNewData['taskname'];
            }
        }
//        echo "stepname: "; var_dump($stepname);
//        echo "taskname: "; var_dump($taskname); die;
        $this->procNewData['next_taskname'] = $taskname;
        $this->procNewData['next_stepname'] = $stepname;
        $stepInfo = $this->getStepInfo($taskname, $stepname);
        //print_r($stepInfo); die;
        //print_r($this->sessiondata); die;
        $this->procNewData['createuser'] = $this->sessiondata['username'];
        $this->procNewData['rolename'] = $stepInfo['rolename'];
        $this->procNewData['status'] = $stepInfo['status'];
        //print_r($this->procNewData); die;
    }
    public function saveData($procid){
		//echo "xxx"; print_r($this->procNewData); die;
        $this->procNewData['taskname'] = $this->procNewData['next_taskname'];
        $this->procNewData['stepname'] = $this->procNewData['next_stepname'];
        unset($this->procNewData['flowname']);
        unset($this->procNewData['next_taskname']);
        unset($this->procNewData['next_stepname']);
//        print_r($info);
//        print_r($this->procData); die;
//        echo $procid;
        if ((int)$procid===0){
            // data baru
            $this->insertData();
        } else {
            // update
            $this->updateData($procid);
        }
    }
    
    function insertData(){
        $sql = "select 0;
            insert into app_process(procname, title, subtitle, createuser, 
            createtime, procdata, taskname, stepname, rolename, status, 
            updateuser, updatetime, progress)
            values (:procname, :title, :subtitle, :createuser, 
            now(), :procdata, :taskname, :stepname, :rolename, :status, 
            :sys_username, now(), :progress);
            select currval('app_process_id_seq') as procid;";
        $params = $this->procNewData;
        $procdata = json_encode($params);
        $params['procdata'] = $procdata;
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        $this->procNewData['procid'] = $result[0]['procid'];
        //$this->mdb->execSQL('application', $sql, $params);
    }
    
    public function updateData($procid){
        $sql = "update app_process
            set procname = :procname, title = :title, subtitle = :subtitle,
            procdata = :procdata, taskname = :taskname, stepname = :stepname,
            rolename = :rolename, status = :status, updateuser = :sys_username,
            updatetime = now(), progress = :progress
            where id = :procid;
            ";
        $params = $this->procNewData;
        $procdata = json_encode($params);
        $params['procdata'] = $procdata;
        $result = $this->mdb->ExecSQL('application', $sql, $params);
        
    }
    
    public function checkProcessData(){
        if (!isset($this->procNewData['taskname'])){
            throw new MgException('save error', 'Nama task tidak boleh kosong.');
        }
        if (($this->procNewData['taskname'])===''){
            throw new MgException('save error', 'Nama task tidak boleh kosong.');
        }
        if (!isset($this->procNewData['stepname'])){
            throw new MgException('save error', 'Nama step tidak terdefinisi.');
        }
        
    }
    
    public function getStepInfo($taskname, $stepname){
        return array('rolename'=>'admin', 'status'=>'process');
    }
    
    public function loadProcessData($procid, $info=array()){
        if((int)$procid === 0){
            $first = $this->getFirstTask();
            $result = $this->procDef;
            $result['taskname'] = $first['taskname'];
            $result['stepname'] = $first['stepname'];
            $result['status'] = $first['status'];
        } else {
            $sql = "select id, procdata
                from app_process
                where id = :procid
                ";
            $params = array('procid'=>$procid);
            $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
            if(isset($qresult[0])){
                $result = json_decode($qresult[0]['procdata'], true);
            } else {
                $result = array();
            }
            $result['procid'] = $procid;
        }
        $this->procData = array_merge($info, $result);
        //print_r($this->procData);
        return;
    }
    
    public function getFirstTask(){
        return array('taskname'=>'', 'stepname'=>'', 'status'=>'draft');
    }
    
    public function getStatusDef($taskname){
        //
        return 'draft';
    }
    
    // overidden methods.
    public function getNextTask($taskname, $flowname){
        // get next task
        return '';
    }
    
    public function getNextStep($taskname, $stepname, $flowname){
        // get next step
        return '';
    }
    
    public function getViewName($taskname, $stepname){
        // get view name
    }
    
    public function onLoadData($taskname, $stepname){
        // dipanggil ketika data di-load sebelum view dipanggil
        
    }
    
    public function afterSaveData(){
        // dipanggil setelah data disimpan
        
    }
    
    public function beforeSaveData(){
        // dipanggil sebelum data disimpan
        
    }
    
}
?>
