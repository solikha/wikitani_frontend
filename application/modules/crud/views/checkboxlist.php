<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
if(!isset($fieldcount)){
    $fieldcount=0;
}
if($fieldcount>0){
    $haschild=1;
    $nodeheight = 26;
} else {
    $haschild=0;
    $nodeheight = 20;
}
//print_r($fieldcount); die;
?>
<style>
    .cbox-child {
        padding: 0!important;
        padding-left:4px!important;
        padding-right:4px!important;
        margin: 2px!important;
        width: 40px;
    }
    .cbox_check_item {
        height:20px!important;
    }
</style>
<?php
    foreach($arrelements as $element){
?>

<?php   if($element['xtype']=='row'){ ?>
<div class="<?php echo getArrayDef($element, 'class', 'row');?>" >
<?php   } else if($element['xtype']=='/row'){ ?>
</div>
<?php   } else if($element['xtype']=='column'){ ?>
    <div class="<?php echo getArrayDef($element, 'class', '');?>" >
<?php   } else if($element['xtype']=='/column'){ ?>
    </div>
<?php   } else if($element['xtype']=='checkbox'){ ?>
    <div class="checkbox" style="min-height:<?php echo $nodeheight; ?>px">
        <label>
            <input name="form-field-checkbox" class="ace ace-checkbox-2 cbox_check_item" 
                   data-haschild="<?php echo $haschild;?>"
                   
                   data-check-target=".group-checbox-item-<?php echo $element['id']; ?>"
                    type="checkbox" data-cboxid="<?php echo $element['id']; ?>" 
                    <?php echo ($element['checked']==1? 'checked': '' ); ?>
                    >
            <span class="lbl" id="form-field-checkbox-child-<?php echo $element['id']; ?>">
            <?php for($idx=0; $idx<$fieldcount; $idx++){ ?>
                <input name="form-field-checkbox<?php echo $idx;?>" 
                    class="cbox-child group-checbox-item-<?php echo $element['id']; ?>" 
                    style="<?php echo ($element['checked']==1? '': 'display:none' ); ?>"
                    type="text" data-cboxid="<?php echo $element['id']; ?>" 
                    value="<?php echo isset($element['field'][$idx])?$element['field'][$idx]:''; ?>"
                    >
            <?php } ?>
            </span>
            <span class="lbl"> <?php echo $element['value']; ?></span>
        </label>
    </div>

<?php   } else if($element['xtype']==''){ ?>
<?php   } ?>

<?php } ?>

