<?php

class Import extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
        
    }
	

	
	
	
	function tumblr(){
		
	auth();
		
	$this->load->view('tumblr');
		
	}
	
	
}