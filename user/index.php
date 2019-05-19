<?php 

require('/var/www/html/Blog/lib/init.php');

// Check if the user want all articles or articles in a sepcific catagoty
if (isset($_GET['cat_id'])){
	$where = "AND art.cat_id = $_GET[cat_id]";
}
else {
	$where = '';
}
// Number of all articles.
$sqli = "SELECT count(*) FROM art";
$all = mGetOne($sqli);
// Here should consider condition that no article in a category.
$sqli = "SELECT count(*) FROM art WHERE 1 ".$where;
$count = mGetOne($sqli);
if ($count == 0){
	$count = $all;
}

// Paginate
$curr = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$cnt = 5;
$page = getPage($count, $curr, $cnt);
// print_r($page);
// exit();

if ($count != 0){
	$sqli = "SELECT art_id, art.cat_id, cat_name, user_id, nick, title, content, pubtime, comm, tag FROM art LEFT JOIN cat on art.cat_id = cat.cat_id WHERE 1 ".$where. " ORDER BY art_id DESC LIMIT ".($curr-1)*$cnt.','.$cnt;
	$arts = mGetAll($sqli);
}


$sqli = "SELECT cat_name, cat_id, num FROM cat";
$cats = mGetAll($sqli);

include(ROOT.'/user/index.html');
?>