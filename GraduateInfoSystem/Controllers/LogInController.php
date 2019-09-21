<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-12
 * Time: 18:56
 */


include ('../MySQL/MySqlConnect.php');

//学生登录管理
function stu_login($input_name, $input_pwd){
    $check_query = "select userpwd from stuser where username = '$input_name'";
    $conn = mysql_conn();
    $result = mysqli_query($conn, $check_query);
    if(!$result) {
        echo "用户名错误！";
    }else{
        $row = mysqli_fetch_array($result);
        if ($row[0] == $input_pwd){
            $conn->close();
            echo "登录成功！";
        }else{
            $conn->close();
            echo "密码错误！";
        }
    }
}

//企业登录管理
function enterprise_login($input_name, $input_pwd){
    $check_query = "select userpwd from enterpuser where username = '$input_name'";
    $conn = mysql_conn();
    $result = mysqli_query($conn, $check_query);
    if(!$result) {
        $conn->close();
        echo "用户名错误！";
    }else{
        $row = mysqli_fetch_array($result);
        if ($row[0] == $input_pwd){
            $conn->close();
            echo "登录成功！";
        }else{
            echo "密码错误！";
        }
    }
}

//管理员登录管理
function admin_login($input_name, $input_pwd){
    $check_query = "select adminpwd from admin where adminID = '$input_name'";
    $conn = mysql_conn();
    $result = mysqli_query($conn, $check_query);
    if(!$result) {
        $conn->close();
        echo "用户名错误！";
    }else{
        $row = mysqli_fetch_array($result);
        if ($row[0] == $input_pwd){
            $conn->close();
            echo "登录成功！";
        }else{
            echo "密码错误！";
        }
    }
}

