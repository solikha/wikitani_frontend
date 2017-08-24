<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Cetak extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
    
    function paspor() {
        echo "cetak paspor";
    }
    
    
    function layanan(){
        $this->load->model('m_cetak', 'mcetak');
        $lyn_id = getArrayDef($_GET, 'lyn_id');
        $menu = $this->mcetak->cetak_dispatch_hash($lyn_id);
        //print_r($menu);
        if (isset($menu['redirect'])){
            redirect('menu/'.$menu['redirect']);        
        } else {
            echo $menu['message'];
        }
    }
}