<?php
$con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com",
                      "admin", "rnqhstlr123!", "PoliceDB") or dir("MySQL 접속 실패!!");

$incident_id = $_POST["incident_id"];//incident_id 받아옴
$s_name =$_POST["s_name"];//서 받아옴
$d_name =$_POST["d_name"];//부서 받아옴
$t_name =$_POST["t_name"];//팀 받아옴
$start =$_POST["start"];//시작 날짜
$end =$_POST["end"];//종료 날짜

$role = $_POST["role"];
$teamId = $_POST["teamId"];

//프로시저 호출
$sql = "CALL team_add_Proc('".$incident_id."','".$s_name."','".$d_name."','".$t_name."','".$start."','".$end."')";

$ret = mysqli_query($con, $sql);

if($ret){
    echo "";
}
else{
    echo "Team_incident 생성 실패!!!"."<br>";
    echo "실패 원인 :".mysqli_error($con);
}

mysqli_close($con);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<hr width = "100%" color = "#FFD966" size = "60">
<h2> 팀 추가 완료 </h2>

<hr width = "100%" color = "#FFD966" size = "10">

<h3> 팀 추가가 정상적으로 완료 되었습니다. </h3>
    
<form method = "GET", action = "/PolicePHP/home.php">
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
    
<input type = "submit" value = "<---- 홈으로">
</form>


</body>
</html>