<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); /* Manggu Framework * Simple PHP Application Development * Kusnassriyanto S. Bahri * kusnassriyanto@gmail.com * */

	
?>
<html>
    <head>
        
    </head>
    <body>
        <style>
		@page{
		margin-top: 0.5cm;
		margin-left: 0cm;
		margin-right:0.5cm;
		}
		
		body{
			color:#3E3E3E;
			font-size:10pt;
			width:100%;
			font-family:Arial;
		}
		.container{
		
		}
		.td-container{
		
		}
		.content{
		
		float:left;
		width:77.5mm;
		padding:0cm;
		margin-left:10mm;
		}
		#content-1{
		
		}
		.td-content{
		
		padding-top:-40mm;
		}
		/*class ini dibuat supaya lebar element tidak terpengaruh contentnya*/
		.td-sub-content{
		/*border:0.1px solid white;*/
		padding-left:0.3cm;
		padding-right:0.3cm;
		max-width:13.6cm;
		text-align: justify;
		width:8.7cm;
		max-height:15.6cm;
		text-justify: inter-word;
		}
        </style>
		<table class="container">
			<tr>
				<td  class="td-container">
					<table style="margin-left:0px;"  class="content" id="content-1">
						<tr>
							<td style="width:110mm;">
								
							</td>
						</tr>
					</table>
				</td>	
				<td style="padding-left:0px;" class="td-container">
					<table class="content" style="padding:0.5cm; border-style:none;">
						<tr>
							<td style="width:8.7cm; height:13.6cm; border-style:none;" class="td-content">
								<table class="sub-content">
									<tr>
										<td class="td-sub-content">
											<b>PEKERJAAN/OCUPATION</b>
											<br/>
												<?php echo strtoupper(getArrayDef($datalayanan,"pkjaan_nama")); ?>
											<br/>
										</td>
									</tr>
								</table>
								<table  class="sub-content">
									<tr>
										<td class="td-sub-content">
									
										</td>
									</tr>
								</table>
								<table  class="sub-content">
									<tr>
										<td class="td-sub-content" style="text-align:center;">
										    <br/>
											<?php //echo strtoupper(getArrayDef($data_pencetakan,"kota"));?>,&nbsp;
											<?php //echo  strtoupper(getArrayDef($datalayanan,"pbaru_tgl_cetak"));?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
				<td style="padding-left:-1cm; " class="td-container">
					<table class="content" style="padding:0.5cm; border-style:none;">
						<tr>
							<td style="width:8.7cm; height:13.6cm; border-style:none;" class="td-content">
								<table class="sub-content">
									<tr>
										<td class="td-sub-content">
											
										</td>
									</tr>
								</table>
								<table  class="sub-content">
									<tr>
										<td class="td-sub-content">
											
										</td>
									</tr>
								</table>
								<table  class="sub-content">
									<tr>
										<td class="td-sub-content" style="text-align:center;">
											
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
    </body>
</html>
