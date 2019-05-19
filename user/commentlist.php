<?php 
require('/var/www/html/Blog/lib/init.php');


$sqli = "SELECT count(*) FROM comment WHERE 1";
$count = mGetOne($sqli);

// Paginate
$curr = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$cnt = 10;
$page = getPage($count, $curr, $cnt);

if ($count != 0){

	$sqli = "SELECT comment_id, pubtime, nick, email, content, ip FROM comment ORDER BY comment_id ASC LIMIT ".($curr-1)*$cnt.','.$cnt;
	$comments = mGetAll($sqli); 

}

include(ROOT.'/user/commentlist.html');
?>