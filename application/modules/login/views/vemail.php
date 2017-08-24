<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
$register_link = base_url() . index_page() . '/register';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Email Form Page - <?php echo $appconfig['app-title']; ?></title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- basic styles -->

        <link href="<?php echo $assetdir; ?>css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/font-awesome.min.css" />

        <!--[if IE 7]>
          <link rel="stylesheet" href="<?php echo $assetdir; ?>css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->

        <!-- fonts -->

        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-fonts.css" />

        <!-- ace styles -->

        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace.min.css" />
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-rtl.min.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="<?php echo $assetdir; ?>js/html5shiv.js"></script>
        <script src="<?php echo $assetdir; ?>js/respond.min.js"></script>
        <![endif]-->

        <style>
            .login-layout {
                background-image: url('<?php echo base_url(); ?>themes/aceadmin/images/bg belgia-04.png');background-size: 100% 120%;
            }
            .title-text {
                color: black;
            }
        </style>
    </head>

    <body class="login-layout">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center" style="margin-top:40px;">
                                <img src="<?php echo $appconfig['login-icon']; ?>" height="80px">
                                <h1>
                                    <span class="title-text"><?php echo $appconfig['login-title']; ?></span>
                                </h1>
                                <h4 class="title-text"><?php echo $appconfig['login-subtitle']; ?></h4>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div class="login-box visible" style="background-color: rgba(160, 00, 0, 0.70);">
                                    <form action="<?php echo $mainurl; ?>login/sendEmail" method="post" >
                                        <div class="widget-main">
                                            <?php
                                            if ($emailCek == 'ada') {
                                                ?>
                                                <h5 class="header white lighter bigger">
                                                    <i class="icon-lock green"></i>
                                                    Masukan Email Anda
                                                </h5>

                                                <div class="space-6"></div>

                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input name="email" type="email" class="form-control" placeholder="Email" onkeypress="doKeyPress(event)" />
                                                            <i class="icon-user"></i>
                                                        </span>
                                                    </label>
                                                    <input type="hidden" value="<?php echo $emailKey; ?>" name="key"/>
                                                    <div class="space"></div>

                                                    <div class="clearfix">

                                                        <button type="submit" class="width-35 pull-right btn btn-sm btn-primary" >
                                                            <i class="icon-key"></i>
                                                            Submit
                                                        </button>
                                                    </div>

                                                    <div class="space-4"></div>
                                                </fieldset>
                                                <?php
                                            } else {
                                                echo '<h3>Maaf Link Anda Tidak Sesuai.</h3>';
                                            }
                                            ?>

                                        </div><!-- /widget-main -->

                                    </form>
                                </div><!-- /widget-body -->
                            </div><!-- /login-box -->




                        </div><!-- /position-relative -->
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>

        <!-- basic scripts -->

        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo $assetdir; ?>js/jquery.min.js'>" + "<" + "/script>");
        </script>


        <!-- <![endif]-->

        <!--[if IE]>
        <script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo $assetdir; ?>js/jquery-1.10.2.min.js'>"+"<"+"/script>");
        </script>
        <![endif]-->

        <script src="<?php echo $libsurl; ?>dplibs/js/dplibs.js"></script>

        <script type="text/javascript">
            if ("ontouchend" in document)
                document.write("<script src='<?php echo $assetdir; ?>js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>

        <!-- inline scripts related to this page -->




        <script type="text/javascript">
            function show_box(id) {
                jQuery('.widget-box.visible').removeClass('visible');
                jQuery('#' + id).addClass('visible');
            }

            function doAjaxLogin() {
                var vuser = $('#email').val();

                $.post("<?php echo $mainurl; ?>login/sendEmail", {email: vuser}, function (result) {
                    return;
                });

            }

            function doKeyPress(e) {
                var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
                if (testEmail.test(e.value)) {
                    //var tb = document.getElementById("scriptBox");
                    //eval(tb.value);
                    return false;
                }

            }


        </script>
    </body>

</html>



