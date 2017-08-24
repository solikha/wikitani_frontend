<html>
    <head>

    </head>
    <body>
        <style>
		@page{
		margin-top: 0.5cm;
		margin-left: 9cm;
		margin-right:0.5cm;
		}
		.tg{
			border:1px solid white;
			width:9cm;
		 }
	    .tg-yw4l{
		/*text-decoration: underline;*/
		border:1px solid white;
		height:1.2cm;
		}
		.label-underlined{
			text-decoration: underline;
		}
		.col-header{
		height:2.2cm;
		vertical-align:bottom;
		padding-left:0.5cm;
		font-size:8pt;
		text-align: left;
		}
		.col-image{
		height:4.5cm;
		}
		.col-nama{
			padding-left:1.3cm;
			font-size:8pt;
		}
		.col-wn{
		  padding-left:2.5cm;
		}
		.col-ttl{
		  padding-left:3.00cm;
		}
		.col-alamat{
		width:4.5cm;
		height:1.6cm;
		font-size:8pt;
		padding-left:1cm;
		}
		.body{
				font-family:arial;
                font-size:10pt
		}
		.col-jenkel{
		text-align: right;
		padding-right:0.5cm;
		}
		.p-jenkel{
			border:1px solid black;
		}
		.tg-031e{
		padding-left:1.5cm;
		font-size:8pt;
		}
		.col-foto{
		font-size:8pt;
		}
        </style>
    <table class="tg" cellspacing="0" cellpadding="0">
  <tr>
    <th class="tg-yw4l col-header" colspan="3">
	KETERANGAN PEMEGANG
	<br/>
	DESCRIPTION OF THE BARRER
	</th>
  </tr>
  <tr>
    <td class="tg-yw4l col-nama" colspan="2">
			<?php echo strtoupper(getArrayDef($datalayanan,"full_name")); ?>
	</td>
	<td class="tg-yw4l col-jenkel">
	<p class="p-jenkel">L/M</p>
	</td>
  </tr>
  <tr>
    <td class="tg-yw4l col-wn" colspan="3"><?php echo strtoupper(getArrayDef($datalayanan,"warganegara"));?></td>
  </tr>
  <tr>
    <td class="tg-yw4l col-ttl" colspan="3"><?php echo strtoupper(getArrayDef($datalayanan,"birth_place")); ?></td>
  </tr>
  <tr>
    <td class="tg-yw4l col-alamat">
	&nbsp;<br/>
	<?php echo strtoupper(getArrayDef($datalayanan,"alamat")); ?>
	</td>
    <td class="tg-yw4l col-foto" colspan="2" rowspan="2">
	<img src="<?php echo $foto; ?>" class="col-image" />
	<br>
	Tanda Tangan
	</td>
  </tr>
  <tr>
    <td class="tg-031e">
	&nbsp;<br/>
	<?php echo getArrayDef($datalayanan,"tinggi_badan"); ?>CM
	</td>
  </tr>
  <tr>
  <td></td>
  <td></td>
  <td></td>
  </tr>
</table>
    </body>
</html>
