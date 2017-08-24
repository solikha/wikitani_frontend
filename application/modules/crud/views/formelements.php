<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//echo asdfasdfe;
/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
?>
<?php

function get_checked_value($data) {
    if ($data) {
        return "checked";
    } else {
        return '';
    }
}

foreach ($arrelements as $element) {
    if (!isset($element['xtype'])) {
        $element['xtype'] = 'text';
    }
    if (getArrayDef($element, 'visible', '1') == '0') {
        $invistyle = 'display:none';
    } else {
        $invistyle = '';
    }
    if (isset($element['required'])){
        if ($element['required']=='1'){
            $element['required'] = 'required';
        }
    }
//        echo '******';
//        print_r(getArrayDef($element, 'lookup-data', ''));
    $itemstyle = getArrayDef($element, 'style', '');
    $groupstyle = getArrayDef($element, 'groupstyle', '');
    $labelstyle = getArrayDef($element, 'labelstyle', '');

    $itemoptions = getArrayDef($element, 'options', '');
    $groupoptions = getArrayDef($element, 'groupoptions', '');
    $labeloptions = getArrayDef($element, 'groupoptions', '');
    ?>
    <?php if ($element['xtype'] == 'row') { ?>
        <div class="<?php echo getArrayDef($element, 'class', 'row'); ?>" style="<?php echo $invistyle; ?>">
        <?php } else if ($element['xtype'] == '/row') { ?>
        </div>
    <?php } else if ($element['xtype'] == 'column') { ?>
        <div class="<?php echo getArrayDef($element, 'class', ''); ?>" style="<?php echo $invistyle; ?>">
        <?php } else if ($element['xtype'] == '/column') { ?>
        </div>
    <?php } else if ($element['xtype'] == 'generate_number') { ?>
        <!--code ini untuk mendapatkan numbernya-->
        <script type="text/javascript">
            if ($('.navbar-brand').attr('href') == '#') {
                $('.navbar-brand').attr('href', "");
        //                get_no();
                set_no();
            } else {
                $('.navbar-brand').attr('href', "#");
            }

            $('#crudexecute').click(function () {
        //                set_no();
            });

            function get_no() {
                var code = $('#generate_number').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/workflow/get_no/" + code,
                    success: function (msg) {
                        $('.generate_number').val(msg);
                    }
                });
            }

            function set_no() {
                var code = $('#generate_number').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/workflow/set_no/" + code,
                    success: function (msg) {
                        $('.generate_number').val(msg);
                    }
                });
            }
        </script>
        <!--dan ini untuk mendapatkan codenya-->
        <input value="<?php echo getArrayDef($element, 'code'); ?>" id="generate_number" type="hidden"/>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name'); ?>" style="<?php echo $labelstyle; ?>"> <?php echo getArrayDef($element, 'caption'); ?> </label>
            <input type="text" class="generate_number form-control <?php echo getArrayDef($element, 'class', ''); ?>" placeholder="<?php echo getArrayDef($element, 'placeholder', '') ?>" 
                   name="<?php echo getArrayDef($element, 'name'); ?>" id="<?php echo getArrayDef($element, 'name'); ?>"
                   style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                   value="<?php echo getArrayDef($element, 'value'); ?>" 
                   <?php echo getArrayDef($element, 'required'); ?> 
                   <?php echo (isset($element['maxlength'])) ? 'maxlength="' . $element['maxlength'] . '"' : ''; ?> />
        </div>
    <?php } else if ($element['xtype'] == 'text') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name'); ?>" style="<?php echo $labelstyle; ?>"> <?php echo getArrayDef($element, 'caption'); ?> </label>
            <input type="text" class="form-control <?php echo getArrayDef($element, 'class', ''); ?>" placeholder="<?php echo getArrayDef($element, 'placeholder', '') ?>" 
                   name="<?php echo getArrayDef($element, 'name'); ?>" id="<?php echo getArrayDef($element, 'name'); ?>"
                   style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                   value="<?php echo getArrayDef($element, 'value'); ?>" 
                   <?php echo getArrayDef($element, 'required'); ?> 
                   <?php echo (isset($element['maxlength'])) ? 'maxlength="' . $element['maxlength'] . '"' : ''; ?> />
        </div>
    <?php } else if ($element['xtype'] == 'text-disable') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name'); ?>" style="<?php echo $labelstyle; ?>"> <?php echo getArrayDef($element, 'caption'); ?> </label>
            <input type="text" class="form-control <?php echo getArrayDef($element, 'class', ''); ?>" placeholder="<?php echo getArrayDef($element, 'placeholder', '') ?>" 
                   name="<?php echo getArrayDef($element, 'name'); ?>" id="<?php echo getArrayDef($element, 'name'); ?>"
                   style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                   value="<?php echo getArrayDef($element, 'value'); ?>" disabled />
        </div>
    <?php } else if ($element['xtype'] == 'typeahead') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name'); ?>" style="<?php echo $labelstyle; ?>"> <?php echo getArrayDef($element, 'caption'); ?> </label>
            <input class="typeahead" type="text" placeholder="<?php echo getArrayDef($element, 'placeholder', '') ?>"
                   name="<?php echo getArrayDef($element, 'name'); ?>" id="<?php echo getArrayDef($element, 'name'); ?>"
                   autocomplete="off" spellcheck="false" dir="auto" 
                   data-lookupname="<?php echo getArrayDef($element, 'lookupname'); ?>"
                   style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                   <?php echo getArrayDef($element, 'required'); ?> 
                   value="<?php echo getArrayDef($element, 'value'); ?>"
                   >

        </div>
    <?php } else if ($element['xtype'] == 'hidden') { ?>
        <input type="hidden" class="form-control <?php echo getArrayDef($element, 'class', ''); ?>" placeholder="<?php echo getArrayDef($element, 'placeholder', '') ?>" 
               name="<?php echo getArrayDef($element, 'name'); ?>" id="<?php echo getArrayDef($element, 'name'); ?>"
               style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
               value="<?php echo getArrayDef($element, 'value'); ?>" />
           <?php } else if ($element['xtype'] == 'password') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>" style="<?php echo $labelstyle; ?>"> <?php echo getArrayDef($element, 'caption', '...'); ?> </label>
            <input type="password" class="form-control <?php echo getArrayDef($element, 'class', ''); ?>" placeholder="<?php echo getArrayDef($element, 'placeholder', '') ?>" 
                   name="<?php echo getArrayDef($element, 'name', ''); ?>" id="<?php echo getArrayDef($element, 'name', ''); ?>"
                   style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                   value="<?php echo getArrayDef($element, 'value'); ?>" />
        </div>
    <?php } else if ($element['xtype'] == 'date') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>" style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
            <div class="input-group" style="padding:0px">
                <input class="form-control date-picker <?php echo getArrayDef($element, 'class', ''); ?>" type="text" 
                       data-date-format="<?php echo getArrayDef($element, 'dateformat', 'dd-mm-yyyy'); ?>" 
                       name="<?php echo getArrayDef($element, 'name', ''); ?>" id="<?php echo getArrayDef($element, 'name', ''); ?>" 
                       style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                       <?php echo getArrayDef($element, 'required'); ?> 
                       value="<?php echo getArrayDef($element, 'value'); ?>" />
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>
    <?php } else if ($element['xtype'] == 'date-range') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>" style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
            <div class="input-group" style="padding:0px">
                <input class="form-control date-range-picker " type="text" 
                       data-date-format="<?php echo getArrayDef($element, 'dateformat', 'dd-mm-yyyy'); ?>" 
                       name="<?php echo getArrayDef($element, 'name', ''); ?>" id="<?php echo getArrayDef($element, 'name', ''); ?>" 
                       style="<?php echo $itemstyle; ?>"  <?php echo $itemoptions; ?>
                       data-datestart="<?php echo $element['date-start']; ?>"
                       data-dateend="<?php echo $element['date-end']; ?>"
                       value="<?php echo getArrayDef($element, 'value'); ?>" />
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
            <script>
                if (typeof onload_functions !== 'undefined') {
                    onload_functions.push({'name': 'DateRangePicker',
                        'args': ["<?php echo getArrayDef($element, 'name', ''); ?>",
                            {"format": "<?php echo getArrayDef($element, 'format', 'DD-MM-YYYY'); ?>",
                                "default": "<?php echo getArrayDef($element, 'default', '@today'); ?>"
                            }]});
                }
            </script>
        </div>
    <?php } else if ($element['xtype'] == 'lookup') { //print_r($element); ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>" style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
            <select class="form-control <?php echo getArrayDef($element, 'class', ''); ?>" 
                    name="<?php echo getArrayDef($element, 'name', ''); ?>" id="<?php echo getArrayDef($element, 'name', ''); ?>"
                    data-lookup-paramlist="<?php echo getArrayDef($element, 'lookup-paramlist', ''); ?>"
                    data-lookup-refresh="<?php echo getArrayDef($element, 'lookup-refresh', ''); ?>"
                    data-lookup-name="<?php echo getArrayDef($element, 'lookupname', ''); ?>"
                    style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                    value="<?php echo getArrayDef($element, 'value'); ?>"
                    <?php echo getArrayDef($element, 'required'); ?>
                    >
                        <?php echo getArrayDef($element, 'lookup-data', ''); ?>
            </select>
        </div>

    <?php } else if ($element['xtype'] == 'lookup-disable') { //print_r($element); ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>" style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
            <select class="form-control <?php echo getArrayDef($element, 'class', ''); ?>" 
                    name="<?php echo getArrayDef($element, 'name', ''); ?>" 
                    id="<?php echo getArrayDef($element, 'name', ''); ?>"
                    data-lookup-paramlist="<?php echo getArrayDef($element, 'lookup-paramlist', ''); ?>"
                    data-lookup-refresh="<?php echo getArrayDef($element, 'lookup-refresh', ''); ?>"
                    data-lookup-name="<?php echo getArrayDef($element, 'lookupname', ''); ?>"
                    style="<?php echo $itemstyle; ?> background-color: #eee" <?php echo $itemoptions; ?>
                    value="<?php echo getArrayDef($element, 'value'); ?>" disabled >
                        <?php echo getArrayDef($element, 'lookup-data', ''); ?>
            </select>
        </div>

    <?php } else if ($element['xtype'] == 'lookup-search') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>"  style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
            <select class="form-control chosen-select <?php echo getArrayDef($element, 'class', ''); ?>" 
                    name="<?php echo getArrayDef($element, 'name', ''); ?>" id="<?php echo getArrayDef($element, 'name', ''); ?>"
                    data-lookup-params="<?php //echo getArrayDef($element, 'lookup-params', ''); ?>"
                    data-lookup-updates="<?php //echo getArrayDef($element, 'lookup-updates', ''); ?>"
                    style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                    value="<?php echo getArrayDef($element, 'value'); ?>">
                        <?php echo getArrayDef($element, 'lookup-data', ''); ?>
            </select>
        </div>
    <?php } else if ($element['xtype'] == 'lookup-multiple') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>"  style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
            <select multiple="" class="form-control xchosen-select tag-input-style <?php echo getArrayDef($element, 'class', ''); ?>" 
                    id="form-field-select-1" name="<?php echo getArrayDef($element, 'name', ''); ?>" id="<?php echo getArrayDef($element, 'name', ''); ?>"
                    data-lookup-params="<?php echo getArrayDef($element, 'lookup-params', ''); ?>"
                    data-lookup-updates="<?php echo getArrayDef($element, 'lookup-updates', ''); ?>"
                    style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                    value="<?php echo getArrayDef($element, 'value'); ?>">
                        <?php echo getArrayDef($element, 'lookup-data', ''); ?>
            </select>
        </div>
    <?php } else if ($element['xtype'] == 'checklistbox') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name'); ?>" style="<?php echo $labelstyle; ?>"> <?php echo getArrayDef($element, 'caption'); ?> </label>
            <div class="row checkbox-panel crud-group" id="<?php echo getArrayDef($element, 'name'); ?>"
                 name="<?php echo getArrayDef($element, 'name'); ?>" 
                 data-lookup-name="<?php echo getArrayDef($element, 'lookupname', ''); ?>"
                 data-lookup-paramlist="<?php echo getArrayDef($element, 'lookup-paramlist', ''); ?>"
                 >
                     <?php echo getArrayDef($element, 'lookup-data', ''); ?>
            </div>
            <div class="row">
                <div class="col-xs-12" style="margin-top:4px">
                    <button type="button" class=" btn btn-minier btn-yellow cbox_check_all" 
                            data-inputid="<?php echo getArrayDef($element, 'name'); ?>" >Check All</button>
                    <button type="button" class=" btn btn-minier btn-yellow cbox_check_none" 
                            data-inputid="<?php echo getArrayDef($element, 'name'); ?>" >Check None</button>
                </div>
            </div>


        </div>

    <?php } else if ($element['xtype'] == 'textarea') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>" style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
            <textarea class="form-control <?php echo getArrayDef($element, 'class', ''); ?>" 
                      id="<?php echo getArrayDef($element, 'name', ''); ?>" name="<?php echo getArrayDef($element, 'name', ''); ?>" 
                      style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                      ><?php echo getArrayDef($element, 'value', ''); ?></textarea>
        </div>
    <?php } else if ($element['xtype'] == 'textarea-disable') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>" style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
            <textarea class="form-control <?php echo getArrayDef($element, 'class', ''); ?>" 
                      id="<?php echo getArrayDef($element, 'name', ''); ?>" name="<?php echo getArrayDef($element, 'name', ''); ?>" 
                      style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                      disabled
                      ><?php echo getArrayDef($element, 'value', ''); ?></textarea>
        </div>
    <?php } else if ($element['xtype'] == 'textarea-auto') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>" style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
            <textarea class="form-control autosize-transition <?php echo getArrayDef($element, 'class', ''); ?>"
                      id="<?php echo getArrayDef($element, 'name', ''); ?>" name="<?php echo getArrayDef($element, 'name', ''); ?>" 
                      style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                      ><?php echo getArrayDef($element, 'value', ''); ?></textarea>
        </div>
    <?php } else if ($element['xtype'] == 'textarea-limited') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>" style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
            <textarea class="form-control autosize-transition <?php echo getArrayDef($element, 'class', ''); ?>" 
                      id="<?php echo getArrayDef($element, 'name', ''); ?>" name="<?php echo getArrayDef($element, 'name', ''); ?>" 
                      style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                      maxlength="<?php echo getArrayDef($element, 'maxlength', '50'); ?>"><?php echo getArrayDef($element, 'value', ''); ?></textarea>
        </div>
    <?php } else if ($element['xtype'] == 'checkbox') { ?>
        <div class="checkbox" style="<?php echo $invistyle; ?>">
            <label style="<?php echo $labelstyle; ?>">
                <input type="checkbox" class="ace <?php echo getArrayDef($element, 'class', ''); ?>" 
                       name="<?php echo getArrayDef($element, 'name', ''); ?>" id="<?php echo getArrayDef($element, 'name', ''); ?>" 
                       style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                       <?php echo get_checked_value(getArrayDef($element, 'value', '')); ?> />
                <span class="lbl"><?php echo getArrayDef($element, 'caption', ''); ?></span>
            </label>
        </div>
    <?php } else if ($element['xtype'] == 'checkbox-disable') { ?>
        <div class="checkbox" style="<?php echo $invistyle; ?>">
            <label style="margin-left: -10px; <?php echo $labelstyle; ?>">
                <input type="checkbox" class="ace <?php echo getArrayDef($element, 'class', ''); ?>" 
                       name="<?php echo getArrayDef($element, 'name', ''); ?>" id="<?php echo getArrayDef($element, 'name', ''); ?>" 
                       style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                       <?php echo get_checked_value(getArrayDef($element, 'value', '')); ?> 
                       disabled /> 
                <span class="lbl"> <?php echo getArrayDef($element, 'caption', ''); ?></span>
            </label>
        </div>
    <?php } else if ($element['xtype'] == 'label') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label><?php echo getArrayDef($element, 'caption', ''); ?></label>
        </div>
    <?php } else if ($element['xtype'] == 'html') { ?>
        <?php echo $element['html']; ?>
    <?php } else if ($element['xtype'] == 'button') { ?>
        <button class="btn <?php echo getArrayDef($element, 'style', ''); ?> btn-sm <?php echo getArrayDef($element, 'class', ''); ?>"
                style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                id="<?php echo getArrayDef($element, 'name'); ?>" >
            <i class="<?php echo getArrayDef($element, 'icon', 'cog'); ?> align-top bigger-100"></i>
            <?php echo getArrayDef($element, 'caption', ''); ?>
        </button>
    <?php } else if ($element['xtype'] == 'radio-group') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="form-field-radio" style="<?php echo $labelstyle; ?>">Radio Group</label>

            <div class="radio">
                <label>
                    <input name="form-field-radio" type="radio" class="ace <?php echo getArrayDef($element, 'class', ''); ?>" 
                           style="<?php echo $itemstyle; ?>"  <?php echo $itemoptions; ?> />
                    <span class="lbl"> radio option 1</span>
                </label>
            </div>

            <div class="radio">
                <label>
                    <input name="form-field-radio" type="radio" class="ace" 
                           style="<?php echo $itemstyle; ?>"  <?php echo $itemoptions; ?> />
                    <span class="lbl"> radio option 2</span>
                </label>
            </div>

            <div class="radio">
                <label>
                    <input name="form-field-radio" type="radio" class="ace" 
                           style="<?php echo $itemstyle; ?>"  <?php echo $itemoptions; ?> />
                    <span class="lbl"> radio option 3</span>
                </label>
            </div>

            <div class="radio">
                <label>
                    <input disabled="" name="form-field-radio" type="radio" class="ace" 
                           style="<?php echo $itemstyle; ?>"  <?php echo $itemoptions; ?> />
                    <span class="lbl"> disabled</span>
                </label>
            </div>
        </div>
    <?php } else if ($element['xtype'] == 'colorpicker') { ?>
        <div class="clearfix">
            <label for="colorpicker1" style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
        </div>
        <div class="input-group" style="padding:0px"></div>
        <div class="input-group input-append color" data-color="#<?php echo getArrayDef($element, 'value'); ?>" data-color-format="hex" id="cp1">
            <input type="text" class="span2 <?php echo getArrayDef($element, 'class', ''); ?>" 
                   name="<?php echo getArrayDef($element, 'name', ''); ?>" 
                   id="<?php echo getArrayDef($element, 'name', ''); ?>"
                   value="#<?php echo getArrayDef($element, 'value'); ?>"
                   style="width:100%; <?php echo $itemstyle; ?>" 
                   readonly
                   <?php echo $itemoptions; ?>
                   >
            <span class="input-group-addon add-on"><i style="background-color:  rgb(255, 146, 180);"></i></span>
        </div>
        <div></div>

    <?php } else if ($element['xtype'] == 'search') { ?>

        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>" style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
            <div class="input-group" style="padding:0px">
                <input class="form-control <?php echo getArrayDef($element, 'class', ''); ?>" type="text" 
                       name="<?php echo getArrayDef($element, 'name', ''); ?>" id="<?php echo getArrayDef($element, 'name', ''); ?>" 
                       style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                       <?php echo getArrayDef($element, 'required'); ?> 
                       value="<?php echo getArrayDef($element, 'value'); ?>" testing="xxx" />
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button" 
                            id="<?php echo getArrayDef($element, 'btn_name', 'btn_' . getArrayDef($element, 'name', 'x')); ?>">
                        <i class="ace-icon fa fa-search bigger-110"></i>
                        Search
                    </button>
                </span>
            </div>
        </div>


    <?php } else if ($element['xtype'] == 'addon') { ?>

        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>" style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
            <div class="input-group" style="padding:0px">
                <input class="form-control <?php echo getArrayDef($element, 'class', ''); ?>" type="text" 
                       name="<?php echo getArrayDef($element, 'name', ''); ?>" id="<?php echo getArrayDef($element, 'name', ''); ?>" 
                       style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                       <?php echo getArrayDef($element, 'required'); ?> 
                       value="<?php echo getArrayDef($element, 'value'); ?>" testing="xxx" />
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button" 
                            id="<?php echo getArrayDef($element, 'btn_name', 'xbtn_' . getArrayDef($element, 'name', 'x')); ?>">
                        <i class="ace-icon <?php echo getArrayDef($element, 'icon', 'fa fa-search'); ?> bigger-110"></i>
                        Search
                    </button>
                </span>
            </div>
        </div>


    <?php } else if ($element['xtype'] == 'heading') { ?>
        <<?php echo getArrayDef($element, 'headtype', 'h1'); ?> 
        class="<?php echo getArrayDef($element, 'class', ''); ?>" 
        style="<?php echo getArrayDef($element, 'style', ''); ?>" >
        <?php echo getArrayDef($element, 'caption'); ?>
        </<?php echo getArrayDef($element, 'headtype', 'h1'); ?>>
    <?php } else if ($element['xtype'] == 'xsearch') { ?>

        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', ''); ?>" style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
            <div class="input-group" style="padding:0px">
                <input class="form-control <?php echo getArrayDef($element, 'class', ''); ?>" type="text" 
                       name="<?php echo getArrayDef($element, 'name', ''); ?>" id="<?php echo getArrayDef($element, 'name', ''); ?>" 
                       style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                       <?php echo getArrayDef($element, 'required'); ?> 
                       value="<?php echo getArrayDef($element, 'value'); ?>" testing="xxx" />
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button" 
                            id="<?php echo getArrayDef($element, 'btn_name', 'btn_' . getArrayDef($element, 'name', 'x')); ?>">
                        <i class="ace-icon fa fa-search bigger-110"></i>
                        Search
                    </button>
                </span>
            </div>

        </div>
        <script>
            //OnReadyArray.push(function(){
            //debugger;
            $("#<?php echo getArrayDef($element, 'btn_name', 'btn_' . getArrayDef($element, 'name', 'x')); ?>").click(function () {
                //alert('fil_rvehicle_nopol');
                //console.log('fil_rvehicle_nopol');
                //debugger;
                console.log('<?php echo getArrayDef($element, 'btn_name', 'btn_' . getArrayDef($element, 'name', 'x')); ?>-click');
        //                        Manggu.Crud.updateLookup({
        //                                lookupName: 'ortuid',
        //                                baseClass: "crud-edit",
        //                                baseurl: '../crud/svlookup/'
        //                        });
            });

            //});
        </script>


    <?php } else if ($element['xtype'] == 'file') { ?>
        <label for="<?php echo getArrayDef($element, 'name', ''); ?>" style="<?php echo $labelstyle; ?>"><?php echo getArrayDef($element, 'caption', ''); ?></label>
        <div class="ace-file-input ace-file-multiple">
            <input multiple="" type="file" 
                   name="<?php echo getArrayDef($element, 'name', ''); ?>" 
                   id="<?php echo getArrayDef($element, 'name', ''); ?>"
                   class="manggu-file-input"
                   <?php echo getArrayDef($element, 'required'); ?>
                   />
        </div>
    <?php } else if ($element['xtype'] == 'xchecklistedit') { ?>
        asdf
        <?php echo getArrayDef($element, 'lookup-paramlist', '');
        die; ?>
    <?php } else if ($element['xtype'] == 'checklistedit') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name'); ?>" style="<?php echo $labelstyle; ?>"> <?php echo getArrayDef($element, 'caption'); ?> </label>
            <div class="row checkbox-panel crud-group" id="<?php echo getArrayDef($element, 'name'); ?>"
                 name="<?php echo getArrayDef($element, 'name'); ?>" 
                 data-lookup-name="<?php echo getArrayDef($element, 'lookupname', ''); ?>"
                 data-lookup-paramlist="<?php echo getArrayDef($element, 'lookup-paramlist', ''); ?>"
                 >
                     <?php echo getArrayDef($element, 'lookup-data', ''); ?>
            </div>
            <div class="row">
                <div class="col-xs-12" style="margin-top:4px">
                    <button type="button" class=" btn btn-minier btn-yellow cbox_check_all" 
                            data-inputid="<?php echo getArrayDef($element, 'name'); ?>" >Check All</button>
                    <button type="button" class=" btn btn-minier btn-yellow cbox_check_none" 
                            data-inputid="<?php echo getArrayDef($element, 'name'); ?>" >Check None</button>
                </div>
            </div>


        </div>

    <?php } else if ($element['xtype'] == 'attachment') { ?>

        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name'); ?>" style="<?php echo $labelstyle; ?>"> <?php echo getArrayDef($element, 'caption'); ?> </label>

            <div class="widget-box " style="margin-top: 0px; margin-bottom: 0px">
                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <div id="dialogcontainer" style="background-color:#eee" class="slim-scroll" data-height="<?php echo getArrayDef($element, 'height', '153'); ?>" >
                            <?php echo getArrayDef($element, 'attachment-data'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php } else if ($element['xtype'] == 'free-template') { ?>
        <?php echo getArrayDef($element, 'template_result'); ?>
    <?php } else if ($element['xtype'] == 'template') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name'); ?>" style="<?php echo $labelstyle; ?>"> <?php echo getArrayDef($element, 'caption'); ?> </label>

            <div class="widget-box " style="margin-top: 0px; margin-bottom: 0px">
                        <div style="background-color:#eee; padding: 4px;" class="slim-scroll" data-height="<?php echo getArrayDef($element, 'height', '92'); ?>" >
                            <?php echo getArrayDef($element, 'template_result'); ?>
                        </div>
            </div>
        </div>
    <?php } else if ($element['xtype'] == 'template-single') { ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name'); ?>" style="<?php echo $labelstyle; ?>"> <?php echo getArrayDef($element, 'caption'); ?> </label>

            <div class="widget-box " style="border-style:none; margin-top: 0px; margin-bottom: 0px">
                        <div class="form-control" style="border-width: 1px; background-color:#eee; padding: 4px;height: <?php echo getArrayDef($element, 'height', '34'); ?>px"  >
                            <?php echo getArrayDef($element, 'template_result'); ?>
                        </div>
            </div>
        </div>
    <?php } else if ($element['xtype'] == '') { ?>
    <?php } else if ($element['xtype'] == '') { ?>
    <?php } else if ($element['xtype'] == '') { ?>
    <?php } else if ($element['xtype'] == '') { ?>
    <?php } ?>
<?php } ?>
