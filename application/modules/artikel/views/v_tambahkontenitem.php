<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 
?>
<div class="col-md-12" style=" backgroun-color:#EEEEEE">
 <form method="post" action="<?php echo base_url()?>/index.php/artikel/saveArtikelContent">
   <div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
				<input style="display:none;" value="<?php echo $artikel_id; ?>" type="text" readonly="readonly" id="artikel_id" name="artikel_id"/>
			</div>
		</div>
   </div>
   <div class="row" style="margin-bottom:10px; ">
      <div class="col-md-3">
         <div class="row" >
            kategori
         </div>
         <div class="row" style="margin-right:3px">
           
               <select class="form-control" name="kategori_nama" id="kategori_nama" readonly="readonly">
                  <?php
                     foreach ($lookup_kategori as $key => $value){
                        ?>
                  <option value="<?php echo $value["kategori_id"];  ?>"><?php echo $value["nama_kategori"]; ?></option>
                  <?php																  
                     }
                     ?>
               </select>
         </div>
      </div>
      <div class="col-md-3">
      <div class="row">sub_kategori</div>
      <div class="row" style="margin-right:3px">
      <select class="form-control" name="subkategori_nama" id="subkategori_nama" readonly="readonly">			
                  <?php
                     foreach ($lookup_subkategori as $key => $value){
                        ?>
                  <option value="<?php echo $value["subkategori_id"];  ?>"><?php echo $value["subkategori_nama"]; ?></option>
                  <?php																  
                     }
                     ?>

      </select>
      </div>
      </div>
      <div class="col-md-3">
      <div class="row">judul_artikel</div>
      <div class="row" style="margin-right:3px">
      <input type="text" class="form-control crud-param" value="<?php echo $judulartikel; ?>" readonly="readonly" placeholder="" name="judul_artikel" id="judul_artikel" style="" >
      </div>
      </div>
      <div class="col-md-3">
      <div class="row">judul_konten</div>
      <div class="row" style="margin-right:3px">
      <input type="text" class="form-control crud-param" placeholder="" name="judul_konten" id="judul_konten" style="" >
      </div>
      </div>
   </div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="row" >
 <textarea name="editor1" id="editor1"></textarea>
</div>
</div>
<div class="widget-toolbox padding-4 clearfix">
<div class="btn-group pull-left">
<button class="btn btn-sm btn-blue">
<a href="<?php echo base_url(); ?>index.php/menu/artikel">
<i class="ace-icon fa fa-arrow-left bigger-125"></i>
Back
</a>
</button>
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
<div class="row">
        <script>
		//debugger();
			CKEDITOR.replace( 'editor1', {
								filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
								filebrowserImageBrowseUrl: '/ckfinder/ckfinder.html?type=Images',
								filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
								filebrowserImageUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
							});	
	       //CKEDITOR.instances.editor1.setData("uhfihwhfiu");

							
        </script>
</div>
</form>
<script src='<?php echo base_url(); ?>themes/aceadmin/js/jquery.min.js'></script>
<script>

  $("#kategori_nama" ).change(function() {
	 var url_lookup_subkategori ="<?php echo base_url()?>"+"index.php/artikel/getLookupSubkategori";
	 //var kategori_nama="";
	   var values = $(this).serialize();
	   console.log($(this).serialize());
        $.ajax({
        url: url_lookup_subkategori,
        type: "post",
        data: values ,
        success: function (response) {
		var obj = JSON.parse(response);
          
         //console.clear();		   
           $("#subkategori_nama").empty();
			for (var i = 0; i < obj.length; i++){
             
			   $("#subkategori_nama").append("<option  value="+obj[i].subkategori_id+">"+obj[i].subkategori_nama+"</option>")
			}
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
});

</script>
 
