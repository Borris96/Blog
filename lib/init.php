<?php 
// echo __DIR__, '<br />'; // Directory of this file
// echo __FILE__, '<br />'; // Directory of this file with file name
// echo __LINE__;
header('Content-type:text/html;charset=utf8');
define('ROOT', dirname(__DIR__));
// echo ROOT;
require(ROOT.'/lib/mysql.php');
require(ROOT.'/lib/config.php');
?>