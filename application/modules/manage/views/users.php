
<div class="head"><h1>Manage Users</h1><a href="<?=base_url();?>users/edit" title="add user" class="add"><img src="<?=base_url();?>application/views/backend/img/add.png" /></a>

<div class="clear"></div>
</div>

<div class="content">


<div class="nav">
<ul id="tabs">
<li><a href="<?=base_url();?>manage/settings">General</a></li>
<li><a href="<?=base_url();?>manage/users" style="background-color: white; border-right: 0;">Users</a></li>

</ul>

</div>


<div class="main">
<div class="note">Add or edit users</div>

<ul>
<?php

$this->db->where('blog', $this->session->userdata('blog'));
$q=$this->db->get('users');

foreach($q->result() as $item){
	?>
    <li class="box" id="page_<?=$item->id;?>" style="padding-top: 5px; padding-bottom: 5px;"><table width="100%" border="0">
  <tr>
    <td><a href="<?=base_url();?>users/edit/<?=$item->id;?>"><?=$item->username;?></a></td>
    <td>&nbsp;</td>
    <td align="right"><?php if($q->num_rows()>1){ ?><a href="<?=base_url();?>users/delete/<?=$item->id;?>"><img src="<?=base_url();?>application/sources/icons/cross_trans.png" /></a><?php } ?></td>
  </tr>
</table>
</li>
    <?php
}
?>
</ul>
<br />


</div>

<div style="clear: both;"></div>

</div>