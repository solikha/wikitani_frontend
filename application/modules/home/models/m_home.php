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

class M_login extends MY_Model
{
    var $keys;
    var $SysConfig;
    public function __construct()
    {
        parent::__construct();
        $this->prepareKey();
        $this->SysConfig = $this->ci->config->item('sysconfig');
        
    }
    
    public function openLoginScreen(){
        //echo "test";
        $data = $this->getDefaultData();
        $idx = rand(0, 99);
        $data['kode_data'] = $idx;
        $data['key_data'] = $this->keys[$idx];
//        print_r($this->ci->config->item('appconfig'));
//        die;
        $this->load->view('login/vlogin', $data);
        
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
        $sql = 'select userid, username, password, enctype from sys_users where username = :username and active=1';
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
        
    
    function serviceLogin($username='', $password='', $key=0){
        if (($key>=0) and ($key<=99)){
            //print_r($this->keys);
            $xkey = $this->keys[$key];
            $xpass = $this->rc4($xkey, $this->hexToStr($password));

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
        //$vsession = $this->getCookiesName(NAMA_SESSION);
        //print_r($vsession);
        $vsql = "delete from sys_session where sessioncode = :sessionid";
        $vparams = array('sessionid'=>$vsession);
        $res = $this->mdb->ExecSQL('application', $vsql, $vparams, 'array');
        return false;
    }
    
    public function getUserInfo($username){
        $vsql = "select a.userid, a.username, a.fullname
            from sys_users a 
            where a.username = :username";
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
    
    
    
}



?>
