<?php if (!defined( 'BASEPATH')) exit( 'No direct script access allowed'); /* Manggu Framework * Simple PHP Application Development * Kusnassriyanto S. Bahri * kusnassriyanto@gmail.com * */ 
//$send_replay_conf=base_url().index_page(). '/send_replay_conf'; $register_link=base_url().index_page(). '/register'; $lupa_password=base_url().index_page(). '/login/emailInput'; ?>
  <style>
  <?php if($page=="Search Engine"){ ?>
    body{
		
	}
   .page-content {
          
            background-size: 100%;
			 background-image: url('<?php echo base_url(); ?>themes/aceadmin/images/bg1.png');
			background-repeat: no-repeat;
			width:100%;
			margin-left:-100px;
			height:80%;
        }
		.main-container{
			background-image: url('<?php echo base_url(); ?>themes/aceadmin/images/bg1.png');
			border:1px solid green;
			width:100%;
			height:800px;
			
		}
  <?php } ?>
       
        .title-text {
            color: black;
        }
		
    </style>


            <form  action="<?php echo base_url()?>index.php/search_engine/doSearch" method="get" >
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="login-container">
                        <div class="center" style="margin-top:100px;">
                            <img src="<?php echo $appconfig['login-icon']; ?>" height="320px">
                        </div>
                        <!--image icon-->
                      <div class="input-group input-group-lg" >
                            <input name="textsearch" type="text" class="form-control search-query" style=" opacity:0.6; color:white; background:black;" placeholder="">
                           	<span class="input-group-btn" >
							<button class="btn btn-default btn-lg" style="padding:5%; width:60px;">
								
									  <span class="fa fa-search "></span>
								</button>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
			</form>
        
