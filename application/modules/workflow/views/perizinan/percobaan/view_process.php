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
<form id="edit-form" action="<?php echo $form_action;?>" method="post">

<?php echo $control_fields; ?>
<!------ -->
<input type="hidden" name="final_screen_url" value="<?php echo base_url().index_page();?>/menu/home">
<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px">
    <div class="col-xs-12 col-sm-12">
        <div class="row" style="">
    <div class="col-sm-12 col-md-6 col-lg-6 datapanel" style="">
        
        <div class="edit-group" style="">
            <label for="customername"> Nama Lengkap</label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="customername" id="customername"
                style="" value="" disabled />
        </div>
        
        <div class="edit-group" style="">
            <label for="alamat">Alamat</label>
            <textarea class="form-control crud-edit valid" id="alamat" 
                      name="alamat" style="height: 94px" aria-invalid="false" disabled ></textarea>
        </div>        
        <div class="edit-group" style="">
            <label for="tempatlahir"> Tempat Lahir</label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="tempatlahir" id="tempatlahir"
                style="" value="" disabled />
        </div>
        <div class="edit-group" style="">
            <label for="tanggallahir"> Tanggal Lahir</label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="tanggallahir" id="tanggallahir"
                style="" value="" disabled />
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6 datapanel" style="">
        <div class="edit-group" style="">
            <label for="agama">Agama</label>
            <select class="form-control crud-edit" name="agama" id="agama" data-lookup-paramlist="" data-lookup-refresh="" 
                        data-lookup-name="edapartemen" style="" disabled >
                <option value="">--Pilih Agama--</option>
                <option value="islam" >Islam</option>
                <option value="katolik" >Kristen Katolik</option>
                <option value="protestan" >Kristen Protestan</option>
                <option value="hindu" >Hindu</option>
                <option value="budha" >Budha</option>
                <option value="konghucu" >Konghucu</option>
            </select>
        </div>        
        <div class="edit-group" style="">
            <label for="jenkel">Jenis Kelamin</label>
            <select class="form-control crud-edit" name="jenkel" id="jenkel" data-lookup-paramlist="" data-lookup-refresh="" 
                        data-lookup-name="edapartemen" style="" disabled >
                <option value="">--Pilih Jenis Kelamin--</option>
                <option value="p" >Pria</option>
                <option value="w" >Wanita</option>
            </select>
        </div>        
        <div class="edit-group" style="">
            <label for="jenkel">Jenis Perizinan</label>
            <select class="form-control crud-edit" name="tipe_izin" id="tipe_izin" data-lookup-paramlist="" 
                    data-lookup-refresh="" data-lookup-name="edapartemen" style="" disabled >
                <option value="">--Pilih Jenis Perizinan--</option>
                <option value="tdi" >TDI</option>
                <option value="ho" >HO</option>
                <option value="iui" >IUI</option>
                <option value="reklame" >Reklame</option>
            </select>
        </div>        
        
    </div>
</div>
    </div>                                                                    
</div>
<div class="row" style="">
    <div class="pull-left command-container" >
        <a href="<?php echo base_url().index_page();?>/menu/wf_perizinan_mhn" data-dismiss="modal" id="canceledit" class="btn btn-default btn-sm" style="margin-top:20px;">Back</a>
    </div>                                                                    
</div>
</form>
<script>
    
</script>