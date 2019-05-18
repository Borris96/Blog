<?php 
/**
*
*
*/
require('/var/www/html/Blog/lib/init.php');
$art_id = $_GET['art_id'];
$sqli = "SELECT count(*) FROM art WHERE art_id = $art_id";
$rs  = mGetOne($sqli);
// echo $rs;
// exit();

if ($rs == 0){
	header("Location:index.php");
	exit();
}

else {
	$sqli = "SELECT art_id, art.cat_id, cat_name, user_id, nick, title, content, pubtime, comm FROM art LEFT JOIN cat on art.cat_id = cat.cat_id WHERE 1";
	$art = mGetRow($sqli);
	// var_dump($art);

	$sqli = "SELECT cat_name, cat_id, num FROM cat";
	$cats = mGetAll($sqli);

	$sqli = "SELECT count(*) FROM art";
	$count = mGetOne($sqli);

	if (!empty($_POST)){
		$comm = array();
		$comm['art_id'] = $art_id;
		$comm['nick'] = $_POST['username'];
		$comm['content'] = $_POST['comment'];
		$comm['email'] = $_POST['email'];
		$comm['pubtime'] = time();
		$crs = false;
		if (!empty($comm['content']) && !empty($comm['email'])){
			$crs = mExec('comment',$comm);
		}
		// var_dump($crs);
		// exit();
		if ($crs !== false){ // If update successfully, redirect to the last page.
			$ref = $_SERVER['HTTP_REFERER'];
			header("Location: $ref");
		}
	}

	$sqli = "SELECT art_id, nick, content, pubtime FROM comment WHERE art_id = $art_id";
	$comment = mGetAll($sqli);

	include(ROOT.'/user/art.html');
}

?>