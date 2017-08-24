<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style type="text/css" title="currentStyle">
    @import "<?php echo base_url(); ?>themes/aceadmin/css/demo_page.css";
    @import "<?php echo base_url(); ?>themes/aceadmin/css/demo_table.css";
    @import "<?php echo base_url(); ?>themes/aceadmin/css/themes/base/jquery-ui.css";
    @import "<?php echo base_url(); ?>themes/aceadmin/css/themes/smoothness/jquery-ui-1.7.2.custom.css";
</style>

<script src="<?php echo base_url(); ?>themes/aceadmin/js/jquery-1.4.4.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>themes/aceadmin/js/jquery.dataTables.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>themes/aceadmin/js/jquery-2.0.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>themes/aceadmin/js/jquery-ui.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>themes/aceadmin/js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
<div class="page-header">
    <h1>Import Execl Data</h1>
</div>
<div class="col-sm-6 col-md-4 col-lg-4">
    <input id="sortpicture" class="btn-group btn btn-sm btn-success" type="file" name="files"/>
</div>
<div class="col-sm-6 col-md-4 col-lg-4">
    <button id="upload" class="btn-group btn btn-sm btn-info">Load</button>
</div>
<div class="col-sm-12 col-md-12" style="height: 30px;">
    <hr/>
</div>
<form id="form">
    <table class="table table-striped table-bordered table-hover" id="numbers_table">
        <thead>
            <tr id="header-row">
                <th><input type="checkbox" id="checkall" title="Select all" onClick="toggle(this)"/></th>
                <th id="row1">Row 1 (one)</th>
                <th id="row2">Row 2 (two)</th>
                <th id="row3">Row 3 (three)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            for ($j = 1; $j < count($data_part); $j++) {
                ?>
                <tr>
                    <td><input name="checkbox[]" value="<?php echo $i++; ?>" type="checkbox"></td>
                    <td><?php echo $data_part[$j]['nama']; ?><input type="hidden" class="row1" name="" value="<?php echo $data_part[$j]['nama']; ?>" /></td>
                    <td><?php echo $data_part[$j]['alamat']; ?><input type="hidden" class="row2" name="" value="<?php echo $data_part[$j]['alamat']; ?>" /></td>
                    <td><?php echo $data_part[$j]['telepon']; ?><input type="hidden" class="row3" name="" value="<?php echo $data_part[$j]['telepon']; ?>" /></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <div class="col-sm-12 col-md-12">
        <div class="page-header">
            <h3>Pilih Field</h3>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4">
        <select class="form-control">
            <option>pilih row 1</option>
            <option onclick="select_1_row1();">Number</option>
            <option onclick="select_1_row2();">Code</option>
            <option onclick="select_1_row3();">Name</option>
        </select>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4">
        <select class="form-control">
            <option>pilih row 2</option>
            <option onclick="select_2_row1();">Number</option>
            <option onclick="select_2_row2();">Code</option>
            <option onclick="select_2_row3();">Name</option>
        </select>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-4">
        <select class="form-control">
            <option>pilih row 3</option>
            <option onclick="select_3_row1();">Number</option>
            <option onclick="select_3_row2();">Code</option>
            <option onclick="select_3_row3();">Name</option>
        </select>
    </div>
    <br/>
    <div class="col-sm-12 col-md-12">
        <hr/>
    </div>
    <button type="submit">Submit form</button>
</form>

<!--http://jsfiddle.net/vXBtP/5/-->
<script type="text/javascript">
//                  option row 1
                    function select_1_row1() {
                        var oTable = $('#numbers_table').dataTable();
                        oTable.$(".row1").attr("name", "number[]");
                        $('#row1').html('Number');
                    }
                    function select_1_row2() {
                        var oTable = $('#numbers_table').dataTable();
                        oTable.$(".row1").attr("name", "code[]");
                        $('#row1').html('Code');
                    }
                    function select_1_row3() {
                        var oTable = $('#numbers_table').dataTable();
                        oTable.$(".row1").attr("name", "name[]");
                        $('#row1').html('Name');
                    }

//                  option row 2
                    function select_2_row1() {
                        var oTable = $('#numbers_table').dataTable();
                        oTable.$(".row2").attr("name", "number[]");
                        $('#row2').html('Number');
                    }
                    function select_2_row2() {
                        var oTable = $('#numbers_table').dataTable();
                        oTable.$(".row2").attr("name", "code[]");
                        $('#row2').html('Code');
                    }
                    function select_2_row3() {
                        var oTable = $('#numbers_table').dataTable();
                        oTable.$(".row2").attr("name", "name[]");
                        $('#row2').html('Name');
                    }

//                  option row 3
                    function select_3_row1() {
                        var oTable = $('#numbers_table').dataTable();
                        oTable.$(".row3").attr("name", "number[]");
                        $('#row3').html('Number');
                    }
                    function select_3_row2() {
                        var oTable = $('#numbers_table').dataTable();
                        oTable.$(".row3").attr("name", "code[]");
                        $('#row3').html('Code');
                    }
                    function select_3_row3() {
                        var oTable = $('#numbers_table').dataTable();
                        oTable.$(".row3").attr("name", "name[]");
                        $('#row3').html('Name');
                    }

                    $(document).ready(function() {
                        var oTable = $('#numbers_table').dataTable();

//                      submit form table data
                        $('#form').submit(function() {
                            var sData = oTable.$('input').serialize();
                            $.ajax({
                                type: "post",
                                url: "<?php echo base_url(); ?>index.php/workflow/save_import",
                                data: sData,
                                success: function(result) {
                                    alert(result);
                                }
                            });
                            return false;
                        });

//                      checked form table all
                        $('#checkall').click(function() {
                            oTable.$("input:checkbox").prop('checked', $(this).is(":checked"));
                        });

//                      upload import execl
                        $("#upload").on('click', function() {
                            var file_data = $('#sortpicture').prop('files')[0];
                            var form_data = new FormData();
                            form_data.append('files', file_data);
                            $.ajax({
                                url: '<?php echo base_url(); ?>index.php/workflow/do_upload', // point to server-side PHP script 
                                dataType: 'text', // what to expect back from the PHP script, if anything
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,
                                type: 'post',
                                success: function(data) {
                                    alert(data);
                                }
                            });
                            $.ajax({
                                type: "post",
                                url: "replace_name",
                                data: $('#file').serialize(),
                                success: function(result) {
                                    $('#file').val(result);
                                }
                            });
                        });
                    });
</script>