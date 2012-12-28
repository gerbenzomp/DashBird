<?php

class Manage extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
        
    }
	

	function posts($page='home'){
		
		auth();
		
		$data['page'] = $page;
		
		$data['maincontent'] = 'posts';
		
		$data['toolbar'] = 'backend/toolbar';
		
		$this->load->view('backend/index', $data);
		
	}
	
	function pages(){
		
		auth();
		
		$data['maincontent'] = 'pages';
		
		$data['toolbar'] = 'backend/toolbar';
		
		$this->load->view('backend/index', $data);
		
	}
	
	function users(){
		
		auth();
		
		$data['maincontent'] = 'users';
		
		$data['toolbar'] = 'backend/toolbar';
		
		$this->load->view('backend/index', $data);
		
	}
	
	function settings(){
		
		auth();
		
		$data['maincontent'] = 'settings';
		
		$data['toolbar'] = 'backend/toolbar';
		
		$this->load->view('backend/index', $data);
		
	}
	
	function save_settings(){
		
		auth();
		
		$params = array();
		parse_str($_POST['formdata'], $params);
		
		// pr($params);
		foreach($params as $key=>$value){
			
			
			if($key=='title' || $key=='theme'){
				
				$mydata[$key]=$value;
				$this->db->where('url', $this->session->userdata('blog'));
				$this->db->update('blogs', $mydata);
				
			}
			else
			{
			
			
					$this->db->where('name',$key);
					$this->db->where('blog', $this->session->userdata('blog'));
					$q=$this->db->get('settings');
					if($q->num_rows()>0){
						$data=array('value'=>$value);
						$this->db->where('name', $key);
						$this->db->update('settings', $data);
					}
					else
					{
						$data=array('name'=>$key, 'value'=>$value, 'blog'=>$this->session->userdata('blog'));
						$this->db->insert('settings', $data);
					}
			}
		
		}
		
		
		
	}
	
	
	function reorder($table){
		
		auth();
		
		$order = $_POST['orderdata'];
		
		$params = array();
		parse_str($_POST['orderdata'], $params);

// pr($params);
$i=0;
		foreach($params['page'] as $id){
			
			
			$data=array('order_id'=>$i);
			$this->db->where('id', $id);
			$this->db->update($table, $data);
			
			$i++;
		}
	}
	
	function bounceback($id){
		
	
		
			header("Location: ".$_SERVER['HTTP_REFERER']."#post-".$id);
		
	}
	
	
	
}