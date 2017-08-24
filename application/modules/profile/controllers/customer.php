<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Customer extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        //echo "TEsting Index Customer";
        $this->load->model('m_customer', 'mcust');
        if (isset($_GET['cust_id'])){
            $cust_id = $_GET['cust_id'];
        } else {
            $cust_id = '';
        }
        
        $customer = $this->mcust->getCustomerData(array('cust_id'=>$cust_id));
        if (isset($customer[0])){
            $data['customer'] = $customer[0];
        } else {
            $data['customer'] = array();
        }
        $this->load->view('customer', $data);
    }
}


?>