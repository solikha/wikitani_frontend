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

$form_action = '';

?>
<form id="edit-form" action="<?php echo $form_action;?>" method="post">

<?php //echo $control_fields; ?>
<!------ -->
<input type="hidden" name="final_screen_url" value="<?php echo base_url().index_page();?>/menu/home">
<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px">
    
    <div class="page-header">
    <h1>Lampiran</h1>
</div>

<div class="row">
    <div class="col-xs-12">
        <table id="list-lampiran" class="table table-striped table-bordered table-hover">
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

        <a class="btn btn-sm btn-default" id="btn_tambah">Tambahkan Arsip</a>

    </div>
</div>
    
</div>
<input type="hidden" name="actionx" value="Next" id="actionx">
<div class="row" style="">
    <div class="pull-left command-container" >
        <a href="<?php echo base_url().index_page().'/'.$cancel_target;?>" data-dismiss="modal" id="canceledit" class="btn btn-default btn-sm" style="margin-top:20px;">Cancel</a>
        <button type="button" id="btn_action_next" class="btn_submit btn btn-info btn-sm" 
            data-action="previous" data-form="edit-form" style="margin-top:20px;">Previous</button>        
        <button type="button" id="btn_action_next" class="btn_submit btn btn-info btn-sm" 
            data-action="next" data-form="edit-form" style="margin-top:20px;">Next</button>        
    </div>                                                                    
</div>
</form>



<div id="modal-form" class="modal fade" tabindex="-1" role="dialog" data-target=".modal-input" data-width="700" aria-hidden="true">
        <div class="modal-content">
            <form action="<?php echo $urlsubmitform; ?>" method="POST" enctype="multipart/form-data" name="docform" id="docform"> 

                <input type="hidden" id="modal_workflowid" name="workflowid" value="1" />

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger">Silakan isi formulir berikut:</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-5">
                            <div class="space"></div>
                            <input type="file" />
                        </div>
                        <div class="col-xs-12 col-sm-7">
                            <div class="edit-group">
                                <label for="namadokumen">Nama Dokumen</label>
                                    <input type="text" class="form-control" id="namadokumen" name="namadokumen" />
                            </div>
                            <div class="form-group">
                                <label for="jenisdokumen">Jenis Dokumen</label>
                                    <select class="form-control" name="jenisdokumen" id="jenisdokumen"></select>
                            </div>
                            <div class="form-group">
                                <label for="jenisdokumen">Jenis File</label>
                                <select class="form-control" name="jenisfile" id="jenisfile">
                                    <option value="digital">Digital</option>
                                    <option value="fisik">Fisik</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lokasi">Lokasi</label>
                                <div>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" />
                                </div>
                            </div>
                            <div class="doc-fields"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>

                    <button class="btn btn-sm btn-primary">
                        <i class="ace-icon fa fa-check"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
</div>


<script type="text/javascript">
    OnReadyArray.push(function() {
        
    vmodal_function = function(e){
        
        var vwfid = document.forms.namedItem("edit-form").elements['workflowid'].value;
        $('#modal_workflowid').val(vwfid);
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
                                    .attr('class', 'btn btn-xs')
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
                                .append($('<a>')
                                    .attr('class', 'btn btn-xs')
                                    .attr('href', '#')
                                    .attr('title', 'Edit')
                                    .append('<i class="ace-icon fa fa-pencil-square-o"></i>')
                                )
                                .append(" ")
                                .append($('<a>')
                                    .attr('class', 'btn btn-xs delete')
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
                $('#modal-form input[type=file]').ace_file_input('disable');
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
                        //$('#modal-form').modal('hide');
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

        loaddata();

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
        
    }
     
    $('#basicModal').on('shown.bs.modal', vmodal_function);
        
    });
</script>
