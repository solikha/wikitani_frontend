<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
 
class Print_Controller extends MY_Controller {

    public function __construct() {
        parent::__construct();
		//echo "print_controller"; die;
		$this->loadConfig();
		//die;
    }

    public function index() {
        //$this->config->load('breadcrumbs');
		//$this->config->set_item('hide_number', 'your value');
    }
	
	function loadConfig(){
		$config_kbri = $this->config->item('kbri');
		//print_r($config_kbri);
		$config_db = $this->loadDBConfig('kbri');
		$xconfig = array_merge($config_kbri, $config_db);
		$this->config->set_item('kbri', $xconfig);
		//print_r($xconfig);
		
	}
	
	function loadDBConfig($group='kbri'){
		$sql = "select nama, value from app_config where kategori = :group";
		$params = array('group'=>$group);
		$qres = $this->mdb->QueryData('application', $sql, $params, 'record');
		$result = array();
		if (isset($qres[0])){
			foreach($qres as $row){
				$result[$row['nama']] = $row['value'];
			}
		}
		return $result;
	}
}
