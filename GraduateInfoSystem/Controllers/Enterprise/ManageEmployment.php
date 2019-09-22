<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-18
 * Time: 18:46
 * 这是企业用于管理雇员的文件
 */

$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/MySQL/MySqlConnect.php");

function show_all_employ_info($enterp_id){
    $conn = mysql_conn();
    $getInfoQuery = "select * from graduatework where enterpID = '$enterp_id'";
    $result = mysqli_query($conn, $getInfoQuery);
    while($row = mysqli_fetch_row($result)){
        foreach ($row as $key => $value){
            echo "$key"."=>"."$value";
        }
    }
    exit();
} //用于展示该企业所有的雇员的信息

function fire_employee($fired_id){
    $conn = mysql_conn();
    $firingEmployeeQuery = "delete from graduatework where stuID = '$fired_id'";
    $result = mysqli_query($conn, $firingEmployeeQuery);
    if(mysqli_affected_rows($conn) == 0){
        exit("不能重复解雇同一个人！");
    }elseif($result){
        exit("解雇成功！");
    }else{
        exit($conn->error);
    }
} // 解雇雇员

