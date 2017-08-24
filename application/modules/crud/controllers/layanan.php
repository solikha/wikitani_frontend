<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Layanan extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
    
	public function test($lyn_id){
	echo "test ok";
	}
    function edit_layanan(){
        $this->load->model('m_layanan', 'mlayanan');
        $lyn_id = getArrayDef($_GET, 'lyn_id');
        $menu = $this->mlayanan->edit_dispatch_hash($lyn_id);
        redirect('menu/'.$menu['redirect']);        
    }
    
    // edit layanan user
    function show_layanan(){
        $this->load->model('m_layanan', 'mlayanan');
        $lyn_id = getArrayDef($_GET, 'lyn_id');
        //$menu = $this->mlayanan->edit_dispatch_user_hash($lyn_id);
        $menu = $this->mlayanan->edit_dispatch(array('lyn_id'=>$lyn_id));
        redirect($menu['redirect']);        
    }
    
    function jenis_layanan($param) {
        $this->load->model('m_layanan', 'mlayanan');
        $menu = $this->mlayanan->jenis_layanan($param)[0];
        echo json_encode($menu);
    }
    
    function pembayaran() {
        $var = $this->input->get();
        echo '<title>Print</title>';
        echo json_encode($var);
    }
    
    function getfoto($lyn_id=''){
	//echo 1;
	//die();
        $this->load->model('crud/m_layanan', 'mlayanan');
        $result = $this->mlayanan->getfoto($lyn_id);
        //print_r($result);
        header("Content-Type: ".$result['type']);            
        header("Content-Disposition: inline; ".'filename="'.$result['name'].'"');
        echo file_get_contents($result['filename']);
    }
    
    function test_mrz(){
        $this->load->model('crud/m_layanan', 'mlayanan');
        $this->mlayanan->test_mrz();
    }
    
    function test_method($module, $model, $method){
        $params = $_GET;
        $this->load->model($module.'/'.$model, 'mtest');
        $this->mtest->$method($params);
    }
    
    function update_sys_menu($kode){
        $this->load->model('crud/m_layanan', 'mlayanan');
        $this->mlayanan->update_sys_menu($kode);
    }
    
    function getDataApl() {
        $datakbri = $this->ci->config->item('kbri');
        echo json_encode($datakbri);
    }
    
    function isAdmin(){
        $sql = "select userid, username, password, isadmin from sys_users where username = :sys_username";
        $result = $this->mdb->QueryData('application', $sql, array(), 'record');
        if (isset($result[0]['isadmin'])){
            return $result[0]['isadmin'];
        } else {
            return 0;
        }        
    }
    
    function kembali(){
        $sessData = $this->checkSessionData();
        if ($sessData===false){
            echo Modules::run('login');
        } else {
            $username = $sessData['username'];
            $this->updateSysParamsUserInfo($username);
            if ($this->isAdmin()){
                 redirect('menu/layanan');
            } else {
                 redirect('menu/layanan_wni');
            }
        }            
             
        
        // $this->load->model('m_layanan', 'mlayanan');
        // $lyn_id = getArrayDef($_GET, 'lyn_id');
        // $menu = $this->mlayanan->edit_dispatch_hash($lyn_id);
        // redirect('menu/'.$menu['redirect']);        
    }
    
    function cek_cekal($lyn_id=''){
        $sessData = $this->checkSessionData();
        if ($sessData===false){
            echo Modules::run('login');
        } else {
            $username = $sessData['username'];
            $this->updateSysParamsUserInfo($username);
            $this->load->model('m_layanan', 'mlayanan');
            $lyn_id = getArrayDef($_GET, 'lyn_id');
            $result = $this->mlayanan->dispatch_cek_cekal($lyn_id, $this->isAdmin());
        }            
             
        redirect('menu/'.$result);   
        
        // $this->load->model('m_layanan', 'mlayanan');
        // $lyn_id = getArrayDef($_GET, 'lyn_id');
        // $menu = $this->mlayanan->edit_dispatch_hash($lyn_id);
        // redirect('menu/'.$menu['redirect']);        
    }
        
    function sendEmailSiapProses(){
        $this->load->model('m_layanan', 'mlayanan');
		$delay = 5;
		$count = ceil(60 / $delay);
        ob_start();
        echo "start...\r\n";
        ob_end_flush();
        flush();
        ob_flush();
		for ($i=0; $i<$count; $i++){
			$data = $this->mlayanan->sendEmailSiapProses();
			echo json_encode($data);
            echo "\r\n";
            flush();
            ob_flush();        
			sleep($delay);
		}
    }

    function checkBungkusEmail(){
        $this->load->view('email/vshell');
    }
    function checkHasilEmail($id){
        $sql = "select data from app_email where id = :id";
        $params = array('id'=>$id);
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qres[0]['data'])){
            echo $qres[0]['data'];
        } 
    }
    
    
}