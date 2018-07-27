<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 15:33
 */
include "config.php";

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_REQUEST["uname"])&&!empty($_REQUEST["gid"])){
        $uname=$_REQUEST["uname"];
        $gid=$_REQUEST["gid"];
        $cartSQL = "DELETE FROM mecoxlane.shoppingcart WHERE g_id='".$gid."'AND u_name='".$uname."';";
        $result= $conn->query($cartSQL);
        //删除宝贝
        if($result){
            print_r(json_encode(Array("status" => 1, "msg" => "删除成功")));
        }else{
            print_r(json_encode(Array("status" => 1, "msg" => "删除失败")));
        }
    } else {
        print_r(json_encode(Array("status" => 0, "msg" => "参数错误")));
    }
}