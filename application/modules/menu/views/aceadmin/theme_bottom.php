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
        <!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo $assetdir; ?>js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo $assetdir; ?>js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo $assetdir; ?>js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo $assetdir; ?>js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="<?php echo $assetdir; ?>js/excanvas.min.js"></script>
		<![endif]-->
		<script src="<?php echo $assetdir; ?>js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/jquery.easypiechart.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/jquery.sparkline.min.js"></script>
            
		<!-- ace scripts -->
		<script src="<?php echo $assetdir; ?>js/ace-elements.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/ace.min.js"></script>
                <script src="<?php echo $assetdir; ?>js/ace/ace.sidebar-scroll-1.js"></script>
                
                
                <script src="<?php echo $assetdir; ?>js/dataTables/jquery.dataTables.js"></script>
		<script src="<?php echo $assetdir; ?>js/dataTables/jquery.dataTables.bootstrap.js"></script>
		<script src="<?php echo $assetdir; ?>js/dataTables/extensions/buttons/dataTables.buttons.js"></script>
		<script src="<?php echo $assetdir; ?>js/dataTables/extensions/buttons/buttons.flash.js"></script>
		<script src="<?php echo $assetdir; ?>js/dataTables/extensions/buttons/buttons.html5.js"></script>
		<script src="<?php echo $assetdir; ?>js/dataTables/extensions/buttons/buttons.print.js"></script>
		<script src="<?php echo $assetdir; ?>js/dataTables/extensions/buttons/buttons.colVis.js"></script>
		<script src="<?php echo $assetdir; ?>js/dataTables/extensions/select/dataTables.select.js"></script>
                
                <script src="<?php echo $assetdir; ?>js/chosen.jquery.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/fuelux/fuelux.spinner.min.js"></script>
                
                
                <script src="<?php echo $assetdir; ?>js/date-time/bootstrap-datepicker.js"></script>
		<script src="<?php echo $assetdir; ?>js/date-time/bootstrap-timepicker.js"></script>
		<script src="<?php echo $assetdir; ?>js/date-time/moment.js"></script>
		<script src="<?php echo $assetdir; ?>js/date-time/daterangepicker.js"></script>
		<script src="<?php echo $assetdir; ?>js/date-time/bootstrap-datetimepicker.js"></script>
                
		<script src="<?php echo $assetdir; ?>js/bootstrap-colorpicker.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/bootstrap-wysiwyg.js"></script>
		<script src="<?php echo $assetdir; ?>js/elements.wysiwyg.js"></script>
		
		<script src="<?php echo $assetdir; ?>js/jquery.knob.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/autosize.js"></script>
		<script src="<?php echo $assetdir; ?>js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/jquery.maskedinput.min.js"></script>
		<script src="<?php echo $assetdir; ?>js/bootstrap-tag.min.js"></script>

                <script src="<?php echo $assetdir; ?>js/dropzone.min.js"></script>
                <script src="<?php echo $assetdir; ?>js/bootbox.min.js"></script>
                
                <script src="<?php echo $assetdir; ?>js/jquery.easypiechart.min.js"></script>
                <script src="<?php echo $assetdir; ?>js/flot/jquery.flot.min.js"></script>
                <script src="<?php echo $assetdir; ?>js/flot/jquery.flot.pie.min.js"></script>
                <script src="<?php echo $assetdir; ?>js/flot/jquery.flot.resize.min.js"></script>
                <script src="<?php echo $assetdir; ?>js/jquery.gritter.min.js"></script>
                <script src="<?php echo $assetdir; ?>js/jquery.slimscroll.min.js"></script>
                
                <script src="<?php echo $libsurl; ?>typeahead/typeahead.jquery.js"></script>
                <script src="<?php echo $libsurl; ?>typeahead/bloodhound.js"></script>
		<script type="text/javascript">
                    $(document).ready(function(){
                            /*------ Dropzone Init ------*/
                            $(".dropzone").dropzone({maxFilesize: 8});
                            
                            /*$('.scrollable').each(function () {
					var $this = $(this);
					$(this).ace_scroll({
						size: $this.attr('data-size') || 100,
						//styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
					});
				});
                            */    
                            $('.slim-scroll').each(function () {
					var $this = $(this);
					$this.slimScroll({
						height: $this.data('height') || 100,
						railVisible:true
					});
				});
                                

                    });

		</script>
