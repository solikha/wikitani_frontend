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
                font-size:12px; margin:10px 0; font-family: Dejavu Sans; color:#333333;
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
			.label {
				border:1px solid white;
				vertical-align: text-top;
			}
			.pemisah {
				margin-left:-20%;
				vertical-align: text-top;
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

         <table style="font:10pt verdana, sans-serif; width:100%; "  class ="content">
            <tr>
                <td style="width: auto; height: auto" rowspan="6">
                    <img src="<?php echo $icon; ?>" width=300>
                </td>
                <td style="background-color: #B2CBF0; height: auto; font-size:20pt; width:250pt; font-family: Dejavu Sans; color:white; text-align: center" colspan="3">PURCHASE ORDER</td>
            </tr>
            <tr>
                <td style="font-size:12pt; font-family: Dejavu Sans; text-align: center; height: auto; width:250pt;" colspan="3"><b> <?php echo $data_export['po_number']; ?></b>
				</td>
            </tr>
            <tr>
                <td style="background-color:#B2CBF0; height:1px;" colspan="3">
                </td>
            </tr>
            <tr>
                <td style="line-height: 100%; text-align: left; height: auto;" colspan="2"><b>Date </b>: <br><?php echo $data_export['date_format']; ?> </td>
                <td style="line-height: 100%; ext-align: left; height: auto;"><b>Ref </b>: <br><?php echo $data_export['reference']; ?> <?php echo $data_export['reference_datex']; ?></td>
            </tr>
            <tr>
                <td style="line-height: 100%; height: auto;"><b><?php echo $data_export['incoterms_idx']; ?></b> : <br><?php echo $data_export['incoterms_text']; ?></td>
                <td style="line-height: 100%; height: auto;"><b>Currency </b>: <br><?php echo $data_export['currency']; ?></td>
                <td style="line-height: 100%; height: auto;" ><b>Term Of Payment </b>: <br><?php echo $data_export['terms_idx']; ?></td>
            </tr>
            <tr>
                <td style="line-height: 100%; height: auto;" colspan="2"></td>
            </tr>
        </table>
		
        <table style="width: 100%;">
            <tr>
                <td colspan="2" style="background-color:#B2CBF0; width:400px">
                </td>
            </tr>
        </table>
		
        <table style="width:100%; font:10pt verdana, sans-serif;">
            <tr>
                <td style="text-align: left; height: auto ; color:#4f99c6; font-size:14px; width:50%;"><b><u>To :</u></b></td>
                <td style="text-align: left; height: auto ; color:#4f99c6; font-size:14px; width:50%;"><b><u>Ship To :</u></b></td>
            </tr>
            <tr>
                <td style="text-align: left; line-height: 110%;">
				<b><?php echo $data_export['supp_name']; ?></b><br/>
				Supplier ID : <?php echo $data_export['supplier_id']; ?><br/>
				<?php echo $data_export['supp_addres']; ?><br/>
				Phone : <?php echo $data_export['phone']; ?><br/>
				Fax : <?php echo $data_export['fax']; ?><br/>
				Attn : <b><?php echo $data_export['attn']; ?></b>
				</td>
				
                <td style="text-align: left; line-height: 110%;">
				<?php echo $data_export['ship_to']; ?><br/>
				<?php echo $data_export['ship_to_address']; ?><br/>
				Phone : <?php echo $data_export['ship_phone']; ?><br/>
				Fax : <?php echo $data_export['ship_fax']; ?><br/>
				Attn : <b><?php echo $data_export['ship_name']; ?></b>
				</td>
            </tr>
        </table>
	
        <table style="width:100%; font:10pt verdana, sans-serif; ">
            <tr>
                <td style="text-align: left; color:#4f99c6; font-size:14px; width:50%;"><b><u>Bank Address :</u></b></td>
                <td style="text-align: left; color:#4f99c6; font-size:14px; width:50%;"><b><u>Shipping Arrangement By :</u></b></td>
            </tr>
            <tr>
                <td style="text-align: left; "><?php echo $data_export['bank_address']; ?></td>
				<td style="text-align: left; padding-right:80px;"><?php echo $data_export['shipping_arrangement']; ?></td>
            </tr>    
        </table>
		
        <div style="padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px  " class="row">
            <table class="users">
                <thead>
                    <tr>
                        <th>Item#</th>
                        <th>Part Number</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Delivery</th>
                        <th>Condition</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					$no=1;
                    foreach ($data as $row) {
                        ?>
                        <tr class="table-tr">
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['part_number']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['qty']; ?></td>
                            <td><?php echo $row['unit_price']; ?></td>
                            <td><?php echo $row['delivery']; ?></td>
                            <td><?php echo $row['condition']; ?></td>
                            <td style="text-align: right;"><?php echo $row['subtotal']; ?></td>
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
			
			<table style="width:100%;" >
			  <tr>
				<td style="width:50%; color:#4f99c6; font-size:18px;"> <b><u>Supply Agreement : </b></u></td>
				<td style="text-align: center;" colspan="3"></td>
				<td style=""></td>
				<td style=""></td>
			  </tr>
			  <tr>
				<td style="font-size:12px;">1. Items supplied must be accompanied by approved release certificate or must have certification of airworthiness as agreed by FAA 8130-3 or Dual Release.</td>
				<td style=""></td>
				<td style=""></td>
				<td style=""></td>
				<td style=""></td>
				<td style=""></td>
			  </tr>
			  <tr>
				<td style="font-size:12px;">2. Packaging of the items supplied should follow through ATA300 and if fails to be complied supplier will be bear all risk of loss or damage of items supplied during shipment.</td>
				<td style="text-align: center; color:#4f99c6; font-size:15px;" colspan="2"><b><u>ORDER CONFIRMATION</b></u></td>
				<td style=""></td>
				<td style=""></td>
				<td style=""></td>
			  </tr>
			  <tr>
				<td style="font-size:12px;">3. Items must be shipped based on our shipping instruction and Global Aero Support Pte Ltd must be notified by supplier or repair shop of any delivery made to courier or our appointed forwarding not later than 24 hours after delivery.</td>
				<td style="font-size:14px;">Approved By:</td>
				<td style="font-size:14px;">Date:</td>
				<td style=""></td>
				<td style=""></td>
				<td style=""></td>
			  </tr>
			  <tr>
				<td style="font-size:12px;">4. Items supplied must be accordance to the release terms and condition quoted and order acknowledgement shall be provided by fax or email within 2 days ARO.</td>
				<td style=""></td>
				<td style=""></td>
				<td style=""></td>
				<td style=""></td>
				<td style=""></td>
			  </tr>
			  <tr>
				<td style="font-size:12px;">5. Order can be cancelled by Global Aero Support Pte Ltd in case supplier unable to supply based on term and condition as quoted.</td>
				<td style=" text-align: center; font-size:14px;" colspan="2">(<?php echo $data_export['supp_name']; ?>)</td>
				<td style=""></td>
				<td style=""></td>
				<td style=""></td>
			  </tr>
			</table>
			
            <table style="width: 100%;">
                <tr>
                    <td colspan="2" style="background-color:#B2CBF0; width:400px">
                    </td>
                </tr>
            </table>
			
			<table style="width:100%; font:10pt verdana, sans-serif; ">
			  <tr>
				<td style="text-align: left; height: auto; width:30%;"></td>
				<td style="text-align: left; height: auto; width:30%;"></td>
				<td style="text-align: left; height: auto; width:20%;">Sub Total</td>
				<td style="text-align: right; height: auto; width:20%;"><?php echo $data_export['total']; ?></td>
			  </tr>
			  <tr>
				<td style="text-align: left; height: auto; width:30%;"></td>
				<td style="text-align: left; height: auto; width:30%;"></td>
				<td style="text-align: left; height: auto; width:20%;">Tax</td>
				<td style="text-align: right; height: auto; width:20%;"><?php echo $data_export['tax']; ?></td>
			  </tr>
			  <tr>
				<td style="text-align: left; height: auto; width:30%;"></td>
				<td style="text-align: left; height: auto; width:30%;"></td>
				<td style="text-align: left; height: auto; width:20%;">Handling Charge</td>
				<td style="text-align: right; height: auto; width:20%;"><?php echo $data_export['handling_charge']; ?></td>
			  </tr>
			  <tr>
				<td style="text-align: left; height: auto; width:30%;"></td>
				<td style="text-align: left; height: auto; width:30%;"></td>
				<td style="text-align: left; height: auto; width:20%;">Shipping Charge</td>
				<td style="text-align: right; height: auto; width:20%;"><?php echo $data_export['shipping_charge']; ?></td>
			  </tr>
			  <tr>
				<td style="text-align: left; height: auto; width:30%;"></td>
				<td style="text-align: left; height: auto; width:30%;"></td>
				<td style="text-align: left; height: auto; width:20%;"><b>Grand Total</b></td>
				<td style="text-align: right; height: auto; width:20%;"><b><?php echo $data_export['total']; ?></b></td>
			  </tr>
			</table>
			
        </div>
    </body>
</html>
