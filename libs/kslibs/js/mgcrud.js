/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var model = namespace('Manggu.Crud');
var modal_cache = {}

model.getParamData = function(paramclass){
    paramdata = {};
    $('.'+paramclass).each(function (index){
        name = $(this).attr('name');
        paramdata[name] = $(this).val();
        //paramdata.push($(this).val());
    });
    return paramdata;    
}

model.checkRequired = function(formname){
    $('#'+formname)[0].checkValidity();
//    paramdata = {};
//    $('.'+paramclass).each(function (index){
//        name = $(this).attr('name');
//        paramdata[name] = $(this).val();
//        $(this).checkValidity();
//        //paramdata.push($(this).val());
//    });
    return 'Error';    
}

model.loadData = function(config){
    paramclass = config.paramclass;
    ajaxurl = config.url;
    var paramdata = {};
    $('.'+paramclass).each(function (index){
        name = $(this).attr('name');
        paramdata[name] = $(this).val();
        //paramdata.push($(this).val());
    });
    console.log("paramdata");
    console.log(paramdata);
    Manggu.loadAjax({
        type: 'GET',
        url: ajaxurl,
        data: paramdata,
        onsuccess: function(data){
            for(idx in data){
                //console.log($('#'.idx));
                //console.log(data[idx]);
                $('#'+idx).html(data[idx]);
            }
            for(idx in OnReadyArray){
                OnReadyArray[idx]();
            }
            OnReadyArray = [];
            /***/
            if (typeof AfterLoadGrid !== 'undefined'){
                for(idx in AfterLoadGrid){
                    AfterLoadGrid[idx]();
                }
            }
        },
        onerror: function(message){
            Manggu.showMessage(message);
        }
    });
}


model.showModal = function(config){
    if (typeof config.width == "undefined"){
        width = '700';
    } else {
        width = config.width;
    }
    if (typeof config.modalname == "undefined"){
        modalname="ajax-modalnormal";
    } else {
        modalname = config.modalname;
    }
    if (typeof config.data == "undefined"){
        data = '';
    } else {
        data = config.data;
    }
    var modalobj = $('#'+modalname);
    var xmodalobj = $('#'+modalname+'-body');
    //console.log(modalobj);
    $(modalobj).attr('data-modalresult', 0);
    $(modalobj).attr('data-width', width);
    //console.log(modalobj);
//    $('body').modalmanager('loading');
    //console.log("data");
    //console.log(data);
    if (typeof config.url == 'undefined'){
        if (typeof config.modalname != 'undefined'){
            if (typeof modal_cache[config.modalname] == 'undefined'){
                modal_cache[config.modalname] = $('#'+config.modalname).html();
                $('#'+config.modalname).html('');
                $('#'+config.modalname).html(modal_cache[config.modalname]);
            } else {
                $('#'+config.modalname).html('');
                $('#'+config.modalname).html(modal_cache[config.modalname]);
            }
            if (typeof config.onload != 'undefined'){
                config.onload();
            }
            $('#'+config.modalname).modal();
        }
    } else {
        modalobj.load(config.url, data, function(){
            console.log($(modalobj).find(".modal-header").attr('data-width'));
            //console.log($(modalobj).find(".modal-header"));
            //console.log(modalobj);
            modalobj.modal();
        });
    }
}

model.showModalx = function(config){
    if (typeof config.width == "undefined"){
        width = '700';
    } else {
        width = config.width;
    }
    if (typeof config.modalname == "undefined"){
        modalname="ajax-modalnormal";
    } else {
        modalname = config.modalname;
    }
    if (typeof config.data == "undefined"){
        data = '';
    } else {
        data = config.data;
    }
    var modalobj = $('#'+modalname);
    //console.log(modalobj);
    $(modalobj).attr('data-modalresult', 0);
    $(modalobj).attr('data-width', width);
    //console.log(modalobj);
    $('body').modalmanager('loading');
    //console.log("data");
    //console.log(data);
    modalobj.load(config.url, data, function(){
        console.log($(modalobj).find(".modal-header").attr('data-width'));
        //console.log($(modalobj).find(".modal-header"));
        //console.log(modalobj);
        modalobj.modal();
    });
}

model.execData = function(config){
    try {
        debugger;
        paramclass = config.paramclass;
        ajaxurl = config.url;
        //var paramdata = {};
        var paramdata = new FormData();
        $('.'+paramclass).each(function (index){
            //console.log(this);
            name = $(this).attr('name');
            //paramdata[name] = $(this).val();
            paramdata.append(name, $(this).val());
            //paramdata.push($(this).val());
        });
        if (typeof config.groupClass!=='undefined'){
            //alert($('.'+config.groupClass).length);
            $('.'+config.groupClass).each(function (index){
                //console.log(this);
            console.log("***");
            console.log(this);
                name = $(this).attr('name');
                //alert(name);
                //paramdata[name] = Manggu.Crud.getGroupValueList(name);
                paramdata.append(name, Manggu.Crud.getGroupValueList(name));
                //paramdata.push($(this).val());
            });
        }
        if (typeof config.filedata !=='undefined'){
            var vname='';
            $.each(config.filedata, function(key, value){
                $.each(value, function(xkey, xvalue){
                    if(xkey!==0){
                        vname = key+''+xkey;
                    } else {
                        vname = key+'';
                    }
                    paramdata.append(vname, xvalue);
                });
                //paramdata[key] = value;
            });
        }

        console.log(paramdata);
        var xx = paramdata;
        //try{
            Manggu.loadAjax({
                type: 'POST',
                url: ajaxurl,
                dataType: 'json',
                data: xx,
                cache: false,
                processData: false,
                contentType: false,
                onsuccess: config.onsuccess,
                onerror: config.onerror
            });

    //    } catch (err){
    //        console.log('error');
    //        console.log(err)
    //    }

    } catch (err){
        console.log('error');
        console.log(err);
    }

}

model.updateLookup = function(config){
    //return;
    if (typeof config.prefixName=='undefined'){
        prefixName = '';
    } else {
        prefixName = config.prefixName;
    }
    if (typeof config.paramClass=='undefined'){
        paramClass = config.baseClass;
    } else {
        paramClass = config.paramClass;
    }
    luname = config.lookupName;
    selector = '.'+config.baseClass+'#'+luname;
    if ($(selector).length>0){
        lookupname = $(selector).attr('data-lookup-name');
        luparamlist = $(selector).attr('data-lookup-paramlist');
        if (typeof luparamlist!=='undefined'){
            luparamlist = luparamlist.split(',');
        } else {
            luparamlist = [];
        }
        
        paramdata = {}
        for (var i=0; i<luparamlist.length; i++){
            parname = luparamlist[i];
            parselector = '.'+paramClass+'#'+parname;
            paramdata[parname] = $(parselector).val();
        }
        ajaxurl = config.baseurl+lookupname;
        Manggu.loadAjax({
            lookupvarname: luname,
            lookupname: lookupname,
            baseclass: config.baseClass,
            type: 'GET',
            url: ajaxurl,
            data: paramdata,
            onsuccess: function(data){
                luname = this.lookupvarname;
                baseclass = this.baseclass;
                selector = '.'+baseclass+'#'+prefixName+luname;
                $(selector).html(data['view']);
                $(selector).change();
            },
            onerror: function(message){
                Manggu.showMessage(message);
            }
        });
    }
}


model.checkBoxAll = function(inputid, mode){
    //mode :all, none, toggle
    
    selector = '.crud-group#'+inputid+' :checkbox';
    console.log(selector);
    console.log($(selector).length);
    $(selector).each(function(index){
        if(mode=='all'){
            //all
            $(this).prop('checked', true);
        } else if (mode=='toggle'){
            //toggle
            $(this).prop('checked', !this.checked);
        } else {
            //none
            $(this).prop('checked', false);
        }
        if(typeof this.doclick!=='undefined'){
            this.doclick();
        }
        //$(this).click();
        //name = $(this).attr('data-cboxid');

        //console.log(name);
        //paramdata[name] = $(this).val();
    });
    console.log(inputid);
    
    
}

model.getGroupValueList = function(inputid){
    result = '';
    selector = '.crud-group#'+inputid+' :checkbox';
    console.log(selector);
    console.log($(selector).length);
    $(selector).each(function(index){
        if (this.checked){
            if (result!==''){
                result = result+',';
            }
            haschild = $(this).attr('data-haschild');
            if((typeof haschild == 'undefined') || (haschild==null)){
                vresult = $(this).attr('data-cboxid');
            } else {
                vid = $(this).attr('data-cboxid');
                vresult = vid;
                $('#form-field-checkbox-child-'+vid).children().each(function(index){
                    vresult = vresult+'|'+$(this).val();
                });
                //$(this).attr('data-cboxid');
            }
            result = result+vresult;
        }
    });
    console.log(result);
    debugger;
    //throw new Error("Something went badly wrong!");
    return result;
}