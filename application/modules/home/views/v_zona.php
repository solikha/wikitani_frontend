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
<link rel="stylesheet" href="<?php echo $libsurl; ?>leaflet/leaflet.css" />
<script src="<?php echo $libsurl; ?>leaflet/leaflet-src.js"></script>
<script src="<?php echo $libsurl; ?>mustache/mustache.js"></script>
  <script src="<?php echo $libsurl; ?>sockjs/sockjs-0.3.4.js"></script>
  <script src="<?php echo $libsurl; ?>stomp/stomp.js"></script>
<script src="<?php echo $libsurl; ?>kslibs/js/mgmap.js"></script>
<style>
    #map { 
        height: 400px; 
    }
    .page-content{
        padding-top : 2px;
        padding-left: 12px;
        padding-right: 12px;
        padding-bottom: 0px;
    }
    .teksinfo{
        margin-bottom: 4px;
    }
    .widget-title{
        margin-bottom:5px;
    }
    .widget-header{
        min-height: 28px;
        height: auto;
    }
    .label-status{
        width:100%; 
        text-align:left;
        padding-top: 4px;
        margin-bottom:3px;
    }
    
    .table{
        margin-top: 0px;
        margin-bottom: 0px;
        border: solid #444 2px!important;
    }
    .table thead>tr{
        border-bottom: solid #888 2px!important;
    }
    .table thead>tr>th, .table tbody>tr>th, .table tfoot>tr>th, .table thead>tr>td, .table tbody>tr>td, .table tfoot>tr>td{
        padding-left: 2px;
        padding-right: 2px;
        padding-bottom: 1px;
        padding-top: 1px;
        line-height: 1.3;
    }
    .tdleft {
        padding-left: 10px!important;
    }
    .tdright {
        padding-right: 10px!important;
    }
    .status-log{
        max-width: 800px;
        background-color:#cde;
    }
</style>
<audio id="audiotag1" src="<?php echo $basedir;?>images/audio/alarm1.mp3" preload="auto"></audio>
<audio id="audiotag2" src="<?php echo $basedir;?>images/audio/alarm2.mp3" preload="auto"></audio>

<div id ="popup-jobsite" style="display:none;">
    <div class="col-xs-12 col-sm-6 widget-container-col" style="padding:0px;">
    <div class="timeline-item clearfix" style="border:#ddd solid 1px; margin-right:5px">
        <!-- #section:pages/timeline.info -->
        <div class="timeline-info" style="margin-left:-10px; width:40px">
            <img src="<?php echo $basedir.'images/pin/'; ?>{{status_zona}}.png"
                    style="width:36px; border-radius: 0px; margin-left:12px; margin-top:4px; border-style:none;">
            
<!--            <a href="#" class="btn btn-success btn-sm btn-round" style="margin-left:18px; margin-top: 0px; margin-bottom: 2px"
               onclick="send_disarm_button({{id}})" >
                <i class="ace-icon fa fa-unlock-alt"></i>
            </a>
            <a href="#" class="btn btn-warning btn-sm btn-round" style="margin-left:18px; margin-top: 0px; margin-bottom: 4px"
               onclick="send_arm_button({{id}})" >
                <i class="ace-icon fa fa-lock"></i>
            </a>-->
            
        </div>
            
        <!-- /section:pages/timeline.info -->
        <div class="widget-box transparent" style="margin-left:40px;">
            <div class="widget-header" style=" padding-right:6px;">
                <span ><h4 class="jobsite-id-{{id}}-title" style="margin-bottom:-10px">{{nama}} </h4> &nbsp;</span>
                
                
            </div>
                    <div class="" style="margin-top:0px; margin-bottom:-12px">
                        <b><span class="jobsite-id-{{id}}-status"> <span class="{{status_class}} label-status" >{{status_zona_caption}}&nbsp;</span></span></b>&nbsp;
                    </div>
            <div style="margin-left: 10px; margin-top: 6px">
                <a href="#" class="btn btn-success btn-round" 
                onclick="send_disarm_button({{id}})" >
                    <i class="ace-icon fa fa-unlock-alt  bigger-150"></i> Disarm
                </a>
                <a href="#" class="btn btn-warning btn-round" 
                onclick="send_arm_button({{id}})" >
                    <i class="ace-icon fa fa-lock bigger-150"></i> Arm
                </a>
            </div>
            <div class="widget-body">
                <div class="widget-main" style="min-width:200px; padding-top:6px">
                    
                    <div class="teksinfo"><i class="ace-icon fa fa-map-marker pull-left"></i> <div style="margin-left:16px">{{alamat}}&nbsp;</div></div>
                    <div class="teksinfo"><i class="ace-icon fa fa-bell-o pull-left"></i> 
                        <div style="margin-left:16px">
                        {{#zona_info}}
                        <span class="jobsite-id-{{id}}-status"> <span class="{{status_class}} label-status " >{{nama}} : {{caption}}&nbsp;</span></span>
                        {{/zona_info}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<div id="data-jobsite" class="row" style="padding-left:12px; padding-right:8px;">
    
</div>

<script>
    function send_disarm_button(vid){
        var vnonce = 'PBTN'+(new Date).getTime();
        var vurl = '<?php echo $basedir.index_page();?>/ccenter/svc_send_disarm?nonce='+vnonce+'&jobsite_id='+vid;
        var voption = {
            mode: 'GET',
            divid: 'msg_div',
            url: vurl
        }
        send_data_panic_button(voption);
    }
    
    function send_arm_button(vid){
        var vnonce = 'PBTN'+(new Date).getTime();
        var vurl = '<?php echo $basedir.index_page();?>/ccenter/svc_send_arm?nonce='+vnonce+'&jobsite_id='+vid;
        var voption = {
            mode: 'GET',
            divid: 'msg_div',
            url: vurl
        }
        send_data_panic_button(voption);
    }
    
    function send_data_panic_button(voption){
        var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById(voption.divid).innerHTML=xmlhttp.responseText;
            }
        }
        xmlhttp.open(voption.mode,voption.url,true);
        xmlhttp.send();
    }
    function send_disarm(voption){
        
    }
</script>

<script>
    var pinurl = '<?php echo $basedir;?>images/pin/';
    // lon 107.5833097
    // lat -6.9046567
    var dataJobsite = <?php echo json_encode($dataJobsite); ?>;
    var LoadDataJobsite;
    var updatePopup = function(m){
        var data = m.options.data;
        //console.log(data);
        var template = $('#'+data.popupname).html();
        var msg = Mustache.render(template, data);
        m.setPopupContent(msg);
    }
    
    var onMarkerClick = function (e){
        console.log(e);
        var m = e.target;
        updatePopup(m);
        //console.log(m.getPopup()); 
    }    
    var isFunction = function (functionToCheck) {
        var getType = {};
        return functionToCheck && getType.toString.call(functionToCheck) === '[object Function]';
    }

    var updateDataJobsite = function(){
        
    }
    
    var showGritterMessage = function(data){
        $.gritter.add({
            title: 'This is a regular notice!',
            text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="blue">magnis dis parturient</a> montes, nascetur ridiculus mus.',
            sticky: false,
            time: '',
            class_name: 'gritter-light'
        });
    }
    
    var messageNotification = function(data){
        vresult = 0;
        if (data['ispopup']=='1') {
            voption = {
                title: data['status_zona_caption'],
                text: 'Jobsite : '+data['nama']+'<br>'+'Customer : '+data['nama_customer'],
                sticky: false,
                class_name: 'gritter-info gritter-light'
            }
            vresult = $.gritter.add(voption);
        } else if (data['ispopup']=='2'){
            voption = {
                title: data['status_zona_caption'],
                text: 'Jobsite : '+data['nama']+'<br>'+'Customer : '+data['nama_customer'],
                sticky: true,
                class_name: 'gritter-error '
            }
            vresult = $.gritter.add(voption);
        } else {
        }
        return vresult;
    }
    
    var messageSound = function(data){
        if (data['issound']=='1') {
            document.getElementById('audiotag1').play();
        } else if (data['issound']=='2'){
            document.getElementById('audiotag2').play();
        } else {
        }
    }
    

    var getJobsiteIcon;
    var iconArray = [];
    var SiapIcon;
    var JobsiteIcon;
    var map;

    var getJobsiteIcon = function(vname){
        if ((vname==='') || (vname===null)){
            vname = 'none';
        }
        if (typeof iconArray[vname]=='undefined'){
            iconArray[vname] = new JobsiteIcon({iconUrl: pinurl+vname+'.png'});
        }
        return iconArray[vname];
    }

        
    var checkJSIcon = function (data){
        nmicon = data['nama_status'];
        return getJobsiteIcon(nmicon);
    }
    
    var updateStatusZona = function(vid){
        //var data = jobsite['data'];
        //var vid = jobsite['data']['jobsite_id'];
        var vidx = Manggu.findItemArray(dataJobsite, function(item){
            if (item['id']==vid){
                return true;
            } else {
                return false;
            }
        });
        
        console.log(vidx);
        if (vidx!==false){
            var data = dataJobsite[vidx];
            if ((data['status_zona']==='') || (data['status_zona']===null)){
                data['status_zona'] = 'none';
            }
            var template = $('#popup-jobsite').html();
            var msg = Mustache.render(template, data);

            $('#data-status-jobsite-'+vid).html(msg);
            console.log($('#data-status-jobsite-'+vid));
            console.log(msg);
        }
    }
    
    var findItemById = function(data, id){
        for(var i=0; i<data.length; i++){
            var item = data[i];
            if (item['id']==id){
                return item;
            }
        }
        return false;
    }


    
    OnReadyArray.push(function(){
            var isrunning = false;
        
        
        
        vdelta = 105;
        vheight = $(window).height()-vdelta;
        if (vheight<400){
            vheight = 400;
        }
        
        LoadDataJobsite = function(){ 
            console.log('interval');
            ajaxurl = '<?php echo $mainurl;?>ccenter/svcjobsite';
            if (!isrunning){
                isrunning = true;
                Manggu.loadAjax({
                    type: 'GET',
                    url: ajaxurl,
                    data: {code: Math.random()},
                    onsuccess: function(data){
                        //alert('sukses');
                        //location.reload();
                        debugger;
                        console.log(data);
                        updateMarker(data['data']);
                        isrunning = false;
                    },
                    onerror: function(message){
                        //Manggu.showMessage(message);
                        console.log(message);
                        isrunning = false;
                    }
                });
            }
            //alert("Hello"); 
        }        
        
        
        // Stomp.js boilerplate
        //client.debug = pipe('#second');
        var vInterval = 5;
        var client;
//        var print_first = pipe('#first', function(data) {
//            client.send('/topic/jobsite.*.zona.*.status', {}, data);
//        });
        var on_connect = function(x) {
            vInterval = 5;
            id = client.subscribe("/topic/jobsite.status", function(d) {
                //print_first(d.body);
                //LoadDataJobsite();
                console.log(d);
            });
            
            // subscribe ke informasi jobsite
            id = client.subscribe("/topic/customer.*.jobsite.*.status", function(d) {
                //print_first(d.body);
                //LoadDataJobsite();
                console.log('Jobsite Msg');
                console.log(d.body);
                updateJobsite(d.body);
                debugger;
            });
            
            
        };
        var doRabbitConnect = function (vuser, vpasswd, von_connect, von_error, vpath){
            var ws = new SockJS('http://krwtn.net:15674/stomp');
            client = Stomp.over(ws);

            // SockJS does not support heart-beat: disable heart-beats
            client.heartbeat.outgoing = 0;
            client.heartbeat.incoming = 0;
            client.connect(vuser, vpasswd, von_connect, von_error, vpath);
        }
        
        var on_error =  function(x) {
            console.log('error');
            console.log(x);
            setTimeout(function(){
                console.log("try to connect again");
                //client.connect('guest', 'guest', on_connect, on_error, '/');
                doRabbitConnect('guest', 'guest', on_connect, on_error, '/');
                vInterval = vInterval+5;
            }, vInterval*1000);
        };
        doRabbitConnect('guest', 'guest', on_connect, on_error, '/');
        
        
        var updateJobsite = function(msg){
            var data = jQuery.parseJSON(msg);
            var vidx = Manggu.findItemArray(dataJobsite, function(item){
                if (item['id']==data['data']['jobsite_id']){
                    return true;
                } else {
                    return false;
                }
            });
            if (vidx!==false){
                // ketemu
                // update icon
                var vitem = dataJobsite[vidx];
//                var vmarker = vitem['marker'];
//                var vpopup = vmarker.options.data.popupname;
                dataJobsite[vidx] = data['data'];
//                dataJobsite[vidx]['marker'] = vmarker;
//                var vicon = getJobsiteIcon(data['data']['nama_status']);
//                vmarker.options.data = data['data'];
//                vmarker.options.data.popupname = vpopup;
//                vmarker.setIcon(vicon);
//                if(data['data']['isfocus']!='0'){
//                    vmarker.openPopup();
//                }
//                updatePopup(vmarker);
                updateStatusZona(data['data']['jobsite_id']);
                if(typeof vitem.gritterid !== 'undefined'){
                    $.gritter.remove(vitem.gritterid, { 
                        fade: true, // optional
                        speed: 'fast' // optional
                    });
                }
                var vid = messageNotification(data['data']);
                if (vid!==0){
                    vitem.gritterid = vid;
                }
                messageSound(data['data']);
            } else {
                // tidak ketemu
            }
        }
        
        //load data
        var vtemplate = $('#popup-jobsite').html();
        vtemplate = '<div id="data-status-jobsite-{{jobsite_id}}">'+
            vtemplate+'</div>';
        for(var vidx = 0; vidx<dataJobsite.length; vidx++){
            var data = dataJobsite[vidx];
            if ((data['status_zona']==='') || (data['status_zona']===null)){
                data['status_zona'] = 'none';
            }
            var vhtml = Mustache.render(vtemplate, data);
            $('#data-jobsite').append(vhtml);
        }
        
    });
</script>