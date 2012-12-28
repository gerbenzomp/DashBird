<?php

class Feed extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
		
		
        
    }
	
	 function import($blog, $page){
		 
		$limit = 5; // only import latest 5 feed items
		
		$this->db->where('url', $page);
		$this->db->where('blog', $blog);
		$this->db->where('type', 'feed');
		
		$this->db->where('feed !=', '');
		$q=$this->db->get('pages');
		if($q->num_rows()>0){
		 
		$mypage = $q->row();
		
				 // Set the feed URLs here
				$feeds = array(
					$mypage->feed
					// etc.
				);
				
				// Get all feed entries
				$entries = array();
				foreach ($feeds as $feed) {
					$xml = simplexml_load_file($feed);
					$entries = array_merge($entries, $xml->xpath('/rss//item'));
				}
				
				
				 // pr($entries);
				/*
				// Sort feed entries by pubDate (ascending)
				usort($entries, function ($x, $y) {
					return strtotime($x->pubDate) - strtotime($y->pubDate);
				});
				*/
				
			
					$count = 0;
					$i = 0;
			
						foreach($entries as $post){
							
							$this->db->where('blog', $blog);
							$this->db->where("col", "main");
							$this->db->where('external_id', "$post->guid");
							$q=$this->db->get('posts');
							if($q->num_rows()==0 && $i<$limit){
								
								
								
								// image
								include(APPPATH."../grabzit/GrabzItClient.class.php");

								//Create the GrabzItClient class
								//Replace "APPLICATION KEY", "APPLICATION SECRET" with the values from your account!
								$grabzIt = new GrabzItClient("bWFpbEB6b21wLm5s", "Pz9YPz8/UCkfCT8IPz99ARM7P08/Pz8/Pz9QP0AODT4=");
								//Take the picture the method will return the unique identifier assigned to this task
								$id = $grabzIt->TakePicture($post->link, base_url()."grabzit/GrabzItHandler.php", null, null, null, 200, 150);
								$data['image'] = "http://www.cineblah.com/grabzit/images/".$id.".jpg";
								
								
								
								
							
								
								$data['title'] = "$post->title";
								$data['body'] = "$post->description";
								$data['external_id'] = "$post->guid";
								$data['external_link'] = "$post->link";
								
								$data['type'] = "feed";
								$data['created'] = date('Y-m-d H:i:s', strtotime($post->pubDate));
								$data['publish'] = 1;
								$data['page'] = $page;
								$data['blog'] = $this->session->userdata('blog');
								$data['col'] = 'main';
								$data['url'] = niceUrl($post->title);
								$this->db->insert('posts', $data);
								
								$count += 1;
								$i++;
							}
							
						
						}
						
						echo $count;
	
		
		}
		
	
		// header("Location: ".$_SERVER['HTTP_REFERER']);
		
	 }
	 
	 
	 function delete_all($page){ // deletes all feed items on a certain page
		 
		 $this->db->where('type', 'feed');
		 $this->db->where('page', $page);
		 $this->db->where('blog', $this->session->userdata('blog'));
		 $this->db->delete('posts');
		 
	 }
	 
	 function screenshot(){
		
		include(APPPATH."../grabzit/GrabzItClient.class.php");

		//Create the GrabzItClient class
		//Replace "APPLICATION KEY", "APPLICATION SECRET" with the values from your account!
		$grabzIt = new GrabzItClient("bWFpbEB6b21wLm5s", "Pz9YPz8/UCkfCT8IPz99ARM7P08/Pz8/Pz9QP0AODT4=");
		//Take the picture the method will return the unique identifier assigned to this task
		$id = $grabzIt->TakePicture("http://www.google.com", base_url()."grabzit/GrabzItHandler.php");
		
		
		 
	 }
	
	
	function show(){
		
		
$this->load->config('bitly');
	
$this->load->library('bitly');

		
		
	
	function search($search, $array) {
		
		$json  = json_encode($array);
		$array = json_decode($json, true);

		
	   foreach ($array as $key => $val) {
		   
		   // echo strpos($val['title'], $search);
		   $search = substr($search, 1, 50);
		   
		   if (strpos(niceUrl($val['title']), $search)) {
			   return $key;
		   }
	   }
	   return false;
	}
	
	

		
		
		// Set the feed URLs here
		$feeds = array(
			'http://delicious.com/v2/rss/cineblah'
			// etc.
		);
		
		// Get all feed entries
		$entries = array();
		foreach ($feeds as $feed) {
			$xml = simplexml_load_file($feed);
			$entries = array_merge($entries, $xml->xpath('/rss//item'));
		}
		
		
		// pr($entries);
		/*
		// Sort feed entries by pubDate (ascending)
		usort($entries, function ($x, $y) {
			return strtotime($x->pubDate) - strtotime($y->pubDate);
		});
		*/
		
		if($this->uri->segment(4)){
			
			
			$show = search($this->uri->segment(4), $entries);
			
			
			
			
			
				$i=0;
				foreach($entries as $post){
					
					// pr($post);
					
					if($i==$show){
					
					include(APPPATH."modules/feed/views/show.php");
					
					}
					
					$i++;
				}
		

			
		}
		else{
			
		
				foreach($entries as $post){
					
					// pr($post);
					
					
					
					include(APPPATH."modules/feed/views/show.php");
					
					
				}
		
			
		}
		
		?>
        
        <br />
        <div style="text-align: center;">More bookmarks on <a href="http://delicious.com/cineblah" target="_blank">Delicious</a>. Images powered by <a href='http://www.bitpixels.com/' target="_blank">Bitpixels</a>.</div>
        
        <br />
        <?php
		
		
		
	}
	
	
	function zootool(){
		
		$key = "86b3c99242ae49e385d514aea72ae9bb";
		$secret = "nm6iw";
		
		
		include(APPPATH."modules/feed/libraries/class.zoo.php");
		
		$zoo = new ZooPHP($key, $secret);
		$posts = $zoo->getUserItems('cineblah');
		
		$posts = json_decode($posts);
		
		// pr($posts);
		
		foreach($posts as $post){
			
				$this->load->view('zootool', $post);
			
		}
		
		
		
		
	}
	
	
	function makestatic(){
		
		
		function wwwcopy($link,$file)
		{
			$cont = '';
			
		   $fp = @fopen($link,"r");
		   while(!feof($fp))
		   {
			   $cont.= fread($fp,1024);
		   }
		   fclose($fp);
		
		   $fp2 = @fopen($file,"w");
		   fwrite($fp2,$cont);
		   fclose($fp2);
		}
		
		//Example on using this function
		wwwcopy("http://www.cineblah.com/page/show/home", "../../../sites/gerben/home.html");



		
	}
	

	
}