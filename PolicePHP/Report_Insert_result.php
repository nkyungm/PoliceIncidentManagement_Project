<!DOCTYPE html>
<html>
<head>
<meta charest="utf-8">
</head>
<body>
	<hr width = "100%" color = "#1369B8" size = "60">
	<h3> &nbsp&nbsp&nbsp&nbsp&nbsp수사 보고서 작성 결과 </h3>
	<hr width = "100%" color = "#1369B8" size = "10">
	<br>

<?php
    $con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com", "admin", "rnqhstlr123!", "PoliceDB") 
    or die("MySQL 접속 실패!!");

    $incident_id = $_POST["incident_id"];
    $role = $_POST["role"];
    $teamId = $_POST["teamId"];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "CALL insertReport('".$title."', '".$content."', '".$teamId."', '".$incident_id."')" ;
    $ret = mysqli_query($con, $sql);

    if($ret) {
        echo "보고서 정상 등록 완료.";
    }
    else {
        echo "보고서 등록 실패 !!!";
        echo "실패 원인 :" .mysqli_error($con);
        echo "<hr> <a href = '/PolicePHP/home.php?role=$role&teamId=$teamId'><button>확인</button></a> ";
    }
    mysqli_close($con);

    echo "<hr> <a href = '/PolicePHP/home.php?role=$role&teamId=$teamId'><button>확인</button></a> ";
?>

    </body>
    </html>
