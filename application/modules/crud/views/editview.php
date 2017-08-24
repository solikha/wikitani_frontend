<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
if(!isset($ismodal)){
    $ismodal = true;
}

if(!isset($execurl)){
    $execurl = $crudurl . 'svexecdata/' . $crudname . '/' . $actionname;
}

?>
<style>
    div#color_selector 
{
   z-index: 1120; 
}
.colorpicker {
    z-index: 1220; 
}
    .pagination {
        margin-top: 5px;
        margin-bottom: 10px;
    }
    .table{
        margin-bottom: 14px;
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
    .modal {
        padding-left: 30px;
        padding-right: 30px;
        padding-top: 10px;
        padding-bottom: 20px;
    }
    .error {
        color: red;
    }
</style>
<div class="page-header">
    <h1><?php echo $crudtitle; ?></h1>
</div>

<?php if ($crudmessage!=='') { ?>
<div>
    <h4><?php echo $crudmessage; ?></h4>
</div>
<?php } ?>
<form id="edit-form" >
<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px">
    <div class="col-xs-12 col-sm-12">
        <?php echo $crudparams; ?>
    </div>                                                                    
</div>
<div class="row" style="">
    <div class="pull-left command-container" >
        <?php if ($readonly===1){ ?>
            <button data-dismiss="modal" id="canceledit" class="btn btn-default btn-sm" style="margin-top:20px;">Cancel</button>
        <?php } else { ?>
            <?php if (isset($submitactions)){ ?>
            <div style="margin-top:20px;">
            <?php echo $submitactions; ?>
            </div>
            <?php } else { ?>
            <button data-dismiss="modal" id="canceledit" class="btn btn-default btn-sm" style="margin-top:20px;">Cancel</button>
            <button id="crudexecute" class="btn btn-info btn-sm crudexecute" style="margin-top:20px;">OK</button>
            <?php } ?>
        <?php } ?>
            <div id="hidden-button" style="float: left;margin-right: 3px"></div>
    </div>                                                                    
</div>
</form>
<script>
    var validationRules = {};
    
    <?php if(isset($scriptdata)) {
        echo $scriptdata;
    }
    ?>
    // percobaan
</script>

<script> 
    // Start check is modal
    <?php if(!$ismodal){ ?>
    OnReadyArray.push(function(){
    <?php } ?>
    var files = {};
    
    // Add events
    $('input[type=file]').on('change', prepareUpload);

    // Grab the files and set them to our variable
    function prepareUpload(event)
    {
        files[event.target.name] = event.target.files;
        debugger;
    }
    debugger;
    $.validator.setDefaults({
        submitHandler: function() {
            
        debugger;
    //event.stopPropagation(); // Stop stuff happening
    //event.preventDefault(); // Totally stop stuff happening
        Manggu.Crud.execData({'paramclass': 'crud-edit',
                filedata: files,
                groupClass: "crud-group",
                'url': '<?php echo $execurl; ?>',
                onsuccess: function(data){
                    if (typeof data['isclose']=='undefined'){
                        data['isclose'] = true;
                    }
                    if(data['isclose']){
                        //alert('sukses');
                        $('#ajax-modalnormal').attr('data-modalresult', 1);
                        $('#ajax-modalnormal').modal('hide');
                        if (typeof data['islink']!='undefined'){
                            if (data['islink']==1){
                                if (typeof data['params']!=='undefined') {
                                    url = '<?php echo $mainurl; ?>'+data['link']+'?'+data['params'];
                                } else {
                                    url = '<?php echo $mainurl; ?>'+data['link'];
                                }
                                window.location.href = url;
                                //alert(url);
                                console.log(url);
                            }
                        }
                    } else {
                        //$('#ajax-modalnormal').attr('data-modalresult', 1);
                        //vurl = 'http://localhost/siap24/index.php/process/test';
                        vurl = '<?php echo $mainurl; ?>'+data['url'];
                        modalWidth = 200;
                        data = {}
                        modalname = 'ajax-modalnormal';
                        Manggu.Crud.showModal({
                            width: modalWidth,
                            url: vurl,
                            data: data,
                            modalname: modalname
                        });

                        
                        
                    }
                },
                onerror: function(message){
                    Manggu.showAlert(message, 'Update Error', 'warning');
                    //alert(message);
                }
            });
            //alert("submitted!");
        }
    });
    
    validate_option = {
        rules: validationRules
    };
    //validate_option['rules'] = validationRules;
    $("#edit-form").validate(validate_option);    
    
    $('#testing').click(function(event){
        console.log("testing");
        //event.preventDefault();
        //$('#confirmpassword').setCustomValidity("Testing");
        //var validator = $( "#edit-form" ).validate();
        //validator.form();        
        
    });
    
        $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });
        
        $('#cp1').colorpicker({
            format: 'hex'
        });
    
    
    
//alert('xxxxx');
//$('.date-picker').each(function(){
//    console.log('pck-xxx');
//});
////alert('xxx');
//        $('.date-picker').datepicker({
//            //autoclose:false,
//            beforeShow: function() { 
//                alert("1234");
//                $('.datepicker').css("z-index", 1051); 
//            }
//        }).next().on(ace.click_event, function(){
//            //alert("xxxxx");
//            $(this).prev().focus();
//        });
    
    
    
    //OnReadyArray.push(function(){
//        console.log("edit-view");
//        $('.crudexecute').click(function(){
//            return;
//            //checkRequired = Manggu.Crud.checkRequired('edit-form');
//            if (checkRequired===True){
//                Manggu.Crud.execData({'paramclass': 'crud-edit',
//                    groupClass: "crud-group",
//                    'url': '<?php echo $crudurl.'svexecdata/'.$crudname.'/'.$actionname;?>',
//                    onsuccess: function(data){
//                        //alert('sukses');
//                        $('#ajax-modalnormal').attr('data-modalresult', 1);
//                        $('#ajax-modalnormal').modal('hide');
//                        if (typeof data['islink']!='undefined'){
//                            if (data['islink']==1){
//                                url = '<?php echo $mainurl; ?>'+data['link']+'?'+data['params'];
//                                window.location.href = url;
//                                //alert(url);
//                                console.log(url);
//                            }
//                        }
//    //                    Manggu.Crud.loadData({'paramclass': 'crud-param',
//    //                        'url': '<?php echo $crudurl.'svqueryview/'.$crudname.'/browse';?>'
//    //                    });
//                    },
//                    onerror: function(message){
//                        alert(message);
//                    }
//                });
//            } else {
//                alert(checkRequired);
//            }
//            //alert('test');
//            console.log(this);
//            //console.log($(this));
//            //alert(namespace('test'));
//            return false;
//        })
//    //});
//    
    
    console.log('testing');
    console.log($('.lookup-refresh').length);
        $('.lookup-refresh').change(function(){
        //alert('test');
            //console.log(this);
            //console.log($(this).attr('data-lookup-refresh'));
            basurl = '<?php echo $crudurl.'svlookup/'?>';
            cburl = '<?php echo $crudurl.'svcblookup/'?>';
            list = $(this).attr('data-lookup-refresh').split(',');
            console.log(list);
            for (var i=0; i<list.length; i++){
                //alert('test'+i);
                //console.log(list[idx]);
                //console.log('xxx');
                //console.log(list[i]);
                Manggu.Crud.updateLookup({
                    lookupName: list[i],
                    baseClass: "crud-edit",
                    baseurl: basurl
                });
                Manggu.Crud.updateLookup({
                    lookupName: list[i],
                    baseClass: "crud-group",
                    paramClass: "crud-edit",
                    baseurl: cburl
                });
                //x = 'test1, test2, test3';
                //console.log((x.split(', ')));
                
            }
        });
    
    $('.cbox_check_all').click(function(){
        console.log(this);
        inputid = $(this).attr('data-inputid');
        Manggu.Crud.checkBoxAll(inputid, 'all');
    });
    
    $('.cbox_check_none').click(function(){
        console.log(this);
        inputid = $(this).attr('data-inputid');
        Manggu.Crud.checkBoxAll(inputid, 'none');
    });
    
    $('.cbox_check_toggle').click(function(){
        console.log(this);
        inputid = $(this).attr('data-inputid');
        Manggu.Crud.checkBoxAll(inputid, 'toggle');
    });
    
    console.log("check-chosen");
    $('.chosen-select').each(function(){
        console.log("xxx--1");
    });
    console.log($('.chosen-select'));
    
    $('.chosen-select').chosen({allow_single_deselect:true});

    var myClickFunction = function(){
        console.log(this);
        var target = $(this).attr('data-check-target');
        if (target){
            if(this.checked){
                $(target).show();
            } else {
                $(target).hide();
            }
        }
    }
    
    $('.cbox_check_item').each(function(){
        this.doclick = myClickFunction;
    });

    $('.cbox_check_item').click(myClickFunction);
    
    
$('.<?php echo $namespace; ?>rowactionlink').click(function(){
            //alert('test');
            console.log(this);
            baselink = '<?php echo $mainurl;?>';
            console.log(baselink);
            link = $(this).attr('data-target');
            //alert(link.indexOf('http:'));
            if (link.indexOf('http:')<0){
                //alert(url);
                if (link.indexOf('javascript')<0){
                    url = baselink+link;
                } else {
                    url = link;
                    //alert(url);
                }
            } else {
                url = link;
            }

            sparamlist = $(this).attr('data-paramlist');
            paramlist = $.parseJSON(sparamlist);
            xparam = {};
            for (i=0; i<paramlist.length; i++){
                x = paramlist[i];
                xparam[x] = data[x];
            }
            strparam = $.param(xparam);
            url = url+'?'+strparam;
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
        });    
    
    <?php if(!$ismodal){ ?>
    });
    <?php } ?>
    // End check is modal
    
    debugger;
    $('.manggu-file-input').ace_file_input({
        style:'well',
        btn_choose:'Drop files here or click to choose',
        btn_change:null,
        no_icon:'ace-icon fa fa-cloud-upload',
        droppable:true,
        maxFilesize: 8,
        thumbnail:'small'//large | fit
        //,icon_remove:null//set null, to hide remove/reset button
        /**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
        /**,before_remove : function() {
						return true;
					}*/
        ,
        preview_error : function(filename, error_code) {
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            alert(error_code);
        }
        
    }).on('change', function(){
        //console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });
//    var baseurl = '<?php echo $crudurl.'svlookup/'?>';
//    var lookupname = $(this).data('data-lookupname');
//    var dataSource = new Bloodhound({
//        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
//        queryTokenizer: Bloodhound.tokenizers.whitespace,
//        remote: {
//            xxurl: baseurl+lookupname+'?query=%QUERY',
//          url: 'https://twitter.github.io/typeahead.js/data/films/queries/%QUERY.json',
//          wildcard: '%QUERY'
//        }
//    });

    $('input.typeahead').each(function() {
        debugger;
        var baseurl = '<?php echo $crudurl.'bhoundlookup/'?>';
        var lookupname = $(this).data('lookupname');
        var emptymsg = $(this).data('emptymsg');
        if(typeof emptymsg=='undefined'){
            emptymsg = 'Data tidak diketemukan.'
        }
        var dataSource = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            limit: 10,
            remote: {
                url: baseurl+lookupname+'?query=%QUERY',
              xxurl: 'https://twitter.github.io/typeahead.js/data/films/queries/%QUERY.json',
              wildcard: '%QUERY'
            }
        });
        
        
        
        $(this).typeahead(null, {
            name: 'th-name',
            display: 'id',
            templates: {
                empty: [
                  '<div class="empty-message">',
                    emptymsg,
                  '</div>'
                ].join('\n'),
                suggestion: function(data) {
                    return '<p>'+ data.description+ '</p>';
                }
              },
            source: dataSource
        });
        //$(this).bind('')
    });
            
//    $('input.typeahead').typeahead(null, {
//            name: 'th-name',
//            display: 'value',
//            source: dataSource
//        });
    

    
    
</script>    