<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-18
 * Time: 20:26
 * 进行招聘信息的提交修改
 */

$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/MySQL/MySqlConnect.php");

function put_up_recruitment($enterp_id, $post_name, $post_requirement, $post_salary, $work_addr){
    $conn = mysql_conn();
    $getNumberQuery = "select max(postNumber) from recruitment";
    $numberREsult = mysqli_query($conn, $getNumberQuery);
    if($numberREsult){
        $row = mysqli_fetch_row($numberREsult);
        $posNumber = $row[0] + 1;
    }else{
        $posNumber = 1;
    }

    $putUpRecruitmentQuery = "insert into recruitment(postNumber, enterpID, postName, postRequirement".
                             ",postSalary, workAddr)"."values".
                             "('$posNumber', '$enterp_id', '$post_name', '$post_requirement','$post_salary','$work_addr')";
    $res = mysqli_query($conn, $putUpRecruitmentQuery);
    if($res){
        exit("发布成功！");
    }else{
        exit($conn -> error);
    }

} // 发布招募信息

//修改招聘信息
function update_recruitment(){}

//下架招聘信息
function delete_recruitment($post_number){
    $conn = mysql_conn();
    $deleteQuery = "delete from recruitment where postNumber = '$post_number'";
    mysqli_query($conn, $deleteQuery);
    $res = mysqli_affected_rows($conn);
    if($res == 0){
        exit($conn->error);
    }else{
        exit("删除成功！");
    }
}



$requirement = "是一个人";
put_up_recruitment("0001", "programmer", $requirement, "$19111", "SF");

