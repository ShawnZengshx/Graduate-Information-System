<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-20
 * Time: 15:33
 * 这是企业进行申请管理的
 */

$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/MySQL/MySqlConnect.php");

//展示企业受到的所有的申请信息
function show_all_apply($enterp_id){
    $conn = mysql_conn();
    $showAllApplyQuery = "select * from apply left join recruitment on apply.postNumber = recruitment.postNumber where apply.enterpID = '$enterp_id' and apply.state !='reject' and apply.state != 'accept';";
    $res = mysqli_query($conn, $showAllApplyQuery);
    if(!$res){
        exit($conn->error);
    }else{
        while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            foreach ($row as $key => $value){
                echo "$key".": "."$value  ";
            }
            echo "<br>";
        }
    }
    exit();
}

//接受申请并进行相应的更新
function accept_apply($apply_number){
    $conn = mysql_conn();
    $acceptAppQuery = "delete from apply where stuID in (select stuID from (select stuID from apply where applyNumber = '$apply_number') as t ) and applyNumber != '$apply_number' ";
    $res = mysqli_query($conn, $acceptAppQuery);
    if($res){
        $changeState = "update apply set state = 'accept' where applyNumber = '$apply_number'";
        $result = mysqli_query($conn, $changeState);
        if($result){
            $conn->close();
            exit("更新成功！");
        }else{
            exit($conn->error);
        }
    }else{
        exit($conn->error);
    }
}

//拒绝申请并进行相应的更新
function reject_apply($apply_number){
    $conn = mysql_conn();
    $rejectAppQuery = "update apply set state = 'reject' where applyNumber = '$apply_number'";
    $res = mysqli_query($conn, $rejectAppQuery);
    if($res){
        $conn->close();
        exit("拒绝成功！");
    }else{
        exit($conn->error);
    }
}

show_all_apply("0001");
//accept_apply(2);

//reject_apply(1);