<?php 

require('/var/www/html/Blog/lib/init.php');

$cat_id = $_GET['cat_id'];

if (empty($_POST)){
	$sqli = "SELECT cat_name FROM cat WHERE cat_id = $cat_id";
	$cat = mGetRow($sqli);
	// var_dump($cat);
}
else {
    $catname = trim($_POST['catname']);
    if (empty($catname)){
        echo 'The category name should not be empty.';
        header("Refresh:1; url='./catedit.php?cat_id=$cat_id'");
    }
    else
    {
        $sqli = "UPDATE cat SET cat_name = '$catname' where cat_id = $cat_id";
        $result = mQuery($sqli);
        if (!$result){
            echo 'Update Failed.';
            header("Refresh:1; url='./catedit.php?cat_id=$cat_id'");
        }
        else {
            // header("Refresh:3;url=./catlist.php");
            header("location:./catlist.php"); // Redirect to list
            echo 'Update Successful.';
        }   
    }
}
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
                    <li><a href="">栏目列表</a></li>
                    <li><a href="">添加栏目</a></li>
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
            <form action="" method="post">
                <div class="form-group">
                    <label>栏目名称:</label>
                    <p>
                        <input type="text" name="catname" value="<?php echo "$cat[cat_name]"; ?>"> <!-- Here is a problem -->
                    </p>
                </div>
                <div class="form-group">
                    <label>&nbsp;</label>
                    <p>
                        <button type="submit">提交</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <footer>
        Copyright &copy; 2019 · GeneratePress · WordPress
    </footer>
</body>
</html>