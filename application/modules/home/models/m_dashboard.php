<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_dashboard extends MY_Model {

    var $userinfo;

    public function __construct() {
        parent::__construct();
        $this->load->model("login/m_login");
        $session = $this->m_login->getSessionData();
        $this->userinfo = $this->m_login->getUserInfo($session['username']);
    }

    public function get_dashboard() {


        $result = array();

       
        return $result;
    }

    public function layanan_all() {
      
		  return array();
    }

    public function data_kategori_wni() {
        
		return array();
    }

}
