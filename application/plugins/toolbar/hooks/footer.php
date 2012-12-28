<?php if(logged_in()){ ?>

<div id="memory" style="display: none;"></div>



<div id="redactor_modal" style="position: fixed; top: 50%; left: 50%; width: 570px; height: auto; margin-top: -188.5px; margin-left: -315px; display: none;">
<div id="redactor_modal_close" onclick="$('#redactor_modal_inner').html(''); $('#redactor_modal').hide();">×</div>
<div id="redactor_modal_header"></div>
<div id="redactor_modal_inner">
</div>
</div>

<script type="text/javascript">
function save(name){
		var order = $("#"+name).sortable( "serialize");
		
	
		
		$.ajax({
		
		    type: "POST",
			url: "<?=base_url();?>manage/reorder/files",
			data: { orderdata: order }

		  
		}).done(function() { 
		 

		});
	}
</script>


<?php } ?>