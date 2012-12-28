<?php
class Users extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
        
    }
	
	function login(){
		
	
		
		$data = array();
		
		if($_POST){
			
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$this->db->where('username', $username);
			$this->db->where('password', $password);
			$q=$this->db->get('users');
			
			if($q->num_rows()>0){
				$user = $q->row();
				
				$this->session->set_userdata('logged_in', 1);
				$this->session->set_userdata('username', $username);
				$this->session->set_userdata('blog', $user->blog);
				$this->session->set_userdata('level', $user->level);
				
				
				header("Location: ".site_url());

			}
			else
			{
				
				$data['error'] = "Error logging in.";
				
			}
		}
		
		$data['maincontent'] = "login";
		
		$this->load->view('backend/index', $data);
		
		
	}
	
	function logout(){
	$this->session->unset_userdata('logged_in');
	$this->session->unset_userdata('username');	
	$this->session->unset_userdata('level');	
	
	header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	
	
	function edit($id=''){
		
		auth();
		
		if($_POST){
			
			
		
			
			
			if($id==''){
				
			
			    $this->db->where('username', $_POST['username']);
				$q=$this->db->get('users');
				
				if($q->num_rows()==0){
				$data=array('username'=>$_POST['username'], 'password'=>$_POST['password'], 'level'=>$_POST['level']);
				$this->db->insert('users', $data);
				header("Location: ".base_url()."manage/users");
				}
				else
				{
				$data['error'] = "This username already exists";	
				}
			}
			else
			{
				
				$this->db->where('username', $_POST['username']);
				$this->db->where('id !=', $id);
				$q=$this->db->get('users');
				if($q->num_rows()==0){
				
				$data=array('username'=>$_POST['username'], 'password'=>$_POST['password'], 'level'=>$_POST['level']);
				$this->db->where('id', $id);
				$this->db->update('users', $data);
				
				header("Location: ".base_url()."manage/users");
				
				
				}
				else
				{
					$data['error'] = "This username already exists";
				}
			}
			
			
			
		}
		
		if($id!=''){
		$this->db->where('id', $id);
		$q=$this->db->get('users');
		$data = $q->row_array();
		}
		
		$data['id'] = $id;
		
		$data['maincontent'] = 'edit';
		
		$data['toolbar'] = 'backend/toolbar';
		
		$this->load->view('backend/index', $data);
		
		
	}
	
	
	function delete($id){
		
		auth();
		
		$this->db->where('id', $id);
		$this->db->delete('users');
		
		header("Location: ".$_SERVER['HTTP_REFERER']);
		
	}
	
	
	
}
?>