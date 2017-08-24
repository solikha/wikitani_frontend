<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_cronstatus extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->library('amqp');
        $this->amqp->declareTopic('', true);
        $this->load->model('ccenter/m_ccenter', 'mcc');
    }

    public function echoLogInfo($caption){
        echo "[".date("D M d, Y G:i:s a")."] ".$caption;
        echo "<br>\r\n";
    }
    
    function prepareProcess(){
    }
    
    function loadAlarmData(){
        $sql = "select nextval('alarm_process_counter_seq');
            update app_alarm_temp set updateid = currval('alarm_process_counter_seq')
            where updateid is null;
            select a.*, b.nama as nama_zona, b.jobsite_id, c.cust_id
              from app_alarm_temp a 
              left join app_jobsite_zona b on a.zonaid = b.id
              left join app_jobsite c on b.jobsite_id = c.id
              where a.updateid = currval('alarm_process_counter_seq')
            ";
        $params = array();
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qresult[0])){
            $result = array(
                'updateid'=>$qresult[0]['updateid'],
                'data'=>$qresult
            );
        } else {
            $result = array(
                'updateid'=>0,
                'data'=>array()
            );
        }
        return $result;
    }
    
    function updateStatus($item){
        $sql = "select zonastatus, coalesce(applyall, 0) as applyall from app_alarm_change 
            where alarmtype = :alarmtype 
            and alarmstatus = :alarmstatus;
        ";
        //print_r($item);
        $qresult = $this->mdb->QueryData('application', $sql, $item, 'record');
        //print_r($qresult);
        if (isset($qresult[0])){
            $item['zonastatus'] = $qresult[0]['zonastatus'];
            $applyall = $qresult[0]['applyall'];
            if ($applyall==1){
                $sql = "
                    update app_jobsite_zona
                    set status = :zonastatus, updateid = :updateid,
                        sourcename = :sourcename, source_id = :source_id
                    where terminal_id = :terminal_id;
                ";
            } else {
                $sql = "
                    update app_jobsite_zona
                    set status = :zonastatus, updateid = :updateid,
                        sourcename = :sourcename, source_id = :source_id
                    where terminal_id = :terminal_id and hardware_id = :hardware_id;
                ";
            }
            $this->mdb->ExecSQL('application', $sql, $item);
            return $qresult[0];
        } else {
            return array();
        }
        
    }
    
    function getStatusInfo($category, $status){
        $sql = "select * from app_zona_status
            where category = :category and status = :status
            ";
        $params = array('category'=>$category, 'status'=>$status);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qresult[0])){
            return $qresult[0];
        } else {
            return array();
        }
    }
    
    function updateJobsiteStatus($jobsiteid){
        $sql = "select a.*, b.cust_id, b.status_zona,
            b.nama as nama_jobsite, c.nama as cust_nama
            from app_jobsite_zona a
            left join app_jobsite b on a.jobsite_id = b.id
            left join app_customer c on b.cust_id = c.id
            where jobsite_id = :jobsite_id
        ";
        $params = array('jobsite_id'=>$jobsiteid);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        //print_r($qresult); die;
        if(isset($qresult[0])){
            $old_status = $qresult[0]['status_zona'];
            $cust_id = $qresult[0]['cust_id'];
            $total=0;
            $armed = 0;
            $disarmed = 0;
            $panic = 0;
            $none = 0;
            $alarm = 0;
            $xalarm = '';
            $data = $qresult[0];
            print_r($qresult);
            foreach($qresult as $row){
                if ($row['status']=='arm'){
                    $armed = $armed+1;
                } else if ($row['status']=='disarm'){
                    $disarmed = $disarmed+1;
                } else if ($row['status']=='panic'){
                    $panic = $panic+1;
                } else if ($row['status']===''){
                    $none = $none+1;
                } else {
                    $alarm=$alarm+1;
                    $xalarm = $row['status'];
                }
                $total = $total+1;
            }
            $status = 'none';
            if ($alarm>0){
                if ($alarm>1){
                    $status = 'multi';
                } else {
                    $status = $xalarm;
                }
            } else if ($panic>0){
                $status = 'panic';
            } else if ($disarmed>0){
                $status = 'disarm';
            } else if ($armed>0){
                $status = 'arm';
            }
            // update data
            $sql = "update app_jobsite
                set status_zona = :status,
                last_upd_zona = now()
                where id = :jobsite_id";
            $params = array('status'=>$status, 'jobsite_id'=>$jobsiteid);
            $this->mdb->ExecSQL('application', $sql, $params);
            
            
            
            // send notification
            $vdata = $this->mcc->getJobsite($jobsiteid);
            if($old_status!=$status){
                //echo "yyy"; die;
                if (isset($vdata[0])){ 
                    $data = $vdata[0];
                    $this->dispatchJobsiteStatus($data);
                }
            } else {
                if (isset($vdata[0])){ 
                //echo "xxx"; die;
                    $data = $vdata[0];
                    $data['ispopup'] = '0';
                    $data['issound'] = '0';
                    $data['isfocus'] = '0';
                    $this->dispatchJobsiteStatus($data);
                }
            }
        }
    }
    
    function dispatchJobsiteStatus($data){
//        echo "========";
//        print_r($data); echo "XXX"; die;
        if (isset($data['jobsite_id'])){
            $xdata = array();
            $jsid = $data['jobsite_id'];
            $custid = $data['cust_id'];
            $topicname = "customer.$custid.jobsite.$jsid.status";
            $xdata['topic_group'] = 'jobsite';
            $xdata['topic_data'] = 'status';
            $xdata['topic_name'] = $topicname;
            $xdata['sender'] = 'cronstatus';
            $date = new DateTime();
            $xdata['timestamp'] = $date->format('Y-m-d H:i:s');
            $xdata['data'] = $data;
            //print_r($xdata); echo "--xxx"; die;
            // disini
            $this->updateMessageUser($data);
            $this->amqp->sendTopic($topicname, $xdata);
        }
    }
    
    function dispatchZonaStatus($data){
        if (isset($data['zonaid'])){
            $xdata = array();
            $jsid = $data['jobsite_id'];
            $zonaid = $data['zonaid'];
            $custid = $data['cust_id'];
            $topicname = "customer.$custid.jobsite.$jsid.zona.$zonaid.status";
            $xdata['topic_group'] = 'jobsite.zona';
            $xdata['topic_data'] = 'status';
            $xdata['topic_name'] = $topicname;
            $xdata['sender'] = 'cronstatus';
            $date = new DateTime();
            $xdata['timestamp'] = $date->format('Y-m-d H:i:s');
            $xdata['data'] = $data;
            $this->amqp->sendTopic($topicname, $xdata);
        }
    }
    
    function updateMessageUser($data){
        $vmessage = $data['nama'].' is '.$data['status_zona_caption'].'.';
        $xmessage = '';
        foreach($data['zona_info'] as $item_zona){
            if ($xmessage!==''){
                $xmessage = $xmessage.', ';
            }
            $xmessage = $xmessage.$item_zona['nama'].' is '.$item_zona['caption'];
        }
        if ($xmessage!==''){
            $vmessage = $vmessage.'<br>Zona : '.$xmessage;
        }
        $sql="insert into app_messages(message, sender, sender_category, username)
            select :message, 'system_status', 'system', username 
            from sys_users
            where cust_id = :cust_id";
        $sql2="insert into app_messages(message, sender, sender_category, username)
            values (:message, 'system_status', 'system', 'g:petugas')
            ";
        echo "update message user";
        print_r($data);
        try {
            $params = array('message'=>$vmessage, 'cust_id'=>$data['cust_id']);
            $this->mdb->ExecSQL('application', $sql, $params);
            $this->mdb->ExecSQL('application', $sql2, $params);
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
    
    function rabbitStatusDispatch($data){
        echo "dispatch status";
        $xdata = array();
        $topicname = "jobsite.status";
        $xdata['topic_group'] = 'jobsite';
        $xdata['topic_data'] = 'status';
        $xdata['topic_name'] = $topicname;
        $xdata['sender'] = 'cronstatus';
        $date = new DateTime();
        $xdata['timestamp'] = $date->format('Y-m-d H:i:s');
        $xdata['data'] = $data;
        $this->amqp->sendTopic($topicname, $xdata);
    }
    
    function rabbitDispatch($data){
        return;
        //
        //print_r($data);
        $this->dispatchZonaStatus($data);
        //$this->amqp->sendTopic('test', $data);
    }
    
    function deleteTemp($updateid){
        $sql = "delete from app_alarm_temp
            where updateid = :updateid;
        ";
        $this->mdb->ExecSQL('application', $sql, array('updateid'=>$updateid));
    }
    
    public function doProcess(){
        $this->echoLogInfo('Start Process');
        $start_time = microtime();
        $this->prepareProcess();
        $result = $this->loadAlarmData();
        $stcount = 0;
        foreach($result['data'] as $item){
            $status = $this->updateStatus($item);
            $item = array_merge($item, $status);
            print_r($item);
            if (isset($status['zonastatus'])){
                //$dest = 'status';
                $stcount = $stcount+1;
                $this->rabbitDispatch($item);
            }            
            $this->updateJobsiteStatus($item['jobsite_id']);
        }
        $this->deleteTemp($result['updateid']);
        if($stcount>0){
            $data = array('message'=>'Status dari Jobsite');
            $this->rabbitStatusDispatch($data);
        }
        usleep(200);
        $execution_time = microtime()-$start_time;
        $this->echoLogInfo('Finished. Duration: '.number_format($execution_time, 5).' detik');
        
        
    }
}
?>
