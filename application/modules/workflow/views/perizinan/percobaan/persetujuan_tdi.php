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
<input type="hidden" name="final_screen_url" value="menu/home">
<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px">
    <div class="col-xs-12 col-sm-12">
        <div class="row" style="">
    <div class="col-sm-12 col-md-12 col-lg-12 datapanel" style="">
        <h4>Persetujuan TDI</h4>
            
        <div class="edit-group" style="">
            <label for="customername"> Nama Lengkap</label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="customername" id="customername"
                style="" value="" disabled/>
        </div>
        <div class="edit-group" style="">
            <label for="tempatlahir"> Tempat Lahir</label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="tempatlahir" id="tempatlahir"
                style="" value="" disabled/>
        </div>
        <div class="edit-group" style="">
            <label for="tanggallahir"> Tanggal Lahir</label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="tanggallahir" id="tanggallahir"
                style="" value="" disabled/>
        </div>
        
        <div class="edit-group" style="">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control crud-edit valid" id="keterangan" 
                      name="keterangan" style="height: 94px" aria-invalid="false"></textarea>
        </div>        
    </div>
    
</div>
    </div>                                                                    
</div>
<div class="row" style="">
    <div class="pull-left command-container" >
        <input type="submit" value="Previous" name="action" class="btn btn-info btn-sm" style="margin-top:20px;">
        <a href="<?php echo base_url().index_page();?>/menu/wf_perizinan_vrf" data-dismiss="modal" id="canceledit" class="btn btn-default btn-sm" style="margin-top:20px;">Cancel</a>
        <input type="submit" value="Next" name="action" class="btn btn-info btn-sm" style="margin-top:20px;">
    </div>                                                                    
</div>
</form>
<script>
    
</script>