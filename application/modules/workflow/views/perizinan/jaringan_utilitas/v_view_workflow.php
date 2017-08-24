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

$baseurl = base_url().index_page() . "/workflow/wftest/";

$urlgetlampirans = $baseurl . "getlampirans";
$urljenislampiran = $baseurl . "getjenislampirans";
$urldocfields = $baseurl . "getdocfields";
$urlsubmitform = $baseurl . "docsimpan";
$urldownload = $baseurl . "download";
$urldelete = $baseurl . "delete";
 
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
					Proses Perizinan Jaringan Utilitas
					<small>View Data</small>
				</h3>
        
				<div class="edit-group" style="">
					<label for="customername">Nama Lengkap</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="customername" id="customername"
						style="" value="" disabled/>
				</div>
        
				<div class="edit-group" style="">
					<label for="nama_perusahaan">Nama Perusahaan</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="nama_perusahaan" id="nama_perusahaan"
						style="" value="" disabled/>
				</div>
			
					<h4>Lokasi yang dimintakan izin :</h4>
        	
					<div class="edit-group" style="">
						<label for="kelurahan">Kelurahan</label>
						<input type="text" class="form-control crud-edit" placeholder="" 
							name="kelurahan" id="kelurahan"
							style="" value="" disabled/>
					</div>
				
					<div class="edit-group" style="">
						<label for="kecamatan">Kecamatan</label>
						<input type="text" class="form-control crud-edit" placeholder="" 
							name="kecamatan" id="kecamatan"
							style="" value="" disabled/>
					</div>
				
					<div class="edit-group" style="">
						<label for="kota">Kota Administrasi</label>
						<input type="text" class="form-control crud-edit" placeholder="" 
							name="kota" id="kota"
							style="" value="" disabled/>
					</div>

					<div class="edit-group" style="">
						<label for="luas_tanah">Luas Tanah</label>
						<div class="input-group">
							<input type="text" class="form-control crud-edit" placeholder="" 
								name="luas_tanah" id="luas_tanah"
								style="" value="" disabled/>
							<span class="input-group-addon">
								m<sup>2</sup>
							</span>
						</div>
					</div>			
					
			</div>

		</div><br>
		
		<div id="content">
			<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
				<li class="active"><a href="#red" data-toggle="tab">Detail</a></li>
				<li><a href="#orange" data-toggle="tab">Dokumen</a></li>
				<li><a href="#yellow" data-toggle="tab">Kegiatan</a></li>
				<li><a href="#green" data-toggle="tab">History</a></li>
			</ul>

<!--- Kode Untuk TAB --->	
			
			<div id="my-tab-content" class="tab-content">
			
				<div class="tab-pane active" id="red">

<!--- Detail Data Pemohon --->

<input type="hidden" name="final_screen_url" value="<?php echo base_url().index_page();?>/menu/home">
<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px">
    <div class="col-xs-12 col-sm-12">
        <div class="row" style="">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 datapanel" style="">
			
				<div class="page-header">
				<h1>Data Pemohon</h1>
				</div>
				
					<div class="edit-group" style="">
						<label for="id-date-picker-1">Tanggal Permohonan</label>
						<div class="input-group">
							<input class="form-control date-picker" id="tanggal_permohonan" name="tanggal_permohonan" data-date-format="dd-mm-yyyy" type="text" disabled/>
							<span class="input-group-addon">
							<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
					<script>
					OnReadyArray.push(function(){
							//datepicker plugin
							//link
							$('.date-picker').datepicker({
								autoclose: true,
								todayHighlight: true
							})
							//show datepicker when clicking on the icon
							.next().on(ace.click_event, function(){
								$(this).prev().focus();
							});
					});
					</script>   
				<div class="edit-group" style="">
					<label for="customername">Nama Lengkap</label>
					<input type="text" class="form-control crud-edit duplicate-field" placeholder="" 
						name="customername" id="customername"
						style="" value="" disabled/>
				</div>
        
				<div class="edit-group" style="">
					<label for="alamat_pemohon">Alamat</label>
					<textarea class="form-control crud-edit valid" id="alamat_pemohon" 
							name="alamat_pemohon" style="height: 94px" aria-invalid="false" disabled/></textarea>
				</div>  
				
				<div class="edit-group" style="">
					<label for="notelepon_pemohon">Nomor Telepon</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="notelepon_pemohon" id="notelepon_pemohon"
						style="" value="" size=12 maxlength=12 onKeyPress="return numbersonly (this, event)" disabled/>
				</div>
			
			</div>
		</div>
		
        <div class="row" style="">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 datapanel" style="">
				<h4>Data Perusahaan :</h4>
        
				<div class="edit-group" style="">
					<label for="nama_perusahaan">Nama Perusahaan</label>
					<input type="text" class="form-control crud-edit duplicate-field" placeholder="" 
						name="nama_perusahaan" id="nama_perusahaan"
						style="" value="" disabled/>
				</div>
        
				<div class="edit-group" style="">
					<label for="alamat_perusahaan">Alamat Perusahaan</label>
					<textarea class="form-control crud-edit valid" id="alamat_perusahaan" 
							name="alamat_perusahaan" style="height: 94px" aria-invalid="false" disabled/></textarea>
				</div>  
				
				<div class="edit-group" style="">
					<label for="notelepon_perusahaan">Nomor Telepon</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="notelepon_perusahaan" id="notelepon_perusahaan"
						style="" value="" size=12 maxlength=12 onKeyPress="return numbersonly (this, event)" disabled/>
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
						style="" value="" disabled/>
				</div>
				
				<div class="edit-group" style="">
					<label for="kelurahan">Kelurahan</label>
					<input type="text" class="form-control crud-edit duplicate-field" placeholder="" 
						name="kelurahan" id="kelurahan"
						style="" value="" disabled/>
				</div>
				
				<div class="edit-group" style="">
					<label for="kecamatan">Kecamatan</label>
					<input type="text" class="form-control crud-edit duplicate-field" placeholder="" 
						name="kecamatan" id="kecamatan"
						style="" value="" disabled/>
				</div>
				
				<div class="edit-group" style="">
					<label for="kota">Kota Administrasi</label>
					<input type="text" class="form-control crud-edit duplicate-field" placeholder="" 
						name="kota" id="kota"
						style="" value="" disabled/>
				</div>
				
				<div class="edit-group" style="">
					<label for="penggunaan">Penggunaan Bangunan</label>
					<input type="text" class="form-control crud-edit" placeholder="" 
						name="penggunaan" id="penggunaan"
						style="" value="" disabled/>
				</div>

				<div class="edit-group" style="">
					<label for="luas_tanah">Luas Tanah</label>
					<div class="input-group">
						<input type="text" class="form-control crud-edit duplicate-field" placeholder="" 
							name="luas_tanah" id="luas_tanah"
							style="" value="" disabled/>
						<span class="input-group-addon">
							m<sup>2</sup>
						</span>
					</div>
				</div>
				
			</div>
		</div>
					
	</div>
</div>                                                                    			
				
				</div>
				
				<div class="tab-pane" id="orange">
				
<!--- Detail Dokumen --->

<input type="hidden" name="final_screen_url" value="<?php echo base_url().index_page();?>/menu/home">
<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px">
    
    <div class="page-header">
    <h1>Lampiran</h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <table id="list-lampiran" class="table table-striped table-bordered table-hover detail_table">
            <thead>
                <tr>
                    <th>Nama Dokumen</th>
                    <th>Jenis Dokumen</th>
                    <th>Lokasi</th>
                    <th>Jenis File</th>
                    <th width="15%"></th>
                </tr>
            </thead>
            <tbody id="data" name="data"></tbody>
        </table>
    </div>
</div>
    
</div>

				</div>
				
				<div class="tab-pane" id="yellow">
				
<!--- Detail Kegiatan --->
				<div class="page-header">
				<h1>Kegiatan Disini</h1>
				</div>
				
				</div>
				
				<div class="tab-pane" id="green">
				
<!--- Detail History --->
				<div class="page-header">
				<h1>History Disini</h1>
				</div>

				</div>
				
			</div>
		</div> 
		
	</div>
</div>

<div class="row" style="">
    <div class="pull-left command-container" >
		<a href="<?php echo base_url().index_page();?>/menu/permohonan_perizinan"
		data-dismiss="modal" id="canceledit" class="btn btn-default btn-sm" style="margin-top:20px; margin-left:20px;">
		Cancel</a>

    </div>                                                                    
</div>
</form>

<SCRIPT TYPE="text/javascript">
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

//-->
</SCRIPT>

<script type="text/javascript">
OnReadyArray.push(function(){
	jQuery(document).ready(function ($) {
	$('#tabs').tab();
	});
});
</script>

<script type="text/javascript">
    var vwfid=0;
    
    var vonload;

        function onclickevent(e) {

            e.preventDefault();

            console.log('clicked, lampiran id: ' + $(this).data("lampiranid"));
            var lampiranid = $(this).data("lampiranid");
            if (confirm("Anda yakin akan menghapus data ini? (Perintah ini tidak dapat di-undo)")) {
                $.ajax({
                    url: "<?php echo $urldelete; ?>",
                    type: "POST",
                    data: { lampiranid: lampiranid },
                    dataType: "json",
                    success: function(data, textStatus, jqXHR) {
                        console.log("menghapus data berhasil");
                        loaddata();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Telah terjadi kesalahan: " + errorThrown);
                    }
                });
            }
        }

        function oneditevent(e) {

            e.preventDefault();
            console.log(e.currentTarget);
            console.log($(e.currentTarget).attr('data-id'));
            //alert('edit');
            dataid = $(e.currentTarget).attr('data-id');
            console.log(dataid);
            $.ajax({
                url: "<?php //echo $urledit; ?>",
                type: "POST",
                data: { lampiranid: dataid },
                dataType: "json",
                success: function(data, textStatus, jqXHR) {
                    console.log(data);
                    //alert('sukses');
                    //console.log("menghapus data berhasil");
                    //loaddata();
                    Manggu.Crud.showModal({
                        width: 800,
                        modalname: 'modal-form2',
                        onload: vonload2
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Telah terjadi kesalahan: " + errorThrown);
                    alert('error');
                }
            });
        }

    function loaddata() {

        $.ajax({
            url: "<?php echo $urlgetlampirans; ?>",
            type: "POST",
            dataType: "json",
            data: { workflowid: vwfid },
            success: function(data, textStatus, jqXHR) {
                // console.log("Load data berhasil.");
                // console.log(data);

                $('#data').empty();
                for (var i = 0; i < data.length; i++) {

                    var download = "";
                    if (data[i].filename) {
                        download = $('<a>')
                                .attr('class', 'btn btn-minier')
                                .attr('href', '<?php echo $urldownload; ?>/' + data[i].lampiranid)
                                .attr('target', '_blank')
                                .attr('title', 'Download')
                                .append('<i class="ace-icon fa fa-download"></i>');
                    } 
                    $('#data').append($('<tr>')
                        .append('<td>'+data[i].namadokumen+'</td>')
                        .append('<td>'+data[i].namajenis+'</td>')
                        .append('<td>'+data[i].lokasi+'</td>')
                        .append('<td>'+data[i].jenisfile+'</td>')
                        .append($('<td>')
//                            .append($('<a>')
//                                .attr('class', 'btn btn-xs')
//                                .attr('href', '#')
//                                .attr('title', 'Edit')
//                                .attr('data-id', data[i].lampiranid)
//                                .click(oneditevent)
//                                .append('<i class="ace-icon fa fa-pencil-square-o"></i>')
//                            )
                            .append(" ")
                            .append($('<a>')
                                .attr('class', 'btn btn-minier delete btn-danger')
                                .attr('href', '#')
                                .attr('title', 'Delete')
                                .data('lampiranid', data[i].lampiranid)
                                .click(onclickevent)
                                .append('<i class="ace-icon fa fa-trash-o"></i>')
                            )
                            .append(" ")
                            .append(download)
                        )
                    );
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("ERRORS : " + errorThrown);
            }
        });

    }
    
    OnReadyArray.push(function() {
        vwfid = document.forms.namedItem("edit-form").elements['workflowid'].value;
        $('#modal_workflowid').val(vwfid);
    
    
        $('#btn_tambah').click(function(){
            Manggu.Crud.showModal({
                width: 800,
                modalname: 'modal-form',
                onload: vonload
            });
        });
        loaddata();
        
        
        
    });
    vonload = function() {
        // Inisialisasi file input uploader
        $('#modal-form input[type=file]').ace_file_input({
            style: 'well',
            btn_choose: 'Drop file here or click to choose',
            btn_change: null,
            no_icon: 'ace-icon fa fa-cloud-upload',
            droppable: true,
            thumbnail: 'large'
        })
        // END Inisialisasi file input uploader


        // Ketika jenis dokumen yang dipilih berubah
        // Load field untuk jenis dokumen tersebut
        $('#jenisdokumen').on('change', function() {

            var jenisdokumenid = $("#jenisdokumen").val();

            $.ajax({
                url: "<?php echo $urldocfields; ?>",
                type: "POST",
                dataType: "json",
                data: { jenislampiranid: jenisdokumenid },
                success: function(data, textStatus, jqXHR) {
                    // console.log(msg);
                    $(".doc-fields").html('');
                    for (var i = 0; i < data.length; i++) {
                        $(".doc-fields").append('<div class="form-group"><label for="'+data[i].nama+'">'+data[i].label+'</label><div><input type="text" name="'+data[i].nama+'" id="'+data[i].nama+'" class="form-control" /></div></div>');
                    }
                }
            });
        });
        // END Change


        var lokasicontainer = $('#lokasi').parent().parent();
        lokasicontainer.hide();
        $('#jenisfile').on('change', function(e) {
            var jenisfile = $('#jenisfile').val();

            if (jenisfile === 'digital') {
                $('#modal-form input[type=file]').ace_file_input('enable');
                lokasicontainer.hide('slow');
                $('#lokasi').val('');
            } else if (jenisfile === 'fisik') {
                $('#modal-form input[type=file]').ace_file_input('reset_input');
                $('#modal-form input[type=file]').ace_file_input('disable');
                
//                var vinput = $('#modal-form input[type=file]');
//                vinput.replaceWith(vinput.val('').clone(true));
                lokasicontainer.show('slow');
            }
        });

        /* BEGIN LOAD OPSI JENIS LAMPIRAN */
        $.ajax({
            url: "<?php echo $urljenislampiran; ?>",
            type: "POST",
            dataType: "json",
            success: function(data, textStatus, jqXHR){
                $('#jenisdokumen').html('');
                for(var i=0; i < data.length; i++) {
                    $('#jenisdokumen').append("<option value='" + data[i].jenislampiranid + "'>" + data[i].namajenis + "</option>");
                }
                $('#jenisdokumen').change();
            }
        });
        /* END LOAD */

        // BEGIN SUBMIT FORM
        $('#docform').on('submit', function(e) {
            e.preventDefault();

            var docform = $('#docform');
            var fd = new FormData();
            $.each(docform.serializeArray(), function(i, item) {
                fd.append(item.name, item.value);
            });

            docform.find('input[type=file]').each(function() {
                var field_name = $(this).attr('name');
                var files = $(this).data('ace_input_files');
                if (files && files.length > 0) {
                    for (var f = 0; f < files.length; f++) {
                        fd.append(field_name, files[f]);
                    }
                }
            })

            $.ajax({
                url: "<?php echo $urlsubmitform; ?>",
                type: "POST",
                processData: false,
                contentType: false,
                dataType: "json",
                data: fd,
                success: function(data, textStatus, jqXHR) {
                    if (typeof data.error === 'undefined') {
                        $('#modal-form').modal('hide');
                        loaddata();

                        // CLEAR CONTROLS
                        $('#docform input[type=text]').each(function(index) {
                            $(this).val('');
                        });
                        $('#modal-form input[type=file]').ace_file_input('reset_input');
                        // END CLEAR CONTROLS
                    } else {
                        console.log("ERRORS : " + data.error);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("ERRORS : " + textStatus);
                }
            });
        });
        // END SUBMIT FORM

    };
    
</script>


