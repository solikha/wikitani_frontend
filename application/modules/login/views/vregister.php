<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
$perjanjian = base_url().index_page().'/perjanjian_pengguna';
//$login_link = base_url() . index_page() . '/logout';
$login_link = base_url().'index.php/login';
?>
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

        <!--[if IE 7]>
          <link rel="stylesheet" href="<?php echo $assetdir; ?>css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->

        <!-- fonts -->

        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-fonts.min.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/jquery.gritter.css" />

        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace.css" />
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/ace-rtl.css" />

        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/bootstrap-datepicker3.css" />
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/daterangepicker.css" />
        <link rel="stylesheet" href="<?php echo $assetdir; ?>css/bootstrap-datetimepicker.css" />
        
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
        <script>
            var submit_register = function(){
            }
            
            
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
            
            
            
        </script>
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
                                            <div class="block col-sm-8 col-sm-offset-4">
                                                <h5 style="color: white;">
                                                    Masukkan Data Diri Anda untuk mendaftar.
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <form id="form-register" action="testing">
                                        <input type="hidden" name="enc_type" value="1">
                                        <fieldset>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="block clearfix">
                                                        <span class="col-sm-4 right register-label" for="form-field-select-1" style="color: white;">Email</span>
                                                        <span class="col-sm-8 block ">
                                                            <input type="email" class="form-control" placeholder="" name="email" required>
                                                        </span>
                                                    </label>
                                                    <label class="block clearfix">
                                                        <span class="col-sm-4 right register-label" for="form-field-select-1" style="color: white;">Nama Lengkap</span>
                                                        <span class="col-sm-8 block ">
                                                            <input type="text" class="form-control" placeholder="" name="full_name" required>
                                                        </span>
                                                    </label>
                                                    <label class="block clearfix">
                                                        <span class="col-sm-4 right register-label" for="form-field-select-1" style="color: white;">Password</span>
                                                        <span class="col-sm-8 block ">
                                                            <input type="password" class="form-control" placeholder=""  name="password" required>														
                                                        </span>
                                                    </label>
                                                    <label class="block clearfix">
                                                        <span class="col-sm-4 right register-label" for="form-field-select-1" style="color: white;">Ulangi Password</span>
                                                        <span class="col-sm-8 block ">
                                                            <input type="password" class="form-control" placeholder=""  name="k_password" required>															
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label class="block clearfix">
                                                        <span class="col-sm-4 right register-label" for="form-field-select-1" style="color: white;">Pria/Wanita</span>
                                                        <span class="col-sm-8 block ">
                                                            <select class="form-control" id="form-field-select-1" placeholder=""  name="jenkelid" required>
                                                                <option value=""></option>
                                                                <option value="1">Pria</option>
                                                                <option value="2">Wanita</option>
                                                            </select>
                                                        </span>
                                                    </label>
                                                    <label class="block clearfix">
                                                        <span class="col-sm-4 right register-label" for="form-field-select-1" style="color: white;">Kota Tempat Lahir</span>
                                                        <span class="col-sm-8 block">
                                                            <input type="text" class="form-control" placeholder=""  name="birth_city" required>
                                                        </span>
                                                    </label>
                                                   <!-- <label class="block clearfix">
                                                        <span class="col-sm-4 right register-label" for="form-field-select-1" style="color: white;">Negara Tempat Lahir</span>
                                                        <span class="col-sm-8 block">
                                                            <select class="form-control" id="form-field-select-1" placeholder=""  name="birth_country" required>
                                                                <?php echo $country; ?>
                                                            </select>
                                                        </span>
                                                    </label>-->
                                                    <label class="block clearfix">
                                                        <span class="col-sm-4 right register-label" for="form-field-select-1" style="color: white;">Tanggal Lahir</span>
                                                        <div class="col-sm-8 register-date input-group">
                                                            <input class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy"  name="birth_date"  required>
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar bigger-110"></i>
                                                            </span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="block col-sm-8 col-sm-offset-4">
                                                        <input type="checkbox" class="form-control my_checkbox" name = "accept" required>
                                                        <span style="color: white">
                                                            Saya Menerima
                                                            <a href="<?php echo $perjanjian;?>" style="color: white;">Perjanjian Pengguna</a>
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label class="block col-sm-8 col-sm-offset-4">
                                                        <span class="lbl" xstyle="vertical-align: bottom;" style="color: white;">
                                                            Semua field harus diisi
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                                <div class="space-16"></div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="clearfix">
                                                        <a style="margin-top: 6px" href="<?php echo $login_link; ?>" class="pull-left btn btn-sm width-25 btn-link">
                                                            <span  style="color: white;">Login Screen</span>
                                                        </a>
                                                        <button style="margin-left:10px" type="reset" class="pull-left btn btn-sm width-25 ">
                                                            <span class="bigger-110">Reset</span>
                                                        </button>
                                                        <button style="margin-left:10px" type="submit" onclick="submit_register();" class="width-45 pull-left btn btn-sm btn-primary">
                                                            <span class="bigger-110">Daftar</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>

                            </div><!-- /.widget-body -->
                            <div class="space-12"></div>
                        </div>                        


                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo $assetdir; ?>js/jquery.min.js'>" + "<" + "/script>");
        </script>


        <!-- <![endif]-->

        <!--[if IE]>
        <script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo $assetdir; ?>js/jquery-1x.min.js'>"+"<"+"/script>");
        </script>
        <![endif]-->
        
        

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



        <script type="text/javascript">


        </script>
    </body>

    <script>
        
        Manggu.showAlert = function(message, title, style){
            //alert("xxx-"+message);
            var vtitle, vstyle;
            if (typeof title == 'undefined'){
                vtitle = 'Error';
            }
            if (typeof style == 'undefined'){
                vstyle = 'error';
            }
            if (style == 'error'){
                vstyle = 'gritter-error';
            } else if (style == 'warning'){
                vstyle = 'gritter-warning';
            } else if (style == 'success'){
                vstyle = 'gritter-success';
            } else {
                vstyle = 'gritter-info';
            }
            //vstyle = vstyle;//+' gritter-center';

            $.gritter.add({
                title: vtitle,
                text: message,
                class_name: vstyle
            });
        }/*show alert*/
                
                
            var xkey = '<?php echo $kode_data;?>';
            var rkey = '<?php echo $key_data;?>';
            
        $( "#form-register" ).submit(function( event ) {
            event.preventDefault();
            var vdata = $( this ).serializeArray();
            var data = {}
            for (var i=0; i<vdata.length; i++){
                var item = vdata[i];
                data[item.name] = item.value;
            }
            
            var vpass = data['password'];
            var vkpass = data['k_password'];
            var vxpass = toHex(dataen(rkey, vpass));
            var vxkpass = toHex(dataen(rkey, vkpass));
            data['password'] = vxpass;
            data['k_password'] = vxkpass;
            data['pwd_key'] = xkey;
            
            console.log( vdata );
            console.log(data);
            var ajaxurl = '<?php echo $mainurl; ?>login/svregister';
            Manggu.loadAjax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                onsuccess: function(data){
                    //alert('sukses');
                    //location.reload();
                    //alert(data.message);
                    if (typeof data.redirect !== 'undefined'){
                        window.location=data.redirect;
                    } else if (typeof data.redirect !== 'undefined'){
                        Manggu.showAlert(data.message, 'Error', 'success');
                    } else {
                        Manggu.showAlert('Success', 'Error', 'success');
                    }
                },
                onerror: function(message){
                    //alert(message);
                    Manggu.showAlert(message, 'Error');
                }
            });
            
        });            
        
        //Manggu.showAlert('Testing Error');
        
    $(document).ready(function(){
        var dtranges = {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Last 7 Days': [moment().subtract('days', 6), moment()],
            'Last 30 Days': [moment().subtract('days', 29), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')]
                    //'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        }
		
        $('.date-range-picker').daterangepicker({format:'YYYY-MM-DD', ranges:dtranges},
            function(start, end, vobj) {
            console.log("Callback has been called!");
            //$('#reportrange span').html(start.format('D MMMM YYYY') + ' sd ' + end.format('D MMMM YYYY'));
            console.log(this);
            //$(this).find('span').html('xxx');
            //console.log($(this).container.attr('class'));
            console.log(this.element);
            console.log($(this.element).attr('data-dateend'));
            startobj = $(this.element).attr('data-datestart');
            endobj = $(this.element).attr('data-dateend');
                $('#'+startobj).val(start.format('YYYY-MM-DD'));
                $('#'+endobj).val(end.format('YYYY-MM-DD'));

        }
            ).prev().on(ace.click_event, function(){
            $(this).next().focus();
        });

        $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });        
        
    });
        
    </script>
</html>



