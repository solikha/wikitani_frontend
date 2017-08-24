<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

?>
<script>
    function SetDisabledButton(mode){
        if (mode){
            $('#loading-img').show();
            $('#btn-scan').hide();
            $('#btn-scan-disabled').show();
        } else {
            $('#loading-img').hide();
            $('#btn-scan').show();
            $('#btn-scan-disabled').hide();
        }
    }
    function android_barcode(){
        console.log("barcode scan");
        vsignature = '<?php echo $signature; ?>'+(new Date).getTime();
        vurl = "<?php echo $basedir.index_page(); ?>/menu/reg_barcode/{CODE}/<?php echo $check_point_id; ?>"+
            "/view/register_qrcode";
        SetDisabledButton(true);
        //$('#loading-img').show();
        //$('#btn-scan').prop( "disabled", true );
//        $('#btn-scan').prop({
//            disabled: true
//        });
        //$('#btn-scan').hide();

//        vurl = "<?php echo $basedir.index_page(); ?>/barcode/patroli/{CODE}/"+vsignature;
        try {
            console.log(vurl);
            Android.scanBarcode(vurl);
        } catch (e) {
            console.log(e.message);
            SetDisabledButton(false);
        }
//        Android.scanBarcode("http://siap24.com/url/{CODE}");
//        console.log("barcode-scan");
//        try{
//            Android.barcodeScan();
//        } catch (e){
//            alert(e.message);
//        }
    }
</script>
<div class="page-header">
    <h1>
    <img id="loading-img" src="<?php echo $basedir; ?>/images/base/loading.gif"
         style="display:none">
        Register QR Code 
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Admin
        </small>
    </h1>
</div>
<div class="row">
    <div class="col-xs-12">
        <a id="btn-scan" class="btn btn-primary" onclick="android_barcode();" >Scan Barcode</a>
        <a id="btn-scan-disabled" class="btn btn-primary" onclick="android_barcode();" 
           style="display:none" disabled>Scan Barcode</a>
    </div>
</div>
