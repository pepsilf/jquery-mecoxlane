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
    if(!empty($_REQUEST["uname"]) && !empty($_REQUEST["upwd"])){
        $loginSQL = "SELECT `u_id`,`u_name`,`u_phone` FROM mecoxlane.users WHERE u_name=? AND u_pwd=? ";
        $stmt = $conn->prepare($loginSQL);
        $stmt->bind_param("ss", $_REQUEST["uname"],$_REQUEST["upwd"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $resList = Array("status" => 0, "msg" => "用户名或密码错误");

        if($result->num_rows >= 1){
            $resList["status"] = 1;
            $resList["msg"] = "登录成功";
            $rowData = $result->fetch_array();
            $resArray=Array();
            $resArray["uid"]=$rowData["u_id"];
            $resArray["uname"]=$rowData["u_name"];
            $resArray["uphone"]=$rowData["u_phone"];
            $resList["data"] = $resArray;
            $_SESSION["currentLogin"]=$resArray;
        }
        print_r(json_encode($resList));
    } else {
        print_r(json_encode(Array("status" => 0, "msg" => "用户名或密码错误")));
    }
}