<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
if (!isset($cancel_target)){
    $cancel_target = 'menu/persetujuan_perizinan';
}

?>
<form id="edit-form" action="<?php echo $form_action;?>" method="post">
<?php echo $control_fields; ?>
<!------ -->
<input type="hidden" name="final_screen_url" value="<?php echo base_url().index_page();?>/menu/home">
<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px">
    <div class="col-xs-12 col-sm-12">
        <div class="row" style="">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 datapanel" style="">
				<h3 class="header lighter blue">
					Proses Perizinan IMP Reklamasi
					<small>Tanda Tangan Kepala Bidang Reklamasi</small>
				</h3>
				<h4>Data Pemohon :</h4>
				<div class="edit-group" style="">
					<label for="customername">Tanggal Permohonan</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						id="tanggal_permohonan" name="tanggal_permohonan" 
						style="" value="" disabled="disabled"/>
				</div>
				<div class="edit-group" style="">
					<label for="customername">Nama Lengkap</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="customername" id="customername"
						style="" value="" disabled="disabled"/>
				</div>
        
				<div class="edit-group" style="">
					<label for="alamat_pemohon">Alamat</label>
					<textarea class="form-control crud-edit valid" id="alamat_pemohon" 
							name="alamat_pemohon" style="height: 94px" aria-invalid="false"  disabled="disabled"></textarea>
				</div>  
				
				<div class="edit-group" style="">
					<label for="notelepon_pemohon">Nomor Telepon</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="notelepon_pemohon" id="notelepon_pemohon"
						style="" value="" size=12 maxlength=12 onKeyPress="return numbersonly (this, event)" disabled="disabled"/>
				</div>
			
			</div>
		</div>
		
        <div class="row" style="">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 datapanel" style="">
				<h4>Data Perusahaan :</h4>
        
				<div class="edit-group" style="">
					<label for="nama_perusahaan">Nama Perusahaan</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="nama_perusahaan" id="nama_perusahaan"
						style="" value="" disabled="disabled"/>
				</div>
        
				<div class="edit-group" style="">
					<label for="alamat_perusahaan">Alamat Perusahaan</label>
					<textarea class="form-control crud-edit valid" id="alamat_perusahaan" 
							name="alamat_perusahaan" style="height: 94px" aria-invalid="false" disabled="disabled" ></textarea>
				</div>  
				
				<div class="edit-group" style="">
					<label for="notelepon_perusahaan">Nomor Telepon</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="notelepon_perusahaan" id="notelepon_perusahaan"
						style="" value="" size=12 maxlength=12 onKeyPress="return numbersonly (this, event)"/ disabled="disabled">
				</div>
			</div>
		</div>
		
        <div class="row" style="">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 datapanel" style="">
			
				<h4>Lokasi yang dimintakan izin :</h4>
        
				<div class="edit-group" style="">
					<label for="jalan">Jalan / RT / RW</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="jalan" id="jalan"
						style="" value="" disabled="disabled"/>
				</div>
				
				<div class="edit-group" style="">
					<label for="kelurahan">Kelurahan</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="kelurahan" id="kelurahan"
						style="" value="" disabled="disabled"/>
				</div>
				
				<div class="edit-group" style="">
					<label for="kecamatan">Kecamatan</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="kecamatan" id="kecamatan"
						style="" value="" disabled="disabled"/>
				</div>
				
				<div class="edit-group" style="">
					<label for="kota">Kota Administrasi</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="kota" id="kota"
						style="" value="" disabled="disabled"/>
				</div>
				
				<div class="edit-group" style="">
					<label for="penggunaan">Penggunaan Bangunan</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="penggunaan" id="penggunaan"
						style="" value="" disabled="disabled"/>
				</div>

				<div class="edit-group" style="">
					<label for="luas_tanah">Luas Tanah</label>
					<div class="input-group">
						<input type="text" class="form-control crud-edit" placeholder="" 
							name="luas_tanah" id="luas_tanah"
							style="" value="" disabled="disabled"/>
						<span class="input-group-addon">
							m<sup>2</sup>
						</span>
					</div>
				</div>
				
			</div>
		</div>
					
	</div>
</div>  
	<!----jangan ditimpa------>
<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px">
    <div class="col-xs-12 col-sm-12">
		<div class="row" style="">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 datapanel" style="">
				<div class="edit-group" style="">
					<label for="penggunaan">TTD Oleh:</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="ttd_oleh" id="ttd_oleh"
						style="" value="" disabled="disabled"/>
				</div>
			</div>
		</div>	                                                                
        <div class="row" style="">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 datapanel" style="">
				<div class="checkbox" style="padding-top:0px; padding-left:0px">
					<label>
						<input name="data_ok" id="data_ok" type="checkbox" class="ace" />
						<span class="lbl">Data sudah benar</span>
					</label>
				</div>	
			</div>		
		</div>	
	</div>
</div>	
<div class="row" style="">
    <div class="pull-left command-container" >
        <a href="<?php echo base_url().index_page().'/'.$cancel_target;?>" data-dismiss="modal" id="canceledit" class="btn btn-default btn-sm" style="margin-top:20px;">Cancel</a>
		<input type="submit" value="previous" name="action" class="btn btn-info btn-sm" style="margin-top:20px;"/>
        <input type="submit" value="Next" name="action" class="btn btn-info btn-sm" style="margin-top:20px;"/>
    </div>                                                                    
</div>
</form>

<script>
function numbersonly(myfield, e, dec)
{
var key;
var keychar;

if (window.event)
   key = window.event.keyCode;
else if (e)
   key = e.which;
else
   return true;
keychar = String.fromCharCode(key);

// control keys
if ((key==null) || (key==0) || (key==8) || 
    (key==9) || (key==13) || (key==27) )
   return true;

// numbers
else if ((("0123456789").indexOf(keychar) > -1))
   return true;

// decimal point jump
else if (dec && (keychar == "."))
   {
   myfield.form.elements[dec].focus();
   return false;
   }
else
   return false;
}

OnReadyArray.push(function(){
    console.log('role');
    console.log(document.forms.namedItem("edit-form").elements['current_roledesc'].value);
    currentrole = document.forms.namedItem("edit-form").elements['current_roledesc'].value;
    $('#ttd_oleh').val(currentrole);
    //console.log(document.formName.elements['next_roledesc'].value);
});

//-->
</script>

