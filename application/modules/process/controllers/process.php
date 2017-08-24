<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
class Process extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_process', 'mprocess');
    }
    
    function view($procname, $procid=0, $taskname='', $stepname=''){
        $sessData = $this->checkSessionData();
        if ($sessData===false){
            echo "not Login";
        } else {
            $username = $sessData['username'];
            $this->updateSysParamsUserInfo($username);
            
            $this->load->model('m_'.$procname, 'mproc');
            if ((int)$procid===0){
                if(isset($_POST['procid'])){
                    $procid = $_POST['procid'];
                }
            }
            echo $this->mproc->viewProcess($taskname, $procid, $stepname);
        }
    }
    
    function svsave($procname){
        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            $this->load->model('m_'.$procname, 'mproc');
            if ($sessData===false){
                throw new MgException('login', 'Belum login.');
            } else {
                if (isset($_POST['procid'])){
                    $procid = $_POST['procid'];
                } else {
                    $procid = 0;
                }
                $username = $sessData['username'];
                $this->updateSysParamsUserInfo($username);
                $result = $this->mproc->saveProcessData($procid);
                //$result = array('success'=>1);
            }
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
        }
        echo json_encode($result);
    }
    
    
    public function test(){
        echo 'percobaan 12345';
    }
    
    public function viewprint($procname, $taskname='', $stepname=''){
        if (isset($_GET['procid'])){
            $procid = $_GET['procid'];
        } else {
            $procid = 0;
        }
        
        $this->load->model('m_'.$procname, 'mproc');
        $content = $this->mproc->viewProcess($taskname, $procid, $stepname);
        
        //$this->view($procname, $procid, $taskname, $stepname);
        //echo 'percobaan 12345';
        $data = $this->mproc->getDefaultData();
        $data['pagecontent'] = $content;
        $this->load->view('menu/baseblank', $data);
        echo "<script>window.print();</script>";
    }
    
}
?>
