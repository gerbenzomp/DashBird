
<div class="head">

<h1>Manage Posts</h1>

<!--
 <div style=" margin-left: 365px; margin-top: 13px;"><a href="<?=base_url();?>posts/fs_init/home">add post</a></div>
   -->
  
<a href="<?=base_url();?>posts/fs_init/home" class="add" title="add post""><img src="<?=base_url();?>application/views/backend/img/add.png" /></a>
 
    
    <div class="clear"></div>
   </div>






<div class="content">





<div class="nav">
 <div class="description">Choose page:</div><br />
<ul id="tabs">
<?php
$this->db->order_by('order_id');
$this->db->where('blog', $this->session->userdata('blog'));
$q=$this->db->get('pages');
foreach($q->result() as $item){
	?>
<li><a href="<?=base_url();?>manage/posts/<?=$item->url;?>"<?php if($page==$item->url){ echo " style='background-color: white; border-right: 0;'"; } ?>><?=$item->title;?></a></li>
    
    <?php
	
}
?>

</ul>

</div>

<div class="main">


<!--
<div class="note">Drag to reorder posts</div>
-->


<ul id="sortable">
<?php
$this->db->order_by('created desc');
$this->db->where('blog', $this->session->userdata('blog'));
$this->db->where('page', $page);
$this->db->where('visible', 1);
$q=$this->db->get('posts');

if($q->num_rows()==0){
	?>
    <div class="note">There are no posts on this page. <a href="<?=base_url();?>posts/fs_init/home">Add a post.</a></div>
    <?php
}

if($q->num_rows()>0){
foreach($q->result() as $item){
	?>
    <li class="box" id="page_<?=$item->id;?>"><table width="100%" border="0">
  <tr>
  
    <td><a href="<?=base_url();?>posts/fs_edit/<?=$item->id;?>/<?=$item->type;?>"><?=$item->title;?></a></td>
    <td>&nbsp;</td>

    <td width="15" align="right">
	
   
	<!--
	<?php if($item->publish==0){ ?>
        <a href="<?=base_url();?>posts/publish/<?=$item->id;?>/1"><img src="<?=base_url();?>application/sources/icons/unpublished.png" border="0" title="publish" style="margin-right: 3px;" class="unpublished" /></a>
         <?php }else{ ?>
         
               <a href="<?=base_url();?>posts/publish/<?=$item->id;?>/0"><img src="<?=base_url();?>application/sources/icons/published.png" border="0" title="unpublish" style="margin-right: 3px;" class="published" /></a>
         <?php } ?>
         
      -->   
         
         </td>
    <td width="15" align="right">
    <!--
    <a href="<?=base_url();?>posts/delete/<?=$item->id;?>"><img src="<?=base_url();?>application/sources/icons/cross.png" title="delete" /></a>
    -->
    
      <?php if($item->publish==0){ ?>
        <a href="<?=base_url();?>posts/publish/<?=$item->id;?>/1"><img src="<?=base_url();?>application/sources/icons/unpublished.png" border="0" title="publish" style="margin-right: 3px;" class="unpublished" /></a>
         <?php }else{ ?>
         
               <a href="<?=base_url();?>posts/publish/<?=$item->id;?>/0"><img src="<?=base_url();?>application/sources/icons/published.png" border="0" title="unpublish" style="margin-right: 3px;" class="published" /></a>
         <?php } ?>
    
    
    </td>
  </tr>
</table>
</li>
    <?php
}
?>
</ul>
<br />
<!--
<input name="button" type="button" value="save" onclick="save();" />
-->
<?php } ?>

</div>




<div style="clear: both;"></div>

<script type="text/javascript">

	/*			

	$(function() {
		$( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
	});
	
	function save(){
		var order = $( "#sortable" ).sortable( "serialize");
		
		$.ajax({
		
		    type: "POST",
			url: "<?=base_url();?>manage/reorder/posts",
			data: { orderdata: order }

		  
		}).done(function() { 
		  $('.note').animate({'background-color': '#99cc99', 'borderColor': 'green'}, 1000).html('Changes were saved.');
		   $('.note').animate({'background-color': '#ffffcc', 'borderColor': '#ffcc66'}, 1000, function() {
    // Animation complete.
	$('.note').html('Drag to reorder posts');
  });
		});
	}
			
*/
</script>
</div>