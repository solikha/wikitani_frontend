<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

///penting: file ini belum digunakan!
?>
<table id="sample-table-1" class="table table-striped table-bordered table-hover">
    <?php // header ?>
    <thead>
        <tr>
            <?php if ($rowactposition=='left') {?>
            <td><?php echo getArrayDef($cruddata['rowactions'], 'caption', 'Actions');?></td>
            <?php } ?>
            <?php foreach($cruddata['rowactions'] as $row) {?>
            <td> <?php echo getArrayDef($field, 'caption', getArrayDef($field, 'name', '')); ?></td>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datagrid['data'] as $row){ ?>
            <?php foreach($this->crudData['fieldlist'] as $field){ 
                //$value = $field['name'];
                $value = getArrayDef($row, $field['name'], ''); ?>
                <td><?php echo $value ?></td>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>

