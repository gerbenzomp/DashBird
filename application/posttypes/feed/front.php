 <div class="post" style="min-height: 150px;">
 
<div class="content"> 





<div style="float: left; width: 400px;">

<?=$edit_buttons;?>


<h2 id="title-<?=$id;?>" class="edit_single"><a href="<?=$external_link;?>" target="_blank"><?=$title;?></a></h2>

<span id="body-<?=$id;?>" class="edit_rich" data-button-class="all">

<p><strong>CineBlah note:</strong> <?=$body;?></p>
</span>


</div>



<div style="float: right; width: 200px; border: 1px solid #CCC; margin-top: 20px;">

<?php 


if($image!=''){ ?>

<a href="<?=$external_link;?>" target="_blank"><img src="<?=$image;?>" border="0" width="200" /></a>

<?php }else{ ?>

<a href="<?=$external_link;?>" target="_blank"><img src="http://img.bitpixels.com/getthumbnail?code=67772&size=200&url=<?=$external_link;?>" border="0" /></a>

<?php } ?>



</div>
<div style="clear: both;"></div>
<br />

   <?php 
	 if($this->uri->segment(3)){
	?>
    <br />
    <?php	 
	$mydata['post'] = $post;
	 hook('after-detail', $mydata);
	 }
	 ?>  


</div>
    
<div class="meta">  
  

     
     <div style="padding-left: 15px; margin-top: -5px;">
     <h2 style="margin-bottom: 0;"><?=date("j M Y", strtotime($post['created']));?></h2>
     
      by <a href="<?=site_url();?>">CineBlah</a>
    
    
    <?php 
	$hookdata = array('url'=>site_url()."post/".$id."/".$url);
	hook('after-meta', $hookdata); ?>
    
    
    <?php
	if($_SERVER['REMOTE_ADDR']=='83.80.205.171'){
		?>
        <br />
        <a href="<?=site_url();?>feed/import/<?=$this->session->userdata('blog');?>/<?=PAGE;?>">Refresh</a>
        <?php
		
	}
	
	?>
     
   


</p>
   
 
     
     </div>
     </div>
    
     <div style="clear: both;"></div>
    
    </div> 
    


		   <br />
<?php
 if($this->uri->segment(3)){
 hook("between-posts");
 }
  ?>