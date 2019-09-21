<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-20
 * Time: 15:16
 * 用于进行学生提交申请工作的
 */

$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/MySQL/MySqlConnect.php");

function apply_for_job($stu_id, $post_number){
    $conn = mysql_conn();
    if(check_apply_if_duplicated($stu_id, $post_number, $conn)){
        exit("请不要重复申请！");
    }
    $getAppNumberQuery = "select max(applyNumber) from apply";
    $res = mysqli_query($conn, $getAppNumberQuery);
    if($res){
        $row = mysqli_fetch_row($res);
        $appNumber = $row[0] + 1;
    }else{
        $appNumber = 1;
    }

    $getEnterpIDQuery = "select enterpID from recruitment where postNumber = '$post_number'";
    $enterpID = mysqli_fetch_row(mysqli_query($conn, $getEnterpIDQuery));

    $applyForJobQuery = "insert into apply(applyNumber, stuID, enterpID, postNumber, state)".
                        "values".
                        "('$appNumber', '$stu_id', '$enterpID[0]', '$post_number', 'waiting')";
    $result = mysqli_query($conn, $applyForJobQuery);
    if($result){
        $conn->close();
        exit("申请成功！");
    }else{
        exit($conn->error);
    }
}

//检测学生是否重复申请一个职位
function check_apply_if_duplicated($stu_id, $post_number, $conn){
    $checkApplyIfDup = "select * from apply where stuId = '$stu_id' and postNumber = '$post_number'";
    $res = mysqli_fetch_row(mysqli_query($conn, $checkApplyIfDup));
    if($res == 0){
        return false;
    }else{
        return true;
    }
}

apply_for_job(20160002, 2);