<?php
/**
 * Created by PhpStorm.
 * User: zengshengxing
 * Date: 2019-09-12
 * Time: 18:41
 */
//进行数据库的连接
function mysql_conn(){
    $conn_conf = array(
        'host' => 'localhost:3306',
        'db' => 'DataBaseDesign',
        'db_user' => 'root',
        'pwd' => 'Zengshx@9869'
    );

    @$conn = new mysqli($conn_conf['host'], $conn_conf['db_user'], $conn_conf['pwd'], $conn_conf['db']);
    if(mysqli_connect_errno()){
        die("could not connect to mysql: \n". mysqli_connect_error());
    }   //若发生连接异常
    $conn->set_charset("utf-8"); //将数据库设置成utf-8编码
    return $conn;
}


?>


