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
    if(!empty($_REQUEST["uname"])&& !empty($_REQUEST["gid"])&& !empty($_REQUEST["nums"])){
        $uname=$_REQUEST["uname"];
        $gid=$_REQUEST["gid"];
        $gnums=$_REQUEST["nums"];

        $cartSQL = "SELECT *FROM mecoxlane.shoppingcart WHERE u_name='".$uname."' AND g_id='".$gid."';";
        $result= $conn->query($cartSQL);
        //如果商品存在购物车
        if($result->num_rows >= 1){
            $addSQL="UPDATE mecoxlane.shoppingCart SET g_nums='".$gnums."' WHERE u_name='".$uname."' AND g_id='".$gid."';";
            $result=$conn->query($addSQL);
        }
        if($result){
            $backs = Array("status" => 1, "msg" => "修改成功");
        }else{
            $backs = Array("status" => 0, "msg" => "修改失败");
        }
        print_r(json_encode($backs));
    } else {
        print_r(json_encode(Array("status" => 0, "msg" => "参数错误")));
    }
}