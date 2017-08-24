<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_service extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function ProcessMessage(){
        $result = array('success'=>1);
        return $result;
    }
    
    public function SendMessage($xparams){
        //{"pin":"1234","msisdn":"08182206876","nominal":"10","sendertype":1,"sendercode":"08562158005"}
        $sendertype = $xparams['sendertype'];
        $sendercode = $xparams['sendercode'];
        $custid = $this->getCustomerId($sendertype, $sendercode);
        $custid = (($custid==0)?'':$custid);
        //echo '*'.$custid.'*';
        $default = array('customerid'=>$custid, 'processid'=>1, 'statusdata'=>0, 
            'statusflow'=>0, 'data'=>'', 'sendertype'=>0, 'sendercode'=>'');
        $sql = 'insert into apw_requests(processid, statusflow, statusdata, 
            data, sendertype, sendercode, customerid) values 
            (:processid, :statusflow, :statusdata, :data, :sendertype, 
            :sendercode, :customerid);';
        $params = array_merge($default, $xparams);
        $qresult = $this->mdb->ExecSQL('application', $sql, $params);
        return array ('succes'=>1);
    }
    
    public function getCustomerId($sendertype, $sendercode){
        $sql = 'select customerid from apr_sender where sendertype = :sendertype 
            and sendercode = :sendercode';
        $params = array('sendertype'=>$sendertype, 'sendercode'=>$sendercode);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qresult[0])){
            $result = $qresult[0]['customerid'];
        } else {
            $result = 0;
        }
        return $result;
        
    }
    
}



?>
