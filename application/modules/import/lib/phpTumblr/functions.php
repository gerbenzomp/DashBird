<?php


/*  First, you have to include some files :
/     * The Clearbricks _common.php file
/     * The Tumblr class itself
/     * The UTF8 HTML Decode class (used to clean up some non-standards entities)
/*/
require dirname(__FILE__).'/clearbricks/_common.php';
require dirname(__FILE__).'/class.read.tumblr.php';
require dirname(__FILE__).'/class.read.tumblr.cache.php';


function fetchPosts($blog, $type=null){
	
if($_GET['flush']){
	$time = 0;
}
else
{
	$time = 3600; // one hour
}

$oTumblr = new readTumblrCache($blog,'phpTumblr',dirname(__FILE__).'/tmp',$time);

$oTumblr->getPosts(null,'all',$type);

$aTumblr = $oTumblr->dumpArray();



return $aTumblr;
}

function fetchOnePost($blog, $id){
	
$oTumblr = new readTumblrCache($blog,'phpTumblr',dirname(__FILE__).'/tmp',$time);
$post = $oTumblr->getPosts(null,null,null,$id);
$post = $oTumblr->dumpArray();

return $post;
	
}

/*  Important note : you can do as much getPosts request as you like!
/   It's impossible to have several times the same post in the array (array key composed with post's id and post's timestamp).
/*/
?>