<?php
function auth(){
	$CI =& get_instance();
	if(logged_in()==0){
		header("Location: ".base_url());
		
	
	}
	
}


function site_url(){
	$CI =& get_instance();
	
	if($CI->session->userdata('blog')=='default'){
		$blog = '';
	}
	else
	{
		$blog = $CI->session->userdata('blog')."/";
	}
	
	return base_url().$blog;
}

function niceUrl($string){
	
	//$string = str_replace(" ", "-", $string);
	$string = preg_replace("![^a-z0-9]+!i", "-", $string);
	$string = strtolower($string);
	return $string;
}

function decodeUrl($string){
	$string = str_replace("-", " ", $string);

	return $string;
}

function getPostId($url){
	return str_replace("http://cineblah.tumblr.com/post/", "", $url);
}

function EmptyDir($dir, $DeleteMe) {
    if(!$dh = @opendir($dir)) return;
    while (false !== ($obj = readdir($dh))) {
        if($obj=='.' || $obj=='..') continue;
        if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
    }

    closedir($dh);
    if ($DeleteMe){
        @rmdir($dir);
    }
}

function listFiles($dir){

		$exclude = array('.', '.DS_Store', '..', 'index.html', '.htaccess', 'default');
		
		$handle = opendir(APPPATH.$dir.'/');
		
		while ( false !== ($file = readdir($handle)))
		{
			if(!in_array($file, $exclude))
			{
			$files[] = $file;
			}
		}
		
		closedir($handle);
		
		return $files;

}

function hook($name, $data=''){
	

	
	include(APPPATH.'config/plugins.php');
	
	
	
	foreach($plugins as $item){
		if(file_exists(APPPATH."plugins/".$item."/hooks/".$name.".php")){
			
		
			
			include(APPPATH."plugins/".$item."/hooks/".$name.".php");
			
		}
	}
	
	
}

function pr($var){
	echo "<pre>";
	print_r($var);
	echo "</pre>";	
}

function debug(){
	if($_SERVER['REMOTE_ADDR']=""){ // your ip here
		return true;
	}
	else
	{
		return false;
	}
}


function logged_in(){
	$CI =& get_instance();
	if($CI->session->userdata('logged_in')==1){
		return 1;
	}
	else
	{
		return 0;
	}
	
}

function getSet($key){
	$CI =& get_instance();
	$CI->db->where('name', $key);
	$CI->db->where('blog', $CI->session->userdata('blog'));
	$q=$CI->db->get('settings');
	if($q->num_rows() > 0){
	$set = $q->row();
	
	return $set->value;
	}
	
}


function lookForFile($name, $posttype){
	
	// allows you to override front in themes folder
	if(file_exists(APPPATH."views/themes/posttypes/".$posttype."/".$name.".php")){
		return(APPPATH."views/themes/posttypes/".$posttype."/".$name.".php");
	}
	// or in posttypes folder
	elseif(file_exists(APPPATH."posttypes/".$posttype."/".$name.".php")){
		return(APPPATH."posttypes/".$posttype."/".$name.".php");
	}
	elseif(file_exists(APPPATH."posttypes/default/".$name.".php")){
		return(APPPATH."posttypes/default/".$name.".php");
	}
	else
	{
	return FALSE;	
	}
	
}

function FetchPage($path)
			{
				$file = fopen($path, "r"); 
				
				if (!$file)
				{
				exit("The was a connection error!");
				} 
				
				$data = '';
				
				while (!feof($file))
				{
				// Extract the data from the file / url
				
				$data .= fgets($file, 1024);
				}
				return $data;
}

	function imageFromUrl($url){
		
			
			// Fetch page
			$string = FetchPage($url);
			
			// Regex that extracts the images (full tag)
			$image_regex_src_url = '/<img[^>]*'.
			
			'src=[\"|\'](.*)[\"|\']/Ui';
			
			preg_match_all($image_regex_src_url, $string, $out, PREG_PATTERN_ORDER);
			
			$img_tag_array = $out[0];
			
			// echo "<pre>"; print_r($img_tag_array); echo "</pre>";
			
			// Regex for SRC Value
			$image_regex_src_url = '/<img[^>]*'.
			
			'src=[\"|\'](.*)[\"|\']/Ui';
			
			preg_match_all($image_regex_src_url, $string, $out, PREG_PATTERN_ORDER);
			
			$images_url_array = $out[1];
			
			if(strpos('rss', $images_url_array[2])){
			return $images_url_array[3];
			}
			else
			{
				return $images_url_array[2];	
			}
			
			

		
	}
	
	function mysql_date(){
	return date("Y-m-d H:i:s");
	}
	
	
	function checkEmail($email){
    return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
	}



	function humanize($var){
	
	$var = str_replace('-', ' ', $var);
	$var = ucwords($var);
	return $var;
		
	}
?>