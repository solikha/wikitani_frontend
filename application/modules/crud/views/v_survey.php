<?php if (!defined( 'BASEPATH')) exit( 'No direct script access allowed'); /* Manggu Framework * Simple PHP Application Development * Kusnassriyanto S. Bahri * kusnassriyanto@gmail.com * */ ?>
<html>
        <head>
            <link rel="stylesheet" href="<?php echo base_url(); ?>themes/aceadmin/css/bootstrap.min.css" />
            <link rel="stylesheet" href="<?php echo base_url(); ?>themes/aceadmin/css/font-awesome.min.css" />
        </head>
<body>
<style>
   .data_value{
      font-style: italic;
	  display: block;
	  color:#8C8C94;
	  border:#EBE6E6 solid 1px;
	  height:20px;
   }
   .data_value_lebar_high{
      font-style: italic;
	  display: block;
	  color:#8C8C94;
	  border:#EBE6E6 solid 1px;
	  height:80px;
   }
   .data_value_lebar_medium{
      font-style: italic;
	  display: block;
	  color:#8C8C94;
	  border:#EBE6E6 solid 1px;
	  height:40px;
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
   .data_label_ceklist{
	  
   }
   .ceklist{
	   border:#EBE6E6 solid 1px;
	  /* height:20px;
	   width:10px;*/
   }
</style>
    <h3>Lokasi Survey</h3>
    <div style="padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px  " class="row">


        <div class="col-xs-6">
			<!--script contoh
            <label class="data_label"> Nama Lokasi Pemasangan </label>
            <div  class="data_value"><span><?php echo $datasurvey['nama_jobsite'];  ?></span></div>
			-->
			<label class="data_label"> Nama Lokasi Pemasangan </label>
            <div class="data_value"><?php echo $datasurvey['nama_jobsite'];  ?></div>
            <label class="data_label"> Alamat Lokasi Pemasangan </label>
            <div class="data_value"><?php echo $datasurvey[ 'psg_alamat'] ?></div>
            <label class="data_label"> Provinsi</label>
            <div class="data_value"><?php echo $datasurvey['nama_provinsi'] ?></div>
            <label class="data_label"> Kota </label>
            <div class="data_value"><?php echo $datasurvey['nama_kota'] ?></div>
			<label class="data_label"> Kecamatan</label>
            <div class="data_value"><?php echo $datasurvey['psg_kecamatan'] ?></div>
        </div>
		
		<div class="col-xs-5">
			<label class="data_label"> Kelurahan </label>
            <div class="data_value"><?php echo $datasurvey['psg_kelurahan'];  ?></div>
            <label class="data_label"> Kode Pos </label>
            <div class="data_value"><?php echo $datasurvey[ 'psg_kode_pos'] ?></div>
            <label class="data_label"> RT/RW</label>
            <div class="data_value"><?php echo $datasurvey['psg_rt_rw'] ?></div>
            <label class="data_label"> Nomor Telepon Rumah </label>
            <div class="data_value"><?php echo $datasurvey['psg_telepon_rumah'] ?></div>
			<label class="data_label"> Nama Pelanggan</label>
            <div class="data_value"><?php echo $datasurvey['nama_pelanggan'] ?></div>
			<label class="data_label"> Alamat Pelanggan</label>
            <div class="data_value"><?php echo $datasurvey['alamat'] ?></div>
        </div>
		
		<div class="col-xs-12"><h3>Hasil Survey</h3></div>	
        <div class="col-xs-6">
			<label class="data_label"> longitude</label>
			
            <div class="data_value"><?php echo $datasurvey['longitude'];  ?></div>
            <label class="data_label">Lattitude</label>
            <div class="data_value"><?php echo $datasurvey[ 'lattitude'] ?></div>
            <label class="data_label">Tanggal Survey</label>
            <div class="data_value"><?php echo $datasurvey['tanggal_survey'] ?></div>
            <label class="data_value_lebar_medium"> Batas Depan Lokasi</label>
            <div class="data_value_lebar_medium"><?php echo $datasurvey['survey_depan'] ?></div>
			<label class="data_label"> Batas Kiri Lokasi</label>
            <div class="data_value_lebar_medium"><?php echo $datasurvey['survey_kiri'] ?></div>
        </div>
		<div class="col-xs-5">
			<label class="data_label">Batas Kanan Lokasi</label>
            <div class="data_value_lebar_medium"><?php echo $datasurvey['survey_kanan'];  ?></div>
            <label class="data_label">Batas Belakang</label>
            <div class="data_value_lebar_medium"><?php echo $datasurvey[ 'survey_belakang'] ?></div>
            <label class="data_label"> Catatan</label>
			 <div class="data_value_lebar_high"><?php echo $datasurvey[ 'survey_catatan'] ?></div>
        </div>
		
		<div class="col-xs-12"><h3>Rekomendasi</h3></div>	
        <div class="col-xs-6">
			<label class="data_value_lebar_medium">Rekomendasi Paket</label>
            <div class="data_value_lebar_medium"><?php echo $datasurvey['survey_rkmd_paket'];  ?></div>
            <label class="data_value_lebar_medium">Rekomendasi Peralatan Dan Pembagian Zona </label>
            <div class="data_value_lebar_medium"><?php echo $datasurvey[ 'survey_rkmd_peralatan'] ?></div>
        </div>
		<div class="col-xs-5">
			<label class="data_label">Rekomendasi Petugas Keamanan</label>
            <div class="data_value_lebar_medium"><?php echo $datasurvey['survey_rkmd_security'];  ?></div>
			<div><hr></div>
			<label class="data_label">Check List</label>
            <div class="data_value_ceklist">
				<input type="check" class="ceklist"/>
				<label class="data_label_ceklist">Longitude</label>
			</div> 
            <div class="data_value_ceklist">
				<input type="check" class="ceklist"/>
				<label class="data_label_ceklist">Lattitude</label>
			</div>
            <div class="data_value_ceklist">
				<input type="check" class="ceklist"/>
				<label class="data_label_ceklist">Foto Lokasi</label>
			</div>
            <div class="data_value_ceklist">
				<input type="check" class="ceklist"/>
				<label class="data_label_ceklist">Denah Lokasi</label>
		    </div>
        </div>
	</div>
<script>
</script>
</body>
</html>
