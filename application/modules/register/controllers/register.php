<?php
class Register extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
        
    }
	
	function index(){
		
		
		if($_POST){
			
			if($_POST['url']=='' && $_POST['password']==''){
				$data['error'] = "Oops, you did not fill in all required fields!";
			}
			else
			{
			
			
					$this->db->where('url', $_POST['url']);
					$q=$this->db->get('blogs');
					
					$this->db->where('username', $_POST['url']);
					$q2=$this->db->get('users');
					
					
					if($q->num_rows()==0 && $q2->num_rows()==0){
						$data['title'] = $_POST['title'];
						$data['url'] = $_POST['url'];
						$data['theme'] = 'cineblah';
						$this->db->insert('blogs', $data);
						
						$udata['username'] = $_POST['url'];
						$udata['password'] = $_POST['password'];
						$udata['email'] = $_POST['email'];
						$udata['blog'] = $_POST['url'];
						$udata['level'] = 5;
						$this->db->insert('users', $udata);
						
						$pdata=array('blog'=>$_POST['url'], 'title'=>'Home', 'url'=>'home', 'type'=>'standard', 'order_id'=>1);
						$this->db->insert('pages', $pdata);
						
						$adata=array('blog'=>$_POST['url'], 'title'=>'Welcome to your new blog', 'body'=>'You can delete this post by clicking on the red cross on the right. Create new post by clicking on "Add post" in the top left corner.', 'url'=>'welcome', 'type'=>'article', 'order_id'=>1, 'page'=>'home', 'created'=>mysql_date());
						$this->db->insert('posts', $adata);
						
						
						$this->session->set_userdata('logged_in', 1);
						$this->session->set_userdata('username', $udata['username']);
						$this->session->set_userdata('blog', $_POST['url']);
						$this->session->set_userdata('level', 5);
						
						
						header("Location: ".site_url());
					
					}
					else
					{
						$data['error'] = "This name already exists, please try another";
					}
			}
			
		}
	
	
		$data['maincontent'] = "register";
		
		$this->load->view('backend/index', $data);
		
		
	}
	
	
	
}
?>