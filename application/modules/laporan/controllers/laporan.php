<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class laporan extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('tool_helper');
    }

    public function index() {
        
    }

    function getWN($idwn) {
        $sql = "select countryname from country where countryid = :idwn ";
        $params = array('idwn' => $idwn);
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qres[0])) {
            return $qres[0]['countryname'];
        }
        return '';
    }

    public function laporan_static_minggu($thn, $bulan) {
        $this->load->model('m_laporan', 'm_lp');
        if (isset($thn) && isset($bulan)) {
            $datakbri = $this->ci->config->item('kbri');
            $kotakbri = $datakbri['kota'];
            $layanan = $this->m_lp->layanan();
            $datas = array();
            for ($i = 0; $i < count($layanan); $i++) {
                $datas[$layanan[$i]['nama']] = $this->m_lp->laporan_static_minggu($thn, $bulan, $layanan[$i]['id']);
            }
            $result = array();
            foreach ($datas as $keyss => $valuess) {
                $val = array();
                $val['layanan'] = $keyss;
                foreach ($valuess as $in) {
                    $val['minggu' . $in['minggu']] = $in['count'];
                }
                array_push($result, $val);
            }
            $data['now'] = date('Y-m-d');
            $data['now_clock'] = date("H:i:s");
            $data['data_mingguan'] = $result;
            $data['tahun'] = $thn;
            $data['bulan'] = $this->bulans($bulan);
            $filedata = 'data:image/png;base64,' . base64_encode(file_get_contents(BASEPATH . "../assets/images/email/garuda.png"));
            $data['garuda'] = $filedata;
            $html = $this->load->view("v_laporan_mingguan_layanan", $data, true);
            $this->load->library('m_pdf');
            $pdf = $this->m_pdf->load(array('mgt' => 28, 'mgh' => 10, "format" => "A4"));
            $pdfFilePath = 'laporan_stat_bul.pdf';

            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "I");
        } else {
            echo "data tidak diketemukan.";
        }
    }

    public function laporan_transaksi_rekap($awal, $akhir) {
        $this->load->model('m_laporan', 'm_lp');
        if (isset($awal) && isset($akhir)) {
            $datakbri = $this->ci->config->item('kbri');
            $kotakbri = $datakbri['kota'];
            $layanan = $this->m_lp->layanan();
            $datas = array();
            for ($i = 0; $i < count($layanan); $i++) {
                $datas[$layanan[$i]['nama']] = $this->m_lp->laporan_transaksi_rekap($awal, $akhir, $layanan[$i]['id']);
            }
            $harga = $this->m_lp->harga_jenis_();
            $result = array();
            foreach ($datas as $keyss => $valuess) {
                $val = array();
                $val['layanan'] = $keyss;
                foreach ($valuess as $in) {
                    $val[$in['nama']] = $in['nilai'];
                    if ($in['layananid'] != null) {
                        for ($i = 0; $i < count($harga); $i++) {
                            if ($in['layananid'] == $harga[$i]['layananid']) {
                                $val['harga'] = $harga[$i]['nilai'];
                            }
                        }
                    }
                }
                array_push($result, $val);
            }
            $data['now'] = date('Y-m-d');
            $data['now_clock'] = date("H:i:s");
            $data['data_transaksi_rekap'] = $result;
            $data['awal'] = $awal;
            $data['akhir'] = $akhir;
            $filedata = 'data:image/png;base64,' . base64_encode(file_get_contents(BASEPATH . "../assets/images/email/garuda.png"));
            $data['garuda'] = $filedata;
            $html = $this->load->view("v_laporan_transaksi_rekap", $data, true);
            $this->load->library('m_pdf');
            $pdf = $this->m_pdf->load(array('mgt' => 28, 'mgh' => 10, "format" => "A4"));
            $pdfFilePath = 'laporan_stat_bul.pdf';

            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "I");
        } else {
            echo "data tidak diketemukan.";
        }
    }

    public function laporan_transaksi_detail($awal, $akhir, $lyn = '') {
        $this->load->model('m_laporan', 'm_lp');
        if (isset($awal) && isset($akhir)) {
            $datakbri = $this->ci->config->item('kbri');
            $kotakbri = $datakbri['kota'];
            $layanan = $this->m_lp->layanan();
            if ($lyn != NULL) {
                $datas = $this->m_lp->laporan_transaksi_detail($awal, $akhir, $lyn);
            } else {
                $datas = $this->m_lp->laporan_transaksi_detail_null($awal, $akhir);
            }
            $harga = $this->m_lp->harga_jenis_();
            $result = array();
            foreach ($datas as $keyss => $valuess) {
                $val = array();
                foreach ($valuess as $in => $vals) {
                    $val[$in] = $vals;
                    for ($i = 0; $i < count($harga); $i++) {
                        if ($vals == $harga[$i]['layananid']) {
                            $val['harga'] = $harga[$i]['nilai'];
                        }
                    }
                }
                array_push($result, $val);
            }
            $data['now'] = date('Y-m-d');
            $data['now_clock'] = date("H:i:s");
            $data['data_transaksi_detail'] = $result;
            $data['awal'] = $awal;
            $data['akhir'] = $akhir;
            $filedata = 'data:image/png;base64,' . base64_encode(file_get_contents(BASEPATH . "../assets/images/email/garuda.png"));
            $data['garuda'] = $filedata;
            $html = $this->load->view("v_laporan_transaksi_detail", $data, true);
            $this->load->library('m_pdf');
            $pdf = $this->m_pdf->load(array('mgt' => 28, 'mgh' => 10, "format" => "A4"));
            $pdfFilePath = 'laporan_stat_bul.pdf';

            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "I");
        } else {
            echo "data tidak diketemukan.";
        }
    }

    function searcharray($key, $val, $name) {
        $data = array();
        $data[$key][$name] = $val;
        return $data;
    }

    public function laporan_rekapitulasi($thn) {
        $this->load->model('m_laporan', 'm_lp');
        if (isset($thn)) {
            $datakbri = $this->ci->config->item('kbri');
            $kotakbri = $datakbri['kota'];
            $datas = $this->m_lp->laporan_rekapitulasi($thn);
            $harga = $this->m_lp->harga_jenis_();

            $array = array();
            foreach ($datas as $value) {
                $array[$this->bulans($value['bulan'])][$value['id']]['nama'] = $value['nama'];
                $array[$this->bulans($value['bulan'])][$value['id']]['count'] = $value['count'];
                for ($i = 0; $i < count($harga); $i++) {
                    if ($value['id'] == $harga[$i]['layananid']) {
                        $array[$this->bulans($value['bulan'])][$value['id']]['harga'] = $harga[$i]['nilai'];
                    }
                }
            }
//            print_r($array);die;

            $data['now'] = date('Y-m-d');
            $data['now_clock'] = date("H:i:s");
            $data['data_rekapitulasi'] = $array;
            $data['tahun'] = $thn;
            $filedata = 'data:image/png;base64,' . base64_encode(file_get_contents(BASEPATH . "../assets/images/email/garuda.png"));
            $data['garuda'] = $filedata;
            $html = $this->load->view("v_laporan_rekapitulasi", $data, true);
            $this->load->library('m_pdf');
            $pdf = $this->m_pdf->load(array('mgt' => 28, 'mgh' => 10, "format" => "A4"));
            $pdfFilePath = 'laporan_stat_bul.pdf';

            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "I");
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

    function bulans($param) {
        $bln = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
        for ($bulan = 0; $bulan <= 12; $bulan++) {
            if ($param == $bulan) {
                $month = $bln[$bulan-1];
            }
        }
        return $month;
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

    function getdata_td($param, $array) {

        if (isset($param[$array])) {
            $val = $param[$array];
        } else {
            $val = '';
        }
        return $val;
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
