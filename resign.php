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

$reWorkerName = $_POST['reWorkerName'];
$reWorkerNum = $_POST['reWorkerNum'];
if( $reWorkerName && $reWorkerNum ) {
	$query1="DELETE FROM workerlist WHERE number='{$reWorkerNum}' ";
	$folie->excu($query1);
	$query2 = "INSERT INTO departurelist (number,name,time离职日期) VALUES ('{$reWorkerNum}','{$reWorkerName}',CURDATE())";
	$folie->excu($query2);
}
$home_url = 'index.php';
header('Location: '.$home_url);