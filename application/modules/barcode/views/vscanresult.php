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
<div class="page-header">
    <h1>
        Scan QR Code
    </h1>
</div>
    <div class="alert alert-info">
        <?php echo $message; ?>
    </div>
<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-primary" href="<?php echo $backurl;?>">Back</a>
        <a class="btn btn-primary" href="<?php echo $basedir.index_page();?>/menu/home">Home</a>
    </div>
</div>
