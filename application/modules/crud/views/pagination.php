<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
//print_r($pagebuttons);
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
?>

<ul class="pagination">
    <?php foreach ($pagebuttons as $button) { ?>
    <?php //print_r($button);?>
        <?php if ($button['type']=='start') { ?>
            <li class = "<?php echo $namespace; ?><?php echo getArrayDef($button, 'class', ''); ?>" data-number="<?php echo getArrayDef($button, 'data-page', ''); ?>"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
        <?php } else if ($button['type']=='end') { ?>
            <li class = "<?php echo $namespace; ?><?php echo getArrayDef($button, 'class', ''); ?>" data-number="<?php echo getArrayDef($button, 'data-page', ''); ?>"><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
        <?php } else if ($button['type']=='dots') { ?>
            <li class=""><span class = "" href="#">...</span></li>
        <?php } else if ($button['type']=='number') { ?>
            <li class="<?php echo $namespace; ?><?php echo getArrayDef($button, 'class', ''); ?>" data-number="<?php echo getArrayDef($button, 'data-page', ''); ?>"><a class = "" href="#"><?php echo getArrayDef($button, 'caption', ''); ?></a></li>
        <?php }?>
    <?php }?>
</ul>    

<script>
    OnReadyArray.push(function(){
        $('.<?php echo $namespace; ?>pagebutton').click(function(){
            number = $(this).attr('data-number');
            //alert(number);
            //$('#<?php echo $namespace; ?>pagenum').val(number);
            console.log('pagenum---');
            $('.<?php echo $namespace; ?>crud-param').each(function(){
                if ($(this).attr('id')=='pagenum'){
                    $(this).val(number);
                    console.log('FOUND!!');
                }
                console.log(this);
            });
            //$('<?php echo $namespace; ?>crud-param').closest('#pagenum').val(number);
            debugger;
            Manggu.Crud.loadData({'paramclass': '<?php echo $namespace; ?>crud-param',
                'url': '<?php echo $crudurl.$ajax_sv_name.'/'.$crudname.'/'.$actionname;?>'
            });
            
            
            return false;
        })
    });
    
    OnReadyArray.push(function(){
        $('.<?php echo $namespace; ?>page-disabled').click(function(){
            return false;
        })
    });
    
</script>    