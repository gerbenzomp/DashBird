<form>


<div class="head">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td><h1>Add Post</h1><div style=" margin-left: 325px; margin-top: 13px;"><a href="<?=base_url();?>">cancel</a></div></td>
    <td>&nbsp;</td>
    <td align="right" valign="top"><div style="margin-right: 13px; margin-top: 7px;"><a href="javascript: void(0);" onclick="save();"><img src="<?=base_url();?>application/sources/img/save.png" border="0" /></a></div></td>
  </tr>
  </table>

<?php /*
<h1>Edit Post</h1><a href="javascript: void(0);" onclick="showModal('Post Settings', '<?=base_url();?>posts/settings/<?=$post['id'];?>');"><img src="<?=base_url();?>application/sources/icons/cog2.png" border="0" class="add" /></a>
*/ ?>


<div class="clear"></div>
</div>

<div class="content" id="content">



<div class="nav">

<ul id="tabs">

<?php
$id = $post['id'];

extract($post);

/*
$posttypes = listFiles('posttypes');

sort($posttypes);

foreach($posttypes as $item){
	?><li>
    <a href="<?=base_url();?>posts/fs_change_type/<?=$post['id'];?>/<?=$item;?>"<?php if($this->uri->segment(4)==$item){ echo " style='background-color: white; border-right: 0;'"; }?>><?php echo ucwords($item); ?></a>
    </li>
    <?php
	
}
*/
?>


<li><a href="#tab1" class="tinytabs current">Title and Body text</a></li>

<li><a href="#tab2" class="tinytabs">Extended Text</a></li>


<li><a href="#tab3" class="tinytabs" style="border-bottom: 1px solid #CCC;">Photo Gallery</a></li>



<br />
<br />
Options:<br />
<li><a href="#tab4" class="tinytabs">Options</a></li>

<?php if($visible==1){ ?>
<li><a href="#delete" class="tinytabs">Delete</a></li>
<?php } ?>


</ul>

</div>


<div class="main">

<div class="saved" style="display: none;">Changes were saved</div>





<div id="tab1" class="tinycontent">


Title<br />
<input type="text" name="title" class="uniform" style="font-size: 22px;" size="65" value="<?=$post['title'];?>">  
<br><br>



<?php

	// allows you to add options
	$inc = lookForFile('below_title', $this->uri->segment(4));
	if($inc!=FALSE){
	include($inc);
	}
	
?>


Body<br>
<textarea name="body" style="width: 100%;" rows="8" id="body"><?=$post['body'];?></textarea>

<?php if($this->uri->segment(4)!='article'){ ?>
<br><br>
<?php } ?>

<input name="page" type="hidden" value="<?=$post['page'];?>">

<input name="type" type="hidden" value="<?=$this->uri->segment(4);?>">

<input name="col" type="hidden" value="main">

</div>

<div id="tab2" class="tinycontent">

Extended<br>
<textarea name="extended" style="width: 100%;" rows="8" id="extended"><?=$post['extended'];?></textarea>

</div>

<div id="tab3" class="tinycontent">

<?php
$this->load->library('upload');
echo modules::run('upload/uploader', 'gallery', $post['id']);

?>

</div>

<div id="tab4" class="tinycontent">


Publish<br />

<select style="opacity: 0;" class="uniform" name="publish">

<option value="0"<?php if($post['publish']==0){ echo " selected"; } ?>>No</option>
<option value="1"<?php if($post['publish']==1){ echo " selected"; } ?>>Yes</option>

</select>
<br />
<br />
Page<br />

<select style="opacity: 0;" class="uniform" name="page">
<?php
$this->db->where('blog', $this->session->userdata('blog'));
$this->db->order_by('order_id');
$q=$this->db->get('pages');

foreach($q->result() as $p){
?>
<option value="<?=$p->url;?>"<?php if($post['page']==$p->url){ echo " selected"; } ?>><?=$p->title;?></option>
<?php } ?>
</select>

<br /><br />
Author:<br />
<input name="author" type="text" size="30" class="uniform" value="<?php if($post['author']==''){ echo $this->session->userdata('username'); } ?>">
<br /><br />


Tags (comma-separated):<br />
<input name="tags" type="text" value="<?php echo $tags; ?>" id="tags" style="display: none;">



<br /><br />

<script>
        $(document).ready(function() {
			
var sampleTags = [<?php
$alltags = '';
$this->db->where('blog', $this->session->userdata('blog'));
$this->db->where('tags !=', '');
$q=$this->db->get('posts');
foreach($q->result() as $item){
	
	
	$alltags .= str_replace(' ', '', strtolower($item->tags));
}


$arr = explode(',', $alltags);

$array = array_count_values($arr);

foreach($array as $key=>$value){
	
	if($value>1){
		
		?>'<?=$key;?>', <?php
		
	}
	
}

?>'blogbird'];
	
            $('#tags').tagit({
                availableTags: sampleTags
            });
			
			
		});
</script>


<br />



</div>

<div id="delete" class="tinycontent">

<div class="warning" style="text-align: center;">
<strong>Warning:</strong> are you sure you wish to delete this post? This cannot be undone.
</div>



<div style="text-align: center; width: 250px; margin: 0 auto; padding: 15px;" id="delete_pre"><a class="uniform" onclick="$('#delete_final').show(); $('#delete_pre').hide();">Yes, I'm sure.</a></div>


<div id="delete_final" style="display: none;">

<div class="warning" style="text-align: center;">
<strong>Really?</strong> after this button press there's no way back. Pfff. Gone.
</div>

<br /><br /><br />
<div style="text-align: center; width: 250px; margin: 0 auto; padding: 15px;"><a href="<?=base_url();?>posts/delete/<?=$id;?>" class="uniform">Delete this post now.</a></div>

</div>
</div>

<div class="function" id="function-<?=$post['id'];?>">
<?php
/*
// allows you to override in themes folder
	$inc = lookForFile('function', $this->uri->segment(4));
	include($inc);
	*/
	?>
 </div>  


<?php /*

*/ ?>



</div>

</form>

<div id="redactor_modal" style="position: fixed; top: 50%; left: 50%; width: 570px; height: auto; margin-top: -188.5px; margin-left: -315px; display: none;">
<div id="redactor_modal_close" onclick="$('#redactor_modal_inner').html(''); $('#redactor_modal').hide();">×</div>
<div id="redactor_modal_header"></div>
<div id="redactor_modal_inner">
</div>
</div>

<script type="text/javascript" charset="utf-8">
	
	
	
      $(function(){
		  
		  
		
		 $('.editscreen').click(function(){
					var id = $(this).attr('id');
					showModalBig("Edit", "<?=base_url();?>posts/configure/"+id);
			});
			
		
		
      });
	  
	  function showModal(title, url){
$('#redactor_modal_header').html(title);
$('#redactor_modal_inner').load(url, function() {
   $("#redactor_modal input, #redactor_modal textarea, #redactor_modal select, #redactor_modal button").uniform();
   $('#redactor_modal').show();
});


}
	  
	  
	  function showModalBig(title, url){
		$('#redactor_modal').css('width', '800px');
		$('#redactor_modal_header').html(title);
		$('#redactor_modal_inner').load(url, function() {
		   $("#redactor_modal input, #redactor_modal textarea, #redactor_modal select, #redactor_modal button").uniform();
		   $('#redactor_modal').show();
		});


	}
	  
	 function save(){
		var mydata = $("form").serialize();
		
		$.ajax({
		
		    type: "POST",
			url: "<?=base_url();?>posts/fs_save/<?=$post['id'];?>",
			data: { formdata: mydata }

		  
		}).done(function() { 
	
	  
   $('.head').append('<a href="<?=base_url();?>post/<?=$id;?>" style="position: absolute; top: 95px; padding-left: 5px;">&laquo; View article</a>');
   $('.head').animate({'background-color': '#99cc99'}, 1000, function() {
   $('.head').animate({'background-color': '#EEE'});
 
   
  });
		});
	} 
	  
	  
	  $('.editable').hover(function() {
					
				$(this).css('background-color', '#ffffcc');
				
				
				 
				  $(this).click(function(){
					
					  $(this).css('background-color', 'transparent');
					});
				 
				
				 
				},
				function () {
					 $(this).css('background-color', 'transparent');
				}
				
				
		);
	  
</script>	  
<br /><br />
<div style="clear: both;"></div>
</div>


</div>