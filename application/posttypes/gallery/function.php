
<?php


$this->db->where('post_id', $id);
$this->db->order_by('order_id');
$q=$this->db->get('files');


if($q->num_rows()>0){
	
	
	
	?>
    
    <ul class="images editscreen_big" id="edit-<?=$id;?>">
    <?php
	
foreach($q->result() as $file){
	
	

	
	?>
    <li class="image"><img src="<?=base_url();?>uploads/thumb.php?src=<?=$this->session->userdata('blog');?>/<?=$file->filename;?>&w=100&h=100&zc=1" /></li>
    <?php
	
}

?>
</ul>


<br />


<?php
}
else
{
?>

<div class="editscreen_big droparea" id="edit-<?=$id;?>">



Click to create a gallery



</div>

<?php } ?>

 
