<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-18
 * Time: 18:25
 * 进行企业账户的注册认证操作
 */

$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/MySQL/MySqlConnect.php");

function check_enterp_register($input_id, $input_pwd, $input_name){

    $conn = mysql_conn();
    //用于验证学生注册时输入的学号是否是正确的
    if(verify_enterp_id($input_id, $conn)){
        //需要加入验证该学号是否已经注册过
        if (verify_enterp_id_if_duplicated($input_id, $conn)){
            exit("该企业号已经被注册！");
        }
        //验证用户名
        if(verify_enterp_user_name($input_name, $conn)){

            //获取当前的用户数量
            $getCurrentUserNum = "select * from enterpuser";
            $currentUserNum = mysqli_num_rows(mysqli_query($conn, $getCurrentUserNum)) + 1;
            $currentUserNum = strval($currentUserNum);

            //更新企业用户表
            $updateUser = "insert into enterpuser(username, enterpID, userpwd, usernumber)".
                "values('$input_name', '$input_id', '$input_pwd', '$currentUserNum')";
            $res = mysqli_query($conn, $updateUser);
            if($res){
                $conn -> close();
                echo "更新成功！";
            }else{
                $conn ->error;
            }
        }else{
            exit("用户名已被注册");
        }
    }else{
        exit("企业号错误！") ;
    }
}

//验证企业的学号是否有效
function verify_enterp_id($input_id, $conn){
    $verifyEnterpIdQuery = "select * from enterprise where enterpID = '$input_id'";
    $idResult = mysqli_fetch_row(mysqli_query($conn, $verifyEnterpIdQuery));
    if($idResult == 0){
        return false;   //如果没找到说明企业号错误返回失败
    }else{
        return true;  //反正返回成功
    }
}

function verify_enterp_id_if_duplicated($input_id, $conn){
    $dupVerifyIdQuery = "select * from enterpuser where enterpID = '$input_id'";
    $dupIdResult = mysqli_fetch_row(mysqli_query($conn, $dupVerifyIdQuery));
    if ($dupIdResult != 0 ){ //如果条数不为0，即企业号已经注册，则返回成功
        return true;
    }else{
        return false;
    }
}

//验证企业的用户名是否有效
function verify_enterp_user_name($input_name, $conn){
    $verifyUserNameQuery = "select * from enterpuser where username = '$input_name'";
    $nameResult = mysqli_fetch_row(mysqli_query($conn, $verifyUserNameQuery));
    if($nameResult == 0){
        return true;  //如果查询结果为空，则表明用户名未被注册，成功
    }else{
        return false; //反正已被注册
    }
}

check_enterp_register(010,01231, "asdhia");