<!DOCTYPE html>
<html>
<head>
<meta charest="utf-8">
</head>
<body>
	<hr width = "100%" color = "#1369B8" size = "60">
	<h3> &nbsp&nbsp&nbsp&nbsp&nbsp피해자 정보 상세 </h3>
	<hr width = "100%" color = "#1369B8" size = "10">
	<br>

<?php
    $con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com", "admin", "rnqhstlr123!", "PoliceDB") 
    or die("MySQL 접속 실패!!");
    $check = $_GET["check"];
    $role = $_GET["role"];
    $teamId = $_GET["teamId"];
    $victim_id = $_GET['victim_id'];
    $sql = "CALL searchVictim('".$victim_id."')";

    $ret = mysqli_query($con, $sql);
    if($ret) {
            $row = mysqli_fetch_array($ret);
    }
    else {
        echo "피해자 데이터 조회 실패 !!!!"."<br>";
        echo "실패 원인 :".mysqli_error($con);
        exit();
    }
    echo "<TABLE border = 1>";
    echo "<TR>";
        echo "<TH>이름</TH>";
        echo "<TD>", $row['name'], "</TD>";
    echo "</TR>";
    echo "<TR>";
        echo "<TH>주소</TH>";
        echo "<TD>", $row['address'], "</TD>";
    echo "</TR>";
    echo "<TR>";
        echo "<TH>생년월일</TH>";
        echo "<TD>", $row['birth'], "</TD>";
    echo "</TR>";
    echo "<TR>";
        echo "<TH>전화번호</TH>";
        echo "<TD>", $row['phone'], "</TD>";
    echo "</TR>";
    echo "<TR>";
        echo "<TH>성별</TH>";
        echo "<TD>", $row['gender'], "</TD>";
    echo "</TR>";

    mysqli_close($con);
    echo "</TABLE>";

    echo "<hr>";
    if ($check){
        echo "<a href = '/PolicePHP/Victim_update.php?victim_id=$victim_id&role=$role&teamId=$teamId'><button>수정하기</button></a> ";
    }
    echo "<a href = '/PolicePHP/home.php?role=$role&teamId=$teamId'><button>홈</button></a> ";
?>
</body>
</html>
	
