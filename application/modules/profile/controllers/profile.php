<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Profile extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
    
    // parameter profile adalah nama view --> 'module/viewname';
    //    module/folder/folder/folder/viewname (maksimum 3 level folder).
    function index($vpar1='', $vpar2='', $vpar3='', $vpar4='', $vpar5=''){
        $viewname = $this->getViewName($vpar1, $vpar2, $vpar3, $vpar4, $vpar5);
        //echo $viewname;
        $this->load->view($viewname);
        
    }
    
    private function getViewName($vpar1, $vpar2, $vpar3, $vpar4, $vpar5){
        $count = 5;
        $blank = true;
        $result = '';
        for($i=$count; $i>0; $i--){
            $x = 'vpar'.$i;
            if ($$x!==''){
                $blank = false;
            }
            //echo '['.$$x.']';
            if (!$blank){
                if ($result!==''){
                    $result = '/'.$result;
                }
                $result = $$x.$result;
            }
        }
        return $result;
    }
    
    function pelanggan(){
        $custid = $_GET['cust_id'];
        
    }
    
    public function xcustomer(){
        echo "Percobaan";
    }
    

}

?>
