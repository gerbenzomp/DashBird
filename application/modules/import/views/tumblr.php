<?php

// first, let's empty the table
// $this->db->truncate("posts");

include(APPPATH.'modules/import/lib/phpTumblr/functions.php');
	
// fetch tumblr posts
$data = fetchPosts('cineblah');

$posts = $data['posts'];
$totalposts = count($posts);

// pr($posts);
 
 if (count($posts)) {
	
foreach($posts as $post){

$this->db->where('external_id', getPostId($post['url']));
$q=$this->db->get('posts');
if($q->num_rows()==0){	   
		 
 // temporarily store tumblr post in database   
$data = array("external_id"=>getPostId($post['url']), "title"=>$post['content']['title'], "body"=>$post['content']['body'], "created"=>date("Y-m-d H:i:s", $post['time']), "url"=>niceUrl($post['content']['title']), "publish"=>1);
$this->db->insert('posts', $data);
}
  

		} 
	}
?>
