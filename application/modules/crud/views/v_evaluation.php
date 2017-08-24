<style>
</style>
	<div class="col-xs-12" style="background-color:rgb(239, 243, 248); padding-top: 8px; padding-left:20px; padding-right: 5px;">
	<div class="row">
		<div class="col-xs-6">
			<div class="row">
			<h3>Evaluation Quotation</h3>
			</div>
			<div class="row">
			<h5>RFQC ID</h5>
			</div>
			
			<div class="row">
			<input type="text" value="<?Php echo $dataevaluationc['rfqc_id']; ?>" id="rfqc_id" disabled>
			</div>
			<div class="row">
			<h5>Quot C ID</h5>
			</div>
			<div class="row">
			<input id="quotc_id" type="text" value="1" disabled>
			<p>Quot C ID digunakan untuk kembali ke screen sebelumnya</p>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top:10px; border:solid #dadada 1px;">
	<div class="col-xs-1">
		<div class="row">
			<table class="table table-striped table-bordered table-hover" id="sample-table-1">
				<thead>
					<tr>
					<td>Part Number</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php 
							foreach($dataevaluationc['detailrfqc'] as $element)
							{
						?>
						<td><?php echo $element['part_number']; ?></td>
						<input type="hidden" id="part_number" value="<?php echo $element['part_number'];?>">
						</tr>	
					   <?php
							}
						?>
					
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-xs-6">
		<table class="table table-striped table-bordered table-hover" id="tbrfqs" style="margin-left:-10px;">
		
			<thead>
				<tr>
				<th>Supplier</th>
				<th>Jumlah RFQS</th>
				<th>Jumlah Quotation</th>
				<th>Delivery Terms</th>
				<th>Quotations Price</th>
				<th>Selected</th>
				<th>Optional</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php 
					$i=0;
						foreach($dataevaluationc['detailrfqs'] as $element)
						{
						
					?>
					<td><?php echo $element['nama_supplier']; ?></td>
					<td><?php echo $element['rfq_qty']; ?></td>
					<td><?php echo $element['qoutation_qty']; ?></td>
					<td><?php echo $element['delivery_item']; ?></td>
					<td><?php echo $element['price']; ?></td>
					<td><input type="checkbox" id="<?php echo $i; ?>"></td>
					<td><input type="text" class="form-control"></td>
					</tr>	
				   <?php
				   $i=$i+1;
						}
				    ?>
				
			</tbody>
		</table>
	</div>
	
	<div class="col-xs-2">
		<div class="row">
			<table class="table table-striped table-bordered table-hover"  id="sample-table-1" style="/* margin-left:-10px;*/ margin-left:-10px;">
				<thead>
					<tr>
					<td>Jumlah Quotation</td>
					<td>Jumlah RFQC</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php 
							foreach($dataevaluationc['detailrfqc'] as $element)
							{
						?>
						<td><?php// echo $element['jumlah_quotation']; ?></td>
						<td><?php echo $element['jumlah_rfqc']; ?></td>
						</tr>	
					   <?php
							}
						?>
					
				</tbody>
			</table>
		</div>
	</div>	
	
	<div class="col-xs-1">
		<div class="row">
			<table class="table table-striped table-bordered table-hover"  id="sample-table-1" style="/* margin-left:-10px;*/ margin-left:-8px;">
				<thead>
					<tr>
					<td>Average<br/> Price</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php 
							foreach($dataevaluationc['dataavgprice'] as $element)
							{
						?>
						<td><?php echo $element['average_price']; ?></td>
						<input id="avg-price" class="form-control" type="hidden" value="<?php echo $element['average_price']; ?>">
						</tr>	
					   <?php
							}
						?>
					
				</tbody>
			</table>
		</div>
	</div>
	
		
	</div>
	
	</div>
	<div class="row" style="background-color:rgb(239, 243, 248); padding-top: px; padding-left:20px; padding-right: 5px;">
			<div class="col-xs-6">
				<button  id="btn-save-evaluation" class="btn-info">
				<i class="icon fa fa-floppy-o"></i>
				Save
				</button>
				<button class="btn-info">
				<i class="icon fa fa-reply"></i>
				Cancel
				</button>
				<button id="btn-back" onclick="back()" class="btn-info">
				<i class="icon fa fa-history"></i>
				Back
				</button>
			</div>
	</div>
<div id="modal-form" class="modal fade" tabindex="-1">
<div class="modal-content">
            <form method="POST" action="<?php echo base_url().'index.php/menu/save_evaluation?id='.$dataevaluationc['rfqc_id'];?>"> 
                <div class="modal-header" style="padding-top: 6px; padding-bottom: 0px">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue">Data Quotation</h4>
                </div>
                <div class="modal-body" style="padding-top: 6px; padding-bottom: 0px">
					<div id="data-quotation">
					</div>
                </div>
                <div class="modal-footer" style="margin-top: 6px">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancel
                    </button>

                    <button class="btn btn-sm btn-primary">
                        <i class="ace-icon fa fa-check"></i>
                        OK
                    </button>
                </div>
            </form>
        </div>        
    
</div>	
	<script src="<?php echo base_url();?>themes/aceadmin/js/jquery-2.0.3.min.js"></script><script type="text/javascript">
	function get_data_rfqs(rfqc_id){
		//mengosongkan nilai grand total supaya kembali ke siklus awal ketika masuk entri data item kembali
		//gtotal=0;
        var dellength = document.getElementsByTagName('table')[1].getElementsByTagName('tr').length - 1;
		
        var decrementrowlength = document.getElementsByTagName('table')[1].getElementsByTagName('tr').length - 1;
        var a = 0;
		var i=0;
        for (i = 0; i < dellength; i++) {
		
            a = a + 1;
            var tominimumrow = document.getElementsByTagName('table')[1].getElementsByTagName('tr').length - 1;
            var checktodel = document.getElementsByTagName('table')[1].getElementsByTagName('tr')[decrementrowlength].getElementsByTagName('td')[5].getElementsByTagName('input')[0];
            var checkid = 'checkbox' + String(decrementrowlength);
			var checked_supplier=document.getElementsByTagName('table')[1].getElementsByTagName('tr')[decrementrowlength].getElementsByTagName('td')[0].textContent;
            try {
                if (checktodel.checked == true) {
                    // $(document.getElementsByTagName('table')[1].children[decrementrowlength]).remove();
					alert('data quotation customer \n'+'nama supplier :' +checked_supplier+'\n'+'');
					
                }
            } catch (err) {
                alert(err.message);
            }
            decrementrowlength = decrementrowlength - 1;
			
			
        }
		
		//document.getElementById("grandtotal").textContent="Grand Total:"+ getgrandtotalawal();
    
	}
	  
	 
	 //basic untuk membuat modal adalah script ini:
	 OnReadyArray.push(function() {
        $('#btn-save-evaluation').click(function(){
		
            Manggu.Crud.showModal({
                width: 800,
                modalname: 'modal-form'
            });
		
		 var dellength = document.getElementsByTagName('table')[1].getElementsByTagName('tr').length - 1;
		
        var decrementrowlength = document.getElementsByTagName('table')[1].getElementsByTagName('tr').length - 1;
        var a = 0;
		var i=0;
        for (i = 0; i < dellength; i++) {
		
            a = a + 1;
            var tominimumrow = document.getElementsByTagName('table')[1].getElementsByTagName('tr').length - 1;
            var checktodel = document.getElementsByTagName('table')[1].getElementsByTagName('tr')[decrementrowlength].getElementsByTagName('td')[5].getElementsByTagName('input')[0];
            var checkid = 'checkbox' + String(decrementrowlength);
			var checked_supplier=document.getElementsByTagName('table')[1].getElementsByTagName('tr')[decrementrowlength].getElementsByTagName('td')[0].textContent;
			var checked_jum_rfqs=document.getElementsByTagName('table')[1].getElementsByTagName('tr')[decrementrowlength].getElementsByTagName('td')[1].textContent;
			var checked_jum_quots=document.getElementsByTagName('table')[1].getElementsByTagName('tr')[decrementrowlength].getElementsByTagName('td')[2].textContent;
            try {
                if (checktodel.checked == true) {
					//$('#data-quotation').append('Nama Supplier :'+checked_supplier+'<br>');
					//$('#data-quotation').append('Jumlah RFQS :'+checked_jum_rfqs+'<br>');
					///$('#data-quotation').append('Jumlah QUOTS :'+checked_jum_quots+'<br>');
					
					
                }
            } catch (err) {
                alert(err.message);
            }
            decrementrowlength = decrementrowlength - 1;
			
			
        }
		
		
		$('#data-quotation').append('<div class="row">');
		$('#data-quotation').append('<label>Part Number</label>');
		$('#data-quotation').append('</div>');
		$('#data-quotation').append('<div class="row">');
		$('#data-quotation').append('<input type="text" name="part_number" value='+$("#part_number").val()+'><br>');
		$('#data-quotation').append('</div>');
		
		
		$('#data-quotation').append('<div class="row">');
		$('#data-quotation').append('<label>Average Price</label>');
		$('#data-quotation').append('</div>');
		$('#data-quotation').append('<div class="row">');
		$('#data-quotation').append('<input type="text" name="avg_price" value='+$("#avg-price").val()+'><br>');
		$('#data-quotation').append('</div>');
		
		//$('#data-quotation').append('Average Price :'+$('#avg-price').text()+'<br>');
        });
     });

	 function back(rfqc_id){
			 window.location.href="<?php echo base_url().'index.php/menu/quot_c?quotc_id='?>"+$("#quotc_id").val();
     }
	 
	// http://localhost/gas-pp/index.php/menu/quot_c?quotc_id=2
	 
	 
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
	
	</script>