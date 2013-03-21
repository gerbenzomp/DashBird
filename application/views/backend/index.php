<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Manage</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>


    <script src="<?=base_url();?>application/views/backend/js/uniform/jquery.uniform.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
      $(function(){
        $(".uniform").uniform();
		
		
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
    
   <link rel="stylesheet" href="<?=base_url();?>application/views/backend/js/uniform/css/uniform.default.css" type="text/css" media="screen">

   
   <!-- Valums -->
<script src="<?=base_url();?>application/sources/js/valums/client/fileuploader.js" type="text/javascript"></script>
   
     <link rel="stylesheet" href="<?=base_url();?>application/views/backend/style.css" type="text/css" media="screen">
     
     <!-- toolbar -->
<link rel="stylesheet" href="<?=base_url();?>application/views/backend/toolbar.css" type="text/css" media="screen">


<!-- Redactor -->
<script src="<?=base_url();?>application/sources/js/redactor/redactor/redactor.js"></script>
<link rel="stylesheet" href="<?=base_url();?>application/sources/js/redactor/redactor/redactor.css" />

    <script type="text/javascript">
    $(document).ready(
    function()
    {
    $('#body, #extended').redactor({
	buttons:     ['bold', 'italic', '|',
    'unorderedlist', 'orderedlist', '|',
    'image', 'video', 'file', 'table', 'link', '|',
    'alignleft', 'aligncenter', 'alignright', '|',
    'horizontalrule', '|','html'],
	minHeight: 250,
	imageUpload: '<?=base_url();?>upload/upload_image'
		
		
	});
    }
    );
    </script>
    
    <style type="text/css">
ul.images{
padding: 0;
margin: 0;	
}

ul.images li{
display: inline-block;	
}

</style>


<!-- uploadify -->


<link href="<?=base_url();?>application/sources/js/uploadify2/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url();?>application/sources/js/uploadify2/swfobject.js"></script>
<script type="text/javascript" src="<?=base_url();?>application/sources/js/uploadify2/jquery.uploadify.v2.1.4.min.js"></script>

<script src="<?=base_url();?>application/sources/js/zomp/tinytabs.js"></script>

<script type="text/javascript">

  $(function(){
$('#content').tinytabs({transition: 'fade'});
  });

</script>

<style type="text/css">

.current{
	background-color: white !important;
	border-right: 0 !important;
}

#gal_window{
	width: 828px;
	margin: 0 auto !important;
	border-left-top-radius: 8px !important;
	border-right-top-radius: 8px !important;

}

fieldset{
border: 0;	
padding: 0;
margin: 0;

	margin-bottom: 10px;
}

textarea{
	margin-bottom: 10px;
}

/*

.tinytabs{
 padding-left: 34px !important; 
 background-position: 12px 11px;
 background-repeat: no-repeat;	
}
*/

</style>


<!-- tag-it -->

<link href="<?=base_url();?>application/sources/js/tag-it/css/jquery.tagit.css" rel="stylesheet" type="text/css">
<link href="<?=base_url();?>application/sources/js/tag-it/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
<script src="<?=base_url();?>application/sources/js/tag-it/js/tag-it.js" type="text/javascript" charset="utf-8"></script>


</head>
<body>
<?php
if(isset($toolbar)){
echo $this->load->view($toolbar);
}
?>

<br /><br /><br /><br /><br />
<div class="wrapper">

<?=$this->load->view($maincontent);?>

</div>



</body>
</html>