<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_export extends MY_Model {

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

    function export($id) {
        $param = array('id' => $id);
        $sql = 'select b.id, b.supp_po_id, b.part_id, b.qty, b.uom, b.delivery, b.unit_price, sum(b.qty * b.unit_price) as subtotal, c.part_number, c.description, d.price, sum(b.qty * d.price) as q_subtotal, g.condition
		FROM app_supp_po a 
		left join app_supp_po_dt b on a.id=b.supp_po_id 
        left join app_parts c on c.id=b.part_id 
        left join (select b.id, d.price from app_supp_po a  
        left join app_supp_po_dt b on b.supp_po_id=a.id  
        left join app_quots c on c.id=a.quots_id  
        left join app_detail_quot_s d on d.quot_s_id=c.id 
        where d.part_id=b.part_id and d.condition_id=b.condition_id) d on d.id=b.id 
        left join app_condition g on g.id=b.condition_id 
        where b.supp_po_id=:id 
        group by a.id, b.id, d.id, c.id, d.price, g.id 
        order by b.id';
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record');
        return $qresult;
    }

    function data_export($id) {
        $param = array('id' => $id);
        $sql = "select a.id as po_supp_id, a.po_number, to_char(a.date,'MONDD/YYYY') as date_format, i.incoterms as incoterms_idx, a.incoterms_text,
		a.reference, to_char(a.reference_date, 'MONDD/YYYY') as reference_datex, a.quots_id, a.requirement, d.name as supp_name, d.id as supplier_id, d.attn,
		d.addres as supp_addres, a.ship_to, a.ship_to_address, a.invoice_to, a.invoice_to_address, c.date as quotation_date, 
		c.quotation_no as quotation_number, c.rfqs_id, d.bank_address, b.po_number as cust_po_number, b.date as cust_po_date, 
		f.name as cust_name, trim(to_char(sum(e.sub), '999,999,999,999,999')) as total,  h.currency, g.terms as terms_idx, a.shipping_arrangement, a.ship_phone,
		a.ship_fax, a.ship_name, a.inv_phone, a.inv_fax, a.inv_name, d.phone, d.fax, a.*
        FROM app_supp_po a 
		left join app_cust_po b on b.id=a.cust_po_id 
        left join app_customer f on f.id=b.cust_id
		left join app_terms g on g.id=a.terms_id  
        left join app_quots c on c.id=a.quots_id 
        left join app_supplier d on d.id=a.supplier_id 
		left join app_currency h on h.id=a.currency_id 
		left join app_incoterms i on a.incoterms_id=i.id 
        left join (select a.id, sum(b.subtotal) as sub 
            from app_supp_po a 
            left join (select b.supp_po_id, sum(b.qty * b.unit_price) as subtotal 
                from app_supp_po a 
                left join app_supp_po_dt b on a.id=b.supp_po_id 
                left join app_parts c on c.id=b.part_id 
                where b.supp_po_id=:id 
                group by a.id, b.id)b on b.supp_po_id=a.id 
                    where a.id=:id group by a.id, b.subtotal) e on e.id=a.id 
                    where a.id=:id group by a.id, b.id, c.id, d.id, e.id, f.id, g.id, h.id, i.id";
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record');
        return $qresult;
    }

}

?>
