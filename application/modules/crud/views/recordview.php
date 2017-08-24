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
    .datapanel{
        padding-left:6px;
        padding-right: 6px;
    }
    input[disabled]{
        background-color: #fefefe!important;
    }
</style>

<div class="page-header">
    <h1><?php echo $rectitle; ?></h1>
</div>

<div class="row" style="padding-left:12px">
    <div class="pull-left command-container" id="reccommands">
        <?php echo $reccommands; ?>
    </div>                                                                    
</div>
<div class="row">
    <div class="pull-right">
        <span style="padding-right: 15px" id="crudgridinfo"><?php echo '' ?></span>
    </div>                                                                    
</div>


<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px">
    <div class="col-xs-12 col-sm-12">
        <?php echo $recmain; ?>
    </div>                                                                    
</div>
<?php if ($recmessage!=='') { ?>
<div>
    <h4><?php echo $recmessage; ?></h4>
</div>
<?php } ?>
<div class="row">
    <div class="pull-right">
        <span style="padding-right: 15px" id="crudgridinfo"><?php echo '' ?></span>
    </div>                                                                    
</div>

<?php if (isset($recdetails) and ($recdetails!=='')){ ?>
<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 2px; padding-left:5px; padding-right: 5px">
    <div class="col-xs-12 col-lg-12" id="crudgrid">
        <?php echo $recdetails ?>
    </div>                                                                    
</div>

<?php } ?>

<script>

    OnReadyArray.push(function(){
        $('.rowactionbutton').click(function(){
            //alert('test');
            console.log(this);
            actionName = $(this).attr('data-action');
            modalWidth = $(this).attr('data-modalwidth');
            modalname = 'ajax-modalnormal';
            console.log("actionName: "+actionName);
            data_idx = $(this).closest('tr').attr('data-index');
            data = gridData[data_idx];
            Manggu.Crud.showModal({
                width: modalWidth,
                url: '<?php echo $crudurl.'command/'.$crudname;?>'+'/'+actionName,
                data: data,
                modalname: modalname
            });
               
           $('#'+modalname).on('hidden.bs.modal', function () {
               if ($('#'+modalname).attr('data-modalresult')==1){
                   //alert('modal result 1')
                    Manggu.Crud.loadData({'paramclass': 'crud-param',
                        'url': '<?php echo $crudurl.'svqueryview/'.$crudname.'/'.$actionname;?>'
                    });
               }
            });
            
            return false;
        })
    });

    OnReadyArray.push(function(){
        $('.rowactionlink').click(function(){
            //alert('test123');
            console.log(this);
            baselink = '<?php echo $mainurl;?>';
            link = $(this).attr('data-target');
            if (link.indexOf('http:')===false){
                if (link.indexOf('javascript')===false){
                    url = baselink+link;
                } else {
                    url = link;
                }
            } else {
                url = link;
            }
            linkreplace = $(this).attr('data-link-replace');
            //alert(url);
            if(linkreplace==1){
                window.location.replace(url);
            } else if(linkreplace==2){
                window.open(url, '_blank');
            } else {
                document.location.href = url;
            }
            no_need_return_just_exception;
            return false;
        })
    });


</script>