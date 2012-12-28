 <div class="post" style="min-height: 150px;">
 
<div class="content"> 


<div style="float: left; width: 400px;">
<h2><a href="<?=$post->link;?>" target="_blank"><?=$post->title;?></a></h2>

<p><strong>CineBlah note:</strong> <?=$post->description;?></p></div>



<div style="float: right; width: 200px; border: 1px solid #CCC; margin-top: 20px;">

<a href="<?=$post->link;?>" target="_blank"><img src="http://img.bitpixels.com/getthumbnail?code=67772&size=200&url=<?=$post->link;?>" border="0" /></a>

</div>
<div style="clear: both;"></div>
<br />

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
	 $link = base_url()."page/show/".PAGE."/".niceUrl($post->title);
	 ?>
     
     <p style="margin-top: 0px;"><a href="<?=$link;?>">Permalink</a><br />

<a href="<?php echo $this->bitly->shorten($link);?>">Shortlink</a>

</p>
   
 
     
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