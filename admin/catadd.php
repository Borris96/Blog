
<?php 
/**
* catadd.php
* Adding category for the blog.
**/

require('/var/www/html/Blog/lib/init.php');
if (empty($_POST)){
	include(ROOT . '/admin/catadd.html');
}
else{
	// If $_POST exists, check if it is empty.
	$catname = trim($_POST['catname']);
	// var_dump($catname);
	if (empty($catname)){
        // echo 'The category name should not be empty.';
        // header("Refresh:1; url='./catadd.php'");
        fail('The category name should not be empty.');
	}

    // Check if it has already exsited
    // var_dump($catname);
    else{
        $sqli = "SELECT count(*) FROM cat WHERE cat_name = '$catname'";
        $name = mGetOne($sqli);
        // var_dump($name);
        if ($name != 0){
            fail('The category name has already existed.');
            // header("Refresh:1; url='./catadd.php'");
        }
        
        else{
            $sqli = "INSERT INTO cat(cat_name) VALUES ('$catname')";
            $result = mQuery($sqli);

            if (!$result){
                fail('Add Unsuccessfully.');
                // echo 'Add Unsuccessfully.';
                // exit();
            }
            else{
                // echo 'Add Successfully';
                succ('Add Successfully.');
                // header("Refresh:1;url=./catlist.php");
            }
        }
    }

}

?>