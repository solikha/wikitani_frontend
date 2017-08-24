<?php //var_dump($this->_ci_cached_vars);?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $appconfig['app-title']; ?></title>

        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- basic styles -->

        <link href="<?php echo $assetdir; ?>/css/bootstrap.min.css" rel="stylesheet" />
        
        
        <!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo $assetdir; ?>css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo $assetdir; ?>css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo $assetdir; ?>js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo $assetdir; ?>js/html5shiv.js"></script>
		<script src="<?php echo $assetdir; ?>js/respond.min.js"></script>
		<![endif]-->

        
        <script src="<?php echo $assetdir; ?>/js/ace-extra.min.js"></script>
        <script src="<?php echo $libsurl; ?>kslibs/js/kslibs.js"></script>
        
        <link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>libs/bsmodal/css/bootstrap-modal-bs3patch.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $basedir; ?>libs/bsmodal/css/bootstrap-modal.css">

        <script>
            var OnReadyArray = [];
            var OnResizeArray = [];
            var DisplayMode = 'normal';
            var DefaultBaseSearch = '#page-content ';
            var BaseSearch = DefaultBaseSearch;
        </script>

        <style>
            
            .btn-minier {
                font-size: 14px;
            }
            .datepicker-dropdown {
                z-index: 9999;
            }
            .icon-users:before{content:"\f0c0";}
            .navbar{
                background-color: <?php echo $appconfig['main-barcolor']; ?>;
            }
            .navbar-brand{
                padding-bottom: 0px!important;
                padding-top: 5px!important;
                padding-left: 0px;
                padding-right: 0px;

            }
            .icon-dapurpulsax:before{content:"\f0c1";}
            .icon-dapurpulsa{
                margin-top: 6px;
                display:inline-block!important;
                width: 40px;
                height: 30px;
                background-repeat: no-repeat;
                background-position-y: 0px;
                background-image: url(<?php echo $basedir; ?>images/logosm2.png);
                background-size:40px 30px;
            }
            .edit-group{
                margin-bottom: 10px;
            }
            .edit-control{
                width:100%;
                height:34px;
            }
            textarea.edit-control{
                height:103px;
            }
            span.input-group-addon{
                height:34px;
            }
            select.form-control{
                height:34px;
            }
            a.chosen-single{
                height:34px;
            }
            .radio{
                margin-top: -4px;
                margin-bottom: 8px;
            }
            .modal-header{
                padding-top: 5px;
                padding-bottom: 5px;
                xbackground-color: #ced7dc;
                background-color: #438eb9;
                color: white;
                border-top-left-radius: 6px;
                border-top-right-radius: 6px;
            }
            .modal-body{
                xbackground-color: #f8fafc;
                background-color: #fbfcfd;
            }
            .modal-footer{
                margin-top: 0px;
                xbackground-color: #a5c9dd;
                background-color: #eee;
            }
            .modal-backdrop, .modal-backdrop.fade.in{
                background-color: #333;
                opacity:0.7;
            }
            
        .testing1 {
            display: none;
        }
    @media only screen and (max-width:991px){
        .testing1 {
            display: block;
            height: 30px;
        }
    }
            
        </style>
    </head>

    <body>
        <div class="navbar navbar-default" id="navbar">
            <script type="text/javascript">
                try{ace.settings.check('navbar' , 'fixed')}catch(e){}
            </script>

            <div class="navbar-container" id="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand" style="font-size:24px">
                        <img src="<?php echo $appconfig['main-icon']; ?>" height="35px">
                        <?php echo $appconfig['main-title']; ?>
                    </a><!-- /.brand -->
                </div><!-- /.navbar-header -->

                <div class="navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">

                        <li class="green">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <i class="icon-user" style="font-size: 30px; margin-top: 5px">&nbsp;</i>
                                <span class="user-info">
                                    <small>Welcome,</small>
                                    <?php echo $displayname; ?>
                                </span>
                                                                    
                                <i class="icon-caret-down" style="margin-top:0px"></i>
                            </a>
                                                            
                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="#" class="baseactionbutton" data-params='{"username":"<?php echo $username?>"}'>
                                        <i class="icon-lock"></i>
                                        Change Password
                                    </a>
                                </li>
                                                                    
                                <li>
                                    <a href="../login/logout">
                                        <i class="icon-off"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>                        
                                                    
                    </ul>
                    <?php echo $userinfo;?>
                </div><!-- /.navbar-header -->
            </div><!-- /.container -->
        </div>

        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>

            <div class="main-container-inner">
                <a class="menu-toggler" id="menu-toggler" href="#">
                    <span class="menu-text"></span>
                </a>

                <div class="sidebar" id="sidebar">
                    <script type="text/javascript">
                        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
                    </script>
                    <?php echo $shortcuts; ?>

                    <?php echo $mainmenu; ?>

                    <div class="sidebar-collapse" id="sidebar-collapse">
                        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
                    </div>

                    <script type="text/javascript">
                        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
                    </script>
                </div>

                <div class="main-content">

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
                </div><!-- /.main-content -->


            </div><!-- /.main-container-inner -->

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="icon-double-angle-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <div id="ajax-modalwide" class="modal container fade" tabindex="-1" style="display: none; width:80%" data-dataname="testing"></div>
        <div id="ajax-modalnormal" class="modal container fade" tabindex="-1" style="display: none; " data-width="700"></div>
        <div id="ajax-modalwider" class="modal container fade" tabindex="-1" style="display: none; padding-left: 20px; padding-right: 20px" data-width="700"></div>

        <!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo $assetdir; ?>js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo $assetdir; ?>js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo $assetdir; ?>js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo $assetdir; ?>js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="<?php echo $assetdir; ?>js/excanvas.min.js"></script>
		<![endif]-->
		<script src="<?php echo $assetdir; ?>js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/jquery.easypiechart.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/jquery.sparkline.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/flot/jquery.flot.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/flot/jquery.flot.pie.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/flot/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo $assetdir; ?>js/ace-elements.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/ace.min.js"></script>
                <script src="<?php echo $assetdir; ?>js/jquery.dataTables.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/jquery.dataTables.bootstrap.js"></script>


        <script type="text/javascript" src="<?php echo $basedir; ?>libs/bsmodal/js/bootstrap-modal.js"></script>
        <script type="text/javascript" src="<?php echo $basedir; ?>libs/bsmodal/js/bootstrap-modalmanager.js"></script>

        <script src="<?php echo $libsurl; ?>kslibs/js/mgcrud.js"></script>
        <script src="<?php echo $libsurl; ?>jqvalidation/jquery.validate.js"></script>


        <script>
            OnReadyArray.push(function(){
                $('.baseactionbutton').click(function(){
                    //alert('test');
                    console.log(this);
                    actionName = $(this).attr('data-action');
                    modalWidth = $(this).attr('data-modalwidth');
                    //console.log("*data*");
                    //console.log($(this).data('params'));

                    modalname = 'ajax-modalnormal';
                    console.log("actionName: "+actionName);
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
                    
                    $('#'+modalname).on('hidden.bs.modal', function () {
                        if ($('#'+modalname).attr('data-modalresult')==1){
                            //alert('modal result 1')
//                            Manggu.Crud.loadData({'paramclass': 'crud-param',
//                                'url': '<?php //echo $basedir . 'crud/svqueryview/' . $crudname . '/' . $actionname; ?>'
//                            });
                        }
                    });
                    
                    return false;
                })
            });
            
            
        </script>
        
        
        <!-- inline scripts related to this page -->
        <script>




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
			
            function ShowModal(vurl, width, modalname){
                if (typeof width == "undefined"){
                    width = '700';
                }
                if (typeof modalname == "undefined"){
                    modalname="#ajax-modalnormal";
                }
                var modalobj = $(modalname);
                //console.log(modalobj);
                $(modalobj).attr('data-width', width);
                //console.log(modalobj);
                $('body').modalmanager('loading');
                modalobj.load(vurl, '', function(){
                    console.log($(modalobj).find(".modal-header").attr('data-width'));
                    //console.log($(modalobj).find(".modal-header"));
                    //console.log(modalobj);
                    modalobj.modal();
                });

            }

            function ShowConfirmationOkCancel(obj, vTitle, vMessage, callbackOk, callbackCancel){
                $('body').modalmanager('loading');
                var tmpl = [
                    // tabindex is required for focus
                    '<div id="modalwindow" class="modal fade" tabindex="-1">',
                    '<div class="modal-header">',
                    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
                    '<h2>'+vTitle+'</h2>',
                    '</div>',
                    '<div class="modal-body">',
                    '<p>'+vMessage+'</p>',
                    '</div>',
                    '<div class="modal-footer">',
                    '<a id="okButton" href="#" data-dismiss="modal" class="btn btn-primary">OK</a>',
                    '<a id="cancelButton" href="#" data-dismiss="modal" class="btn btn-default">Cancel</a>',
                    '</div>',
                    '</div>'
                ].join('');
  
                $(tmpl).modal("show");
                $('#okButton').click(function() {
                    callbackOk(obj);
                    //alert('ok');
                    //$('#modalwindow').modal('hide');
                });
                $('#cancelButton').click(function() {
                    callbackCancel(obj);
                    //alert('cancel');
                    //$('#modalwindow').modal('hide');
                });
                $("#modalwindow").on('hidden', function(obj) {
                    if (typeof obj=='undefined'){
          
                    }
                    //callback(); 
                });
  
            }            
    
                        
                        
                        
                    
        </script>

    </body>
</html>
