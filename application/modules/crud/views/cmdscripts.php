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
<?php
    if ($namespace!==''){
        $xnamespace = rtrim($namespace, "_");
        $ajax_sv_name = 'svcallqueryview/'.$xnamespace;
        $ajax_cmd_name = 'commandcall/'.$xnamespace;
    } else {
        $ajax_sv_name = 'svqueryview';
        $ajax_cmd_name = 'command';
    }
    if(!isset($modal_url)){
        $modal_url = '';
    }
    if(!isset($modal_url)){
        $modal_url = '';
    }
?>
<script>
    control_cmd_script_flag = 0;
    console.log("action-script!!..");
    OnReadyArray.push(function(){
        Manggu.Crud.dispatch = function (config){
            Manggu.loadAjax({
                type: 'POST',
                url: config.url,
                data: config.data,
                onsuccess: function(data){
                    if (typeof data.redirect !=='undefined'){
                        if (data.linkreplace){
                            window.location.replace(data.redirect);
                        } else {
                            document.location.href = data.redirect;
                        }
                    } else {
                        if (typeof data.message !=='undefined'){
                            Manggu.showMessage(data.message);
                        }
                    }
                    
//                    for(idx in data){
//                        //console.log($('#'.idx));
//                        //console.log(data[idx]);
//                        //$('#'+idx).html(data[idx]);
//                    }
//                    for(idx in OnReadyArray){
//                        OnReadyArray[idx]();
//                    }
//                    OnReadyArray = [];
                },
                onerror: function(message){
                    Manggu.showMessage(message);
                }
            });
        }
        
        
//        console.log("action-script!! - 1");
        modalname = 'ajax-modalnormal';
        $('.<?php echo $namespace; ?>rowactionbutton').off('click');
        $('.<?php echo $namespace; ?>rowactionbutton').click(function(){
            //alert('testxxx');
debugger;
            var validated = true;
            if (typeof this.validation !== 'undefined'){
                try {
                    validated = this.validation();
                } catch (ex){
                    
                }
            }
            if (validated===true){
                console.log('*this*');
                console.log(this);
                console.log("action-script!! - 2");
    //            console.log(this);
                actionName = $(this).attr('data-action');
                modalWidth = $(this).attr('data-modalwidth');
                reloadAll = $(this).attr('data-reloadall');
                console.log("actionName: "+actionName);
                $('#'+modalname).off('hidden.bs.modal');
                $('#'+modalname).on('hidden.bs.modal', function () {
                    if ($('#'+modalname).attr('data-modalresult')==1){
                        //alert('modal result 1')
                        debugger;
                        if(reloadAll){
                            location.reload(true);
                        } else {
                            Manggu.Crud.loadData({'paramclass': '<?php echo $namespace; ?>crud-param', 
                                'namespace': '<?php echo $namespace; ?>',
                                'url': '<?php echo $crudurl.$ajax_sv_name.'/'.$crudname.'/'.$actionname;?>'
                            });
                        }

                    }
                    $('#'+modalname).empty();
                });


                data_idx = $(this).closest('tr').attr('data-index');
                data = <?php echo $namespace; ?>gridData[data_idx];
                if (data==null){
                    //data = {'test':'a'};
                    paramclass='<?php echo $namespace; ?>crud-param';
                    data = Manggu.Crud.getParamData(paramclass);
                    //data = $('#param-form').serializeArray();
                    console.log("data");
                    console.log(data);
                }
                link = $(this).attr('data-target');
                if(typeof link=='undefined'){
                    link = '';
                }
                if (link!==''){
                    baselink = '<?php echo $mainurl;?>';
                    vurl = baselink+link;
                } else {
                    vurl = '<?php echo $crudurl.$ajax_cmd_name.'/'.$crudname;?>'+'/'+actionName;
                }
                exec = $(this).attr('data-execute');
                if(typeof exec=='undefined'){
                    exec = 'showmodal';
                }
                var vconfig = {
                        width: modalWidth,
                        url: vurl,
                        data: data,
                        modalname: modalname
                    }
                if (exec=='showmodal'){
                    Manggu.Crud.showModal(vconfig);
                } else {
                    veval = exec+'(vconfig);';
                    eval(veval);
                }
                return true;
            } else {
                if (typeof validated == 'string'){
                    Manggu.showAlert(validated, 'error', 'warning');
                }
                return false;
            }
        });
        
    });

    OnReadyArray.push(function(){
        $('.<?php echo $namespace; ?>rowactionlink').click(function(){
            //alert('testxxxxx');
            data_idx = $(this).closest('tr').attr('data-index');
            if (typeof data_idx !== 'undefined'){
                data = gridData[data_idx];
            } else {
                data = {};
            }
            console.log(this);
            baselink = '<?php echo $mainurl;?>';
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
debugger;
            sparamlist = $(this).attr('data-paramlist');
            if (typeof sparamlist!=='undefined'){
                paramlist = $.parseJSON(sparamlist);
                if ((typeof paramlist=='undefined') || (paramlist===null)){
                    paramlist = {}
                }
                rparam = '';
                for (i=0; i<paramlist.length; i++){
                    x = paramlist[i];
                    if (rparam!==''){
                        rparam = rparam+'&';
                    }
                    var data_x;
                    if (typeof data[x]!=='undefined'){
                        data_x = data[x]
                    } else {
                        data_x = $('#<?php echo $namespace; ?>'+x).val();
                    }
                    rparam = rparam+x+'='+data_x;
                    //xparam[x] = data[x];
                }
                if (rparam!==''){
                    url = url+'?'+rparam;
                }
            }
            
            linkreplace = $(this).attr('data-link-replace');
            //alert(url);
            if(linkreplace==1){
                window.location.replace(url);
            } else if(linkreplace==2){
                window.open(url, '_blank');
            } else {
                linktarget = $(this).attr('data-link-target');
                if (typeof linktarget=='undefined'){
                    document.location.href = url;
                } else {
                    window.open(url,'_blank');
                }
            }
            no_need_return_just_exception;
            return true;
        })
    });

    OnReadyArray.push(function(){
        //console.log("action-script!! - xxx");
        //$('.rowactionbutton').html("Testing"+Math.random());
        //console.log($('#ajax-modalwider').find('.crudsearch'));
        //$('#crudsearch').html('XXX'+Math.random());
        //$('.testing123').html('XXX'+Math.random());

        $('.<?php echo $namespace; ?>rowactioncrud').click(function(){
            data_idx = $(this).closest('tr').attr('data-index');
            if (typeof data_idx !== 'undefined'){
                data = gridData[data_idx];
            } else {
                data = {};
            }
            console.log("*params*"+data);
            link = $(this).attr('data-target');
            sparamlist = $(this).attr('data-paramlist');
            paramlist = $.parseJSON(sparamlist);
            if ((typeof paramlist=='undefined') || (paramlist===null)){
                paramlist = {}
            }
            xparam = {};
            for (i=0; i<paramlist.length; i++){
                x = paramlist[i];
//                xparam[x] = data[x];
                    var data_x;
                    if (typeof data[x]!=='undefined'){
                        data_x = data[x]
                    } else {
                        data_x = $('#<?php echo $namespace; ?>'+x).val();
                    }
                    xparam[x] = data_x;
                    ids = data_x;
            }
            strparam = $.param(xparam);
            console.log(xparam);
            console.log(strparam);
            console.log(paramlist);
            url = '<?php echo $mainurl; ?>menu/'+link+'?'+strparam;
            console.log(url);
            linkreplace = $(this).attr('data-link-replace');
            //alert(url);
            if(ids==null){
                alert('ID Tidak Ditemukan!');
                return;
            }
            if(linkreplace==1 ){
                window.location.replace(url);
            } else {
                document.location.href = url;
            }
        });

        $(BaseSearch+'.rowactioncrudxx').click(function(){
            //alert('testx');
            DisplayMode = 'showmodal';
            console.log(this);
            actionName = $(this).attr('data-action');
            modalWidth = $(this).attr('data-modalwidth');
            link = $(this).attr('data-target');
            modalname = 'ajax-modalwider';
            BaseSearch = '#'+modalname+' ';
            console.log("actionName: "+actionName);
            data_idx = $(this).closest('tr').attr('data-index');
            data = gridData[data_idx];
            
            Manggu.Crud.showModal({
                width: modalWidth,
                url: '<?php echo $crudurl;?>index/'+link+'/',
                data: data,
                modalname: modalname
            });
               
           $('#'+modalname).on('hidden.bs.modal', function () {
               if ($('#'+modalname).attr('data-modalresult')==1){
                   //alert('modal result 1')
                    Manggu.Crud.loadData({'paramclass': 'crud-param',
                        'url': '<?php echo $crudurl.$ajax_sv_name.'/'.$crudname.'/'.$actionname;?>'
                    });
               }
            });
            
            
            return false;
        })
        
    });
    //alert('test');
    if(DisplayMode=='showmodal') {
        for(idx in OnReadyArray){
            OnReadyArray[idx]();
        }
        OnReadyArray = [];
        DisplayMode = 'normal';
        BaseSearch = DefaultBaseSearch;
    }
    
        

    
</script>