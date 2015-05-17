<!DOCTYPE html>
<html lang="zh-en">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>客户端</title>
</head>
<body></body>
</html>
<?php
error_reporting(E_ALL);
set_time_limit(0);
//默认时区设置为上海
date_default_timezone_set('asia/shanghai');

echo "<h2>TCP/IP Connection</h2>\n";

$port = 1930;
$ip = "127.0.0.1";

/*
 +-------------------------------
 *    @socket连接整个过程
 +-------------------------------
 *    @socket_create
 *    @socket_connect
 *    @socket_write
 *    @socket_read
 *    @socket_close
 +--------------------------------
 */

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket < 0) {
    echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
}else {
    echo "OK.\n";
}

echo "试图连接 '$ip' 端口 '$port'...\n";
$result = socket_connect($socket, $ip, $port);
if ($result < 0) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
}else {
    echo "连接OK\n";
}

$array = array("num" => "2012019060007","pos" => "C110");
/**
 * [$jsonencode 模拟底层发送的数据，格式为 '{"num":"2012019060024","pos":"C100"}' ]
 * @var [string]
 */
$jsonencode = json_encode($array);

if(!socket_write($socket, $jsonencode, strlen($jsonencode))) {
    echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
}else {
    echo "发送到服务器信息成功！\n";
    echo "发送的内容为:$jsonencode <br>";
}

/*while($out = socket_read($socket, 8192)) {
    echo "接收服务器回传信息成功！\n";
    echo "接受的内容为:".$out;
}*/


echo "关闭SOCKET...\n";
socket_close($socket);
echo "关闭OK\n";
?>
