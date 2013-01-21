<?php

class Default_controller extends MX_Controller {

 
	
	function index($blog='default', $controller='pages', $method='show', $var1='home', $extra='')
	{
	
	/*
	if(logged_in() && $blog != $this->session->userdata('blog')){
		header("Location: ".base_url().$this->session->userdata('blog'));
	}
	*/

	if(!logged_in()){
	
	$this->session->set_userdata('blog', $blog);
	}

	$this->db->where('url', $blog);
	$q=$this->db->get('blogs');
	if($q->num_rows()>0){
	
	$myblog = $q->row();
	
	if($controller=='pages'){
	
	// check if page exists	
	$this->db->where('url', $var1);
	$this->db->where('blog', $blog);
	$q=$this->db->get('pages');
	
	if($q->num_rows()==0){
		
		
		$maincontent = "<div style='text-align: center; min-height: 500px;'><p>Oops, this page was not found. Let's take you somewhere <a href='".base_url()."'>nicer</a>.</p></div>";
		$sidebar = '';
		$menu = '';
		$description = '';
		$page = '';
		$title = "Page Not Found.";
		$site_title = "Oops";
		include(APPPATH."views/themes/".$myblog->theme."/index.php");
		exit;
		
	}
	
	$this->session->set_userdata('curpage', $var1);
	}
	elseif($controller=='posts'){
	$this->db->where('id', $var1);
	$q=$this->db->get('posts');
		if($q->num_rows()>0){
			$post = $q->row();
			
			$this->session->set_userdata('blog', $post->blog);
		}
	
	}
	
	
	}else{
		
		$maincontent = "<div style='text-align: center; min-height: 500px;'><p>Oops, this page was not found. Let's take you somewhere <a href='".base_url()."'>nicer</a>.</p></div>";
		$sidebar = '';
		$menu = '';
		$description = '';
		$page = '';
		$title = "Page Not Found.";
		$site_title = "Oops";
		include(APPPATH."views/themes/dashbird/index.php");
		exit;
		
		
	}
	
	
	echo modules::run($controller."/".$method, $var1);
	
	
	
	}
	
	
	
	
	
	

}
?>