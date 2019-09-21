<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-18
 * Time: 20:07
 * 进行毕业生信息系统管理的程序
 */

$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/MySQL/MySqlConnect.php");

/*----------------进行毕业生信息的相关管理--------------------*/
//显示所有的毕业生信息的函数
function show_all_graduate_info(){
    $conn = mysql_conn();
    $showInfoQuery = "select * from graduateinfo";
    $result = mysqli_query($conn, $showInfoQuery);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        foreach($row as $key => $value){
            echo "$key"." : "."$value"."  ";
        }
        echo "<br>";
    }
}

//更新毕业生信息的函数
function update_graduate_info(){}

//删除毕业生信息的函数
function delete_graduate_info($target_stu_id){
    $conn = mysql_conn();
    $turnOffForeignKeyCheck = "set foreign_key_checks = 0"; // 关闭数据库的外键检测
    mysqli_query($conn, $turnOffForeignKeyCheck);
    $deleteInfoQuery = "delete from graduateinfo where stuID = '$target_stu_id'";
    $res = mysqli_query($conn, $deleteInfoQuery);
    if(!$res){
        exit($conn ->error);
    }
    $turnOnForeignKeyCheck = "set foreign_key_checks = 1"; // 重新开启外键检测
    mysqli_query($conn, $turnOnForeignKeyCheck);
    exit("删除成功！");
}

/*----------------进行企业信息的相关管理--------------------*/
//显示所有企业信息的函数
function show_all_enterp_info(){
    $conn = mysql_conn();
    $getAllEnterpInfo = "select * from enterprise";
    $res = mysqli_query($conn, $getAllEnterpInfo);
    while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
        foreach($row as $key => $value){
            echo "$key"."=>"."$value  ";
        }
        echo "<br>";
    }
}

//更新企业信息的函数
function update_enterp_info(){}

//删除企业信息的函数
function delete_enterp_info($target_enterp_id){
    $conn = mysql_conn();
    $turnOffForeignKeyCheck = "set foreign_key_checks = 0"; // 关闭数据库的外键检测
    mysqli_query($conn, $turnOffForeignKeyCheck);
    $deleteInfoQuery = "delete from enterprise where enterpID = '$target_enterp_id'";
    $res = mysqli_query($conn, $deleteInfoQuery);
    if(!$res){
        exit($conn ->error);
    }
    $turnOnForeignKeyCheck = "set foreign_key_checks = 1"; // 重新开启外键检测
    mysqli_query($conn, $turnOnForeignKeyCheck);
    exit("删除成功！");
}

/*----------------进行毕业生工作信息的相关管理--------------------*/
//显示所有的毕业生工作的信息
//更新所有的毕业生工作的信息
//删除特定的毕业生工作的信息

//


/*----------------测试--------------------*/
//delete_graduate_info("20160001");
show_all_enterp_info();