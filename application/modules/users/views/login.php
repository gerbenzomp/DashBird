<div class="wrapper_small">
<div class="head"><h1>Log In</h1>

<div class="clear"></div>
</div>

<div class="simplecontent">


<?php if(isset($error)){ ?>
<div class="error"><?=$error;?></div>
<?php }else{ ?>
<div class="note">Log in with your BlogBird username and password</div>
<?php } ?>




<form id="form" name="form" method="post" action="<?=base_url();?>users/login">

<ul>
 <li class="box"><table width="100%" border="0">
  <tr>
    <td>Username</td>
    <td>&nbsp;</td>
    <td align="right"><input type="text" name="username" size="35" value="" class="uniform" /></td>
  </tr>
</table>
</li>


 <li class="box"><table width="100%" border="0">
  <tr>
    <td>Password</td>
    <td>&nbsp;</td>
    <td align="right"><input type="password" name="password" id="password" size="35" class="uniform" /></td>
  </tr>
</table>
</li>
</ul>
<br />

<button type="submit" class="uniform">Log In</button>
<div class="spacer"></div>

</form>

</div>
</div>