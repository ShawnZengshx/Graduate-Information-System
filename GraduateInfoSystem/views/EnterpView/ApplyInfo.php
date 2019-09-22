
<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-03-05
 * Time: 11:15
 */


include("../../MySQL/MySqlConnect.php");
session_start();
$enterpID = $_SESSION['enterpID']

?>
<?php
function outJson($enterp_id){
    $conn = mysql_conn();
    $full_sql = $showAllApplyQuery = "select * from apply left join recruitment on apply.postNumber = recruitment.postNumber where apply.enterpID = '$enterp_id' and apply.state !='reject' and apply.state != 'accept';";
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
    $file = fopen("EnterpInfo.json","w");
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
                <li><a href="AllEmployment.php">Employment Information</a></li>
                <li><a href="AllRecruitment.php">Recruitment Information</a></li>
                <li class="active"><a href="ApplyInfo.php">Apply Information</a></li>
                <li><a href="Evaluation.php">Evaluation</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h2 class="sub-header">申请信息</h2>
            <div class="btn-group operation">
                <button id="btn_edit" type="button" class="btn bg-primary" data-target="#acceptApply" data-toggle="modal">
                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>接受
                </button>
                <button id="btn_delete" type="button" class="btn btn-success del" data-toggle="modal" data-target="#rejectApply">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>拒绝
                </button>
            </div>

            <!-- 进行接受申请的model-->
            <div class="modal fade" id="acceptApply" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">确认要接受吗？</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button id="delete" type="button" class="btn btn-danger" data-dismiss="modal" onclick="accept()">接受</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 进行拒绝申请的model-->
            <div class="modal fade" id="rejectApply" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">确认要拒绝吗？</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button id="delete" type="button" class="btn btn-danger" data-dismiss="modal" onclick="reject()">拒绝</button>
                        </div>
                    </div>
                </div>
            </div>
            <table id="table"></table>
        </div>
        <script>
            $("#table").bootstrapTable({ // 对应table标签的id
                url: "EnterpInfo.json",   //AJAX获取表格数据的url
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
                uniqueId:'applyNumber',
                columns: [
                    {
                        checkbox:true
                    },{
                        field: 'applyNumber',
                        title: '申请编号',
                        align: 'center',
                        valign: 'middle',
                        visible:false
                    },{
                        field: 'stuID',
                        title: '学号',
                        align: 'center',
                        valign: 'middle'
                    },{
                        field: 'postName',
                        title: '职位',
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
            function accept() {
                var a= $("#table").bootstrapTable('getSelections');
                var id = a[0].applyNumber;
                $("#table").bootstrapTable('remove',{field:'applyNumber', values:id});
                window.location.href= "ApplyInfo.php?accApplyNumber=" + id;
            }

            function reject() {
                var a= $("#table").bootstrapTable('getSelections');
                var id = a[0].applyNumber;
                $("#table").bootstrapTable('remove',{field:'applyNumber', values:id});
                window.location.href= "ApplyInfo.php?rejApplyNumber=" + id;
            }

        </script>
    </div>
</div>

<?php
if(isset($_GET['accApplyNumber'])){}
if(isset($_GET['rejApplyNumber'])){
    $target_number = $_GET['rejApplyNumber'];
    reject_apply($target_number);
}
//拒绝申请并进行相应的更新
function reject_apply($apply_number){
    $conn = mysql_conn();
    $rejectAppQuery = "update apply set state = 'reject' where applyNumber = '$apply_number'";
    $res = mysqli_query($conn, $rejectAppQuery);
    if($res){
        $conn->close();
        echo "<script>alert('拒绝成功！')</script>";
        outJson($_SESSION['enterpID']);
        echo "<script>window.history.go(-1)</script>";
        exit;
    }else{
        exit($conn->error);
    }
}
?>
