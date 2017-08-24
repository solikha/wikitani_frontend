/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var model = namespace('Manggu.Crud');

model.loadData = function(config){
    paramclass = config.paramclass;
    ajaxurl = config.url;
    var paramdata = {};
    $('.'+paramclass).each(function (index){
        name = $(this).attr('name');
        paramdata[name] = $(this).val();
        //paramdata.push($(this).val());
    });
    //console.log(paramdata);
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
            
        },
        onerror: function(message){
            alert(message);
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
    paramclass = config.paramclass;
    ajaxurl = config.url;
    var paramdata = {};
    $('.'+paramclass).each(function (index){
        //console.log(this);
        name = $(this).attr('name');
        paramdata[name] = $(this).val();
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
            paramdata[name] = Manggu.Crud.getGroupValueList(name);
            //paramdata.push($(this).val());
        });
    }
    
    console.log(paramdata);
    Manggu.loadAjax({
        type: 'POST',
        url: ajaxurl,
        data: paramdata,
        onsuccess: config.onsuccess,
        onerror: config.onerror
    });
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
                alert(message);
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

            result = result+$(this).attr('data-cboxid');
        }
    });
    console.log(result);
    return result;
}