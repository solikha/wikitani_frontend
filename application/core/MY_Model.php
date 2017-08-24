<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class MY_Model extends CI_Model
{
    var $ci;
    var $basepath = '';
    var $themeName = 'aceadmin';
    var $brandIcon = 'avatar2';
    var $brandName = 'Pulsanium';
    public function __construct()
    {
        parent::__construct();
        // setting timezone.
        date_default_timezone_set('Asia/Jakarta');
        $this->ci =& get_instance();
        //$this->ci->config->load('manggu');
    }
    
    function getData(&$data, $default=null){
        if(isset($data)){
            return $data;
        } else {
            if (isset($default)){
                return $default;
            } else {
                throw new MangguException('internal-error', 'Unknown Variable.', '');
            }
        }
    }
    
    public function checkRoles($rolename){
        $sql = "select a.username, c.rolename
            from sys_users a
            join sys_userroles b on a.userid = b.userid
            left join sys_roles c on b.roleid = c.roleid
            where username = :sys_username
            and c.rolename = :rolename
            and c.active = 1
            ";
        $params = array('rolename'=>$rolename);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        //print_r($qresult);
        if (isset($qresult[0])){
            //print_r($qresult[0]);
            return true;
        }
        return false;
    }
    
    
    function LoadConfig($context, $type){
        $filename = $this->ci->config->item('structurefolder').'/'.$this->basepath."/".
            $context.'.'.$type;
        $json_data = file_get_contents($filename);
        return json_decode($json_data, true);
    }
    
    function LoadContext($context, $type){
        $filename = $this->ci->config->item('basefolder').'/'.$this->basepath."/".
            $context.'.'.$type;
        $json_data = file_get_contents($filename);
        return json_decode($json_data, true);
    }
    
    function getAppUrl(){
        if (index_page()!==''){
            $result = base_url().index_page().'/app/';
        } else {
            $result = base_url().'app/';
        }
        return $result;
    }
    
    function getBaseUrl(){
        if (index_page()!==''){
            $result = base_url().index_page().'/';
        } else {
            $result = base_url();
        }
        return $result;
    }
    
    function getMainUrl($vpath=''){
        if ($vpath!==''){
            $vpath = $vpath.'/';
        }
        if (index_page()!==''){
            $result = base_url().index_page().'/'.$vpath;
        } else {
            $result = base_url().$vpath;
        }
        return $result;
    }
    
    function getDefaultData(){
        $result = array();
        $appconfig = $this->ci->config->item('appconfig');
        $result['assetdir'] = $appconfig['assetdir'];
//        $result['assetdir'] = base_url().'themes/'.$this->themeName.'/';
        $result['basedir'] = base_url();
        $result['libsurl'] = base_url().'libs/';
        $result['mainurl'] = $this->getMainUrl();
        $result['brandicon']=$this->brandIcon;
        $result['brandname']=$this->brandName;
        $result['shortcuts']='';
        $result['mainmenu']='';
        $result['userinfo']='';
        $result['pagecontent']='';
        $result['appconfig'] = $this->ci->config->item('appconfig');
        
        return $result;
    }
    
    
}
?>
