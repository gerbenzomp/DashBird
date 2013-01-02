<?php


hook('after-body');

?>
<div id="<?=$col;?>" class="col">


<?php
if($col=='main'){ 
$window_title = "Add Post";
}
else
{
$window_title = "Add Sidebar Item";
}
?>

<div class="add" style="display: none;"><a href="javascript:void(0);" onclick="showModal('<?=$window_title;?>', '<?=base_url();?>posts/add/<?=PAGE;?>/<?=$col;?>');" class="add_button">&nbsp;</a></div>

<div class="message" style="display: none;"></div>

<?php

	$this->db->order_by('created desc');
	$this->db->where('page', PAGE);
	$this->db->where('col', $col);
	$this->db->where('blog', $this->session->userdata('blog'));
	if(!$this->session->userdata('logged_in')){
	$this->db->where('publish', 1);	
	}
	$q=$this->db->get('posts');
	$posts = $q->result_array();
	

$num = getSet('per_page');


if($num!=''){

	$per_page = $num;
}
else
{
	$per_page = 999;
}



$this->load->library('pagination');

$config['base_url'] = site_url()."page/".$this->session->userdata('curpage');
$config['total_rows'] = $q->num_rows();
$config['per_page'] = $num;

$this->pagination->initialize($config);



	$this->db->order_by('order_id asc, created desc');
	$this->db->where('page', PAGE);
	$this->db->where('col', $col);
	$this->db->where('blog', $this->session->userdata('blog'));
	if(!$this->session->userdata('logged_in')){
	$this->db->where('publish', 1);	
	}
	$this->db->limit($num, $this->uri->segment(3));
	$q=$this->db->get('posts');
	
	


foreach($q->result_array() as $post){
	
	extract($post);

		$edit_buttons = modules::run('posts/edit_buttons', $post['id']);	
			
		
           
		if($post['type']==''){
			$post['type'] = "article";
		}
	?>
	<div class="item" id="item-<?=$post['id'];?>">
    
    <?php
	
	
	// allows you to override in themes folder
	$inc = lookForFile('front', $post['type']);
	include($inc);
	
	
	
       //  include(APPPATH."posttypes/".$post['type']."/front.php"); 
	?>
    </div>
    <?php
 }
	
?>
<div class="navigation">


<?php

echo $this->pagination->create_links();

		?>
        </div>


</div>

<div style="clear: both;"></div>

    





