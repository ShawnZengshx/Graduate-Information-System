
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
    $full_sql = "select * from graduateWork left join graduateinfo on graduateWork.stuID = graduateinfo.stuID where enterpID = '$enterp_id';";
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
    $file = fopen("EmploymentInfo.json","w");
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
            <a class="navbar-brand" href="#">Enterprise info</a>
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
                <li class="active"><a href="AllEmployment.php">Employment Information</a></li>
                <li><a href="AllRecruitment.php">Recruitment Information</a></li>
                <li><a href="ApplyInfo.php">Apply Information</a></li>
                <li><a href="Evaluation.php">Evaluation</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h2 class="sub-header">毕业生职员信息表</h2>
            <div class="btn-group operation">
                <button id="btn_edit" type="button" class="btn bg-info update" data-target="#fireStu" data-toggle="modal">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>解雇
                </button>
                <button id="btn_delete" type="button" class="btn btn-success del" data-toggle="modal" data-target="#deleteStu">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>评价
                </button>
            </div>

            <!-- 进行解雇的model-->
            <div class="modal fade" id="fireStu" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">确认要解雇吗？</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button id="delete" type="button" class="btn btn-danger" data-dismiss="modal" onclick="fire_stu()">解雇</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--修改评级的modal-->

            <div class="modal fade" id="deleteStu" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">进行评价</h4>
                        </div>
                        <div id="editEvalModal" class="modal-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="updateEvaluation" class="col-sm-2 control-label">评语:*</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="updateEvaluation" type="text">
                                        </div>
                                    </div>
                                    <label for="updateEvalGrade" class="col-sm-2 control-label">评级:*</label>
                                    <div class="col-sm-10">
                                        <label><input id="updateEvalGrade" name="EvalGrade" type="radio" value="A">   A    </label>
                                        <label><input id="updateEvalGrade" name="EvalGrade" type="radio" value="B">   B    </label>
                                        <label><input id="updateEvalGrade" name="EvalGrade" type="radio" value="C">   C    </label>
                                        <label><input id="updateEvalGrade" name="EvalGrade" type="radio" value="D">   D    </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button id="delete" type="button" class="btn btn-success update_ok" data-dismiss="modal" onclick="put_up_eval()">确认</button>
                        </div>
                    </div>
                </div>
            </div>
            <table id="table"></table>
        </div>
        <script>
            $("#table").bootstrapTable({ // 对应table标签的id
                url: "EmploymentInfo.json",   //AJAX获取表格数据的url
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
                uniqueId:'stuID',
                columns: [
                    {
                        checkbox:true
                    },{
                        field: 'employID', // 返回json数据中的name
                        title: '职员编号', // 表格表头显示文字
                        align: 'center', // 左右居中
                        valign: 'middle', // 上下居中
                        sortable:true
                    },{
                        field: 'stuname',
                        title: '学生姓名',
                        align: 'center',
                        valign: 'middle'
                    },{
                        field: 'stuID',
                        title: '学号',
                        align: 'center',
                        valign: 'middle',
                        sortable:true
                    },{
                        field: 'employPos',
                        title: '职位',
                        align: 'center',
                        valign: 'middle'
                    },{
                        field: 'stuphonenumber',
                        title: '职员电话',
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
            function fire_stu(){
                var a= $("#table").bootstrapTable('getSelections');
                var id = a[0].stuID;
                $("#table").bootstrapTable('remove',{field:'stuID', values:id});
                window.location.href="AllEmployment.php?firedID=" + id;
            }

            function put_up_eval(){
                var a= $("#table").bootstrapTable('getSelections');
                var id = a[0].stuID;
                var evaluation = $("#updateEvaluation").val();
                var selected = document.getElementsByName("EvalGrade");
                var evalGrade = "";
                for(var i =0; i<selected.length; i++){
                    if(selected[i].checked){
                        evalGrade = selected[i].value;
                    }
                }
                var php_info = id + "," + evaluation + "," + evalGrade;
                window.location.href="AllEmployment.php?newEval=" + php_info;
            }
        </script>
    </div>
</div>

<?php
if(isset($_GET['firedID'])){
    $target_id = $_GET['firedID'];
    fire_employee($target_id);
}

if(isset($_GET['newEval'])){
    $info = $_GET['newEval'];
    $slice = explode(",", $info);
    $stuID = $slice[0];
    $evaluation = $slice[1];
    $evalGrade = $slice[2];

    give_evaluation($stuID, $evalGrade, $evaluation, $_SESSION['enterpID']);
}
function fire_employee($fired_id){
    $conn = mysql_conn();

    $firingEmployeeQuery = "delete from graduatework where stuID = '$fired_id'";
    $result = mysqli_query($conn, $firingEmployeeQuery);
    if(mysqli_affected_rows($conn) == 0){
        exit("不能重复解雇同一个人！");
    }elseif($result){
        $conn->close();
        echo "<script>alert('解雇成功！')</script>";
        outJson($_SESSION['enterpID']);
        echo "<script>window.history.go(-1)</script>";
        exit;
    }else{
        exit($conn->error);
    }
} // 解雇雇员

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
        echo "<script>alert('评价成功！');window.setTimeout(window.location.href='Evaluation.php',500)</script>";
    } else {
        exit($conn->error);
    }
}
?>
