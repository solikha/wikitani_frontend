<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
class Barcode extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_barcode', 'mbar');
    }
    
    function messageKeyList(){
        $result = array();
        array_push($result, array('keyword'=>'app_scanpatroli_unique_signature',
                'message'=>'Terjadi duplikasi signature. Silahkan scan ulang.'));
        array_push($result, array('keyword'=>'app_check_point_unique_kode',
                'message'=>'Kode QR Code sudah digunakan oleh Check Point Lain. Silahkan diganti dengan QR Code lain.'));
        return $result;
    }
    
    function scanpatroli(){
        try {
            $result = $this->mbar->scanpatroli();
        } catch (Exception $e) {
            $result = $this->showException($e);
        }
    }
    
    function register_qrcode(){
        try {
            $result = $this->mbar->register_qrcode();
        } catch (Exception $e) {
            $result = $this->showException($e);
        }
    }
    
    function registrasi($barcode, $check_point_id, $result_mode='view', $result_return='barcode'){
        try {
            $result = array('success'=>0, 'message'=>'unknown error.');
            $sessData = $this->checkSessionData();
            if ($sessData===false){
                throw new Exception('Not Login');
            } else {
                $username = $sessData['username'];
                $result = $this->mbar->registrasi($barcode, $check_point_id);
                //echo json_encode($result);
            }
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
            $result['success'] = 0;
            //echo json_encode($result);
        }
        if ($result_mode=='view'){
            $data = $this->mbar->getDefaultData();
            //print_r($result);
            if (isset($result['success']) and ($result['success']==1)){
                if (isset($result['message'])){
                    $data['message'] = $result['message'];
                } else {
                    $data['message'] = 'Pengiriman data barcode berhasil.';
                }
            } else {
                if (isset($result['message'])){
                    $data['message'] = $result['message'];
                } else {
                    $data['message'] = 'Pengiriman data barcode gagal.';
                }
            }
            $data['backurl'] = $data['basedir'].index_page().'/menu/'.$result_return;
            $this->load->view('barcode/vscanresult', $data);
        } else {
            echo json_encode($result);
        }
    }
    
    function patroli($barcode, $signature, $result_mode='view', $result_return='barcode'){
        try {
            //$xresult=array('checkpoint_name'=>'-', )
            $result = array('success'=>0, 'message'=>'unknown error.');
            $sessData = $this->checkSessionData();
            if ($sessData===false){
                throw new Exception('Not Login');
            } else {
                $username = $sessData['username'];
                $result = $this->mbar->patroli($barcode, $signature, $username);
                //echo json_encode($result);
            }
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
            $result['success'] = 0;
            //echo json_encode($result);
        }
        if ($result_mode=='view'){
            $data = $this->mbar->getDefaultData();
//            print_r($result); die;
            if (isset($result['success']) and ($result['success']==1)){
                if (isset($result['message'])){
                    $data['message'] = $result['message'];
                } else {
                    $jobsite = getArrayDef($result, 'nama_jobsite', '-');
                    $checkpoint = getArrayDef($result, 'nama_checkpoint', '-');
                    $data['message'] = "Pengiriman data barcode berhasil. Check Point : <strong>$checkpoint</strong> Jobsite : <strong>$jobsite</strong>";
                }
            } else {
                if (isset($result['message'])){
                    $data['message'] = $result['message'];
                } else {
                    $data['message'] = 'Pengiriman data barcode gagal.';
                }
            }
            $data['backurl'] = $data['basedir'].index_page().'/menu/'.$result_return;
            $this->load->view('barcode/vscanresult', $data);
        } else {
            echo json_encode($result);
        }
    }

    function checkstatus($signature){
        try {
            $sessData = $this->checkSessionData();
            if ($sessData===false){
                throw new Exception('Not Login');
            } else {
                $result = $this->mbar->checkstatus($signature);
                echo json_encode($result);
            }
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
            echo json_encode($result);
        }
    }
}

?>
