<div class="row">
    <script src="<?php echo base_url(); ?>themes/aceadmin/js/jquery.js" type="text/javascript"></script>
    <link href="<?php echo base_url(); ?>themes/aceadmin/css/c3-b03125fa.css" media="screen" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>themes/aceadmin/js/d3-3.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>themes/aceadmin/js/c3.js" type="text/javascript"></script>
    <div class="col-sm-12" style="height: 500px;">
        <div class="page-header">
            <h4>
                Data Semua Layanan
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
<script>
    var chart = c3.generate({
        bindto: '#layanan_all',
        data: {
            x: 'x',
            columns: <?php echo $layanan_all; ?>,
            type: 'bar'
        },
        axis: {
            x: {
                type: 'categorized',
            }
        }
    });
</script>