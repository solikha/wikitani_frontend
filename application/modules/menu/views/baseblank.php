<?php //var_dump($this->_ci_cached_vars);?>

<?php //include_once 'test.php';?>
<?php
  if(!isset($namespace)){
      $namespace = '';
  }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $appconfig['app-title']; ?></title>
        <link rel="icon" href="<?=base_url()?>/icon.png" type="image/png">

        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <?php include_once 'aceadmin'.'/theme_top.php' ?>
        
        <script src="<?php echo $libsurl; ?>kslibs/js/kslibs.js"></script>
        
        <link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>libs/bsmodal/css/bootstrap-modal-bs3patch.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>libs/bsmodal/css/bootstrap-modal.css">
        <!---->
        <script>
            var OnReadyArray = [];
            var OnResizeArray = [];
            var DisplayMode = 'normal';
            var DefaultBaseSearch = '#page-content ';
            var BaseSearch = DefaultBaseSearch;
        </script>

        <?php include_once 'basev_style.php' ?>

    </head>

    <body class="no-skin">
        

        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>

            <div class="main-container-inner">
                


                    <div class="page-content" id="page-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="testing1"></div>
                                <!-- PAGE CONTENT BEGINS -->
                                <?php echo $pagecontent ?>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->


            </div><!-- /.main-container-inner -->

        </div><!-- /.main-container -->


        <?php include_once 'aceadmin'.'/theme_bottom.php' ?>

        <script type="text/javascript" src="<?php echo $basedir; ?>libs/bsmodal/js/bootstrap-modal.js"></script>
        <script type="text/javascript" src="<?php echo $basedir; ?>libs/bsmodal/js/bootstrap-modalmanager.js"></script>

        <script src="<?php echo $libsurl; ?>kslibs/js/mgcrud.js"></script>
        <script src="<?php echo $libsurl; ?>jqvalidation/jquery.validate.js"></script>


        <script>
            OnReadyArray.push(function(){
                });
                
            
        </script>
        
        
        <!-- inline scripts related to this page -->
        <script>


            (function ($) {
            $.fn.serializeAllArray = function () {
                var obj = {};

                $('input',this).each(function () { 
                    obj[this.name] = $(this).val(); 
                });
                //return $.param(obj);
                return obj;
            }
            })(jQuery);

            jQuery(function($) {
                for(idx in OnReadyArray){
                    OnReadyArray[idx]();
                }
                OnReadyArray = [];
            });
            jQuery(window).resize(function() { /* What ever */ 
                for(idx in OnResizeArray){
                    OnResizeArray[idx]();
                }
            });
			
                        
    
                        
                        
                    
        </script>

    </body>
</html>
