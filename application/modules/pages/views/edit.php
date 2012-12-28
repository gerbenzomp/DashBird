
<div class="head">


<h1><?php if($id!=''){ ?>Edit<?php }else{ ?>Add<?php } ?> Page</h1>

<div class="clear"></div>

</div>

<div class="content">


<div class="nav"></div>


<div class="main">
<form action="<?=base_url();?>pages/edit<?php if($id!=''){ echo "/".$id; } ?>" method="post">

Title:<br>
<input type="text" name="title" value="<?php if($id!=''){ echo $title; } ?>" size="55" class="uniform"><br /><br />

Description:<br />
<textarea name="description"  rows="4" style="width: 90%;" class="uniform"><?php if($id!=''){ echo $description; } ?></textarea>

<br><br>
Type of page:<br />
<select name="type" onchange="showFeed();" id="select" class="uniform">
<option value="standard"<?php if($id!='' && $type=='standard'){ echo " selected"; } ?>>Standard</option>
<option value="static"<?php if($id!='' && $type=='static'){ echo " selected"; } ?>>Static</option>
<option value="feed"<?php if($id!='' && $type=='feed'){ echo " selected"; } ?>>RSS Feed</option>

</select>


<div <?php if($id=='' || $feed==''){ ?>style="display: none;"<?php } ?> id="feed">
<br />
RSS Feed:<br />
<input name="feed" type="text" size="55" value='<?php if($id!=''){ echo $feed; } ?>' class="uniform" />
</div>


<div <?php if($id=='' || $static_file==''){ ?>style="display: none;"<?php } ?> id="static">
<br />
URL:<br />
<input name="static_file" type="text" size="55" value='<?php if($id!=''){ echo $static_file; } ?>' class="uniform" />
</div>

<br /><br />

<input type="submit" value="save" class="uniform" />
</form>

<script type="text/javascript">
function showFeed(){
	var selectBox = document.getElementById("select");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
	

	
  if(selectedValue=='feed'){
	  $('#static').hide();
	  $('#feed').show();
	  
  }
  else if(selectedValue=='static'){
	  $('#feed').hide();
	  $('#static').show();
  }
  else
  {
	   $('#feed').hide();
	   $('#static').hide();
  }

}
</script>

</div>

<div style="clear: both;"></div>

</div>

