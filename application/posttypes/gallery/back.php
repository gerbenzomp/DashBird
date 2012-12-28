

<!-- <div class="note">Use the shift key to select multiple images at once. Drag to reorder images.</div>
<br />-->
Upload images:
<div id="file-uploader-demo1"></div>

<br />
 <script>        
        function createUploader(){  
		
		
		
		          
            var uploader = new qq.FileUploader({
                element: document.getElementById('file-uploader-demo1'),
                action: '<?=base_url();?>upload/upload_multi/<?=$id;?>',
				uploadButtonText: '',
				onComplete: function(id, fileName, response){
					
					
					$('#files-<?=$id;?>').append('<li id="page_'+response.id+'" class="edit_image"><img src="<?=base_url();?>uploads/thumb.php?src=<?=$this->session->userdata('blog');?>/'+fileName+'&w=100&h=100&zc=1" /></li>');
				},
                debug: false
                
            });           
        }
        
    
       createUploader();
	 
    </script> 

  <ul id="files-<?=$id;?>" class="edit_images">
<?php

$this->db->where('post_id', $id);
$this->db->order_by('order_id');
$q=$this->db->get('files');


if($q->num_rows()>0){

foreach($q->result() as $file){


	?>
    <li id="page_<?=$file->id;?>" class="edit_image"><img src="<?=base_url();?>uploads/thumb.php?src=<?=$this->session->userdata('blog');?>/<?=$file->filename;?>&w=100&h=100&zc=1" /></li>
    <?php
	
}

}
?>
</ul>
     
   <br />
    
 <a href="javascript:void(0);" onclick="saveOrder();"><img src="<?=base_url();?>application/sources/img/save.png" border="0" style="margin-left: -2px;" /></a>
    
    
    
    <script type="text/javascript">
	
	
	$(function() {
		$( "#files-<?=$id;?>" ).sortable({
			helper : 'clone', // somehow prevents onclick behaviour
			/*
			update: function(event, ui) {
	
			}
			*/
			
		});
		$( "#files-<?=$id;?>" ).disableSelection();
	});
	
	
	$('.edit_image').click(function(){
	

	var id = $(this).attr('id');
	showModal('Edit Image', '<?=base_url();?>posts/edit_image/'+id);



	
	
});

function saveOrder(){
	name = "files-<?=$id;?>";
	

	 
		var order = $("#"+name).sortable( "serialize");
		
	
		
		$.ajax({
		
		    type: "POST",
			url: "<?=base_url();?>manage/reorder/files",
			data: { orderdata: order }

		  
		}).done(function() { 
		 	$('#function-<?=$id;?>').load('<?=base_url();?>post/show_function/<?=$id;?>');	
			$('#redactor_modal_inner').html(''); $('#redactor_modal').hide();

		});		
}

</script>


    



     
    


