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
    <h1><?php echo (isset($title)?$title:''); ?></h1>
</div>
<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px">
    <?php echo (isset($parameters)?$parameters:''); ?>
</div>