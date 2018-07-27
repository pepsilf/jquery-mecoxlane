<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 20:52
 */

include "config.php";
if(isset($_REQUEST["uname"])){
    $uname = $_REQUEST["uname"];
    $inserSQL = "SELECT *FROM mecoxlane.users WHERE u_name='".$uname."';";
    $result= $conn->query($inserSQL);
    if($result->num_rows>=1){
        print_r("false");
    }else{
        print_r("true");
    }
}
if(isset($_REQUEST["uphone"])){
    $uphone = $_REQUEST["uphone"];
    $inserSQL = "SELECT *FROM mecoxlane.users WHERE u_phone='".$uphone."';";
    $result= $conn->query($inserSQL);
    if($result->num_rows>=1){
        print_r("false");
    }else{
        print_r("true");
    }
}


