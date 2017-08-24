<?php 
 session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function testing(){
        $this->load->model('m_login', 'mlogin');
        $sessData = $this->mlogin->getSessionData();
        $this->mlogin->openLoginScreen();
    }
    function index(){
        $this->load->model('m_login', 'mlogin');
        $sessData = $this->mlogin->getSessionData();
        if ($sessData===false){
            $this->mlogin->openLoginScreen();
        } else {
			//$_SESSION['username'] = $sessData["username"];
			$_SESSION['session_login'] = $sessData;
			if($_GET["return_page_to"]== "Search Engine"){
				//print_r($sessData); die();		
				//$_SESSION['session_login'] = $sessData;
				//echo $_SESSION['username']; die();
				header('Location: '.base_url()."index.php/search_engine?return_keyword_to=".$_GET["return_keyword_to"]."&return_page_to=".$_GET["return_page_to"]);		
				
			}else{		
				header('Location: '.base_url()."index.php/search_engine/doSearch?textsearch=".$_GET["return_keyword_to"]."&return_page_to=".$_GET["return_page_to"]);	
			}
        }
    
    }
    
	public function openLoginScreen(){
		
		
	}
    private function decryptdata($encrypted, $keyid){
        //$key = 
    }
    
//    public function svlogin($username, $password, $keyid){
//        $decpass = decryptdata($pasword, $keyid);
//        echo $username."-".$decpass;
//    }
        
    public function svgetkey(){
        //echo "***";
        $this->load->model('m_login', 'mlogin');
        $result = $this->mlogin->getRandomKey();
        //print_r($result);
        echo json_encode($result);
        
    }

    public function svlogin($username='', $password='', $key=0){
        // result sukses
        // {"success": 1}
        // result error
        // {"success": 0, "error": 1, "message": "Error"}
        $this->load->model('m_login', 'mlogin');
        
        try {
            $result = $this->mlogin->serviceLogin($username, $password, $key);
			//$result = $this->mlogin->serviceLogin($username, $password,95);
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
            //$result = array("success"=>0, "error"=>1, "message"=>$e->getMessage());
        }
        echo json_encode($result);
    }
    
    public function svlogout(){
        // result sukses
        // {"success": 1}
        // result error
        // {"success": 0, "error": 1, "message": "Error"}
        
        $this->load->model('m_login', 'mlogin');
        
        try {
            $this->mlogin->doLogout();
			
            $result = array("success"=>1);
        } catch (Exception $e) {
            $result = array("success"=>0, "error"=>1, "message"=>$e->getMessage());
        }
        echo json_encode($result);
    }
        
    public function svregister(){
        $this->load->model('m_login', 'mlogin');        
        try {
            $this->updateSysParams();
            $data = $this->input->post();
			$data_email= $this->mlogin->getDefaultData();
			//echo "<pre>";
			//print_r ($data_email); die();
			//echo "</pre>";
			//print_r($data)."xxxxxx"; die();
			//echo $data["email"]."<br>".$data["password"];
            $result = $this->mlogin->doRegister($data);
			$message='Terima Kasih sudah melakukan konfirmasi. Silahkan mengikuti <a href="'.
                    $data_email['mainurl']."login/saveRegBerhasil?username=".$data["email"].'& password='.$data["password"].'&pwd_key='.$data["pwd_key"].'">link ini</a> untuk masuk ke dalam sistem. '.
                    'Gunakan email dan paassword yang sudah anda isikan.';			
			$this->mlogin->doGeekSendEmail($data["email"],"Registrasi Wikitani",$message);	
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
            //$result = array("success"=>0, "error"=>1, "message"=>$e->getMessage());
        }
        echo json_encode($result);
    }
	
	public function SaveRegBerhasil(){
		$data=array(
		"email"=>$_GET["username"],
		"password"=>$_GET["password"],
		"pwd_key" =>$_GET["pwd_key"]
		);
		$this->load->model('m_login', 'mlogin');      
		$this->mlogin->SaveRegBerhasil($data);  
	}
        
    function messageKeyList(){
        $result = array();
        array_push($result, array('keyword'=>'users_unique_username',
                'message'=>'Error: Email already registered.'));
        array_push($result, array('keyword'=>'app_registration_uq_email',
                'message'=>'Error: Email already registered.'));
        
        
        
        return $result;
    }
    
    public function logout(){
        
        $this->load->model('m_login', 'mlogin');
		// remove all session variables
			session_unset(); 
			// destroy the session 
			session_destroy(); 
        $this->mlogin->doLogout();
       // $redirect = site_url().'/menu/home';
       // redirect($redirect);
		
		
		if($_GET["return_page_to"]== "Search Engine"){
				//print_r($sessData); die();		
				//$_SESSION['session_login'] = $sessData;
				//echo $_SESSION['username']; die();
				header('Location: '.base_url()."index.php/search_engine?return_keyword_to=".$_GET["return_keyword_to"]."&return_page_to=".$_GET["return_page_to"]);		
				
			}else{		
				header('Location: '.base_url()."index.php/search_engine/doSearch?textsearch=".$_GET["return_keyword_to"]."&return_page_to=".$_GET["return_page_to"]);	
			}
        
    }
    
    
    public function register(){
        $this->load->model('m_login', 'mlogin');
        $sessData = $this->mlogin->getSessionData();
        //if ($sessData===false){
        $this->mlogin->openRegisterScreen();
        
//        $this->load->model('m_login', 'mlogin');
//        $data = $this->mlogin->getDefaultData();
//        $data['country'] = $this->formatSelectCountry(['ID', 'BE']);
//        $this->load->view('login/vregister', $data);

    }

    function updateSysParams(){
        $appconfig = $this->ci->config->item('appconfig');
        $hashkey = $appconfig['hash-key'];
        $sys_info = array();
        $sys_info['sys_hashkey'] = $hashkey;
        $this->mdb->mergeDefParams($sys_info);
    }
    
    function test_email(){
        $this->load->model('m_login', 'mlogin');
        $data['email'] = 'rekysenjaya@gmail.com';
        $data['full_name'] = 'rekysenjaya@gmail.com';
        $data['layananidhash'] = '1234567890';
        $this->mlogin->doSendEmail($data);
    }

    public function send_replay_conf() {
        $this->load->model('m_login', 'mlogin');
        try {
            $data = $this->mlogin->getDefaultData();
        } catch (Exception $exc) {
            
        }
        $this->load->view('vsendconfirmationreplay', $data);
    }

    function sendReplay() {
        $this->load->model('m_login', 'mlogin');
        try {
            $post = $this->input->post('email');
            $sql = "select * from sys_users where username = :email";
            $result = $this->mdb->QueryData('application', $sql, array('email' => $post), 'record');
            $sql2 = "select a.key from app_key_konfirmasi a left join app_registration b on b.id=a.regid where b.email = :email";
            $result2 = $this->mdb->QueryData('application', $sql2, array('email' => $post), 'record');
            if (isset($result[0]) or isset($result2[0])) {
                $sql3 = "select a.key from app_key_konfirmasi a left join app_registration b on b.id=a.regid where a.status = 0 and b.email = :email";
                $result3 = $this->mdb->QueryData('application', $sql3, array('email' => $post), 'record');
                if (isset($result3[0]['key'])) {
                    $result = $this->mlogin->replaysend($result2[0]['key']);
                }  else {
                    $result = array("success"=>0, "error"=>1, "message"=>'Anda sudah konfirmasi');
                }
            } else {
                $result = array("success"=>0, "error"=>1, "message"=>'Email yang anda masukkan tidak terdaftar.');
            }
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
            //$result = array("success"=>0, "error"=>1, "message"=>$e->getMessage());
        }
        echo json_encode($result);
    }
    
    function send_confirmation($hashid=''){
        $this->load->model('m_login', 'mlogin');
        try {
            $sql = "select * from app_key_konfirmasi a left join app_registration b on b.id=a.regid where a.key = :hashid";
            $qres = $this->mdb->QueryData('application', $sql, array('hashid'=>$hashid), 'record');
            if (isset($qres[0])){
                $xdata = $qres[0];
                $xdata['email'] = $xdata['email'];
                $xdata['full_name'] = $xdata['full_name'];
                $this->mlogin->doSendEmail($xdata);
                 				
                $message = 'Email sudah dikirimkan. Silahkan buka email anda, bisa jadi ada di folder spam email dan ikuti petunjuknya.';
            } else {
                $message = 'Kode registrasi salah.';
            }
        } catch (Exception $ex){
            $message = $ex->getMessage();
            $message = $this->softenMessage($message);
        }
        $data = $this->mlogin->getDefaultData();
        $data['message'] = $message;
        $this->load->view('vmessage', $data);
    }
    
    function expired_confirmation($hashid=''){
        $param = array('hashid'=>$hashid);
        $this->load->model('m_login', 'mlogin');
        try {
            $this->updateSysParams();
            $sql = "select 0;
                    insert into app_key_konfirmasi(key, expired, regid, status) values 
                    (md5(:sys_hashkey || 'confirmation' || cast(currval('app_key_konfirmasi_id_seq') as character varying)), (select now()+'1 month'),  
                    (select regid from app_key_konfirmasi where key = :hashid), 0);
                    
                    select * from app_key_konfirmasi a left join app_registration b on b.id=a.regid where a.id = currval('app_key_konfirmasi_id_seq');";
            $qres = $this->mdb->QueryData('application', $sql, $param, 'record');
            if (isset($qres[0])){
                $xdata = $qres[0];
                $xdata['email'] = $xdata['email'];
                $xdata['full_name'] = $xdata['full_name'];
                $this->mlogin->doSendEmailexpired($xdata);
                $message = 'Konfirmasi ulang sudah dikirim ke Email. Silahkan buka email anda dan ikuti petunjuknya.';
            } else {
                $message = 'Kode registrasi salah.';
            }
        } catch (Exception $ex){
            $message = $ex->getMessage();
            $message = $this->softenMessage($message);
        }
        $data = $this->mlogin->getDefaultData();
        $data['message'] = $message;
        $this->load->view('vmessage', $data);
    }
    
    function confirmation($regid=''){
        $this->load->model('m_login', 'mlogin');
        $data = $this->mlogin->getDefaultData();
        $this->updateSysParams();
        try {
            $success = $this->mlogin->doConfirmation($regid);
            $redirect = $data['mainurl'].'confirmed';
            if ($success==='success') {
                redirect($redirect);
            }  else {
                $redirect2 = $data['mainurl'].'login/send_email/'.$regid;
                redirect($redirect2);
                
            }
        } catch (Exception $ex){
            $message = $ex->getMessage();
            $data['message'] = $this->softenMessage($message);
            $this->load->view('vmessage', $data);
        }
    }
    
    function confirmed(){
        $this->load->model('m_login', 'mlogin');
        $data = $this->mlogin->getDefaultData();
        try {
            $data['message'] = 'Terima Kasih sudah melakukan konfirmasi. Silahkan mengikuti <a href="'.
                    $data['mainurl'].'">link ini</a> untuk masuk ke dalam sistem. '.
                    'Gunakan email dan paassword yang sudah anda isikan.';
            $this->mlogin->doLogout();
            $this->load->view('vmessage', $data);
        } catch (Exception $ex){
            $message = $ex->getMessage();
            $data['message'] = $this->softenMessage($message);
            $this->load->view('vmessage', $data);
        }
    }
    
    function send_email($key){
        $this->load->model('m_login', 'mlogin');
        $data = $this->mlogin->getDefaultData();
        try {
            $data['message'] = 'Konfirmasi anda sudah Expired. Silahkan mengikuti <a href="'.
                    $data['mainurl'].'login/expired_confirmation/'.$key.'">link ini</a> untuk kirim ulang konfirmasi. '.
                    'Silakan anda membuka Email anda kembali untuk konfirmasi ulang.';
            $this->mlogin->doLogout();
            $this->load->view('vmessage', $data);
        } catch (Exception $ex){
            $message = $ex->getMessage();
            $data['message'] = $this->softenMessage($message);
            $this->load->view('vmessage', $data);
        }
    }
    
    function inputEmail($param) {
        $this->load->model('m_login', 'mlogin');
        $data = $this->mlogin->getDefaultData();
        $data['emailKey'] = $param;
        $data['emailCek'] = $this->mlogin->cekEmailKey($param);
        $this->load->view('vemail',$data);
    }
    
    public function sendEmail() {
        $hashid = $this->input->post('key');
        $email = $this->input->post('email');
        $this->load->model('m_login', 'mlogin');
        try {
            $sql1 = "select * from app_registration where email = :email";
            $qres1 = $this->mdb->QueryData('application', $sql1, array('email'=>$email), 'record');
                if (isset($qres1[0])){
                $sql = "select * from app_key_konfirmasi a left join app_registration b on b.id=a.regid where a.key = :hashid";
                $qres = $this->mdb->QueryData('application', $sql, array('hashid'=>$hashid), 'record');
                if (isset($qres[0])){
                    $xdata = $qres[0];
                    $xdata['email'] = $xdata['email'];
                    $xdata['full_name'] = $xdata['full_name'];
                    $this->mlogin->doSendEmail($xdata);
                    $message = 'Email sudah dikirimkan. Silahkan buka email anda, bisa jadi ada di folder spam email dan ikuti petunjuknya.';
                } else {
                    $message = 'Kode registrasi salah.';
                }
            }  else {
                $message = 'Email Anda salah.';
            }
        } catch (Exception $ex){
            $message = $ex->getMessage();
            $message = $this->softenMessage($message);
        }
        $data = $this->mlogin->getDefaultData();
        $data['message'] = $message;
        $this->load->view('vmessage', $data);
    }
    
    public function emailInput() {
        $this->load->model('m_login', 'mlogin');
        $data = $this->mlogin->getDefaultData();
        $this->load->view('vemailpassword', $data);
    }


    public function emailPassword() {
        $email = $this->input->post('email');
        $this->load->model('m_login', 'mlogin');
        try {
            $sql = "select * from sys_users  where username = :email";
            $qres = $this->mdb->QueryData('application', $sql, array('email'=>$email), 'record');
            if (isset($qres[0])){
                $this->updateSysParams();
                $sql1 = "
                        select 0;
                        insert into app_key_pass(key, userid) values (md5(:sys_hashkey || 'confirmation' || cast(currval('app_key_pass_id_seq') as character varying)), (select userid from sys_users  where username = :email));
                        select md5(:sys_hashkey || 'confirmation' || cast(currval('app_key_pass_id_seq') as character varying)) as key";
                $qres1 = $this->mdb->QueryData('application', $sql1, array('email'=>$email), 'record');
                $xdata = $qres[0];
                $xdata['email'] = $xdata['username'];
                $xdata['full_name'] = $xdata['fullname'];
                $xdata['key'] = $qres1[0]['key'];
                $this->mlogin->doSendEmailPassword($xdata);
                $message = 'Email sudah dikirimkan. Silahkan buka email anda, bisa jadi ada di folder spam email dan ikuti petunjuknya.';
            }  else {
                $message = 'Email yang anda masukan tidak terdaftar.';
            }
        } catch (Exception $ex){
            $message = $ex->getMessage();
            $message = $this->softenMessage($message);
        }
        $data = $this->mlogin->getDefaultData();
        $idx = rand(0, 99);
        $data['country'] = $this->mlogin->formatSelectCountry(['ID', 'BE']);
        $data['kode_data'] = $idx;
        $data['key_data'] = $this->mlogin->keys[$idx];
        $data['message'] = $message;
        $this->load->view('vmessage', $data);
    }
    
    public function InputPassword($param) {
        $this->load->model('m_login', 'mlogin');
        try {
            $data = $this->mlogin->getDefaultData();
            $idx = rand(0, 99);
            $data['country'] = $this->mlogin->formatSelectCountry(['ID', 'BE']);
            $data['kode_data'] = $idx;
            $data['key_data'] = $this->mlogin->keys[$idx];
            $sql = "select a.* from sys_users a left join app_key_pass b on b.userid=a.userid where b.key = :pass";
            $qres = $this->mdb->QueryData('application', $sql, array('pass'=>$param), 'record');
            if (isset($qres[0])) {
                $data['passwordcek'] = 'ada';
            }else{
                $data['passwordcek'] = NULL;
            }
        } catch (Exception $exc) {
            $data['country'] = '';
            $data['kode_data'] = '';
            $data['key_data']='';
            $data['passwordcek'] = NULL;
        }
        $data['key'] = $param;
        $this->load->view('vpassword', $data);
    }
    
    public function spasswordNew() {
        $this->load->model('m_login', 'mlogin');
        try {
            $this->updateSysParams();
            $data = $this->input->post();
            $result = $this->mlogin->doNewPassword($data);
        } catch (Exception $e) {
            $result = $this->exceptionAsJson($e);
        }
        echo json_encode($result);
    }

    public function perjanjian_pengguna() {
        $this->load->model('m_login', 'mlogin');
        try {
            $data = $this->mlogin->getDefaultData();
        } catch (Exception $exc) {
            
        }
        $this->load->view('vperjanjian_pengguna', $data);
    }
}



?>
