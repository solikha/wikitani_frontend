<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
//print_r($customer);
//print_r(getArrayDef($customer, 'nama', '')); die;
  $nama_pelanggan = getArrayDef($customer, 'nama', '');
  $alamat = getArrayDef($customer, 'alamat', '');
  $kota = getArrayDef($customer, 'nama_kota', '');
?>
<style>
    .tab-pane {
        min-height: 300px;
        margin-left: 8px;
        margin-right: 8px;
    }
</style>
<div class="page-header">
    <h1>
        <?php echo $nama_pelanggan; ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Profil Pelanggan
        </small>
    </h1>
</div>
<div class="row" style="background-color:rgb(239, 243, 248); 
     margin-left: 0px; margin-right: 0px; margin-bottom: 5px;
     border: 1px solid #C5D0DC;
     padding-top: 8px; padding-left:0px; padding-right: 0px; padding-bottom: 10px">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-sm-4">
                <div class="edit-group" style="">
                    <label for="cust_nama"> Nama Pelanggan </label>
                    <div class="form-control crud-param" ><?php echo $nama_pelanggan; ?></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="edit-group" style="">
                    <label for="cust_nama"> Alamat </label>
                    <div class="form-control crud-param" ><?php echo $alamat; ?></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="edit-group" style="">
                    <label for="cust_nama"> Kota</label>
                    <div class="form-control crud-param" ><?php echo $kota; ?></div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="tabbable">
    <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
        <li class="active">
            <a data-toggle="tab" href="#cust_detail" aria-expanded="true">Detail Pelanggan</a>
        </li>

        <li class="">
            <a data-toggle="tab" href="#cust_jobsite" aria-expanded="false">Pemasangan</a>
        </li>

        <li class="">
            <a data-toggle="tab" href="#cust_user" aria-expanded="false">User</a>
        </li>
        <li class="">
            <a data-toggle="tab" href="#cust_asset" aria-expanded="false">Daftar Aset</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="cust_detail" class="tab-pane active">
            <div class="row">
                
            <?php $this->load->view('detail_data');?>
            
            </div>
        </div>

        <div id="cust_jobsite" class="tab-pane">
            <?php echo call_user_func_array('Modules::run', array('crud/call', 'ns_jobsite', 'cust_jobsite_all')); ?>
        </div>

        <div id="cust_user" class="tab-pane">
            <?php echo call_user_func_array('Modules::run', array('crud/call', 'ns_user', 'cust_user')); ?>
        </div>

        <div id="cust_asset" class="tab-pane">
            <?php echo call_user_func_array('Modules::run', array('crud/call', 'ns_asset', 'aset')); ?>
        </div>

        <div id="cust_document" class="tab-pane">
            <?php //echo call_user_func_array('Modules::run', array('crud/call', 'ns_jobsite', 'jobsite')); ?>
        </div>

    </div>
</div>


