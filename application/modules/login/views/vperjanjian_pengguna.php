<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Registration - <?php echo $appconfig['app-title']; ?></title>

        <meta name="description" content="User Registration" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- basic styles -->

        <link href="<?php echo $assetdir; ?>css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/font-awesome.min.css" />
        
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-fonts.min.css" />
        
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/jquery.gritter.css" />

        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace.css" />
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-rtl.css" />

        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/bootstrap-datepicker3.css" />
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/daterangepicker.css" />
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/bootstrap-datetimepicker.css" />
        <style>
            .login-layout {
                background-image: url('<?php echo base_url(); ?>themes/aceadmin/images/bg belgia-04.png');background-size: 100% 120%;
            }
            .title-text {
                color: black;
            }
            .register-label{
                margin-top: 8px;
                padding-right: 0px;
                text-align: right;
            }
            .register-date{
                padding-left: 12px!important;
                padding-right: 12px!important;
            }
            .login-layout label {
                margin-bottom: 6px;
            }            
            .my_checkbox {
                position: relative;
                display: inline;
                margin: 0;
                line-height: 10px;
                min-height: 18px;
                min-width: 18px;
                font-weight: normal;
                cursor: pointer;
                font-family: fontAwesome;
                font-weight: normal;
                font-size: 12px;
                color: #FFF;
                content: "\a0";
                width: 20px;
                height: 20px;
                margin-top: -10px;
                vertical-align: bottom;
            }
            .datepicker-dropdown { 
                z-index: 9999;
            }
        </style>
    </head>
    <body class="login-layout">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="" style="margin-top:6px;">
                            <div class="row">
                                <div class="col-xs-4" style="text-align: right">
                                    <img src="<?php echo $appconfig['login-icon']; ?>" height="60px">
                                </div>
                                <div class="col-xs-8">
                                    <h2 style="margin-top:0px">
                                        <span class="title-text"><?php echo $appconfig['login-title']; ?></span>
                                    </h2>
                                    <h5 class="title-text"><?php echo $appconfig['login-subtitle']; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div id="signup-box" class="signup-box visible" style="background-color: rgba(160, 00, 0, 0.70);">
                            <div class="">
                                <div class="widget-main" style="padding-top: 8px; padding-bottom: 8px">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div style="text-align: center;">
                                                <h5 style="color: white;">
                                                    Perjanjian Pengguna
                                                    <hr>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-12"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo $assetdir; ?>js/jquery.min.js'>" + "<" + "/script>");
        </script>
        <script src="<?php echo $assetdir; ?>js/bootstrap.js"></script>
        <script src="<?php echo $libsurl; ?>kslibs/js/kslibs.js"></script>

        <script src="<?php echo $assetdir; ?>js/ace-elements.min.js"></script>
        <script src="<?php echo $assetdir; ?>js/ace.min.js"></script>
        <script src="<?php echo $assetdir; ?>js/ace/ace.sidebar-scroll-1.js"></script>        

        <script src="<?php echo $assetdir; ?>js/jquery.gritter.min.js"></script>

        <script type="text/javascript">
            if ("ontouchend" in document)
                document.write("<script src='<?php echo $assetdir; ?>js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>

        <!-- inline scripts related to this page -->
        <script src="<?php echo $assetdir; ?>js/date-time/bootstrap-datepicker.js"></script>
        <script src="<?php echo $assetdir; ?>js/date-time/bootstrap-timepicker.js"></script>
        <script src="<?php echo $assetdir; ?>js/date-time/moment.js"></script>
        <script src="<?php echo $assetdir; ?>js/date-time/daterangepicker.js"></script>
        <script src="<?php echo $assetdir; ?>js/date-time/bootstrap-datetimepicker.js"></script>
    </body>
</html>



