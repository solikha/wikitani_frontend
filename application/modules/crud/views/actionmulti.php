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
<?php foreach ($actions as $action) { ?>
                        <li>
    <?php if (getArrayDef($action, 'visible', '1')==1){ ?>
        <?php if ($action['xtype']=='button') { ?>
            <a class ="<?php echo $namespace; ?>rowactionbutton <?php echo getArrayDef($action, 'class');?>"
                data-action="<?php echo getArrayDef($action, 'action');?>"
                <?php echo (isset($action['modalwidth']))?'data-modalwidth="'.$action['modalwidth'].'"':''; ?>
                data-target ="<?php echo getArrayDef($action, 'target');?>"
                data-reloadall ="<?php echo getArrayDef($action, 'reloadall');?>"
                <?php echo getArrayDef($action, 'other_setting', '');?>
                >
            <?php if(isset($action['icon'])) { ?>
                <i class="icon <?php echo $action['icon']; ?>"></i>
            <?php } ?>
            <?php echo getArrayDef($action, 'caption');?>
            </a>
        <?php } else if ($action['xtype']=='link') { ?>
            <a class ="<?php echo $namespace; ?>rowactionlink <?php echo getArrayDef($action, 'class');?>"
                data-target ="<?php echo getArrayDef($action, 'target');?>"
                data-paramlist ='<?php echo json_encode(getArrayDef($action, 'paramlist'));?>'
                >
            <?php if(isset($action['icon'])) { ?>
                <i class="icon <?php echo $action['icon']; ?>"></i>
            <?php } ?>
            <?php echo getArrayDef($action, 'caption');?>
            </a>
        <?php } else if ($action['xtype']=='crud') { ?>
            <a class ="<?php echo $namespace; ?>rowactioncrud <?php echo getArrayDef($action, 'class');?>"
                data-target ="<?php echo getArrayDef($action, 'target');?>"
                data-paramlist ='<?php echo json_encode(getArrayDef($action, 'paramlist'));?>'
                >
            <?php if(isset($action['icon'])) { ?>
                <i class="icon <?php echo $action['icon']; ?>"></i>
            <?php } ?>
            <?php echo getArrayDef($action, 'caption');?>
            </a>
        <?php } else if ($action['xtype']=='multi') { ?>
            <div class="btn-group">
                <a data-toggle="dropdown" class="btn btn-minier dropdown-toggle <?php echo getArrayDef($action, 'class');?>">
                    <?php if(isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                        <i class="fa fa-caret-down icon-on-right"></i>
                    <?php } ?>
                    <?php echo getArrayDef($action, 'caption');?>
                </a>

                <ul class="dropdown-menu">
                <?php foreach($action['items'] as $item) { ?>
                        <li>
                            <a href="#" class ="<?php echo $namespace.(getArrayDef($item, 'xtype')=='link'?'rowactionlink': 'rowactionbutton'); ?>" data-action="<?php echo getArrayDef($item, 'action');?>"
                            <?php echo (isset($item['modalwidth']))?'data-modalwidth="'.$item['modalwidth'].'"':''; ?>
                            data-target ="<?php echo getArrayDef($item, 'target');?>"
                            data-reloadall ="<?php echo getArrayDef($action, 'reloadall');?>"
                            >
                            <i class="icon <?php echo getArrayDef($item, 'icon'); ?> "></i>&nbsp;
                            <?php echo getArrayDef($item, 'caption');?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

        <?php } else if ($action['xtype']=='disable') { ?>
            <span class ="light-grey <?php echo getArrayDef($action, 'class');?>"
                style="padding-left: 11px"
                data-action="<?php echo getArrayDef($action, 'action');?>"
                <?php echo (isset($action['modalwidth']))?'data-modalwidth="'.$action['modalwidth'].'"':''; ?>
                data-target ="<?php echo getArrayDef($action, 'target');?>"
                data-reloadall ="<?php echo getArrayDef($action, 'reloadall');?>"
                <?php echo getArrayDef($action, 'other_setting', '');?>
				data-disable = "1"
                >
            <?php if(isset($action['icon'])) { ?>
                <i class="icon <?php echo $action['icon']; ?>"></i>
            <?php } ?>
            <?php echo getArrayDef($action, 'caption');?>
            </span>
        <?php } else if ($action['xtype']=='multi') { ?>
        <?php } ?>
    <?php } ?>
                        </li>
<?php } ?>

