<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 
?>
								<div class="col-md-8">
								    <form action="<?php echo base_url(); ?>index.php/search_engine/showFormSunting" method="post">
									<!-- #section:elements.tab -->
									<div class="tabbable">
									<input type="hidden" name="artikel_konten_id" id="artikel_konten_id"/>
										<ul class="nav nav-tabs" id="myTab">
											<li class="active">
												<a data-toggle="tab" href="#home">
													<i class="green fa fa-file-o bigger-120"></i>
													Halaman
												</a>
											</li>

											<li>
												<li class="active">
												<a data-toggle="tab" href="#home">
													<i class="green fa fa-comments-o bigger-120"></i>
													Diskusikan Artikel ini
												</a>
											</li>
											</li>

										</ul>
                                         <?php
										 $i=0;
                                         foreach ($data_artikel as $key => $value){
										  $i ++;
										?>
										<div class="tab-content">
										<?php if($i==1){ ?>
										<h1><?php echo $value["judul_artikel"]; ?></h1>
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
											
										</div>
										 <?php } ?>
									</div>
									<!-- /section:elements.tab -->
									</form>
								</div>
							<div class="col-md-4" style="margin-top:30px;">
							<div class="widget-box">
										<div class="widget-header">
											<h5 class="widget-title smaller"><?php echo $value["judul_artikel"]; ?></h5>

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
							</br>
							</br>
							</br>
							
							
							<a href="https://id-id.facebook.com/kementanRI/" style="color:blue;"><img alt="Facebook" border="0" title="Find me on Facebook" style="widht:20px; height:20px;" src="<?php echo base_url(); ?>1491480467_facebook_circle.png" />&nbspKementrian Pertanian Republik Indonesia</a>&nbsp;</br></br>

							<a href="https://twitter.com/kementan" style="color:blue;"><img alt="Twitter" border="0" src="<?php echo base_url(); ?>twiter.png" title="Follow my Twitter" /> @kementan</a>&nbsp;</br></br>

							<a href="https://plus.google.com/+PustakaKementerianPertanian" style="color:blue";><img alt="Google+" border="0" src="http://2.bp.blogspot.com/-RlLTbIC_AtM/Uvbt80L9J5I/AAAAAAAAAPw/aQ2WngzkP6o/s20/google_plus.png" title="Add me on Google+" /> PustakaKementrianPertanian</a></br></br>

							<a href="https://www.instagram.com/kementerianpertanian/?hl=id" style="color:blue";><img alt="Instagram" border="0" src="http://2.bp.blogspot.com/-sGItvKHpEBI/Uvbt9uc-twI/AAAAAAAAAP8/mSrkggy9aY8/s20/instagram.png" title="Find me on Instagram" /> kementrianpertanian</a></br></br>

							<a href="https://id.linkedin.com/in/pustakawan-kementerian-pertanian-82568696" style="color:blue;"><img alt="Linkedin" border="0" src="http://1.bp.blogspot.com/-g4kCUG-XenU/Uvbt95QYaxI/AAAAAAAAAQY/KJk7t5pCRYs/s20/linkedin.png" title="Find me on Linkedin" /> Pustakawan Kementrian Pertanian</a></br></br>

							<!--<a href="https://Path.com" style="color:blue;"><img alt="Path" border="0" src="http://2.bp.blogspot.com/-VnZEtVjKWmY/Uvbt92tTvVI/AAAAAAAAAQM/PV7WdbtJ5WY/s20/path.png" title="Find me on Path" /></a></br></br>

							<a href="mailto:eko_purnomo97@yahoo.com" style="color:blue;"><img alt="Yahoo" border="0" src="http://2.bp.blogspot.com/-z83sbVxyM8c/Uvbt_CLk6pI/AAAAAAAAAQk/IL6ynoNf6vg/s20/yahoo.png" title="Kirim Yahoo Mail" /></a></br></br>
-->
							<a href='https://www.youtube.com/channel/UC757MLmzhe5QXlr9yWyHcpQ' style="color:blue;" title="youtube"><img src="<?php echo base_url(); ?>youtube.png" /> Kementrian Pertanian RI</a>
							
							
							
							
							    <!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_default_style">
    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
    <a class="addthis_button_tweet"></a>
    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
    <a class="addthis_counter addthis_pill_style"></a>
    </div>
    <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5156a09e76c1568f"></script>
    <!-- AddThis Button END -->
							
							
							
							
							
							
							
							
							
							</div>
							<script>
							function setArticleContentId(article_content_id){
								
								$("#artikel_konten_id").val(article_content_id)
							}
							</script>
