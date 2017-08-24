<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 
?>
<div class="col-md-12">
<div class="row">
<div class="col-md-12" style=" background-color:white;">
 <form method="post" action="<?php echo base_url()?>index.php/search_engine/doSaveUpdatedArticleContent">
   <!--<div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
			</div>
		</div>
   </div>-->
   <div class="row" style="margin-bottom:10px; ">
      <div class="col-md-3">
         <!--<div class="row" >
            </div>-->
         <div class="row" style="margin-right:3px ">
               <input type="hidden" class="form-control" name="nama_kategori" id="nama_kategori" readonly="readonly" value="<?php echo $data_form_sunting["nama_kategori"]; ?>"/>
			   <input type="hidden" class="form-control" name="kategori_id" id="kategori_id" readonly="readonly" value="<?php echo $data_form_sunting["kategori_id"]; ?>"/>
         </div>
      </div>
      <div class="col-md-3">
      <!--<div class="row"></div>-->
      <div class="row" style="margin-right:3px">
      <input type="hidden" class="form-control" name="subkategori_nama" id="subkategori_nama" readonly="readonly"  value="<?php echo $data_form_sunting["subkategori_nama"]; ?>"/>
		<input type="hidden" class="form-control" name="subkategori_id" id="subkategori_id" readonly="readonly"  value="<?php echo $data_form_sunting["subkategori_id"]; ?>"/>	  
      </div>
      </div>
      <div class="col-md-3">
      <div class="row"></div>
      <div class="row" style="margin-right:3px">
      <input type="hidden" class="form-control crud-param" value="<?php  echo $data_form_sunting["judul_artikel"]; ?>" readonly="readonly" placeholder="" name="judul_artikel" id="judul_artikel" style="" >
      </div>
      </div>
      <div class="col-md-3">
      <!--<div class="row"></div>-->
      <div class="row" style="margin-right:3px">
		  <input type="hidden" class="form-control crud-param" value="<?php echo $data_form_sunting["judul_konten_artikel"]; ?>" placeholder="" name="judul_konten_artikel" id="judul_konten_artikel" style="" >
      </div>
      </div>
   </div>
   <div class="row">
   <div class="col-md-3">
    <!--<div class="row"></div>-->
	<div class="row">
		<input readonly="readonly" type="hidden" class="form-control crud-param" value="114" placeholder="" name="userid" id="userid" style="" >
	</div>
   </div>
   <div class="col-md-3">
    <!--<div class="row" ></div>-->
	<div class="row">
		 <input type="hidden" readonly="readonly" class="form-control crud-param" name="artikel_konten_id" id="artikel_konten_id" value="<?php echo $data_form_sunting["artikel_konten_id"]; ?>" type="text"/>

	</div>
   </div>
   </div>

</div>
</div>
<div class="row">

   <div class="row">
	    <textarea name="editor1" id="editor1"></textarea>
		<div class="widget-toolbox padding-4 clearfix">
<div class="btn-group pull-left">
<div class="btn btn-sm btn-blue">
<a href="<?php echo base_url(); ?>index.php/search_engine/doSearch?textsearch=<?php echo $data_form_sunting["judul_artikel"]; ?>">
<i class="ace-icon fa fa-arrow-left bigger-125"></i>
Back
</a>
</div>
</div>
<div style="display : none;" class="btn-group pull-left">
<button class="btn btn-sm btn-info">
<i class="ace-icon fa fa-times bigger-125"></i>
Cancel
</button>
</div>
<div class="btn-group pull-left">
<button class="btn btn-sm btn-purple">
<i class="ace-icon fa fa-floppy-o bigger-125"></i>
Save
</button>
</div>
</div>
   </div>
</div>
</div>
</form>

                <script>
                    CKEDITOR.replace('editor1', {
                        filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
                        filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                    });
                    CKEDITOR.instances.editor1.setData("" + <?php echo $data_form_sunting["konten"]; ?> + "");
                </script>
            </div
			
			<script src='<?php echo base_url(); ?>themes/aceadmin/js/jquery.min.js'></script>
        <script>
           
        </script>
