<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
class File extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        echo "index file";
    }
    
    public function download(){
        if (isset($_GET['file_id'])){
            $fileid = $_GET['file_id'];
        } else {
            $fileid = false;
        }
        
        if ($fileid===false){
            show_404();
        } else {
            try{
                $this->load->model('m_file', 'mfile');
                $this->mfile->download($fileid);
            } catch(Exception $e) {
                echo $e->getMessage() . "\r\n" . $e->getTraceAsString();
            }
        }
        
    }
    
    public function filetest($method){
        if (isset($_GET['file_id'])){
            $fileid = $_GET['file_id'];
        } else {
            $fileid = false;
        }
        
        if ($fileid===false){
            show_404();
        } else {
            try{
                $this->load->model('m_file', 'mfile');
                $result = $this->mfile->$method($fileid);
                echo json_encode($result);
            } catch(Exception $e) {
                echo $e->getMessage() . "\r\n" . $e->getTraceAsString();
            }
        }
    }

}
?>
