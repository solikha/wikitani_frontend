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
                font-size:18px; margin:10px 0; font-family: Dejavu Sans; color:#333333;
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
                border:#EBE6E6 solid 1px;
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
				color:#5A5A5A;
                /*display: block;*/
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
				font-family: Dejavu Sans; 
				font-size:9pt;
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
			
			.content {
				  width:100%;
				  font-size:12pt;
				  margin-left:0%;
				  border:1px solid white;
			}
			.content th {
			}
        </style>
		<table style="font-size:10pt; font-family: Dejavu Sans; width:100%; ">
            <tr>
				<td style="font-size:18px; font-family: Dejavu Sans; font-weight: bold; color:#B2CBF0; background-color:white; text-align: left; width:50%;" >To
				</td>
				<td style="font-size:18px; font-family: Dejavu Sans; font-weight: bold; color:#B2CBF0; background-color:white; text-align: left; width:50%;">Requirement
				</td>
			</tr>
			<tr>
				<td style="text-align: left; width:50%;" ><b><?php echo $data_rfqs["supplier_name"]; ?></b>
				<br> <?php echo  $data_rfqs["addres"];?>
				<br> Phone: <?php echo  $data_rfqs["phone"];?>
				<br> Fax: <?php echo  $data_rfqs["fax"];?>
				</td>
				<td style="text-align: left; width:50%;">All the quoted materials must have Certification of Airworthiness : FAA-8130-3 / EASA FORMI or Dual Release.
				<br>
				<br>
				<br>
				<br>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="height:10pt;"></td>
			</tr>
         </table>
        <table class="users">
            <thead>
                <tr>
                    <th style="font-size:11pt; font-family: Dejavu Sans; text-align: center;">Item#</th>
                    <th style="font-size:11pt; font-family: Dejavu Sans; text-align: center;">Part Number</th>
                    <th style="font-size:11pt; font-family: Dejavu Sans; text-align: center;">Description</th>
                    <th style="font-size:11pt; font-family: Dejavu Sans; text-align: center;">RFQ Qty</th>
                    <th style="font-size:11pt; font-family: Dejavu Sans; text-align: center;">Condition</th>
                    <th style="font-size:11pt; font-family: Dejavu Sans; text-align: center;">UOM</th>
                    <th style="font-size:11pt; font-family: Dejavu Sans; text-align: center;">Remark</th>
                </tr>
            </thead>
            <tbody>
                <?php
				$no=1;
                foreach ($data_rfqs['detail'] as $element) {
                    ?>
                    <tr>
                        <td height=""><?php echo $no++?></td>
                        <td><?php echo $element['part_number']; ?></td>
                        <td><?php echo $element['description']; ?></td>
                        <td><?php echo $element['rfq_qty']; ?></td>
                        <td><?php echo $element['condition']; ?></td>
                        <td><?php echo $element['uom_id']; ?></td>
                        <td><?php echo $element['remark']; ?></td>
                    </tr>
                    <?php
                }
				//echo $data_rfqs;
                ?>

            </tbody>
        </table>



    </body>
</html>
