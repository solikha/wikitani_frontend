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
							<form action="<?php echo base_url(); ?>index.php/search_engine/showFormSunting" method="post">
							
									<!-- #section:elements.tab -->
										<div class="tabbable">
										<input type="hidden" name="artikel_konten_id" id="artikel_konten_id"/>
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#home">
														<i class="green fa fa-file-o bigger-120"></i>
														Beranda
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#messages">
													<i class="green fa fa-comments-o bigger-120"></i>
														Diskusikan Artikel ini
														<span class="badge badge-danger">4</span>
													</a>
												</li>

												
											</ul>

											<div class="tab-content">
												<div id="home" class="tab-pane fade in active">
													
													
													 <?php
										 $i=0;
                                         foreach ($data_artikel as $key => $value){
										  $i ++;
										?>
										<!--<div class="tab-content">-->
										<?php if($i==1){ ?>
										<h1>
										<?php 
											echo $value["judul_artikel"]; 
											$link = $value["link"]; 
											$artikel_id=$value["artikel_id"];
										?>
										</h1>
										<?php } ?>
										    
											<div id="home" class="tab-pane in active">
												
												<div class="page-header">
												<h4><button onclick="setArticleContentId(this.id)" class="btn btn-minier btn-cog" id="<?php echo $value["artikel_konten_id"]; ?>"><i class="fa fa-pencil-square-o"  style=""> </i></button> <button class="btn btn-minier btn-orange"><i class="fa fa-thumbs-o-up"  > </i></button> <!--<a class="addthis_counter addthis_pill_style" href="#" style="display: inline-block;"><a class="addthis_button_expanded" target="_blank" title="More" href="#" tabindex="1000"></a></a>--><!--<button class="btn btn-minier btn-red"><i class="fa fa-share-alt"></i></button>-->&nbsp;<?php echo $value["judul_konten_artikel"]; ?></h4>
												</div>
												<?php 
												     echo getBeautyString($value["konten"]);
													 $filepath=$value["filepath"];
												?>

											</div>
											
										<!--</div>-->
										 <?php } ?>
									 </div>
<!--tab chatting here-->
												<!--	<div id="messages" class="tab-pane fade in active">												
														<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="5"></div>
												</div>
											</div>
										</div>
										<input type="text" name="userid" id="userid" value="1"/>
										<input type="text" name="artikel_id" id="artikel_id" value="<?php echo $artikel_id ?>"/>
										</form>
									</div>
									
									
									
									
									
									
									<div class="col-sm-4" style="margin-top:30px;">
																		
								<div class="widget-box">
										<div class="widget-header">
										<h5 class="widget-title smaller">Berikan penilaian anda</h5>

											<div class="widget-toolbar">
												<span class="label label-success">
													16%
													<i class="ace-icon fa fa-arrow-up"></i>
												</span>
											</div>
											<div class="widget-body">
											<div class="widget-main padding-6">
												<div class="my-rating"></div>
											</div>
											</div>
										</div>

										
								</div>
								
								
								
								</div>
						
								<div class="col-sm-4" style="margin-top:30px;">																		
								<div class="widget-box">
										<div class="widget-header">
										<h5 class="widget-title smaller">Gambar&nbsp;<?php echo $value["judul_artikel"]; ?></h5>

											<div class="widget-toolbar">
												<span class="label label-success">
													16%
													<i class="ace-icon fa fa-arrow-up"></i>
												</span>
											</div>
										</div>

										<div class="widget-body">
											<div class="widget-main padding-6">
												<div class="alert alert-info"> <img style="width:100%; height:100%;" src="<?php echo getHtdocs(); ?>/wikitani/files/documents/<?php echo $filepath;  ?>"></div>
											</div>
										</div>
								</div>
							    <div class="widget-box">
										<div class="widget-header">
										<h5 class="widget-title smaller">Video Tentang &nbsp;<?php echo $value["judul_artikel"]; ?></h5>

											<div class="widget-toolbar">
												<span class="label label-success">
													16%
													<i class="ace-icon fa fa-arrow-up"></i>
												</span>
											</div>
										</div>

										<div class="widget-body">
											<div class="embed-responsive embed-responsive-16by9">
												<div class="alert alert-info"> <?php echo getEmbedUrl($link);  ?></div>
											</div>
										</div>
								</div>   -->
							
							
							
							<!--<div class="fb-video" data-href=" https://www.facebook.com/kementanRI/videos/1848557492094592/" data-width="500" data-show-text="false" ><blockquote cite="https://www.facebook.com/facebook/videos/10153231379946729/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook/videos/10153231379946729/">How to Share With Just Friends</a><p>How to share with just friends.</p>Dikirim oleh <a href="https://www.facebook.com/facebook/">Facebook</a> pada 5 Desember 2014</blockquote></div>-->
							</br>
							</br>
							</br>
							
							
							
							
							
							
							<!--<a href="https://id-id.facebook.com/kementanRI/" style="color:blue;"><img alt="Facebook" border="0" title="Find me on Facebook" style="widht:20px; height:20px;" src="<?php echo base_url(); ?>1491480467_facebook_circle.png" />  Kementrian Pertanian Republik Indonesia</a>&nbsp;</br></br>

							<a href="https://twitter.com/kementan" style="color:blue;"><img alt="Twitter" border="0" src="<?php echo base_url(); ?>twiter.png" title="Follow my Twitter" /> @kementan</a>&nbsp;</br></br>

							<a href="https://plus.google.com/+PustakaKementerianPertanian" style="color:blue";><img alt="Google+" border="0" src="http://2.bp.blogspot.com/-RlLTbIC_AtM/Uvbt80L9J5I/AAAAAAAAAPw/aQ2WngzkP6o/s20/google_plus.png" title="Add me on Google+" />  PustakaKementrianPertanian</a></br></br>

							<a href="https://www.instagram.com/kementerianpertanian/?hl=id" style="color:blue";><img alt="Instagram" border="0" src="http://2.bp.blogspot.com/-sGItvKHpEBI/Uvbt9uc-twI/AAAAAAAAAP8/mSrkggy9aY8/s20/instagram.png" title="Find me on Instagram" />  kementrianpertanian</a></br></br>

							<a href="https://id.linkedin.com/in/pustakawan-kementerian-pertanian-82568696" style="color:blue;"><img alt="Linkedin" border="0" src="http://1.bp.blogspot.com/-g4kCUG-XenU/Uvbt95QYaxI/AAAAAAAAAQY/KJk7t5pCRYs/s20/linkedin.png" title="Find me on Linkedin" />  Pustakawan Kementrian Pertanian</a></br></br>

							<!--<a href="https://Path.com" style="color:blue;"><img alt="Path" border="0" src="http://2.bp.blogspot.com/-VnZEtVjKWmY/Uvbt92tTvVI/AAAAAAAAAQM/PV7WdbtJ5WY/s20/path.png" title="Find me on Path" /></a></br></br>

							<a href="mailto:eko_purnomo97@yahoo.com" style="color:blue;"><img alt="Yahoo" border="0" src="http://2.bp.blogspot.com/-z83sbVxyM8c/Uvbt_CLk6pI/AAAAAAAAAQk/IL6ynoNf6vg/s20/yahoo.png" title="Kirim Yahoo Mail" /></a></br></br>
-->
							<a href='https://www.youtube.com/channel/UC757MLmzhe5QXlr9yWyHcpQ' style="color:blue;" title="youtube"><img src="<?php echo base_url(); ?>youtube.png" />  Kementrian Pertanian RI</a></br></br>
							
							
							
							
							    <!-- AddThis Button BEGIN -->
   <!-- <div class="addthis_toolbox addthis_default_style">
    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
    <a class="addthis_button_tweet"></a>
    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
    <a class="addthis_counter addthis_pill_style"></a>
    </div>-->
   
	
    <!-- AddThis Button END -->
							
							
							
							
							
							
							
							
							
							</div>
							</div>
							
							 <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
							 <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5156a09e76c1568f"></script>
	
	
	
<!--library fb-->	
	<div id="fb-root">
	</div>
				<script>
				(function(d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.8";
					fjs.parentNode.insertBefore(js, fjs);
					}
					(document, 'script', 'facebook-jssdk'));
			    </script>


							
							<script>
							function setArticleContentId(article_content_id){
								
								$("#artikel_konten_id").val(article_content_id)
							}
							</script>

							
							<script>
		
$(".my-rating").starRating({
    starSize: 25,
    callback: function(currentRating, $el){
        // make a server call here
		 //alert('rated ' + currentRating);
        //console.log('DOM element ', $el);
		
		var url_rating ="<?php echo base_url()?>"+"index.php/search_engine/doGiveRate?artikel_id="+<?php echo $artikel_id; ?>+"&rate="+currentRating+"&userid="+$("#userid").val();
	 //var kategori_nama="";
	   var values = $(this).serialize();
	   console.log($(this).serialize());
        $.ajax({
        url: url_rating,
        type: "get",
        data: values ,
        success: function (response) {
		//var obj = JSON.parse(response);
          alert(response);
         
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });
		
		
		
    }
});
							</script>
							
							
							