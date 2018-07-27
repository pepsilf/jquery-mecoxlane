<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 16:01
 */
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Origin:*");

$dbHostName = '127.0.0.1';//数据库服务器的地址
$dbUserName = 'root';//数据库的用户名
$dbUserPwd = '';//数据库的密码
$dbDataBase = 'mecoxlane';
//创建链接
$conn = new mysqli($dbHostName, $dbUserName, $dbUserPwd, $dbDataBase, 3306);
//设置链接字符集
mysqli_query($conn, "set names utf8");