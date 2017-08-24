<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

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
	//param diisi tahun lengkap dd-mm-yyyy
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

   function terbilang($angka) {
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


?>
