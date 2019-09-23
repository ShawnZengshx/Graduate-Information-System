<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-16
 * Time: 20:15
 * 用于进行学生的注册
 */

$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/MySQL/MySqlConnect.php");

//管理注册
function stu_register($input_id, $input_pwd, $input_name){

    $conn = mysql_conn();
    //用于验证学生注册时输入的学号是否是正确的
    if(verify_stu_id($input_id, $conn)){
        //需要加入验证该学号是否已经注册过
        if (verify_stu_id_if_duplicated($input_id, $conn)){
            $conn->close();
            echo "<script>alert('该学号已被注册！');window.history.go(-1)</script>";
            exit;
        }
        //验证用户名
        if(verify_stu_user_name($input_name, $conn)){

            //获取当前的用户数量
            $getCurrentUserNum = "select * from stuser";
            $currentUserNum = mysqli_num_rows(mysqli_query($conn, $getCurrentUserNum)) + 1;
            $currentUserNum = strval($currentUserNum);

            //更新学生用户表
            $updateUser = "insert into stuser(username, stuID, userpwd, usernumber)".
                "values('$input_name', '$input_id', '$input_pwd', '$currentUserNum')";
            $res = mysqli_query($conn, $updateUser);
            if($res){
                $conn -> close();
                echo "<script>alert('注册成功！即将跳转到登录界面');window.setTimeout(window.location.href='../../views/login.php',400)</script>";
                exit;
            }else{
                $conn ->error;
            }
        }else{
            $conn->close();
            echo "<script>alert('用户名已被注册！');window.history.go(-1) </script>";
            exit;
        }
    }else{
        $conn->close();
        echo "<script>alert('学号错误！');window.history.go(-1)</script>";
        exit;
    }
}

//验证学生的学号是否有效
function verify_stu_id($input_id, $conn){
    $verifyStuIdQuery = "select * from graduateinfo where stuID = '$input_id'";
    $idResult = mysqli_fetch_row(mysqli_query($conn, $verifyStuIdQuery));
    if($idResult == 0){
        return false;   //如果没找到说明学号错误返回失败
    }else{
        return true;  //反正返回成功
    }
}

function verify_stu_id_if_duplicated($input_id, $conn){
    $dupVerifyIdQuery = "select * from stuser where stuID = '$input_id'";
    $dupIdResult = mysqli_fetch_row(mysqli_query($conn, $dupVerifyIdQuery));
    if ($dupIdResult != 0 ){ //如果条数不为0，即学号已经注册，则返回成功
        return true;
    }else{
        return false;
    }
}

//验证学生的用户名是否有效
function verify_stu_user_name($input_name, $conn){
    $verifyUserNameQuery = "select * from stuser where username = '$input_name'";
    $nameResult = mysqli_fetch_row(mysqli_query($conn, $verifyUserNameQuery));
    if($nameResult == 0){
        return true;  //如果查询结果为空，则表明用户名未被注册，成功
    }else{
        return false; //反正已被注册
    }
}

if(isset($_GET['stuRegInfo'])){
    $info = $_GET['stuRegInfo'];
    $slice_info = explode(",", $info);
    $stuID = $slice_info[2];
    $userName = $slice_info[0];
    $userPwd = $slice_info[1];
    stu_register($stuID, $userPwd, $userName);
}