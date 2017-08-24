<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 
?>
<div class="col-md-12" style=" backgroun-color:#EEEEEE">
   <div class="row" style="margin-bottom:10px; ">
      <div class="col-md-3" >
         <div class="row" >
            kategori
         </div>
         <div class="row" style="margin-right:3px">
            <form method="post" action="<?php echo base_url()?>/index.php/artikel/saveartikel">
               <select class="form-control" name="kategori_nama" id="kategori_nama" disabled="disabled">
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
      <select class="form-control" name="subkategori_nama" id="subkategori_nama" disabled="disabled">			
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
<!--<div class="row" style="padding-left:24px;">
   konten
   </div>-->
<div class="row" >
<div class="col-sm-12">
<h4 class="header green">Menambahkan Artikel</h4>
<div class="widget-box widget-color-blue">
<div class="widget-header widget-header-small">  </div>
<div class="widget-body">
<div class="widget-main no-padding">
<div class="md-editor" id="1490166623569"><div class="md-header btn-toolbar"><div class="btn-group"><button class="btn-default btn-sm btn btn-white" type="button" title="Bold (Ctrl+B)" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdBold" data-hotkey="Ctrl+B"><span class="fa fa-bold"></span> </button><button class="btn-default btn-sm btn btn-white" type="button" title="Italic (Ctrl+I)" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdItalic" data-hotkey="Ctrl+I"><span class="fa fa-italic"></span> </button><button class="btn-default btn-sm btn btn-white" type="button" title="Heading (Ctrl+H)" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdHeading" data-hotkey="Ctrl+H"><span class="fa fa-header"></span> </button></div><div class="btn-group"><button class="btn-default btn-sm btn btn-white" type="button" title="URL/Link (Ctrl+L)" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdUrl" data-hotkey="Ctrl+L"><span class="fa fa-link"></span> </button><button class="btn-default btn-sm btn btn-white" type="button" title="Image (Ctrl+G)" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdImage" data-hotkey="Ctrl+G"><span class="fa fa-picture-o"></span> </button></div><div class="btn-group"><button class="btn-default btn-sm btn btn-white" type="button" title="Unordered List (Ctrl+U)" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdList" data-hotkey="Ctrl+U"><span class="fa fa-list"></span> </button><button class="btn-default btn-sm btn btn-white" type="button" title="Ordered List (Ctrl+O)" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdListO" data-hotkey="Ctrl+O"><span class="fa fa-list-ol"></span> </button><button class="btn-default btn-sm btn btn-white" type="button" title="Code (Ctrl+K)" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdCode" data-hotkey="Ctrl+K"><span class="fa fa-code"></span> </button><button class="btn-default btn-sm btn btn-white" type="button" title="Quote (Ctrl+Q)" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdQuote" data-hotkey="Ctrl+Q"><span class="fa fa-quote-left"></span> </button></div><div class="btn-group"><button class="btn-sm btn btn-primary btn-white" type="button" title="Preview (Ctrl+P)" tabindex="-1" data-provider="bootstrap-markdown" data-handler="bootstrap-markdown-cmdPreview" data-hotkey="Ctrl+P" data-toggle="button"><span class="fa fa-search"></span> Preview</button></div><div class="md-controls"><a class="md-control md-control-fullscreen" href="#"><span class="fa fa-expand"></span></a></div></div><textarea name="content" data-provide="markdown" data-iconlibrary="fa" rows="17" class="md-input" style="resize: none;">**Markdown Editor** inside a *widget box*
- list item 1
- list item 2
- list item 3
</textarea>
</div>
</div>
</div>
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
<!--<textarea    class="form-control crud-param" placeholder="This text area automatically resizes its height as you fill in more text courtesy of autosize-master it out..." >
   </textarea>-->
</div>
</div>
</div>
</form>	
</div>
<?php// echo $dataModel; ?>
<?php// echo $nama; ?>
</div>
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
               //console.log(i);
			   //console.log(obj[i].subkategori_nama);
			   //$("#subkategori_nama").empty();
			   $("#subkategori_nama").append("<option  value="+obj[i].subkategori_id+">"+obj[i].subkategori_nama+"</option>")
			}
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
});
</script>

