<?php
/**
 * 
 * @authors start_heart (704469176@qq.com)
 * @date    2015-05-18 10:53:48
 * @version $Id$
 */

include "inc/mysql.php";
$folie = new mysql;
$connect = $folie->link("");
//开启一个会话
session_start();
$error_msg = "";
//如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
if(!isset($_SESSION['user_id'])){
    if(isset($_POST['submit'])){//用户提交登录表单时执行如下代码
        $user_username = trim($_POST['username']);
        $user_password = trim($_POST['password']);
        if(!empty($user_username)&&!empty($user_password)){
            //MySql中的SHA()函数用于对字符串进行单向加密
            $query1 = "SELECT id,name FROM administrator WHERE name = '$user_username' AND pw = '$user_password' ";
            //用用户名和密码进行查询
            $result1 = $folie->excu($query1);
            //若查到的记录正好为一条，则设置SESSION，同时进行页面重定向
            if(mysql_num_rows($result1)==1){
                $row1 = mysql_fetch_array($result1);
                $_SESSION['user_id']=$row1['id'];
                $_SESSION['username']=$row1['name'];
                $home_url = 'index.php';
                header('Location: '.$home_url);
            }else{//若查到的记录不对，则设置错误信息
                $error_msg = 'Sorry, you must enter a valid username and password to log in.';
            }
        }else{
            $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
    }
}else{//如果用户已经登录，则直接跳转到已经登录页面
    $home_url = 'index.php';
    header('Location: '.$home_url);
}
?>
<!DOCTYPE html>
<html lang="zh-en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>农业管理系统登录</title>
<meta name="description" content="农业管理系统登录">
<meta name="keywords" content="农业管理系统">
<link rel="stylesheet" type="text/css" href="css/base.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link href="css/login.css" rel="stylesheet">
</head>
<body>

	<!--通过$_SESSION['user_id']进行判断，如果用户未登录，则显示登录表单，让用户输入用户名和密码-->
        <?php
        if(!isset($_SESSION['user_id'])){
            echo '<p class="error">'.$error_msg.'</p>';
        ?>
        <!-- $_SERVER['PHP_SELF']代表用户提交表单时，调用自身php文件 -->
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="form">
    	<h2>基于RFID的管理系统登录</h2>

    	<div class="form-group">
    		<label for="username">账号：</label>
    		<input type="text" class="form-control" id="username" placeholder="输入用户名" name="username"></div>
    	<div class="form-group">
    		<label for="password">密码：</label>
    		<input type="password" class="form-control" id="password" placeholder="输入密码" name="password"></div>
    	<div class="form-submit">
    	<input type="submit" class="btn btn-primary" value="登录" name="submit">
    	<a href="#" class="form-pwForget">忘记密码</a>
    	</div>
    </form>
    <?php
        }
    ?>

</body>
</html>