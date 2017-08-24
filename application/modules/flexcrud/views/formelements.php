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
    foreach($arrelements as $element){
        //var_dump($element);

        if (!isset($element['xtype'])){
            $element['xtype'] = 'text';
        }
        if (getArrayDef($element, 'visible', '1')=='0'){
            $invistyle = 'display:none'; 
        } else {
            $invistyle = '';
        }
        
        $itemstyle = getArrayDef($element, 'style', '');
        $groupstyle = getArrayDef($element, 'groupstyle', '');
        $labelstyle = getArrayDef($element, 'labelstyle', '');
        
        $itemoptions = getArrayDef($element, 'options', '');
        $groupoptions = getArrayDef($element, 'groupoptions', '');
        $labeloptions = getArrayDef($element, 'groupoptions', '');
        
?>
<?php   if($element['xtype']=='row'){ ?>
<div class="<?php echo getArrayDef($element, 'class', 'row');?>" style="<?php echo $invistyle; ?>">
<?php   } else if($element['xtype']=='/row'){ ?>
</div>
<?php   } else if($element['xtype']=='column'){ ?>
    <div class="<?php echo getArrayDef($element, 'class', '');?>" style="<?php echo $invistyle; ?>">
<?php   } else if($element['xtype']=='/column'){ ?>
    </div>
<?php   } else if($element['xtype']=='text'){ ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name');?>"> <?php echo getArrayDef($element, 'caption');?> </label>
            <input type="text" class="edit-control <?php echo getArrayDef($element, 'class', '');?>" placeholder="<?php echo getArrayDef($element, 'placeholder', '')?>" 
                name="<?php echo getArrayDef($element, 'name');?>" id="<?php echo getArrayDef($element, 'name');?>"
                style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                value="<?php echo getArrayDef($element, 'value');?>" />
        </div>
<?php   } else if($element['xtype']=='text-disable'){ ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name');?>"> <?php echo getArrayDef($element, 'caption');?> </label>
            <input type="text" class="edit-control <?php echo getArrayDef($element, 'class', '');?>" placeholder="<?php echo getArrayDef($element, 'placeholder', '')?>" 
                name="<?php echo getArrayDef($element, 'name');?>" id="<?php echo getArrayDef($element, 'name');?>"
                style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                value="<?php echo getArrayDef($element, 'value');?>" disabled />
        </div>
<?php   } else if($element['xtype']=='hidden'){ ?>
        <input type="hidden" class="edit-control <?php echo getArrayDef($element, 'class', '');?>" placeholder="<?php echo getArrayDef($element, 'placeholder', '')?>" 
            name="<?php echo getArrayDef($element, 'name');?>" id="<?php echo getArrayDef($element, 'name');?>"
            style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
            value="<?php echo getArrayDef($element, 'value');?>" />
<?php   } else if($element['xtype']=='password'){ ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', '');?>"> <?php echo getArrayDef($element, 'caption', '...');?> </label>
            <input type="password" class="edit-control <?php echo getArrayDef($element, 'class', '');?>" placeholder="<?php echo getArrayDef($element, 'placeholder', '')?>" 
                name="<?php echo getArrayDef($element, 'name', '');?>" id="<?php echo getArrayDef($element, 'name', '');?>"
                style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                value="<?php echo getArrayDef($element, 'value');?>" />
        </div>
<?php   } else if($element['xtype']=='date'){ ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', '');?>"><?php echo getArrayDef($element, 'caption', '');?></label>
            <div class="input-group" style="padding:0px">
                <input class="edit-control date-picker <?php echo getArrayDef($element, 'class', '');?>" type="text" 
                    data-date-format="<?php echo getArrayDef($element, 'dateformat', 'dd-mm-yyyy');?>" 
                    name="<?php echo getArrayDef($element, 'name', '');?>" id="<?php echo getArrayDef($element, 'name', '');?>" 
                    style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                    value="<?php echo getArrayDef($element, 'value');?>" />
                <span class="input-group-addon">
                        <i class="icon-calendar bigger-110"></i>
                </span>
            </div>
        </div>
<?php   } else if($element['xtype']=='date-range'){ ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', '');?>"><?php echo getArrayDef($element, 'caption', '');?></label>
            <div class="input-group" style="padding:0px">
                <input class="edit-control date-range-picker " type="text" 
                    data-date-format="<?php echo getArrayDef($element, 'dateformat', 'dd-mm-yyyy');?>" 
                    name="<?php echo getArrayDef($element, 'name', '');?>" id="<?php echo getArrayDef($element, 'name', '');?>" 
                    style="<?php echo $itemstyle; ?>"  <?php echo $itemoptions; ?>
                    data-datestart="<?php echo $element['date-start']; ?>"
                    data-dateend="<?php echo $element['date-end']; ?>"
                    value="<?php echo getArrayDef($element, 'value');?>" />
                <span class="input-group-addon">
                        <i class="icon-calendar bigger-110"></i>
                </span>
            </div>
            <script>
                if (typeof onload_functions !=='undefined'){
                    onload_functions.push({'name': 'DateRangePicker', 
                        'args': ["<?php echo getArrayDef($element, 'name', '');?>",
                        { "format": "<?php echo getArrayDef($element, 'format', 'DD-MM-YYYY');?>",
                          "default": "<?php echo getArrayDef($element, 'default', '@today');?>"
                        }]});
                }
            </script>
        </div>
<?php   } else if($element['xtype']=='lookup'){ //print_r($element);?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', '');?>"><?php echo getArrayDef($element, 'caption', '');?></label>
            <select class="edit-control <?php echo getArrayDef($element, 'class', '');?>" 
                name="<?php echo getArrayDef($element, 'name', '');?>" id="<?php echo getArrayDef($element, 'name', '');?>"
                data-lookup-paramlist="<?php echo getArrayDef($element, 'lookup-paramlist', '');?>"
                data-lookup-refresh="<?php echo getArrayDef($element, 'lookup-refresh', '');?>"
                data-lookup-name="<?php echo getArrayDef($element, 'lookupname', '');?>"
                style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                value="<?php echo getArrayDef($element, 'value');?>">
                <?php echo getArrayDef($element, 'lookup-data', ''); ?>
            </select>
        </div>
        
<?php   } else if($element['xtype']=='lookup-search'){ ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', '');?>" ><?php echo getArrayDef($element, 'caption', '');?></label>
            <select class="edit-control xchosen-select <?php echo getArrayDef($element, 'class', '');?>" 
                name="<?php echo getArrayDef($element, 'name', '');?>" id="<?php echo getArrayDef($element, 'name', '');?>"
                data-lookup-params="<?php echo getArrayDef($element, 'lookup-params', '');?>"
                data-lookup-updates="<?php echo getArrayDef($element, 'lookup-updates', '');?>"
                style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                value="<?php echo getArrayDef($element, 'value');?>">
                <?php echo getArrayDef($element, 'lookup-data', ''); ?>
            </select>
        </div>
<?php   } else if($element['xtype']=='lookup-multiple'){ ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', '');?>" ><?php echo getArrayDef($element, 'caption', '');?></label>
            <select multiple="" class="edit-control xchosen-select tag-input-style <?php echo getArrayDef($element, 'class', '');?>" 
                id="form-field-select-1" name="<?php echo getArrayDef($element, 'name', '');?>" id="<?php echo getArrayDef($element, 'name', '');?>"
                data-lookup-params="<?php echo getArrayDef($element, 'lookup-params', '');?>"
                data-lookup-updates="<?php echo getArrayDef($element, 'lookup-updates', '');?>"
                style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                value="<?php echo getArrayDef($element, 'value');?>">
                <?php echo getArrayDef($element, 'lookup-data', ''); ?>
            </select>
        </div>
<?php   } else if($element['xtype']=='checklistbox'){ ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name');?>"> <?php echo getArrayDef($element, 'caption');?> </label>
            <div class="row checkbox-panel crud-group" id="<?php echo getArrayDef($element, 'name');?>"
                 name="<?php echo getArrayDef($element, 'name');?>" 
                 data-lookup-name="<?php echo getArrayDef($element, 'lookupname', '');?>"
                 data-lookup-paramlist="<?php echo getArrayDef($element, 'lookup-paramlist', '');?>"
                 >
                <?php echo getArrayDef($element, 'lookup-data', ''); ?>
            </div>
            <div class="row">
                <div class="col-xs-3" style="margin-top:4px">
                    <button class=" btn btn-minier btn-yellow cbox_check_all" 
                            data-inputid="<?php echo getArrayDef($element, 'name');?>" >Check All</button>
                    <button class=" btn btn-minier btn-yellow cbox_check_none" 
                            data-inputid="<?php echo getArrayDef($element, 'name');?>" >Check None</button>
                </div>
            </div>

            
        </div>
        
<?php   } else if($element['xtype']=='textarea'){ ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', '');?>"><?php echo getArrayDef($element, 'caption', '');?></label>
            <textarea class="edit-control <?php echo getArrayDef($element, 'class', '');?>" 
                id="<?php echo getArrayDef($element, 'name', '');?>" name="<?php echo getArrayDef($element, 'name', '');?>" 
                style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                ><?php echo getArrayDef($element, 'value', '');?></textarea>
        </div>
<?php   } else if($element['xtype']=='textarea-auto'){ ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', '');?>"><?php echo getArrayDef($element, 'caption', '');?></label>
            <textarea class="edit-control autosize-transition <?php echo getArrayDef($element, 'class', '');?>"
                id="<?php echo getArrayDef($element, 'name', '');?>" name="<?php echo getArrayDef($element, 'name', '');?>" 
                style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                ><?php echo getArrayDef($element, 'value', '');?></textarea>
        </div>
<?php   } else if($element['xtype']=='textarea-limited'){ ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="<?php echo getArrayDef($element, 'name', '');?>"><?php echo getArrayDef($element, 'caption', '');?></label>
            <textarea class="edit-control autosize-transition <?php echo getArrayDef($element, 'class', '');?>" 
                id="<?php echo getArrayDef($element, 'name', '');?>" name="<?php echo getArrayDef($element, 'name', '');?>" 
                style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                maxlength="<?php echo getArrayDef($element, 'caption', '50');?>"><?php echo getArrayDef($element, 'value', '');?></textarea>
        </div>
<?php   } else if($element['xtype']=='checkbox'){ ?>
        <div class="checkbox" style="<?php echo $invistyle; ?>">
            <label>
                <input type="checkbox" class="ace <?php echo getArrayDef($element, 'class', '');?>" 
                    name="<?php echo getArrayDef($element, 'name', '');?>" id="<?php echo getArrayDef($element, 'name', '');?>" 
                    style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
                    <?php echo get_checked_value(getArrayDef($element, 'value', ''));?> />
                <span class="lbl"><?php echo getArrayDef($element, 'caption', '');?></span>
            </label>
        </div>
<?php   } else if($element['xtype']=='label'){ ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label><?php echo getArrayDef($element, 'caption', '');?></label>
        </div>
<?php   } else if($element['xtype']=='html'){ ?>
        <?php echo $element['html']; ?>
<?php   } else if($element['xtype']=='button'){ ?>
        <button class="btn <?php echo get_button_type(getArrayDef($element, 'style', ''));?> btn-sm <?php echo getArrayDef($element, 'class', '');?>"
            style="<?php echo $itemstyle; ?>" <?php echo $itemoptions; ?>
            id="<?php echo getArrayDef($element, 'name');?>" >
            <i class="icon-<?php echo getArrayDef($element, 'icon', 'cog');?> align-top bigger-100"></i>
            <?php echo getArrayDef($element, 'caption', '');?>
        </button>
<?php   } else if($element['xtype']=='radio-group'){ ?>
        <div class="edit-group" style="<?php echo $invistyle; ?>">
            <label for="form-field-radio">Radio Group</label>

            <div class="radio">
                <label>
                    <input name="form-field-radio" type="radio" class="ace <?php echo getArrayDef($element, 'class', '');?>" 
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
<?php   } else if($element['xtype']==''){ ?>
<?php   } else if($element['xtype']==''){ ?>
<?php   } else if($element['xtype']==''){ ?>
<?php   } else if($element['xtype']==''){ ?>
<?php   } ?>
<?php } ?>
