<?php
/**
 * 
 * @authors start_heart (you@example.org)
 * @date    2015-03-04 14:30:49
 * @version 1.0
 */
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
<link rel="icon" href="image/icon.png">
</head>
<body>
    <div class="container-fluid">
      <div class="row" id="div-row">
        <div class="col-sm-3 col-md-2 sidebar">
          <div class="logo"><h4>晨电智能</h4><h4>工作室</h4></div>
          <ul class="nav nav-sidebar">
            <li>
				<a href="javascript:;" class="menu" name="sub-menu1">
					职员档案
				</a>
					<ul class="submenu" id="sub-menu1">
						<li>
							<a href="workerlist.php">员工列表</a>
						</li>
						<li>
							<a href="addworker.html">职员录入</a>
						</li>
					</ul>
			</li>
            <li>
				<a href="javascript:;" class="menu" name="sub-menu2" >
					离职信息
				</a>
					<ul class="submenu" id="sub-menu2">
						<li>
							<a href="#">统计信息</a>
						</li>
						<li>
							<a href="#">离职信息录入</a>
						</li>
					</ul>
			</li>
            <li>
				<a href="javascript:;" class="menu" name="sub-menu3">
					岗位调整
				</a>
					<ul class="submenu" id="sub-menu3">
						<li>
							<a href="#">人员调整信息</a>
						</li>
						<li>
							<a href="#">统计信息</a>
						</li>
					</ul>
			</li>
            <li>
				<a href="javascript:;" class="menu" name="sub-menu4">
					考勤信息
				</a>
					<ul class="submenu" id="sub-menu4">
						<li>
							<a href="#">员工考勤列表</a>
						</li>
						<li>
							<a href="signform.php">今日签到</a>
						</li>
					</ul>
			</li>
            <li>
				<a href="javascript:;" class="menu" name="sub-menu5">
					奖惩信息
				</a>
					<ul class="submenu" id="sub-menu5">
						<li>
							<a href="#">奖惩列表</a>
						</li>
						<li>
							<a href="#">薪金统计</a>
						</li>
					</ul>
			</li>
          </ul>
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
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>

          

          <ol class="breadcrumb" style="margin-bottom: 5px;">
			<li>
				<a href="index.php">Dashboard</a>
			</li>
			<li>
				<a href="index.php">职员档案</a>
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
  							//关闭数据库非持久连接
  							mysql_close($connect);
				?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/index.js"></script>
<script type="text/javascript">window.onload = function() {$(".submenu").hide();}</script>
</body>
</html>