<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class print_avidafit extends Print_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('tool_helper');
		$this->load->helper('indonesian_convertion_helper');
    }

    public function cetak($posisi) {
	//echo "print ok"; die();
        $this->load->model('m_print_avidafit', 'mprint_avidafit');
        if (isset($_GET['lyn_id'])) {
            $data['posisi']=$posisi;
           // $data['top']="height: ".$_GET['top']."mm;";
           //$data['padding_left']="padding-left: ".$_GET['left']."mm;";
            $lyn_id = $_GET['lyn_id'];
            $datakbri = $this->ci->config->item('kbri');
			//print_r($datakbri); die();
           // $kotakbri = $datakbri['kota'];
            $datalayanan = $this->mprint_avidafit->loadWniLayanan($lyn_id);
            $data['datalayanan'] = $datalayanan;
			//print_r($datalayanan); die();
			
			$data['dataconfig']=$datakbri;
			if($posisi=="kiri"){
            $html = $this->load->view("v_print_avidafit _kiri", $data, true);
			}else if($posisi=="kanan"){
			$html = $this->load->view("v_print_avidafit _kanan", $data, true);
			}
           //echo $html; die();
            $this->load->library('m_pdf_landscape');
            $pdf = $this->m_pdf_landscape->load();
           // $pdfFilePath = "the_pdf_output.pdf";
            $pdfFilePath = "print_avidafit.pdf";
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "I");
        } else {
            echo "data tidak diketemukan.";
        }
    }

    function getdata($param, $array) {
        if (array_key_exists($param, $array)) {
            $val = $array[$param];
        } else {
            $val = '';
        }
        return $val;
    }

    public function rupiah($angka) {
        $rupiah = number_format($angka, 2, ',', '.');
        return $rupiah;
    }

    public function terbilang($angka) {
        $angka = (float) $angka;
        $bilangan = array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas');
        if ($angka < 12) {
            return $bilangan[$angka];
        } else if ($angka < 20) {
            return $bilangan[$angka - 10] . ' Belas';
        } else if ($angka < 100) {
            $hasil_bagi = (int) ($angka / 10);
            $hasil_mod = $angka % 10;
            return trim(sprintf('%s Puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
        } else if ($angka < 200) {
            return sprintf('Seratus %s', $this->terbilang($angka - 100));
        } else if ($angka < 1000) {
            $hasil_bagi = (int) ($angka / 100);
            $hasil_mod = $angka % 100;
            return trim(sprintf('%s Ratus %s', $bilangan[$hasil_bagi], $this->terbilang($hasil_mod)));
        } else if ($angka < 2000) {
            return trim(sprintf('Seribu %s', $this->terbilang($angka - 1000)));
        } else if ($angka < 1000000) {
            $hasil_bagi = (int) ($angka / 1000);
            $hasil_mod = $angka % 1000;
            return sprintf('%s Ribu %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod));
        } else if ($angka < 1000000000) {
            $hasil_bagi = (int) ($angka / 1000000);
            $hasil_mod = $angka % 1000000;
            return trim(sprintf('%s Juta %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else if ($angka < 1000000000000) {
            $hasil_bagi = (int) ($angka / 1000000000);
            $hasil_mod = fmod($angka, 1000000000);
            return trim(sprintf('%s Milyar %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else if ($angka < 1000000000000000) {
            $hasil_bagi = $angka / 1000000000000;
            $hasil_mod = fmod($angka, 1000000000000);
            return trim(sprintf('%s Triliun %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
        } else {
            return 'Data Salah';
        }
    }

}

?>