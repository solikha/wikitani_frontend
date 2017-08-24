<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Crud extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
//    public function command(){
//        echo "testing";
//    }

    public function _xremap($methodname){
        $this->openCrud($methodname);
    }
    
    public function index($crudname, $actionname='browse'){
        try {
            $this->crud_load('', $crudname, $actionname);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function call($namespace, $crudname, $actionname='browse'){
        $this->crud_load($namespace, $crudname, $actionname);
    }
    
    function messageKeyList(){
        $result = array();
        array_push($result, array('keyword'=>'app_scanpatroli_unique_signature',
                'message'=>'Terjadi duplikasi signature. Silahkan scan ulang.'));
        array_push($result, array('keyword'=>'app_check_point_unique_kode',
                'message'=>'Kode QR Code sudah digunakan oleh Check Point Lain. Silahkan diganti dengan QR Code lain.'));
        array_push($result, array('keyword'=>'Undefined index: file_id',
                'message'=>'File tidak boleh dikosongkan.'));
        
        return $result;
    }
    

	private function checkAccess($username, $crudname, $actionname){
		//$isAdmin = $this->mcrud->isAdmin($sessData['username']);
		if($this->mcrud->isAdmin($username)){
			return true;
		} else {
			$arr_public = array(
				'layanan_wni', 'layanan_ganti_paspor', 'layanan_ganti_paspor', 'layanan_kelahiran',
				'layanan_konversi_ganti_alamat', 'layanan_konversi_ganti_alamat', 'layanan_konversi_ganti_nama', 
				'layanan_konversi_ganti_stat_pekejaan', 'layanan_lapor_diri', 'layanan_lapor_menikah',
				'layanan_lapor_meninggal', 'layanan_paspor_baru_anak', 'layanan_pindah_wn', 'layanan_pulang_habis',
				'layanan_ref', 'layanan_splp', 'layanan_wni', 'layanan_wni_attch', 'layanan_wni_input'
			);
			if (in_array($crudname, $arr_public)){
				return true;
			}
		}
		return false;
	}
	
    private function crud_load($namespace, $crudname, $actionname='browse'){
//        echo "*****";
//        echo $crudname;
//        die;

        $this->load->model('m_crud', 'mcrud');
        $this->mcrud->namespace = $namespace;

        $sessData = $this->checkSessionData();
        if ($sessData===false){
            //echo "***";
            echo 'not login.';
            //$this->mlogin->openLoginScreen();
        } else {
			if ($this->checkAccess($sessData['username'], $crudname, $actionname)){
		
				$basefolder = $this->ci->config->item('basefolder').'crud/';
				$filename = $basefolder.$crudname.'/'.$actionname.".query";
				//echo $filename;
				if (file_exists($filename)){
					$this->mcrud->sessionData = $sessData;
					$username = $sessData['username'];
					$this->updateSysParamsUserInfo($username);
					$this->mcrud->showCrud($crudname, $actionname);
				} else {
					echo $filename;
					echo "<br>";
					echo "not Found";
					//show_404();
				}       
			} else {
				//echo "No Access to This Menu";
				show_404();
			}
        }
    }
    
    public function command($crudname, $actionname){
        $this->commandload('', $crudname, $actionname);
    }
    
    public function commandcall($namespace, $crudname, $actionname){
        $this->commandload($namespace, $crudname, $actionname);
    }
    
    private function commandload($namespace, $crudname, $actionname){
        $this->load->model('m_crud', 'mcrud');
        $this->mcrud->namespace = $namespace;
        $sessData = $this->checkSessionData();
        if ($sessData===false){
            //echo "***";
            echo 'not login.';
            //$this->mlogin->openLoginScreen();
        } else {
			if ($this->checkAccess($sessData['username'], $crudname, $actionname)){
				$basefolder = $this->ci->config->item('basefolder').'crud/';
				$filename = $basefolder.$crudname.'/'.$actionname.".query";
				//echo $filename;
				$this->mcrud->sessionData = $sessData;
				$username = $sessData['username'];
				$this->updateSysParamsUserInfo($username);
				if (file_exists($filename)){
					$this->mcrud->showCommand($crudname, $actionname);
				} else {
					$this->mcrud->showCommand('base', 'construction');
				}
			} else {
				echo "<br> No Access to This Command<br><br>";
			}
        }
    }
    
    public function openCrud($crudname){
        $this->load->model('m_crud', 'mcrud');
        $ctparams = $this->mcrud->getViewDataParams($crudname);
        //print_r($ctparams);
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
        $namespace = '';
        $this->svloadqueryview($namespace, $crudname, $actionname);
    }
    
    public function svcallqueryview($namespace, $crudname, $actionname){
        $this->svloadqueryview($namespace, $crudname, $actionname);
    }
    
    public function svloadqueryview($namespace, $crudname, $actionname){
        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            if ($sessData===false){
                $result = array('success'=>0, 'error'=>1, 'errorname'=>'belum_login', 'message'=>'Belum login.');
            } else {
                $this->load->model('m_crud', 'mcrud');
                $this->mcrud->namespace = $namespace;
                $username = $sessData['username'];
                //echo $username;
                $sysuserinfo = $this->getSysUserInfo($username);
                //$this->mcrud->mdb->mergeDefParams($sysuserinfo);
                //$this->mdb->mergeDefParams($sysuserinfo);
                $this->updateSysParamsUserInfo($username);
                $this->mcrud->loadCrudFile($crudname, $actionname);
                $yparams = $this->mcrud->getDefaultSQLParams();
                $xparams = $this->mcrud->getDefaultParams();
                $xparams = array_merge($yparams, $xparams);
                $params = array_merge($xparams, $_GET);
                $xresult = $this->mcrud->getViewDataGrid($params);
                //print_r($xresult);
                //die;
                if ($namespace===''){
                    $xns = '';
                } else {
                    $xns = $namespace.'_';
                }
                $result = array();
                $result[$xns.'crudgrid'] = $xresult['view'];
                $result[$xns.'crudpages'] = $xresult['pagination'];
                //$result['crudcommands'] = $xresult['crudcommands'];
                $result[$xns.'cmdscripts'] = $xresult['cmdscripts'];
                $result[$xns.'crudgridinfo'] = $xresult['gridinfo'];
                $result['success'] = 1;
            }
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
        }
        echo json_encode($result);
    }

    public function svexecdata($crudname, $actionname, $command=''){
//        print_r($_FILES);
        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            if ($sessData===false){
                $result = array('success'=>0, 'error'=>1, 'errorname'=>'belum_login', 'message'=>'Belum login.');
            } else {
                $this->load->model('m_crud', 'mcrud');
                $this->mcrud->loadCrudFile($crudname, $actionname);
                $username = $sessData['username'];
                $this->updateSysParamsUserInfo($username);
                if (isset($this->mcrud->crudData['cmdtype'])){
                    $cmdtype = $this->mcrud->crudData['cmdtype'];
                } else {
                    $cmdtype = 'sql';
                }
                if ($cmdtype=='sql'){
                    if ($command===''){
                        $command = 'sqlexec';
                    }
                    $result = $this->mcrud->executeData($command, $_POST, $_FILES);
                } else if ($cmdtype=='method'){
                    if ($command===''){
                        $command = 'methodexec';
                    }
                    $_POST['crud_name'] = $crudname;
                    $_POST['action_name'] = $actionname;
                    $result = $this->mcrud->executeMethod($command, $_POST, $_FILES);
                }
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
                $username = $sessData['username'];
                $this->updateSysParamsUserInfo($username);
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

    public function svlookupdata($lookupname){
        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            if ($sessData===false){
                $result = array('success'=>0, 'error'=>1, 'errorname'=>'belum_login', 'message'=>'Belum login.');
            } else {
                $this->load->model('m_crud', 'mcrud');
                $params = $_GET;
                $value = '';
                $username = $sessData['username'];
                $this->updateSysParamsUserInfo($username);
                //$ludata = $this->mcrud->getViewLookup($lookupname, $params, $value);
                $ludata=array();
                $ludata['data'] = $this->mcrud->getDataLookup($lookupname, $params);
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

    public function svfile($fileid=''){
        $this->load->model('login/m_login', 'mlogin');
        $sessData = $this->mlogin->getSessionData();
        if ($sessData===false){
            $result = array('success'=>0, 'error'=>1, 'errorname'=>'belum_login', 'message'=>'Belum login.');
        } else {
            $this->load->model('m_crud', 'mcrud');
            //$this->mcrud->namespace = $namespace;
            $username = $sessData['username'];
            $this->updateSysParamsUserInfo($username);
            $this->load->model('crud/m_file', 'mfile');
            $this->mfile->getFileByHash($fileid);
        }
    }

    public function svimage($fileid=''){
        $this->load->model('login/m_login', 'mlogin');
        $sessData = $this->mlogin->getSessionData();
        if ($sessData===false){
            $result = array('success'=>0, 'error'=>1, 'errorname'=>'belum_login', 'message'=>'Belum login.');
        } else {
            $this->load->model('m_crud', 'mcrud');
            //$this->mcrud->namespace = $namespace;
            $username = $sessData['username'];
            $this->updateSysParamsUserInfo($username);
            $default_filename = 'blank-photo';
            $this->load->model('crud/m_file', 'mfile');
            //echo $default_filename;
            $this->mfile->getFileByHash($fileid, $default_filename);
        }
    }

    public function bhoundlookup($lookupname){
        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            if ($sessData===false){
                //$result = array('success'=>0, 'error'=>1, 'errorname'=>'belum_login', 'message'=>'Belum login.');
                $result = array();
            } else {
                $this->load->model('m_crud', 'mcrud');
                $params = $_GET;
                $value = '';
                $username = $sessData['username'];
                $this->updateSysParamsUserInfo($username);
                //$ludata = $this->mcrud->getViewLookup($lookupname, $params, $value);
                $ludata=array();
                $ludata['data'] = $this->mcrud->getDataLookup($lookupname, $params, 'record');
                $ludata['lookupname'] = $lookupname;
                $ludata['success'] = 1;
                $result = $ludata['data'];
                //$result = $ludata;
                //$this->mcrud->loadCrudFile($crudname, $actionname);
                //$result = $this->mcrud->executeData($command, $_POST);
            }
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
        }
        echo json_encode($result);
    }

    public function lookup($lookupname, $params=array(), $value=''){
//        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            if ($sessData===false){
                $result = array('success'=>0, 'error'=>1, 'errorname'=>'belum_login', 'message'=>'Belum login.');
            } else {
                $this->load->model('m_crud', 'mcrud');
                //$params = $_GET;
                //$value = '';
                $username = $sessData['username'];
                $this->updateSysParamsUserInfo($username);
                $ludata = $this->mcrud->getDataLookup($lookupname, $params);
                $result = $this->mcrud->formatViewLookup($ludata, $value);
                //print_r($ludata);
                
                //$ludata['lookupname'] = $lookupname;
                //$ludata['success'] = 1;
                //$result = $ludata;
                //$this->mcrud->loadCrudFile($crudname, $actionname);
                //$result = $this->mcrud->executeData($command, $_POST);
            }
//        } catch (Exception $e) {
//            $result = $this->exceptionAsJson($e);
//        }
        //echo json_encode($result);
        return $result;
    }

    public function svcblookup($lookupname){
        try {
            $this->load->model('login/m_login', 'mlogin');
            $sessData = $this->mlogin->getSessionData();
            if ($sessData===false){
                $result = array('success'=>0, 'error'=>1, 'errorname'=>'belum_login', 'message'=>'Belum login.');
            } else {
                $this->load->model('m_crud', 'mcrud');
                $username = $sessData['username'];
                $this->updateSysParamsUserInfo($username);
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
    
    public function pengembangan(){
        $this->load->view('vpengembangan');
    }
    
    
    public function method($crudname, $actionname){
        $this->load->model('m_crud', 'mcrud');
        $this->mcrud->namespace = '';
        $sessData = $this->checkSessionData();
        if ($sessData===false){
            //echo "***";
            echo 'not login.';
            //$this->mlogin->openLoginScreen();
        } else {
            $basefolder = $this->ci->config->item('basefolder').'crud/';
            $filename = $basefolder.$crudname.'/'.$actionname.".query";
            //echo $filename;
            $this->mcrud->sessionData = $sessData;
            $username = $sessData['username'];
            $this->updateSysParamsUserInfo($username);
            if (file_exists($filename)){
                $dresult = $this->mcrud->callCommandMethod($crudname, $actionname, true);
                $result = array('success'=>1, 'message'=>'Command Executed');
                $result = array_merge($result, $dresult);

            } else {
                $result = array('success'=>0, 'message'=>'Command Not Found');
            }
            echo json_encode($result);
        }
    }

    public function testing(){
        echo "testing...";
        $test = "xxx";
        $test = $this;
        if (is_object($test)){
            echo get_class($test);
        } else {
            echo "bukan objek";
        }
    }
    
    public function getHash($param) {
        $this->load->model('m_layanan', 'mcrud');
        $ludata = $this->mcrud->edit_dispatch_hash($param);
        echo json_encode($ludata);
    }
}
?>
