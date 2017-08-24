<?php

ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_quotations extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
    }

    function get_supplieraddres($supplier_id) {
        // echo $supplier_id; die();
        $sql = "select id,addres from app_supplier where id=:supplier_id";
        $params = array('supplier_id' => $supplier_id);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        return $qresult[0];
    }
    
    public function get_suppliercontact($supplier_id) {
        $params = array('supplier_id' => $supplier_id);
        $sql = "select id,email from app_supplier where id=:supplier_id";
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        return $qresult;
    }

    function get_partnumber($part_id) {
        // echo $supplier_id; die();
        $sql = "select id,part_number,description from app_parts where id=:part_id";
        $params = array('part_id' => $part_id);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        return $qresult[0];
    }

    function get_rfqs($rfqs_id) {
            $sql = "select 
	a.id as rfqs_id,b.email,a.rfq_number as rfqs_no,a.requirement,to_char(a.date,'MONDD/YYYY') as rfqs_date,a.ship_to,a.ship_to_addr as ship_to_addres,b.name as supplier_name,
	b.addres, b.phone, b.fax,
	a1.rfq_number as rfqc_no,a1.date as rfqc_date,b1.name as customer_name
	from
	app_rfqs a
	left join
	app_supplier b on a.supplier_id=b.id
	left join
	app_supp_contact c
	on b.id=c.supplier_id
	left join
	app_rfqc a1
	on a.rfqc_id=a1.id
	left join app_customer b1 on b1.id=a1.cust_id
	where 
	a.id=:rfqs_id";
            $params = array('rfqs_id' => $rfqs_id);
            $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
            return $qresult[0];
    }

    function get_detailrfqs($rfqs_id) {
        try {
            $sql = "select 
				a.id as detail_rfqs_id,b.description,a.rfq_qty, c.condition,b.id as part_id,
					b.part_number, d.uom as uom_id, a.remark
					from app_detail_rfqs a
					left join app_parts b
					on a.part_id=b.id
					left join app_condition c
					on a.condition_id=c.id
					left join app_uom d
					on a.uom_id=d.id
		          where a.rfqs_id=:rfqs_id";
            $params = array('rfqs_id' => $rfqs_id);
            $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
            return $qresult;
        } catch (Exception $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }
    }

    public function getquotationc($id) {
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

    function getdetail($id) {
        try {
            $sql = "select a.part_number,a.description,a.qty from app_detail_rfqc a where 
				a.rfqc_id=:id";
            $params = array('id' => $id);
            $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
            return $qresult;
        } catch (Exception $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }
    }

    public function get_kolomsupplier($id) {
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
    /* backup awal
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
    public function get_kolompartnumber($id) {
        try {
            $sql = "select a.part_number,a.description,a.qty as jumlah_rfqc from app_detail_rfqc a where 
				a.rfqc_id=:id";
            $params = array('id' => $id);
            $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
            return $qresult;
        } catch (Exception $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }
    }

    /* back up */
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

    function get_editdetail($id) {

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
        } catch (Exception $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }
    }

    function disp_rfqs($rfqs_id) {
        $param = array('rfqs_id' => $rfqs_id);
        $sql = "select 
		a.id as rfqs_id,a.rfq_number as rfqs_no,to_char(a.date,'dd-mm-yyyy') as rfqs_date,b.name as supplier_name,
		b.addres,
		a1.rfq_number as rfqc_no,a1.date as rfqc_date,a1.id as cust_id,b1.name as customer_name
		from
		app_rfqs a
		left join
		app_supplier b on a.supplier_id=b.id
		left join
		app_supp_contact c
		on b.id=c.supplier_id
		left join
		app_rfqc a1
		on a.rfqc_id=a1.id
		left join app_customer b1 on b1.id=a1.cust_id
		where 
		a.id=:rfqs_id
		";
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record');
        return $qresult;
    }

    function disp_detail($rfqs_id) {
        try {
            $sql = "select 
				a.id as detail_rfqs_id,b.description,a.rfq_qty, a.condition,
				b.part_number
				from app_detail_rfqs a
				left join app_parts b
				on a.part_id=b.id
				where a.rfqs_id=:rfqs_id";
            $params = array('rfqs_id' => $rfqs_id);
            $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
            return $qresult;
        } catch (Exception $e) {
            echo $e->getMessage();
            return $e->getMessage();
        }
    }

}

?>
