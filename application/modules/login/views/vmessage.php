<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
$register_link = base_url().index_page().'/register';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login Page - <?php echo $appconfig['app-title']; ?></title>

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
                background-color: <?php echo $appconfig['login-background']; ?>;
            }
            .title-text {
                color: red;
            }
        </style>
    </head>

    <body class="login-layout">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                            <div class="center" style="margin-top:40px;">
                                <img src="<?php echo $appconfig['login-icon']; ?>" height="80px">
                                <h1>
                                    <span class="title-text"><?php echo $appconfig['login-title']; ?></span>
                                </h1>
                                <h4 class="title-text"><?php echo $appconfig['login-subtitle']; ?></h4>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <?php echo $message; ?>

                                            <div class="space-6"></div>

                                            
                                        </div><!-- /widget-main -->

                                    </div><!-- /widget-body -->
                                </div><!-- /login-box -->

                                

                                
                            </div><!-- /position-relative -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo $assetdir; ?>js/jquery.min.js'>"+"<"+"/script>");
        </script>
        

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='<?php echo $assetdir; ?>js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

        <script src="<?php echo $libsurl; ?>dplibs/js/dplibs.js"></script>

        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='<?php echo $assetdir; ?>js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>

        <!-- inline scripts related to this page -->

        
        
        
        <script type="text/javascript">
            
            function toHex(str) {
                    var hex = '';
                    for(var i=0;i<str.length;i++) {
                            hexchar = '00'+str.charCodeAt(i).toString(16);
                            hexchar = hexchar.substr(hexchar.length-2);
                            hex += hexchar;
                    }
                    return hex;
            }
            function dataen(key, str) {
              var s = [],
                  j = 0,
                  x, res = '';
              for (var i = 0; i < 256; i++) {
                s[i] = i;
              }
              for (i = 0; i < 256; i++) {
                j = (j + s[i] + key.charCodeAt(i % key.length)) % 256;
                x = s[i];
                s[i] = s[j];
                s[j] = x;
              }
              i = 0;
              j = 0;
              for (var y = 0; y < str.length; y++) {
                i = (i + 1) % 256;
                j = (j + s[i]) % 256;
                x = s[i];
                s[i] = s[j];
                s[j] = x;
                res += String.fromCharCode(str.charCodeAt(y) ^ s[(s[i] + s[j]) % 256]);
              }
              return res;
            }
            
            
            var xkey = '<?php echo $kode_data;?>';
            var rkey = '<?php echo $key_data;?>';
            function show_box(id) {
                jQuery('.widget-box.visible').removeClass('visible');
                jQuery('#'+id).addClass('visible');
            }
            
            function doAjaxLogin(){
                var vuser = $('#username').val();
                var vpass = $('#password').val();
                var vxpass = toHex(dataen(rkey, vpass));
                console.log(vuser);
                console.log(vpass);
                console.log(vxpass);
                var ajaxurl = '<?php echo $mainurl; ?>login/svlogin/'+encodeURIComponent(vuser)+'/'+vxpass+'/'+xkey;
                
                loadAjax({
                    type: 'GET',
                    url: ajaxurl,
                    onsuccess: function(data){
                        //alert('sukses');
                        location.reload();
                    },
                    onerror: function(message){
                        alert(message);
                    }
                });
                
            }
            
            function doKeyPress(e){
                if (e.keyCode == 13) {
                    doAjaxLogin();
                    //var tb = document.getElementById("scriptBox");
                    //eval(tb.value);
                    return false;
                }
                
            }
            
            
        </script>
    </body>
    
</html>



