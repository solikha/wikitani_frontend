<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
?>
<form id="edit-form" >
<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px">
    <div class="col-xs-12 col-sm-12">
        <div class="row" style="">
    <div class="col-sm-12 col-md-12 col-lg-12 datapanel" style="">
        <h4 
            class="crud-edit" 
            style="margin-top: 5px; padding-bottom:4px; border-bottom: 1px solid #bcc;" >
        Data Pelanggan        </h4>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <input type="hidden" class="form-control crud-edit" placeholder="" 
            name="id" id="id"
            style=""             value="" />
        <div class="edit-group" style="">
            <label for="jpelanggan_id">Jenis Pelanggan</label>
            <select class="form-control crud-edit" 
                name="jpelanggan_id" id="jpelanggan_id"
                data-lookup-paramlist=""
                data-lookup-refresh=""
                data-lookup-name="jpelanggan"
                style=""                 value="1">
            </select>
        </div>
        
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="jpengenal_id">Jenis Tanda Pengenal</label>
            <select class="form-control crud-edit" 
                name="jpengenal_id" id="jpengenal_id"
                data-lookup-paramlist=""
                data-lookup-refresh=""
                data-lookup-name="jpengenal"
                style=""                 value="1">
            </select>
        </div>
        
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="nomor_pengenal"> Nomor Tanda Pengenal </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="nomor_pengenal" id="nomor_pengenal"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="nama"> Nama </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="nama" id="nama"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tempat_lahir"> Tempat Lahir </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="tempat_lahir" id="tempat_lahir"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <div class="input-group" style="padding:0px">
                <input class="form-control date-picker crud-edit" type="text" 
                    data-date-format="dd-mm-yyyy" 
                    name="tanggal_lahir" id="tanggal_lahir" 
                    style=""                      
                    value="" />
                <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-6 col-lg-6 datapanel" style="">
        <div class="edit-group" style="">
            <label for="alamat">Alamat</label>
            <textarea class="form-control crud-edit" 
                id="alamat" name="alamat" 
                style=""                 ></textarea>
        </div>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="provinsi_id">Provinsi</label>
            <select class="form-control crud-edit lookup-refresh" 
                name="provinsi_id" id="provinsi_id"
                data-lookup-paramlist=""
                data-lookup-refresh="kota_id"
                data-lookup-name="provinsi"
                style=""                 value="32">
            </select>
        </div>
        
        <div class="edit-group" style="">
            <label for="kota_id">Kota</label>
            <select class="form-control crud-edit" 
                name="kota_id" id="kota_id"
                data-lookup-paramlist="provinsi_id"
                data-lookup-refresh=""
                data-lookup-name="kota"
                style=""                 value="3273">
            </select>
        </div>
        
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="kecamatan"> Kecamatan </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="kecamatan" id="kecamatan"
                style=""                 value="" 
                 
                 />
        </div>
        <div class="edit-group" style="">
            <label for="kelurahan"> Kelurahan </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="kelurahan" id="kelurahan"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="rt_rw"> RT/RW </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="rt_rw" id="rt_rw"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="kode_pos"> Kode Pos </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="kode_pos" id="kode_pos"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="telepon_rumah"> No Telepon Rumah </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="telepon_rumah" id="telepon_rumah"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="telepon_kantor"> No Telepon Kantor </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="telepon_kantor" id="telepon_kantor"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="telepon_hp"> No Hp </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="telepon_hp" id="telepon_hp"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-12 col-md-12 col-lg-12 datapanel" style="">
        <h4 
            class="crud-edit" 
            style="margin-top: 5px; padding-bottom:4px; border-bottom: 1px solid #bcc;" >
        Pemasangan        </h4>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-6 col-lg-6 datapanel" style="">
        <div class="edit-group" style="">
            <label for="paket">Paket yang di pilih</label>
            <select class="form-control crud-edit" 
                name="paket" id="paket"
                data-lookup-paramlist=""
                data-lookup-refresh=""
                data-lookup-name="paket"
                style=""                 value="">
            </select>
        </div>
        
        <div class="edit-group" style="">
            <label for="psg_alamat">Alamat</label>
            <textarea class="form-control crud-edit" 
                id="psg_alamat" name="psg_alamat" 
                style=""                 ></textarea>
        </div>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="psg_provinsi_id">Provinsi</label>
            <select class="form-control crud-edit lookup-refresh" 
                name="psg_provinsi_id" id="psg_provinsi_id"
                data-lookup-paramlist=""
                data-lookup-refresh="psg_kota_id"
                data-lookup-name="provinsi"
                style=""                 value="32">
            </select>
        </div>
        
        <div class="edit-group" style="">
            <label for="psg_kota_id">Kota</label>
            <select class="form-control crud-edit" 
                name="psg_kota_id" id="psg_kota_id"
                data-lookup-paramlist="psg_provinsi_id"
                data-lookup-refresh=""
                data-lookup-name="psg_kota"
                style=""                 value="3273">
            </select>
        </div>
        
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="psg_kecamatan"> Kecamatan </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="psg_kecamatan" id="psg_kecamatan"
                style=""                 value="" 
                 
                 />
        </div>
        <div class="edit-group" style="">
            <label for="psg_kelurahan"> Kelurahan </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="psg_kelurahan" id="psg_kelurahan"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="psg_rt_rw"> RT/RW </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="psg_rt_rw" id="psg_rt_rw"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="psg_kode_pos"> Kode Pos </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="psg_kode_pos" id="psg_kode_pos"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="psg_telepon_rumah"> No Telepon Rumah </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="psg_telepon_rumah" id="psg_telepon_rumah"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-12 col-md-12 col-lg-12 datapanel" style="">
        <h4 
            class="crud-edit" 
            style="margin-top: 5px; padding-bottom:4px; border-bottom: 1px solid #bcc;" >
        Keluarga yang tidak tinggal serumah        </h4>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-6 col-lg-6 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_nama"> Nama </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="klg_nama" id="klg_nama"
                style=""                 value="" 
                 
                 />
        </div>
        <div class="edit-group" style="">
            <label for="klg_alamat">Alamat</label>
            <textarea class="form-control crud-edit" 
                id="klg_alamat" name="klg_alamat" 
                style=""                 ></textarea>
        </div>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_provinsi_id">Provinsi</label>
            <select class="form-control crud-edit lookup-refresh" 
                name="klg_provinsi_id" id="klg_provinsi_id"
                data-lookup-paramlist=""
                data-lookup-refresh="klg_kota_id"
                data-lookup-name="provinsi"
                style=""                 value="32">
            </select>
        </div>
        
        <div class="edit-group" style="">
            <label for="klg_kota_id">Kota</label>
            <select class="form-control crud-edit" 
                name="klg_kota_id" id="klg_kota_id"
                data-lookup-paramlist="klg_provinsi_id"
                data-lookup-refresh=""
                data-lookup-name="klg_kota"
                style=""                 value="3273">
            </select>
        </div>
        
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_kecamatan"> Kecamatan </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="klg_kecamatan" id="klg_kecamatan"
                style=""                 value="" 
                 
                 />
        </div>
        <div class="edit-group" style="">
            <label for="klg_kelurahan"> Kelurahan </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="klg_kelurahan" id="klg_kelurahan"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_rt_rw"> RT/RW </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="klg_rt_rw" id="klg_rt_rw"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_kode_pos"> Kode Pos </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="klg_kode_pos" id="klg_kode_pos"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_telepon_rumah"> No Telepon Rumah </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="klg_telepon_rumah" id="klg_telepon_rumah"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_telepon_kantor"> No Telepon Kantor </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="klg_telepon_kantor" id="klg_telepon_kantor"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_telepon_hp"> No Hp </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="klg_telepon_hp" id="klg_telepon_hp"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-12 col-md-12 col-lg-12 datapanel" style="">
        <h4 
            class="crud-edit" 
            style="margin-top: 5px; padding-bottom:4px; border-bottom: 1px solid #bcc;" >
        Pengiriman Tagihan        </h4>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-6 col-lg-6 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tgh_alamat">Alamat</label>
            <textarea class="form-control crud-edit" 
                id="tgh_alamat" name="tgh_alamat" 
                style=""                 ></textarea>
        </div>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tgh_provinsi_id">Provinsi</label>
            <select class="form-control crud-edit lookup-refresh" 
                name="tgh_provinsi_id" id="tgh_provinsi_id"
                data-lookup-paramlist=""
                data-lookup-refresh="tgh_kota_id"
                data-lookup-name="provinsi"
                style=""                 value="32">
            </select>
        </div>
        
        <div class="edit-group" style="">
            <label for="tgh_kota_id">Kota</label>
            <select class="form-control crud-edit" 
                name="tgh_kota_id" id="tgh_kota_id"
                data-lookup-paramlist="tgh_provinsi_id"
                data-lookup-refresh=""
                data-lookup-name="tgh_kota"
                style=""                 value="3273">
            </select>
        </div>
        
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tgh_kecamatan"> Kecamatan </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="tgh_kecamatan" id="tgh_kecamatan"
                style=""                 value="" 
                 
                 />
        </div>
        <div class="edit-group" style="">
            <label for="tgh_kelurahan"> Kelurahan </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="tgh_kelurahan" id="tgh_kelurahan"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tgh_rt_rw"> RT/RW </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="tgh_rt_rw" id="tgh_rt_rw"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tgh_kode_pos"> Kode Pos </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="tgh_kode_pos" id="tgh_kode_pos"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tgh_telepon_rumah"> No Telepon Rumah </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="tgh_telepon_rumah" id="tgh_telepon_rumah"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-12 col-md-12 col-lg-12 datapanel" style="">
        <h4 
            class="crud-edit" 
            style="margin-top: 5px; padding-bottom:4px; border-bottom: 1px solid #bcc;" >
        Data Lainnya        </h4>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="kode_pelanggan"> Kode Pelanggan </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="kode_pelanggan" id="kode_pelanggan"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="nama_sales"> Nama Sales </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="nama_sales" id="nama_sales"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="kode_penjualan"> Kode Penjualan </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="kode_penjualan" id="kode_penjualan"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tanggal_survey">Tanggal survei</label>
            <div class="input-group" style="padding:0px">
                <input class="form-control date-picker crud-edit" type="text" 
                    data-date-format="dd-mm-yyyy" 
                    name="tanggal_survey" id="tanggal_survey" 
                    style=""                      
                    value="" />
                <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="nama_petugas_survey"> Petugas Survei </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="nama_petugas_survey" id="nama_petugas_survey"
                style=""                 value="" 
                 
                 />
        </div>
    </div>
</div>
    </div>                                                                    
</div>
<div class="row" style="">
    <div class="pull-left command-container" >
        <button data-dismiss="modal" id="canceledit" class="btn btn-default btn-sm" style="margin-top:20px;">Cancel</button>
        <button id="crudexecute" class="btn btn-info btn-sm crudexecute" style="margin-top:20px;">OK</button>
    </div>                                                                    
</div>
</form>