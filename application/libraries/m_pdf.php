<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class m_pdf {
    
    public function __construct()
    {
        $CI = & get_instance();
    }
 
    public function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
        $defparams = array(
            "mode"=>"", 
            "format"=>"A4",
            "default_font_size"=>0,
            "default_font"=>"",
            "mgl"=>10,
            "mgr"=>10,
            "mgt"=>10,
            "mgb"=>10,
            "mgh"=>6,
            "mgf"=>3,
            "orientation"=>"L"
        );

        $params = $defparams;
        if ($param !== NULL) {
            if (is_array($param)) $params = array_merge($defparams, $param);
            print_r($params);
        }

        /*
        if ($param == NULL) {
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3';
        }
        */
         
        // return new mPDF($param);
        return new mPDF($params["mode"], $params["format"], $params["default_font_size"], $params["default_font"], $params["mgl"], $params["mgr"], $params["mgt"], $params["mgb"], $params["mgh"], $params["mgf"], $params["orientation"]);
    }
}