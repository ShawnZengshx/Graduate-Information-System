
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

    <title>Welcome</title>

    <!-- Bootstrap core CSS -->
    <link href="../resource/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../resource/js/jquery.min.js"></script>
    <script src="../resource/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $("#mytab a").click(function (e) {
            $(this).tab("show");
        })
    </script>

</head>


<?php
//    require '../controllers/registerTest.php';
//?>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Welcome</a>
        </div>
        <div class="collapse navbar-collapse navbar-right">
            <ul class="nav navbar-nav" id="mytab">
                <li class="active"><a href="#" >Home</a></li>
                <li><a href="login.php">Student</a></li>
                <li><a href="EnterpriseLogin.html">Enterprise</a></li>
            </ul>
        </div>

    </div>
</nav>
<style>
    .error{
        color:#ff0000;
    }
</style>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1 style="font-family: Arial;color: #204d74"><span style="font-style: italic">Graduate</span> Information System <sup>&reg;</sup></h1>

        <p>When people can demonstrate their potential, the possibilities are endless.
            <br>Meaningful measurement today can help you set your best path forward tomorrow. Our assessments and research tools are designed to help you make decisions with confidence.</p>
        <!--<p><a class="btn btn-primary btn-lg" href="#" role="button">Register now &raquo;</a></p>-->



        <form class="form-horizontal" role="form">
            <div class="form-group">
                <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal" style="background:#9acfea ">
                        Graduate Register&raquo;
                    </button>
                <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal" style="background:#9acfea ">
                        Enterprise Register&raquo;
                    </button>
            </div>
        </form>


        <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Register for Graduate Info System</h4>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <span class="error">* 必填字段</span><br/>
                                <label for="stuname" class="control-label">User name</label>
                                <input class="form-control" type="text" id="stuname" name="stuname"/><span class="error">*</span>
                                <label for="password" class="control-label">Password</label>
                                <input class="form-control" type="password" id="password" name="password" />
                                <label for="confirmpwd" class="control-label">Confirm password</label>
                                <input class="form-control" type="password" id="confirmpwd" name="confirmpwd" /><span class="error">*</span>
                                <label for="stuemail" class="control-label">Email</label>
                                <input class="form-control" type="text" id="stuemail" name="email"/><span class="error">*</span>
                                <label for="stuidenid" class="control-label">Identical ID</label>
                                <input class="form-control" type="text" id="stuidenid" name="stuidenid" />
                                <label for="stuface" class="control-label">Real Name</label>
                                <input class="form-control" type="text" id="stuface" name="stuface"/>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="OK">
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-4">
            <h2 style="color: #1b6d85">Employment Informations</h2>
            <p>The school will further expand the employment channels for graduates and improve the employment quality of graduates in accordance with the principles of local conditions, classified guidance and precise docking.</p>
            <p><a class="btn btn-default" href="http://gdjy.hfut.edu.cn/" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2 style="color: #d58512">Innovation and Entrepreneurship</h2>
            <p>In order to run the "open classroom", the Student Employment Guidance Center actively researched, seriously judged and invited the relevant responsible persons of high-quality employers to come to the school to carry out special lectures, and spare no effort to do the employment guidance services for the 2020 graduates.</p>
            <p><a class="btn btn-default" href="http://gdjy.hfut.edu.cn/" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2 style="color: #761c19">Career Development</h2>
            <p>The University Student Employment Guidance Center runs a career planning and career development open classroom for college students, aiming at achieving a seamless connection between colleges and employers, allowing students who are about to enter the graduating class to understand the needs of quality enterprises in advance and lay the foundation for their job hunting.</p>
            <p><a class="btn btn-default" href="http://gdjy.hfut.edu.cn/" role="button">View details &raquo;</a></p>
        </div>
    </div>

    <hr>

    <footer>
        <p>&copy; 2019 Company, Inc.</p>
    </footer>
</div> <!-- /container -->

</body>
</html>
