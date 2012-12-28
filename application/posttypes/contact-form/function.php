<?php if($config1!=''){ ?>

<div class="editscreen" id="edit-<?=$id;?>">
<form name="contact" action="<?=base_url();?>posttypes/sendmail/<?=$id;?>" method="post">




<p>
Name:<br />
<input name="name" type="text" value="<?php if(isset($mem)){ echo $mem['name']; } ?>" /><br /><br />

Email:<br />
<input name="email" type="text" value="<?php if(isset($mem)){ echo $mem['email']; } ?>" /><br /><br />


Message:<br />
<textarea name="message" rows="4" style="width: 75%;" value="<?php if(isset($mem)){ echo $mem['message']; } ?>"></textarea>
<br />


<div style="display: none;">

<input name="extra" type="text" value="" />

</div>


<input type="submit" value="<?=$this->lang->line('submit');?>" class="button" />

</p>


</form>
</div>
	
<?php }else{ ?>

<div class="editscreen droparea" id="edit-<?=$id;?>">



Click to create a form



</div>
<?php } ?>


 
