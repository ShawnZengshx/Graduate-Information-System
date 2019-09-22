
<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-03-05
 * Time: 11:15
 */


include("../../MySQL/MySqlConnect.php");
session_start();
$enterpID = $_SESSION['enterpID'];

?>
<?php
function outJson($enterp_id){
    $conn = mysql_conn();
    $full_sql = "select * from recruitment where enterpID = '$enterp_id' ";
    $res = mysqli_query($conn,$full_sql);
    if(!$res){
        exit($conn->error);
    }
    $jarr = array();
    while($rows = mysqli_fetch_array($res,MYSQLI_ASSOC)){
        $count = count($rows);
        for($i=0;$i<$count;$i++){
            unset($rows[$i]);//删除冗余数据
        }
        array_push($jarr,$rows);
    }
    $str = json_encode($jarr);
    $file = fopen("Recruitment.json","w");
    fwrite($file,$str);
    fclose($file);
    $conn->close();
}
outJson($enterpID);
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Info</title>

    <link href="../../resource/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../resource/bootstrap-table/css/bootstrap-table.min.css" rel="stylesheet">

    <script src="../../resource/js/jquery.min.js"></script>
    <script src="../../resource/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../resource/bootstrap-table/js/bootstrap-table.js"></script>
    <script src="../../resource/bootstrap-table/js/bootstrap-table-zh-CN.js"></script>

    <!-- Custom styles for this template -->
    <link href="../../resource/dashboard.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Graduate info</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../controllers/stuLogout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="EnterpInfo.php">Overview <span class="sr-only">(current)</span></a></li>
                <li><a href="AllEmployment.php">Employment Information</a></li>
                <li class="active"><a href="AllRecruitment.php">Recruitment Information</a></li>
                <li><a href="ApplyInfo.php">Apply Information</a></li>
                <li><a href="Evaluation.php">Evaluation</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h2 class="sub-header">招募信息表</h2>
            <div class="btn-group operation">
                <button id="btn_add" type="button" class="btn bg-info update" data-target="#putUpRecruit" data-toggle="modal">
                    <span class="glyphicon glyphicon-bitcoin" aria-hidden="true"></span>发布招募信息
                </button>
                <button id="btn_delete" type="button" class="btn bg-danger" data-toggle="modal" data-target="#deleteRecruit">
                    <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>下架招募信息
                </button>
            </div>

            <!-- 进行发布新招募信息的model-->
            <div class="modal fade" id="putUpRecruit" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">发布新的招募信息</h4>
                        </div>

                        <div id="editBookModal" class="modal-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label for="postName" class="col-sm-2 control-label">职位:*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="postName" type="text">
                                    </div>
                                    <label for="requirement" class="col-sm-2 control-label">要求:*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="requirement" type="text">
                                    </div>
                                    <label for="salary" class="col-sm-2 control-label">薪资:*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="salary" type="text">
                                    </div>
                                    <label for="workAddr" class="col-sm-2 control-label">工作地点:*</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="workAddr" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button id="delete" type="button" class="btn btn-danger" data-dismiss="modal" onclick="put_up_recruitment()">发布</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 进行下架招募信息的model-->
            <div class="modal fade" id="deleteRecruit" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">确认要下架吗？</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button id="delete" type="button" class="btn btn-danger" data-dismiss="modal" onclick="delete_recruitment()">下架</button>
                        </div>
                    </div>
                </div>
            </div>
            <table id="table"></table>
        </div>
        <script>
            $("#table").bootstrapTable({ // 对应table标签的id
                url: "Recruitment.json",   //AJAX获取表格数据的url
                striped: true,                      //是否显示行间隔色(斑马线)
                pagination: false,                   //是否显示分页（*）
                sidePagination: "server",           //分页方式：client客户端分页，server服务端分页（*）
                paginationLoop: false,		  //当前页是边界时是否可以继续按
                queryParams: function (params) {    // 请求服务器数据时发送的参数，可以在这里添加额外的查询参数，返回false则终止请求
                    return {
                        //limit: params.limit, // 每页要显示的数据条数
                        //offset: params.offset, // 每页显示数据的开始行号
                        //sort: params.sort, // 要排序的字段
                        //sortOrder: params.order, // 排序规则
                        //dataId: $("#dataId").val() // 额外添加的参数
                    }
                },//传递参数（*）
                pageNumber:1,                       //初始化加载第一页，默认第一页
                pageSize: 10,                       //每页的记录行数（*）
                pageList: [10, 25, 50, 100,'all'],  //可供选择的每页的行数（*）
                contentType: "application/x-www-form-urlencoded",//一种编码。在post请求的时候需要用到。这里用的get请求，注释掉这句话也能拿到数据
                //search: true,                     //是否显示表格搜索，此搜索是客户端搜索，不会进服务端，所以，个人感觉意义不大
                strictSearch: false,		  //是否全局匹配,false模糊匹配
                showColumns: true,                  //是否显示所有的列
                showRefresh: true,                  //是否显示刷新按钮
                minimumCountColumns: 2,             //最少允许的列数
                clickToSelect: true,               //是否启用点击选中行
                singleSelect:true,
                //height: 500,                      //行高，如果没有设置height属性，表格自动根据记录条数觉得表格高度
                //uniqueId: "id",                   //每一行的唯一标识，一般为主键列
                showToggle:true,                    //是否显示详细视图和列表视图的切换按钮
                cardView: false,                    //是否显示详细视图
                detailView: false,                  //是否显示父子表
                cache: false,                       // 设置为 false 禁用 AJAX 数据缓存， 默认为true
                sortable: true,                     //是否启用排序
                sortOrder: "asc",                   //排序方式
                sortName: 'sn', // 要排序的字段
                uniqueId:'postNumber',
                columns: [
                    {
                        checkbox:true
                    },{
                        field: 'postNumber', // 返回json数据中的name
                        title: '招募编号', // 表格表头显示文字
                        align: 'center', // 左右居中
                        valign: 'middle', // 上下居中
                        sortable:true,
                        visible:false
                    },{
                        field: 'postName',
                        title: '职位名称',
                        align: 'center',
                        valign: 'middle'
                    },{
                        field: 'postRequirement',
                        title: '招募要求',
                        align: 'center',
                        valign: 'middle'
                    },{
                        field: 'postSalary',
                        title: '薪资',
                        align: 'center',
                        valign: 'middle'
                    },{
                        field: 'workAddr',
                        title: '工作地点',
                        align: 'center',
                        valign: 'middle'
                    }
                ],
                onLoadSuccess: function(){  //加载成功时执行
                    console.info("加载成功");
                },
                onLoadError: function(){  //加载失败时执行
                    console.info("加载数据失败");
                }

            });
        </script>
        <script>
            function put_up_recruitment(){
                var postName = $("#postName").val();
                var requirement = $("#requirement").val();
                var salary = $("#salary").val();
                var workAddr = $("#workAddr").val();
                var php_info = postName + "," + requirement + "," + salary + "," + workAddr;
                window.location.href = "AllRecruitment.php?recInfo=" + php_info;
            }

            function delete_recruitment () {
                var a= $("#table").bootstrapTable('getSelections');
                var id = a[0].postNumber;
                $("#table").bootstrapTable('remove',{field:'postNumber', values:id});
                window.location.href= "AllRecruitment.php?delPostNumber=" + id;
            }
        </script>
    </div>
</div>

<?php

if(isset($_GET['recInfo'])){
    $info = $_GET['recInfo'];
    $slice_info = explode(",", $info);
    $postName = $slice_info[0];
    $requirement = $slice_info[1];
    $salary = $slice_info[2];
    $workAddr = $slice_info[3];
    put_up_recruitment($_SESSION['enterpID'], $postName, $requirement, $salary, $workAddr);
}

if(isset($_GET['delPostNumber'])){
    $target_number = $_GET['delPostNumber'];
    delete_recruitment($target_number);
}

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
        $conn->close();
        echo "<script>alert('发布成功！')</script>";
        outJson($_SESSION['enterpID']);
        echo "<script>window.history.go(-1)</script>";
    }else{
        exit($conn -> error);
    }

} // 发布招募信息


//下架招聘信息
function delete_recruitment($post_number){
    $conn = mysql_conn();
    $turnOffForeignKeyCheck = "set foreign_key_checks = 0"; // 关闭数据库的外键检测
    mysqli_query($conn, $turnOffForeignKeyCheck);
    $deleteQuery = "delete from recruitment where postNumber = '$post_number'";
    mysqli_query($conn, $deleteQuery);
    $res = mysqli_affected_rows($conn);
    if($res == 0){
        exit($conn->error);
    }else{
        $turnOnForeignKeyCheck = "set foreign_key_checks = 1"; // 重新开启外键检测
        mysqli_query($conn, $turnOnForeignKeyCheck);
        $conn->close();
        echo "<script>alert('$post_number')</script>";
        outJson($_SESSION['enterpID']);
        echo "<script>window.history.go(-1)</script>";
        exit;
    }
}
?>

