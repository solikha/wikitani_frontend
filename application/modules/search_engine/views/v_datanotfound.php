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
				   Penelusuran Anda&nbsp; -<b style="color:red;"><?php echo $data_keyword ?></b>-&nbsp; tidak cocok dengan artikel apapun!
				</div>
					
				</div>
							
							 <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
							
<!--library fb-->	
	<div id="fb-root">
	</div>
				<script>
				</script>
							
							
							