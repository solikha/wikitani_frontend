<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class pembayaran extends Print_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('tool_helper');
    }

    public function index() {
        $this->load->model('m_pembayaran', 'mpembayaran');
        if (isset($_GET['lyn_id'])) {
            $lyn_id = $_GET['lyn_id'];
            $datakbri = $this->ci->config->item('kbri');
            $datalayanan = $this->mpembayaran->loadWniLayanan($lyn_id);
            if ($datalayanan != NULL) {
//                echo json_encode($datakbri) . '<br>';
//                echo json_encode($datalayanan);
//                die;
                $data['data_cetak_kwitansi'] = $datalayanan;
                $data['cetak_kwitansi'] = array(
                    "nama_permohonan_data_kwitansi" => "Data Pemohon",
                    "alamat1" => $datakbri['alamat1'],
                    "alamat2" => $datakbri['alamat2'],
                    "kota" => $datakbri['kota'],
                    "phone" => $datakbri['phone'],
                    "fax" => $datakbri['fax'],
                    "tempat_pembuatan_kwitansi_data_kwitansi" => $datakbri['kota'],
					"kwitansi_nama"=>$datakbri['kwitansi_nama'],
					"kwitansi_jabatan"=>$datakbri['kwitansi_jabatan'],
					"kwitansi_nip"=>$datakbri['kwitansi_nip'],
                    "petugas_kbri_data_kwitansi" => "",
					"kwitansi_mengetahui_nama"=>$datakbri['kwitansi_mengetahui_nama'],
					"kwitansi_mengetahui_jabatan"=>$datakbri['kwitansi_mengetahui_jabatan'],
					"kwitansi_mengetahui_nip"=>$datakbri['kwitansi_mengetahui_nip']
                );
                $html = $this->load->view("v_cetak_kuitansi", $data, true);
                $this->load->library('m_pdf');
                $pdf = $this->m_pdf->load();
                if (isset($datalayanan['pemohon'])) {
                    $pemohon = '_' . $datalayanan['pemohon'];
                } else {
                    $pemohon = '';
                }
                $pdfFilePath = "pembayaran" . $pemohon . ".pdf";
                $pdf->WriteHTML($html);
                $pdf->Output($pdfFilePath, "I");
            } else {
                $alert = "data tidak diketemukan.";
            }
        } else {
            $alert = "data tidak diketemukan.";
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