<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

$data = array();
array_push($data, array('title'=>'Kepala Dinas', 'base_value'=>'2', 'base_icon'=>'fa-thumbs-o-up', 'base_color'=>'green', 'add_value'=>'1 jam', 'add_color'=>'success', 'base_start'=>'<div class="col-sm-3">', 'base_end'=>''));
array_push($data, array('title'=>'Sekretaris', 'base_value'=>'5', 'base_icon'=>'fa-gear', 'base_color'=>'green', 'add_value'=>'3 hari', 'add_color'=>'danger', 'base_start'=>'', 'base_end'=>'</div><div class="col-sm-3">'));
array_push($data, array('title'=>'Kabid Jalan', 'base_value'=>'15', 'base_icon'=>'fa-gears', 'base_color'=>'orange', 'add_value'=>'3 jam', 'add_color'=>'success', 'base_start'=>'', 'base_end'=>''));
array_push($data, array('title'=>'Kasi Rencana Jalan', 'base_value'=>'8', 'base_icon'=>'fa-gears', 'base_color'=>'orange', 'add_value'=>'1 hari', 'add_color'=>'warning', 'base_start'=>'', 'base_end'=>''));
array_push($data, array('title'=>'Staff Renc Jalan', 'base_value'=>'25', 'base_icon'=>'fa-warning', 'base_color'=>'red', 'add_value'=>'5 hari', 'add_color'=>'danger', 'base_start'=>'', 'base_end'=>'</div><div class="col-sm-3">'));
array_push($data, array('title'=>'Kabid Jembatan', 'base_value'=>'4', 'base_icon'=>'fa-gear', 'base_color'=>'green', 'add_value'=>'3 hari', 'add_color'=>'danger', 'base_start'=>'', 'base_end'=>''));
array_push($data, array('title'=>'Kasi Rencana Jembatan', 'base_value'=>'12', 'base_icon'=>'fa-gears', 'base_color'=>'orange', 'add_value'=>'3 jam', 'add_color'=>'success', 'base_start'=>'', 'base_end'=>''));
array_push($data, array('title'=>'Staf Renc Jembatan', 'base_value'=>'9', 'base_icon'=>'fa-gears', 'base_color'=>'orange', 'add_value'=>'1 hari', 'add_color'=>'warning', 'base_start'=>'', 'base_end'=>'</div><div class="col-sm-3">'));
array_push($data, array('title'=>'Kabid SD Air', 'base_value'=>'4', 'base_icon'=>'fa-gear', 'base_color'=>'green', 'add_value'=>'3 hari', 'add_color'=>'danger', 'base_start'=>'', 'base_end'=>''));
array_push($data, array('title'=>'Kasi Rencana SD Air', 'base_value'=>'12', 'base_icon'=>'fa-gears', 'base_color'=>'orange', 'add_value'=>'3 jam', 'add_color'=>'success', 'base_start'=>'', 'base_end'=>''));
array_push($data, array('title'=>'Staf Renc SD Air', 'base_value'=>'9', 'base_icon'=>'fa-gears', 'base_color'=>'orange', 'add_value'=>'1 hari', 'add_color'=>'warning', 'base_start'=>'', 'base_end'=>'</div>'));


?>
<div class="page-header">
    <h1>
        Dashboard
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Overview Perizinan
        </small>
    </h1>
</div>
<div class="row">
    
    <div class="col-xs-12">
        
        <div class="alert alert-block alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
                
            <i class="ace-icon fa fa-check green"></i>
                
            Selamat datang di <strong class="green">Aplikasi Perizinan PU DKI Jakarta</strong>
        </div>        
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-sm-10 infobox-container">
                <!-- #section:pages/dashboard.infobox -->
        <?php foreach($data as $item) { ?>
                <?php echo $item['base_start'];?>
                    <div class="infobox infobox-<?php echo $item['base_color'];?>">
                        <div class="infobox-icon">
                            <i class="ace-icon fa <?php echo $item['base_icon'];?>"></i>
                        </div>                    
                        <div class="infobox-data">
                            <span class="infobox-data-number"><?php echo $item['base_value'];?></span>
                            <div class="infobox-content"><?php echo $item['title'];?></div>
                        </div>
                        <div class="badge badge-<?php echo $item['add_color'];?>">
                            &nbsp;<?php echo $item['add_value'];?>&nbsp;
                        </div>
                        <!-- /section:pages/dashboard.infobox.stat -->
                    </div>
                <?php echo $item['base_end'];?>

        <?php } ?>
            </div> 
        </div>
            <div class="row">
                <div class="col-sm-10 infobox-container">
                <!-- /section:pages/dashboard.infobox -->
                <div class="space-6"></div>
                    
                <!-- #section:pages/dashboard.infobox.dark -->
                <div class="infobox infobox-green infobox-small infobox-dark">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-thumbs-up"></i>
                    </div>
                        
                    <div class="infobox-data">
                        <div class="infobox-content" style="width: 200px">Tepat Waktu</div>
                        <div class="infobox-content">248</div>
                    </div>
                </div>
                    
                <div class="infobox infobox-red infobox-small infobox-dark">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-clock-o"></i>
                    </div>
                        
                    <div class="infobox-data">
                        <div class="infobox-content" style="width: 200px">Terlambat</div>
                        <div class="infobox-content">25</div>
                    </div>
                </div>
                    
                <div class="infobox infobox-pink infobox-small infobox-dark">
                    <div class="infobox-icon">
                        <i class="ace-icon fa fa-trash-o"></i>
                    </div>
                        
                    <div class="infobox-data">
                        <div class="infobox-content">Ditolak</div>
                        <div class="infobox-content">7</div>
                    </div>
                </div>
                    
                <!-- /section:pages/dashboard.infobox.dark -->
            </div>
        </div>
            
        <div style="margin-bottom: 15px"></div>
        <div class="row">
            
            <div class="vspace-12-sm"></div>
                
            <div class="col-sm-10">
                <div class="widget-box">
                    <div class="widget-header widget-header-flat widget-header-small">
                        <h5 class="widget-title">
                            <i class="ace-icon fa fa-signal"></i>
                            Jumlah Perizinan
                        </h5>
                            
                        <div class="widget-toolbar no-border">
                            <div class="inline dropdown-hover">
                                <button class="btn btn-minier btn-primary">
                                    Bulan Ini
                                    <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                                </button>
                                    
                                <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                    <li class="active">
                                        <a href="#" class="blue">
                                            <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                            Bulan Lalu
                                        </a>
                                    </li>
                                        
                                    <li>
                                        <a href="#">
                                            <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                            Tahun Ini
                                        </a>
                                    </li>
                                        
                                    <li>
                                        <a href="#">
                                            <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                            Seluruhnya
                                        </a>
                                    </li>
                                        
                                </ul>
                            </div>
                        </div>
                    </div>
                        
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="row">
                                
                            <div class="col-sm-6">
                            <!-- #section:plugins/charts.flotchart -->
                            <div id="piechart-placeholder" style="width: 90%; min-height: 150px; padding: 0px; position: relative;"><canvas class="flot-base" width="384" height="150" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 384px; height: 150px;"></canvas><canvas class="flot-overlay" width="384" height="150" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 384px; height: 150px;"></canvas><div class="legend"><div style="position: absolute; width: 80px; height: 110px; top: 15px; right: -30px; opacity: 0.85; background-color: rgb(255, 255, 255);"> </div><table style="position:absolute;top:15px;right:-30px;;font-size:smaller;color:#545454"><tbody>
                                                <tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #68BC31;overflow:hidden"></div></div></td><td class="legendLabel">xsocial networks</td></tr>
                                                <tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #2091CF;overflow:hidden"></div></div></td><td class="legendLabel">search engines</td></tr>
                                                <tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #AF4E96;overflow:hidden"></div></div></td><td class="legendLabel">ad campaigns</td></tr>
                                                <tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #DA5430;overflow:hidden"></div></div></td><td class="legendLabel">direct traffic</td></tr>
                                                <tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid #FEE074;overflow:hidden"></div></div></td><td class="legendLabel">other</td></tr></tbody></table></div></div>
                                
                            <!-- /section:plugins/charts.flotchart -->
                            <div class="hr hr8 hr-double"></div>
                                
                            <div class="clearfix">
                                <!-- #section:custom/extra.grid -->
                                <div class="grid3">
                                    <span class="grey">
                                        <i class="ace-icon fa fa-file-text fa-2x blue"></i>
                                        &nbsp; Sedang diproses
                                    </span>
                                    <h4 class="bigger pull-right">1,255</h4>
                                </div>
                                    
                                <div class="grid3">
                                    <span class="grey">
                                        <i class="ace-icon fa fa-file-text fa-2x purple"></i>
                                        &nbsp; Diterbitkan
                                    </span>
                                    <h4 class="bigger pull-right">941</h4>
                                </div>
                                    
                                <div class="grid3">
                                    <span class="grey">
                                        <i class="ace-icon fa fa-file-text fa-2x green"></i>
                                        &nbsp; Total &nbsp; &nbsp; &nbsp; &nbsp; 
                                    </span>
                                    <h4 class="bigger pull-right">1,050</h4>
                                </div>
                                    
                                <!-- /section:custom/extra.grid -->
                            </div>
                            </div>
                                
                            <div class="col-sm-6">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Jenis Perizinan</th>
                                            <th>Masuk</th>
                                            <th>Disetujui</th>
                                            <th>Ditolak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>IMP Jalan</th>
                                            <th>8</th>
                                            <th>7</th>
                                            <th>1</th>
                                        </tr>
                                        <tr>
                                            <th>IMP Jembatan</th>
                                            <th>2</th>
                                            <th>2</th>
                                            <th>0</th>
                                        </tr>
                                        <tr>
                                            <th>IMP Saluran</th>
                                            <th>12</th>
                                            <th>9</th>
                                            <th>2</th>
                                        </tr>
                                        <tr>
                                            <th>IMP Reklamasi</th>
                                            <th>10</th>
                                            <th>8</th>
                                            <th>2</th>
                                        </tr>
                                        <tr>
                                            <th>PLB Banjir</th>
                                            <th>9</th>
                                            <th>6</th>
                                            <th>2</th>
                                        </tr>
                                        <tr>
                                            <th>Jaringan Utilitas</th>
                                            <th>12</th>
                                            <th>10</th>
                                            <th>1</th>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                            </div>
                                
                            </div>
                            
                            
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
                
            </div>
            
        </div><!-- /.row -->
            
        <!-- #section:custom/extra.hr -->
        <div class="hr hr32 hr-dotted"></div>
            
            
            
        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div>


<script>
    
    OnReadyArray.push(function(){
        
        $('.easy-pie-chart.percentage').each(function(){
            var $box = $(this).closest('.infobox');
            var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
            var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
            var size = parseInt($(this).data('size')) || 50;
            $(this).easyPieChart({
                barColor: barColor,
                trackColor: trackColor,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: parseInt(size/10),
                animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
                size: size
            });
        })
        
        $('.sparkline').each(function(){
            var $box = $(this).closest('.infobox');
            var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
            $(this).sparkline('html',
            {
                tagValuesAttribute:'data-values',
                type: 'bar',
                barColor: barColor ,
                chartRangeMin:$(this).data('min') || 0
            });
        });
        
        
        var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'200px'});
        var data = [
            { label: "IMP Jalan",  data: 38.7, color: "#68BC31"},
            { label: "IMP Jembatan",  data: 24.5, color: "#2091CF"},
            { label: "IMP Saluran",  data: 8.2, color: "#AF4E96"},
            { label: "IMP Reklamasi",  data: 18.6, color: "#DA5430"},
            { label: "PLB Banjir",  data: 10, color: "#FEE0FF"},
            { label: "Jaringan Utilitas",  data: 10, color: "#FEE074"}
        ]
        function drawPieChart(placeholder, data, position) {
            $.plot(placeholder, data, {
                series: {
                    pie: {
                        show: true,
                        tilt:0.8,
                        highlight: {
                            opacity: 0.25
                        },
                        stroke: {
                            color: '#fff',
                            width: 2
                        },
                        startAngle: 2
                    }
                },
                legend: {
                    show: true,
                    position: position || "ne", 
                    labelBoxBorderColor: null,
                    margin:[-30,15]
                }
                ,
                grid: {
                    hoverable: true,
                    clickable: true
                }
            })
        }
        drawPieChart(placeholder, data);
        
        
    });

</script>
