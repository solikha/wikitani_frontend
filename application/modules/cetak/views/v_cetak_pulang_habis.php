<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); /* Manggu Framework * Simple PHP Application Development * Kusnassriyanto S. Bahri * kusnassriyanto@gmail.com * */
$function = new pulang_habis();
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
            <div style="<?php echo $top;?>"></div>
            <div style="<?php echo $padding_left;?>">
                <table rotate="-90" style="width: 70mm;font-size:9pt;">
                    <?php 
                    echo $posisi;
                    if ($posisi=='kiri') {
                    ?>
                    <tr>
                        <td>AMENDMENT :</td>
                    </tr>
                    <tr>
                        <td>PEMEGANG PASPOR TELAH MELAPORKAN <br/>DIRI APADA KBRI DAN HAAG UNTUK <br/>KEMABLI KE INDONESIA SETERUSNYA <br/>DENGAN ALAMAT :</td>
                    </tr>
                    <tr>
                        <td><br/><?php echo $function->getdata("alamat_id", $datalayanan); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $function->getdata("kota_kab_id", $datalayanan) . ' - ' . $function->getdata("kodepos_id", $datalayanan); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $function->getdata("negara_id", $datalayanan); ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div style="<?php echo $padding_left;?>">
                <table rotate="-90" style="width: 77mm;font-size:9pt;">
                    <?php 
                    if ($posisi=='kanan') {
                    ?>
                    <tr>
                        <td>AMENDMENT :</td>
                    </tr>
                    <tr>
                        <td>PEMEGANG PASPOR TELAH MELAPORKAN <br/>DIRI APADA KBRI DAN HAAG UNTUK <br/>KEMABLI KE INDONESIA SETERUSNYA <br/>DENGAN ALAMAT :</td>
                    </tr>
                    <tr>
                        <td><br/><?php echo $function->getdata("alamat_id", $datalayanan); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $function->getdata("kota_kab_id", $datalayanan) . ' - ' . $function->getdata("kodepos_id", $datalayanan); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $function->getdata("negara_id", $datalayanan); ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </body>
</html>
