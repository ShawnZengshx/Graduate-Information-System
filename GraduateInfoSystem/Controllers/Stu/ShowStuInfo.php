<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-16
 * Time: 18:35
 * 展示学生的基本个人信息
 */

$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/MySQL/MySqlConnect.php");

//用于展示毕业生的基本的信息
function show_stu_info($target_id){
    $conn = mysql_conn();
    $check_query = "select * from graduateinfo where stuID = '$target_id' ";
    $result = mysqli_query($conn, $check_query);
    $row = mysqli_fetch_row($result);
    if(!$result){  //如果查询出错
        $conn->close();
        echo $conn->error;
    }elseif($row == 0){  //如果查询的结果为空
        $conn->close();
        echo "没有这个学生！";
    }else{  //查询到了学生的信息，则进行打印输出
        $conn->close();
        var_dump($row);
    }
}

show_stu_info(20160002);

