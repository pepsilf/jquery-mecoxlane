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
    if(!empty($_REQUEST["uname"])&& !empty($_REQUEST["gid"]) && !empty($_REQUEST["name"])&& !empty($_REQUEST["num"])&& !empty($_REQUEST["nums"])&& !empty($_REQUEST["p1"])&& !empty($_REQUEST["price"])){
        $uname=$_REQUEST["uname"];
        $gid=$_REQUEST["gid"];
        $gname=$_REQUEST["name"];
        $gnum=$_REQUEST["num"];
        $gnums=$_REQUEST["nums"];
        $gprice=$_REQUEST["price"];
        $gsrc=$_REQUEST["p1"];

        $cartSQL = "SELECT *FROM mecoxlane.shoppingcart WHERE u_name='".$uname."' AND g_id='".$gid."';";
        $result= $conn->query($cartSQL);
        //如果商品存在购物车
        if($result->num_rows >= 1){
            $addSQL="UPDATE mecoxlane.shoppingCart SET g_nums=g_nums+'".$gnums."' WHERE u_name='".$uname."' AND g_id='".$gid."';";
            $result=$conn->query($addSQL);
        }else{
            $inserSQL= "INSERT INTO mecoxlane.shoppingcart(u_name,g_id,g_name,g_num,g_price,g_nums,g_src)";
            $inserSQL.= "VALUES('".$uname."','".$gid."','".$gname."','".$gnum."','".$gprice."','".$gnums."','".$gsrc."');";
            $result=$conn->query($inserSQL);
        }
        if($result){
            $backs = Array("status" => 1, "msg" => "加入购物车成功");
        }else{
            $backs = Array("status" => 0, "msg" => "加入购物车失败");
        }
        print_r(json_encode($backs));
    } else {
        print_r(json_encode(Array("status" => 0, "msg" => "参数错误")));
    }
}