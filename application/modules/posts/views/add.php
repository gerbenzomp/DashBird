<?php
if($_POST){
	
	unset($_POST['save']);
		
		if($_POST['title']==''){
			$_POST['title'] = 'Your title here';
		}
		
		if($_POST['body']==''){
			$_POST['body'] = 'Some body text';
		}
		
		$_POST['page'] = $page;
		
		
		$_POST['col'] = $col;
		
		
		$_POST['created'] = date("Y-m-d H:i:s");
		$_POST['blog'] = $this->session->userdata('blog');
		
		$data = $_POST;
		
		//$data = array('title'=>$_POST['title'], 'body'=>'Some body text', "page"=>$page, "type"=>$_POST['type'], "created"=>date("Y-m-d H:i:s"));
		$this->db->insert('posts', $data);
			
			header("Location: ".$_SERVER['HTTP_REFERER']);
		}
		else
		{
		?>


<form action="<?=base_url();?>posts/add/<?=$page;?>/<?=$col;?>" method="post" name="addForm">
        
        <!--
        Title:<br />
        <input name="title" type="text" />
        <br /><br />
        -->
       
        <div style="width: 510px;">
        <?php
        $posttypes = listFiles('posttypes');
		
		foreach($posttypes as $mytype){
			
			include(APPPATH."posttypes/".$mytype."/config.php");
			
			if($posttype['col']=="main"){
				
				$main[] = $mytype;
			}
			elseif($posttype['col']=="sidebar")
			{
				$side[] = $mytype;
			}
			
			
		}
		
		// pr($main);
		
		if($col=='main'){
			$mytypes = $main;
			
		}
		else
		{
			$mytypes = $side;
		}
		
		
		asort($mytypes);
		
		$total = count($mytypes);
		
		// $per_col = round($total/2);
		
		echo "<div>";
		
	
		foreach($mytypes as $type){
			
			
			?>
            <a class="buttonbox box" onclick="$('#type').val('<?=$type;?>'); document.forms.addForm.submit();" style="background-image: url(<?=base_url();?>application/posttypes/<?=$type;?>/icon.png);"><?=ucwords(str_replace('-', ' ', $type));?></a>
            
            <?php
		
		}
		
		echo "</div>";
		
		
		?>
        <div style="clear: both;"></div>
        
		
	
      
         
        
    
        
        
        </div>
        <div style="clear: both;"></div>
       
       <input type="hidden" name="type" value="article" id="type" />
       
        
        </form>

<!--
    <script type="text/javascript">
		
		function configure(type){
			
			$('#configure').load('<?=base_url();?>application/posttypes/'+type+'/back.php', function() {
 $("#configure input, #configure textarea, #configure select").uniform();
});
			
		}
		
		function remove(){
			$('#configure').html('');
		}
		
		</script>
        -->
        
		<?php
       
		}
		?>