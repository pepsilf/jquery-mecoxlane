<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 20:52
 */
include"config.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_REQUEST["uname"])&&isset($_REQUEST["uphone"])&& isset($_REQUEST["upwd"])) {
        $uname = $_REQUEST["uname"];
        $uphone = $_REQUEST["uphone"];
        $upwd = $_REQUEST["upwd"];
        //准备sql语句
        $inserSQL= "INSERT INTO mecoxlane.users(u_name,u_phone,u_pwd)";
        $inserSQL.= "VALUES('".$uname."','".$uphone."','".$upwd."');";
        $result = $conn->query($inserSQL);
        if ($result){
            $result = Array("status" => 1, "msg" => "注册成功,是否立即登录!");
            print_r(json_encode($result));
        }else{
            $result = Array("status" => 0, "msg" => "注册失败");
            print_r(json_encode($result));
        }
    }else{
        $result = Array("status" => 0, "msg" => "注册失败");
        print_r(json_encode($result));
    }
}else{
    $result = Array("status" => 0, "msg" => "请使用POST请求");
    print_r(json_encode($result));
}
