<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Chart extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_chart', 'mchart');
    }

    function data_status() {
        $data['data_status'] = $this->mchart->data_status();
        $this->load->view('data_status', $data);
    }

    function data_kategori_wni() {
        $datas = $this->mchart->data_kategori_wni();
        $awal = array();
        $i = 0;
        foreach ($datas as $sth) {
            if ($i++ == 0) {
                $awal[] = 'x';
            }
            $awal[] = $sth['nama'];
        }

        $dua = array();
        $i = 0;
        foreach ($datas as $sh) {
            if ($i++ == 0) {
                $dua[] = "Data Kategori WNI";
            }
            $dua[] = (int) $sh['nilai'];
        }
        $arrayG = array($awal, $dua);
        $data['data_kategori_wni'] = json_encode($arrayG);
        $this->load->view('data_kategori_wni', $data);
    }

    function data_kelamin() {
        $datas = $this->mchart->data_kelamin();
        $awal = array();
        $i = 0;
        foreach ($datas as $sth) {
            if ($i++ == 0) {
                $awal[] = 'x';
            }
            $awal[] = $sth['nama'];
        }

        $dua = array();
        $i = 0;
        foreach ($datas as $sh) {
            if ($i++ == 0) {
                $dua[] = "Data Jenis Kelamin";
            }
            $dua[] = (int) $sh['nilai'];
        }
        $arrayG = array($awal, $dua);
        $data['data_kelamin'] = json_encode($arrayG);
        $this->load->view('data_kelamin', $data);
    }

    function layanan_all() {
        $datas = $this->mchart->layanan_all();
        $awal = array();
        $i = 0;
        foreach ($datas as $sth) {
            if ($i++ == 0) {
                $awal[] = 'x';
            }
            $awal[] = $sth['nama'];
        }

        $dua = array();
        $i = 0;
        foreach ($datas as $sh) {
            if ($i++ == 0) {
                $dua[] = "Data Semua Layanan";
            }
            $dua[] = (int) $sh['nilai'];
        }
        $arrayG = array($awal, $dua);
        $data['layanan_all'] = json_encode($arrayG);
        $this->load->view('layanan_all', $data);
    }

    function layanan_semua() {
        $datas = $this->mchart->layanan_all();
        $awal = array();
        $i = 0;
        foreach ($datas as $sth) {
            if ($i++ == 0) {
                $awal[] = 'x';
            }
            $awal[] = $sth['nama'];
        }

        $dua = array();
        $i = 0;
        foreach ($datas as $sh) {
            if ($i++ == 0) {
                $dua[] = "Data Semua Layanan";
            }
            $dua[] = (int) $sh['nilai'];
        }
        $arrayG = array($awal, $dua);
        $data['layanan_all'] = json_encode($arrayG);
        $data['layanan_name'] = $this->mchart->layanan_name();
        $this->load->view('layanan', $data);
    }

    function getdatalayanan($layanan, $starttahun) {
        try {
            if ($layanan === 'all') {
                $layanan_all = $this->mchart->layanan_all_tahun($starttahun);
                $awal = array();
                $i = 0;
                foreach ($layanan_all as $sth) {
                    if ($i++ == 0) {
                        $awal[] = 'x';
                    }
                    $awal[] = $sth['nama'];
                }

                $dua = array();
                $i = 0;
                foreach ($layanan_all as $sh) {
                    if ($i++ == 0) {
                        $dua[] = "Data Semua Layanan";
                    }
                    $dua[] = (int) $sh['nilai'];
                }
                $arrayG = array($awal, $dua);
                echo json_encode($arrayG);
            } else {
                $datas = $this->mchart->layanan_($layanan, $starttahun);
                $layanans = $this->mchart->layanan_name_where($layanan)[0];

                if ($datas == null) {
                    $jalan = '[["x"],["' . $starttahun . ' : ' . $layanans['nama'] . '"]]';
                } else {
                    $awal = array();
                    $i = 0;
                    foreach ($datas as $sth) {
                        if ($i++ == 0) {
                            $awal[] = 'x';
                        }
                        $awal[] = $this->bulan($sth['bulan']);
                    }

                    $dua = array();
                    $i = 0;
                    foreach ($datas as $sh) {
                        if ($i++ == 0) {
                            $dua[] = $starttahun . " : " . $layanans['nama'];
                        }
                        $dua[] = (int) $sh['nilai'];
                    }
                    $arrayG = array($awal, $dua);
                    $jalan = json_encode($arrayG);
                }
                echo $jalan;
            }
        } catch (Exception $exc) {
            echo 'data tidak ditemukan';
        }
    }

    function pay() {
        $data['layanan_name'] = $this->mchart->layanan_name();
        $data['layanan_all'] = $this->mchart->layanan_all();
        $this->load->view('chart', $data);
    }

    function bulan($param) {
        switch ($param) {
            case "01":
                $hasil = "Jan";
                break;
            case "02":
                $hasil = "Feb";
                break;
            case "03":
                $hasil = "Mar";
                break;
            case "04":
                $hasil = "Apr";
                break;
            case "05":
                $hasil = "May";
                break;
            case "06":
                $hasil = "Jun";
                break;
            case "07":
                $hasil = "Jul";
                break;
            case "08":
                $hasil = "Aug";
                break;
            case "09":
                $hasil = "Sep";
                break;
            case "10":
                $hasil = "Oct";
                break;
            case "11":
                $hasil = "Nov";
                break;
            case "12":
                $hasil = "Dec";
                break;
        }
        return $hasil;
    }

}

?>
