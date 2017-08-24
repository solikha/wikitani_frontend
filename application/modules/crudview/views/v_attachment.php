<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

$baseurl = base_url().index_page() . "/workflow/wfattachement/";

$urlgetlampirans = $baseurl . "getlampirans";
$urljenislampiran = $baseurl . "getjenislampirans";
$urldocfields = $baseurl . "getdocfields";
$urlsubmitform = $baseurl . "docsimpan";
$urldownload = $baseurl . "download";
$urldelete = $baseurl . "delete";

//print_r($paramdata);
if (!isset($paramdata['viewmode'])){
    $viewmode = 'edit';
} else {
    $viewmode = $paramdata['viewmode'];
}

?>
<style>
    div#color_selector 
{
   z-index: 1120; 
}
.colorpicker {
    z-index: 1220; 
}
    .pagination {
        margin-top: 5px;
        margin-bottom: 10px;
    }
    .table{
        margin-bottom: 14px;
    }
    .table thead>tr>th, .table tbody>tr>th, .table tfoot>tr>th, .table thead>tr>td, .table tbody>tr>td, .table tfoot>tr>td{
        padding: 6px;
    }
    .page-header{
        margin-bottom: 8px;
        padding-bottom: 5px;
    }
    .command-container{
        margin-left: 8px;
        margin-top: 3px;
        margin-bottom: 10px;
    }
    .modal {
        padding-left: 30px;
        padding-right: 30px;
        padding-top: 10px;
        padding-bottom: 20px;
    }
    .error {
        color: red;
    }
    
</style>

<form id="edit-form" > 
<div class="modal-content" style="margin-top: 15px">
            <form action="<?php echo $urlsubmitform; ?>" method="POST" enctype="multipart/form-data" name="docform" id="docform"> 

                <input type="hidden" id="workflowid_x" name="workflowid" value="<?php echo $paramdata['id'] ?>" />

                <div class="modal-header" style="padding-top: 6px; padding-bottom: 0px">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="blue">Tambah Dokumen</h3>
                </div>
                <div class="modal-body" style="padding-top: 6px; padding-bottom: 0px">
                    <div class="row">
                        <div class="col-xs-12 col-sm-5">
                            <div class="space"></div>
                            <input type="file" />
                        </div>
                        <div class="col-xs-12 col-sm-7">
                            <div class="edit-group"><br>
                                <label for="deskrpsidokumen">Nama Dokumen</label>
                                    <input type="text" class="form-control" id="deskrpsidokumen" name="deskrpsidokumen" />
                            </div>
                            <div class="edit-group">
                                <label for="namadokumen">Deskripsi Dokumen</label>
                                    <input type="text" class="form-control" id="namadokumen" name="namadokumen" />
                            </div>
                            <div class="doc-fields"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="margin-top: 30px">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Batal
                    </button>

                    <button class="btn btn-sm btn-primary">
                        <i class="ace-icon fa fa-check"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>        
</form>    

<script type="text/javascript">
    var vonload;
    var vwfid = document.forms.namedItem("edit-form").elements['workflowid'].value;
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
        //vwfid = document.forms.namedItem("edit-form").elements['workflowid'].value;
        $.ajax({
            url: "<?php echo $urlgetlampirans; ?>",
            type: "POST",
            dataType: "json",
            data: { workflowid: document.forms.namedItem("edit-form").elements['workflowid'].value },
            success: function(data, textStatus, jqXHR) {
                // console.log("Load data berhasil.");
                // console.log(data);
                viewmode = '<?php echo $viewmode;?>';
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
                    var deletebtn = "";
                    var editbtn = "";
                    if (viewmode=='edit'){
                        deletebtn = $('<a>')
                            .attr('class', 'btn btn-minier delete btn-danger')
                            .attr('href', '#')
                            .attr('title', 'Delete')
                            .data('lampiranid', data[i].lampiranid)
                            .click(onclickevent)
                            .append('<i class="ace-icon fa fa-trash-o"></i>');
//                        editbtn = $('<a>')
//                                .attr('class', 'btn btn-xs')
//                                .attr('href', '#')
//                                .attr('title', 'Edit')
//                                .attr('data-id', data[i].lampiranid)
//                                .click(oneditevent)
//                                .append('<i class="ace-icon fa fa-pencil-square-o"></i>')
                            
                    }
                    $('#data').append($('<tr>')
                        .append('<td>'+data[i].namadokumen+'</td>')
                        .append('<td>'+data[i].namajenis+'</td>')
                        .append('<td>'+data[i].lokasi+'</td>')
                        .append('<td>'+data[i].jenisfile+'</td>')
                        .append($('<td>')
                            .append(editbtn)
                            .append(" ")
                            .append(deletebtn)
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
    
    //OnReadyArray.push(function() {
        //$('#modal_workflowid').val(vwfid);
        
        $('#btn_tambah').click(function(){
            Manggu.Crud.showModal({
                width: 800,
                modalname: 'modal-form',
                onload: vonload
            });
        });
        loaddata();
        
    //});
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