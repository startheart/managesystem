<?php
/**
 * 
 * @authors start_heart (you@example.org)
 * @date    2015-03-04 14:30:49
 * @version 1.0
 */
header("Content-type: text/html; charset=utf-8");
//使用会话内存储的变量值之前必须先开启会话
session_start();
//使用一个会话变量检查登录状态
if(!isset($_SESSION['username'])){
    //echo 'You are Logged as '.$_SESSION['username'].'<br/>';
    //点击“Log Out”,则转到logOut页面进行注销
    //echo '<a href="logOut.php"> Log Out('.$_SESSION['username'].')</a>';
    $home_url = 'login.php';
    header('Location: '.$home_url);
}
/**在已登录页面中，可以利用用户的session如$_SESSION['username']、
 * $_SESSION['user_id']对数据库进行查询，可以做好多好多事情*/
include "inc/mysql.php";
$folie = new mysql;
$connect = $folie->link("");
?>

<!DOCTYPE html>
<html lang="zh-en">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>企业员工后台管理系统</title>
	<meta name="description" content="企业员工后台管理系统">
	<meta name="keywords" content="晨电智能工作室， 后台管理系统， RFID， Wed">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="icon" href="image/icon.png"></head>
<body>
	<div class="container-fluid">
		<div class="row" id="div-row">
			<div class="col-sm-3 col-md-2 sidebar">
				<div class="logo">
					<h4>晨电智能</h4>
					<h4>工作室</h4>
				</div>
				<div class="nav nav-sidebar tab">
					<div class="tab-wrapper">
						<a href="javascript:;" class="menu" name="sub-menu1">职员档案</a>
						<ul class="tab-menuWrapper" id="sub-menu1">
							<li class="J_tab-menu">
								<a href="#">员工列表</a>
							</li>
							<li class="J_tab-menu">
								<a href="#">职员录入</a>
							</li>
						</ul>
					</div>
					<div class="tab-wrapper">
						<a href="javascript:;" class="menu" name="sub-menu1">离职信息</a>
						<ul class="tab-menuWrapper" id="sub-menu1">
							<li class="J_tab-menu">
								<a href="#">离职统计信息</a>
							</li>
							<li class="J_tab-menu">
								<a href="#">离职信息录入</a>
							</li>
						</ul>
					</div>
					<div class="tab-wrapper">
						<a href="javascript:;" class="menu" name="sub-menu1">岗位调整</a>
						<ul class="tab-menuWrapper" id="sub-menu1">
							<li class="J_tab-menu">
								<a href="#">岗位调整统计表</a>
							</li>
							<li class="J_tab-menu">
								<a href="#">人员岗位调整</a>
							</li>
						</ul>
					</div>
					<div class="tab-wrapper">
						<a href="javascript:;" class="menu" name="sub-menu1">考勤信息</a>
						<ul class="tab-menuWrapper" id="sub-menu1">
							<li class="J_tab-menu">
								<a href="#">员工考勤列表</a>
							</li>
								<li class="J_tab-menu">
									<a href="#">今日签到</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<nav class="navbar navbar-inverse">
						<div class="container-fluid">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="#">职员后台管理系统</a>
							</div>
							<div id="navbar" class="navbar-collapse collapse">
								<ul class="nav navbar-nav navbar-right">
									<li>
										<a href="index.php">Dashboard</a>
									</li>
									<li>
										<a><?php echo '管理员：'.$_SESSION['username']?></a>
									</li>
									<li>
										<a href="logOut.php">登出</a>
									</li>
								</ul>
								<form class="navbar-form navbar-right">
									<input type="text" class="form-control" placeholder="Search..."></form>
							</div>
						</div>
					</nav>
				<div class="tab-content">
					<div class="tab-contentWrapper" style="display:block">
					<ol class="breadcrumb" style="margin-bottom: 5px;">
						<li>
							<a href="index.php">Dashboard</a>
						</li>
						<li class="active">
							职员档案
						</li>
						<li class="active">员工列表</li>
					</ol>
						<div class="table-responsive content">
							<table class="table table-striped">
								<thead>
									<tr>
										<?php $query1="show full columns from workerlist";
											$result1=$folie->excu($query1);
											while($row1=mysql_fetch_array($result1)){ 
												echo "<th>";
												echo $row1['Field'];
												echo "</th>";
											}
							  				// 释放资源
							  				mysql_free_result($result1);
										?>
									</tr>
								</thead>
								<tbody>
									<?php
										$query2="select * from workerlist order by id";
										$result2=$folie->excu($query2);
										while($row2 = mysql_fetch_array($result2))
											{
												echo "<tr>";
												echo "<td>".$row2['id']."</td>";
												echo "<td>".$row2['name']."</td>";
												echo "<td>".$row2['number']."</td>";
												echo "<td>".$row2['sex']."</td>";
												echo "<td>".$row2['position']."</td>";
												echo "<td>".$row2['department']."</td>";
												echo "<td>".$row2['time(入职日期)']."</td>";
												echo "<tr>";
				  							}
				  							// 释放资源
				  							mysql_free_result($result2);
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-contentWrapper">
						
					</div>
					<div class="tab-contentWrapper">
						<ol class="breadcrumb" style="margin-bottom: 5px;">
							<li>
								<a href="index.php">Dashboard</a>
							</li>
							<li class="active">离职信息</li>
							<li class="active">统计信息</li>
						</ol>
          				<div class="table-responsive content">
          					<table class="table table-striped">
          						<thead>
          							<tr>
						                <?php
							                $query1="show full columns from departurelist";
											$result1=$folie->excu($query1);
											while($row1=mysql_fetch_array($result1)){ 
												echo "<th>";
												echo $row1['Field'];
												echo "</tn>";
											}
							  				// 释放资源
							  				mysql_free_result($result1);
										?>
                					</tr>
                				</thead>
                				<tbody>
				                	<?php
										$query2="select * from departurelist group by name order by id";
										$result2=$folie->excu($query2);
										$i=0;
										while($row2 = mysql_fetch_array($result2))
											{
												$i++;
												echo "<tr>";
												echo "<td>".$i."</td>";
												echo "<td>".$row2['number']."</td>";
												echo "<td>".$row2['name']."</td>";
												echo "<tr>";
				  							}
						  				// 释放资源
						  				mysql_free_result($result2);
									?>

              					</tbody>
            				</table>
          				</div>
					</div>
					<div class="tab-contentWrapper">4</div>
					<div class="tab-contentWrapper">
						<ol class="breadcrumb" style="margin-bottom: 5px;">
							<li>
								<a href="index.php">Dashboard</a>
							</li>
							<li class="active">岗位调整</li>
							<li class="active">统计表格</li>
						</ol>
          				<div class="table-responsive content">
          					<table class="table table-striped">
          						<thead>
          							<tr>
						                <?php
							                $query1="show full columns from poschangelist";
											$result1=$folie->excu($query1);
											while($row1=mysql_fetch_array($result1)){ 
												echo "<th>";
												echo $row1['Field'];
												echo "</tn>";
											}
							  				// 释放资源
							  				mysql_free_result($result1);
										?>
                					</tr>
                				</thead>
                				<tbody>
				                	<?php
										$query2="select * from poschangelist group by name order by id";
										$result2=$folie->excu($query2);
										$i=0;
										while($row2 = mysql_fetch_array($result2))
											{
												$i++;
												echo "<tr>";
												echo "<td>".$i."</td>";
												echo "<td>".$row2['name']."</td>";
												echo "<td>".$row2['originpos']."</td>";
												echo "<td>".$row2['nowpos']."</td>";
												echo "<tr>";
				  							}
						  				// 释放资源
						  				mysql_free_result($result2);
									?>

              					</tbody>
            				</table>
          				</div>
					</div>
					<div class="tab-contentWrapper">6</div>
					<div class="tab-contentWrapper">
						<ol class="breadcrumb" style="margin-bottom: 5px;">
							<li>
								<a href="index.php">Dashboard</a>
							</li>
							<li class="active">考勤信息</li>
							<li class="active">员工考勤列表</li>
						</ol>
          				<div class="table-responsive content">
          					<table class="table table-striped">
          						<thead>
          							<tr>
						                <?php
							                $query1="show full columns from attendancelist";
											$result1=$folie->excu($query1);
											while($row1=mysql_fetch_array($result1)){ 
												echo "<th>";
												echo $row1['Field'];
												echo "</tn>";
											}
							  				// 释放资源
							  				mysql_free_result($result1);
										?>
                					</tr>
                				</thead>
                				<tbody>
				                	<?php
										$query2="select * from attendancelist group by name order by id";
										$result2=$folie->excu($query2);
										$i=0;
										while($row2 = mysql_fetch_array($result2))
											{
												$i++;
												echo "<tr>";
												echo "<td>".$i."</td>";
												echo "<td>".$row2['name']."</td>";
												echo "<td>".$row2['number']."</td>";
												echo "<td>".$row2['shouldcomes']."</td>";
												echo "<td>".$row2['actualcomes']."</td>";
												echo "<tr>";
				  							}
						  				// 释放资源
						  				mysql_free_result($result2);
									?>

              					</tbody>
            				</table>
          				</div>
					</div>
					<div class="tab-contentWrapper">
						<ol class="breadcrumb" style="margin-bottom: 5px;">
							<li>
								<a href="index.php">Dashboard</a>
							</li>
							<li class="active">考勤信息</li>
							<li class="active">今日签到</li>
						</ol>
          				<div class="table-responsive content">
          					<table class="table table-striped">
          						<thead>
          							<tr>
						                <?php 
							               	$sign_form_today = "signform".date("Ymd");
							                $query1="show full columns from ".$sign_form_today;
											$result1=$folie->excu($query1);
											while($row1=mysql_fetch_array($result1)){ 
												echo "<th>";
												echo $row1['Field'];
												echo "</tn>";
											}
							  				// 释放资源
							  				mysql_free_result($result1);
										?>
                					</tr>
                				</thead>
                				<tbody>
				                	<?php
										$query2="select * from ".$sign_form_today." group by name order by id";
										$result2=$folie->excu($query2);
										$i=0;
										while($row2 = mysql_fetch_array($result2))
											{
												$i++;
												echo "<tr>";
												echo "<td>".$i."</td>";
												echo "<td>".$row2['name']."</td>";
												echo "<td>".$row2['number']."</td>";
												echo "<td>".$row2['place']."</td>";
												echo "<td>".$row2['time']."</td>";
												echo "<tr>";
				  							}
						  				// 释放资源
						  				mysql_free_result($result2);
						  				//关闭数据库非持久连接
						  				mysql_close($connect);
									?>

              					</tbody>
            				</table>
          				</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="js/jquery-2.1.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/index.js"></script>
</body>
</html>