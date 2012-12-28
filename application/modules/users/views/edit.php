
<div class="head"><h1><?php if($id!=''){ ?>Edit<?php }else{ ?>Add<?php } ?> User</h1>

<div class="clear"></div>

</div>

<div class="content">

<div class="main">

<?php if(isset($error)){ ?>
<div class="error"><?=$error;?></div>
<?php } ?>


<form action="<?=base_url();?>users/edit<?php if($id!=''){ echo "/".$id; } ?>" method="post">

Username:<br>
<input type="text" name="username" value="<?php if($id!=''){ echo $username; } ?>" size="55" class="uniform"><br /><br />

Password:<br>
<input type="password" name="password" value="<?php if($id!=''){ echo $password; } ?>" size="55" class="uniform"><br /><br />

Role:<br />
<select name="level" class="uniform">
<option value="1"<?php if($id!='' && $level==1){ echo " selected"; } ?>>writer</option>
<option value="2"<?php if($id!='' && $level==2){ echo " selected"; } ?>>editor</option>
<option value="5"<?php if($id!='' && $level==5){ echo " selected"; } ?>>admin</option>
</select>

<br /><br />
<input type="submit" value="save" class="uniform" />
</form>

</div>

<div class="clear"></div>

</div>

