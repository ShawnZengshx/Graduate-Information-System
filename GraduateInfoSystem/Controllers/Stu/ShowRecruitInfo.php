<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-16
 * Time: 19:26
 * 展示企业招聘的信息
 * 可以考虑展现为pdf格式
 */

$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/MySQL/MySqlConnect.php");

//用于展示企业招聘的信息
function show_recruit_info($target_id){
    $conn = mysql_conn();
    $check_query = "select * from recruitment where postNumber = '$target_id' ";
    $result = mysqli_query($conn, $check_query);
    $row = mysqli_fetch_row($result);
    if(!$result){  //如果查询出错
        $conn->close();
        exit($conn->error);
    }elseif($row == 0 ){  //如果查询的结果为空
        $conn->close();
        exit("没有这个招聘信息！") ;
    }else{  //查询到了企业的信息，则进行打印输出

        //进行相关的一些信息展示的操作

    }
    //return $result;
}