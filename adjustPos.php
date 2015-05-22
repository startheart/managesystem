<?php
/**
 * 
 * @authors start_heart (704469176@qq.com)
 * @date    2015-05-18 20:49:05
 * @version $Id$
 */
header("Content-type: text/html; charset=utf-8");
include "FirePHPCore-0.3.2/lib/FirePHPCore/fb.php";
include "inc/mysql.php";
$folie = new mysql;
$connect = $folie->link("");

$adWorkerName = $_POST['adWorkerName'];
$originPos = $_POST['originPos'];
$nowPos = $_POST['nowPos'];

if( $adWorkerName && $originPos && $nowPos) {
	$query1="update workerlist set position='{$nowPos}' WHERE name='{$adWorkerName}' ";
	$folie->excu($query1);
	$query2 = "INSERT INTO poschangelist (name,originpos,nowpos) VALUES ('{$adWorkerName}','{$originPos}','{$nowPos}')";
	$folie->excu($query2);
}
$home_url = 'index.php';
header('Location: '.$home_url);