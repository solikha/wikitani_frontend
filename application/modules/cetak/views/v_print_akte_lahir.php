<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); /* Manggu Framework * Simple PHP Application Development * Kusnassriyanto S. Bahri * kusnassriyanto@gmail.com * */
$function = new akte_lahir();

//print_r($dataakte_lahir); die;
?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <style>
            .headerPagedStart { 
                page: smallsquare; 
            } 
            .page1 { 
                page: page1; 
            } 
            .page2 { 
                page: page2; 
            } 
            .page3 { 
                page: page3; 
            } 
            .page4 { 
                page: page4; 
            } 
            @page smallsquare {   
                sheet-size: A4-L;
            } 
            @page page1 {    
                sheet-size: A4;
            }
            @page page2 {    
                sheet-size: A4;
            }
            @page page3 {    
                sheet-size: A4;
            }
            @page page4 {    
                sheet-size: A4;
            }
        </style>
        <div class="page1">
            <div style="padding: 12mm;">
                <img src="<?php echo $foto; ?>" style="height:25mm; width:25mm;padding-left: 70mm;" >
                <p style="text-align: center;font-size:15pt;"><b>KEDUTAAN BESAR REPUBLIK INDONESIA<br>
                        BRUSSEL</b></p>
                <div style="text-align: center;font-size:15pt;"><b>SURAT PERNYATAAN LAHIR</b></div>
                <div style="text-align: center;font-size:12pt;"><b>No : <?php echo $function->getdata($dataakte_lahir, 'surat_nomor') ?></b></div>
                <br>
                <br>
                <br>
                <br>
                <div align="justify" style="font-size:12pt;">
                    <b>Pada hari ini <?php echo $function->getdata($dataakte_lahir, 'tanggal_cetak_nama_hari') ?>, 
                    tanggal <?php echo $function->getdata($dataakte_lahir, 'tanggal_cetak_terbilang') ?> 
                    bulan <?php echo $function->getdata($dataakte_lahir, 'tanggal_cetak_bln') ?> tahun <?php echo $function->getdata($dataakte_lahir, 'tanggal_cetak_thn') ?> telah terdaftar dalam daftar pelaporan tentang kelahiran Warga Negara Indonesia yang berdasarkan kepada catatan Akte Kelahiran <?php echo $function->getdata($dataakte_lahir, 'tpt_keluar_akte') ?> 
                    No.<?php echo $function->getdata($dataakte_lahir, 'no_tpt_keluar_akte') ?> tertanggal <?php echo $function->getdata($dataakte_lahir, 'tgl_keluar_akte_hr') ?> <?php echo $function->getdata($dataakte_lahir, 'tgl_keluar_akte_bln') ?> <?php echo $function->getdata($dataakte_lahir, 'tgl_keluar_akte_thn') ?>.
                        <br>
                        <br>
                        Bahwa di <?php echo $function->getdata($dataakte_lahir, 'tempat_lahir') ?> pada hari <?php echo $function->getdata($dataakte_lahir, 'tgl_lahir_nama_hari') ?>, tanggal <?php echo $function->getdata($dataakte_lahir, 'tgl_lahir_hr') ?> bulan <?php echo $function->getdata($dataakte_lahir, 'tgl_lahir_bln') ?> tahun <?php echo $function->getdata($dataakte_lahir, 'tgl_lahir_thn') ?> telah lahir seorang anak bernama;</b>
                </div>
                <br>
                <div style="text-align: center;font-size:15pt;"><b><?php echo strtoupper($function->getdata($dataakte_lahir, 'nama')) ?></b></div>
                <br>
                <div align="justify" style="font-size:12pt;">
                    <b>anak <?php 
					if($function->getdata($dataakte_lahir, 'jenis_kelamin_anak')==2){
					echo "perempuan";
					}else if($function->getdata($dataakte_lahir, 'jenis_kelamin_anak')==1){
					echo "laki-Laki";
					}
					?> dari pasangan,
                        <br>
                        <br>
                        Suami;
                        <br>
                        <?php echo $function->getdata($dataakte_lahir, 'nama_ayah') ?>, seorang warga negara <?php echo $function->getdata($dataakte_lahir, 'wn_ayah');?>.
                        <br>
                        <br>
                        Istri;
                        <br>
                        <?php echo $function->getdata($dataakte_lahir, 'nama_ibu') ?>, seorang warga negara <?php echo $function->getdata($dataakte_lahir, 'wn_ibu');?>.
                    </b>
                </div>
                <br>
                <div style="padding-left: 85mm;text-align: center;">
                    <b>
                        <?php echo $function->getdata($dataakte_lahir, 'conf_kota') ?>, <?php echo $function->getdata($dataakte_lahir, 'tanggal_cetak_hr_angka') ?> <?php echo $function->getdata($dataakte_lahir, 'tanggal_cetak_bln') ?> <?php echo $function->getdata($dataakte_lahir, 'tanggal_cetak_thn_angka') ?>
                        <br>
                        A/n Kepala Perwakilan RI
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <?php echo $function->getdata($dataakte_lahir, 'nama_kepala_perwakilan_ri') ?>
                        <div style="height: 1px; width: 5mm; background-color:black;text-align: center;padding-left: 100mm"></div> 
                    </b>
                    <b>
                        <?php echo $function->getdata($dataakte_lahir, 'jabatan_kepala_perwakilan_ri') ?>
                    </b>
                </div>
            </div>
        </div>
    </body>
</html>
