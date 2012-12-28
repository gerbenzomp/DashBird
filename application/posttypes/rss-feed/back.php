
RSS Feed URL:<br />
<input name="config1" type="text" value="<?=$post['config1'];?>" size="40" />

<br /><br />
Number of items:<br />

<?php $num_items=$post['config2']; ?>

<select name="config2">
<option value="1"<?php if($num_items==1){ echo " selected"; } ?>>1</option>
<option value="5"<?php if($num_items==5){ echo " selected"; } ?>>5</option>
<option value="10"<?php if($num_items==10){ echo " selected"; } ?>>10</option>
<option value="15"<?php if($num_items==15){ echo " selected"; } ?>>15</option>
<option value="20"<?php if($num_items==20){ echo " selected"; } ?>>20</option>
<option value="25"<?php if($num_items==25){ echo " selected"; } ?>>25</option>
</select>
