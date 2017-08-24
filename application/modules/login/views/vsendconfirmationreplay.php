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
        <title>Password Form Page - <?php echo $appconfig['app-title']; ?></title>
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
        <script>
            var submit_register = function () {
            }


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



        </script>
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
                                    <form id="form_pass" action="testing">
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

                                        </div>
                                    </form>
                                </div><!-- /widget-main -->
                            </div><!-- /widget-body -->
                        </div><!-- /login-box -->
                    </div><!-- /position-relative -->
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
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
    <script type="text/javascript">
    </script>
    <div class="col-sm-4" style="top:15px;right:15px;position:fixed;">
        <div class="alert alert-success" id="success" style="display: none;">
            <strong></strong>
        </div>

        <div class="alert alert-info" id="info" style="display: none;">
            <strong></strong>
        </div>

        <div class="alert alert-warning" id="warning" style="display: none;">
            <strong></strong>
        </div>

        <div class="alert alert-danger" id="danger" style="display: none;">
            <strong></strong>
        </div>
    </div>
</body>
<script>
    function alertshowhide(text, id) {
        document.getElementById(id).style.display = 'block';
        var timePeriodInMs = 4000;
        setTimeout(function ()
        {
            document.getElementById(id).style.display = "none";
        },
                timePeriodInMs);
        document.getElementById(id).innerHTML = '<strong></strong> ' + text;
    }

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

    $("#form_pass").submit(function (event) {
        event.preventDefault();
        var vdata = $(this).serializeArray();
        var data = {}
        for (var i = 0; i < vdata.length; i++) {
            var item = vdata[i];
            data[item.name] = item.value;
        }

        var vxpass = data['password'];
        data['password'] = vxpass;
        console.log(vdata);
        console.log(data);
        var ajaxurl = '<?php echo $mainurl; ?>login/sendReplay';
        Manggu.loadAjax({
            type: 'POST',
            url: ajaxurl,
            data: data,
            onsuccess: function (data) {
                //alert('sukses');
                //location.reload();
                //alert(data.message);
                if (typeof data.redirect !== 'undefined') {
                    window.location = data.redirect;
                } else if (typeof data.redirect !== 'undefined') {
                    alertshowhide(data.message, 'success');
                } else {
                    alertshowhide('Success', 'success');
                }
            },
            onerror: function (message) {
                //alert(message);
                alertshowhide(message, 'danger');
            }
        });
    });
    $(document).ready(function () {
        var dtranges = {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Last 7 Days': [moment().subtract('days', 6), moment()],
            'Last 30 Days': [moment().subtract('days', 29), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')]
                    //'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        }
        $('.date-range-picker').daterangepicker({format: 'YYYY-MM-DD', ranges: dtranges},
        function (start, end, vobj) {
            console.log("Callback has been called!");
            //$('#reportrange span').html(start.format('D MMMM YYYY') + ' sd ' + end.format('D MMMM YYYY'));
            console.log(this);
            //$(this).find('span').html('xxx');
            //console.log($(this).container.attr('class'));
            console.log(this.element);
            console.log($(this.element).attr('data-dateend'));
            startobj = $(this.element).attr('data-datestart');
            endobj = $(this.element).attr('data-dateend');
            $('#' + startobj).val(start.format('YYYY-MM-DD'));
            $('#' + endobj).val(end.format('YYYY-MM-DD'));
        }
        ).prev().on(ace.click_event, function () {
            $(this).next().focus();
        });
        $('.date-picker').datepicker({autoclose: true}).next().on(ace.click_event, function () {
            $(this).prev().focus();
        });
    });
</script>
</html>



