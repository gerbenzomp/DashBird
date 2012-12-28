<?php

class Upload extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
        
    }
	

	
	// rich text editor upload
	function upload_image(){
		
		
		auth();
	
		$config['upload_path'] = APPPATH.'../uploads/'.$this->session->userdata('blog').'/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';
		$config['encrypt_name'] = TRUE;
		/*
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		*/

		$this->load->library('upload', $config);

		$field_name = 'file';

		if ( ! $this->upload->do_upload($field_name))
		{
			$error = array('error' => $this->upload->display_errors());

			//$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			
			// resizing
			
			
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = $data['upload_data']['full_path'];
			$config2['new_image'] = $data['upload_data']['full_path'];
			
			$config2['create_thumb'] = FALSE;
			$config2['maintain_ratio'] = TRUE;
			
			$config2['width'] = 600;
			$config2['height'] = 400;
			
			
			$this->load->library('image_lib', $config2);
			
			$this->image_lib->resize();
			
			
			
			 // displaying file    
				$array = array(
					'filelink' => base_url().'uploads/'.$this->session->userdata('blog')."/".$data['upload_data']['file_name']
				);
				
				
				echo stripslashes(json_encode($array));  

			//$this->load->view('upload_success', $data);
		}
		
	}
	
	
	// valums uploader
	function upload_multi($post_id){
		
		auth();
		
		
		$allowedExtensions = array();
		// max file size in bytes
		$sizeLimit = 10 * 1024 * 1024;
		
		require(APPPATH.'sources/js/valums/server/php.php');
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		
	
		
		// Call handleUpload() with the name of the folder, relative to PHP's getcwd()
		$result = $uploader->handleUpload(APPPATH."../uploads/".$this->session->userdata('blog')."/");
		
			
			// resize image
			$config['image_library'] = 'gd2';
			$config['source_image'] = APPPATH."../uploads/".$this->session->userdata('blog')."/".$result['filename'];
			$config['new_image'] = APPPATH."../uploads/".$this->session->userdata('blog')."/".$result['filename'];
			
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			
			$config['width'] = 600;
			$config['height'] = 400;
			
			
			$this->load->library('image_lib', $config);
			
			$this->image_lib->resize();
			
			
			
			$data=array("post_id"=>$post_id, "filename"=>$result['filename'], "type"=>"gallery");
			$this->db->insert('files', $data);
			
			$result['id'] = mysql_insert_id();
		
		// to pass data through iframe you will need to encode all html tags
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		
	}
	
	
}