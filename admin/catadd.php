
<?php 
/**
* catadd.php
* Adding category for the blog.
**/

require('/var/www/html/Blog/lib/config.php');
require('/var/www/html/Blog/lib/mysql.php');
if (empty($_POST)){
	include('./catadd.html');
}
else{
	//If $_POST exists, check if it is empty.
	$catname = trim($_POST['catname']);
	// var_dump($catname);
	if (empty($catname)){
		exit('The category name should not be empty.');
	}
	
	$sqli = "INSERT INTO cat(cat_name) VALUES ('$catname')";
	$result = mQuery($sqli);

	if (!$result){
		echo 'Add Unsuccessfully.';
		exit();
	}
	else{
		echo 'Add Successfully';
		header("Refresh:1;url=./catlist.php");
	}
}


 ?>