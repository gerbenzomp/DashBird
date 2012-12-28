 <div class="post" style="min-height: 150px;">
 
<div class="content"> 

<div style="float: left; width: 160px;"><img src="<?=$thumbnail;?>" /></div>

<div style="float: right;"><h2><a href="<?=$link;?>" target="_blank"><?=$title;?></a></h2>

<p><strong>CineBlah note:</strong> <?=$description;?></p>

</div>

   <?php 
	 if($this->uri->segment(4)){
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
     <h2 style="margin-bottom: 0;"><?=date("j M Y", strtotime($post->pubDate));?></h2>
     
     <?php
	 $link = base_url()."page/show/".PAGE."/".niceUrl($title);
	 ?>
     
     <? /*
     <p style="margin-top: 0px;"><a href="<?=$link;?>">Permalink</a><br />

<a href="<?php echo $this->bitly->shorten($link);?>">Shortlink</a>

</p>
 */ ?>  
 
     
     </div>
     </div>
    
     <div style="clear: both;"></div>
    
    </div> 
    


		   <br />
<?php
 if($this->uri->segment(4)){
 hook("between-posts");
 }
  ?>