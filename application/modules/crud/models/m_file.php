<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
class M_file extends MY_Model
{
    var $fileidprefix='file';
    public function __construct()
    {
        parent::__construct();
    }
    
    function getNewGeneralFileId(){
        $sql = "select nextval('sys_files_id_seq') as fileid;";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result[0]['fileid'])){
            return $result[0]['fileid'];
        } else {
            throw new Exception('cannot generate file id.');
        }
    }
    
    function insertSysFiles($params){
        $sql = "insert into sys_files(id, name, filepath, type, basetype, size)
            values (:id, :name, :filepath, :type, :basetype, :size);
            update sys_files set hashid = md5(:sys_hashkey||cast(id as character varying)) 
              where id = currval('sys_files_id_seq');";
        $this->mdb->ExecSQL('application', $sql, $params);
    }
    
    function forceFolder($folder){
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
    }
    
    function generateFolderName($files){
        if(!isset($files['foldertype'])){
            $type = 'date';
        }
        if(!isset($files['folderarg1'])){
            $arg1 = false;
        }
        if(!isset($files['folderarg2'])){
            $arg2 = false;
        }
        if($type===false){
            return '';
        } else if($type==='date'){
            return date('Ymd');
        } else if($type==='data'){
            return $arg1[$arg2];
        } else if($type==='function'){
            return $arg1($arg2);
        } else {
            return false;
        }
    }
        
    
    public function download($fileid){
        $sql = "select * from sys_files where id = :fileid";
        $params = array('fileid'=>$fileid);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qresult[0])){
            $basefolder = $this->ci->config->item('filefolder');
            $filepath = $basefolder.$qresult[0]['filepath'];
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: must-revalidate");
            header("Content-Type: " . $qresult[0]['type']);
            header("Content-Disposition: attachment; filename=\"" . $qresult[0]['name'] . "\";");
            header("Content-Length: " . filesize($filepath));
            readfile($filepath);
        } else {
            throw new Exception('File Not Found');
        }
    }
    
    public function fileinfo($fileid){
        $sql = "select * from sys_files where id = :fileid";
        $params = array('fileid'=>$fileid);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qresult[0])){
            return $qresult[0];
        } else {
            throw new Exception('File Not Found');
        }
    }
    
    public function delete($fileid){
        $sql = "select * from sys_files where id = :fileid";
        $params = array('fileid'=>$fileid);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qresult[0])){
            //return $qresult[0];
            $basefolder = $this->ci->config->item('filefolder');
            $filepath = $basefolder.$qresult[0]['filepath'];
            //if (file_exists($filepath)){
                unlink($filepath);
            //}
            $sql = "delete from sys_files where id = :fileid";
            $this->mdb->ExecSQL('application', $sql, $params);
        } else {
            //throw new Exception('File Not Found');
        }
    }
    
    function saveFiles($files=false){
        if ($files===false){
            $files = $_FILES;
        }
        $result = array();
        foreach($files as $fname => $file){
            //print_r($files);
            if (isset($file['file_id']) and ($file['file_id']!=='') and ($file['file_id']!==null)){
                $guid = $file['file_id'];
                $this->delete($guid);
                $mode='update';
            } else {
                $guid = $this->getNewGeneralFileId();
                $mode='insert';
            }
            //print_r($mode); die;
            $fileid = $this->fileidprefix.$guid;
            $folderid = $this->generateFolderName($files);
            $folder = $this->ci->config->item('filefolder').$folderid.'/';
            $filepath = $folderid.'/'.$fileid;
            $this->forceFolder($folder);
            //echo $folder.$fileid;
            //print_r($file); die;
            //$file['tmp_name']
            if (move_uploaded_file($file['tmp_name'], $folder.$fileid)){
                $result[$fname.'_filepath'] = $filepath;
                $result[$fname.'_filename'] = $file['name'];
                $dtype = explode('/', $file['type']);
                if(isset($dtype[0])){
                    $file['basetype'] = $dtype[0];
                } else {
                    $file['basetype'] = '';
                }
                $result[$fname.'_type'] = $file['type'];
                $result[$fname.'_basetype'] = $file['basetype'];
                $result[$fname.'_size'] = $file['size'];
                $result[$fname.'_id'] = $guid;
                $fparams = $file;
                $fparams['filepath'] = $filepath;
                $fparams['id'] = $guid;
                $this->insertSysFiles($fparams);
            } else {
                throw new Exception('cannot generate file id.');
            }
        }
        return $result;
    }
    
    function getFileByHash($hashid, $default_file_name=''){
        if (!$default_file_name){
            $default_file_name = 'not-found';
        }
        $default_file = $this->ci->config->item('filefolder').$default_file_name.'.png';
        if ($hashid){
            $sql = 'select * from sys_files where hashid = :hashid';
            $params = array('hashid'=>$hashid);
            $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
            if (isset($qres[0])){
    //            print_r($qres[0]);
                $path = $qres[0]['filepath'];
                $type = $qres[0]['type'];
                $name = $qres[0]['name'];
                
                $filename = $this->ci->config->item('filefolder').$path;
                if (file_exists($filename)){
                    header("Content-Type: $type");            
                    header("Content-Disposition: inline; ".'filename="'.$name.'"');
                    echo file_get_contents($filename);
                } else {
                    if (($default_file) and (file_exists($default_file))){
                        header("Content-Type: $type");            
                        header("Content-Disposition: inline; ".'filename="'.$name.'"');
                        echo file_get_contents($default_file);
                    }
                }
            } else {
                if (($default_file) and (file_exists($default_file))){
                    header("Content-Type: image/png");            
                    header("Content-Disposition: inline; ".'filename="'.$default_file.'"');
                    echo file_get_contents($default_file);
                }
            }
            //$folder = $this->ci->config->item('filefolder').$folderid.'/';
        } else {
            if (($default_file) and (file_exists($default_file))){
                header("Content-Type: image/png");            
                header("Content-Disposition: inline; ".'filename="'.$default_file.'"');
                echo file_get_contents($default_file);
            }
        }
    }
    
}
?>
