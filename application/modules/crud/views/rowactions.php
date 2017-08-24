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
<?php foreach ($rowactions as $action) { ?>
    <?php if (getArrayDef($action, 'visible', '1')==1){ ?>
        <?php if ($action['xtype']=='button') { ?>
            <button class ="<?php echo $namespace; ?>rowactionbutton btn btn-minier <?php echo getArrayDef($action, 'class');?>"
                data-action="<?php echo getArrayDef($action, 'action');?>"
                <?php echo (isset($action['modalwidth']))?'data-modalwidth="'.$action['modalwidth'].'"':''; ?>
                data-target ="<?php echo getArrayDef($action, 'target');?>"
                data-execute ="<?php echo getArrayDef($action, 'execute', 'showmodal');?>"
                <?php echo getArrayDef($action, 'other_setting', '');?>
                >
            <?php if(isset($action['icon'])) { ?>
                <i class="icon <?php echo $action['icon']; ?>"></i>
            <?php } ?>
            <?php echo getArrayDef($action, 'caption');?>
            </button>
        <?php } else if ($action['xtype']=='link') { ?>
            <button class ="<?php echo $namespace; ?>rowactionlink btn btn-minier <?php echo getArrayDef($action, 'class');?>"
                data-target ="<?php echo getArrayDef($action, 'target');?>"
                data-paramlist ='<?php echo json_encode(getArrayDef($action, 'paramlist'));?>'
                <?php echo getArrayDef($action, 'other_setting', '');?>
                >
            <?php if(isset($action['icon'])) { ?>
                <i class="icon <?php echo $action['icon']; ?>"></i>
            <?php } ?>
            <?php echo getArrayDef($action, 'caption');?>
            </button>
        <?php } else if ($action['xtype']=='crud') { ?>
            <button class ="<?php echo $namespace; ?>rowactioncrud btn btn-minier <?php echo getArrayDef($action, 'class');?>"
                data-target ="<?php echo getArrayDef($action, 'target');?>"
                data-paramlist ='<?php echo json_encode(getArrayDef($action, 'paramlist'));?>'
                <?php echo getArrayDef($action, 'other_setting', '');?>
                >
            <?php if(isset($action['icon'])) { ?>
                <i class="icon <?php echo $action['icon']; ?>"></i>
            <?php } ?>
            <?php echo getArrayDef($action, 'caption');?>
            </button>
        <?php } else if ($action['xtype']=='multi') { ?>
            <div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-minier dropdown-toggle <?php echo getArrayDef($action, 'class');?>">
                    <?php if(isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                        <i class="fa fa-caret-down icon-on-right"></i>
                    <?php } ?>
                    <?php echo getArrayDef($action, 'caption');?>
                </button>

                <ul class="dropdown-menu">
                    <?php 
                        $data = array('actions'=>$action['items']);
                        $this->load->view('actionmulti', $data);
                    ?>
                    <?php if (false) { ?>
                    <?php //foreach($action['items'] as $item) { ?>
                        <li>
                            <?php
                                $vxtype = getArrayDef($item, 'xtype');
                                if ($vxtype=='link'){
                                    $xclass = 'rowactionlink';
                                } else if ($vxtype=='crud'){
                                    $xclass = 'rowactioncrud';
                                } else {
                                    $xclass = 'rowactionbutton';
                                }
                            ?>
                            <a href="#" 
                               class ="<?php echo $namespace.$xclass; ?>" 
                               data-action="<?php echo getArrayDef($item, 'action');?>"
                            <?php echo (isset($item['modalwidth']))?'data-modalwidth="'.$item['modalwidth'].'"':''; ?>
                            data-target ="<?php echo getArrayDef($item, 'target');?>"
                            >
                            <i class="icon <?php echo getArrayDef($item, 'icon'); ?> "></i>&nbsp;
                            <?php echo getArrayDef($item, 'caption');?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

        <?php } ?>
    <?php } ?>
<?php } ?>



