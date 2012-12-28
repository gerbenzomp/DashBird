 <div class="post">
 
<div class="content"> 

<?php echo $edit_buttons; ?>
  
     


<h2 id="title-<?=$id;?>" class="edit_single editable"><?=$post['title'];?></h2>






<div id="body-<?=$id;?>" class="edit_rich editable" data-button-class="all">
<p><?=$body;?></p>
</div>



<div class="function" id="function-<?=$id;?>">
<?php
// allows you to override in themes folder
	$inc = lookForFile('function', $type);
	include($inc);
	?>
</div>



         
     <?php 
	 if(is_numeric($this->uri->segment(3))){
	?>
    <br />
    <?php	 
	$mydata['post'] = $post;
	 hook('after-detail', $mydata);
	 }
	 ?>       

<ul>
<?php
$this->db->where('post_id', $id);
$this->db->where('type', 'gallery');
$this->db->order_by('order_id');
$q=$this->db->get('files');
foreach($q->result() as $file){
	?>
    <li style="display: inline;"><a class="group" rel="group" title="<?=$file->title;?>" href="<?=base_url();?>uploads/<?=$this->session->userdata('blog');?>/<?=$file->filename;?>"><img src="<?=base_url();?>uploads/thumb.php?src=<?=$this->session->userdata('blog');?>/<?=$file->filename;?>&w=100&h=100&zc=1" /></a></li>
    
    <?php
	
}
?>
</ul>        
    </div>
    
    
     <div class="meta">  
     
     <div style="padding-left: 15px; margin-top: -5px;">
     <h2 style="margin-bottom: 0;" id="created-<?=$post['id'];?>"><?=date("j M Y", strtotime($post['created']));?></h2>
     by <a href="<?=site_url();?>">CineBlah</a>
    
    
    <?php 
	$hookdata = array('url'=>site_url()."post/".$id."/".$url);
	hook('after-meta', $hookdata); ?>
     
     </div>
     </div>
    
     <div style="clear: both;"></div>
    
    </div> 
    


		   <br />
<?php hook("between-posts"); ?>