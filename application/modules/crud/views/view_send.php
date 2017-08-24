<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-xs-12">
    <div class="testing1"></div>
    <div class="page-header">
        <h1>RFQS Send Email</h1>
    </div>
    <style type="text/css">
        input[name=to] {
            pointer-events:none;
            background-color: #eee;
        }
        input[name=subject] {
            pointer-events:none;
            background-color: #eee;
        }
    </style>
    <form action="<?php echo base_url(); ?>index.php/crud/c_quotations/email_rfqs" method="post">
        <div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px">
            <div class="col-xs-12 col-sm-12">
                <div class="row">
                    <p style="font-size: 20px">Apakah anda yakin mengirim file data RFQS kepada <?php echo $to; ?> ?</p>
                    <div class="col-sm-8 col-md-8 col-lg-8 datapanel">
                        <input class="form-control" type="hidden" value="<?php echo $id; ?>" name="id"/>
                        <div class="edit-group">
                            <label>TO</label>
                            <input class="form-control" type="text" value="<?php echo $to; ?>" name="to"/>
                        </div>
                        <div class="edit-group">
                            <label>Subject</label>
                            <input class="form-control" type="text" value="<?php echo $subject; ?>" name="subject"/>
                        </div>
                        <div class="edit-group">
                            <label>Message</label>
                            <textarea rows="6" class="form-control" name="message"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="pull-left command-container">
                <a class="btn btn-default btn-sm" style="margin-top:20px;" href="quot_s?rfqs_id=<?php echo $id; ?>">Cancel</a>
                <button id="crudexecute" class="btn btn-info btn-sm crudexecute" style="margin-top:20px;">Send Email</button>
            </div>
        </div>
    </form>
</div>