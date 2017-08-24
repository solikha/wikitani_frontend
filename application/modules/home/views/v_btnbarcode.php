<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
?>
<script>
    function android_barcode(){
        Android.scanBarcode("http://siap24.com/url/{CODE}");
//        console.log("barcode-scan");
//        try{
//            Android.barcodeScan();
//        } catch (e){
//            alert(e.message);
//        }
    }
</script>
<hr>
<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-primary" onclick="android_barcode();">Scan Barcode</a>
    </div>
</div>
