<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>themes/aceadmin/css/star-rating-svg.css">
<script src="<?php echo base_url() ?>themes/aceadmin/js/jquery.js"></script>
<script src="<?php echo base_url() ?>themes/aceadmin/js/jquery.star-rating-svg.js"></script>

	<style>.comments-page { background-color: #f2f2f2;}#blogger-comments-page { padding: 0px 5px; display: none;}.comments-tab { float: left; padding: 5px; margin-right: 3px; cursor: pointer; background-color: #f2f2f2;}.comments-tab-icon { height: 14px; width: auto; margin-right: 3px;}.comments-tab:hover { background-color: #eeeeee;}.inactive-select-tab { background-color: #d1d1d1;} 
<!--style for rate-->
	</style>							

	<div class="row" style="margin-bottom:10px;">
		
		<div class="breadcrumbs" id="breadcrumbs" style="background-color:white;">
					<script type="text/javascript">
						try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
					</script>


					<!-- #section:basics/content.searchbox -->
					
					<div class="nav-search" id="nav-search">
						<form class="form-search" action="<?php echo base_url()?>index.php/search_engine/doSearch" method="get">
							<span class="input-icon">
								<input type="text" placeholder="Search ..." class="nav-search-input" id="textsearch" name="textsearch" autocomplete="off">
								<i class="ace-icon fa fa-search nav-search-icon"></i>
							</span>
						</form>
					</div><!-- /.nav-search -->

					<!-- /section:basics/content.searchbox -->
		</div>
	</div>	
	<div class="row">
	<div class="col-sm-8">
	      <h2><i>Penelusuran yang terkait dengan&nbsp; <?php echo $data_keyword; ?></i></h2>

	      <?php 
               foreach ($data_artikel as $key => $value){
		  ?>
		  	<div class="page-header"><h5 style="color:blue";><b><?php echo $value["judul_artikel"] ?><b></h5></div>
			<p>
          <?php		  
				   echo (truncate(getBeautyString($value["konten"]),200))."<br/>";
			?>			
			</p>
			<a style="color:red;" href="<?php echo base_url(); ?>index.php/search_engine/showArtikelByArtikelId?artikel_id=<?php echo $value["artikel_id"]; ?>">Klik untuk bacaan selengkapnya ...</a>
         <?php			
			   }
		  ?> 
           	  
    </div>								
	</div>
	<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5156a09e76c1568f"></script>
	
							