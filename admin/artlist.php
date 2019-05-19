<?php 
/**
*
*
*/

require('/var/www/html/Blog/lib/init.php');

$sqli = "SELECT count(*) FROM art WHERE 1";
$count = mGetOne($sqli);

// Paginate
$curr = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$cnt = 10;
$page = getPage($count, $curr, $cnt);

if ($count != 0){

	$sqli = "SELECT art_id, art.cat_id, cat_name, pubtime, title, comm, content FROM art LEFT JOIN cat ON art.cat_id = cat.cat_id ORDER BY art_id ASC LIMIT ".($curr-1)*$cnt.','.$cnt;
	$arts = mGetAll($sqli); //You must get the $arts value before you include the artlist page, or the value of $arts in the html page is null.
	// var_dump($arts);

}

include(ROOT.'/admin/artlist.html');

?>