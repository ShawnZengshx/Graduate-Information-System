<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-19
 * Time: 18:39
 * 这是企业对学生进行评价的
 */

$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/MySQL/MySqlConnect.php");


//对学生进行评价操作，分为评级以及评语
function give_evaluation($stu_id, $eval_grade, $evaluation, $enterp_id){
    $conn = mysql_conn();
    $getEvalNumberQuery = "select max(evalNumber) from evaluation";
    $numRes = mysqli_query($conn, $getEvalNumberQuery);

    if($numRes){
        $row = mysqli_fetch_row($numRes);
        $evalNumber = $row[0] + 1;
    }else{
        $evalNumber = 1;
    }

    $giveEvaluationQuery = "insert into evaluation(evalNumber, stuID, evaluation, evalGrade, enterpID)" .
        "values" .
        "('$evalNumber', '$stu_id', '$evaluation', '$eval_grade', '$enterp_id')";
    $res = mysqli_query($conn, $giveEvaluationQuery);
    if ($res) {
        $conn->close();
        exit("发布成功！");
    } else {
        exit($conn->error);
    }
}

//进行评价内容的修改
function update_evaluation($stu_id, $evaluation, $enterp_id){
    $conn = mysql_conn();
    $updateEvaluationQuery = "update evaluation set evaluation = '$evaluation'".
                             "where stuID = '$stu_id' and enterpID = '$enterp_id'";
    $res = mysqli_query($conn, $updateEvaluationQuery);
    if($res){
        $conn->close();
        exit("更新成功！");
    }else{
        exit($conn->error);
    }
}

//进行评价等级的修改
function update_eval_with_grade($stu_id, $eval_grade, $enterp_id){
    $conn = mysql_conn();
    $updateEvalGradeQuery = "update evaluation set evalGrade = '$eval_grade'".
                            "where stuID = '$stu_id' and enterpID = '$enterp_id'";
    $res = mysqli_query($conn, $updateEvalGradeQuery);
    if($res){
        $conn->close();
        exit("更新成功！");
    }else{
        exit($conn->error);
    }
}

$evaluation = "这个人不错的";
//give_evaluation(20160001, "A", $evaluation, "0001");
$newEvaluation = "这个人不行的";
//update_evaluation(20160001, $newEvaluation, "0001");
$newEvalGrade = "B";
update_eval_with_grade(20160001, $newEvalGrade, "0001");