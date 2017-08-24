<?php if (!defined( 'BASEPATH')) exit( 'No direct script access allowed'); /* Manggu Framework * Simple PHP Application Development * Kusnassriyanto S. Bahri * kusnassriyanto@gmail.com * */ 
//$send_replay_conf=base_url().index_page(). '/send_replay_conf'; $register_link=base_url().index_page(). '/register'; $lupa_password=base_url().index_page(). '/login/emailInput'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>
        <?php echo $appconfig[ 'app-title']; ?>
    </title>

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
            background-image: url('<?php echo base_url(); ?>themes/aceadmin/images/bg1.png');
            background-size: 100% 100%;
			background-repeat: no-repeat;
			width:100%;
			height:100%;
        }
        .title-text {
            color: black;
        }
		.main-container{
			width:100%;
			height:100%;
		}
		#footer{
		text-align:center;
		/*line-height:14px;*/
		/*background:#333;*/
		color:/*#000*/ white;
		position:absolute;
		bottom:0px;
		width:100%;
		/*height:68px;*/
		font: 12px verdana;
		/*margin-top:10px;*/
		}
	
    </style>
</head>

<body class="login-layout">
    <div class="main-container">
        <div class="main-content">
           <!-- <div class="col-md-12">
                <button type="button" class="btn btn-xs" style="background:#3300; left: 1296px; border:1px solid #676767;"  a href="http://localhost/wikitani/index.php/menu/home">Login</button>
            </div>-->

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
            <!-- /.row -->
        </div>

		


		</div>
		<div id="footer">
<b> Powered by: Kementerian Pertanian RI<br />
Jl. Harsono RM. No. 3, Ragunan-Jakarta 12550, Indonesia<br />
Telp: 021-7806131, 021-7804116. Fax: 021-7806305<br />
e-mail : webmaster@pertanian.go.id</b>
</div>	

	
    <!-- /.main-container -->

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
        if ("ontouchend" in document) document.write("<script src='<?php echo $assetdir; ?>js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>

    <!-- inline scripts related to this page -->




    <script type="text/javascript">
        function toHex(str) {
            var hex = '';
            for (var i = 0; i < str.length; i++) {
                hexchar = '00' + str.charCodeAt(i).toString(16);
                hexchar = hexchar.substr(hexchar.length - 2);
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
            jQuery('#' + id).addClass('visible');
        }

        function doAjaxLogin() {
            var vuser = $('#username').val();
            var vpass = $('#password').val();
            var vxpass = toHex(dataen(rkey, vpass));
            console.log(vuser);
            console.log(vpass);
            console.log(vxpass);
            var ajaxurl = '<?php echo $mainurl; ?>login/svlogin/' + encodeURIComponent(vuser) + '/' + vxpass + '/' + xkey;

            loadAjax({
                type: 'GET',
                url: ajaxurl,
                onsuccess: function(data) {
                    //alert('sukses');
                    location.reload();
                },
                onerror: function(message) {
                    alert(message);
                }
            });

        }

        function doKeyPress(e) {
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