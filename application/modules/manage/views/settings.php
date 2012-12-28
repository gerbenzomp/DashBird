
<div class="head"><h1>Manage Settings</h1>

<div class="clear"></div>
</div>

<div class="content">


<div class="nav">
<ul id="tabs">
<li><a href="<?=base_url();?>manage/settings" style="background-color: white; border-right: 0;">General</a></li>
<li><a href="<?=base_url();?>manage/users">Users</a></li>

</ul>

</div>


<div class="main">

<div class="note">Manage your site's settings</div>

<?php
$this->db->where('url', $this->session->userdata('blog'));
$q=$this->db->get('blogs');

$blog = $q->row();
?>


<form>
<ul>

    <li class="box"><table width="100%" border="0">
  <tr>
    <td width="300">Title</td>
   
    <td><input type="text" name="title" size="40" value="<?=$blog->title;?>" style="width: 85%;" class="uniform" /></td>
  </tr>
</table>
</li>


<?php
$themes = listFiles('views/themes');


// lock theme if it has the same name as the blog

if(in_array($this->session->userdata('blog'), $themes)){
	?>
    
    <li class="box" style="padding-top: 10px; padding-bottom: 10px;"><table width="100%" border="0">
  <tr>
    <td width="300">Theme</td>
  
    <td>
    
    <?php echo  ucwords($this->session->userdata('blog')); ?>
    
    </td>
  </tr>
</table>
</li>
    
    
    <?php
	
	
}
else
{
?>


<li class="box"><table width="100%" border="0">
  <tr>
    <td width="300">Theme</td>
    
    <td>
    <select name="theme" class="uniform">
    <?php 
    foreach($themes as $theme){ ?>
    <option value="<?=$theme;?>"><?=ucwords($theme);?></option>
    <?php } ?>
    </select>
    </td>
  </tr>
</table>
</li>

<?php } ?>


  <li class="box"><table width="100%" border="0">
  <tr>
    <td width="300">Number of articles per page</td>
   
    <td><input type="text" name="per_page" size="2" value="<?=getSet('per_page');?>" class="uniform" /></td>
  </tr>
</table>
</li>
    
</ul>
<br />
<input name="button" type="button" value="save" onclick="save();" class="uniform" />



</form>



</div>

<div style="clear: both;"></div>
<script type="text/javascript">

				

	$(function() {
		$( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
	});
	
	function save(){
		var mydata = $("form").serialize();
		
		$.ajax({
		
		    type: "POST",
			url: "<?=base_url();?>manage/save_settings",
			data: { formdata: mydata }

		  
		}).done(function() { 
		  $('.note').animate({'background-color': '#99cc99', 'borderColor': 'green'}, 1000).html('Changes were saved.');
		   $('.note').animate({'background-color': '#ffffcc', 'borderColor': '#ffcc66'}, 1000, function() {
    // Animation complete.
	$('.note').html('Change your site\'s settings');
  });
		});
	}
			

</script>
</div>