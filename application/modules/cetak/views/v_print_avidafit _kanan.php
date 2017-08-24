<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); /* Manggu Framework * Simple PHP Application Development * Kusnassriyanto S. Bahri * kusnassriyanto@gmail.com * */
$function = new print_avidafit();
?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
	    <!--+ 8.4-->
        <style>
		@page{
           margin-top: 1cm;
         /*margin-bottom: 1cm;*/
         margin-left: 1cm;
		 margin-right:0.5cm;
		  border:1px solid white;
		}
		body{
		 font-family:arial;
         font-size:10pt
		  
		}
          .content{
		  /*padding-top:6.2cm;*/
		  padding-left:19.9cm;
		  border:1px solid white;
		  
		  }
          .ttd{
		  padding-top:2cm;
		  padding-left:22.4cm;
		   border:1px solid white;
		  }		  
        </style>
       <table style="margin-left:0.8cm;">
	   <tr>
			<td class="content">
			Nomor Register : <?php echo getArrayDef($datalayanan,'pbaru_noreg'); ?>
			<br/>
			Pemegang Paspor ini adalah subyek Pasal 4<br/>
			huruf c, huruf d, huruf h, huruf i dan Pasal 5<br/>
			Undang-Undang Nomor 12 Tahun 2006<br/>
			tentang Kewarganegaraan Republik<br/>
			Indonesia<br/>
			</td>
	   </tr>
	   <tr>
			<td class="content ttd">
			<?php echo getArrayDef($dataconfig,'kota') ?>, <?php echo bulan(getArrayDef($datalayanan,'pbaru_tgl_cetak')); echo " ". hari(getArrayDef($datalayanan,'pbaru_tgl_cetak')); echo ', '.tahun(getArrayDef($datalayanan,'pbaru_tgl_cetak'));?><br/>
			a.n Kepala Perwakilan RI<br/><br/><br>
			<?php echo getArrayDef($dataconfig,'nama_atase_imigrasi'); ?>
			<hr style="height:1pt;border-width:0;margin-bottom: 0px; background: black; border-width:0"/>
			Atase Imigrasi<br/>
			
			</td>
	   </tr>
	   </table>
    </body>
</html>
