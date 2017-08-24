<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_database extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    var $dbobj=array();
    var $defparams = array();
    public function loadDb($dbname){
        $this->dbobj[$dbname] = $this->load->database($dbname, TRUE);
    }
    
    public function mergeDefParams($params){
        $this->defparams = array_merge($this->defparams, $params);
    }
    
    function querySQL($sql, $params, $resultType='matrix', $isPaging=false, $limit=0, $start=0){
        
    }
    
    public function trans_begin($dbname){
        if (!isset($this->dbobj[$dbname])){
            $this->dbobj[$dbname] = $this->load->database($dbname, TRUE);
        }
        $vdb = $this->dbobj[$dbname];
        $vdb->trans_begin();
    }
    
    public function trans_commit($dbname){
//        if (!isset($this->dbobj[$dbname])){
//            $this->dbobj[$dbname] = $this->load->database($dbname, TRUE);
//        }
        $vdb = $this->dbobj[$dbname];
        $vdb->trans_commit();
    }
    
    public function trans_rollback($dbname){
//        if (!isset($this->dbobj[$dbname])){
//            $this->dbobj[$dbname] = $this->load->database($dbname, TRUE);
//        }
        $vdb = $this->dbobj[$dbname];
        $vdb->trans_rollback();
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
    
////////
    
    protected function convertSQL($SQL, $paramList, $isPaging = false, $limit=0, $start=0){
        /*
         * function ini digunakan untuk mengubah parameter dalam SQL
         * dari :<name> menjadi ? dan menyesuaikan urutan parameter, serta
         * menambahi kata kunci limit dan start bila ada paging.
         * Hasil function ini adalah
         *   SQL : adalah SQL yang sudah diubah parameter-nya
         *   countSQL : SQL untuk Count bila $isPaging true
         *   params : array of value yang urutannya sudah disesuaikan dengan
         *     kemunculan :<nama>
         *
         */

//        $temporarySQL = $SQL;
        $tokens = preg_split('/[^a-zA-Z0-9\':_"]+/', $SQL);
        $temporaryArray = array();
        $trPair = array();
        foreach($tokens as $token){
            if (substr($token, 0, 1)==':'){
                array_push($temporaryArray, strtolower(substr($token, 1)));
                $trPair[$token]="?";
                //$temporarySQL = str_replace($token, "?", $temporarySQL);
            }
        }
        $temporarySQL = strtr ($SQL, $trPair );
        $params = array();
        foreach($temporaryArray as $item){
            if ($paramList[$item]===''){
                array_push($params, null);
            } else {
                array_push($params, $paramList[$item]);
            }
            
        }
        $result = array('params'=>$params);
        if ($isPaging){
            $result['countSQL'] = 'select count(*) from ('.$temporarySQL.') a ';
            // postgresql style
            // $result['SQL'] = $temporarySQL.' limit '.$limit.' offset '.$start;

            // mysql style
            $result['SQL'] = $temporarySQL.' limit '.$start.', '.$limit;


        } else {
            $result['SQL'] = $temporarySQL;
        }
        //print_r($result);
        return $result;
    }
    
    protected function doQuery($dbname, $SQL, $params, $resulttype='matrix', $countSQL=''){
        /*
         * function ini digunakan untuk menjalankan Query. Selain itu ada dua
         * parameter tambahan yaitu limit dan start untuk keperluan paging.
         * SQL adalah select SQL.
         * countSQL (optional) adalah sql untuk menghitung
         * banyaknya record total. Bila tidak kosng dianggap ada paging.
         * informasi limit dan offset menggunakan limit dan start.
         * Hasil query diformat dalam bentuk matrix 2 dimensi
         * hanya datanya saja, tanpa nama field.
         * 
         */
        $sqlInfo = $this->convertSQL($SQL, $params);
        $countsqlInfo = $this->convertSQL($countSQL, $params);
        $matrix= array();
        $count=0;
        if (!isset($this->dbobj[$dbname])){
            $this->dbobj[$dbname] = $this->load->database($dbname, TRUE);
        }
        $vdb = $this->dbobj[$dbname];
        //$rs = $vdb->query($SQL, $params);
        $rs = $vdb->query($sqlInfo['SQL'], $sqlInfo['params']);
        /*if ($rs){
            return $rs->result_array();
        } else {
            return $vdb->_error_message();
        }
         * 
         */
        
        
        if (!$rs){
            return $vdb->_error_message();
        } else {
            //echo $resulttype;
            if ($resulttype=='matrix'){
                $fieldlist = array();
                foreach ($rs->result() as $record){
                    $rowResult = array();
                    foreach ($record as $fieldname => $value){
                        array_push($fieldlist, $fieldname);
                    }
                    //array_push($matrix, $rowResult);
                    break;
                }

                foreach ($rs->result() as $record){
                    $rowResult = array();
                    foreach ($record as $fieldName => $value){
                        array_push($rowResult, $value);
                    }
                    array_push($matrix, $rowResult);
                    $count=$count+1;
                }
                if ($countSQL!=''){
                    $countrs = $vdb->query($countsqlInfo['SQL'], $countsqlInfo['params']);
                    if ($countrs){
                        foreach ($countrs->result() as $record){
                            foreach ($record as $fieldName => $value){
                                $count = $value;
                            }
                        }
                    }
                }
                return array('fieldlist'=>$fieldlist, 'matrixdata'=>$matrix, 'count'=>$count);
            } else {
                return $rs->result_array();
            }
        }
    }
    
    function QueryData($dbname, $vsql, $vparams, $resulttype='matrix', $countsql=''){
        $vparams = array_merge($this->defparams, $vparams);
        try {
            $result = $this->doQuery($dbname, $vsql, $vparams, $resulttype, $countsql);
            if (is_array($result)){
                return $result;
            } else {
                throw new Exception('ModelRoot: Query Error. '.$result);
            }
        } catch(Exception $ex) {
            error_log("Database: $dbname");
            error_log("SQL: $vsql");
            $xparams = print_r($vparams, true);
            error_log("Params: $xparams");
            $vtrace = $this->getExceptionTrace($ex);
            error_log("Error: ".$ex->getMessage()."\r\n".$vtrace);
            throw($ex);
        }
        
    }
    
    function ExecSQL($dbname, $vsql, $vparams){
        $vparams = array_merge($this->defparams, $vparams);
        try {
            $sqlInfo = $this->convertSQL($vsql, $vparams, false, 0, 0);
            if (!isset($this->dbobj[$dbname])){
                $this->dbobj[$dbname] = $this->load->database($dbname, TRUE);
            }
            $vdb = $this->dbobj[$dbname];
            //$vdb = $this->load->database($dbname, TRUE);
            $result = $vdb->query($sqlInfo['SQL'], $sqlInfo['params']);
            return $result;
        } catch(Exception $ex) {
            error_log("Database: $dbname");
            error_log("SQL: $vsql");
            $xparams = print_r($vparams, true);
            error_log("Params: $xparams");
            $vtrace = $this->getExceptionTrace($ex);
            error_log("Error: ".$ex->getMessage()."\r\n".$vtrace);
            throw($ex);
        }
        
    }
    
}



?>
