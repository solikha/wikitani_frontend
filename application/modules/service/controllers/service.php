<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        //$this->load->view('welcome_message');
        //echo modules::run('login', '');
        //echo "testing";
        $result = array('success'=>0, 'error'=>1, 'message'=>'request salah');
    }

    public function svprocessmessage(){
        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            if ($sessData===false){
                $vmsg = 'Belum login.';
                $result = array('success'=>0, 'error'=>1, 'message'=>$vmsg);
                echo json_encode($result);
            } else {
                $this->load->model('process/m_process', 'process');
                $data = $this->process->getMessageData();
                $result = $this->process->ProcessMessages($data);
                echo json_encode($result);
                //echo "sudah login";
            }
        } catch (Exception $e) {
            $vmsg = $e->getMessage() . "\r\n" . $e->getTraceAsString();
            $result = array('success'=>0, 'error'=>1, 'message'=>$vmsg);
            echo json_encode($result);
        }
    }
    
    public function svsendmessage(){
        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            if ($sessData===false){
                $vmsg = 'Belum login.';
                $result = array('success'=>0, 'error'=>1, 'message'=>$vmsg);
                echo json_encode($result);
            } else {
                $this->load->model('m_service', 'svc');
                $result = $this->svc->SendMessage($_POST);
                //echo json_encode($result);
                //echo "sudah login";
            }
        } catch (Exception $e) {
            $vmsg = $e->getMessage() . "\r\n" . $e->getTraceAsString();
            $result = array('success'=>0, 'error'=>1, 'message'=>$vmsg);
            echo json_encode($result);
        }
        
//        $data = $_POST;
//        $result = $_POST;
//        $result['success'] = 1;
        
        echo json_encode($result);
    }
    
    function openMenu($menuname) {
        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            if ($sessData===false){
                //echo "***";
                echo Modules::run('login');
                //$this->mlogin->openLoginScreen();
            } else {
                $this->load->model('m_menu', 'mmenu');
                $menuinfo = $this->mmenu->getMenuInfo($menuname);

                if ($menuinfo === false) {
                    show_404();
                } else {
                    $data = $this->mmenu->getDefaultData();

                    $ctmenu = $this->mmenu->getViewMainMenu();
                    $data['mainmenu'] = $ctmenu['view'];

                    $cmd = $menuinfo['command'];
                    $ctx = $menuinfo['context'];
                    $data['pagecontent'] = Modules::run($cmd, $ctx);

                    $this->load->view('menu/baseview', $data);
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "\r\n" . $e->getTraceAsString();
//                $this->showError($e);
        }
    }
    
    public function coba(){
        echo "coba";
    }

    public function testing() {
        try {
            $this->load->model('m_menu', 'menu');
            $data = $this->mmenu->getDefaultData();

            $ctmenu = $this->mmenu->getViewMainMenu();
            $data['mainmenu'] = $ctmenu['view'];
            //print_r($ctmenu);
            $this->load->view('baseview', $data);

            //print_r($data);
        } catch (Exception $e) {
            echo $e->getMessage() . "\r\n" . $e->getTraceAsString();
//                $this->showError($e);
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */