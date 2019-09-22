<?php

require_once ('../resource/TCPDF/tcpdf.php');
require_once('../resource/TCPDF/tcpdf_barcodes_1d.php');

/**
 * Created by PhpStorm.
 * User: ceng shengxing
 * Date: 9/19/2019
 * Time: 12:27 PM
 */

include ("../MySQL/MySqlConnect.php");
session_start();
//实例化
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// 设置文档信息
$pdf->SetCreator('GIS');
$pdf->SetAuthor('GIS');
$pdf->SetTitle('Graduate Information');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, PHP');

// 设置页眉和页脚信息
$pdf->SetHeaderData('logo.png', 60, 'Graduate Information', 'From GIS',
    array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// 设置页眉和页脚字体
$pdf->setHeaderFont(Array('stsongstdlight', '', '10'));
$pdf->setFooterFont(Array('helvetica', '', '8'));

// 设置默认等宽字体
$pdf->SetDefaultMonospacedFont('courier');

// 设置间距
$pdf->SetMargins(15, 27, 15);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);

// 设置分页
$pdf->SetAutoPageBreak(TRUE, 25);

// set image scale factor
$pdf->setImageScale(1.25);

// set default font subsetting mode
$pdf->setFontSubsetting(true);

//设置字体
$pdf->SetFont('stsongstdlight', '', 14);

$pdf->AddPage();
$stuid = $_SESSION['stuID'];
$sql = "select * from graduateinfo where stuid='$stuid'";
//$ex_sql = "select examroom from stuexam where stuid = '$stuid'";
$conn = mysql_conn();
$stu_info = mysqli_fetch_array(mysqli_query($conn, $sql));
//$stu_ex_info = $conn->query($ex_sql)->fetch_assoc();
$str1 = '注意事项:';
$content = date("Y/m/d");
$name = $stu_info['stuname'];
$stuID = $stu_info['stuID'];
$stuMajor = $stu_info['stumajor'];
$stuSex = $stu_info['stusex'];
$stuGraduateClass = $stu_info['stugraduateclass'];
$stuPhoneNumber = $stu_info['stuphonenumber'];
$stuIdenNumber = $stu_info['stuidennumber'];
$stuDepartment = $stu_info['studepartment'];
$stuBornDate = $stu_info['stuborndate'];
$pdf->Cell(30, 6, '日期', 1, 0);
$pdf->Cell(120, 6, $content , 1, 1);
$pdf->Cell(30, 6, '学生姓名', 1, 0);
$pdf->Cell(120, 6, $name, 1, 1);
$pdf->Cell(30, 6, "学号", 1, 0);
$pdf->Cell(120, 6, $stuID, 1, 1);
$pdf->Cell(30, 6, '专业', 1, 0);
$pdf->Cell(120, 6, $stuMajor, 1, 1);
$pdf->Cell(30, 6, '身份证号码', 1, 0);
$pdf->Cell(120, 6, $stuIdenNumber, 1, 1);
$pdf->Cell(30, 6, '性别', 1, 0);
$pdf->Cell(120, 6, $stuSex, 1, 1);
$pdf->Cell(30, 6, '毕业班级', 1, 0);
$pdf->Cell(120, 6, $stuGraduateClass, 1, 1);
$pdf->Cell(30, 6, '手机号码', 1, 0);
$pdf->Cell(120, 6, $stuPhoneNumber, 1, 1);
$pdf->Cell(30, 6, '毕业学院', 1, 0);
$pdf->Cell(120, 6, $stuDepartment, 1, 1);
$pdf->Cell(30, 6, '出生日期', 1, 0);
$pdf->Cell(120, 6, $stuBornDate, 1, 1);
$pdf->Ln(8);
$pdf->Write(0,$str1,'', 0, 'L', true, 0, false, false, 0);
$str2 = "• 若上面所示信息有错误，则请前往学生中心申请更改。
";
$pdf->Write(0,$str2,'', 0, 'L', true, 0, false, false, 0);


ob_end_clean();
$pdf->Output('info.pdf', 'I');