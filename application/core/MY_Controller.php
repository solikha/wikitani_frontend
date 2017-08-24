<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

function mfErrorHandler($errno, $errstr, $errfile, $errline)
{
    switch ($errno) {
    case E_USER_ERROR:
        $message = "<b>ERROR</b> [$errno] $errstr<br />\n".
          "Fatal error on line $errline in file $errfile";
        break;

    case E_USER_WARNING:
        $message = "<b>WARNING</b> [$errno] $errstr<br />\n".
          "Line $errline in file $errfile";
        break;

    case E_NOTICE:
        $message = "<b>NOTICE</b> [$errno] $errstr<br />\n".
          "Line $errline in file $errfile";
        break;
    
    case E_USER_NOTICE:
        $message = "<b>NOTICE</b> [$errno] $errstr<br />\n".
          "Line $errline in file $errfile";
        break;

    default:
        $message = "<b>Unknown ERROR</b>: [$errno] $errstr<br />\n".
          "Line $errline in file $errfile";
        break;
    }
    //echo $message;
    //throw new MfException('internal-error', 'Internal error', $message);
    throw new Exception($message);
    /* Don't execute PHP internal error handler */
    return true;
}


class MY_Controller extends MX_Controller {
    var $ErrorMessage;
    var $ci;
    var $default_handler;
    var $debug_message;
    var $show_error_type;
    var $show_error_view;
    var $current_id;
    var $sessiondata;
    function __construct()
    {
        parent::__construct();
        //echo '1234';
        $this->ErrorMessage = '';
        $this->default_handler = set_error_handler('mfErrorHandler');
        date_default_timezone_set('Asia/Jakarta');
        //$this->createnoerror();
        $this->ci =& get_instance();
        $this->ci->sessiondata = false;
        $this->ci->config->load('manggu');
        $this->ci->config->load('mangguapp');
        $this->debug_message = $this->ci->config->item('debug_message');
        $this->show_error_type = 'default';
        $this->show_error_view='base/errview';
        $this->load->model('m_database', 'mdb');
        //print_r($this->ci);
//        $this->sessiondata = 'testing';
//        $this->checkSessionData();
        
    }

    function messageKeyList(){
        return array();
    }
    
    function checkMessage($message, $item){
        if (isset($item['keyword']) and isset($item['message'])){
            //$message = str_replace(array("\n", "\t", "\r"), '', $message);
            $pos = strpos($message, $item['keyword']); 
            if ($pos!==false){
                return $item['message'];
            }
        }
        return false;
    }
    
    function softenMessage($message){
        $listMsg = $this->messageKeyList();
        //print_r($listMsg);
        foreach ($listMsg as $item){
            $result = $this->checkMessage($message, $item);
            if ($result!==false){
                return $result;
            }
        }
        return $message;
    }
    
    function checkSessionData(){
        $this->load->model('login/m_login', 'mlogin');
        return $this->mlogin->getSessionData();
    }
    
    function getUserInfo($username){
        $this->load->model('login/m_login', 'mlogin');
        return $this->mlogin->getUserInfo($username);
    }
    
    function getSysUserInfo($username){
        $userInfo = $this->getUserInfo($username);
        $sys_db_info = array();
        foreach($userInfo as $key=>$value){
            $sys_db_info['sys_'.$key] = $value;
        }
        $appconfig = $this->ci->config->item('appconfig');
        $hashkey = $appconfig['hash-key'];
        $sys_db_info['sys_hashkey'] = $hashkey;
        return $sys_db_info;
    }
    
    function updateSysParamsUserInfo($username){
        $sys_db_info = $this->getSysUserInfo($username);
        //print_r($sys_db_info);
        $this->mdb->mergeDefParams($sys_db_info);
    }
    
    function cleanup(){
        restore_error_handler($this->default_handler);
    }
    
    function getArrData($array, $index, $default){
        if (isset($array[$index])){
            return $array[$index];
        } else {
            return $default;
        }
    }
    function getExceptionTrace($e){
        $varr = $e->getTrace();
        $result = '';
        foreach($varr as $item){
            if ($result!==''){
                $result = $result."\r\n";
            }
            $file = $this->getArrData($item, 'file', '');
            $line = $this->getArrData($item, 'line', '');
            $function = $this->getArrData($item, 'function', '');
            $class = $this->getArrData($item, 'class', '');
            $row = "File: $file, Line: $line, Function: $function, Class: $class";
            $result = $result.$row;
        }
        return $result;
    }
    
    function getDefaultViewParams(){
        $viewpath = 'default';
        $libpath = 'default';
        $homepath = 'main';
        $appurl = $this->getAppURL();
        $liburl = base_url().'libs/'.$libpath.'/';
        $data = array(
            'viewpath'=>$viewpath,
            'appurl'=>$appurl,
            'liburl'=>$liburl,
            'homeurl'=>$appurl.'/'.$homepath
        );
        return $data;
    }
    
    function exceptionAsJson($exception){
        if (get_class($exception)=='MgException'){
            $message = $exception->getMessage();
            $message = $this->softenMessage($message);
            $result = array("success"=>0, "error"=>1, "message"=>$message, 'errorname'=>'MgException');
        } else {
            $message = $exception->getMessage();
            $message = $this->softenMessage($message);
            $detail = $exception->getTraceAsString();
            $result = array("success"=>0, "error"=>1, "message"=>$message, 'errorname'=>'exception',
                'detail'=>$detail);
        }
        return $result;
    }
        
    function showException($exception){
        $devmode = $this->ci->config->item('deploystate');
        //echo $devmode;
        //print_r($exception->getTrace());
        $err_line = $exception->getFile().'. Line: '.$exception->getLine();
        //print_r($exception->getTrace());
        $err_trace = $this->getExceptionTrace($exception);
        //$err_trace = $exception->getTraceAsString();
        
        if (get_class($exception)=='MgException'){
            if ($exception->err_type == '403'){
                echo "Akses ditolak (403)<br>";
            } else if ($exception->err_type == '404'){
                echo "Request tidak diketemukan (404)<br>";
            } else {
                echo "Ada error di server (500)<br>";
            }
            echo $exception->err_message;
        } else {
            echo "Ada error di server (500)<br>";
            echo $exception->getMessage();
        }
        echo '<br>'."\r\n";
        //echo '<!--';
        echo $err_line."\r\n";
        echo $err_trace."\r\n";
        //echo '-->';
//        if (get_class($exception)=='MgException'){
//            $err_code = $exception->Error_code;
//            $err_message = $exception->Error_message;
//            $err_detail = $exception->Error_detail;
//        } else {
//            $err_code = '';
//            $err_message = $exception->getMessage();
//            $err_detail = '';
//        }
//        
//        $err_data = array('err_message'=>$err_message, 'err_code'=>$err_code,
//            'err_detail'=>$err_detail, 'err_line'=>$err_line, 'err_trace'=>$err_trace);
//        print_r($err_data);
    }
    
    function getAppUrl(){
        
    }

}

    
    
?>
