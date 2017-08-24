<style>
</style>
	<div class="col-xs-12" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:20px; padding-right: 5px;" >
	<div class="row" >
		<div class="col-xs-6">
			<div class="row">
			<h3>Quotation Customer</h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6">
		<div class="row">
			<label>Cust RFQ No</label>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-4">
			<div class="row">
				<input id="rfq_number" type="text" disabled class="form-control" value="<?php echo $dataquotationc['rfq_number']; ?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-5">
			<div class="row">
				<label>To</label>
			</div>
			<div class="row">
				<textarea id="to" class="form-control" disabled><?php echo $dataquotationc['ship_to']; ?></textarea>
			</div>
		</div>
		<div class="col-xs-5" style="margin-left:30px">
			<div class="row">
				<label>Ship To</label>
			</div>
			<div class="row">
				<textarea class="form-control" id="ship_to" disabled><?php echo $dataquotationc['ship_to']; ?></textarea>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-3">
			<div class="row">
				<label>Quote Date</label>
			</div>
			<div class="row">
				<div class="edit-group" style="">
						<div class="input-group">
							<input class="form-control date-picker" id="date" name="date" data-date-format="dd-mm-yyyy" type="text" disabled value="<?php echo $dataquotationc['date']; ?>" />
							<span class="input-group-addon">
							<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
					<script>
					
					</script> 
			</div>
		</div>
		<div class="col-xs-3" style="margin-left:40px">
			<div class="row">
				<label>Terms Of Payment</label>
			</div>
			<div class="row">
				<select id="terms" class="form-control" disabled>
				<option><?php echo $dataquotationc['terms']; ?></option>
				<option>Credit</option>
				<option>Cash</option>
				</select>
			</div>
		</div>	
	</div>
	<div class="row">
		<div class="col-xs-3">
			<div class="row">
				<label>Description</label>
			</div>
			<div class="row">
				<textarea  id="description" class="form-control" disabled><?php echo $dataquotationc['description']; ?></textarea>
			</div>
		</div>
	</div>
	
	<div class="row" style="padding-top:20px; padding-bottom:20px;" >
		<div class="col-xs-3">
			<div class="row">
				<button class="btn-info" id="" onclick="evaluation_quotation(<?php echo $dataquotationc['rfqc_id']; ?>)">
				<i class="ace-icon fa fa-bug align-top bigger-125"></i>
				Evaluation Quotation</button>
			</div>
		</div>
		<div class="col-xs-3" style="margin-left:40px">
			<div class="row">
				<button id="btn_edit_header" class="btn-info">
				<i class="icon fa fa-edit"></i>
				Edit Header
				</button>
				<button id="btn_save_header" class="btn-info">
				<i class="icon fa fa-floppy-o"></i>
				Save
				</button>
			</div>
		</div>
	</div>
	</div>
	<div class="row" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:20px; padding-right: 5px;">
		<table class="table table-striped table-bordered table-hover" id="sample-table-1">
			<thead>
				<tr>
				<td>Actions</td>
				<td>Part Number</td>
				<td>Part Deskription</td>
				<td>Qty</td>
				<td>Cust Price</td>
				<td>Condition</td>
				<td>Supplier</td>
				<td>Supplier Price</td>
				</tr>
			</thead>
			<tbody id="tbody_barang">
					<tr>
					<?php 
						foreach($dataquotationc['detail'] as $element)
						{
					?>
					<td>
						<button data-target="" data-modalwidth="960" data-action="edit" class="rowactionbutton btn btn-minier btn-info" id="<?php //echo $element['id']; ?>" onclick="edit_detail(this.id)">
						<i class="icon fa fa-edit"></i>
						</button>
						<button data-target="" data-modalwidth="960" data-action="delete" class="rowactionbutton btn btn-minier btn-danger" >
                            <i class="icon fa fa-fire"></i>
                        </button>
					</td>
					<!--<td><?php //echo $element['id']; ?></td>-->
					<td><?php echo $element['part_number']; ?></td>
					<td><?php echo $element['description']; ?></td>
					<td><?php echo $element['qty']; ?></td>
					<td><?php// echo $element['price']; ?></td>
					<td><?php // echo $element['condition']; ?></td>
					<td><?php //echo $element['nama_supplier']; ?></td>
					<td><?php //echo $element['supplier_price']; ?></td>
					</tr>	
				   <?php
						}
				    ?>
            </tbody>
		</table>
		<div class="row">
			<div class="col-xs-6">
				<button class="btn-info">
				<i class="ace-icon fa fa-file-pdf-o align-top bigger-125"></i>
				Print PDF
				</button>
				<button class="btn-info">
				<i class="ace-icon fa fa-envelope-o align-top bigger-125"></i>
				Send Email
				</button>
			</div>
		</div>
	</div>	
<div id="modal-form" class="modal fade" tabindex="-1">
<div class="modal-content">
            <form method="POST" enctype="multipart/form-data" name="docform" id="docform"> 

                <input type="hidden" id="modal_workflowid" name="workflowid" value="1" />

                <div class="modal-header" style="padding-top: 6px; padding-bottom: 0px">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue">Edit Quotation:</h4>
                </div>
                <div class="modal-body" style="padding-top: 6px; padding-bottom: 0px">
				<div class="row">
					<div class= "col-xs-5">
						<div class="row">
							<label>Part Number</label>
						</div>
					</div>
					<div class= "col-xs-6">
						<div class="row">
							<input type="text" class="form-control" id="part_number">
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px;" >
					<div class= "col-xs-5">
						<div class="row">
							<label>Description</label>
						</div>
					</div>
					<div class= "col-xs-6">
						<div class="row">
							<textarea class ="form-control" id="description_modal"></textarea>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px;" >
					<div class= "col-xs-5">
						<div class="row">
							<label>Qty</label>
						</div>
					</div>
					<div class= "col-xs-6">
						<div class="row">
							<input type="text" class="form-control" id="qty">
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px;" >
					<div class= "col-xs-5">
						<div class="row">
							<label>Quoted Price</label>
						</div>
					</div>
					<div class= "col-xs-6">
						<div class="row">
							<input type="text" class="form-control" id="price">
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px;" >
					<div class= "col-xs-5">
						<div class="row">
							<label>Condition</label>
						</div>
					</div>
					<div class= "col-xs-6">
						<div class="row">
							<input type="text" class="form-control" id="condition">
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px;" >
					<div class= "col-xs-5">
						<div class="row">
							<label>Supplier</label>
						</div>
					</div>
					<div class= "col-xs-6">
						<div class="row">
							<input type="text" class="form-control" id="supplier">
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:20px;" >
					<div class= "col-xs-5">
						<div class="row">
							<label>Supplier Price</label>
						</div>
					</div>
					<div class= "col-xs-6">
						<div class="row">
							<input type="text" class="form-control" id="supplier_price">
						</div>
					</div>
				</div>	
                </div>
                <div class="modal-footer" style="margin-top: 6px">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>

                    <button class="btn btn-sm btn-primary">
                        <i class="ace-icon fa fa-check"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>        
    
</div>	
	<script src="<?php echo base_url();?>themes/aceadmin/js/jquery-2.0.3.min.js"></script><script type="text/javascript">
	  OnReadyArray.push(function() {
        $('#btn_edit_header').click(function(){
		
           $('#rfq_number').prop("disabled", false);
		    $('#to').prop("disabled", false);
			$('#ship_to').prop("disabled", false);
			$('#date').prop("disabled", false);
			$('#prepaid').prop("disabled", false);
			$('#description').prop("disabled", false);
			$('#terms').prop("disabled", false);
			$('#btn_edit_header').prop("disabled", true);
			$('#btn_save_header').prop("disabled", false);
			
        });
     });
	 
	 $('#btn_save_header').click(function(){
	 $('#btn_edit_header').prop("disabled",false);
	   $('#btn_save_header').prop("disabled", true);
	    $('#rfq_number').prop("disabled", true);
		    $('#to').prop("disabled", true);
			$('#ship_to').prop("disabled", true);
			$('#date').prop("disabled", true);
			$('#prepaid').prop("disabled",true);
			$('#description').prop("disabled", true);
			$('#terms').prop("disabled", true);
	 });
	 
	 
	  OnReadyArray.push(function() {
        $('#btn_edit_detail').click(function(){
            Manggu.Crud.showModal({
                width: 800,
                modalname: 'modal-form'
            });
        });
     });
	 
	 /*
	 basic untuk membuat modal adalah script ini:
	 OnReadyArray.push(function() {
        $('#btn_tambah').click(function(){
            Manggu.Crud.showModal({
                width: 800,
                modalname: 'modal-form'
            });
        });
     });
	 */
		function evaluation_quotation(rfqc_id){
		//alert(rfqc_id);
		 window.location.href="<?php echo base_url().'index.php/menu/evaluation?id='?>"+rfqc_id;
		}
	 
	OnReadyArray.push(function(){
	$('.date-picker').datepicker({
	autoclose: true,
	todayHighlight: true
	})
	//show datepicker when clicking on the icon
	.next().on(ace.click_event, function(){
	$(this).prev().focus();
	});
	});	

	 OnReadyArray.push(function() {
     loaddata(); 
     });
	
	
	function edit_detail(id){
	//$("#part_number").text(obj[0]['part_number']);
	var targeturl="<?php echo base_url().'index.php/crud/c_quotationc/get_editdetail'?>";
	$.ajax({
	url:targeturl,
	data:{
		id:id	
	},
	type: "POST",
	success: function (data) {
	//alert('ajax ok');
	var obj = JSON.parse(data);	
	//alert(obj[0]['id']+obj[0]['part_number']+obj[0]['description']);	
	 Manggu.Crud.showModal({
                width: 800,
                modalname: 'modal-form'
     });
	 $("#part_number").val(obj[0]['part_number']);
	 $("#description_modal").val(obj[0]['description']);
	 $("#qty").val(obj[0]['qty']);
	 $("#price").val(obj[0]['price']);
	 $("#condition").val(obj[0]['condition']);
	 $("#supplier").val(obj[0]['nama_supplier']);
	 $("#supplier_price").val(obj[0]['supplier_price']);
	},
	error: function (jqXHR, textStatus, errorThrown) {
	alert('ajax not succesfull'+ errorThrown);
	console.log("ERRORS : " + errorThrown);
	}
				
	});
	 
	 
	}
	
	</script>