<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$site_title;?> - <?=$title;?></title>

<link rel="stylesheet" href="<?=base_url();?>/application/views/themes/dashbird/style.css" type="text/css" media="screen">


<?=hook("head");?>

<style type="text/css">
#menu ul{
margin: 0;
padding: 0;	
}

#menu ul li{
	list-style-type: none;
	display: inline;
}


</style>


</head>

<body>

<?=hook("after-body");?>

<div id="header">

    <div class="wrapper">
    <div id="nav">
    
    <span style="float: left;"><h1 style="margin-top: 10px; font-size: 22px;"><a href="<?=site_url();?>" style="color: #FC0;"><?=$site_title;?></a></h1></span>
    
     <span style="float: right;" id="menu"><?=$menu;?></span>
    
    
    </div>
    
    <div id="tagline"<?php if($description!=''){?> style="padding-top: 0px;"<?php } ?>>
    <h1><?php echo $title; ?></h1>
    
    <?php if($description!=''){ echo "<div id='sub'>".$description."</div>"; } ?>
    
    </div>
    
    </div>

</div>


<div class="wrapper" id="maincontent">


<?=$maincontent;?>




</div>
<br />
<div style="clear: both;"></div>


<div id="footer">

<div class="wrapper" style="text-align: left;">
<?=$sidebar;?>
</div>


</div>


<?php hook('footer'); ?>



</body>
</html>
