<?php 
/**
*
*
*/

require('/var/www/html/Blog/lib/init.php');

$art_id = $_GET['art_id'];

if (!is_numeric($art_id)){
	fail('art_id should be a number.');
}

$sqli = "SELECT * FROM art WHERE art_id = $art_id";
$rs = mGetRow($sqli);
if (empty($rs)){
	fail('The article does not exsit.');
}

$sqli = "SELECT * FROM cat";
$cats = mGetall($sqli);
// var_dump($cats);

if (empty($_POST)){
	$sqli = "SELECT * FROM art WHERE art_id = $art_id";
	$art = mGetRow($sqli);
	// var_dump($art);

	include(ROOT.'/admin/artedit.html');
}
else{
	$table = 'art';
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

	$art['lastup'] = time();

	$rs = mExec($table,$art, $act='UPDATE', "art_id = $art_id"); // Must initialize which art_id to update.
	if (!$rs){
		fail('Update is failed...');
	}else {
		succ('Update successfully!');
	}
}

?>