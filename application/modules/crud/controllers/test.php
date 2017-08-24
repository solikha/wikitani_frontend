<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Test extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        //$this->load->view('welcome_message');
            echo modules::run('login', '');
        //echo "testing";
    }

    function xupdate_viewindex() {
//        print_r($_GET); die;
        try {
            $sessData = $this->checkSessionData();
            if ($sessData===false){
                echo 'not login';
            } else {
                $username = $sessData['username'];
                $this->updateSysParamsUserInfo($username);
                
                $params = array('rfqc_id'=>$_GET['rfqc_id']);
                $sql = "select id
                    from app_detail_rfqc where rfqc_id = :rfqc_id
                    order by id
                    ";
                $result = $this->mdb->QueryData('application', $sql, $params, 'record');
                $sql = "update app_detail_rfqc 
                    set viewindex = :index
                    where id = :id
                    ";
                
                $counter = 1;
                foreach ($result as $row){
                    $row['index'] = $counter;
                    $counter = $counter+1;
                    $this->mdb->ExecSQL('application', $sql, $row);
                }
            }
            echo "finish";
        } catch (Exception $e) {
            echo $e->getMessage() . "\r\n" . $e->getTraceAsString();
        }
    }
    
    function xupdate_viewindex_rfqs() {
//        print_r($_GET); die;
        try {
            $sessData = $this->checkSessionData();
            if ($sessData===false){
                echo 'not login';
            } else {
                $username = $sessData['username'];
                $this->updateSysParamsUserInfo($username);
                
                $params = array('rfqs_id'=>$_GET['rfqs_id']);
                $sql = "select id
                    from app_detail_rfqs where rfqs_id = :rfqs_id
                    order by id
                    ";
                $result = $this->mdb->QueryData('application', $sql, $params, 'record');
                $sql = "update app_detail_rfqs 
                    set viewindex = :index
                    where id = :id
                    ";
                
                $counter = 1;
                foreach ($result as $row){
                    $row['index'] = $counter;
                    $counter = $counter+1;
                    $this->mdb->ExecSQL('application', $sql, $row);
                }
            }
            echo "finish";
        } catch (Exception $e) {
            echo $e->getMessage() . "\r\n" . $e->getTraceAsString();
        }
    }


    function xupdate_viewindex_quots() {
//        print_r($_GET); die;
        try {
            $sessData = $this->checkSessionData();
            if ($sessData===false){
                echo 'not login';
            } else {
                $username = $sessData['username'];
                $this->updateSysParamsUserInfo($username);
                
                $params = array('quot_s_id'=>$_GET['quot_s_id']);
                $sql = "select id
                    from app_detail_quot_s where quot_s_id = :quot_s_id
                    order by id
                    ";
                $result = $this->mdb->QueryData('application', $sql, $params, 'record');
                $sql = "update app_detail_quot_s 
                    set viewindex = :index
                    where id = :id
                    ";
                
                $counter = 1;
                foreach ($result as $row){
                    $row['index'] = $counter;
                    $counter = $counter+1;
                    $this->mdb->ExecSQL('application', $sql, $row);
                }
            }
            echo "finish";
        } catch (Exception $e) {
            echo $e->getMessage() . "\r\n" . $e->getTraceAsString();
        }
    }

    function xupdate_viewindex_quotc() {
//        print_r($_GET); die;
        try {
            $sessData = $this->checkSessionData();
            if ($sessData===false){
                echo 'not login';
            } else {
                $username = $sessData['username'];
                $this->updateSysParamsUserInfo($username);
                
                $params = array('quot_c_id'=>$_GET['quot_c_id']);
                $sql = "select id
                    from app_detail_quot_c where quot_c_id = :quot_c_id
                    order by id
                    ";
                $result = $this->mdb->QueryData('application', $sql, $params, 'record');
                $sql = "update app_detail_quot_c
                    set viewindex = :index
                    where id = :id
                    ";
                
                $counter = 1;
                foreach ($result as $row){
                    $row['index'] = $counter;
                    $counter = $counter+1;
                    $this->mdb->ExecSQL('application', $sql, $row);
                }
            }
            echo "finish";
        } catch (Exception $e) {
            echo $e->getMessage() . "\r\n" . $e->getTraceAsString();
        }
    }

    public function list_fields(){
        
    }
    
    public function import_wni(){
        
    }
    
}