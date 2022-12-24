<?php
//DB 연결
$db_host="policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com" ; 
$db_user="admin";
$db_password="rnqhstlr123!";
$db_name="PoliceDB";
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name) or die("MySQL 접속 실패!!");

$role = $_GET["role"]; //role 변수
$teamId = $_GET["teamId"]; //team_id 변수
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<hr width = "100%" color = "#FFD966" size = "60">

<!-- 메뉴 바 form -->
<form method = "GET", action = "/PolicePHP/" style="width:25%;float:left;">
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
<input type = "submit" value = "사건 조회">
</form>
    
<form method = "GET", action = "/PolicePHP/Police_main.php" style="width:25%;float:left;">
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>    
<input type = "submit" value = "경찰관 관리">
</form>

<form method = "GET", action = "/PolicePHP/incidentAdd1.php" style="width:25%;float:left;">
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
<input type = "submit" value = "사건 등록">
</form>

<form method = "GET", action = "/PolicePHP/statistics1.php" style="width:25%;float:left;">
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>   
<input type = "submit" value = "통계">
</form>

<hr width = "100%" color = "#FFD966" size = "10">
<br>
    <h2 style="color:#176CB9;display:inline;">- 서,부서,팀 별 사건 처리 개수 통계</h2>
    <h3 style="display:inline"># 서 별 통계는 고정 값입니다.</h3>
    <br><br>

    <!-- 서,부서,팀 별 통계 form -->
    <form method="get" action="/PolicePHP/statistics2.php">
        <input type = "text" name = "role" value=<?php echo $role?> hidden/> 
        <input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
        <h3 style="display: inline">서</h3><input type="checkbox" checked disabled style="width:20px;height:20px;"/>
        <h3 style="display: inline">부서</h3><input type="checkbox" name="statistics1" value="d_n" style="width:20px;height:20px;"/>
        <h3 style="display: inline">팀</h3><input type="checkbox" name="statistics2" value="t_n" style="width:20px;height:20px;"/>
        <input type="submit" value="검색"/> 
    </form>
    <br>
    <h2 style="color:#176CB9;display:inline;">- 지역별 사건 발생 개수 통계</h2>
    <h3 style="display:inline"># 구 별 통계는 고정 값입니다.</h3>
    <br><br>

    <!-- 지역별 통계 form -->
    <form method="get" action="/PolicePHP/statistics3.php">
        <input type = "text" name = "role" value=<?php echo $role?> hidden/>
        <input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
        <h3 style="display: inline">구</h3><input type="checkbox" checked disabled style="width:20px;height:20px;"/>
        <h3 style="display: inline">로/동서</h3><input type="checkbox" name="statistics" value="" style="width:20px;height:20px;"/>
        
        <input type="submit" value="검색"/>
    </form>
</body>
</html>