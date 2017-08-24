/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function namespace(namespaceString) {
    var parts = namespaceString.split('.'),
        parent = window,
        currentPart = '';    
        
    for(var i = 0, length = parts.length; i < length; i++) {
        currentPart = parts[i];
        parent[currentPart] = parent[currentPart] || {};
        parent = parent[currentPart];
    }
    
    return parent;
}

//Array.prototype.unique = function() {
//    var a = this.concat();
//    for(var i=0; i<a.length; ++i) {
//        for(var j=i+1; j<a.length; ++j) {
//            if(a[i] === a[j])
//                a.splice(j--, 1);
//        }
//    }
//
//    return a;
//};

model = namespace('Manggu');

model.merge = function(obj1, obj2){
    var obj3 = {};
    for (var attrname in obj1) { obj3[attrname] = obj1[attrname]; }
    for (var attrname in obj2) { obj3[attrname] = obj2[attrname]; }
    return obj3;
}

model.showAlert = function(message){
    alert("[ "+message+' ]');
}

model.showMessage = function(message){
    alert("[ "+message+' ]');
}

model.findItemArray = function(varray, vfunc){
    for(var idx=0; idx<varray.length; idx++){
        var vitem = varray[idx];
        if (vfunc(vitem)){
            return idx;
        }
    }
    return false;
}

model.loadAjax = function(config){    
    debugger;
    xconfig = config;
    xconfig.success = function (response) {
            //console.log(response);
            var sukses = 1;
            var vmessage = 'error....';
            try {
                if (typeof response === "object"){
                    xdata = response;
                } else {
                    try {
                        //Run some code here
                        xdata = $.parseJSON(response);
                    } catch(err) {
                        //Handle errors here
                        vmessage = response;
                        sukses = 0;
                        //alert('Request Error: '+response);
                        xdata = [[]];
                        //sukses = 0;
                        //return;
                    }
                }
                if(typeof xdata.success=='undefined'){
                    if(typeof xdata.message!=='undefined'){
                        vmessage = xdata.message;
                        sukses = 0;
                    } else {
                        xdata = [[]];
                        sukses = 0;
                    }
                } else {
                    if (xdata.success==0){
                        sukses = 0;
                        if(typeof xdata.message!=='undefined'){
                            vmessage = xdata.message;
                        } else {
                            vmessage = 'error unknown (no message)';
                        }
                        //alert(vmessage);
                    } else {
                        //location.reload();
                        sukses = 1;
                    }
                }
                if (sukses===1){
                    if (typeof config.onsuccess!=='undefined'){
                        config.onsuccess(xdata);
                    }
                } else {
                    if (typeof config.onerror!=='undefined'){
                        config.onerror(vmessage);
                    }
                }
            } catch (err){
                if (typeof config.onerror!=='undefined'){
                    config.onerror(err.message);
                }
            }
        }
    
    xconfig.error = function (xhr) {
            if (typeof config.onerror!=='undefined'){
                config.onerror(xhr.responseText);
            }
        }
    $.ajax(xconfig);    
}
function loadAjax(config){
    return Manggu.loadAjax(config);
}



