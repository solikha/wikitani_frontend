<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class ganti_alamat extends Print_Controller {
	 public function __construct(){
        parent::__construct();
      //  $this->load->model('m_workflow', 'wflow');
       // $this->load->library('mustache');
		 $this->load->helper('tool_helper');
    }
	
    public function index(){
		
    }
	
    public function cetak($position) {
        $this->load->model('m_cetak_alamat', 'mcetakalamat');
        // $kakanwil = $this->mlampirani->getKakanwil($data['id_provinsi']);
        if (isset($_GET['lyn_id'])){
            $lyn_id = $_GET['lyn_id'];
            $datakbri = $this->ci->config->item('kbri');
            $kotakbri = $datakbri['kota'];
            $datalayanan = $this->mcetakalamat->loadWniLayanan($lyn_id);
            //$this->load->helper('url');
            //print_r($datalayanan); die();
            $data['datalayanan'] = $datalayanan;
            $data['data_pencetakan'] = array("kota" => $kotakbri, "tanggal_cetak" => "2005-05-05");
            if ($position == "kiri") {
                //peringatan parameter $data,true wajib dilampirkan
                $html = $this->load->view("v_ganti_alamat_kiri", $data, true);
            } elseif ($position == "kanan") {
                $html = $this->load->view("v_ganti_alamat_kanan", $data, true);
            } else {
                echo "mohon kirim parameter kiri atau kanan";
            }
			//echo $html; die();
            $this->load->library('m_pdf_landscape');
            $pdf = $this->m_pdf_landscape->load();
            //$pdfFilePath = "the_pdf_output.pdf";
			$pdfFilePath = "Amandemen Ganti Alamat ".getArrayDef($datalayanan,'pemohon').".pdf";
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "I");
            // $pdf->Output($pdfFilePath, "F");
        } else {
            echo "data tidak diketemukan.";
        }
    }

}

?>
