<?php 
require('/var/www/html/Blog/lib/init.php');

$cat_id = $_GET['cat_id'];
// var_dump($cat_id);

// cat_id is number?
if (!is_numeric($cat_id)){
	echo 'Invalid Category';
	exit();
}

// cat_id exists?
$sqli = "SELECT count(*) FROM cat WHERE cat_id = $cat_id";
$rs = mQuery($sqli);
if (mysqli_fetch_row($rs)[0] == 0) {
	echo 'No such category';
	exit();
}

// cat has articles?
$sqli = "SELECT count(*) FROM art WHERE cat_id = $cat_id";
$rs = mQuery($sqli);

if (mysqli_fetch_row($rs)[0] != 0) {
	echo "Articles in this category";
	exit();
}
//

$sqli = "DELETE FROM cat WHERE cat_id = $cat_id";
$rs = mQuery($sqli);

if ($rs){
	echo "Delete Successfully.";
	header("Refresh:1;url=./catlist.php");
}
else {
	echo "Delete Failed.";
	exit();
}
?>