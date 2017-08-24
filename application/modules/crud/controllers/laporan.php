<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class Laporan extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        echo 'Laporan Class Run';
    }

    function buildA2d($row, $col) {
        $result = array();
        for ($i = 0; $i < $row; $i++) {
            $xrow = array();
            for ($j = 0; $j < $col; $j++) {
                array_push($xrow, '&nbsp;');
            }
            array_push($result, $xrow);
        }
        return $result;
    }

    function kategori_wni() {
        $sql = "select id, nama, view_index from app_kategori_wni order by view_index ";
        return $this->mdb->QueryData('application', $sql, array(), 'record');
    }

    function IsiDataWNI($xarray, $bulan, $tahun) {
        $kategori_wni = $this->kategori_wni();
        $count = count($kategori_wni);
        for ($i = 0; $i < $count; $i++) {
            $xarray[$i][0] = $kategori_wni[$i]['view_index'] . '. ' . $kategori_wni[$i]['nama'];
        }
        $xarray[$count][0] = $count + 1 . '. JUMLAH';

        $qu = "select id, cast(data_wni as json)->>'kategoriwni' as kategori, 
		to_char(to_date(cast(data_wni as json)->>'birth_date', 'dd-mm-yyyy'),'mm-yyyy') as lahir,
		to_char(to_date(cast(data_wni as json)->>'tanggal_kembali', 'dd-mm-yyyy'),'mm-yyyy') as pulang,
		to_char(to_date(cast(data_wni as json)->>'pluar_tgl_keluar', 'dd-mm-yyyy'),'mm-yyyy') as hilang,
		to_char(last_update, 'mm-yyyy') as updates
		from app_wni 
		where 
		case when cast(cast(data_wni as json)->>'kategoriwni' as character varying) <> '' 
		then cast(cast(data_wni as json)->>'kategoriwni' as integer)else null end IS NOT NULL";
        $query_all = $this->mdb->QueryData('application', $qu, array(), 'record');

        $bln = $bulan - 1;
        $thbl_later = $this->mm($bln) . '-' . $tahun;
        $thbl_now = $this->mm($bulan) . '-' . $tahun;

        $kemaren = array();
        $lahir = array();
        $pulang = array();
        $hilang = array();
        $sekarang = array();
        foreach ($query_all as $key => $value) {
            if ($value['updates'] == $thbl_later) {
                $kemaren[] = $value['kategori'];
            }
            if ($value['lahir'] == $thbl_now) {
                $lahir[] = $value['kategori'];
            }
            if ($value['pulang'] == $thbl_now) {
                $pulang[] = $value['kategori'];
            }
            if ($value['hilang'] == $thbl_now) {
                $hilang[] = $value['kategori'];
            }
            if ($value['updates'] == $thbl_now) {
                $sekarang[] = $value['kategori'];
            }
        }

        $counts_kemaren = array_count_values($kemaren);
        foreach ($counts_kemaren as $v => $count_k) {
            for ($a = 0; $a < $count; $a++) {
                if ($kategori_wni[$a]['id'] == $v) {
                    $xarray[$a][1] = $count_k;
                }
            }
        }

        $counts_lahir = array_count_values($lahir);
        foreach ($counts_lahir as $v => $count_l) {
            for ($k = 0; $k < $count; $k++) {
                if ($kategori_wni[$k]['id'] == $v) {
                    $xarray[$k][3] = $count_l;
                }
            }
        }

        $counts_pulang = array_count_values($pulang);
        foreach ($counts_pulang as $v => $count_p) {
            for ($m = 0; $m < $count; $m++) {
                if ($kategori_wni[$m]['id'] == $v) {
                    $xarray[$m][4] = $count_p;
                }
            }
        }

        $counts_hilang = array_count_values($hilang);
        foreach ($counts_hilang as $v => $count_h) {
            for ($n = 0; $n < $count; $n++) {
                if ($kategori_wni[$n]['id'] == $v) {
                    $xarray[$n][5] = $count_h;
                }
            }
        }

        $counts_sekarang = array_count_values($sekarang);
        foreach ($counts_sekarang as $v => $count_se) {
            for ($s = 0; $s < $count; $s++) {
                if ($kategori_wni[$s]['id'] == $v) {
                    $xarray[$s][6] = $count_se;
                }
            }
        }

        $array_count_1[] = array();
        $array_count_2[] = array();
        $array_count_3[] = array();
        $array_count_4[] = array();
        $array_count_5[] = array();
        $array_count_6[] = array();
        for ($o = 0; $o < $count; $o++) {
            $xarray[$o][1] = $xarray[$o][1] + 0;
            $xarray[$o][2] = ($xarray[$o][3] + $xarray[$o][4] + $xarray[$o][5]) - $xarray[$o][6];
            $xarray[$o][3] = $xarray[$o][3] + 0;
            $xarray[$o][4] = $xarray[$o][4] + 0;
            $xarray[$o][5] = $xarray[$o][5] + 0;
            if ($xarray[$o][2] < 0) {
                $xarray[$o][6] = $xarray[$o][3] + $xarray[$o][4] + $xarray[$o][5] + $xarray[$o][6];
                $xarray[$o][2] = $xarray[$o][2] * 0;
            } else {
                $xarray[$o][6] = $xarray[$o][2] + $xarray[$o][3] + $xarray[$o][4] + $xarray[$o][5] + $xarray[$o][6];
            }
            $array_count_1[] = $xarray[$o][1];
            $array_count_2[] = $xarray[$o][2];
            $array_count_3[] = $xarray[$o][3];
            $array_count_4[] = $xarray[$o][4];
            $array_count_5[] = $xarray[$o][5];
            $array_count_6[] = $xarray[$o][6];
        }
        $sum_1 = array_sum($array_count_1);
        $sum_2 = array_sum($array_count_2);
        $sum_3 = array_sum($array_count_3);
        $sum_4 = array_sum($array_count_4);
        $sum_5 = array_sum($array_count_5);
        $sum_6 = array_sum($array_count_6);


        if (isset($query_all)) {
            $xarray[$count][1] = $sum_1;
            $xarray[$count][2] = $sum_2;
            $xarray[$count][3] = $sum_3;
            $xarray[$count][4] = $sum_4;
            $xarray[$count][5] = $sum_5;
            $xarray[$count][6] = $sum_6;
        }

        return $xarray;
    }

//pbaru_nomor
    function IsiDataSPRI($xarray, $bulan, $tahun) {
        $kategori_wni = $this->kategori_wni();
        $count = count($kategori_wni);

        $bln = $bulan - 1;
        $thbl_later = $this->mm($bln) . '-' . $tahun;
        $thbl_now = $this->mm($bulan) . '-' . $tahun;

//      COLOM 2

        $pass = "select b.id, a.status, b.layananid, b.sublayananid, a.no_paspor, a.pengadaanpasporid,
		to_char(c.tanggal,'mm-yyyy') as tanggal,
		to_char(to_date(cast(b.data_layanan as json)->>'pbaru_tgl_keluar', 'dd-mm-yyyy'),'mm-yyyy') as paspor_keluar,
		to_char(b.last_update, 'mm-yyyy') as updates
		from app_nomor_paspor a
		left join wni_layanan b on a.wni_layanan_id=b.id
		left join app_pengadaan_paspor c on c.id=a.pengadaanpasporid
		where a.pengadaanpasporid is not  null
		order by a.id";
        $qpaspor = $this->mdb->QueryData('application', $pass, array(), 'record');

        $paspor_kode = $this->colom2($qpaspor, $thbl_now, 1, 'bln_ini_pakai');
        $i = 0;
        foreach ($paspor_kode as $key_v => $value_v) {
            foreach ($value_v as $val) {
                $j = $i++;
                if (is_array($val)) {
                    $xarray[$j][12] = $key_v . '' . min($val) . ' s/d ' . $key_v . '' . max($val) . ' <br>jumlah ' . array_sum(array_count_values($val));
                } else {
                    $xarray[$j][12] = $key_v . '' . $val . ' <br>jumlah 1';
                }
            }
        }

        $paspor_kode1 = $this->colom2($qpaspor, $thbl_now, 0, 'bln_ini_blm_pakai');
        $i = 0;
        foreach ($paspor_kode1 as $key_v => $value_v) {
            foreach ($value_v as $val) {
                $j = $i++;
                if (is_array($val)) {
                    $xarray[$j][13] = $key_v . '' . min($val) . ' s/d ' . $key_v . '' . max($val);
                    $xarray[$j][14] = array_sum(array_count_values($val));
                } else {
                    $xarray[$j][13] = $key_v . '' . $val;
                    $xarray[$j][14] = 1;
                }
            }
        }

        $paspor_kode2 = $this->colom2($qpaspor, $thbl_now, 0, 'bln_ini_tambah');
        $i = 0;
        foreach ($paspor_kode2 as $key_v => $value_v) {
            foreach ($value_v as $val) {
                $j = $i++;
                if (is_array($val)) {
                    $xarray[$j][10] = $key_v . '' . min($val) . ' s/d ' . $key_v . '' . max($val);
                    $xarray[$j][11] = array_sum(array_count_values($val));
                } else {
                    $xarray[$j][10] = $key_v . '' . $val;
                    $xarray[$j][11] = 1;
                }
            }
        }

        $paspor_kode3 = $this->colom2($qpaspor, $thbl_later, 0, 'bln_lalu_blm_pakai');
        $i = 0;
        foreach ($paspor_kode3 as $key_v => $value_v) {
            foreach ($value_v as $val) {
                $j = $i++;
                if (is_array($val)) {
                    $xarray[$j][8] = $key_v . '' . min($val) . ' s/d ' . $key_v . '' . max($val);
                    $xarray[$j][9] = array_sum(array_count_values($val));
                } else {
                    $xarray[$j][8] = $key_v . '' . $val;
                    $xarray[$j][9] = 1;
                }
            }
        }
//      COLOM 3

        $sql = "select a.id, b.layananid, b.sublayananid, cast(a.data_wni as json)->>'kategoriwni' as kategori, 
		to_char(to_date(cast(data_wni as json)->>'birth_date', 'dd-mm-yyyy'),'mm-yyyy') as lahir,
		to_char(to_date(cast(a.data_wni as json)->>'paspor_tgl_keluar', 'dd-mm-yyyy'),'mm-yyyy') as ganti,
		to_char(a.last_update, 'mm-yyyy') as updates
		from app_wni a
		left join wni_layanan b on b.wniid=a.id
		where b.layananid=1 or b.layananid=2 or b.layananid=9";
        $qres = $this->mdb->QueryData('application', $sql, array(), 'record');

        $xarray[0] [15] = '1. Paspor RI 48 Halaman';
        $xarray[1] [15] = '2. Paspor RI 24 Halaman';
        $xarray[2] [15] = '3. SPLP RI Buku';
        $xarray[3] [15] = '4. Paspor Diplomatik';
        $xarray[4] [15] = '5. Paspor Dinas';
        $xarray[5] [15] = '6. SPLP Dinas';

        $lahir = array();
        $masa_b = array();
        $ru_hi = array();
        $per = array();
        $splp = array();
        foreach ($qres as $value) {
            if ($value['lahir'] == $thbl_now && $value['layananid'] == 2 && $value['sublayananid'] == 3) {
                $lahir[] = $value['layananid'];
            }
            if ($value['ganti'] == $thbl_now && $value['layananid'] == 1 && $value['sublayananid'] == 3) {
                $masa_b[] = $value['layananid'];
            }
            if ($value['ganti'] == $thbl_now && $value['layananid'] == 1 && ($value['sublayananid'] == 2 || $value['sublayananid'] == 4)) {
                $ru_hi[] = $value['layananid'];
            }
            if ($value['ganti'] == $thbl_now && $value['layananid'] == 1) {
                $per[] = $value['layananid'];
            }
            if ($value['lahir'] == $thbl_now && $value['layananid'] == 9) {
                $splp[] = $value['layananid'];
            }
        }

        $counts_lahir = array_count_values($lahir);
        $counts_masa_b = array_count_values($masa_b);
        $counts_ru_hi = array_count_values($ru_hi);
        $counts_per = array_count_values($per);
        $counts_splp = array_count_values($splp);

        if ($counts_lahir != NULL) {
            $i = $counts_lahir[2];
        } else {
            $i = 0;
        }
        if ($counts_masa_b != NULL) {
            $m = $counts_masa_b[1];
        } else {
            $m = 0;
        }
        if ($counts_ru_hi != NULL) {
            $r = $counts_ru_hi[1];
        } else {
            $r = 0;
        }
        if ($counts_per != NULL) {
            $p = $counts_per[1];
        } else {
            $p = 0;
        }
        if ($counts_splp != NULL) {
            $s = $counts_splp[9];
        } else {
            $s = 0;
        }

        $xarray[0] [16] = $i;
        $xarray[2] [16] = $s;

        $xarray[0] [17] = $m;
        $xarray[0] [18] = $r;
        $xarray[0] [19] = $p;
        return $xarray;
    }

    function colom2($array, $thbl_now, $status, $ket) {
//      pencarian paspor sesuai tanggal
        $dipakai = array();
        foreach ($array as $value) {
            if ($status == 0 && $ket == 'bln_ini_blm_pakai') {
                if ($value['tanggal'] == $thbl_now && $value['status'] == $status) {
                    $dipakai[] = $value['no_paspor'];
                }
            } elseif ($status == 1 && $ket == 'bln_ini_pakai') {
                if ($value['paspor_keluar'] == $thbl_now && $value['status'] == $status) {
                    $dipakai[] = $value['no_paspor'];
                }
            } elseif ($ket == 'bln_ini_tambah') {
                if ($value['tanggal'] == $thbl_now) {
                    $dipakai[] = $value['no_paspor'];
                }
            } elseif ($status == 0 && $ket == 'bln_lalu_blm_pakai') {
                if ($value['tanggal'] == $thbl_now && $value['status'] == $status) {
                    $dipakai[] = $value['no_paspor'];
                }
            }
        }

//      pemisah grup paspor
        $paspor_kode = array();
        foreach ($dipakai as $value) {
            if ($this->str_paspor($value)['ferix'] != null) {
                $paspor_kode[$this->str_paspor($value)['ferix']][] = $this->str_paspor($value)['digits'];
            }
        }

        $array_sd = array();
        foreach ($paspor_kode as $key_kode => $value_kode) {
            for ($i = 0; $i < count($value_kode); $i++) {
                if (count($value_kode) > 1) {
                    if ($i == 0 && ($value_kode[0] + 1) == $value_kode[1]) {
                        $array_sd[$key_kode][][] = $value_kode[$i];
                    } elseif (($i > 0 && $i < count($value_kode)) && ($value_kode[$i] - 1) == $value_kode[($i - 1)]) {
                        foreach ($array_sd[$key_kode] as $key => $values) {
                            if (is_array($values)) {
                                foreach ($values as $value) {
                                    if ($value == $value_kode[$i] - 1) {
                                        $k = $key;
                                    }
                                }
                            } else {
                                $k = $i;
                            }
                        }
                        $array_sd[$key_kode][$k][] = $value_kode[$i];
                    } elseif ($i == count($value_kode) - 1) {
                        $array_sd[$key_kode][] = $value_kode[$i];
                    } elseif (($i != 0 && $i < count($value_kode)) && ($value_kode[$i] + 1) == $value_kode[($i + 1)]) {
                        foreach ($array_sd[$key_kode] as $key2 => $values2) {
                            if (is_array($values2)) {
                                foreach ($values2 as $value2) {
                                    if ($value2 == $value_kode[$i] + 1) {
                                        $k2 = $key2;
                                    }
                                }
                            } else {
                                $k2 = $i;
                            }
                        }
                        $array_sd[$key_kode][$k2][] = $value_kode[$i];
                    } else {
                        $array_sd[$key_kode][] = $value_kode[$i];
                    }
                } else {
                    $array_sd[$key_kode][] = $value_kode[$i];
                }
            }
        }

        $array_view = array();
        foreach ($array_sd as $key_v => $value_v) {
            foreach ($value_v as $val) {
                if (is_array($val)) {
                    $array_view[1][] = $key_v . '' . min($val) . ' s/d ' . $key_v . '' . max($val);
                    $array_view[2][] = array_sum(array_count_values($val));
                } else {
                    $array_view[1][] = $key_v . '' . $val;
                    $array_view[2][] = 1;
                }
            }
        }

        return $array_sd;
    }

    function statistik_bulanan($bulan = '', $tahun = '') {
        $data = array();
        $filedata = 'data:image/png;base64,' . base64_encode(file_get_contents(BASEPATH . "../assets/images/email/garuda.png"));
        $data['garuda'] = $filedata;
        $qres = $this->kategori_wni();
        $count = count($qres) + 1; //ditambah row Jumlah
        $xarray = $this->buildA2d($count, 20);
        $xarray = $this->IsiDataWNI($xarray, $bulan, $tahun);
        $xarray = $this->IsiDataSPRI($xarray, $bulan, $tahun);
        $data['arrdata'] = $xarray;
        $data['bulan'] = $this->bulans($bulan);
        $data['tahun'] = $tahun;

        $html = $this->load->view("laporan/v_statistik_bulanan", $data, true);
        $this->load->library('m_pdf');
        $pdf = $this->m_pdf->load(array('mgt' => 28, 'mgh' => 10, "format" => "A4-L"));
        $pdfFilePath = 'laporan_stat_bul.pdf';

        $pdf->WriteHTML($html);
        $pdf->Output($pdfFilePath, "I");
    }

    function str_paspor($param) {
        if (ctype_digit($param[0]) == TRUE) {
            $ferix = '';
            $digits = $this->str($param)[0];
        } else {
            $ferix = $this->str($param)[0];
            $digits = $this->str($param)[1];
        }
        return array('ferix' => $ferix, 'digits' => $digits);
    }

    function str($param) {
        $key = $param;
        $pattern = "/(\d+)/";

        $array = preg_split($pattern, $key, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        return $array;
    }

    function bulans($param) {
        $bln = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember");
        for ($bulan = 0; $bulan <= 12; $bulan++) {
            if ($param == $bulan) {
                $month = $bln[$bulan - 1];
            }
        }
        return $month;
    }

    function mm($param) {
        if (strlen($param) == 1) {
            $m = '0' . $param;
        } elseif (strlen($param) == 2) {
            $m = $param;
        }
        return $m;
    }

}
