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
?>
<script>
  var data_customer = <?php echo json_encode($customer); ?>;    
  OnReadyArray.push(function(){
      for (var item in data_customer){
          $('#'+item).val(data_customer[item]);
          $('#'+item).prop('disabled', true);
      }
  });
  
</script>
<div class="col-xs-12 col-sm-12">
        <div class="row" style="">
    <div class="col-sm-12 col-md-12 col-lg-12 datapanel" style="">
        <a href="#" class="btn btn-xs btn-info pull-right">Update Data</a>
        <h4 class="crud-edit" style="margin-top: 5px; padding-bottom:4px; border-bottom: 1px solid #bcc;">
        Data Pelanggan</h4>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <input class="form-control crud-edit" placeholder="" name="id" id="id" style="" value="" type="hidden">
        <div class="edit-group" style="">
            <label for="jpelanggan_id">Jenis Pelanggan</label>
            <select class="form-control crud-edit" name="jpelanggan_id" id="jpelanggan_id" data-lookup-paramlist="" data-lookup-refresh="" data-lookup-name="jpelanggan" style="" value="1">
                /r/n<option value="">-- Pilih Jenis Pelanggan --</option>/r/n<option value="1" selected="">Perorangan</option>/r/n<option value="2">Perusahaan</option>            </select>
        </div>
        
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="jpengenal_id">Jenis Tanda Pengenal</label>
            <select class="form-control crud-edit" name="jpengenal_id" id="jpengenal_id" data-lookup-paramlist="" data-lookup-refresh="" data-lookup-name="jpengenal" style="" value="1">
                /r/n<option value="">-- Pilih Jenis Tanda Pengenal --</option>/r/n<option value="1" selected="">KTP</option>/r/n<option value="2">SIM</option>/r/n<option value="3">PASPOR</option>            </select>
        </div>
        
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="nomor_pengenal"> Nomor Tanda Pengenal </label>
            <input class="form-control crud-edit" placeholder="" name="nomor_pengenal" id="nomor_pengenal" style="" value="" type="text">    
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="nama"> Nama </label>
            <input class="form-control crud-edit" placeholder="" name="nama" id="nama" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tempat_lahir"> Tempat Lahir </label>
            <input class="form-control crud-edit" placeholder="" name="tempat_lahir" id="tempat_lahir" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <div class="input-group" style="padding:0px">
                <input class="form-control date-picker crud-edit" data-date-format="dd-mm-yyyy" name="tanggal_lahir" id="tanggal_lahir" style="" value="" type="text">
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
            <textarea class="form-control crud-edit" id="alamat" name="alamat" style=""></textarea>
        </div>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="provinsi_id">Provinsi</label>
            <select class="form-control crud-edit lookup-refresh" name="provinsi_id" id="provinsi_id" data-lookup-paramlist="" data-lookup-refresh="kota_id" data-lookup-name="provinsi" style="" value="32">
                /r/n<option value="">-- Pilih Nama Provinsi --</option>/r/n<option value="51">Bali</option>/r/n<option value="36">Banten</option>/r/n<option value="17">Bengkulu</option>/r/n<option value="34">Daerah Istimewa Yogyakarta</option>/r/n<option value="31">Daerah Khusus Ibukota Jakarta</option>/r/n<option value="75">Gorontalo</option>/r/n<option value="15">Jambi</option>/r/n<option value="32" selected="">Jawa Barat</option>/r/n<option value="33">Jawa Tengah</option>/r/n<option value="35">Jawa Timur</option>/r/n<option value="61">Kalimantan Barat</option>/r/n<option value="63">Kalimantan Selatan</option>/r/n<option value="62">Kalimantan Tengah</option>/r/n<option value="64">Kalimantan Timur</option>/r/n<option value="19">Kepulauan Bangka Belitung</option>/r/n<option value="21">Kepulauan Riau</option>/r/n<option value="18">Lampung</option>/r/n<option value="99">Luar Jabar DKI</option>/r/n<option value="81">Maluku</option>/r/n<option value="82">Maluku Utara</option>/r/n<option value="11">Nangroe Aceh Darussalam</option>/r/n<option value="52">Nusa Tenggara Barat</option>/r/n<option value="53">Nusa Tenggara Timur</option>/r/n<option value="91">Papua</option>/r/n<option value="92">Papua Barat</option>/r/n<option value="14">Riau</option>/r/n<option value="76">Sulawesi Barat</option>/r/n<option value="73">Sulawesi Selatan</option>/r/n<option value="72">Sulawesi Tengah</option>/r/n<option value="74">Sulawesi Tenggara</option>/r/n<option value="71">Sulawesi Utara</option>/r/n<option value="13">Sumatera Barat</option>/r/n<option value="16">Sumatera Selatan</option>/r/n<option value="12">Sumatera Utara</option>            </select>
        </div>
        
        <div class="edit-group" style="">
            <label for="kota_id">Kota</label>
            <select class="form-control crud-edit" name="kota_id" id="kota_id" data-lookup-paramlist="provinsi_id" data-lookup-refresh="" data-lookup-name="kota" style="" value="3273">
                /r/n<option value="">-- Pilih Nama Kota --</option>/r/n<option value="3204">Kabupaten Bandung</option>/r/n<option value="3217">Kabupaten Bandung Barat</option>/r/n<option value="3216">Kabupaten Bekasi</option>/r/n<option value="3201">Kabupaten Bogor</option>/r/n<option value="3207">Kabupaten Ciamis</option>/r/n<option value="3203">Kabupaten Cianjur</option>/r/n<option value="3209">Kabupaten Cirebon</option>/r/n<option value="3205">Kabupaten Garut</option>/r/n<option value="3212">Kabupaten Indramayu</option>/r/n<option value="3215">Kabupaten Karawang</option>/r/n<option value="3208">Kabupaten Kuningan</option>/r/n<option value="3210">Kabupaten Majalengka</option>/r/n<option value="3214">Kabupaten Purwakarta</option>/r/n<option value="3213">Kabupaten Subang</option>/r/n<option value="3202">Kabupaten Sukabumi</option>/r/n<option value="3211">Kabupaten Sumedang</option>/r/n<option value="3206">Kabupaten Tasikmalaya</option>/r/n<option value="3273" selected="">Kota Bandung</option>/r/n<option value="3279">Kota Banjar</option>/r/n<option value="3275">Kota Bekasi</option>/r/n<option value="3271">Kota Bogor</option>/r/n<option value="3277">Kota Cimahi</option>/r/n<option value="3274">Kota Cirebon</option>/r/n<option value="3276">Kota Depok</option>/r/n<option value="3272">Kota Sukabumi</option>/r/n<option value="3278">Kota Tasikmalaya</option>            </select>
        </div>
        
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="kecamatan"> Kecamatan </label>
            <input class="form-control crud-edit" placeholder="" name="kecamatan" id="kecamatan" style="" value="" type="text">
        </div>
        <div class="edit-group" style="">
            <label for="kelurahan"> Kelurahan </label>
            <input class="form-control crud-edit" placeholder="" name="kelurahan" id="kelurahan" style="" value="" type="text">
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="rt_rw"> RT/RW </label>
            <input class="form-control crud-edit" placeholder="" name="rt_rw" id="rt_rw" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="kode_pos"> Kode Pos </label>
            <input class="form-control crud-edit" placeholder="" name="kode_pos" id="kode_pos" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="telepon_rumah"> No Telepon Rumah </label>
            <input class="form-control crud-edit" placeholder="" name="telepon_rumah" id="telepon_rumah" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="telepon_kantor"> No Telepon Kantor </label>
            <input class="form-control crud-edit" placeholder="" name="telepon_kantor" id="telepon_kantor" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="telepon_hp"> No Hp </label>
            <input class="form-control crud-edit" placeholder="" name="telepon_hp" id="telepon_hp" style="" value="" type="text">
        </div>
    </div>
</div>

<div class="row" style="">
    <div class="col-sm-12 col-md-12 col-lg-12 datapanel" style="">
        <h4 class="crud-edit" style="margin-top: 5px; padding-bottom:4px; border-bottom: 1px solid #bcc;">
        Keluarga yang tidak tinggal serumah        </h4>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-6 col-lg-6 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_nama"> Nama </label>
            <input class="form-control crud-edit" placeholder="" name="klg_nama" id="klg_nama" style="" value="" type="text">
        </div>
        <div class="edit-group" style="">
            <label for="klg_alamat">Alamat</label>
            <textarea class="form-control crud-edit" id="klg_alamat" name="klg_alamat" style=""></textarea>
        </div>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_provinsi_id">Provinsi</label>
            <select class="form-control crud-edit lookup-refresh" name="klg_provinsi_id" id="klg_provinsi_id" data-lookup-paramlist="" data-lookup-refresh="klg_kota_id" data-lookup-name="provinsi" style="" value="32">
                /r/n<option value="">-- Pilih Nama Provinsi --</option>/r/n<option value="51">Bali</option>/r/n<option value="36">Banten</option>/r/n<option value="17">Bengkulu</option>/r/n<option value="34">Daerah Istimewa Yogyakarta</option>/r/n<option value="31">Daerah Khusus Ibukota Jakarta</option>/r/n<option value="75">Gorontalo</option>/r/n<option value="15">Jambi</option>/r/n<option value="32" selected="">Jawa Barat</option>/r/n<option value="33">Jawa Tengah</option>/r/n<option value="35">Jawa Timur</option>/r/n<option value="61">Kalimantan Barat</option>/r/n<option value="63">Kalimantan Selatan</option>/r/n<option value="62">Kalimantan Tengah</option>/r/n<option value="64">Kalimantan Timur</option>/r/n<option value="19">Kepulauan Bangka Belitung</option>/r/n<option value="21">Kepulauan Riau</option>/r/n<option value="18">Lampung</option>/r/n<option value="99">Luar Jabar DKI</option>/r/n<option value="81">Maluku</option>/r/n<option value="82">Maluku Utara</option>/r/n<option value="11">Nangroe Aceh Darussalam</option>/r/n<option value="52">Nusa Tenggara Barat</option>/r/n<option value="53">Nusa Tenggara Timur</option>/r/n<option value="91">Papua</option>/r/n<option value="92">Papua Barat</option>/r/n<option value="14">Riau</option>/r/n<option value="76">Sulawesi Barat</option>/r/n<option value="73">Sulawesi Selatan</option>/r/n<option value="72">Sulawesi Tengah</option>/r/n<option value="74">Sulawesi Tenggara</option>/r/n<option value="71">Sulawesi Utara</option>/r/n<option value="13">Sumatera Barat</option>/r/n<option value="16">Sumatera Selatan</option>/r/n<option value="12">Sumatera Utara</option>            </select>
        </div>
        
        <div class="edit-group" style="">
            <label for="klg_kota_id">Kota</label>
            <select class="form-control crud-edit" name="klg_kota_id" id="klg_kota_id" data-lookup-paramlist="klg_provinsi_id" data-lookup-refresh="" data-lookup-name="klg_kota" style="" value="3273">
                /r/n<option value="">-- Pilih Nama Kota --</option>/r/n<option value="3204">Kabupaten Bandung</option>/r/n<option value="3217">Kabupaten Bandung Barat</option>/r/n<option value="3216">Kabupaten Bekasi</option>/r/n<option value="3201">Kabupaten Bogor</option>/r/n<option value="3207">Kabupaten Ciamis</option>/r/n<option value="3203">Kabupaten Cianjur</option>/r/n<option value="3209">Kabupaten Cirebon</option>/r/n<option value="3205">Kabupaten Garut</option>/r/n<option value="3212">Kabupaten Indramayu</option>/r/n<option value="3215">Kabupaten Karawang</option>/r/n<option value="3208">Kabupaten Kuningan</option>/r/n<option value="3210">Kabupaten Majalengka</option>/r/n<option value="3214">Kabupaten Purwakarta</option>/r/n<option value="3213">Kabupaten Subang</option>/r/n<option value="3202">Kabupaten Sukabumi</option>/r/n<option value="3211">Kabupaten Sumedang</option>/r/n<option value="3206">Kabupaten Tasikmalaya</option>/r/n<option value="3273" selected="">Kota Bandung</option>/r/n<option value="3279">Kota Banjar</option>/r/n<option value="3275">Kota Bekasi</option>/r/n<option value="3271">Kota Bogor</option>/r/n<option value="3277">Kota Cimahi</option>/r/n<option value="3274">Kota Cirebon</option>/r/n<option value="3276">Kota Depok</option>/r/n<option value="3272">Kota Sukabumi</option>/r/n<option value="3278">Kota Tasikmalaya</option>            </select>
        </div>
        
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_kecamatan"> Kecamatan </label>
            <input class="form-control crud-edit" placeholder="" name="klg_kecamatan" id="klg_kecamatan" style="" value="" type="text">
        </div>
        <div class="edit-group" style="">
            <label for="klg_kelurahan"> Kelurahan </label>
            <input class="form-control crud-edit" placeholder="" name="klg_kelurahan" id="klg_kelurahan" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_rt_rw"> RT/RW </label>
            <input class="form-control crud-edit" placeholder="" name="klg_rt_rw" id="klg_rt_rw" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_kode_pos"> Kode Pos </label>
            <input class="form-control crud-edit" placeholder="" name="klg_kode_pos" id="klg_kode_pos" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_telepon_rumah"> No Telepon Rumah </label>
            <input class="form-control crud-edit" placeholder="" name="klg_telepon_rumah" id="klg_telepon_rumah" style="" value="" type="text">
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_telepon_kantor"> No Telepon Kantor </label>
            <input class="form-control crud-edit" placeholder="" name="klg_telepon_kantor" id="klg_telepon_kantor" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="klg_telepon_hp"> No Hp </label>
            <input class="form-control crud-edit" placeholder="" name="klg_telepon_hp" id="klg_telepon_hp" style="" value="" type="text">
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-12 col-md-12 col-lg-12 datapanel" style="">
        <h4 class="crud-edit" style="margin-top: 5px; padding-bottom:4px; border-bottom: 1px solid #bcc;">
        Pengiriman Tagihan        </h4>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-6 col-lg-6 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tgh_alamat">Alamat</label>
            <textarea class="form-control crud-edit" id="tgh_alamat" name="tgh_alamat" style=""></textarea>
        </div>
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tgh_provinsi_id">Provinsi</label>
            <select class="form-control crud-edit lookup-refresh" name="tgh_provinsi_id" id="tgh_provinsi_id" data-lookup-paramlist="" data-lookup-refresh="tgh_kota_id" data-lookup-name="provinsi" style="" value="32">
                /r/n<option value="">-- Pilih Nama Provinsi --</option>/r/n<option value="51">Bali</option>/r/n<option value="36">Banten</option>/r/n<option value="17">Bengkulu</option>/r/n<option value="34">Daerah Istimewa Yogyakarta</option>/r/n<option value="31">Daerah Khusus Ibukota Jakarta</option>/r/n<option value="75">Gorontalo</option>/r/n<option value="15">Jambi</option>/r/n<option value="32" selected="">Jawa Barat</option>/r/n<option value="33">Jawa Tengah</option>/r/n<option value="35">Jawa Timur</option>/r/n<option value="61">Kalimantan Barat</option>/r/n<option value="63">Kalimantan Selatan</option>/r/n<option value="62">Kalimantan Tengah</option>/r/n<option value="64">Kalimantan Timur</option>/r/n<option value="19">Kepulauan Bangka Belitung</option>/r/n<option value="21">Kepulauan Riau</option>/r/n<option value="18">Lampung</option>/r/n<option value="99">Luar Jabar DKI</option>/r/n<option value="81">Maluku</option>/r/n<option value="82">Maluku Utara</option>/r/n<option value="11">Nangroe Aceh Darussalam</option>/r/n<option value="52">Nusa Tenggara Barat</option>/r/n<option value="53">Nusa Tenggara Timur</option>/r/n<option value="91">Papua</option>/r/n<option value="92">Papua Barat</option>/r/n<option value="14">Riau</option>/r/n<option value="76">Sulawesi Barat</option>/r/n<option value="73">Sulawesi Selatan</option>/r/n<option value="72">Sulawesi Tengah</option>/r/n<option value="74">Sulawesi Tenggara</option>/r/n<option value="71">Sulawesi Utara</option>/r/n<option value="13">Sumatera Barat</option>/r/n<option value="16">Sumatera Selatan</option>/r/n<option value="12">Sumatera Utara</option>            </select>
        </div>
        
        <div class="edit-group" style="">
            <label for="tgh_kota_id">Kota</label>
            <select class="form-control crud-edit" name="tgh_kota_id" id="tgh_kota_id" data-lookup-paramlist="tgh_provinsi_id" data-lookup-refresh="" data-lookup-name="tgh_kota" style="" value="3273">
                /r/n<option value="">-- Pilih Nama Kota --</option>/r/n<option value="3204">Kabupaten Bandung</option>/r/n<option value="3217">Kabupaten Bandung Barat</option>/r/n<option value="3216">Kabupaten Bekasi</option>/r/n<option value="3201">Kabupaten Bogor</option>/r/n<option value="3207">Kabupaten Ciamis</option>/r/n<option value="3203">Kabupaten Cianjur</option>/r/n<option value="3209">Kabupaten Cirebon</option>/r/n<option value="3205">Kabupaten Garut</option>/r/n<option value="3212">Kabupaten Indramayu</option>/r/n<option value="3215">Kabupaten Karawang</option>/r/n<option value="3208">Kabupaten Kuningan</option>/r/n<option value="3210">Kabupaten Majalengka</option>/r/n<option value="3214">Kabupaten Purwakarta</option>/r/n<option value="3213">Kabupaten Subang</option>/r/n<option value="3202">Kabupaten Sukabumi</option>/r/n<option value="3211">Kabupaten Sumedang</option>/r/n<option value="3206">Kabupaten Tasikmalaya</option>/r/n<option value="3273" selected="">Kota Bandung</option>/r/n<option value="3279">Kota Banjar</option>/r/n<option value="3275">Kota Bekasi</option>/r/n<option value="3271">Kota Bogor</option>/r/n<option value="3277">Kota Cimahi</option>/r/n<option value="3274">Kota Cirebon</option>/r/n<option value="3276">Kota Depok</option>/r/n<option value="3272">Kota Sukabumi</option>/r/n<option value="3278">Kota Tasikmalaya</option>            </select>
        </div>
        
    </div>
    <div class="col-sm-6 col-md-3 col-lg-3 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tgh_kecamatan"> Kecamatan </label>
            <input class="form-control crud-edit" placeholder="" name="tgh_kecamatan" id="tgh_kecamatan" style="" value="" type="text">
        </div>
        <div class="edit-group" style="">
            <label for="tgh_kelurahan"> Kelurahan </label>
            <input class="form-control crud-edit" placeholder="" name="tgh_kelurahan" id="tgh_kelurahan" style="" value="" type="text">
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tgh_rt_rw"> RT/RW </label>
            <input class="form-control crud-edit" placeholder="" name="tgh_rt_rw" id="tgh_rt_rw" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tgh_kode_pos"> Kode Pos </label>
            <input class="form-control crud-edit" placeholder="" name="tgh_kode_pos" id="tgh_kode_pos" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-2 col-lg-2 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tgh_telepon_rumah"> No Telepon Rumah </label>
            <input class="form-control crud-edit" placeholder="" name="tgh_telepon_rumah" id="tgh_telepon_rumah" style="" value="" type="text">
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-12 col-md-12 col-lg-12 datapanel" style="">
        <h4 class="crud-edit" style="margin-top: 5px; padding-bottom:4px; border-bottom: 1px solid #bcc;">
        Data Lainnya        </h4>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="cust_id"> Kode Pelanggan </label>
            <input class="form-control crud-edit" placeholder="" name="kode_pelanggan" id="kode_pelanggan" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="nama_sales"> Nama Sales </label>
            <input class="form-control crud-edit" placeholder="" name="nama_sales" id="nama_sales" style="" value="" type="text">
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="kode_penjualan"> Kode Penjualan </label>
            <input class="form-control crud-edit" placeholder="" name="kode_penjualan" id="kode_penjualan" style="" value="" type="text">
        </div>
    </div>
</div>
<div class="row" style="">
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="tanggal_survey">Tanggal survei</label>
            <div class="input-group" style="padding:0px">
                <input class="form-control date-picker crud-edit" data-date-format="dd-mm-yyyy" name="tanggal_survey" id="tanggal_survey" style="" value="" type="text">
                <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4 datapanel" style="">
        <div class="edit-group" style="">
            <label for="nama_petugas_survey"> Petugas Survei </label>
            <input class="form-control crud-edit" placeholder="" name="nama_petugas_survey" id="nama_petugas_survey" style="" value="" type="text">
        </div>
    </div>
</div>
    </div>