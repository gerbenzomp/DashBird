 <div class="post">
 
<div class="content"> 

<?php echo $edit_buttons; ?>
  
     


<h2 id="title-<?=$post['id'];?>" class="edit_single"><?=$post['title'];?></h2>






<div id="body-<?=$post['id'];?>" class="edit_rich" data-button-class="all">
<p><?=$post['body'];?></p>
</div>



<div class="function" id="function-<?=$post['id'];?>">
<?php
// allows you to override in themes folder
	$inc = lookForFile('function', $post['type']);
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

        
    </div>
    
    
    
    
     <div style="clear: both;"></div>
    
    </div> 
    
<br />