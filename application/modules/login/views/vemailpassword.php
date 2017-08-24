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

        <!-- fonts -->
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-fonts.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace.min.css" />
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-rtl.min.css" />

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
                                    <form action="<?php echo $mainurl; ?>login/emailPassword" method="post" >
                                        <div class="widget-main">
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
                                                <div class="space"></div>

                                                <div class="clearfix">

                                                    <button type="submit" class="width-35 pull-right btn btn-sm btn-primary" >
                                                        <i class="icon-key"></i>
                                                        Submit
                                                    </button>
                                                </div>

                                                <div class="space-4"></div>
                                            </fieldset>
                                        </div><!-- /widget-main -->
                                    </form>
                                </div><!-- /widget-body -->
                            </div><!-- /login-box -->
                        </div><!-- /position-relative -->
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </body>
</html>