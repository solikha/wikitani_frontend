<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_quotationc extends MY_Model {

   public function __construct(){
        parent::__construct();
		 $this->load->library('user_agent');
   }

    public function getquotationc($id){
	  $sql = "select 
				a.id,to_char(a.date,'dd-mm-yyyy')as date,a.ship_to,a.terms,a.description,a.quot_no,a.rfqc_id,
				b.rfq_number,
				c.name as nama_customer,c.phone
				from app_quotc a
				left join app_rfqc b on a.rfqc_id = b.id
				left join app_customer c on a.cust_id =c.id
			  where a.rfqc_id=:id";
      $params = array('id' => $id);
      $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
      return $qresult[0];
	  
    }
	
	function getdetail($id){
			try {
				$sql = "select a.part_number,a.description,a.qty from app_detail_rfqc a where 
				a.rfqc_id=:id";
				 $params = array('id' => $id);
				 $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
                 return $qresult;
			}
			catch (Exception $e) {
				echo $e->getMessage();
				return $e->getMessage();
			}
	}

	
	public function get_kolomsupplier($id){
	 $sql = "select b.rfq_qty,b.qoutation_qty,b.price,b.delivery_item,
				a.name as nama_supplier from app_detail_quot_s b
				left join app_quots d
				on b.quot_s_id=d.id
				left join app_rfqs c
				on d.rfqs_id=c.id
				left join app_supplier a 
				on c.supplier_id=a.id
				where c.rfqc_id=:id
			";
      $params = array('id' => $id);
      $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
      return $qresult;
	  
    }
	
	public function get_kolomavgprice($id) {
	 $sql = "select round(AVG(b.price))as average_price
			from app_detail_quot_s b
			left join app_quots d
			on b.quot_s_id=d.id
			left join app_rfqs c
			on d.rfqs_id=c.id
			left join app_supplier a 
			on c.supplier_id=a.id
			where c.rfqc_id=:id
			";
      $params = array('id' => $id);
      $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
      return $qresult;
	  
    }
	
	//SELECT AVG(Price) AS PriceAverage FROM Products; 
	/*backup awal
	public function get_kolompartnumber($id){
	  $sql = "select a.qty as jumlah_quotation,
				b.part_number,b.qty as jumlah_rfqc
				from app_detail_quot_c a
				left join app_quotc c on a.quot_c_id= c.id
				left join app_detail_rfqc b on c.rfqc_id=b.rfqc_id 
				where 
				a.rfqc_id=:id";
      $params = array('id' => $id);
      $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
      return $qresult;
	  
    }
	*/
	public function get_kolompartnumber($id){
	  try {
				$sql = "select a.part_number,a.description,a.qty as jumlah_rfqc from app_detail_rfqc a where 
				a.rfqc_id=:id";
				 $params = array('id' => $id);
				 $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
                 return $qresult;
			}
			catch (Exception $e) {
				echo $e->getMessage();
				return $e->getMessage();
			}
	  }
	
	/* back up*/
	/*
	function getdetail($id){
			try {
				$sql = "select 
				a.id,a.quot_c_id,a.part_number,a.description,a.qty,a.price,a.condition,a.price,a.supplier_price,
				b.name as nama_supplier
				from app_detail_quot_c a
				left join app_supplier b on a.supplier_id=b.id
				where a.quot_c_id=:id
				";
				 $params = array('id' => $id);
				 $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
                 return $qresult;
			}
			catch (Exception $e) {
				echo $e->getMessage();
				return $e->getMessage();
			}
	}
	*/
	
	
	
	
	function get_editdetail($id){
	
		try {
				$sql = "select 
				a.id,a.quot_c_id,a.part_number,a.description,a.qty,a.price,a.condition,a.price,a.supplier_price,
				b.name as nama_supplier
				from app_detail_quot_c a
				left join app_supplier b on a.supplier_id=b.id
				where a.id=:id
				";
				 $params = array('id' => $id);
				 $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
                 return $qresult;
			}
			catch (Exception $e) {
				echo $e->getMessage();
				return $e->getMessage();
			}
	
	}
	

}

?>
