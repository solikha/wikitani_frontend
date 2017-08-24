<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_customer extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
    }
    
    public function getCustomerData($params){
        $sql = "select a.*, b.nama as nama_kota from app_customer a 
            left join app_kota b on a.kota_id = b.id
            where a.id = :cust_id";
        $datasql = $this->mdb->QueryData('application', $sql, $params, 'record');
        return $datasql;
    }
    
    
}

?>
