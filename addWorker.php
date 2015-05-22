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

$workerName = $_POST['workerName'];
$workNum = $_POST['workNum'];
$sex = $_POST['sex'];
$position = $_POST['position'];
$department = $_POST['department'];
if( $workerName && $workNum && $sex && $position && $department) {
	$query1="INSERT INTO workerlist (name,number,sex,position,department,date入职日期) VALUES ('{$workerName}','{$workNum}', '{$sex}', '{$position}', '{$department}', CURDATE())";
	$result1=$folie->excu($query1);
}
$home_url = 'index.php';
header('Location: '.$home_url);