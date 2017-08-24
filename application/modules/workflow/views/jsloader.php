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
<script>
//    OnReadyArray.push(function(){
//        data = <?php echo(json_encode($workflowdata)); ?>;
//        for(var vname in data){
//            vval = data[vname];
//            $('#'+vname).val(vval);
//        }
//    });
 
   OnReadyArray.push(function(){
        data = <?php echo(json_encode($workflowdata)); ?>;
        for(var vname in data){
            vval = data[vname];
            $('#'+vname).val(vval);
			
			//console.log(vname);
        }
		$('.duplicate-field').each(function( index, element ) {
		  id = $(element).attr('id');
		  vval = data[id];
		  $(element).val(vval);
		  console.log(id);
		  console.log(vval);
		  //console.log( index + ": " + $( this ).text() );
		});			
    });
    
</script>
