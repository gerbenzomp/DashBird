<form action="<?=base_url();?>posts/settings/<?=$id;?>" method="post">

Author Name<br />
<input type="text" name="author" value="<?=$this->session->userdata('username');?>">
<br><br>
Publish<br />
<select name="publish">

<option value="0"<?php if($publish=='0'){ echo " selected"; }?>>No</option>
<option value="1"<?php if($publish=='1'){ echo " selected"; }?>>Yes</option>

</select>
<br><br>
<input type="submit" value="submit">

</form>