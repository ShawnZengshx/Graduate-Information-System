<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-16
 * Time: 19:24
 * 展示企业的基本个人信息
 */


$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/MySQL/MySqlConnect.php");

// 用于展示企业的基本信息
function show_enterp_info($target_id){
    $conn = mysql_conn();
    $check_query = "select * from enterprise where enterpID = '$target_id' ";
    $result = mysqli_query($conn, $check_query);
    $row = mysqli_fetch_row($result);
    if(!$result){  //如果查询出错
        echo $conn->error;
    }elseif($row == 0){  //如果查询的结果为空
        echo "没有这个企业！";
    }else{  //查询到了企业的信息，则进行打印输出

        //进行相关的一些信息展示的操作

    }
    //return $result;
}

