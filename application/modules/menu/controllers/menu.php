<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
            echo modules::run('login', '');
        //echo "testing";
    }

    public function _remap($methodname, $params=array()){
        $this->openMenu($methodname, $params);
    }
    
    function openMenu($menuname, $params=array()) {
        try {
//            $this->load->model('login/m_login', 'mlogin');
//            $sessData = $this->mlogin->getSessionData();
            $sessData = $this->checkSessionData();
            //$this->sessiondata = $sessData;
			//print_r($sessData);
			//die;
            if ($sessData===false){
               
                echo Modules::run('search_engine');
                //$this->mlogin->openLoginScreen();
            } else {
                $username = $sessData['username'];
                $this->updateSysParamsUserInfo($username);
                $this->load->model('m_menu', 'mmenu');
                $menuinfo = $this->mmenu->getMenuInfo($menuname);

                if ($menuinfo === false) {
                    show_404();
                } else {
                    $data = $this->mmenu->getDefaultData();

                    $ctmenu = $this->mmenu->getViewMainMenu();
                    $data['mainmenu'] = $ctmenu['view'];
                    if(isset($menuinfo['menuoptions']) and ($menuinfo['menuoptions']!=='')){
                        $data['menuoptions'] = json_decode($menuinfo['menuoptions'], true);
                    } else {
                        $data['menuoptions'] = array();
                    }
                    $cmd = $menuinfo['command'];
                    if (trim($menuinfo['context'])===''){
                        $ctx = array();
                    } else {
                        $ctx = explode("/", $menuinfo['context']);
                    }
                    $xcmd = array_merge(array($cmd), $ctx);
                    if(count($params)>0){
                        $xcmd = array_merge($xcmd, $params);
                    }
                    $data['pagecontent'] = call_user_func_array('Modules::run', $xcmd);
                    //print_r($data);
                    $user_dispname = $sessData['username'];
                    if(isset($sessData['fullname'])){
                        if($sessData['fullname']!==''){
                            $user_dispname = $sessData['fullname'];
                        }
                    }
                    $data['displayname'] = $user_dispname;
                    $data['username'] = $sessData['username'];
                    $data['sysparams'] = $this->mdb->defparams;
					$data["page"]="";
                    $this->load->view('menu/baseview', $data);
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "\r\n" . $e->getTraceAsString();
//                $this->showError($e);
        }
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