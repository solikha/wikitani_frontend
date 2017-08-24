<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); /* Manggu Framework * Simple PHP Application Development * Kusnassriyanto S. Bahri * kusnassriyanto@gmail.com * */

if (!isset($datamrz)) {
    $datamrz = array('', '');
}

if (!isset($datamrz[0])) {
    $datamrz[0] = '';
}
if (!isset($datamrz[1])) {
    $datamrz[1] = '';
}
$datamrz[0] = htmlspecialchars($datamrz[0]);
$datamrz[1] = htmlspecialchars($datamrz[1]);
?>
<html>
    <head>

    </head>
    <body>
        <style>
            .container{
                border:0px solid;
                width:11.6cm;
                border-spacing:0px;
                font-family:arial;
                font-size:10pt
            }
            .col-margin{
                height:9.0cm;
                width:11.60cm;
            }
            .ctn-margin{
                border-style:solid;
                border-width:1px;
                border-color:white;
            }
            .item{
                border:0px solid white;
                border-spacing:0px;
                padding-top:0.30cm;
            }
            #foto{
                width:3cm;
                height:4cm;
            }
            .col-2a{
                width:2cm;
            }
            .col-2b{
                width:3cm;
            }
            .col-3{
                width:3cm;
                text-align:right;
            }
            .col-3a{
                width:3cm;
                text-align:right;
            }
            @page{
                margin-top: 1cm;
                /*margin-bottom: 1cm;*/
                margin-left: 1cm;
            }
            .col-4{
                font-family:ocrb;
                font-size:9.8pt;
            }
            .col-4a{
                font-family:ocrb;
                font-size:9.8pt;
            }
            .col-4b{
                font-family:ocrb;
                font-size:9.8pt;
            }
            .col-4c{
                font-family:ocrb;
                font-size:9.8pt;
            }
            .col-foto{
                border:1px solid white;
                padding-top:0.30cm;
                /*background-image: url('<?php echo $foto; ?>');*/
            }
            .sub-td{
                background-image: url('<?php echo $foto; ?>');
                background-repeat:no-repeat;
                padding-top:2.40cm;
                background-size:2cm 3cm;
                width:3cm;
                height:4cm;
                border:1px solid red;
            }
            .kode_foto_filler{
                height: 10mm;
            }
            .kode_foto{
                background-color:black; 
                color:white; 
                z-index: 1000; 
                padding-left: 10mm;
                padding-right: 10mm;
                padding-top: 1mm;
                padding-bottom: 4mm;

            }
        </style>
        <table class="container ctn-margin">
            <tr>
                <td class="col-margin">
                </td>
            </tr>
        </table>
        <table class="container">
            <tr>
                <td rowspan=7 class="item col-foto" style="padding-top:5mm">	
                    <img src="<?php echo $foto; ?>" style="width:3cm; height:4cm; margin-top: -4mm; margin-bottom: -4mm; vertical-align: text-top;"/>
                    <div class="kode_foto" >
                     &nbsp;&nbsp;&nbsp;<?php echo $kode_foto; ?>&nbsp;&nbsp;&nbsp;
                    </div>
                </td>
                <td  class="item col-2a" style="padding-top:5mm;  padding-bottom:-0.5mm">
                    P
                </td>
                <td  class="item col-2b" style="padding-left: 15mm; padding-top:5mm; padding-bottom:-0.5mm">
                    IDN
                </td>
                <td  class="item col-3" >
                    <?php //echo strtoupper(getArrayDef($datapaspor, 'pbaru_nomor')); ?>
                </td>
            </tr>
            <tr>
                <td colspan=2  class="item">
                    <?php echo strtoupper(getArrayDef($datapaspor, 'full_name')); ?>
                </td>
                <td  class="item col-3a" >
                    <?php
                    //echo strtoupper(getArrayDef($datapaspor, 'jenis_kelamin'));
					if(getArrayDef($datapaspor, 'jenkelid')==1){
						echo "L/M";
					}else if(getArrayDef($datapaspor, 'jenkelid')==2){
						echo "P/F";
					}
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan=2  class="item" style="padding-top:5mm;  padding-bottom:-0.5mm">
                    INDONESIA
                </td>
                <td  class="item col-3a" style="padding-top:5mm; padding-bottom:-0.5mm">

                </td>
            </tr>
            <tr>
                <td colspan=2  class="item" style="padding-top:6mm;  padding-bottom:-0.5mm">
                    <?php echo strtoupper(getArrayDef($datapaspor, 'birth_date')); ?>
                </td>
                <td  class="item col-3a" style="padding-top:6mm;  padding-bottom:-0.5mm">
                    <?php echo strtoupper(getArrayDef($datapaspor, 'birth_place')); ?>
                </td>
            </tr>
            <tr>
                <td colspan=2  class="item" style="padding-top:4mm;  padding-bottom:-0.5mm">
                    <?php echo strtoupper(getArrayDef($datapaspor, 'pbaru_tgl_keluar')); ?>
                </td>
                <td  class="item col-3a" style="padding-top:4mm;  padding-bottom:-0.5mm">
                    <?php echo strtoupper(getArrayDef($datapaspor, 'pbaru_berlaku')); ?>
                </td>
            </tr>
            <tr>
                <td colspan=2  class="item" style="padding-top:3mm;  padding-bottom:-0.5mm">
                    <?php echo strtoupper(getArrayDef($datapaspor, 'pbaru_noreg')); ?>
                </td>
                <td  class="item col-3a" style="padding-top:3mm;  padding-bottom:-0.5mm">
                    <?php echo strtoupper(getArrayDef($datapaspor, 'pbaru_tpt_keluar')); ?>
                </td>
            </tr>
            <tr>
                <td colspan=4  class="item col-4a">
                    &nbsp;
                </td>

            </tr>
            <tr>
                <td colspan=4  class="item col-4b" style="padding-top:2mm;">
                
                    <?php echo $datamrz[0]; ?>
                </td>

            </tr>
            <tr>
                <td colspan=4  class="item col-4c" style="padding-top:1mm;">
                    <?php echo $datamrz[1]; ?>
                </td>

            </tr>
        </table>
    </body>
</html>
