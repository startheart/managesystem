<!DOCTYPE html>
<html lang="zh-en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>服务端</title>
</head>
<body></body>
</html>
<?php

include "inc/mysql.php";
$folie = new mysql;
$folie->link("");
//默认时区设置为上海
date_default_timezone_set('asia/shanghai');
$sign_form_today = "signform".date("Ymd");
$time = date("h:i:sa");
//echo $time;
if(!mysql_query("SELECT * FROM ".$sign_form_today))
	{ 
		$query="create table ".$sign_form_today."(id int(10) NOT NULL AUTO_INCREMENT,PRIMARY KEY(id),name varchar(20) NOT NULL,number varchar(20) not null,place打卡地点 varchar(20) NOT NULL,time打卡时间 time)";
		$result=$folie->excu($query);
	}

//确保在连接客户端时不会超时
set_time_limit(0);

$ip = '127.0.0.1';
$port = 1930;

/*
 +-------------------------------
 *    @socket通信整个过程
 +-------------------------------
 *    @socket_create
 *    @socket_bind
 *    @socket_listen
 *    @socket_accept
 *    @socket_read
 *    @socket_write
 *    @socket_close
 +--------------------------------
 */

/*----------------    以下操作都是手册上的    -------------------*/

if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0) {
    echo "socket_create() 失败的原因是:".socket_strerror($sock)."\n";
}

if(($ret = socket_bind($sock,$ip,$port)) < 0) {
    echo "socket_bind() 失败的原因是:".socket_strerror($ret)."\n";
}

if(($ret = socket_listen($sock,4)) < 0) {
    echo "socket_listen() 失败的原因是:".socket_strerror($ret)."\n";
}

$count = 0;

do {
    if (($msgsock = socket_accept($sock)) < 0) {
        echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
        break;
    } else {
       /**
        * [$buf 底层传来的字符串，格式为 '{"num":"2012019060024","pos":"C100"}' ]
        * pos代表员工刷卡的位置：C100——C区100室
        * @var [string]
        */
       if($buf = socket_read($msgsock,8192)){ 
          var_dump($buf);
       		$jsondecode = json_decode($buf);
          $query = "select * from ".$sign_form_today." where number='$jsondecode->num'";
          $result = $folie->excu($query);
          //查看打卡人是否已经打过卡
          if(mysql_num_rows($result)==0) {
            //查找打卡人详细信息
            $query1 = "select * from workerlist where number='$jsondecode->num'";
            $result1 = $folie->excu($query1);
            $row1 = mysql_fetch_array($result1);
            //查找打卡位置
            var_dump($jsondecode->pos);
            $query2 = "select * from signposition where pos='$jsondecode->pos'";
            $result2 = $folie->excu($query2);
            $row2 = mysql_fetch_array($result2);
            var_dump($row2['name']);
            $query3="INSERT INTO ".$sign_form_today."(name,number,place打卡地点,time打卡时间) VALUES ('{$row1['name']}','{$row1['number']}', '{$row2['name']}', curtime())";
            $folie->excu($query3);
          }
          
	   		/*if ($count<=1) {
	   			$count++;
	   			break;
	   		}*/
	   	}
        
    
    }
    //echo $buf;
    socket_close($msgsock);

} while (true);

socket_close($sock);

?>
