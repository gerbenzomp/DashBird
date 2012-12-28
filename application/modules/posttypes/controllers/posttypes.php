<?php

class Posttypes extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
		
	
        
    }
	

	function sendmail($id){
		
		
		if($_POST['extra'] != ''){ // honeypot
			
			// echo "You're quite a robot, you";
			
		}
		else
		{
		
		
		$name = $_POST['name'];
		$from = $_POST['email'];
		$message = $_POST['message'];
		
		if(checkEmail($from)){
			
		
		
			$this->db->where('id', $id);
			$q=$this->db->get('posts');
			
			if($q->num_rows()>0){
				
				$post=$q->row();
				
				$this->load->library('email');
		
				$this->email->from($from, $name);
				$this->email->to($post->config1);
			
				$this->email->subject('Email sent from your BlogBird site');
				$this->email->message($message);
				
				$this->email->send();
				
				echo $this->email->print_debugger();
			
			}
		
		}
		}
		
		header("Location: ".$_SERVER['HTTP_REFERER']);
		
		
	}
	
	
}