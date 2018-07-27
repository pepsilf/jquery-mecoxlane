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
    if(!empty($_REQUEST["uname"])){
        $uname=$_REQUEST["uname"];
        $cartSQL = "SELECT *FROM mecoxlane.shoppingcart WHERE u_name='".$uname."';";
        $result= $conn->query($cartSQL);
        //如果该用户购物车有宝贝
        $data=Array();
        while($obj=$result->fetch_assoc()){
            array_push($data, $obj);
        }
        $list=Array("status" => 0);
        if($data){
            $list["status"]=1;
            $list["data"]=$data;
        }
        print_r(json_encode($list));
    } else {
        print_r(json_encode(Array("status" => 0, "msg" => "")));
    }
}