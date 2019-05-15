<?php 
/**
*
*
*/

function succ($msg){
	$res = 'Succeed';
	include(ROOT.'/admin/info.html');
	exit();
}

function fail($msg){
	$res = 'Fail';
	include(ROOT.'/admin/info.html');
	exit();
}

?>