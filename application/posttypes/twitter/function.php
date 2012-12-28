<?php

if($post['config1']!=''){
	
?>
<div class="editscreen" id="edit-<?=$id;?>">
<?php	
include_once(APPPATH.'posttypes/twitter/simpletweet/php-simpletweet.php');
$twitter = new SimpleTweet($config1);

$tweets = $twitter->getTweets(APPPATH."cache");


foreach($tweets->results as $tweet){
	?>
    
    <div class="simpletweet" itemscope itemtype="Tweet">
      <p itemprop="content" class="tweettext"><?php echo $tweet->text; ?></p>
<hr />
  
    </div>
    
    <?php
	
}
?>
</div>
<?php

	
}
else
{
	?>
    <br />
   <div class="editscreen droparea" id="edit-<?=$id;?>">



Click to configure your Twitter account


</div> 
    
    
    <?php
	
}
?>

