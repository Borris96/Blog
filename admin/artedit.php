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

// $sqli = "SELECT tag FROM tag WHERE art_id = $art_id";
// $tags = mGetAll($sqli);
// var_dump($tags);
// exit();

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

	$art['tag'] = trim($_POST['tags']);


	$art['lastup'] = time();

	// Tag
	$tags = trim($_POST['tags']);

	$rs = mExec($table,$art, $act='UPDATE', "art_id = $art_id"); // Must initialize which art_id to update.
	if (!$rs){
		fail('Update is failed...');
	}else {
		if (empty($tags)) {
			succ('Updated successfully!');
		}
		else {
			$sqli = "DELETE FROM tag WHERE art_id = $art_id";
			mQuery($sqli);
			$tag = explode(',', $tags);

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
				succ('Updated successfully!');
			}
		}

	}

}

?>