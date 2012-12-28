<?php
/*
if($feed_url!=''){
	

	$content = file_get_contents($feed_url);
	$x = new SimpleXmlElement($content);

	echo "<ul>";
	
	$i=0;
	foreach($x->channel->item as $item) {
	if($i<$num_items){	
		
	echo "<li>";
	echo "<a href='" .$item->link . "' target='_blank'>";
	echo $item->title;
	echo "</a>";
	echo "</li>";
		
	}
	$i++;
	
	}
	
echo "</ul>";
}	

*/
if($post['config1']!=''){
?>
<div class="editscreen" id="edit-<?=$id;?>">
<?php		
	
$this->load->library('simplepie');

$this->simplepie->set_feed_url($post['config1']);
$this->simplepie->set_cache_location(APPPATH.'../uploads/cache/rss');
$this->simplepie->init();
$this->simplepie->handle_content_type();
 
$rss_items = $this->simplepie->get_items(0, $post['config2']);

echo "<ul>";
foreach($rss_items as $item) {
	echo "<li>";
	echo "<a href='" .$item->get_link() . "' target='_blank'>";
	echo $item->get_title();
	echo "</a>";
	echo "</li>";
}
echo "</ul></div>";
}
else{
	
?>
    <br />
   <div class="editscreen droparea" id="edit-<?=$id;?>">



Click to configure your RSS Feed


</div> 
    
    
    <?php	
}

?>


