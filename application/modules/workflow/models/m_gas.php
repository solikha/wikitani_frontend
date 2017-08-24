<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class m_gas extends MY_Model {

    var $workflowdata;
    var $processname;
    var $processcategory;
    var $username = 'public';
    var $view_workflow;
    var $edit_workflow;
    var $url_final_draft;
    var $url_final_verify;
    var $workflowid = '';
    var $wfmode = '';
    var $wfdbdata;

    public function __construct() {
        parent::__construct();
        $this->load->library('user_agent');
        $this->view_workflow = base_url() . index_page() . '/menu/viewworkflow';
        $this->edit_workflow = base_url() . index_page() . '/menu/editworkflow';
        $this->url_final_draft = base_url() . index_page() . '/menu/list_permohonan_inspeksi';
        $this->url_final_verify = base_url() . index_page() . '/menu/persetujuan_admin';
    }

    function quotc($id) {
        $param = array('id' => $id);
        $sql = "select a.id, c.part_number,c.description, e.condition,a.qty ,a.uom, a.price, a.delivery, a.remark,
            sum(a.price * a.qty) as total
            from app_detail_quot_c a 
            left join app_supplier b on a.supplier_id=b.id 
            left join app_parts c on c.id=a.part_id 
            left join app_condition e on e.id=a.condition_id
            where a.quot_c_id=:id group by a.id, b.id, c.id, e.id";
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record');
        return $qresult;
    }

    function data_quotc($id) {
        $param = array('id' => $id);
        $sql = "select b.rfq_number, to_char(a.date,'MONDD/YYYY') as quotation_date, to_char(b.date,'MONDD/YYYY') as rfq_date,
            e.terms as terms_id, b.requirement, a.quot_no, c.name, c.phone, c.fax, trim(to_char(a.freight, '999,999,999,999,999')) as freight, a.freight_description,
            c.addres, a.ship_to as ship_to_name, a.ship_to_addr as ship_to_address, d.email, d.reff, to_char(a.valid_to, 'MONDD/YYYY') as valid_to,
			f.incoterms as incoterms_id, a.incoterms_text
            from app_quotc a 
            left join app_rfqc b on a.rfqc_id=b.id 
            left join app_customer c on a.cust_id=c.id 
            left join app_cust_contact d on d.cust_id=c.id 
			left join app_terms e on a.terms_id=e.id 
			left join app_incoterms f on a.incoterms_id=f.id 
            where a.id=:id 
            group by a.id, b.id, c.id, d.id, e.id, f.id";
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record');
        return $qresult;
    }

    function total($id) {
        $param = array('id' => $id);
        $sql = "select trim(to_char(sum(total), '999,999,999,999,999')) as total_c,
       trim(to_char(sum(total)+freight, '999,999,999,999,999')) as total_c_freight
        from (select f.freight, a.id, sum(a.price * a.qty) as total
            from app_detail_quot_c a 
            left join app_supplier b on a.supplier_id=b.id 
            left join app_parts c on c.id=a.part_id 
            left join app_condition e on e.id=a.condition_id
            left join app_quotc f on f.id=a.quot_c_id
            where a.quot_c_id=:id group by a.id, b.id, c.id, e.id, f.id) a
			group by freight";
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record');
        return $qresult;
    }

    public function get_suppliercontact($supplier_id) {
        $params = array('supplier_id' => $supplier_id);
        $sql = "select id,email from app_supplier where id=:supplier_id";
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        return $qresult;
    }

    function to_invoice($id) {
        $params = array('id' => $id);
        $sql = "select to_invoice as invoice_names, address as invoice_addresss, contact_name as invoice_contact_names, 
            phone as invoice_phones, email as invoice_emails, fax as invoice_faxs 
            from app_invoice_to where cust_invoice_id=:id";
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        return $qresult;
    }

    function to_invoice_po($id) {
        $params = array('id' => $id);
        $sql = "select a.id as invoice_id, a.inv_no, a.date as invoice_date, b.po_number, b.date, b.invoice_name as invoice_names, 
            b.invoice_address as invoice_addresss, b.invoice_contact_name as invoice_contact_names, b.invoice_phone as invoice_phones, 
            b.invoice_fax as invoice_faxs, b.invoice_email as invoice_emails, c.status, trim(to_char(d.total_price, '999,999,999,999,999')) as total_price, 
            e.payment, e.description as payment_description 
            from app_cust_invoice a 
            left join app_cust_po b on b.id=a.cust_po_id 
            left join app_status c on c.id=a.status_id 
            left join (select cust_invoice_id, sum(qty * price) as total_price 
            from app_cust_invoice_dt group by cust_invoice_id) d on d.cust_invoice_id=a.id 
            left join app_payment e on e.id=a.payment_id 
            where a.id=:id";
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        return $qresult;
    }

}

?>
