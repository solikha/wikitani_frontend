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
<?php
    if ($namespace!==''){
    $xnamespace = rtrim($namespace, "_");
        $ajax_sv_name = 'svcallqueryview/'.$xnamespace;
        $ajax_cmd_name = 'commandcall/'.$xnamespace;
} else {
    $ajax_sv_name = 'svqueryview';
    $ajax_cmd_name = 'command';
}

    if (!isset($show_search_btn)){
    $show_search_btn = 1;
}
if (!isset($showgrid)){
    $showgrid = true;
}

?>
<style>
    textarea.form-control {
        height: 94px;
    }
    .pagination {
        margin-top: 3px;
        margin-bottom: 10px;
    }
    .btn-group{
        margin-top: 1px;
    }
    .table{
        margin-bottom: 12px;
    }
    .table thead>tr>th, .table tbody>tr>th, .table tfoot>tr>th, .table thead>tr>td, .table tbody>tr>td, .table tfoot>tr>td{
        padding: 5px;
    }
    .page-header{
        margin-bottom: 8px;
        padding-bottom: 5px;
    }
    .command-container{
        margin-left: 8px;
        margin-top: 3px;
        margin-bottom: 10px;
    }
    .page-content{
        padding-bottom: 16px;
    }
    .checkbox-panel{
        background-color: white;
        border: 1px solid #d5d5d5;
        padding-left: 2px;
        padding-right: 2px;
        padding-top: 5px;
        padding-bottom: 5px;
        margin-left: 1px;
        margin-right: 1px;
        min-height: 200px;
    }
    input[type=checkbox].ace+.lbl, input[type=radio].ace+.lbl{
        font-size: 12px!important;
    }
    .checkbox{
        padding-left:2px;
        margin-top: 5px;
        margin-bottom: 5px;

    }
    .edit-group{
        margin-bottom: 4px;
    }
    label {
        margin-bottom: 0px;
    }
</style>
<div class="page-header">
    <h1><?php echo $crudtitle; ?></h1>
</div>

<script>
    var base_crud_url = "<?php echo $crudurl;?>";
    var base_crud_name = "<?php echo $crudname;?>";
    function doSubmitForm(){
        $('#<?php echo $namespace; ?>crudsearch').click();
        return false;
    }
</script>

<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; 
     padding-left:5px; padding-right: 5px;
     ">
    <?php if($show_search_btn==1){?>
        <form id="param-form" onsubmit="return doSubmitForm()">
            <div class="col-xs-10 col-sm-10">
                <?php echo $crudparams; ?>
            </div>
        </form>
        <div class="col-xs-2 col-sm-2" style="margin-left:0px; padding-left:0px">
            <div class="edit-group" style="">
                <button id="<?php echo $namespace; ?>crudsearch" class="btn btn-info btn-sm" style="margin-top:20px;">Search</button>
            </div>        
        </div>
    <?php } else {?>
        <form id="param-form" onsubmit="return doSubmitForm()">
            <div class="col-xs-12 col-sm-12">
                <?php echo $crudparams; ?>
            </div>
        </form>
    <?php }?>
</div>
<?php if ($showgrid) { ?>
    <div class="row" style="background-color:rgb(239, 243, 248); padding-top: 2px; padding-left:5px; padding-right: 5px">
        <div class="col-xs-12 col-lg-12" id="<?php echo $namespace; ?>crudgrid">
            <?php echo $crudgrid ?>
        </div>                                                                    
    </div>
    <div class="row">
        <div class="pull-right">
            <span style="padding-right: 15px" id="<?php echo $namespace; ?>crudgridinfo"><?php echo $crudgridinfo ?></span>
        </div>                                                                    
    </div>
<?php } else { ?>
    <div class="row" style="background-color:rgb(239, 243, 248);">
    <div style="height: 20px"></div>
    </div>
    <div style="height: 10px"></div>
    <script>
        var gridData = [];
    </script>
<?php } ?>
<div class="row">
    <?php if ($showgrid) { ?>
        <div class="pull-left" style="margin-right: 10px" id="<?php echo $namespace; ?>crudpages">
            <?php echo $crudpages ?>
        </div>
    <?php } ?>
    <div class="pull-left command-container" id="<?php echo $namespace; ?>crudcommands">
        <?php echo $crudcommands ?>
    </div>                                                                    
    <div class="pull-left command-container" id="<?php echo $namespace; ?>cmdscripts">
        <?php echo $cmdscripts ?>
    </div>                                                                    
</div>


<script>

    OnReadyArray.push(function(){
        $('#<?php echo $namespace; ?>crudsearch').click(function(){
            //test
            debugger;
            $('#<?php echo $namespace; ?>pagenum').val(1);
            Manggu.Crud.loadData({'paramclass': '<?php echo $namespace; ?>crud-param',
                'url': '<?php echo $crudurl.$ajax_sv_name.'/'.$crudname.'/'.$actionname;?>'
            });

            //alert('test');
            console.log(this);
            //console.log($(this));
            //alert(namespace('test'));
            return false;
        })
    });

    OnReadyArray.push(function(){
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

        $('#cp1').colorpicker({
            format: 'hex'
        });


    });


    OnReadyArray.push(function(){
        $('.lookup-refresh').change(function(){
            //console.log(this);
            //console.log($(this).attr('data-lookup-refresh'));
            basurl = '<?php echo $crudurl.'svlookup/'?>';
            list = $(this).attr('data-lookup-refresh').split(',');
            console.log(list);
            for (var i=0; i<list.length; i++){
                //console.log(list[idx]);
                //console.log('xxx');
                //console.log(list[i]);
                Manggu.Crud.updateLookup({
                    lookupName: list[i],
                    baseClass: "crud-param",
                    baseurl: basurl
                });
                //x = 'test1, test2, test3';
                //console.log((x.split(', ')));

            }
        });
    });



</script>    
<script>
    var validationRules = {};

    <?php if(isset($scriptdata)) {
    echo $scriptdata;
}
?>
    // percobaan
</script>

