<?php

class Posts extends MX_Controller{
	
	function __construct()
    {
        parent::__construct();
		
	
        
    }
	

	
	function show_all($col){
		
		
	
	$data['col'] = $col;

	
		$this->load->view("show_all", $data);
		
	}
	
	function show($id){
		
	
		
		$this->db->where('id', $id);
		$q=$this->db->get('posts');
		$data['post'] = $q->row_array();
		
		
		
		define("PAGE", $data['post']['page']);
		$data['page'] = $data['post']['page'];
		
		$data['title'] = $data['post']['title'];
			
		
		
		$data['description'] = '';
		
		$data['menu'] = modules::run('pages/nav');
	
		$data['maincontent'] = modules::run('posts/post', $data);
		
		$data['sidebar'] = modules::run("posts/show_all", "sidebar");
		
		
		$data['sidebar2'] = modules::run("posts/show_all", "sidebar2");
		
		$data['sidebar3'] = modules::run("posts/show_all", "sidebar3");
		
		
		
		
		$this->db->where('url', $this->session->userdata('blog'));
		$q = $this->db->get('blogs');
		$blog = $q->row();
		
		$data['site_title'] = $blog->title;
		
		$this->load->view("themes/".$blog->theme."/index.php", $data);
		
		
		
	}
	
	
	
	function edit_buttons($id){
		
		
		
	
		
		include(APPPATH.'config/plugins.php');
		
		$this->db->where('id', $id);
		$q=$this->db->get('posts');
		$post = $q->row_array();
		
		
		if($this->session->userdata('logged_in')){
		?>   
     
      <span class="edit_buttons" style="display: none; width: 160px; text-align: right;">
      
      <span class="save_buttons" id="save_buttons_<?=$id;?>" style="display: none; z-index:100;"><input type="button" value="save" id="save_<?=$id;?>" onclick="savePost('<?=$id;?>');" style="display: inline;" /> <input type="button" value="cancel" id="cancel_<?=$id;?>" onclick="cancelPost('<?=$id;?>');" style="display: inline;" /></span>
        
   
   <span class="minis" id="minis_<?=$id;?>">
        <?php if(in_array('in_place', $plugins)){ ?>
     
      <a href="javascript: void(0);" title="settings" onclick="showModal('Post Settings', '<?=base_url();?>posts/settings/<?=$post['id'];?>');"><img src="<?=base_url();?>application/sources/icons/cog2.png" border="0" style="margin-right: 3px;" /></a>
      <?php }else{ ?>
      
      <a href="<?=base_url();?>posts/fs_edit/<?=$post['id'];?>/<?=$post['type'];?>" title="edit"><img src="<?=base_url();?>application/sources/icons/pencil.png" border="0" style="margin-right: 3px;" /></a>
      <?php } ?>
      
      
      <?php if($post['publish']==0){ ?>
        <a href="<?=base_url();?>posts/publish/<?=$post['id'];?>/1"><img src="<?=base_url();?>application/sources/icons/unpublished.png" border="0" title="publish" style="margin-right: 3px;" class="unpublished" /></a>
         <?php }else{ ?>
         
               <a href="<?=base_url();?>posts/publish/<?=$post['id'];?>/0"><img src="<?=base_url();?>application/sources/icons/published.png" border="0" title="unpublish" style="margin-right: 3px;" class="published" /></a>
         <?php } ?>
      
      <!--
      <a href="<?=base_url();?>posts/delete/<?=$post['id'];?>" onclick="return confirm('Are you sure you want to delete this post?');" title="delete"><img src="<?=base_url();?>application/sources/icons/cross.png" border="0" /></a>
      
      -->
      
  		</span>
  
     </span>

    <?php
		}
		
	}
	
	
	
	/*
	function single($id){
		$this->db->where('id', $id);
		$q=$this->db->get('posts');
		$post = $q->row_array();
		
		include(APPPATH."posttypes/".$post['type']."/front.php"); 
	}
	*/
	
	
	
	function post($data){
		$this->db->where('id', $data['post']['id']);
		$q=$this->db->get('posts');
		$post = $q->row_array();
		
		extract($post);
		
		$edit_buttons = modules::run('posts/edit_buttons', $data['post']['id']);
		
		$inc = lookForFile('front', $post['type']);
		include($inc);
	}
	
	function post_front($id){
		$this->db->where('id', $id);
		$q=$this->db->get('posts');
		$post = $q->row_array();
		
		$edit_buttons = modules::run('posts/edit_buttons', $id);
		
		$inc = lookForFile('front', $post['type']);
		include($inc);
	}
	
	
	
	function save($ajax=1){
		
		auth();
		
		if($_POST){
			// pr($_POST);
			
			
			$info = explode("-", $_POST['id']);
			
			$field = $info[0];
			$id = $info[1];
	
			// some cleaning up
			// $fielddata = str_replace('uploads/', base_url().'uploads/', $_POST['data']);
			
			$fielddata = $_POST['data'];
			
			$data = array($field=>$fielddata);
			
			
			if(isset($data['title'])){
			$data['url'] = strtolower(url_title($data['title']));
			}
	
			
			

			$this->db->where('id', $id);
			$this->db->update('posts', $data);
			
		}
		
		if($ajax==0){
			
		header("Location: ".$_SERVER['HTTP_REFERER']);
		}
		
	}
	
	function save_post($id){
		
		
		
		
		
		
		$data = array();
		foreach($_POST['postdata'] as $key=>$val){
			
			$val = str_replace("<p></p>", "", $val);
			
			
			$newkey = explode('-', $key);
			$newkey = $newkey[0];
			
			$data[$newkey] = $val;
			
			
		
			
		}
		
		if(isset($data['title'])){
	    $data['url'] = strtolower(url_title($data['title']));
		}
	
	
		$this->db->where('id', $id);
		$this->db->update('posts', $data);
		
		
	}
	
	function settings($id){
		
		auth();
		
	$this->db->where('id', $id);
	$q=$this->db->get('posts');
	
	$data = $q->row();	
		
	if($_POST){
		
		$updatedata = array('publish'=>$_POST['publish'], 'author'=>$_POST['author']);
		
		$this->db->where('id', $id);
		$this->db->update('posts', $updatedata);
		
		
		header("Location: ".base_url()."page/".$data->page."#post-".$data->id);
	}
	else
	{
	
	
	
	$this->load->view('settings', $data);
	}
	}
	
	function publish($id, $publish){
		
	$this->db->where('id', $id);
	$q=$this->db->get('posts');
	
	$post = $q->row();		
		
	$data = array('publish'=>$publish);
	$this->db->where('id', $id);
	$this->db->update('posts', $data);
	
	header("Location: ".$_SERVER['HTTP_REFERER']);
		
	}
	
	
	// configures the extra function you can add to posttypes
	function configure($id){
		
		auth();
		
		$id = str_replace('edit-', '', $id);
		
		$this->db->where('id', $id);
		$q=$this->db->get('posts');
		$post = $q->row_array();
		
			extract($post);
			
		
		if(file_exists(APPPATH."posttypes/".$post['type']."/config.php")){
			
			
			include(APPPATH."posttypes/".$post['type']."/config.php");
		}
		else
		{
			
			$part = array();
		}
		
		
		?>
        <?php if(!isset($part['noform'])){ ?>
        <form name="editForm" id="editForm">
        <?php } ?>
        
        <?php include(APPPATH."posttypes/".$post['type']."/back.php"); ?>
        
          <?php if(!isset($part['noform'])){ ?>
        <br /><br />
        <a href="javascript:void(0);" onclick="saveConfig();"><img src="<?=base_url();?>application/sources/img/save.png" /></a>
        
</form>
<script type="text/javascript">
function saveConfig(){
	

		var mydata = $("#editForm").serialize();
		
		$.ajax({
		
		    type: "POST",
			url: "<?=base_url();?>posts/configure_save/<?=$id;?>",
			data: { formdata: mydata }

		  
		}).done(function() { 
		
	$('#function-<?=$id;?>').load('<?=base_url();?>posts/show_function/<?=$id;?>');	
	$('#redactor_modal_inner').html(''); $('#redactor_modal').hide();
 
		});
	}
</script>
  <?php } ?>      
        
        <?php
		
	}
	
	
	function configure_save($id){
		
		auth();
		
		$id = str_replace('edit-', '', $id);
		
		$this->db->where('id', $id);
		$q=$this->db->get('posts');
		$post = $q->row_array();
		
		if($_POST){
			
			$params = array();
			parse_str($_POST['formdata'], $params);
			
			foreach($params as $key=>$value){
				
				$data = array($key=>$value);
				$this->db->where('id', $id);
				$this->db->update('posts', $data);
				
				
			}
			
		
		}
		
	}
	
	function edit_image($id){
		
			auth();
		
		$id = str_replace('page_', '', $id);
		
		$this->db->where('id', $id);
		$q=$this->db->get('files');
		$img = $q->row();
		
		if($_POST){
			
		$params = array();
		parse_str($_POST['formdata'], $params);
			
			$data['title'] = $params['title'];
			$data['description'] = $params['description'];
			
			$this->db->where('id', $id);
			$this->db->update('files', $data);
			
			header("Location: ".$_SERVER['HTTP_REFERER']);
			
		}
		else{
		
		
		?>
        <a href="javascript: void(0);" onclick='showModalBig("Add", "<?=base_url();?>posts/configure/<?=$img->post_id;?>");'>&laquo; back</a><br /><br />
        <form>
        
        <table width="100%" border="0">
  <tr>
    <td valign="top">
    Title:<br />
    <input name="title" type="text" value="<?=$img->title;?>" />
    <br /><br />
    Description:<br />
    <textarea name="description" cols="45" rows="5"><?=$img->description;?></textarea>
    
    </td>
    <td>&nbsp;</td>
    <td valign="top" align="right" width="300"><img src="<?=base_url();?>uploads/thumb.php?src=<?=$this->session->userdata('blog');?>/<?=$img->filename;?>&w=300" /></td>
  </tr>
</table>
        
        
        
      <br />
    
        <input name="button" type="button" value="save" onclick="saveMe();" />
      
</form>

<script type="text/javascript">

function saveMe(){
		var mydata = $("form").serialize();
		
		$.ajax({
		
		    type: "POST",
			url: "<?=base_url();?>posts/edit_image/<?=$id;?>",
			data: { formdata: mydata }

		  
		}).done(function() { 
		  
		  
		  showModalBig("Gallery", "<?=base_url();?>posts/configure/<?=$img->post_id;?>");
		  
  });
		
	}


</script>
        
        
        <?php
		}
	}
	
	function add($page, $col='main'){
		
		auth();
		
		$data['page']=$page;
		$data['col']=$col;
		$this->load->view('add', $data);
		
	}
	
	function delete($id){
		
		auth();	
		
		$this->db->where('id', $id);
		$this->db->delete('posts');
		
		header("Location: ".base_url()."manage/posts");
		
	}
	
	
	
	function fs_init($page='home'){ // create a placeholder for the article, so we have an id
		
	
			auth();
			
			// first cleanup unused posts
			$this->db->where('visible', 0);
			$this->db->where('publish', 0);
			$this->db->delete('posts');
			
				
			
			$data=array('blog'=>$this->session->userdata('blog'), 'page'=>$page, 'type'=>'article', 'created'=>date("Y-m-d H:i:s"));
			$this->db->insert('posts', $data);
			
			$id = mysql_insert_id();
			
			header("Location: ".base_url()."posts/fs_edit/".$id."/article");
			
	
		
	
		
		
	}
	
	function fs_edit($id, $type){
		
		
		auth();
		
		
		$this->db->where('id', $id);
		$q=$this->db->get('posts');
		$data['post'] = $q->row_array();
		
		$data['maincontent'] = 'fs_edit.php';
		$data['toolbar'] = 'backend/toolbar';
		$this->load->view('backend/index', $data);
		
		
		
	}
	
	function fs_save($id){
		
		auth();
		
		if($_POST){
			
			
		
		$data = array();
		parse_str($_POST['formdata'], $data);
		
		unset($data['files_id']);
		
		$data['visible'] = 1;
	
	
			
			$this->db->where('id', $id);
			$this->db->update('posts', $data);
			
			
			
		}	
	
		
	}
	
	function fs_change_type($id, $type){
		
		auth();
		
		$data['type'] = $type;
		$this->db->where('id', $id);
		$this->db->update('posts', $data);
		header("Location: ".base_url()."posts/fs_edit/".$id."/".$type);
	}
	
	function show_function($id){
		
		
		
		$this->db->where('id', $id);
		$q=$this->db->get('posts');
		$post=$q->row_array();
		
		
	// allows you to override in themes folder
	$inc = lookForFile('function', $post['type']);
	include($inc);
	
		
		
	}
	
	
}