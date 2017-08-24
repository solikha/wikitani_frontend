<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function loadHome($array) {
        foreach ($array as $param) {
            echo call_user_func_array('Modules::run', $param);
        }
    }

    function index() {
        try {
            $sessData = $this->checkSessionData();
            if ($sessData === false) {
                echo Modules::run('login');
            } else {
                $this->load->model("m_dashboard");
                $data = $this->m_dashboard->get_dashboard();
                $data['userinfo'] = $this->getUserInfo($sessData['username']);
               // $data['layanan_all'] = $this->layanan_all();
               // $data['data_kategori_wni'] = $this->data_kategori_wni();
                $this->load->view('v_home', $data);
                if ($this->checkRoles('pelanggan')) {
                    $this->status();
                }
                if ($this->checkRoles('petugas')) {
                    $this->allStatus();
                }
                if ($this->checkRoles('sysadmin')) {
                    $this->showBarcode();
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "\r\n" . $e->getTraceAsString();
        }
    }

    function data_kategori_wni() {
        $datas = $this->m_dashboard->data_kategori_wni();
        $awal = array();
        $i = 0;
        foreach ($datas as $sth) {
            if ($i++ == 0) {
                $awal[] = 'x';
            }
            $awal[] = $sth['nama'];
        }

        $dua = array();
        $i = 0;
        foreach ($datas as $sh) {
            if ($i++ == 0) {
                $dua[] = "Data Kategori WNI";
            }
            $dua[] = (int) $sh['nilai'];
        }
        $arrayG = array($awal, $dua);
        return json_encode($arrayG);
    }

    function layanan_all() {
        $layanan_all = $this->m_dashboard->layanan_all();
        $awal = array();
        $i = 0;
        foreach ($layanan_all as $sth) {
            if ($i++ == 0) {
                $awal[] = 'x';
            }
            $awal[] = $sth['nama'];
        }

        $dua = array();
        $i = 0;
        foreach ($layanan_all as $sh) {
            if ($i++ == 0) {
                $dua[] = "Data Semua Layanan";
            }
            $dua[] = (int) $sh['nilai'];
        }
        $arrayG = array($awal, $dua);
        return json_encode($arrayG);
    }

    function test_php_info() {
        $sessData = $this->checkSessionData();
        if ($sessData === false) {
            echo "not login";
        } else {
            phpinfo();
        }
    }

    function dashboard() {
        $this->load->view('v_dashboard');
    }

    public function status() {
        $this->load->model('m_pelanggan');
        $this->m_pelanggan->showDataStatus();
    }

    public function allStatus() {
        $this->load->model('m_pelanggan');
        $this->m_pelanggan->showAllStatus();
    }

    public function checkRoles($rolename) {
        $sql = "select a.username, c.rolename
            from sys_users a
            join sys_userroles b on a.userid = b.userid
            left join sys_roles c on b.roleid = c.roleid
            where username = :sys_username
            and c.rolename = :rolename
            and c.active = 1
            ";
        $params = array('rolename' => $rolename);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qresult[0])) {
            return true;
        }
        return false;
    }

    function showBarcode() {
        $this->load->view('v_btnbarcode');
    }

}

?>
