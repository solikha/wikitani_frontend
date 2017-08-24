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
<form id="edit-form" >
<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:5px; padding-right: 5px; padding-bottom: 10px">
    <div class="col-xs-12 col-sm-12">
        <div class="row" style="">
    <div class="col-sm-12 col-md-12 col-lg-12 datapanel" style="">
        <div class="edit-group" style="">
            <label for="userid"> User Id </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="userid" id="userid"
                style=""                 value="10" disabled />
        </div>
        <div class="edit-group" style="">
            <label for="rcust_id">Dealer</label>
            <select class="form-control crud-edit" 
                name="rcust_id" 
                id="rcust_id"
                data-lookup-paramlist=""
                data-lookup-refresh=""
                data-lookup-name="eddealerpusat"
                style=" background-color: #eee"                 value="71347" disabled >
                /r/n<option value=""  >--Pilih Dealer--</option>/r/n<option value="00000"  >Kantor Pusat</option>/r/n<option value="71347" selected >Existing</option>/r/n<option value="80001"  >Testing 001</option>/r/n<option value="80002"  >Testing 002</option>/r/n<option value="80003"  >Testing 003</option>/r/n<option value="80010"  >Testing 004</option>            </select>
        </div>
        
        <div class="edit-group" style="">
            <label for="username"> Username </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="username" id="username"
                style=""                 value="existing" 
                 
                 />
        </div>
        <div class="edit-group" style="">
            <label for="fullname"> Nama Lengkap </label>
            <input type="text" class="form-control crud-edit" placeholder="" 
                name="fullname" id="fullname"
                style=""                 value="User Existing" 
                 
                 />
        </div>
    </div>
</div>
    </div>                                                                    
</div>
<div class="row" style="">
    <div class="pull-left command-container" >
        <input type="submit" value="Test" class="btn btn-default btn-sm" style="margin-top:20px;">
        <button data-dismiss="modal" id="canceledit" class="btn btn-default btn-sm" style="margin-top:20px;">Cancel</button>
        <button id="crudexecute" class="btn btn-info btn-sm crudexecute" style="margin-top:20px;">OK</button>
    </div>                                                                    
</div>
</form>