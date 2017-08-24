<?php 
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
 ?>
<?php
if (!isset($namespace)) {
    $namespace = '';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $appconfig['app-title']; ?></title>
        <link rel="icon" href="<?= base_url() ?>/icon.png" type="image/png">

        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <?php include_once 'aceadmin' . '/theme_top.php' ?>

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
            var AfterLoadGrid = [];

        </script>

        <?php include_once 'basev_style.php' ?>

        <style>
            .username-filler{
                height:12px; 
                width:10px;
            }
            .my-dropdown{
                left:-100px!important;
            }
            .my-dropdown.dropdown-caret:before {
                left:120px;
            }
            .my-dropdown.dropdown-caret:after {
                left:120px;
            }
            .no-skin .sidebar{
                border-style:solid;
                border-width:0 1px 0 0;
            }
			.menu-text{}
        </style>        
    </head>

    <body class="no-skin">
        <div class="navbar navbar-default" id="navbar" style="background-image: url('<?= base_url() ?>themes/aceadmin/images/bg belgia-02.png');background-size: 1350px 100px ;height: 100px">
            <script type="text/javascript">
                try {
                    ace.settings.check('navbar', 'fixed')
                } catch (e) {
                }
            </script>

            <div class="navbar-container" id="navbar-container" >
			<!--three line menu-->
			
                <button type="button" class="navbar-toggle menu-toggler pull-left btn-grey" id="menu-toggler"  data-toggle="collapse" data-target=".sidebar">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-header pull-left  " style="float:left!important;">
                    <a href="#" class="navbar-brand" style="font-size:24px; padding: 40px 2px 4px 20px;">
                        <span>
                            <?php echo $appconfig['main-title']; ?>
                        </span>
                    </a><!-- /.brand -->
                </div><!-- /.navbar-header -->

                <div class="navbar-header pull-right" role="navigation" style="float:right!important;padding-top: 45px">
                    <ul class="nav">

                        <li class="">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
							    <span><?php if(isset($_SESSION["session_login"]["username"])==true){ echo $_SESSION["session_login"]["username"];} ?></span>&nbsp;
                                <i class="fa fa-user" style="font-size: 30px; margin-top: 5px">&nbsp;</i>
                                <span class="user-info">
                                </span>

                                <i class="fa fa-caret-down" style="margin-top:0px"></i>
                            </a>

                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close my-dropdown">
                                <li  style="text-align: center; line-height: 25px;"><span><strong><?php //echo $username ?></strong></span></li>
                                <hr style="margin: 4px;">
								<?php if(isset($_SESSION["session_login"]["username"])==true){ ?>
                                <li>
                                    <a href="#" class="baseactionbutton" data-params='{"username":"<?php //echo $username ?>"}'>
                                        <i class="fa fa-lock"></i>
                                        Change Password
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo $basedir . index_page(); ?>/login/logout?return_keyword_to=<?php if(isset($_GET["textsearch"])){ echo $_GET["textsearch"];} ?>&return_page_to=<?php echo $page; ?>">
                                        <i class="fa fa-power-off"></i>
                                        Logout
                                    </a>
                                </li>
								<?php } ?>
								<?php if(isset($_SESSION["session_login"]["username"])==false){ ?>
								<li>
                                    <a href="<?php echo $basedir . index_page(); ?>/register">
                                        <i class="fa fa-user-plus"></i>
                                        Sign Up 
										
                                    </a>
                                </li>
								
                                <li>
                                    <a href="<?php echo $basedir . index_page(); ?>/login?return_keyword_to=<?php if(isset($_GET["textsearch"])){ echo $_GET["textsearch"];} ?>&return_page_to=<?php echo $page; ?>">
                                        <i class="fa fa-sign-in"></i>
                                        Login 
                                    </a>
                                </li>
								<?php  
								} 
								?>
								
								
                            </ul>
                        </li>                        

                    </ul>
                    <?php //echo $userinfo; ?>
                </div><!-- /.navbar-header -->
            </div><!-- /.container -->
        </div>

        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.check('main-container', 'fixed')
                } catch (e) {
                }
            </script>
             
            <div class="main-container-inner">
			
			 <?php  if($page != "Search Engine"){ ?>
                <div class="sidebar responsive <?php //echo getArrayDef($menuoptions, 'sidebar_class'); ?>" id="sidebar">
                    <div style="background-image: url('<?= base_url() ?>themes/aceadmin/images/bg belgia-12.png');background-repeat:repeat -x; background-size: 200px 800px">
					<ul class="nav nav-list" style="top: 0px;">
					<li class="">
						<a href="<?php echo base_url(); ?>">
							<i class="fa fa-home fa-2x"></i>
							<span class="menu-text"> Halaman Utama </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="">
						<a href="<?php echo base_url(); ?>index.php/search_engine/doSearchArtikelFavorite">
							<i class="fa fa-star fa-2x"></i>
							<span class="menu-text">
							Artikel Terpopuler </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="">
						<a href="index.html">
							<i class="fa fa-signal fa-2x"></i>
							<span class="menu-text"> Paling Banyak Dibaca </span>
						</a>

						<b class="arrow"></b>
					</li>
					<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					    <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				    </div>
				</ul>
                        <script type="text/javascript">
                            try {
                                ace.settings.check('sidebar', 'fixed')
                            } catch (e) {
                            }
                        </script>
                        <?php echo $shortcuts; ?>

                        <?php echo $mainmenu; ?>
                        <img src="<?= base_url() ?>themes/aceadmin/images/hide.png" style="z-index: 0; height: 560px;width: 200px">

                        <div class="sidebar-collapse" id="sidebar-collapse">
                            <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
                        </div>

                        <script type="text/javascript">
                            try {
                                ace.settings.check('sidebar', 'collapsed')
                            } catch (e) {
                            }
                        </script>
                        <style>
                            a{
                                color: white;
                            }
                        </style>
						
                    </div>
					
                </div>
               <?php } ?>
                <div class="main-content">
                    
                    <?php
                    if (!isset($breadcrumbs) or ( trim($breadcrumbs) === "")) {
                        
                    } else {
                        ?>
                        <div id="breadcrumbs" class="breadcrumbs">
                            <ul class="breadcrumb" id="<?php echo $namespace; ?>breadcrumbs">
								<?php echo $breadcrumbs ?>
                            </ul>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="page-content" id="page-content">
                        <div class="row">
                            <div class="col-xs-12">
                                
                                <!-- PAGE CONTENT BEGINS -->
									<?php echo $pagecontent ?>
									
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div><!-- /.main-content -->


            </div><!-- /.main-container-inner -->

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="icon-double-angle-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->
		

        <div id="ajax-modalwide" class="modal container fade" tabindex="-1" style="display: none; width:80%" data-dataname="testing"></div>
        <div id="ajax-modalnormal" class="modal container fade" tabindex="-1" style="display: none; " data-width="700">
            <div class="modal-body" id="ajax-modalnormal-body"></div></div>
        <div id="ajax-modalwider" class="modal container fade" tabindex="-1" style="display: none; padding-left: 20px; padding-right: 20px" data-width="700"></div>

		<?php include_once 'aceadmin' . '/theme_bottom.php' ?>

        <script type="text/javascript" src="<?php echo $basedir; ?>libs/bsmodal/js/bootstrap-modal.js"></script>
        <script type="text/javascript" src="<?php echo $basedir; ?>libs/bsmodal/js/bootstrap-modalmanager.js"></script>

        <script src="<?php echo $libsurl; ?>kslibs/js/mgcrud.js"></script>
        <script src="<?php echo $libsurl; ?>jqvalidation/jquery.validate.js"></script>


        <script>
                        OnReadyArray.push(function () {
                            $('.baseactionbutton').click(function () {
                                //alert('test');
                                console.log(this);
                                actionName = $(this).attr('data-action');
                                modalWidth = $(this).attr('data-modalwidth');
                                //console.log("*data*");
                                //console.log($(this).data('params'));

                                modalname = '<?php echo $namespace; ?>ajax-modalnormal';
                                console.log("actionName: " + actionName);
                                //data_idx = $(this).closest('tr').attr('data-index');
                                data = $(this).data('params');
                                console.log("*data*");
                                console.log(data);
                                Manggu.Crud.showModal({
                                    width: modalWidth,
                                    type: 'POST',
                                    url: '<?php echo site_url() . '/crud/command/users/changepassword' ?>',
                                    data: data,
                                    modalname: modalname
                                });

                                $('#' + modalname).on('hidden.bs.modal', function () {
                                    if ($('#' + modalname).attr('data-modalresult') == 1) {
                                        //alert('modal result 1')
//                            Manggu.Crud.loadData({'paramclass': 'crud-param',
//                                'url': '<?php //echo $basedir . 'crud/svqueryview/' . $crudname . '/' . $actionname;  ?>'
//                            });
                                    }
                                });

                                return false;
                            })
                        });

                        OnReadyArray.push(function () {

                            Manggu.showAlert = function (message, title, style) {
                                //alert("xxx-"+message);
                                var vtitle, vstyle;
                                if (typeof title == 'undefined') {
                                    vtitle = 'Error';
                                }
                                if (typeof style == 'undefined') {
                                    vstyle = 'error';
                                }
                                if (style == 'error') {
                                    vstyle = 'gritter-error';
                                } else if (style == 'warning') {
                                    vstyle = 'gritter-warning';
                                } else if (style == 'success') {
                                    vstyle = 'gritter-success';
                                } else if (style == 'info') {
                                    vstyle = 'gritter-info';
                                } else if (style == 'error-center') {
                                    vstyle = 'gritter-error gritter-center';
                                } else if (style == 'warning-center') {
                                    vstyle = 'gritter-warning gritter-center';
                                } else if (style == 'success-center') {
                                    vstyle = 'gritter-success gritter-center';
                                } else {
                                    vstyle = 'gritter-info gritter-center';
                                }
                                //vstyle = vstyle+vclass;

                                $.gritter.add({
                                    title: vtitle,
                                    text: message,
                                    class_name: vstyle
                                });
                            }/*show alert*/

                        });


        </script>


        <!-- inline scripts related to this page -->
        <script>


            (function ($) {
                $.fn.serializeAllArray = function () {
                    var obj = {};

                    $('input', this).each(function () {
                        obj[this.name] = $(this).val();
                    });
                    //return $.param(obj);
                    return obj;
                }
            })(jQuery);

            jQuery(function ($) {
                for (idx in OnReadyArray) {
                    OnReadyArray[idx]();
                }
                OnReadyArray = [];
            });
            jQuery(window).resize(function () { /* What ever */
                for (idx in OnResizeArray) {
                    OnResizeArray[idx]();
                }
            });

            function ShowModal(vurl, width, modalname) {
                if (typeof width == "undefined") {
                    width = '700';
                }
                if (typeof modalname == "undefined") {
                    modalname = "#<?php echo $namespace; ?>ajax-modalnormal";
                }
                var modalobj = $(modalname);
                //console.log(modalobj);
                $(modalobj).attr('data-width', width);
                //console.log(modalobj);
                $('body').modalmanager('loading');
                modalobj.load(vurl, '', function () {
                    console.log($(modalobj).find(".modal-header").attr('data-width'));
                    //console.log($(modalobj).find(".modal-header"));
                    //console.log(modalobj);
                    modalobj.modal();
                });

            }

            function ShowConfirmationOkCancel(obj, vTitle, vMessage, callbackOk, callbackCancel) {
                $('body').modalmanager('loading');
                var tmpl = [
                    // tabindex is required for focus
                    '<div id="modalwindow" class="modal fade" tabindex="-1">',
                    '<div class="modal-header">',
                    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
                    '<h2>' + vTitle + '</h2>',
                    '</div>',
                    '<div class="modal-body">',
                    '<p>' + vMessage + '</p>',
                    '</div>',
                    '<div class="modal-footer">',
                    '<a id="okButton" href="#" data-dismiss="modal" class="btn btn-primary">OK</a>',
                    '<a id="cancelButton" href="#" data-dismiss="modal" class="btn btn-default">Cancel</a>',
                    '</div>',
                    '</div>'
                ].join('');

                $(tmpl).modal("show");
                $('#okButton').click(function () {
                    callbackOk(obj);
                    //alert('ok');
                    //$('#modalwindow').modal('hide');
                });
                $('#cancelButton').click(function () {
                    callbackCancel(obj);
                    //alert('cancel');
                    //$('#modalwindow').modal('hide');
                });
                $("#modalwindow").on('hidden', function (obj) {
                    if (typeof obj == 'undefined') {

                    }
                    //callback(); 
                });

            }


            OnReadyArray.push(function () {

                $('.btn_submit').click(function (event) {
                    target = event.target;
                    console.log(target);
                    console.log($(target).attr('id'));
                    actval = $(target).attr('data-action');
                    formname = $(target).attr('data-form');
                    console.log($('#' + formname).find('#action'));
                    if ($('#' + formname).find('#action').length == 0) {
                        vinput = '<input type="hidden" id="action" name="action" value="' + actval + '" >';
                        $('#' + formname).append(vinput);
                    } else {
                        $('#' + formname).find('#action').val(actval);
                    }
                    console.log('filter');

                    $('#' + formname).submit();
                });
            });




        </script>

    </body>
</html>
