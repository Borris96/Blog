<?php 
/**
*
*
*/

function succ($msg){
	$res = 'Succeed';
	include(ROOT.'/admin/info.html');
	exit();
}

function fail($msg){
	$res = 'Fail';
	include(ROOT.'/admin/info.html');
	exit();
}

function getIP() // This remain unsloved
{ 
	static $ip = null;
	if ($ip !== null) {
		return $ip;
	}

	if (getenv('HTTP_X_FROWARD_FOR')) {
		$ip = getenv('HTTP_X_FROWARD_FOR');
	}  
	else if (getenv('HTTP_CLIENT_IP')) {
		$ip = getenv('HTTP_CLIENT_IP'); 
	}
	else if ($_SERVER["REMOTE_ADDR"]) {
		$ip = $_SERVER["REMOTE_ADDR"];
	} 
	else if (getenv("HTTP_X_FORWARDED_FOR")) {
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	}
	else if (getenv("HTTP_CLIENT_IP")) {
		$ip = getenv("HTTP_CLIENT_IP");
	} 
	else if (getenv("REMOTE_ADDR")) {
		$ip = getenv("REMOTE_ADDR"); 
	}
	else {
		$ip = "Unknown";
	} 
	return $ip; 
} 

/**
* @param int $count Total number of articles
* @param int $curr Current page
* @param int $cnt Number of articles on each page
*/
function getPage($count,$curr,$cnt){
	// Max page number
	$max = ceil($count/$cnt);
	// Left page number
	$left = max($curr-2,1);
	// RIght page number
	$right = $left+4;
	$right = min($max,$right);

	$left = max(1, $right-4);

	for($i=$left; $i<=$right; $i++) {
		$_GET['page'] = $i;
		$page[$i]= http_build_query($_GET);
		// $page[$i] = 'page='.$i;
	}
	return $page;
}

?>