<?php 
/**
*
*
*/
require('/var/www/html/Blog/lib/init.php');

$sqli = "SELECT * FROM cat";
$cats = mGetAll($sqli);

if (empty($_POST)){
	include(ROOT.'/admin/artadd.html');
}
else{
	$art['title'] = trim($_POST['title']);
	if (empty($art['title'])){
		fail('Title should not be empty.');
	}

	$art['cat_id'] = $_POST['cat_id'];
	if (!is_numeric($art['cat_id'])){
		fail('cat_id must be a number.');
	} 

	$art['content'] = trim($_POST['content']);
	if (empty($art['content'])){
		fail('Content should not be empty.');
	}

	$art['pubtime'] = time();

	$table = 'art';

	$rs = mExec($table, $art);

	if (!$rs){
		fail('Added is failed...');
	}
	else{
		$sqli = "SELECT count(*) FROM art WHERE cat_id = $art[cat_id]";
		$catn['num'] = mGetOne($sqli);
		// echo $cat['num'];
		// exit();

		mExec('cat', $catn, 'UPDATE', "cat_id = $art[cat_id]");
		succ('Added successfully!');
	}
}

?>