<div class="wrapper_small">
<div class="head"><h1>Register</h1>

<div class="clear"></div>
</div>

<div class="simplecontent">


<?php if(isset($error)){ ?>
<div class="error"><?=$error;?></div>
<?php }else{ ?>
<div class="note">Create a new Blog</div>
<?php } ?>


<script type="text/javascript">
function slugify(str){
    var value = str.replace(/\s+/g,'-').replace(/[^a-zA-Z0-9\-]/g,'').toLowerCase();
	$('#slug').html(value);
	$('#slugfield').val(value);
}

$("#title").live("keyup", function(event){
var str = $("#title").val();
 slugify(str);
});

</script>



<form id="form" name="form" method="post" action="<?=base_url();?>register/index">

<ul>
 <li class="box"><table width="100%" border="0">
  <tr>
    <td>Site Name</td>
    <td>&nbsp;</td>
    <td align="right"><input type="text" name="title" size="35" value="" id="title" /></td>
  </tr>
</table>
</li>



 <li class="box" style="padding-top: 10px; padding-bottom: 10px;"><table width="100%" border="0">
  <tr>
    <td>Site URL</td>
    <td><input type="hidden" name="url" id="slugfield" /></td>
    <td align="right" id="slug"></td>
  </tr>
</table>
</li>

 <li class="box"><table width="100%" border="0">
  <tr>
    <td>Email</td>
    <td>&nbsp;</td>
    <td align="right"><input type="text" name="email" size="35" value="" /></td>
  </tr>
</table>
</li>

 <li class="box"><table width="100%" border="0">
  <tr>
    <td>Password</td>
    <td>&nbsp;</td>
    <td align="right"><input type="password" name="password" id="password" size="35" /></td>
  </tr>
</table>
</li>
</ul>
<br />

<button type="submit">Register</button>
<div class="spacer"></div>

</form>

</div>
</div>