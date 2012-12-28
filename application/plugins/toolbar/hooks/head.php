<!-- jQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>

<!-- Uniform -->
<script src="<?=base_url();?>application/views/backend/js/uniform/jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?=base_url();?>application/views/backend/js/uniform/css/uniform.default.css" type="text/css" media="screen">

<link rel="stylesheet" href="http://uniformjs.com/stylesheets/uniform.aristo.css" type="text/css" media="screen">

<!-- toolbar -->
<link rel="stylesheet" href="<?=base_url();?>application/views/backend/toolbar.css" type="text/css" media="screen">

<style type="text/css">
ul.images{
padding: 0;
margin: 0;	
}

ul.images li{
display: inline-block;	
}

</style>


<?php
// RSS pages auto refresh
// let's only do it sometimes
$sometimes = rand(0,4);
$now = rand(0,4);

$CI =& get_instance();
$CI->db->where('url', $CI->session->userdata('curpage'));
$q=$CI->db->get('pages');

if($q->num_rows()>0){
	
	$mypage = $q->row();
	if($mypage->type=='feed' && $mypage->feed != '' && $sometimes == $now){
	?>
<script type="text/javascript">
	$(document).ready(function(){
    $.ajax({
    url: "<?=base_url();?>feed/import/<?=$CI->session->userdata('blog');?>/<?=$CI->session->userdata('curpage');?>",
	  context: document.body
	}).done(function(data) { 
	  if(data>0){
		  
		  $('#main .message').html('<a class="note" style="display: block; color: black; text-align: center;" onclick="document.location.reload(true);">There are '+data+' new articles</a>').fadeIn('slow');
		  
	  }
	  
	  
	 
	});
}); // 60 seconds
</script>
    
    <?php
	}
}

?>




<?php if(logged_in()){ ?>

<!-- Toolbar Plugin -->


<?php /* 
   <script type="text/javascript" charset="utf-8">
      $(function(){
       //  $("input, textarea, select, button").uniform();
		
		
		// toggle publish buttons
		$('.published').hover(function(){
			$(this).attr('src', '<?=base_url();?>application/sources/icons/unpublished.png');
		},
		function(){
			$(this).attr('src', '<?=base_url();?>application/sources/icons/published.png');
      	});
		
		$('.unpublished').hover(function(){
			$(this).attr('src', '<?=base_url();?>application/sources/icons/published.png');
		},
		function(){
			$(this).attr('src', '<?=base_url();?>application/sources/icons/unpublished.png');
      	});
		
		
	  });
    </script>
	
	*/ ?>

  
   
<script type="text/javascript" charset="utf-8">
	
		
$().ready(function() {
	
	showToolBar();
	
	
	$('.item').hover(function(){
		
		
		var id = $(this).attr('id');
		var width = $('#'+id+' .content').width()-155;
		$('#'+id+' .edit_buttons').css('position', 'absolute');
		$('#'+id+' .edit_buttons').css('margin-left', width+'px');
		
		$('#'+id+' .edit_buttons').show();
		
	},
	
	function(){
		var id = $(this).attr('id');
		
		$('#'+id+' .edit_buttons').hide();
	}
	
	);
	
	
});

function showToolBar(){

toolbar = '<?php include(APPPATH."views/backend/toolbar.php");?>';

$('body').prepend(toolbar);
	
}

<?php include(APPPATH."../config.php"); 
if(!in_array("in_place", $plugins)){
	?>
	function showModal(){
		window.location='<?=base_url();?>posts/fs_init/<?=PAGE?>';
	}
<?php	
}
?>


</script>

<style type="text/css">


	body{
	margin-top: 36px;
	}
	
   
	
	.toolbar{
	z-index: 100;
	border-bottom: 1px solid #000000;	
	padding: 10px;
	padding-top: 7px;
	padding-left: 25px;
	position: fixed;
	x: 0;
	y: 0;
	margin-top: -36px;
	width: 100%;
	background: url(<?=base_url();?>application/plugins/toolbar/img/toolbar_blue.png) repeat-x;
	/* text-align: center; */
	color: white;
	}
	
	
	
	
	
	
	ul{
	margin: 0;
	padding: 0;	
	}
	
	li{
	list-style-type: none;	
	}
	
	
	


	

</style>
    

<?php }


 ?>


