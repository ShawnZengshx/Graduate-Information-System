<?php
/**
 * Created by PhpStorm.
 * User: cengshengxing
 * Date: 2019-09-22
 * Time: 18:32
 */

session_start();
session_destroy();
echo "<script>alert('注销成功！即将回到首页！');window.setTimeout(window.location.href='../views/Welcom.php', 400)</script>";

