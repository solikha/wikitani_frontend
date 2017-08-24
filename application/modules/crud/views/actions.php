<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
//print_r(get_defined_vars());
?>
<?php foreach ($actions as $action) { ?>
    <?php if ($action['xtype'] == 'button') { ?>
        <div class="btn-group">
            <button class ="btn-group <?php echo $namespace; ?>rowactionbutton btn btn-sm <?php echo getArrayDef($action, 'class'); ?>"
                    data-action="<?php echo getArrayDef($action, 'action'); ?>"
                    data-target ="<?php echo getArrayDef($action, 'target'); ?>"
                    <?php echo (isset($action['modalwidth'])) ? 'data-modalwidth="' . $action['modalwidth'] . '"' : ''; ?>
                    data-reloadall ="<?php echo getArrayDef($action, 'reloadall'); ?>"
                    data-y=""
                    id="<?php echo getArrayDef($action, 'name'); ?>" 
                    <?php echo getArrayDef($action, 'other_setting', ''); ?>
                    >
                        <?php if (isset($action['iconpos']) and ( $action['iconpos'] == 'right')) { ?>
                            <?php echo getArrayDef($action, 'caption'); ?>
                            <?php if (isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                    <?php } ?>
                    <?php echo getArrayDef($action, 'caption'); ?>
                <?php } ?>
            </button>
        </div>
    <?php } else if ($action['xtype'] == 'linkbreadcrumbs') { ?>
        <li>
            <a class ="<?php echo $namespace; ?>rowactionlink " style="cursor:pointer"
               data-target ="<?php echo getArrayDef($action, 'target'); ?>"
               data-x="" data-link-replace="<?php echo getArrayDef($action, 'linkreplace'); ?>"
               type="button"
               data-paramlist ='<?php echo json_encode(getArrayDef($action, 'paramlist')); ?>'
               id="<?php echo getArrayDef($action, 'name'); ?>" 
               <?php echo getArrayDef($action, 'other_setting', ''); ?>
               >
                   <?php if (isset($action['iconpos']) and ( $action['iconpos'] == 'right')) { ?>
                       <?php echo getArrayDef($action, 'caption'); ?>
                       <?php if (isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                    <?php } ?>
                    <?php echo getArrayDef($action, 'caption'); ?>
                <?php } ?>
            </a>
        </li>
    <?php } else if ($action['xtype'] == 'linkbreadcrumbsactive') { ?>
        <li class="active">
            <?php echo getArrayDef($action, 'caption'); ?>
        </li>
    <?php } else if ($action['xtype'] == 'link') { ?>
        <div class="btn-group">
            <button class ="<?php echo $namespace; ?>rowactionlink btn btn-sm <?php echo getArrayDef($action, 'class'); ?>"
                    data-target ="<?php echo getArrayDef($action, 'target'); ?>"
                    data-x="" data-link-replace="<?php echo getArrayDef($action, 'linkreplace'); ?>"
                    type="button"
                    data-paramlist ='<?php echo json_encode(getArrayDef($action, 'paramlist')); ?>'
                    id="<?php echo getArrayDef($action, 'name'); ?>" 
                    <?php echo getArrayDef($action, 'other_setting', ''); ?>
                    >
                        <?php if (isset($action['iconpos']) and ( $action['iconpos'] == 'right')) { ?>
                            <?php echo getArrayDef($action, 'caption'); ?>
                            <?php if (isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                    <?php } ?>
                    <?php echo getArrayDef($action, 'caption'); ?>
                <?php } ?>
            </button>
        </div>
    <?php } else if ($action['xtype'] == 'multi') { ?>
        <div class="btn-group">
            <button data-toggle="dropdown" class="btn btn-sm dropdown-toggle <?php echo getArrayDef($action, 'class'); ?>">
                <?php if (isset($action['icon'])) { ?>
                    <i class="icon <?php echo $action['icon']; ?>"></i>
                <?php } ?>
                <?php echo getArrayDef($action, 'caption'); ?>
                id="<?php echo getArrayDef($action, 'name'); ?>" 
                <i class="icon-angle-down icon-on-right"></i>
            </button>

            <ul class="dropdown-menu">
                <?php foreach ($action['items'] as $item) { ?>
                    <li>
                        <a href="#" class ="<?php echo (getArrayDef($item, 'xtype') == 'link' ? 'rowactionlink' : 'rowactionbutton'); ?>" data-action="<?php echo getArrayDef($item, 'action'); ?>"
                        <?php echo (isset($item['modalwidth'])) ? 'data-modalwidth="' . $item['modalwidth'] . '"' : ''; ?>
                           data-target ="<?php echo getArrayDef($item, 'target'); ?>"
                           data-reloadall ="<?php echo getArrayDef($action, 'reloadall'); ?>"
                           >
                            <i class="icon <?php echo getArrayDef($item, 'icon'); ?> "></i>&nbsp;
                            <?php echo getArrayDef($item, 'caption'); ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    <?php } else if ($action['xtype'] == 'alink') { ?>
        <div class="btn-group">
            <a class =" btn btn-sm <?php echo getArrayDef($action, 'class'); ?>"
               href ="<?php echo getArrayDef($action, 'target'); ?>"
               data-x="" data-link-replace="<?php echo getArrayDef($action, 'linkreplace'); ?>"
               id="<?php echo getArrayDef($action, 'name'); ?>" 
               <?php echo getArrayDef($action, 'other_setting', ''); ?>
               >
                   <?php if (isset($action['iconpos']) and ( $action['iconpos'] == 'right')) { ?>
                       <?php echo getArrayDef($action, 'caption'); ?>
                       <?php if (isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                    <?php } ?>
                    <?php echo getArrayDef($action, 'caption'); ?>
                <?php } ?>
            </a>
        </div>

    <?php } else if ($action['xtype'] == 'inactive') { ?>
        <div class="btn-group">
            <button class ="btn-group btn btn-sm <?php echo getArrayDef($action, 'class'); ?>" disabled
                    id="<?php echo getArrayDef($action, 'name'); ?>" 
                    <?php echo getArrayDef($action, 'other_setting', ''); ?>
                    >
                        <?php if (isset($action['iconpos']) and ( $action['iconpos'] == 'right')) { ?>
                            <?php echo getArrayDef($action, 'caption'); ?>
                            <?php if (isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                    <?php } ?>
                    <?php echo getArrayDef($action, 'caption'); ?>
                <?php } ?>
            </button>
        </div>
    <?php } else if ($action['xtype'] == 'blank') { ?>
        <div class="btn-group">
            <a class ="<?php echo $namespace; ?> btn btn-sm <?php echo getArrayDef($action, 'class'); ?>"
               data-x="" data-link-replace="<?php echo getArrayDef($action, 'linkreplace'); ?>"
               id="<?php echo getArrayDef($action, 'name'); ?>" 
               <?php echo getArrayDef($action, 'other_setting', ''); ?>
               >
                   <?php if (isset($action['iconpos']) and ( $action['iconpos'] == 'right')) { ?>
                       <?php echo getArrayDef($action, 'caption'); ?>
                       <?php if (isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (isset($action['icon'])) { ?>
                        <i class="icon <?php echo $action['icon']; ?>"></i>
                    <?php } ?>
                    <?php echo getArrayDef($action, 'caption'); ?>
                <?php } ?>
            </a>
            <script>
                OnReadyArray.push(function () {
                    function OpenNewTab(url) {
                        var win = window.open(url, '_blank');
                        win.focus();
                    }

        <?php
        $m = getArrayDef($action, "paramlist");
        list($v) = $m;
        ?>
                    $('#<?php echo getArrayDef($action, 'name'); ?>').unbind('click');
                    $('#<?php echo getArrayDef($action, 'name'); ?>').bind('click', function () {
                        var lyn_id = $('#<?php echo $v; ?>').val();
                        var top = <?php echo getArrayDef($action, "padding_top"); ?>;
                        var left = <?php echo getArrayDef($action, "padding_left"); ?>;
                        OpenNewTab('<?php echo getArrayDef($action, 'target'); ?>/<?php echo getArrayDef($action, 'name'); ?>?lyn_id=' + lyn_id + '&top=' + top + '&left=' + left);
                    });
                });
            </script>
        </div>
    <?php } ?>

<?php } ?>


