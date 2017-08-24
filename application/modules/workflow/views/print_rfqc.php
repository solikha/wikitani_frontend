<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); /* Manggu Framework * Simple PHP Application Development * Kusnassriyanto S. Bahri * kusnassriyanto@gmail.com * */
?>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo getcwd() . '/themes/aceadmin/css/bootstrap.min.css' . '<br>'; ?>" />
        <link rel="stylesheet" href="<?php echo getcwd() . '/themes/aceadmin/css/font-awesome.min.css' . '<br>'; ?>" /> 
    </head>
    <body>
        <style>
            .data_value{
                font-size:12px; margin:10px 0; font-family: Dejavu Sans;
            }
            .data_value_lebar_high{
                font-style: italic;
                display: block;
                color:#8C8C94;
                border:#EBE6E6 solid 1px;
                height:80px;
            }
            .data_value_lebar_medium{
                /* font-style: italic;*/
                display: block;
                color:#333333;
                height:40px;
                font-family: Dejavu Sans;
            }
            .data_value_ceklist{
                font-style: italic;
                display: block;
                color:#8C8C94;
                border:white solid 1px;
                height:10px;
            }
            .data_value_text{
                font-style: italic;
            }
            .data_label{
                font-style: oblique;
                display: block;
            }
            .tbl_header{
                border:1px solid #8C8C94;;
            }
            .tbl_body{
                border:1px solid #dadada;
            }
            .data_label_ceklist{

            }
            .ceklist{
                border:#EBE6E6 solid 1px;
                /* height:20px;
                 width:10px;*/
            }

            .users {
                table-layout: fixed;
                width: 100%;
                white-space: nowrap;
                font:10pt verdana sans-serif;
            }
            /* Column widths are based on these cells */
            .row-ID {
                width: 10%;
            }
            .row-name {
                width: 40%;
            }
            .row-job {
                width: 30%;
            }
            .row-email {
                width: 20%;
            }
            .users td {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .users th {
                background: #B2CBF0;
                color: white;
            }
            .users td,
            .users th {
                text-align: left;
                padding: 5px 10px;
            }
            .users tr:nth-child(even) {
                background:#E6E6E6;
                /*background-color:#E0F0FF;*/
            }
            .table-tr td{
                font-size: 11px;
            }
			
        </style>
        <table style="width: 100%;">
            <thead>
                <tr valign="top">
                    <td style="background-color:white; width:50%; vertical-align: top;">
                        <div style="font-weight: bold; font-size:18px; margin:10px 0; font-family: Dejavu Sans; color:#B2CBF0;">
                            To
                        </div>
                    </td>
                    <td style="background-color:white; width:50%; vertical-align: top;">
                        <div style="font-weight: bold; font-size:18px; margin:10px 0; font-family: Dejavu Sans; color:#B2CBF0; ">
                            
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr valign="top" style="height:170px;">
                    <td style="background-color:white; vertical-align: top;">
                        <div class="data_value"><b><?php echo $data_rfqc['name']; ?></b></div>
                    </td>
                    <td style="background-color:white; vertical-align: top;">
                        <div class="data_value"><?php echo $data_rfqc['ship_to_name']; ?></div>
                    </td>
                </tr>
                <tr valign="top" style="height:170px;">
                    <td style="background-color:white; vertical-align: top;">
                        <div class="data_value"><?php echo $data_rfqc['addres']; ?></div>
                    </td>
                    <td style="background-color:white; vertical-align: top;">
                        <div class="data_value"><?php echo $data_rfqc['ship_to_address']; ?></div>
                    </td>
                </tr>
                <tr valign="top" style="height:170px;">
                    <td style="background-color:white; vertical-align: top;">
                        <div class="data_value">Tel: <?php echo $data_rfqc['phone']; ?></div>
                    </td>
                </tr>
                <tr valign="top" style="height:170px;">
                    <td style="background-color:white; vertical-align: top;">
                        <div class="data_value">Fax: <?php echo $data_rfqc['fax']; ?></div>
                    </td>
                </tr>
            </tbody>
        </table>
		
        <table style="width: 100%;">
			<tr valign="top">
				<td style="width:50%;">
						In response to your request, we are pleased to quote you the following:
				</td>
			</tr>
        </table>
		
		<table class="users">
			<thead>
				<tr>
					<th>Item#</th>
					<th>Part Number</th>
					<th>Description&nbsp;&nbsp;</th>
					<th>Condition</th>
					<th>Qty</th>
					<th>UOM</th>
					<th width="100">Unit Price</th>
					<th>Total</th>
					<th>Delivery</th>
					<th>Remark</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				foreach ($data as $row) {
					?>
					<tr class="table-tr">
						<td height=""><?php echo $no++; ?></td>
						<td><?php echo $row['part_number']; ?></td>
						<td><?php echo $row['description']; ?></td>
						<td><?php echo $row['condition']; ?></td>
						<td><?php echo $row['qty']; ?></td>
						<td><?php echo $row['uom']; ?></td>
						<td style="text-align: right;"><?php echo $row['price']; ?></td>
						<td style="text-align: right;"><?php echo $row['total']; ?></td>
						<td><?php echo $row['delivery']; ?></td>
						<td><?php echo $row['remark']; ?></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<table style="width: 100%;">
			<tr>
				<td colspan="2" style="background-color:#B2CBF0; width:400px">
				</td>
			</tr>
		</table>
		
		<table style="width:100%; font-size:10pt; font-family: Dejavu Sans;">
		  <tr>
			<td style="text-align: left; height: auto; width:30%;"></td>
			<td style="text-align: left; height: auto; width:30%;"></td>
			<td style="text-align: left; height: auto; width:20%;"></td>
			<td style="text-align: right; height: auto; width:20%;"></td>
		  </tr>
		  <tr>
			<td style="text-align: left; height: auto; width:30%;"></td>
			<td style="text-align: left; height: auto; width:30%;"></td>
			<td style="text-align: left; height: auto; width:20%;"></td>
			<td style="text-align: right; height: auto; width:20%;"></td>
		  </tr>
		  <tr>
			<td style="text-align: left; height: auto; width:30%;"></td>
			<td style="text-align: left; height: auto; width:30%;"></td>
			<td style="text-align: left; height: auto; width:20%; padding-left:10px;">Sub Total 1</td>
			<td style="text-align: right; height: auto; width:20%; padding-right:10px;"><?php echo $total[0]['total_c']; ?></td>
		  </tr>
		  <tr>
			<td colspan="2" style="text-align: right; height: auto; width:60%; padding-right:20px;"><?php echo $data_rfqc['freight_description']; ?></td>
			<td style="text-align: left; height: auto; width:20%; padding-left:10px;">Freight</td>
			<td style="text-align: right; height: auto; width:20%; padding-right:10px;"><?php echo $data_rfqc['freight']; ?></td>
		  </tr>
		  <tr>
			<td style="text-align: left; height: auto; width:30%;"></td>
			<td style="text-align: left; height: auto; width:30%;"></td>
			<td style="text-align: left; height: auto; width:20%; background-color:#E6E6E6; padding-left:10px;"><b>Total</b></td>
			<td style="text-align: right; height: auto; width:20%; background-color:#E6E6E6; padding-right:10px;"><b><?php echo $total[0]['total_c_freight']; ?></b></td>
		  </tr>
		</table>
		
		<table style="width: 100%; font-size:10pt; font-family: Dejavu Sans;">
			<tr>
				<td style="text-align: left; height: auto; width:5%;"><u><b>Notes</b></u></td>
				<td style="text-align: left; height: auto; width:95%;">- Subject To Prior Sale</td>
			</tr>
			<tr>
				<td style="text-align: left; height: auto; width:5%;"></td>
				<td style="text-align: left; height: auto; width:95%;">- All the materials will have certification of Airworthiness as agreed by FAA 8130-3 or EASA1 or C of C.</td>
			</tr>
		</table>
			
    </body>
</html>
