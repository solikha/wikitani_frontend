<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class akte_lahir extends Print_Controller {

    public function __construct() {
        parent::__construct();
        //  $this->load->model('m_workflow', 'wflow');
        // $this->load->library('mustache');
        $this->load->helper('url');
        $this->load->helper('tool_helper');
    }

    public function index() {
        
    }

    function getWN($idwn){
        $sql = "select countryname from country where countryid = :idwn ";
        $params = array('idwn'=>$idwn);
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qres[0])){
            return $qres[0]['countryname']; 
        }
        return '';
    }

    public function cetak() {
        $this->load->model('m_cetak_akte_lahir', 'mcetakakte_lahir');
        if (isset($_GET['lyn_id'])) {
            $lyn_id = $_GET['lyn_id'];
            $datakbri = $this->ci->config->item('kbri');
            $dataakte_lahir = $this->mcetakakte_lahir->loadWniLayanan($lyn_id);
            $filename = FCPATH . "themes" . DIRECTORY_SEPARATOR . "aceadmin" . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . "garuda2.png";
            $filenames = 'data:image/png;base64,' . base64_encode(file_get_contents(BASEPATH . "../themes/aceadmin/images/garuda2.png"));

            $data['foto'] = $filename;

            if (isset($dataakte_lahir)) {
			//echo "<pre>";
			//print_r($dataakte_lahir); die();
			//echo "<pre>";
			//echo $this->nama_hari(getArrayDef($dataakte_lahir,'surat_tgl_cetak')); die();
			/*
                $field = array();
                foreach ($dataakte_lahir as $key => $value) {
                    if ($key == 'tgl_lahir') {
                        if (isset($value)) {
                            $field['tgl_lahir_nama_hari'] = $this->nama_hari($value);
                            $field['tgl_lahir_hr'] = $this->terbilang($this->hari($value));
                            $field['tgl_lahir_bln'] = $this->bulan($value);
                            $field['tgl_lahir_thn'] = $this->terbilang($this->tahun($value));
                        }
                    }
                    if ($key == 'tanggal_cetak') {
                        if (isset($value)) {
                            $field['tanggal_cetak_nama_hari'] = $this->nama_hari($value);
                            $field['tanggal_cetak_hr'] = $this->terbilang($this->hari($value));
                            $field['tanggal_cetak_bln'] = $this->bulan($value);
                            $field['tanggal_cetak_thn'] = $this->terbilang($this->tahun($value));
                            $field['tanggal_cetak_hr_angka'] = $this->hari($value);
                            $field['tanggal_cetak_thn_angka'] = $this->tahun($value);
                        }
                    }
                    if ($key == 'tgl_keluar_akte') {
                        if (isset($value)) {
                            $field['tgl_keluar_akte_nama_hari'] = $this->nama_hari($value);
                            $field['tgl_keluar_akte_hr'] = $this->terbilang($this->hari($value));
                            $field['tgl_keluar_akte_bln'] = $this->bulan($value);
                            $field['tgl_keluar_akte_thn'] = $this->terbilang($this->tahun($value));
                        }
                    }
                    $field['nama_kepala_perwakilan_ri'] = $datakbri['nama_kepala_perwakilan_ri'];
                    $field['jabatan_kepala_perwakilan_ri'] = $datakbri['jabatan_kepala_perwakilan_ri'];
                    $field['conf_kota'] = $datakbri['kota'];
                    $field[$key] = $value;
                }
				*/
//            echo json_encode($field);
//            die;
			//echo $this->nama_hari(getArrayDef($dataakte_lahir,'surat_tgl_cetak')); die();
           $data_surat=array(
				"surat_nomor"    			 =>getArrayDef($dataakte_lahir,'surat_nomor'),
				"tanggal_cetak_nama_hari"    =>$this->nama_hari(getArrayDef($dataakte_lahir,'surat_tgl_cetak')),
				"tanggal_cetak_terbilang"    =>$this->terbilang($this->hari(getArrayDef($dataakte_lahir,'surat_tgl_cetak'))),
				"tanggal_cetak_bln"       	 =>$this->bulan(getArrayDef($dataakte_lahir,'surat_tgl_cetak')),
				"tanggal_cetak_thn"       	 =>$this->terbilang((float)$this->tahun(getArrayDef($dataakte_lahir,'surat_tgl_cetak'))),
				"tpt_keluar_akte"            =>getArrayDef($dataakte_lahir,'akte_tpt_keluar'),
				"no_tpt_keluar_akte"         =>getArrayDef($dataakte_lahir,'akte_nomor'),
				"tgl_keluar_akte_hr"         =>$this->terbilang($this->hari(getArrayDef($dataakte_lahir,'akte_tgl_keluar'))),
				"tgl_keluar_akte_bln"        =>$this->bulan(getArrayDef($dataakte_lahir,'akte_tgl_keluar')),
				"tgl_keluar_akte_thn"        =>$this->terbilang((float)$this->tahun(getArrayDef($dataakte_lahir,'akte_tgl_keluar'))),
				"tempat_lahir"               =>getArrayDef($dataakte_lahir,'birth_place'),
				"tgl_lahir_nama_hari"        =>$this->nama_hari(getArrayDef($dataakte_lahir,'birth_date')),
				"tgl_lahir_hr"               =>$this->terbilang((float)$this->hari(getArrayDef($dataakte_lahir,'birth_date'))),
				"tgl_lahir_bln"              =>$this->bulan(getArrayDef($dataakte_lahir,'birth_date')),
				"tgl_lahir_thn"              =>$this->terbilang((float)$this->tahun(getArrayDef($dataakte_lahir,'birth_date'))),
				"nama"                       =>getArrayDef($dataakte_lahir,'full_name'),
				"jenis_kelamin_anak"         =>getArrayDef($dataakte_lahir,'jenkelid'),
				"nama_ayah"                  =>getArrayDef($dataakte_lahir,'ayah_nama'),
				"nama_ibu"                   =>getArrayDef($dataakte_lahir,'ibu_nama'),
				"wn_ayah"                    =>$this->getWN(getArrayDef($dataakte_lahir,'kewarganegaraan_ayah')),
				"wn_ibu"                     =>$this->getWN(getArrayDef($dataakte_lahir,'kewarganegaraan_ibu')),
				"conf_kota"                  =>getArrayDef($datakbri,'kota'),
				"tanggal_cetak_hr_angka"     =>$this->hari(getArrayDef($dataakte_lahir,'surat_tgl_cetak')),
				"tanggal_cetak_bln"          =>$this->bulan(getArrayDef($dataakte_lahir,'surat_tgl_cetak')),
				"tanggal_cetak_thn_angka"    =>$this->tahun(getArrayDef($dataakte_lahir,'surat_tgl_cetak')),
				"nama_kepala_perwakilan_ri"  =>getArrayDef($datakbri,'nama_kepala_perwakilan_ri'),
				"jabatan_kepala_perwakilan_ri"=>getArrayDef($datakbri,'jabatan_kepala_perwakilan_ri')
				
		  ); 
				//kode lama $data['dataakte_lahir'] = $field;
				//echo "<pre>";
				  //print_r($field); 
				//echo "<pre>"; die();
				$data['dataakte_lahir'] = $data_surat;
                $html = $this->load->view("v_print_akte_lahir", $data, true);
                $this->load->library('m_pdf');
                $pdf = $this->m_pdf->load();
                $name_file = $this->getdata($dataakte_lahir, 'nama');
                if (isset($name_file)) {
                    $nama = '_'.$name_file;
                } else {
                    $nama = '';
                }

                if (file_exists($filenames)) {
                    $pdf->Image($filenames, 100, 48, 20, 20, "png", '', true, false);
                }

                $pdfFilePath = 'akte_lahir' . $nama . '.pdf';
					
                $pdf->WriteHTML($html);
                $pdf->Output($pdfFilePath, "I");
            }
            echo "data tidak diketemukan.";
        } else {
            echo "data tidak diketemukan.";
        }
    }

    function nama_hari($tanggal) {

        $tanggals = date('D-m-Y', strtotime($tanggal));

        $tgl = substr($tanggals, 0, 3);

        switch ($tgl) {
            case 'Sun': return "Minggu";
                break;
            case 'Mon': return "Senin";
                break;
            case 'Tue': return "Selasa";
                break;
            case 'Wed': return "Rabu";
                break;
            case 'Thu': return "Kamis";
                break;
            case 'Fri': return "Jumat";
                break;
            case 'Sat': return "Sabtu";
                break;
        };
    }

    function hari($param) {
        if (isset($param)) {
            $time = strtotime($param);
            $day = date('d', $time);
        } else {
            $day = '';
        }
        return $day;
    }

    function bulan($param) {
        if (isset($param)) {
            $time = strtotime($param);
            $months = date('m', $time);
            $bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
            for ($bulan = 01; $bulan <= 12; $bulan++) {
                if ($months == $bulan) {
                    $month = $bln[$bulan];
                }
            }
        } else {
            $month = '';
        }
        return $month;
    }

    function tahun($param) {
        if (isset($param)) {
            $time = strtotime($param);
            $year = date('Y', $time);
        } else {
            $year = '';
        }
        return $year;
    }

    function getdata($param, $array) {

        if (isset($param[$array])) {
            $val = $param[$array];
        } else {
            $val = '';
        }
        return $val;
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
