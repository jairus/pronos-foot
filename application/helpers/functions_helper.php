<?php
//overide site_url functions
function site_url($uri = '', $nocdn = false){
	$CI =& get_instance();
	return $CI->config->item('base_url').$CI->config->item('index_page').ltrim($uri,"/");
}
function htmlentitiesX($str){
	$str = str_replace("&amp;", "&", $str);
	return htmlentities($str, ENT_COMPAT, "UTF-8");
}
function sanitizeX($str){
	$str = addslashes($str);
	$str = str_replace("\n", "\\n", $str);
	$str = str_replace("\r", "\\r", $str);
	return $str;
}
function db_escape($data){
	$ci = & get_instance();
	return $ci->db->escape_str($data);
}
function pre($r){
	echo "<pre>";
	print_r($r);
	echo "</pre>";
}

function file_url($filepath){
	$path = explode("user_uploads", $filepath);
	$path = ltrim($path[1], "/");
	$path = ltrim($path, "\\");
	return site_url("user_uploads")."/".$path;
}
function upload_file($file, $abspath, $newfilename=""){
	if(!trim($newfilename)){
		$newfilename = $file['name'];
	}
	if($file['error']==0){
		$abspath = rtrim($abspath, "/");
		$absfile = $abspath."/".$newfilename;
		$i = 1;
		$parts = pathinfo($newfilename);
		while(file_exists($absfile)){
			$newfilename = $parts['filename'].$i.".".$parts['extension'];
			$absfile = $abspath."/".$newfilename;
			$i++;
		}	
		if(move_uploaded_file($file['tmp_name'], $absfile)){
			return $absfile;
		}
	}
	return false;
}

?>