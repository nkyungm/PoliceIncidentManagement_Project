<!DOCTYPE html>
<html>
<head>
<meta charest="utf-8">
</head>
<body>
	<hr width = "100%" color = "#1369B8" size = "60">
	<h3> &nbsp&nbsp&nbsp&nbsp&nbsp수사 보고서 상세 페이지 </h3>
	<hr width = "100%" color = "#1369B8" size = "10">
	<br>

<?php
    $con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com", "admin", "rnqhstlr123!", "PoliceDB") 
    or die("MySQL 접속 실패!!");

    $check = $_GET["check"];
    $role = $_GET["role"];
    $teamId = $_GET["teamId"];
    $report_id = $_GET['report_id'];
    $sql = "CALL searchReport('".$report_id."')";

    $ret = mysqli_query($con, $sql);
    if($ret) {
            $row = mysqli_fetch_array($ret);
    }
    else {
        echo "보고서 데이터 조회 실패 !!!!"."<br>";
        echo "실패 원인 :".mysqli_error($con);
        exit();
    }
    echo "<TABLE border = 1>";
    echo "<TR>";
        echo "<TH>작성자</TH>";
        echo "<TD>", $row['writer'], "</TD>";
    echo "</TR>";
    echo "<TR>";
        echo "<TH>작성일</TH>";
        echo "<TD>", $row['re_date'], "</TD>";
    echo "</TR>";
    echo "<TR>";
        echo "<TH>제목</TH>";
        echo "<TD>", $row['title'], "</TD>";
    echo "</TR>";
    echo "</TABLE>";
    echo "<p>수사 내용 :";
    echo "<table border = 1 style='width:450px;table-layout:fixed;word-break:break-all;height:auto'>" ;
    echo "<TR>";
        echo "<TD>", $row['content'], "</TD>";
    echo "</TR>";
    echo "</TABLE>";
    echo "</p>";

    mysqli_close($con);

    echo "<hr>";
    if ($check){
        echo "<hr> <a href = '/PolicePHP/Report_update.php?report_id=$report_id&role=$role&teamId=$teamId'><button>수정하기</button></a> ";
    }   
    echo "<a href = '/PolicePHP/home.php?role=$role&teamId=$teamId'><button>홈</button></a> ";
?>
</body>
</html>
	