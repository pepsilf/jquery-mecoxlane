<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/1
 * Time: 19:42
 */
include"config.php";
session_start();
if(!empty($_REQUEST["id"])){
    $id = $_REQUEST["id"];
    $inserSQL="SELECT *FROM mecoxlane.goods WHERE g_id='".$id."';";
    $result= $conn->query($inserSQL);
    $arrList=Array("status" => 1, "msg" => "成功");
    if($result->num_rows>=1){
        while( $rows=$result->fetch_assoc()){
            $resData=Array();
            $resData["name"]=$rows["g_name"];
            $resData["brand"]=$rows["g_brand"];
            $resData["num"]=$rows["g_num"];
            $resData["price"]=$rows["g_price"];
            $resData["p1"]=$rows["g_p1"];
            $resData["p2"]=$rows["g_p2"];
            $resData["bp1"]=$rows["g_bp1"];
            $resData["bp2"]=$rows["g_bp2"];
        }
        $arrList["data"]=$resData;
        print_r(json_encode($arrList));
    }
}else{
    $result = Array("status" => 0, "msg" => "参数错误");
    print_r(json_encode($result));
}