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
    <div class="col-xs-10 col-sm-10">
        <div class="col-sm-6 col-md-4 col-lg-4" style="">
            <?php echo (isset($group1)?$group1:''); ?>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4" style="">
            <?php echo (isset($group2)?$group2:''); ?>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-4" style="">
            <?php echo (isset($group3)?$group3:''); ?>
        </div>
    </div>                                                                    
    <div class="col-xs-2 col-sm-2" style="margin-left:0px; padding-left:0px">
        <div class="edit-group" style="">
            <button id="crudsearch" class="btn btn-info btn-sm" style="margin-top:25px;">Search</button>
        </div>        
    </div>
