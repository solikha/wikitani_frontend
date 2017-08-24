<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
class M_barcode extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function scanpatroli(){
        $data = $this->getDefaultData();
        $data['signature'] = 'BCPAT';
        $this->load->view('barcode/vscanbarcode', $data);
    }
    
    public function register_qrcode(){
        $data = $this->getDefaultData();
        $data['signature'] = 'BCPAT';
        $data['check_point_id'] = $_GET['check_point_id'];
        $this->load->view('barcode/vregisterbarcode', $data);
    }
    
    public function patroli($barcode, $signature, $username){
        $sql = "insert into app_scanpatroli(kode, signature, sendtime, username)
            values(:kode, :signature, now(), :username)";
        $params = array('kode'=>$barcode, 'signature'=>$signature, 'username'=>$username);
        //print_r($params);
        $this->mdb->ExecSQL('application', $sql, $params);
        $result = $this->getDataBySignature($signature);
        $result['success'] = 1;
        return $result;
    }
    
    function getDataBySignature($signature){
        $sql = "select a.id, a.kode, a.signature,
            coalesce(b.nama, '-') as nama_checkpoint, coalesce(c.nama, '-') as nama_jobsite
            from app_scanpatroli a
            left join app_check_point b on a.kode = b.kode
            left join app_jobsite c on b.jobsite_id = c.id
            where a.signature = :signature";
        $params = array('signature'=>$signature);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if(isset($result[0])){
            return $result[0];
        } else {
            return array();
        }
    }
    
    public function registrasi($barcode, $check_point_id){
        $sql = "update app_check_point set kode = :kode where id = :check_point_id";
        $params = array('kode'=>$barcode, 'check_point_id'=>$check_point_id);
        //print_r($params);
        $this->mdb->ExecSQL('application', $sql, $params);
        return array('success'=>1);
    }
    
    public function checkstatus($signature){
        $sql = "select a.id, a.kode, a.signature,
            coalesce(b.nama, '-') as nama_checkpoint, coalesce(c.nama, '-') as nama_jobsite
            from app_scanpatroli a
            left join app_check_point b on a.kode = b.kode
            left join app_jobsite c on b.jobsite_id = c.id
            where a.signature = :signature";
        $params = array('signature'=>$signature);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if(isset($result[0])){
            $message = 'Kode '.$result[0]['kode'].' sudah terkirim. Checkpoint : '.
                $result[0]['nama_checkpoint'].
                ', Jobsite : '.$result[0]['nama_jobsite'].'.';
            $sent = 1;
        } else {
            $message = 'Data belum terkirim.';
            $sent = 0;
        }
        return array('success'=>1, 'sent'=>$sent, 'message'=>$message);
    }

}    
?>
