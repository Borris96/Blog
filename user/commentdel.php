<?php 
require('/var/www/html/Blog/lib/init.php');

$comment_id = $_GET['comment_id'];

$sqli = "DELETE FROM comment WHERE comment_id = $comment_id";
$rs = mQuery($sqli);

if (!$rs) {
	fail('Delete is failed');
} else {
	succ('Delete successfully!');
}

?>