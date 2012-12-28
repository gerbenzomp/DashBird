<?php

class Pages extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
        
    }
	
	
	function show($page='home', $col='main'){
		
		//echo $this->uri->rsegment(1);
		
		
	
	$this->db->where('url', $page);
	$this->db->where('blog', $this->session->userdata('blog'));
	$q=$this->db->get('pages');
	
	if($q->num_rows()==1){
	
		$pagedata = $q->row();
	


		
		define("PAGE", $page);
		
		
		$data['menu'] = $this->nav();
		
		$data['page'] = $page;
		
		$data['title'] = $pagedata->title;
		$data['description'] = $pagedata->description;
		
		
		
		
		
		if($pagedata->type=='static'){
			
		$data['maincontent'] = modules::run("pages/static_page", $pagedata->static_file);
		}
		else{
		$data['maincontent'] = modules::run("posts/show_all", "main");
		}
		/*
		else{
		$data['maincontent'] = modules::run("feed/show", $page);	
		}
		*/
		
		$data['sidebar'] = modules::run("posts/show_all", "sidebar");
		
		
		$data['sidebar2'] = modules::run("posts/show_all", "sidebar2");
		
		$data['sidebar3'] = modules::run("posts/show_all", "sidebar3");
	
	}
	else
	{
		define("PAGE", $page);
		
		$data['menu'] = $this->nav();
		
		$data['page'] = $page;
		
		$data['title'] = "404 - Not Found";
		$data['description'] = 'The page you requested was not found';
		
		$data['maincontent'] = '';	
		
	}
	
	$this->db->where('url', $this->session->userdata('blog'));
	$q = $this->db->get('blogs');
	$blog = $q->row();
	
	$data['site_title'] = $blog->title;
		
		$this->load->view("themes/".$blog->theme."/index.php", $data);
	}
	
	function static_page($file){
		include(APPPATH."views/themes/cineblah/static/".$file);
	}
	
	
	
	function delete($id){
		
		auth();
		
		$this->db->where('id', $id);
		$this->db->delete('pages');
		
		header("Location: ".$_SERVER['HTTP_REFERER']);
		
	}
	
	
	
	
	function nav(){
		
		
		$this->db->where('blog', $this->session->userdata('blog'));
		$this->db->order_by('order_id');
		$q = $this->db->get('pages');
		$menu = "<div id='nav'><ul class='pages'>";
		foreach($q->result() as $p){
			$menu .= "<li><a href='".site_url()."page/".$p->url."'>".$p->title."</a></li>";
		}
		$menu .= "<ul></div>";
		
		return $menu;
	}

	
	
	function edit($id=''){
		
		auth();
		
		if($_POST){
			
			
			
			$url = niceUrl($_POST['title']);
			$title = $_POST['title'];
			$type = $_POST['type'];
			$description = $_POST['description'];
			
			
			if($_POST['feed']){
				$feed = $_POST['feed'];
			}
			else{
				$feed = '';
			}
			
			if($_POST['static_file']){
				$static_file = $_POST['static_file'];
			}
			else{
				$static_file = '';
			}
			
			$this->db->where('blog', $this->session->userdata('blog'));
			$this->db->order_by('order_id');
			$this->db->limit(1);
			$q=$this->db->get('pages');
			$p = $q->row();
			
			$order = $p->order_id + 1;
			
			
			if($id==''){
			$data=array('title'=>$title, 'description'=>$description, 'url'=>$url, 'type'=>$type, 'feed'=>$feed, 'static_file'=>$static_file, 'blog'=>$this->session->userdata('blog'), 'order_id'=>$order);
			
			$this->db->insert('pages', $data);
			}
			else
			{
				$data=array('title'=>$title, 'description'=>$description, 'type'=>$type, 'feed'=>$feed, 'static_file'=>$static_file);
				$this->db->where('id', $id);
				$this->db->update('pages', $data);
			}
			
			header("Location: ".base_url()."manage/pages");
			exit;
		}
		
		if($id!=''){
		$this->db->where('id', $id);
		$q=$this->db->get('pages');
		$data = $q->row_array();
		}
		
		$data['id'] = $id;
		
		$data['maincontent'] = 'edit';
		
		$data['toolbar'] = 'backend/toolbar';
		
		$this->load->view('backend/index', $data);
		
		
	}
	
	
	
}