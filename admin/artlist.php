<?php 
/**
*
*
*/

require('/var/www/html/Blog/lib/init.php');

$sqli = "SELECT art_id, art.cat_id, cat_name, pubtime, title, comm, content FROM art LEFT JOIN cat ON art.cat_id = cat.cat_id";
$arts = mGetAll($sqli); //You must get the $arts value before you include the artlist page, or the value of $arts in the html page is null.
// var_dump($arts);

include(ROOT.'/admin/artlist.html');

?>