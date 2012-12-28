
<div class="simplenote">This is the only HD embed option that still works after YouTube changed their embed system mid 2012. Also works on iPhone/iPad!
</div>


<div class="post">




<div class="meta">
<form action="<?=base_url();?>page/<?=PAGE;?>" method="post">


<label>YouTube URL:</label><br />
<input type="text" name="url" value="<?php if(isset($_POST['url'])){ echo $_POST['url']; }else{ echo "https://www.youtube.com/watch?v=jJRh5SyEbhE"; } ?>" onclick="if(this.value=='https://www.youtube.com/watch?v=jJRh5SyEbhE'){ this.value='' }" size="35" />


<br /><br />
<label>Dimensions:</label><br />
<select name="dims">
<option value="480x270"<?php if(isset($_POST['dims']) && $_POST['dims']=='480x270'){ echo " selected"; } ?>>480x270</option>
<option value="560x315"<?php if(isset($_POST['dims']) && $_POST['dims']=='560x315'){ echo " selected"; } ?>>560x315</option>
<option value="600x338"<?php if(isset($_POST['dims']) && $_POST['dims']=='600x338'){ echo " selected"; } ?>>600x338</option>
<option value="640x360"<?php if(isset($_POST['dims']) && $_POST['dims']=='640x360'){ echo " selected"; } ?>>640x360</option>




</select>

<br /><br />
<label>Quality:</label><br />
<select name="qual">
<option value="hd720"<?php if(isset($_POST['qual']) && $_POST['qual']=='hd720'){ echo " selected"; } ?>>720p</option>
<option value="hd1080"<?php if(isset($_POST['qual']) && $_POST['qual']=='hd1080'){ echo " selected"; } ?>>1080p</option>

</select>

<br /><br />

<input type="submit" value="generate embed code" />




</form>


</div>



<div class="content">


<?php
if(!$_POST){
	

	
	
	?>
    
    <div class="info">
    

   
 
 <div style="font-size: 12px;">
    Embed Code:
    <br>
    <textarea class="uniform" name="embed" id="embed" rows="5" style="width: 99%;">&lt;iframe width="640" height="360" src="http://youtube.com/v/jJRh5SyEbhE&amp;vq=hd1080" frameborder="0" allowfullscreen&gt;&lt;/iframe&gt;
&lt;script type="text/javascript"&gt;var isIphone = !!navigator.userAgent.match(/iPhone/i);var isIpad = !!navigator.userAgent.match(/iPad/i);if(isIpad || isIphone){document.getElementById('jJRh5SyEbhE').src = 'http://www.youtube.com/embed/jJRh5SyEbhE';}&lt;/script&gt;</textarea>
	<br><br>
	Preview:
    <br>
    
  
	<iframe src="http://youtube.com/v/jJRh5SyEbhE&amp;vq=hd1080" id="jJRh5SyEbhE" allowfullscreen="" frameborder="0" height="360" width="640"></iframe>

   <script type="text/javascript">
	var isIphone = !!navigator.userAgent.match(/iPhone/i);
	var isIpad = !!navigator.userAgent.match(/iPad/i);
	if(isIpad || isIphone){
	 document.getElementById('jJRh5SyEbhE').src = 'http://www.youtube.com/embed/jJRh5SyEbhE'; 	
	}
	</script>




        </div>
 
 </div>
 <?php
	
}


if($_POST){
	
	
	if(strpos($_POST['url'], 'youtube.com')===FALSE){
		?>
        <div class="error">
        
        <h2>Oops...,</h2>
        
        Please fill in a valid YouTube URL (e.g. https://www.youtube.com/watch?v=TS6AXJWSj6E)
        
        </div>
        <?php
		
		
	}
	else
	{
	
	
	$url = $_POST['url'];
	$url = explode("=", $url);
	$url = $url[1];
	$url = explode('&', $url);
	$url = $url[0];
	
	
	$dims = explode("x", $_POST['dims']);
	$width = $dims[0];
	$height = $dims[1];
	
	$qual = $_POST['qual'];
	?>
<div style="font-size: 12px;">
    Embed Code:
    <br />
    <textarea name="embed" id="embed" rows="5" style="width: 99%;"><iframe width="<?=$width;?>" height="<?=$height;?>" src="http://youtube.com/v/<?=$url;?>&vq=<?=$qual;?>" frameborder="0" allowfullscreen></iframe>
<script type="text/javascript">var isIphone = !!navigator.userAgent.match(/iPhone/i);var isIpad = !!navigator.userAgent.match(/iPad/i);if(isIpad || isIphone){document.getElementById('<?=$url;?>').src = 'http://www.youtube.com/embed/<?=$url;?>';}</script></textarea>
	<br /><br />
	Preview:
    <br />
    
  
	<iframe width="<?=$width;?>" height="<?=$height;?>" src="http://youtube.com/v/<?=$url;?>&vq=<?=$qual;?>" frameborder="0" id="<?=$url;?>" allowfullscreen></iframe>

   <script type="text/javascript">
	var isIphone = !!navigator.userAgent.match(/iPhone/i);
	var isIpad = !!navigator.userAgent.match(/iPad/i);
	if(isIpad || isIphone){
	 document.getElementById('<?=$url;?>').src = 'http://www.youtube.com/embed/<?=$url;?>'; 	
	}
	</script>




        </div>
	<?php
	if($_POST['url'] != 'https://www.youtube.com/watch?v=jJRh5SyEbhE'){
		$data=array('url'=>$_POST['url'], 'ip'=>$_SERVER['REMOTE_ADDR'], 'created'=>date('Y-m-d H:i:s'));
		$this->db->insert('movies', $data);
	}
		
		
	
	}
}
?>




<div style="clear: both;"></div>

  



</div>
<div style="clear: both;"></div>
</div>
<br />
  <?php hook('between-posts'); ?>