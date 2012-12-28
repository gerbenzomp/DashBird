
<div class="head"><h1>Manage Pages</h1><a href="<?=base_url();?>pages/edit" class="add" title="add page"><img src="<?=base_url();?>application/views/backend/img/add.png" /></a>


<div class="clear"></div>
</div>

<div class="content">


<div class="nav"></div>



<div class="main">


<div class="note">Drag to reorder pages</div>




<ul id="sortable">
<?php
$this->db->order_by('order_id');
$this->db->where('blog', $this->session->userdata('blog'));
$q=$this->db->get('pages');
foreach($q->result() as $item){
	?>
    <li class="box" id="page_<?=$item->id;?>"><table width="100%" border="0">
  <tr>
    <td><a href="<?=base_url();?>pages/edit/<?=$item->id;?>"><?=$item->title;?></a></td>
    <td>&nbsp;</td>
    <td align="right"><a href="<?=base_url();?>pages/delete/<?=$item->id;?>"><img src="<?=base_url();?>application/sources/icons/cross.png" title="delete" /></a></td>
  </tr>
</table>
</li>
    <?php
}
?>
</ul>
<br />
<input name="button" type="button" value="save" onclick="save();" class="uniform" />

</div>
<div style="clear: both;"></div>

<script type="text/javascript">

				

	$(function() {
		$( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
	});
	
	function save(){
		var order = $( "#sortable" ).sortable( "serialize");
		
		$.ajax({
		
		    type: "POST",
			url: "<?=base_url();?>manage/reorder/pages",
			data: { orderdata: order }

		  
		}).done(function() { 
		  $('.note').animate({'background-color': '#99cc99', 'borderColor': 'green'}, 1000).html('Changes were saved.');
		   $('.note').animate({'background-color': '#ffffcc', 'borderColor': '#ffcc66'}, 1000, function() {
    // Animation complete.
	$('.note').html('Drag to reorder pages');
  });
		});
	}
			

</script>


</div>