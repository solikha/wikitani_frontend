<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); /* Manggu Framework * Simple PHP Application Development * Kusnassriyanto S. Bahri * kusnassriyanto@gmail.com * */
$function = new print_diplomatik();
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
                        <td>BEARER IS MINISTER COUNSELLOR OF THE<br>INDONESIAN EMBASSY<br>IN DEN HAAG<br><br><br><br></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><?php echo $function->getdata("nama_tempat", $datalayanan) . ', ' . $function->getdata("tanggal_print", $datalayanan); ?></td>
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
                        <td>BEARER IS MINISTER COUNSELLOR OF THE<br>INDONESIAN EMBASSY<br>IN DEN HAAG<br><br><br><br></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><?php echo $function->getdata("nama_tempat", $datalayanan) . ', ' . $function->getdata("tanggal_print", $datalayanan); ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </body>
</html>
