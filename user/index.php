<?php 

require('/var/www/html/Blog/lib/init.php');

$sqli = "SELECT art_id, art.cat_id, cat_name, user_id, nick, title, content, pubtime, comm FROM art LEFT JOIN cat on art.cat_id = cat.cat_id";
$arts = mGetAll($sqli);

$sqli = "SELECT * FROM cat";
$cats = mGetAll($sqli);

include(ROOT.'/user/index.html');
?>