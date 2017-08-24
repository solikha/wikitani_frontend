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
<style>
    .label-status{
        width:100%; 
        text-align:left;
        padding-top: 4px;
        margin-bottom:3px;
    }
</style>

<?php foreach ($jobsites as $jobsite) { ?>
<!--    <div class="col-xs-12 col-sm-6 widget-container-col">
        <div class="widget-box">

            <div class="widget-header widget-header-small">
                <h5 class="widget-title">
                    <?php echo $jobsite['nama'];  ?>
                </h5>
            </div>


             /section:custom/widget-box.options.collapsed 
            <div class="widget-body">
                <div class="widget-main">-->
<div class="col-xs-12 col-sm-6 widget-container-col" style="padding:0px;">
                    <div class="timeline-item clearfix" style="border:#ddd solid 1px; margin-right:5px">
                        <!-- #section:pages/timeline.info -->
                        <div class="timeline-info" style="margin-left:-10px; width:40px">
                            <img src="<?php echo $basedir.'images/pin/'.$jobsite['jobsite_status'].'.png'; ?>"
                                 style="width:36px; border-radius: 0px; margin-left:12px; margin-top:4px; border-style:none;">
                        </div>

                        <!-- /section:pages/timeline.info -->
                        <div class="widget-box transparent" style="margin-left:40px;">
                            <div class="widget-header" style=" padding-right:6px;">
                                <span ><h4 class="" style="margin-bottom:-10px"><?php echo $jobsite['nama']; ?> </h4> &nbsp;</span>


                            </div>
                            <div class="" style="margin-top:0px; margin-bottom:-12px; padding-right: 6px; padding-left:6px">
                                <b><span class=""> <span class="<?php echo $jobsite['status_class']; ?> label-status" >
                                            <?php echo $jobsite['status_zona_caption']; ?>&nbsp;</span></span></b>&nbsp;
                            </div>
                            <div class="widget-body">
                                <div class="widget-main" style="min-width:200px; padding-top:6px">

                                    <div class="teksinfo"><i class="ace-icon fa fa-map-marker pull-left"></i> <div style="margin-left:16px"><?php echo $jobsite['alamat']; ?>&nbsp;</div></div>
                                    <div class="teksinfo"><i class="ace-icon fa fa-bell-o pull-left"></i> 
                                        <div style="margin-left:16px">
                                            <?php foreach($jobsite['zona_info'] as $zona) { ?>
                                            <span class=""> 
                                                <span class="<?php echo $zona['status_class']; ?> label-status " >
                                                    <?php echo $zona['nama_zona'].' : '.$zona['cap_status_zona']; ?>&nbsp;</span>
                                            </span>
                                            <?php } ?>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
<!--                </div>
            </div>
        </div>
    </div>-->


<?php } ?>

