<?php
//DB 연결
$db_host="policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com" ; 
$db_user="admin";
$db_password="rnqhstlr123!";
$db_name="PoliceDB";
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name) or die("MySQL 접속 실패!!");

$role = $_POST["role"]; //role 변수
$teamId = $_POST["teamId"]; //team_id 변수
$applicant=$_POST["applicant"]; //신고자 유무 확인 변수 -> 있으면 1, 없으면 0


$t_number=$_POST["team_number"];
$start_date=$_POST["start_date"];
$end_date=$_POST["end_date"];

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<hr width = "100%" color = "#FFD966" size = "60">

<h2>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 사건 정보 기입 &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; </h2>

<hr width = "100%" color = "#FFD966" size = "10">

<h2>3. 사건 등록</h2>

<form method = "post", action = "/PolicePHP/incidentAdd5.php">
<input type = "text" name = "role" value=<?php echo $role?> hidden />
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
<input type = "text" name = "applicant" value=<?php echo $applicant?> hidden/>

<input type = "text" name = "team_number" value="<?php echo $t_number?>"hidden/>
<input type = "datetime" name = "team_start_date" value="<?php echo $start_date?>" hidden/>
<input type = "datetime" name = "team_end_date" value="<?php echo $end_date?>"hidden/>

<table  border="1" bordercolor="black" width ="40%" height="50" table-layout:fixed;>
            <tr>
                <th>사건 종류</th>
                <td><select name="case">
    <option value="살인">살인</option>
    <option value="사기">사기</option>
    <option value="성폭행">성폭행</option>
    <option value="절도">절도</option>
    <option value="폭행">폭행</option>
    <option value="음주">음주</option>
</select>
</td>
            </tr>
            <tr>
                <th>시작일시</th>
                <td><input type="datetime-local" name = "incident_start_date" min = "2010-01-01" placeholder="ex)2020-10-20 13:00:00" required/></td>
            </tr>
             <tr>
                <th>주소</th>
                <td><input type = "text" name = "incident_address" placeholder = "대구광역시 북구 123로 12 상세주소" required/></td>
            </tr>
</table>

   <hr>
   <input type = "submit" value = "등록">
</form>

<br>
</body>
</html>