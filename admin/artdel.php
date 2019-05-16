<?php 
/**
*
*
*/

require('/var/www/html/Blog/lib/init.php');
// include(ROOT.'/admin/artlist.php');

$art_id = $_GET['art_id'];

if (!is_numeric($art_id)){
	fail('$art_id must be a number.');
}
$sqli = "DELETE FROM art WHERE art_id = $art_id";
$rs = mQuery($sqli);
if (!$rs){
	fail('Delete is failed.');
}else{
	succ('Delete successfully!');
}

?>