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
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<hr width = "100%" color = "#FFD966" size = "60">

<form method = "GET", action = "/PolicePHP/home.php" style="width:25%;float:left;">
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

    
    
    
    
<h2>1. 신고자 등록</h2>
<form method = "post", action = "/PolicePHP/incidentAdd2.php">
   <input type = "text" name = "role" value=<?php echo $role?> hidden/> 
   <input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
   <input type = "text" name = "applicant" value="0" hidden/>
   <input type = "submit" value = "신고자 없음"><br><br> 
</form>

    
    
    
<form method = "post", action = "/PolicePHP/incidentAdd2.php">
   <input type = "text" name = "role" value=<?php echo $role?> hidden/> 
   <input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
   <input type = "text" name = "applicant" value="1" hidden/>
    
   <table  border="1" bordercolor="black" width ="40%" height="50" table-layout:fixed;>
            <tr>
                <th>이름</th>
                <td><input type = "text" name = "name" required/></td>
            </tr>
             <tr>
                <th>주소</th>
                <td><input type = "text" name = "address" placeholder = "대구광역시 북구 123로 12 상세주소" /></td>
            </tr>
            <tr>
                <th>생년월일</th>
                <td><input type="date" name = "birth" min = "1950-01-01" placeholder="ex)2020-10-20" required/></td>
            </tr>
            <tr>
                <th>전화번호</th>
                <td><input type = "tel" name = "phone" placeholder= "123-1234-1234" pattern="[0-9]{2,3}-[0-9]{3,4}-{0-9}{4}" /></td>
            </tr>
            <tr>
                <th>신고일시</th>
                <td><input type="datetime-local" name = "report_date" min = "1990-01-01" placeholder= "ex)2020-10-20 13:00:00" required/></td>
            </tr>
            <tr>
                <th>성별</th>
                <td><input type = "radio" name = "gender" value ="1" ondblclick="this.checked=false" required/> 남성
                    <input type = "radio" name = "gender" vaule = "2" ondblclick="this.checked=false"/> 여성</td>
            </tr> 
</table>

<hr>
   <input type = "submit" value = "다음">
</form>

</body>
</html>