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
        </style>
         <table style="font:12pt verdana, sans-serif; width:100%; ">
            <tr>
                <td style="width: auto; height: auto" rowspan="4">
                    <img src="<?php echo $icon; ?>" width=300>
                </td>
                <td style="background-color: #B2CBF0; height: auto; font-size:22pt; width:250pt; font-family: Dejavu Sans; color:white; text-align: center">Purchase Order to Supplier</td>
            </tr>
            <tr>
                <td style="text-align: right; height: auto; padding-right: 20pt">PO # <?php echo $data_export['po_number']; ?></td>
            </tr>
            <tr>
                <td style="text-align: right; height: auto; padding-right: 20pt"><?php echo $data_export['date']; ?></td>
            </tr>
            <tr>
                <td style="text-align: right;"></td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr>
                <td colspan="2" style="background-color:#B2CBF0; width:400px">
                </td>
            </tr>
        </table>
        <table style="width: 75%;">
            <thead>
                <tr valign="top">
                    <td style="background-color:white; width:50%; vertical-align: top;">
                        <div style="font-weight: bold; font-size:18px; margin:10px 0; font-family: Dejavu Sans; color:#4f99c6;">
                            To
                        </div>
                    </td>
                    <td style="background-color:white; width:50%; vertical-align: top;">
                        <div style="font-weight: bold; font-size:18px; margin:10px 0; font-family: Dejavu Sans; color:#4f99c6; ">
                            Ship To 
                        </div>
                    </td>
                    <td style="background-color:white; width:50%; vertical-align: top;  ">
                        <div style="font-weight: bold; font-size:18px; margin:10px 0; font-family: Dejavu Sans; color:#4f99c6; ">
                            Invoice To 
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr align="top" style="height:170px;">
                    <td style="background-color:white; vertical-align: top;">
                        <div class="data_value"><?php echo $data_export['supp_name']; ?></div>
                        <div class="data_value"><?php echo $data_export['supp_addres']; ?></div>
                    </td>
                    <td style="background-color:white; vertical-align: top;">
                        <div class="data_value"><?php echo $data_export['ship_to']; ?></div>
                        <div class="data_value"><?php echo $data_export['ship_to_address']; ?></div>
                    </td>
                    <td style="background-color:white; vertical-align: top;">
                        <div class="data_value"><?php echo $data_export['invoice_to']; ?></div>
                        <div class="data_value"><?php echo $data_export['invoice_to_address']; ?></div>
                    </td>
                </tr>
                
            </tbody>
        </table>
        <table style="width: 100%;">
            <thead>
                <tr valign="top">
                    <td style="background-color:#E6F0FF; width:75%; vertical-align: top;">
                        <div style="font-weight: bold; font-size:18px; margin:10px 0; font-family: Dejavu Sans; color:#4f99c6;">
                            Requirements
                        </div>
                        <div class="data_value"><?php echo $data_export['requirement']; ?></div>
                    </td>
                    <td style="background-color:#E6F0FF; width:25%; vertical-align: top;">
                        <div style="font-weight: bold; font-size:16px; margin:10px 0; font-family: Dejavu Sans; color:#4f99c6; ">
                            Incoterms
                        </div>
                        <div class="data_value"><?php echo $data_export['incoterms']; ?></div>
                        <br>
                        <div style="font-weight: bold; font-size:16px; margin:10px 0; font-family: Dejavu Sans; color:#4f99c6; ">
                            Terms of Payment
                        </div>
                        <div class="data_value"><?php echo $data_export['terms']; ?></div>
                        <br>
                        <div style="font-weight: bold; font-size:16px; margin:10px 0; font-family: Dejavu Sans; color:#4f99c6; ">
                            Total in (USD)
                        </div>
                        <div class="data_value"><?php echo $data_export['total']; ?></div>
                    </td>
                </tr>
            </thead>
        </table>
        <div style="padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px  " class="row">
            <table class="users">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Part Number</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>UOM</th>
                        <th>Delivery Date</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $row) {
                        ?>
                        <tr class="table-tr">
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['part_number']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['qty']; ?></td>
                            <td><?php echo $row['unit_price']; ?></td>
                            <td><?php echo $row['uom']; ?></td>
                            <td><?php echo $row['delivery_date']; ?></td>
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
            <table style="font:12pt verdana, sans-serif; width:100%; ">
                <tr>
                    <td style="text-align: right; height: auto; padding-right: 20pt">SUBTOTAL : <?php echo $data_export['total']; ?></td>
                </tr>
            </table>
        </div>
    </body>
</html>
