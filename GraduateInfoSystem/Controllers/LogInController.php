<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-12
 * Time: 18:56
 */


include ('../MySQL/MySqlConnect.php');
session_start();
$captchaErr = "";

//学生登录管理
function stu_login($input_name, $input_pwd){
    $check_query = "select userpwd,stuID from stuser where username = '$input_name'";
    $conn = mysql_conn();
    $result = mysqli_query($conn, $check_query);
    $row = mysqli_fetch_row($result);
    if($row == 0){
        echo "<script>alert('用户名错误！');history.go(-1)</script>";
    }
    if ($row[0] == $input_pwd){
        $conn->close();
        $_SESSION['stuID'] = $row[1];
        $message = "登录成功！".$row[1];
        echo "<script>alert('$message');window.setTimeout(window.location.href='../views/StuView/stuInfo.php',2000)</script>";
    }else{
        echo "密码错误！";
    }
}

//企业登录管理
function enterprise_login($input_name, $input_pwd){
    $check_query = "select userpwd,enterpID from enterpuser where username = '$input_name'";
    $conn = mysql_conn();
    $result = mysqli_query($conn, $check_query);

    $row = mysqli_fetch_row($result);
    if($row == 0){
        echo "<script>alert('用户名错误！');history.go(-1)</script>";
    }
    if ($row[0] == $input_pwd){
        $conn->close();
        $_SESSION['enterpID'] = $row[1];
        echo "<script>alert('登录成功！');window.setTimeout(window.location.href='../views/EnterpView/EnterpInfo.php',2000)</script>";
    }else{
        echo "密码错误！";
    }

}

//管理员登录管理
function admin_login($input_name, $input_pwd){
    $check_query = "select adminpwd from admintable where adminID = '$input_name'";
    $conn = mysql_conn();
    $result = mysqli_query($conn, $check_query);
    $row = mysqli_fetch_row($result);
    if($row == 0){
        exit("用户名错误！");
    }
    if ($row[0] == $input_pwd){
        $conn->close();
        echo "登录成功！";
    }else{
        echo "密码错误！";
    }
}

//如果是企业用户登录
if(isset($_POST['enterpName'])){
    $enterpName = $_POST['enterpName'];
    $enterpPwd = $_POST['enterpPwd'];
    enterprise_login($enterpName, $enterpPwd);
}

//如果是学生用户登录
if(isset($_POST['StuUserName'])){
    $stuUserName = $_POST['StuUserName']; //学生输入的用户名
    $stuPassword = $_POST['StuPassword']; //学生输入的密码
    $verificationCode = $_SESSION['verification']; //存储的验证码
    $inputVerCode = $_POST['captcha']; //学生输入的验证码

    if($inputVerCode != $verificationCode){
        $captchaErr = "验证码错误！";
    }else{
        stu_login($stuUserName, $stuPassword);
    }
}

//如果是管理员登录
if(isset($_POST['AdminName'])){
    $adminName = $_POST['AdminName'];
    $adminPwd = $_POST['AdminPwd'];
    admin_login($adminName, $adminPwd);

}