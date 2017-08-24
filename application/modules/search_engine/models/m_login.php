<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
//define('GLOBAL_CODE', 'MANGGU2014');
////umur session: 15 menit = 900 detik
//define('UMUR_SESSIONID', 9000);
//// nama session
//define('NAMA_SESSION', 'dapurpulsa-sessionid');
//// umur session
//define('NAMA_UMUR_SESSION', 'dapurpulsa-sessionexpired');

class RegValidation extends MgValidation {
    public function validationFindWniEmail($data, $name) {
        return true;
    }

}

class M_login extends MY_Model
{
    var $keys;
    var $SysConfig;
    var $validation_msg=array();
    public function __construct()
    {
        parent::__construct();
        $this->prepareKey();
        $this->SysConfig = $this->ci->config->item('sysconfig');
        $this->load->helper('language');
        $this->lang->load('user_validation');
        
    }
    
    public function openLoginScreen(){
        $data = $this->getDefaultData();
        $idx = rand(0, 99);
        $data['kode_data'] = $idx;
        $data['key_data'] = $this->keys[$idx];
//        print_r($this->ci->config->item('appconfig'));
//        die;
        $this->load->view('search_engine/vlogin', $data);
        
    }
    
    public function formatSelectCountry($firstCountry){
        $listCountry = $this->getCountry($firstCountry);
        $result = $this->formatSelect($listCountry, 'code', 'name', '', 'Pilih Negara');
        return $result;
    }
    
    public function openRegisterScreen(){
        //echo "test";
        $data = $this->getDefaultData();
        $idx = rand(0, 99);
        $data['country'] = $this->formatSelectCountry(['ID', 'BE']);
        $data['kode_data'] = $idx;
        $data['key_data'] = $this->keys[$idx];
        $this->load->view('login/vregister', $data);
        
    }
    
    function getRandomKey(){
        $idx = rand(0, 99);
        $result = array('indeks'=>$idx, 'kunci' => $this->keys[$idx]);
        return $result;
    }
    
    function prepareKey(){
        $vx=array();
        $vx[0] = '17283'; $vx[1] = '33480'; $vx[2] = '42503'; $vx[3] = '17676'; $vx[4] = '88947'; 
        $vx[5] = '87961'; $vx[6] = '91578'; $vx[7] = '85077'; $vx[8] = '61295'; $vx[9] = '26954'; 
        $vx[10] = '62432'; $vx[11] = '86209'; $vx[12] = '10263'; $vx[13] = '27646'; $vx[14] = '98500'; 
        $vx[15] = '85758'; $vx[16] = '56790'; $vx[17] = '42225'; $vx[18] = '28220'; $vx[19] = '13414'; 
        $vx[20] = '96813'; $vx[21] = '67878'; $vx[22] = '85031'; $vx[23] = '23861'; $vx[24] = '71270'; 
        $vx[25] = '56793'; $vx[26] = '97368'; $vx[27] = '46790'; $vx[28] = '56098'; $vx[29] = '96157'; 
        $vx[30] = '28671'; $vx[31] = '56886'; $vx[32] = '82235'; $vx[33] = '48158'; $vx[34] = '67376'; 
        $vx[35] = '73838'; $vx[36] = '45617'; $vx[37] = '89983'; $vx[38] = '86920'; $vx[39] = '72333'; 
        $vx[40] = '67183'; $vx[41] = '83819'; $vx[42] = '95742'; $vx[43] = '72059'; $vx[44] = '42871'; 
        $vx[45] = '26855'; $vx[46] = '57279'; $vx[47] = '47702'; $vx[48] = '93616'; $vx[49] = '51278'; 
        $vx[50] = '69968'; $vx[51] = '18951'; $vx[52] = '25358'; $vx[53] = '64275'; $vx[54] = '97247'; 
        $vx[55] = '50492'; $vx[56] = '49034'; $vx[57] = '18033'; $vx[58] = '57554'; $vx[59] = '72015'; 
        $vx[60] = '60581'; $vx[61] = '89741'; $vx[62] = '94325'; $vx[63] = '58205'; $vx[64] = '90936'; 
        $vx[65] = '51585'; $vx[66] = '35999'; $vx[67] = '28750'; $vx[68] = '36037'; $vx[69] = '80754'; 
        $vx[70] = '26012'; $vx[71] = '48339'; $vx[72] = '16822'; $vx[73] = '39435'; $vx[74] = '72803'; 
        $vx[75] = '46658'; $vx[76] = '19228'; $vx[77] = '14814'; $vx[78] = '49808'; $vx[79] = '88395'; 
        $vx[80] = '74193'; $vx[81] = '49081'; $vx[82] = '55466'; $vx[83] = '13238'; $vx[84] = '77653'; 
        $vx[85] = '49421'; $vx[86] = '53214'; $vx[87] = '65873'; $vx[88] = '60548'; $vx[89] = '58023'; 
        $vx[90] = '51489'; $vx[91] = '85989'; $vx[92] = '98813'; $vx[93] = '72075'; $vx[94] = '13729'; 
        $vx[95] = '48273'; $vx[96] = '43387'; $vx[97] = '43763'; $vx[98] = '38372'; $vx[99] = '62413'; 
        $this->keys = $vx;
    }
    
    function rc4($key, $str) {
            $s = array();
            for ($i = 0; $i < 256; $i++) {
                    $s[$i] = $i;
            }
            $j = 0;
            for ($i = 0; $i < 256; $i++) {
                    $j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
                    $x = $s[$i];
                    $s[$i] = $s[$j];
                    $s[$j] = $x;
            }
            $i = 0;
            $j = 0;
            $res = '';
            for ($y = 0; $y < strlen($str); $y++) {
                    $i = ($i + 1) % 256;
                    $j = ($j + $s[$i]) % 256;
                    $x = $s[$i];
                    $s[$i] = $s[$j];
                    $s[$j] = $x;
                    $res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
            }
            return $res;
    }    
    
    function hexToStr($hex){
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2){
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }
    
    function strToHex($string){
        $hex='';
        for ($i=0; $i < strlen($string); $i++){
            $hex .= str_pad(dechex(ord($string[$i])), 2, '0', STR_PAD_LEFT);
        }
        return $hex;
    }    

    public function checkPassword($username, $password){
        if (($username==='') or ($password==='')){
            return false;
        }
        $sql = 'select userid, username, password, enctype 
            from sys_users 
            where username = :username and active=1
              and ((isadmin = 1) or (isemailverified=1))
        ';
        $params = array('username'=>$username);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        //print_r($result);
        if (isset($result[0]['password'])){
            $vcode = $this->SysConfig['enccode'];
            if ($result[0]['enctype']==1) {
                $decpass = $this->rc4($vcode, $this->hexToStr($result[0]['password']));
            } else if ($result[0]['enctype']==2) {
            } else {
                return false;
            }
            //echo $decpass."*".$password;
            if ($decpass == $password){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
        
    function createSession($username){
        //echo "Testing";
        //die;
        $vsql = "select nextval('session_counter_seq') as sessionid";
        $vparams = array();
        $result = $this->mdb->QueryData('system', $vsql, $vparams, 'record');
        //$this->mdb->QueryData()
        if (isset($result[0]['sessionid'])){
            $sqid = $result[0]['sessionid'];
        } else {
            //print_r($result);
            throw new Exception('tidak bisa meng-create session');
        }
        //$sqid = $this->GetSingleValueSQL('system', $vsql, $vparams);
        $vcode = $this->SysConfig['enccode'];
        $vumurses = $this->SysConfig['umursession'];
        $namases = $this->SysConfig['namasession'];

        $sessioncode = md5($vcode.$sqid);
        //echo $sessioncode;
        $ses_expired = date('Y-m-d H:i:s', time()+$vumurses);
        
        $vsql = "insert into sys_session(sessioncode, username, sessionexpired)
            values(:sessioncode, :username, :sessionexpired)";
        $vsqlparams = array('sessioncode'=>$sessioncode, 'username'=>$username, 
            'sessionexpired'=>$ses_expired);
        //print_r($vsqlparams);
        $this->mdb->ExecSQL('system', $vsql, $vsqlparams);
        
        $appfolder = $this->ci->config->item('mainfolder');
        //$appfolder='dplabs/';
        $cookie = array(
            'name'=>$namases,
            'value'=>$sessioncode,
            'expire' => '0',
            'path'   => '/'.$appfolder,
            'secure' => FALSE
        );
        //print_r($cookie);
        $this->input->set_cookie($cookie);
        //setcookie(NAMA_SESSION, $sessioncode);
        //setcookie(NAMA_UMUR_SESSION, $ses_expired);
        
        //setcookie('testing', 'Percobaan', time()+UMUR_SESSIONID);
        
        /*setcookie('testing1', 'Percobaan A');
        setcookie('testing2', 'Percobaan B');
        //  setcookie('testing3', 'Percobaan C');
         * 
         */
    }
        
    function decryptSentPasswd($password, $key){
        $xcfg_key = getArrayDef($this->SysConfig, 'no_enc_key', 0);
        if ((($key>=0) and ($key<=99)) or ($key==$xcfg_key)){
            if ($key <= 99){
                $xkey = $this->keys[$key];
                $xpass = $this->rc4($xkey, $this->hexToStr($password));
            } else {
                $xpass = $password;
            }
            return $xpass;
        } else {
            return false;
        }
    }
    
    function serviceLogin($username='', $password='', $key=0){
        $username = urldecode($username);
        //echo $username;
        $xpass = $this->decryptSentPasswd($password, $key);
        if ($xpass!==false){
            //print_r($this->keys);
            if($this->checkPassword($username, $xpass)){
                $this->createSession($username);
                $result = array("success"=>1);
            } else {
                $result = array("success"=>0, "error"=>1, "message"=>"User Name atau Password salah.");
            }
        } else {
            $result = array("success"=>0, "error"=>1, "message"=>"User Name atau Password salah..");
        }
        return $result;
    }
    
    public function getSessionData(){
        $namases = $this->SysConfig['namasession'];
        $vsession = $this->input->cookie($namases);
        $vsql = "select * from sys_session where sessioncode = cast(:sessionid as character varying) and sessionexpired > now()";
        $vparams = array('sessionid'=>$vsession);
        $res = $this->mdb->QueryData('application', $vsql, $vparams, 'array');
        foreach($res as $row){
            return $row;
            //print_r($res);
        }
        return false;
    }

    function doLogout(){
        $namases = $this->SysConfig['namasession'];
        $vsession = $this->input->cookie($namases);
        if ($vsession){
            //$vsession = $this->getCookiesName(NAMA_SESSION);
//            echo "....";
//            print_r($namases);
//            echo "---";
//            print_r($vsession);
//            echo "===";
            $vsql = "delete from sys_session where sessioncode = :sessionid";
            $vparams = array('sessionid'=>$vsession);
            $res = $this->mdb->ExecSQL('application', $vsql, $vparams, 'array');
        }
        return false;
    }
    
    function replaysend($param) {
        return array('success' => true, 'message' => 'Successful Registration', 'redirect' => $this->getMainUrl() . 'send_confirmation/' . $param);
    }
    
    function doRegister($data=array()){
        $cresult = $this->checkRegData($data);
        $cek = $this->cekEmail($data);
        if ($cresult['success'] && $cek=='tidak'){
            $result = $this->saveRegistration($data);
            return array('success'=>true, 'message'=>'Successful Registration',
                'redirect'=>$this->getMainUrl().'send_confirmation/'.$result['hashid']);
        }  elseif ($cek=='ada') {
            return array('success'=>FALSE, 'message'=>'Email Sudah Terdaftar'
                );
        } else {
            return $cresult;
        }
    }
    
    function checkRegData($data){
        $validations = array();
        $validations['full_name'] = array('category' => 'data_pemohon', 'validations' => array('validationBlank'));
        $validations['email'] = array('category' => 'data_pemohon', 'validations' => array('validationBlank', 'validationEmail', 'validationFindWniEmail'));
        $validations['birth_city'] = array('category' => 'data_pemohon', 'validations' => array('validationBlank'));
        $validations['birth_date'] = array('category' => 'data_pemohon', 'validations' => array('validationBlank', 'validationDate'));
        $validations['birth_country'] = array('category' => 'data_pemohon', 'validations' => array('validationBlank'));
        $validations['jenkelid'] = array('category' => 'data_pemohon', 'validations' => array('validationBlank'));
        $validations['password'] = array('category' => 'data_pemohon', 'validations' => array('validationBlank'));
        $validations['k_password'] = array('category' => 'data_pemohon', 'validations' => array('validationBlank', 'validationCekPassword'));
        $validations['accept'] = array('category' => 'data_pemohon', 'validations' => array('validationBlank'));

        $valobj = new RegValidation($validations, $this->lang);
        $xresult = $valobj->checkValidationByList($data);
        //$xresult = $this->checkValidationByList($validations, $data);
        if (!$xresult){
            //echo "error";
            return array('success'=>false, 'message'=>$valobj->getValidationMsg());
        } else {
            //echo "ok";
            return array('success'=>true, 'message'=>'');
        }
    }
    
    function cekEmail($params) {
        $sql = "select * from sys_users where username = :email";
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        $sql2 = "select * from app_registration where email = :email";
        $result2 = $this->mdb->QueryData('application', $sql2, $params, 'record');
        if (isset($result[0]) or isset($result2[0])) {
            $lyndata = 'ada';
        } else {
            $lyndata = 'tidak';
        }
        return $lyndata;
    }
    
    function cekEmailKey($param) {
        $sql = "select * from app_key_konfirmasi where key = :key";
        $params = array('key'=>$param);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result[0])) {
            $lyndata = 'ada';
        } else {
            $lyndata = 'tidak';
        }
        return $lyndata;
    }
    
    function doConfirmation($idhash){
        $sql1 = "select * from app_key_konfirmasi where key=:lyn_id and now() < expired and status=0";
        $params1 = array('lyn_id'=>$idhash);
        $result1 = $this->mdb->QueryData('application', $sql1, $params1, 'record');
        if (isset($result1[0]['key'])){
            $sql = "select b.*, a.key, a.regid from app_key_konfirmasi a left join app_registration b on b.id=a.regid where a.key = :lyn_id";
            $params = array('lyn_id'=>$result1[0]['key']);
            $result = $this->mdb->QueryData('application', $sql, $params, 'record');
            if (isset($result[0]['email'])){
                $dec = $this->decryptSentPasswd($result[0]['password'], $result[0]['pwd_key']);
                $vcode = $this->SysConfig['enccode'];
                $result[0]['enc_password'] = $this->strToHex($this->rc4($vcode, $dec));
                $sql = "
                    select 0;
                    insert into sys_users(username, password, active, fullname, enctype, 
                    isadmin, isemailverified, isverified)
                    values(:email, :enc_password, 1, :full_name, 1, 0, 1, 0);
                    
                    insert into sys_userroles(userid, roleid)
                    select currval('sys_users_userid_seq') as userid, roleid
                    from sys_roles where rolename = 'user';
                    
                    insert into wni_layanan(regid, layananid, sublayananid, username, taskname, statusname)
                    values (:regid, 8, 99, :email, 'attachment', 'proses');
                    
                    update wni_layanan set layananidhash = md5(:sys_hashkey||cast(currval('wni_layanan_id_seq') as character varying))
                    where id = currval('wni_layanan_id_seq');
                    
                    update app_key_konfirmasi set status=1 where key=:key;
                    select :key as key;
                ";
                $this->mdb->QueryData('application', $sql, $result[0]);
                $hasil = 'success';
            } else {
                throw new Exception('Link yang dimasukkan tidak valid.');
            }
        }else{
            $hasil = 'faild';
        }
        return $hasil;
    }
    
    ///===========



    public function getUserInfo($username){
        $vsql = "
            SELECT a.userid, a.username, a.fullname, r.rolename
            FROM sys_users a 
                LEFT JOIN sys_userroles ur ON a.userid = ur.userid
                LEFT JOIN sys_roles r ON r.roleid = ur.roleid
            WHERE a.username = :username";
        $vparams = array('username'=>$username);
        $res = $this->mdb->QueryData('application', $vsql, $vparams, 'record');
        if (isset($res[0])){
            return $res[0];
        }
        return false;
    }
    
    function changePassword($params){
        if (isset($params['username']) and isset($params['currentpassword'])
            and isset($params['newpassword']) and isset($params['confirmpassword'])){
            $vcheck = $this->checkPassword($params['username'], $params['currentpassword']);
            if ($vcheck!==false){
                if ($params['newpassword'] !== $params['confirmpassword'] ) {
                    throw new MgException('Password baru dan konfirmasi password tidak sama.');
                } else {
                    // tipe enkripsi (sementara) adalah 1
                    $newpassword = $params['newpassword'];
                    $vcode = $this->SysConfig['enccode'];
                    $encpass = $this->strToHex($this->rc4($vcode, $newpassword));
                    $vsql = "update sys_users set enctype = 1, password = :password where username = :username";
                    $vparams = array('username'=>$params['username'], 'password'=>$encpass);
                    $res = $this->mdb->ExecSQL('application', $vsql, $vparams, 'array');
                    $result = array('success'=>1, 'message'=>'Password sudah diset.');
                    return $result;
                }
            } else {
                throw new MgException('Password lama salah.');
            }
        } else {
            throw new MgException('Parameter change password tidak lengkap.');
        }
        //print_r($params);
        //throw new Exception('Change Password!');
    }
    
    private function findByAttr($arr, $attr, $val){
        foreach($arr as $idx=>$item){
            if ($item[$attr]==$val){
                return $idx;
            }
        }
    }
    public function getCountry($firstCountry){
        $filename = $this->ci->config->item('basefolder').'json/countries.json';
        $json_data = file_get_contents($filename);
        $json = json_decode($json_data, true);
        $result = array();
        foreach($firstCountry as $code){
            $idx = $this->findByAttr($json, 'code', $code);
            array_push($result, $json[$idx]);
        }
        foreach($json as $item){
            if (!in_array($item['code'], $firstCountry)){
                array_push($result, $item);
            }
        }
        return $result;
    }
    public function formatSelect($list, $id_attr, $display_attr, $blank, $blank_caption){
        $result = '<option value="'.$blank.'">'.$blank_caption.'</option>';
        
        foreach($list as $item){
            $result = $result."\r\n".
                '<option value="'.$item[$id_attr].'">'.$item[$display_attr].'</option>';
        }
        return $result;
    }
    
    function doNewPassword($data=array()){
        $cresult = $this->checkPass($data);
        if ($cresult['success']){
            $this->saveNewPassword($data);
            return array('success'=>true, 'message'=>'Successful Registration', 'redirect'=>$this->getMainUrl());
        } else {
            return $cresult;
        }
    }
    
    public function saveNewPassword($data) {
        $dec = $this->decryptSentPasswd($data['password'], $data['pwd_key']);
        $vcode = $this->SysConfig['enccode'];
        $data['enc_password'] = $this->strToHex($this->rc4($vcode, $dec));
        $sql = "
            select 0;
            UPDATE sys_users SET password=:enc_password WHERE username = (select username from sys_users a LEFT JOIN app_key_pass b ON b.userid = a.userid WHERE b.key = :key);
            select a.username from sys_users a LEFT JOIN app_key_pass b ON b.userid = a.userid WHERE b.key = :key;
            ";
        $result = $this->mdb->QueryData('application', $sql, $data, 'record');
        return $result[0];
    }
    
    function checkPass($data){
        $validations = array();
        $validations['password'] = array('category' => 'data_pemohon', 'validations' => array('validationBlank'));
        $validations['k_password'] = array('category' => 'data_pemohon', 'validations' => array('validationBlank', 'validationCekPassword'));
        $valobj = new RegValidation($validations, $this->lang);
        $xresult = $valobj->checkValidationByList($data);
        if (!$xresult){
            return array('success'=>false, 'message'=>$valobj->getValidationMsg());
        } else {
            return array('success'=>true, 'message'=>'');
        }
    }
    
    public function SaveRegBerhasil($data) {
        $dec = $this->decryptSentPasswd($data['password'], $data['pwd_key']);
        $vcode = $this->SysConfig['enccode'];
        $data['enc_password'] = $this->strToHex($this->rc4($vcode, $dec));
        $sql = "
            select 0;
            insert into sys_users(username, password, active, fullname, enctype, 
            isadmin, isemailverified, isverified)
            values(:email, :enc_password, 1, :full_name, 1, 0, 0, 0)
            ;
            insert into sys_userroles(userid, roleid)
            select currval('sys_users_userid_seq') as userid, roleid
            from sys_roles where rolename = 'user'
            ;
            insert into wni_layanan(regid, layananid, sublayananid, username, taskname, 
            statusname)
            values (currval('app_registration_id_seq'), 8, 99, :email, 'attachment', 'proses')
            ;
            update wni_layanan set layananidhash = md5(:sys_hashkey||cast(currval('wni_layanan_id_seq') as character varying))
            where id = currval('wni_layanan_id_seq')
            ;
            select md5(:sys_hashkey||cast(currval('wni_layanan_id_seq') as character varying)) as hashid;
            ";
        $result = $this->mdb->QueryData('application', $sql, $data, 'record');
        return $result[0];
    }
    
    
    public function saveRegistration($data){
        $d = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 month" ) );
        $sql = "
            select 0;
            insert into app_registration(email, full_name, jenkelid, birth_city, birth_country, birth_date, password, pwd_key)
            values(:email, :full_name, :jenkelid, :birth_city, :birth_country, to_date(:birth_date, 'dd-mm-yyyy'), :password, :pwd_key);
            
            insert into app_key_konfirmasi(key, expired, regid, status) values (md5(:sys_hashkey || 'confirmation' || cast(currval('app_key_konfirmasi_id_seq') as character varying)), '$d 00:00:54+02', currval('app_registration_id_seq'), 0);
                
            select key as hashid from app_key_konfirmasi where id=currval('app_key_konfirmasi_id_seq');
            ";
        $result = $this->mdb->QueryData('application', $sql, $data, 'record');
        return $result[0];
    }
    
    function doSendEmail($data){
        $to = array($data['email']);
        $subject = 'Registrasi E-KBRI';
        $message = $this->getRegistrationEmail($data);
        $message = $this->load->view('vshell', array('content'=>$message), true);
        $datas['email'] = $data['email'];
        $datas['nama_layanan'] = null;
        $datas['id'] = $data['regid'];
        $datas['data'] = $message;
        $datas['subject'] = $subject;
        $this->save_email($datas);
    }
    
    function getRegistrationEmail($data){
        $url = $this->getMainUrl().'confirmation/'.$data['key'];
        $data['conf_url'] = $url;
        //print_r($data); die;
        $msg = $this->load->view('vconfirmation', $data, true);
        return $msg;
    }
    
    function doSendEmailexpired($data){
        $to = array($data['email']);
        $subject = 'Registrasi E-KBRI';
        $message = $this->getRegistrationEmailexpired($data);
        $message = $this->load->view('vshell', array('content'=>$message), true);
        $datas['email'] = $data['email'];
        $datas['nama_layanan'] = null;
        $datas['id'] = $data['regid'];
        $datas['data'] = $message;
        $datas['subject'] = $subject;
        $this->save_email($datas);
    }
    
    function getRegistrationEmailexpired($data){
        $url = $this->getMainUrl().'login/inputEmail/'.$data['key'];
        $data['conf_url'] = $url;
        $msg = $this->load->view('vconfirmation', $data, true);
        return $msg;
    }
    
    function doSendEmailPassword($data){
        $to = array($data['email']);
        $subject = 'Registrasi E-KBRI';
        $message = $this->getRegistrationEmailPassword($data);
        $datas['email'] = $data['email'];
        $datas['nama_layanan'] = null;
        $datas['id'] = $data['userid'];
        $datas['data'] = $message;
        $datas['subject'] = $subject;
        $this->save_email($datas);
    }
    
    function getRegistrationEmailPassword($data){
        $url = $this->getMainUrl().'login/InputPassword/'.$data['key'];
        $data['conf_url'] = $url;
        $msg = 'Silahkan masuk ke link '.$url.' untuk buat password baru.';
        return $msg;
    }
    
    function sendEmail($to, $subject, $message){
        $this->load->library('email');
        $xconfig = $this->ci->config->item('email_config');
        $defconfig = array();
        $defconfig['protocol'] = "smtp";
        $defconfig['charset'] = "utf-8";
        $defconfig['mailtype'] = "html";
        $defconfig['newline'] = "\r\n";
        
        $defconfig = array_merge($defconfig, $xconfig);
        $config = $defconfig;
        //$config = array_merge($defconfig, $config);
        $this->email->initialize($config);
        $this->email->from($config['from_email'], $config['from_name']);
        $this->email->to($to);
        $this->email->reply_to($config['from_email'], $config['from_name']);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }
    
    function save_email($params) {
        if(!$params['nama_layanan']){
            $params['nama_layanan'] = '-';
        }
        $sql="
            Insert into app_email(email, kategori, subkategori, sourceid, data, subject, status)
            values(:email, 'layanan', :nama_layanan, :id, :data, :subject, 0);
        ";
        $this->mdb->ExecSQL('application', $sql, $params);
    }
    
}



?>
