<?php
/**
*
**/ 
require('/var/www/html/Blog/lib/init.php');

// Get category names
$sqli = 'SELECT * FROM cat';
$result = mQuery($sqli);

if (!$result){
	echo 'Unable to get result';
	exit();
}
else{
    $cat = mGetall($sqli);
	// print_r($cat);
} 
// require('./catlist.html');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
<link rel="stylesheet" href="../css/reset.css">
<link rel="stylesheet" href="../css/adm.css">
</head>
<body>
    <header>
        <h1>Blog后台管理界面</h1>
    </header>
    <div id="main">
        <div id="lside">
            <aside>
                <h4>栏目管理</h4>
                <ul>
                    <li><?php echo "<a href='catlist.php'>";?>栏目列表</a></li>
                    <li><?php echo "<a href='catadd.php'>";?>添加栏目</a></li>
                </ul>
            </aside>
            <aside>
                <h4>文章管理</h4>
                <ul>
                    <li><a href="">文章列表</a></li>
                    <li><a href="">发布文章</a></li>
                </ul>
            </aside>
            <aside>
                <h4>个人中心</h4>
                <ul>
                    <li><a href="">修改密码</a></li>
                    <li><a href="">退出登陆</a></li>
                </ul>
            </aside>
        </div>
        <div id="rside">
            <table>
                <tr>
                    <td>序号</td>
                    <td>栏目名称</td>
                    <td>xxx</td>
                    <td>操作</td>
                </tr>
                <?php foreach($cat as $v) {?>
                <tr>
                    <td><?php echo $v['cat_id'];?></td>
                    <td><?php echo $v['cat_name'];?></td>
                    <td><span class="badge"><?php echo $v['num'];?></span></td>
                    <td>
                    	<?php echo "<a href='catdel.php?cat_id=$v[cat_id]'>";?> 删除 </a>
                    	<?php echo "<a href='catedit.php?cat_id=$v[cat_id]'>";?> | 编辑 </a>
                    </td>
                </tr><?php }?>
            </table>
        </div>
    </div>
    <footer>
        Copyright &copy; 2019 · GeneratePress · WordPress
    </footer>
</body>
</html>