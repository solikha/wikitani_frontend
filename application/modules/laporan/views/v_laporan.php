<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); /* Manggu Framework * Simple PHP Application Development * Kusnassriyanto S. Bahri * kusnassriyanto@gmail.com * */
$function = new pembayaran();
?>
<!DOCTYPE html>
<html>
    <head> 
        <meta charset="UTF-8">
        <style>
            @page{
                margin-top:2cm;
                margin-bottom: 1cm;
                margin-left:1.5cm;
                margin-right:1.5cm;
            }
            body{
                color:#3E3E3E;
                font-size:12pt;
                width:100%;
                font-family:times new roman;
            }
            .content{
                font-size:14pt;
            }
            .content-1{
                font-size:14pt;
            }
            #content-2{
                font-size:14pt;
                /*margin-left:45%;*/
            }
            .jarak-baris{
                margin-bottom:1pt;
                color:#808080;
            }
            .jarak-baris-kolom-ttd{
                margin-bottom:1pt;
                /*color:#dadada;*/
            }
            .tengah-layar{
                margin-left:40%;
                font-size:14pt;
            }
            .space-kosong{
                height:40%;
            }
            #content-5{
                margin-left:50%;
            }
            .td-content-paragraf{
                text-align:justify;
            }
            .font-hitam-muda{
                color:#808080;
            }
            .vertikal-align-top{
                vertical-align:top;
                width:50%;
            }
        </style>
    </head>
    <body>
       <table style="width:100%; border-spacing:0; border:1px solid white;">
			<tr>
				<td style="height:2.00cm; width:3.00cm; border:1px solid white;">
				
				</td>
				<td style="height:2.00cm; width:7.50cm; border:1px solid white;">
						<center>
						<font style="font-size:10pt; text-align:center;"><b>KEDUTAAN BESAR REPUBLIK INDONESIA</b></font><br/>
						<font style="font-size:8pt; text-align:center;"><?php echo $function->getdata('alamat1', $cetak_kwitansi) ?></font><br/>
						<font style="font-size:8pt; text-align:center;"><?php echo $function->getdata('alamat2', $cetak_kwitansi) ?></font><br/>
						<font style="font-size:8pt; text-align:center;">Tel: <?php echo $function->getdata('phone', $cetak_kwitansi) ?></font><br/>
						<font style="font-size:8pt; text-align:center;">Fax: <?php echo $function->getdata('fax', $cetak_kwitansi) ?></font><br/>
						</center>
				</td>
				<td style="height:2.00cm; width:6.00cm; border:1px solid white;">
				<font style="font-size:6pt; text-align:center;">No Kwitansi:</font>
					<b>NO <?php echo getArrayDef($data_cetak_kwitansi,'no_kwitansi'); ?></b>
				</td>
			</tr>
			<tr>
				<td style="border:1px solid white;">
				
				</td>
			    <td style="height:2.00cm; " colspan=2>
				<table style="border-spacing:0; border:1px solid white;">
					<tr >
						<td style="height:2.00cm; width:4cm; border:1px solid white; vertical-align:top;">
						<font style="font-size:10pt; vertical-align:top; "></font><br/>
						</td>
						<td style="height:2.00cm; width:0.5cm; border:1px solid white; vertical-align:top;">
						<font style="font-size:10pt; "><b>&nbsp;</b></font><br/>
						</td>
						<td style="height:2.00cm; width:9cm; border:1px solid white; vertical-align:top;">
							<br/>
							<b>TANDA TERIMA</b>
							<br/>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td style="border:1px solid white;">
				<!--a-->
				</td>
				<td style="border:1px solid white;" colspan=2>
					<table style="border-spacing:0;" >
						<tr>
							<td style="height:1.00cm; width:4cm; border:1px solid white; vertical-align:top;">
								<font style="font-size:10pt; vertical-align:top; "><b>Telah Terima dari</b></font><br/>
							</td>
							<td style="height:1.00cm; width:0.5cm; border:1px solid white; vertical-align:top;">
								<font style="font-size:10pt; "><b>:</b></font><br/>
							</td>
							<td style="height:1.00cm; width:9cm; border:1px solid white; vertical-align:top;">
								<?php echo $function->getdata("pemohon", $data_cetak_kwitansi); ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="border:1px solid white;">
				<!--b-->
				</td>
				<td style="border:1px solid white;" colspan=2>
					<table style="border-spacing:0;" >
					<tr>
						<td style="height:1.00cm; width:4cm; border:1px solid white; vertical-align:top;">
						<font style="font-size:10pt; vertical-align:top; "><b>Uang Sebesar</b></font>
						</td>
						<td style="height:1.00cm; width:0.5cm; border:1px solid white; vertical-align:top;">
						<font style="font-size:10pt; "><b>:</b></font>
						</td>
						<td style="height:1.00cm; width:9cm; border:1px solid white; vertical-align:top;">
							<?php
							$angka = $function->getdata("biaya", $data_cetak_kwitansi);
							if ($angka != NULL) {
                            $rupiah = $function->rupiah($angka);
                            echo $rupiah . " €";
                            echo "<br />";

                            $terbilang = $function->terbilang($angka);
                            echo "" . $terbilang . " Euro";
                        }
                        ?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="border:1px solid white;">
				<!--c-->
				</td>
				<td style="border:1px solid white;" colspan=2>
				<table style="border-spacing:0;">
					<tr>
						<td style="height:2.00cm; width:4cm; border:1px solid white; vertical-align:top;">
						<font style="font-size:10pt; vertical-align:top; "><b>Untuk Pembayaran</b></font><br/>
						</td>
						<td style="height:2.00cm; width:0.5cm; border:1px solid white; vertical-align:top;">
						<font style="font-size:10pt; "><b>:</b></font><br/>
						</td>
						<td style="height:2.00cm; width:9cm; border:1px solid white; vertical-align:top;">
						<font style="font-size:10pt; vertical-align:top; ">
						<?php echo getArrayDef($data_cetak_kwitansi,'pembayaran'); ?>
						</font>
						<br/>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td style="border:1px solid white;">
				<!--d-->
				</td>
				<td style="border:1px solid white;" colspan=2>
					<table style="border-spacing:0;">
					<tr>
						<td style="height:1.00cm; width:4cm; border:1px solid white; vertical-align:top;">
						
						</td>
						<td style="height:1.00cm; width:0.5cm; border:1px solid white; vertical-align:top;">
						<font style="font-size:10pt; "><b></b></font><br/>
						</td>
						<td style="height:1.00cm; width:9cm; border:1px solid white; vertical-align:top; padding-left:4.00cm;">
							<font style="font-size:10pt; vertical-align:top; ">Brussel,&nbsp;<?php echo $function->getdata("tanggal", $data_cetak_kwitansi); ?></font><br/>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td style="border:1px solid white;">
				<!--e-->
				</td>
				<td style="border:1px solid white;" colspan=2>
				<table style="border-spacing:0;">
					<tr>
						<td style="height:2.00cm; width:4cm; border:1px solid white; vertical-align:top;">

							<font style="font-size:10pt; vertical-align:top; "><b>Yang Membayar,</b></font>
							<br/><br/>
							<font style="font-size:10pt; vertical-align:top; ">
							<?php 
							?>
							</font>
							<br/><br/>
							<font style="font-size:10pt; vertical-align:top; ">(................................)</font><br/>
						</td>
						<td style="height:2.00cm; width:0.5cm; border:1px solid white; vertical-align:top;">
							<font style="font-size:10pt; "><b></b></font><br/>
						</td>
						<td style="height:2.00cm; width:9cm; border:1px solid white; vertical-align:top; padding-left:4.00cm;">
							<font style="font-size:10pt; vertical-align:top; "><b>Yang Menerima,</b></font>
							<br/><br/>
							<font style="font-size:10pt; vertical-align:top; ">
							<?php 
							
							?>
							</font>
							<br/><br/>
							<font style="font-size:10pt; vertical-align:top; ">(................................)</font><br/>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			
			<tr>
				<td style="border:1px solid white;">
				<!--e-->
				</td>
				<td style="border:1px solid white;" colspan=2>
				<table style="border-spacing:0;">
					<tr>
						<td style="height:0.50cm; width:4cm; border:1px solid white; vertical-align:top;">
							<b><font style="font-weight:bold;">_______________________________________________________</font></b>
						</td>
						
					</tr>
				</table>
				</td>
			</tr>

			<tr>
				<td style="border:1px solid white;">
				<!--g-->
				</td>
				<td style="border:1px solid white;" colspan=2>
				<table style="border-spacing:0;">
					<tr>
						<td style="height:1.00cm; width:6cm; border:1px solid white; vertical-align:top;">
						<font style="font-size:10pt; vertical-align:top; "><b>Lunas Diterima tgl.</td><?php echo getArrayDef($data_cetak_kwitansi,'tanggal'); ?></b></font><br/>
						<font style="font-size:10pt; vertical-align:top; ">
							<?php  ?>
						</font>
						
						<td style="height:1.00cm; width:0.5cm; border:1px solid white; vertical-align:top;">
						<font style="font-size:10pt; "><b></b></font><br/>
						</td>
						<td style="height:1.00cm; width:7cm; border:1px solid white; vertical-align:top;">
						<font style="font-size:10pt; vertical-align:top; "></font><br/>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td style="border:1px solid white;">
				<!--h-->
				</td>
				<td style="border:1px solid white;" colspan=2>
					<table style="border-spacing:0;">
					<tr>
						<td style="height:2.00cm; width:4cm; border:1px solid white; vertical-align:top;">
							<font style="font-size:10pt; vertical-align:top; "><?php echo $cetak_kwitansi['kwitansi_jabatan']; ?>,
							<br/><br/>
							<!--
							<?php //echo $cetak_kwitansi['kwitansi_nama']; ?> </font>--><br/><br/><br/>
							<font style="font-size:10pt; vertical-align:top; ">(<?php echo $cetak_kwitansi['kwitansi_nama']; ?>)</font><br/>
							
							<font style="font-size:10pt; vertical-align:top; ">NIP.<?php echo $cetak_kwitansi['kwitansi_nip']; ?></font>
							<font style="font-size:10pt; vertical-align:top; ">
							<?php  ?>
							</font><br/>
						</td>
						<td style="height:2.00cm; width:0.5cm; border:1px solid white; vertical-align:top;">
							<font style="font-size:10pt; "><b></b></font><br/>
						</td>
						<td style="height:2.00cm; width:9cm; border:1px solid white; vertical-align:top; padding-left:4.00cm;">
							<font style="font-size:10pt; vertical-align:top; ">Mengetahui,<br/>
							<?php  ?></font>
							<font style="font-size:10pt; vertical-align:top; "><?php echo $cetak_kwitansi['kwitansi_mengetahui_jabatan']; ?>,
							<br/><br/>
							</font><br/><br/>
							<font style="font-size:10pt; vertical-align:top; ">(<?php echo $cetak_kwitansi['kwitansi_mengetahui_nama']; ?>)</font><br/>
							<font style="font-size:10pt; vertical-align:top; ">NIP.<?php echo $cetak_kwitansi['kwitansi_mengetahui_nip']; ?></font>
							<font style="font-size:10pt; vertical-align:top; ">
							<?php ?></font><br/>
						</td>
					</tr>
				</table>
				</td>
			</tr>	
	   </table>
	</body>
</html>