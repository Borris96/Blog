<?php
/**
* mysql.php mysql 操作的系列函数
* @author Borris
*/

/**
* 连接数据库
* @return resource 成功返回一个资源
*/

function mConn(){
	static $link = null;
	// $server = 'localhost';
	// $username = 'root';
	// $password = '19961127';
	// $dbname = 'Blog';
	if ($link == null){
		$cfg = include(ROOT . '/lib/config.php');
		$link = mysqli_connect($cfg['server'], $cfg['username'], $cfg['password'], $cfg['dbname']);
		if (!$link){
			die('Connection Failed.'.mysql_connection_error());
		}
		mysqli_set_charset($link, $cfg['charset']);
	}

	return $link;
}

/**
* 执行 sql 语句
*
* @param string $sql
* @return mixed 返回布尔型值 / 数组
*/

function mquery($sqli){
	return mysqli_query(mConn(),$sqli);
}

/**
* 查询 select 语句并返回多行 , 适用于查多条数据
* @param string $sql select 语句
* @return mixed array 查询到返回二维数组 , 未查到返回 false
*/

function mGetAll($sqli){
	$rs = mQuery($sqli);
	if (!$rs){
		return false;
	}
	else{
		$arr = array();
		while ($row = mysqli_fetch_assoc($rs)){ // While data exist
			$arr[] = $row;
		}
	}

	return $arr;
}

// $sql = 'select * from cat';
// print_r(mGetAll($sql));

/**
* 查询 select 语句并返回一行
* @param string $sql select 语句
* @return mixed array 查询到返回一维数组 , 未查到返回 false
*/

function mGetRow($sqli){
	$rs = mQuery($sqli);
	return $rs? mysqli_fetch_assoc($rs) : false;
}

// $sqli = 'select cat_name from cat where cat_id = 3';
// print_r(mGetRow($sqli));

/**
* 查询 select 语句并返回一个单元
* @param string $sql select 语句
* @return mixed string 返回 1 个标量值未查到返回 false
*/

function mGetOne($sqli){
	$rs = mQuery($sqli);
	// var_dump($rs);
	if ($rs){
		$row = mysqli_fetch_row($rs); // row use integer as index, and assoc use string as index (count(*) in this case)
		return $row[0];
	}
	else{
		return false;
	}
}

// $sql = 'select count(*) from cat';
// // echo mGetOne($sql);
// print_r(mGetOne($sql));

/**
* combine insert into and update query and use mQuery()
* @param str $table table name
* @param arr $data array
* @param str $act default value "INSERT INTO"
* @param str
* @return bool insert/update successfullly or failed
*/

function mExec($table, $data, $act = 'INSERT', $where = '0'){
	if ($act == 'INSERT'){
		$sqli = "INSERT INTO $table (";
		$sqli .= implode(",", array_keys($data));
		$sqli .= ") VALUES ('";
		$sqli .= implode("','", array_values($data));
		$sqli .= "')";
	}
	else if ($act == 'UPDATE'){
		$sqli = "UPDATE $table SET ";
		foreach ($data as $key => $value) {
			$sqli .= $key."='".$value."', ";
		}
		$sqli = rtrim($sqli, ', ');
		$sqli .= " where ".$where;
	}
	// echo $sqli;
	return mQuery($sqli);
}

// $data = array('title'=>'My First Article', 'content'=>'Wirtten in the afternoon of May 12th.', 'pubtime'=>'20190512');
//INSERT INTO art(title, content, pubtime) VALUES ('aaa','bbb','1999');
// mExec('art', $data);

// $newdata = array('title'=>'New My First Article', 'content'=>'An updated version.', 'pubtime'=>'20190512');
// UPDATE art SET title = 'New First Article', content = 'I update it.', pubtime = '20190512' where art_id = 1;
// mExec('art', $newdata, 'UPDATE', 'art_id = 1');
//INSERT INTO cat(cat_id, cat_name) VALUES(13, 'test')

/**
* get last id
* @return mysqli insert id
*/

function getLastID(){
	return mysqli_insert_id(mConn());
}
?>