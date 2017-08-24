<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Wfattachement extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index(){
    }

    public function getlampirans(){

        try {
            $workflowid = isset($_POST['workflowid']) ? $_POST['workflowid'] : 0;
            $sql = "
                SELECT * 
                FROM app_izin_lampiran l 
                    LEFT JOIN app_lampiran_jenis j ON l.jenisdokumen = j.jenislampiranid 
                WHERE workflowid = :workflowid";
            $params = array("workflowid"=>$workflowid);
            $res = $this->mdb->QueryData('default', $sql, $params, 'record');

            echo json_encode($res);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    // Mengembalikan list field yang harus diisi untuk jenis lampiran tertentu
    public function getdocfields(){
        $jenislampiranid = $_POST['jenislampiranid'];
        $sql = "SELECT fieldlampiran FROM app_lampiran_jenis WHERE jenislampiranid = :jenislampiranid";
        $params = array("jenislampiranid"=>$jenislampiranid);
        $res = $this->mdb->QueryData('default', $sql, $params, 'record');
        $result = "[]";

        if (count($res) > 0) {
            $result = $res[0]['fieldlampiran'];
        }

        echo json_encode( json_decode($result, true) );
    }

    // Submit Form dan Upload File
    public function docsimpan(){

        $data = array();

        try {
            if (isset($_POST))
            {
                $form = $_POST;
//print_r($form);
                // UPLOAD FILE(S)
                $error = false;
                $files = array();

                $uploaddir = BASEPATH . '../uploads/izin/' . $form['workflowid'] . '/';
                if (!is_dir($uploaddir)) mkdir($uploaddir, 0777);
                $form['filename'] = ''; $form['filetype'] = '';
                foreach($_FILES as $file) {
                    if (move_uploaded_file($file['tmp_name'], $uploaddir . basename($file['name'])))
                    {
                        $files[] = $uploaddir . $file['name'];
                        $form['filename'] = $file['name'];
                        $form['filetype'] = $file['type'];
                    } else {
                        $error = true;
                    }
                }

                // GET DOC FIELDS
                $sql = "SELECT fieldlampiran FROM app_lampiran_jenis WHERE jenislampiranid = :jenislampiranid";
                $jenis = array("jenislampiranid"=>$form['jenisdokumen']);
                $res = $this->mdb->QueryData('default', $sql, $jenis, 'record');
                $docfields = json_decode($res[0]['fieldlampiran'], true);

                $detail = array();
                foreach($docfields as $field) {
                    $detail[$field['nama']] = $form[$field['nama']];
                }

                // INSERT QUERY
                $sql = "INSERT INTO app_izin_lampiran ( workflowid, namadokumen, jenisdokumen, detail, format, lokasi, status, filename, filetype, jenisfile ) 
                        VALUES ( :workflowid, :namadokumen, :jenisdokumen, :detail, '', :lokasi, '', :filename, :filetype, :jenisfile )";

                $form['detail'] = json_encode($detail);
                $this->mdb->ExecSQL('default', $sql, $form);

                $data = ($error) ? 
                    array('error' => 'There was an error uploading your files') : 
                    array('success' => 'Form was submitted ');

            } else {
                $data = array('error' => 'Tidak ada post');
            }
        } catch (Exception $e) {
            $data = array('error' => $e->getMessage());
        }

        echo json_encode($data);
    }

    public function getjenislampirans(){
        $sql = "SELECT * FROM app_lampiran_jenis";
        $params = array();
        $res = $this->mdb->QueryData('default', $sql, $params, 'record');

        echo json_encode($res);
    }

    public function download($lampiranid) {
        $sql = "SELECT * FROM app_izin_lampiran WHERE lampiranid = :lampiranid";
        $params = array("lampiranid"=>$lampiranid);
        $res = $this->mdb->QueryData('default', $sql, $params, 'record');

        if (count($res) > 0) {
            $file = $res[0];

            if (!empty($file['filename'])) {
                $filepath = BASEPATH . '../uploads/izin/' . $file['workflowid'] . '/' . $file['filename'];
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                header("Cache-Control: must-revalidate");
                header("Content-Type: " . $file['filetype']);
                header("Content-Disposition: attachment; filename=\"" . $file['filename'] . "\";");
                header("Content-Length: " . filesize($filepath));
                readfile($filepath);
                exit();
            } else {
                echo 'Mohon maaf, file tidak dapat ditemukan';
            }
        } else {
            echo 'Mohon maaf, file tidak dapat ditemukan';
        }
    }

    public function delete() {
        $lampiranid = $_POST['lampiranid'];
        $sql = "SELECT * FROM app_izin_lampiran WHERE lampiranid = :lampiranid";
        $params = array("lampiranid" => $lampiranid);
        $res = $this->mdb->QueryData('default', $sql, $params, 'record');

        if (count($res) > 0) {
            $lampiran = $res[0];
            try {
                if (!empty($lampiran['filename'])) {
                    $filepath = BASEPATH . '../uploads/izin/' . $lampiran['workflowid'] . '/' . $lampiran['filename'];
                    unlink($filepath);
                }

                $sql = "DELETE FROM app_izin_lampiran WHERE lampiranid = :lampiranid";
                $params = array("lampiranid"=>$lampiranid);
                $this->mdb->ExecSQL('default', $sql, $params);

                echo json_encode(array("success"=>"Data dokumen telah berhasil dihapus."));
            } catch (Exception $e) {
                echo json_encode(array("error"=>"Error: " . $e->getMessage()));
            }
        }
    }

    public function test_public_screen($param1, $param2='x2', $param3='x3'){
        //echo "test".$param1.$param2.$param3;
        $this->load->view('test_screen_1');
    }
    
    
}
?>
