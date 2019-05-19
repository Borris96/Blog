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
		// Update article number for this category.
		$sqli = "SELECT count(*) FROM art WHERE cat_id = $art[cat_id]";
		$catn['num'] = mGetOne($sqli);
		// echo $cat['num'];
		// exit();

		mExec('cat', $catn, 'UPDATE', "cat_id = $art[cat_id]");

		$sqli = "SELECT art_id FROM art ORDER BY art_id DESC LIMIT 1";
		$art_id = mGetOne($sqli);
		// Tag
		$tags = trim($_POST['tags']);
		$sqli = "UPDATE art SET tag = '$tags' WHERE art_id = $art_id"; //Where is a must!!!
		mQuery($sqli);
		if (empty($tags)) {
			succ('Added successfully!');
		}
		else {
			$sqli = "SELECT art_id FROM art ORDER BY art_id DESC LIMIT 1";
			$art_id = mGetOne($sqli);
			// $art_id = getLastID(); //?
			// echo $art_id;
			// exit();
			$tag = explode(',', $tags);
			// var_dump($tag);
			// exit();
			// $sqli = "INSERT INTO tag(art_id, tag) VALUES ($art_id, $v)"
			$sqli = "INSERT INTO tag(art_id, tag) VALUES ";
			foreach ($tag as $v) {
				$sqli .= '('.$art_id.', '."'$v'".'), ';
			}
			$sqli = rtrim($sqli, ', ');
			// echo $sqli;
			// exit();
			$trs = mQuery($sqli);
			if (!$trs){
				$sqli = "Delete FROM art WHERE art_id = $art_id";
				mQuery($sqli);
				fail('Tag insert is failed.');
			}
			else{
				succ('Added successfully!');
			}
		}
	}
}

?>