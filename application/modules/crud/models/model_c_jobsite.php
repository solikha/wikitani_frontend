<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Model_c_jobsite extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
    }

    function load_jobsite($id) {
        $param = array('jobsite_id' => $id);
        $sql = "select a.* ,b.nama as kota, c.nama as provinsi from app_jobsite a 
left join app_kota b on a.kota_id=b.id
left join app_provinsi c on a.provinsi_id=c.id
 where a.id = :jobsite_id";
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record');
        return $qresult[0];
    }

    function load_item($id) {
        $param = array('jobsite_id' => $id);
        $sql = "select c.jumlah, d.nama from app_jobsite a 
left join app_lyn_paket b on a.paket_id=b.id 
left join app_lyn_paket_item c on a.paket_id=c.paket_id
left join app_lyn_item d on c.item_id=d.id
 where a.id = :jobsite_id";
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record');
        return $qresult;
    }

    function layanan($id) {
        $param = array('jobsite_id' => $id);
        $sql = "select b.nama from app_jobsite a 
left join app_lyn_paket b on a.paket_id=b.id 
 where a.id = :jobsite_id";
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record');
        return $qresult[0];
    }

    function load_layanan_tambahan($id) {
        $param = array('jobsite_id' => $id);
        $sql = "select b.*, c.nama from app_jobsite a 
left join app_jobsite_lyn b on a.id=b.jobsite_id
left join app_lyn_item c on b.lyn_id=c.id
 where a.id = :jobsite_id";
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record');
        return $qresult;
    }

    function load_zona($id) {
        $param = array('jobsite_id' => $id);
        $sql = "select b.* from app_jobsite a 
left join app_jobsite_zona b on a.id=b.jobsite_id
 where a.id = :jobsite_id";
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record');
        return $qresult;
    }

    function load_cctv($id) {
        $param = array('jobsite_id' => $id);
        $sql = "select b.* from app_jobsite a 
left join app_jobsite_cctv b on a.id=b.jobsite_id
 where a.id = :jobsite_id";
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record');
        return $qresult;
    }

}