<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Flexcrud extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
//    public function command(){
//        echo "testing";
//    }

    public function _xremap($methodname){
        $this->openCrud($methodname);
    }
    
    function getCrudFileName($crudname, $actionname){
        $basefolder = $this->ci->config->item('basefolder').'flexcrud/';
        $filename = $basefolder.$crudname.'/'.$actionname.".flexcrud";
        return $filename;
    }
    
    public function index($crudname, $actionname='browse'){
        //echo "*****";
        //echo $methodname;
        $filename = $this->getCrudFileName($crudname, $actionname);
        //echo $filename;
        if (file_exists($filename)){
            $this->load->model('m_flexcrud', 'mfcrud');
            $this->mfcrud->showCrud($crudname, $actionname);
        } else {
            show_404();
        }        
    }
    
    public function command($crudname, $actionname){
        $this->load->model('m_crud', 'mcrud');
        $basefolder = $this->ci->config->item('basefolder').'crud/';
        $filename = $basefolder.$crudname.'/'.$actionname.".query";
        //echo $filename;
        if (file_exists($filename)){
            $this->mcrud->showCommand($crudname, $actionname);
        } else {
            $this->mcrud->showCommand('base', 'construction');
        }
    }
    
    public function openCrud($crudname){
        $this->load->model('m_crud', 'mcrud');
        $ctparams = $this->mcrud->getViewDataParams($crudname);
        print_r($ctparams);
    }
    
    public function recview($crudname, $actionname='recordview'){
        //echo "test";
        $this->load->model('m_crud', 'mcrud');
        $basefolder = $this->ci->config->item('basefolder').'crud/';
        $filename = $basefolder.$crudname.'/'.$actionname.".query";
        //echo $filename;
        if (file_exists($filename)){
            $this->mcrud->showRecord($crudname, $actionname);
        } else {
            $this->mcrud->showRecord('base', 'construction');
        }
    }
    
    public function svqueryview($crudname, $actionname){
        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            if ($sessData===false){
                $result = array('success'=>0, 'error'=>1, 'errorname'=>'belum_login', 'message'=>'Belum login.');
            } else {
                $this->load->model('m_crud', 'mcrud');
                $this->mcrud->loadCrudFile($crudname, $actionname);
                $yparams = $this->mcrud->getDefaultSQLParams();
                $xparams = $this->mcrud->getDefaultParams();
                $xparams = array_merge($yparams, $xparams);
                $params = array_merge($xparams, $_GET);
                $xresult = $this->mcrud->getViewDataGrid($params);
                $result = array();
                $result['crudgrid'] = $xresult['view'];
                $result['crudpages'] = $xresult['pagination'];
                $result['crudcommands'] = $xresult['crudcommands'];
                $result['crudgridinfo'] = $xresult['gridinfo'];
                $result['success'] = 1;
            }
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
        }
        echo json_encode($result);
    }

    public function svexecdata($crudname, $actionname, $command=''){
        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            if ($sessData===false){
                $result = array('success'=>0, 'error'=>1, 'errorname'=>'belum_login', 'message'=>'Belum login.');
            } else {
                if ($command===''){
                    $command = 'sqlexec';
                }
                $this->load->model('m_crud', 'mcrud');
                $this->mcrud->loadCrudFile($crudname, $actionname);
                $result = $this->mcrud->executeData($command, $_POST);
            }
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
        }
        echo json_encode($result);
    }
    
    public function svlookup($lookupname){
        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            if ($sessData===false){
                $result = array('success'=>0, 'error'=>1, 'errorname'=>'belum_login', 'message'=>'Belum login.');
            } else {
                $this->load->model('m_crud', 'mcrud');
                $params = $_GET;
                $value = '';
                $ludata = $this->mcrud->getViewLookup($lookupname, $params, $value);
                $ludata['lookupname'] = $lookupname;
                $ludata['success'] = 1;
                $result = $ludata;
                //$this->mcrud->loadCrudFile($crudname, $actionname);
                //$result = $this->mcrud->executeData($command, $_POST);
            }
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
        }
        echo json_encode($result);
    }

    public function svcblookup($lookupname){
        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            if ($sessData===false){
                $result = array('success'=>0, 'error'=>1, 'errorname'=>'belum_login', 'message'=>'Belum login.');
            } else {
                $this->load->model('m_crud', 'mcrud');
                $params = $_GET;
                $value = '';
                $ludata = $this->mcrud->getViewCheckListBox($lookupname, $params, $value);
                $ludata['lookupname'] = $lookupname;
                $ludata['success'] = 1;
                $result = $ludata;
                //$this->mcrud->loadCrudFile($crudname, $actionname);
                //$result = $this->mcrud->executeData($command, $_POST);
            }
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
        }
        echo json_encode($result);
    }
    
}
?>
