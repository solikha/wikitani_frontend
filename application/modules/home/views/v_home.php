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

<?php if ($userinfo['rolename'] === 'admin') : ?>

    <div class="page-header">
        <h1>
            Dashboard
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                overview &amp; stats
            </small>
        </h1>
    </div>
    <div class="col-sm-8 col-md-offset-2">
        <!-- #section:pages/dashboard.infobox -->
        <div class="infobox infobox-red">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-cloud"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?//= $jumlah_wni ?></span>
                <div class="infobox-content">Jumlah WNI</div>
            </div>

            <!-- #section:pages/dashboard.infobox.stat -->
            <!-- <div class="stat stat-success">8%</div> -->

            <!-- /section:pages/dashboard.infobox.stat -->
        </div>

        <div class="infobox infobox-blue">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-database"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?//= $jumlah_layanan_selesai ?></span>
                <div class="infobox-content">Layanan Selesai</div>
            </div>

            <!--
            <div class="badge badge-success">
                +32%
                <i class="ace-icon fa fa-arrow-up"></i>
            </div>
            -->
        </div>

        <div class="infobox infobox-pink">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-users"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"><?//= $jumlah_layanan_proses ?></span>
                <div class="infobox-content">Layanan Diproses</div>
            </div>
            <!--<div class="stat stat-important">4%</div> -->
        </div>

        <!--
        <div class="infobox infobox-red">
            <div class="infobox-icon">
                <i class="ace-icon fa fa-wrench"></i>
            </div>

            <div class="infobox-data">
                <span class="infobox-data-number"></span>
                <div class="infobox-content">Bengkel Pelaksana</div>
            </div>
        </div>
        -->
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="row">
        <script src="<?php echo base_url(); ?>themes/aceadmin/js/jquery.js" type="text/javascript"></script>
        <link href="<?php echo base_url(); ?>themes/aceadmin/css/c3-b03125fa.css" media="screen" rel="stylesheet" type="text/css">
        <script src="<?php echo base_url(); ?>themes/aceadmin/js/d3-3.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>themes/aceadmin/js/c3.js" type="text/javascript"></script>
        <div class="col-sm-6" style="height: 400px;">
            <div class="page-header">
                <h4>
                    Kategori WNI
                    <small>
                        BAR Chart
                    </small>
                </h4>
            </div>
            <div class="chart">
                <div style="max-height: 280px; position: relative;" class="c3" id="data_kategori_wni"></div>
            </div>
        </div>
        <div class="col-sm-6" style="height: 400px;">
            <div class="page-header">
                <h4>
                    Layanan
                    <small>
                        BAR Chart
                    </small>
                </h4>
            </div>
            <div class="chart">
                <div style="max-height: 280px; position: relative;" class="c3" id="layanan_all"></div>
            </div>
        </div>
    </div>

    <div class="space"></div>

    <div class="row">
        <div class="col-sm-6">
            <div class="widget-box transparent">
                <div class="widget-header widget-header-flat">
                    <h4 class="widget-title lighter">
                        <i class="ace-icon fa fa-file-o red"></i>
                        Layanan Terbaru
                    </h4>
                    <div class="widget-toolbar">
                        <a href="#" data-action="collapse">
                            <i class="ace-icon fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <table class="table table-bordered table-striped">
                            <thead class="thin-border-bottom">
                                <tr>
                                    <th align="center" style="text-align: center;"> No</th>
                                    <th> Nama WNI</th>
                                    <th class="hidden-480"> Jenis Layanan </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php// foreach ($latest_layanan as $layanan) : ?>
                                    <tr>
                                        <td align="center"><span class="badge"><?//= $i++ ?></span></td>
                                        <td><b class="blue"><?//= $layanan['namawni'] ?></b></td>
                                        <td class="hidden-480">
                                            <?//= $layanan['layanan'] ?>
                                        </td>
                                    </tr>
                                <?php //endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var chart = c3.generate({
                bindto: '#data_kategori_wni',
                data: {
                    x: 'x',
                    columns: <?php// echo $data_kategori_wni; ?>,
                    type: 'bar'
                },
                axis: {
                    x: {
                        type: 'categorized',
                        tick: {
                            rotate: 90,
                            multiline: false
                        },
                        height: 130
                    }
                }
            });

            var chart = c3.generate({
                bindto: '#layanan_all',
                data: {
                    x: 'x',
                    columns: <?php// echo $layanan_all; ?>,
                    type: 'bar'
                },
                axis: {
                    x: {
                        type: 'categorized',
                        tick: {
                            rotate: 90,
                            multiline: false
                        },
                        height: 130
                    }
                }
            });
        </script>
    <?php endif; ?>

