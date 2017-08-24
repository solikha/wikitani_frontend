<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); /* Manggu Framework * Simple PHP Application Development * Kusnassriyanto S. Bahri * kusnassriyanto@gmail.com * */
$function = new cetak_menikah();
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
                <p style="text-align: center;font-size:12pt;"><b>KEDUTAAN BESAR REPUBLIK INDONESIA<br>
                        <?php echo $function->getdata($datacetak_menikah, 'conf_kota') ?></b></p>
                <div style="text-align: center;font-size:15pt;"><b>SURAT KETERANGAN PERKAWINAN</b></div>
                <div style="width:100%; height:1px; background:black;"></div>
                <div style="text-align: center;font-size:12pt;"><b>No : <?php echo $function->getdata($datacetak_menikah, 'no_surat_ket_menikah') ?></b></div>
                <br>
                <br>
                <br>
                <div align="justify" style="font-size:12pt;">
                    <b>Kedutaan Besar Republik Indonesia di <?php echo $function->getdata($datacetak_menikah, 'conf_kota') ?> dengan ini menerangkan, bahwa:</b>
                </div>
                <br>
                <table style="font-size:12pt;">
                    <tr>
                        <td>
                            <b>Nama</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <b><?php echo $function->getdata($datacetak_menikah, 'pemohon') ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tempat dan Tanggal Lahir</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <b><?php echo $function->getdata($datacetak_menikah, 'birth_place') ?>, <?php echo $function->getdata($datacetak_menikah, 'birth_date') ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Pekerjaan</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <b><?php echo $function->getdata($datacetak_menikah, 'pkjaan_nama') ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Pemegang paspor RI no.</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <b><?php echo $function->getdata($datacetak_menikah, 'paspor_nomor') ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Kantor yg mengeluarkan</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <b><?php echo $function->getdata($datacetak_menikah, 'paspor_tpt_keluar') ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Berlaku s/d tanggal</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <b><?php echo $function->getdata($datacetak_menikah, 'paspor_berlaku') ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">
                            <b>Alamat di Jerman</b>
                        </td>
                        <td style="vertical-align: top">
                            :
                        </td>
                        <td>
                            <b><?php echo $function->getdata($datacetak_menikah, 'aluar_alamat') ?><br><?php echo $function->getdata($datacetak_menikah, 'aluar_kota') ?><br><?php echo $function->getdata($datacetak_menikah, 'aluar_kodepos') ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">
                            <b>Alamat di Indonesia</b>
                        </td>
                        <td style="vertical-align: top">
                            :
                        </td>
                        <td>
                            <b><?php echo $function->getdata($datacetak_menikah, 'aindo_alamat') ?><br><?php echo $function->getdata($datacetak_menikah, 'aindo_kota') ?><br><?php echo $function->getdata($datacetak_menikah, 'aindo_kodepos') ?></b>
                        </td>
                    </tr>
                </table>
                <div align="justify" style="font-size:12pt;">
                    <b>telah melaporkan perkawinannya dengan <?php echo $function->getdata($datacetak_menikah, 'pasangan_nama') ?> (Warga Negara Jerman) pada Kedutaan Besar Indonesia di <?php echo $function->getdata($datacetak_menikah, 'conf_kota') ?> berdasarkan Akta Perkawinan no.<?php echo $function->getdata($datacetak_menikah, 'akta_nomor_perkawinan') ?> yang dikeluarkan oleh Catatan Sipil di <?php echo $function->getdata($datacetak_menikah, 'akta_kota') ?> pada tanggal <?php echo $function->getdata($datacetak_menikah, 'akta_tanggal') ?>.
                        <br>
                        <br>
                        Demikian Surat Keterangan ini dibuat untuk dapat digunakan sebagaimana mestinya.
                    </b>
                </div>
                <br>
                <div style="padding-left: 85mm;text-align: center;">
                    <b>
                        <?php echo $function->getdata($datacetak_menikah, 'conf_kota') ?>, <?php echo $function->getdata($datacetak_menikah, 'tgl_surat_ket') ?>
                        <br>
                        A/n Kepala Perwakilan RI
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <?php echo $function->getdata($datacetak_menikah, 'nama_kepala_perwakilan_ri') ?>
                        <div style="height: 1px; width: 5mm; background-color:black;text-align: center;padding-left: 100mm"></div> 
                    </b>
                    <b>
                        <?php echo $function->getdata($datacetak_menikah, 'jabatan_kepala_perwakilan_ri') ?>
                    </b>
                </div>
            </div>
        </div>
    </body>
</html>
