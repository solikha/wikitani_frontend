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
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>libs/codemirror/codemirror.css">
<script type="text/javascript" src="<?php echo base_url(); ?>libs/codemirror/codemirror.js"></script>

<style>
    .sql_cmd{
        min-height: 400px;
    }
</style>
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12"></div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
            <!-- #section:custom/widget-box -->
            <div class="widget-box ui-sortable-handle">
                <div class="widget-header">
                    <h5 class="widget-title">SQL Command</h5>

                    <!-- #section:custom/widget-box.toolbar -->
                    <div class="widget-toolbar">
                        <div class="widget-menu">
                            <a href="#" data-action="settings" data-toggle="dropdown">
                                <i class="ace-icon fa fa-bars"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
                                <li>
                                    <a data-toggle="tab" href="#dropdown1">Option#1</a>
                                </li>

                                <li>
                                    <a data-toggle="tab" href="#dropdown2">Option#2</a>
                                </li>
                            </ul>
                        </div>

                        <a href="#" data-action="fullscreen" class="orange2">
                            <i class="ace-icon fa fa-expand"></i>
                        </a>

                        <a href="#" data-action="reload">
                            <i class="ace-icon fa fa-refresh"></i>
                        </a>

                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>

                        <a href="#" data-action="close">
                            <i class="ace-icon fa fa-times"></i>
                        </a>
                    </div>

                    <!-- /section:custom/widget-box.toolbar -->
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row sql_cmd">
                            <div class="col-xs-9">
                                <textarea class="form-control sql_cmd" id="sql-text">TEst</textarea>
                            </div>
                            <div class="col-xs-3">
                                Param
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /section:custom/widget-box -->
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
            <!-- #section:custom/widget-box -->
            <div class="widget-box ui-sortable-handle">
                <div class="widget-header">
                    <h5 class="widget-title">SQL Result</h5>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                    </div>
                </div>
            </div>

            <!-- /section:custom/widget-box -->
        </div>
    </div>
    
    
</div>
<script>
var editor = CodeMirror.fromTextArea("sql-text", {
    lineNumbers: true
});    
    
</script>