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

$s_name=$_POST["s_name"];
$d_name=$_POST["d_name"];

$team_ids =[];
$team_names = [];
$team_count = [];
$count = 0;
$sql="call incidentAdd3('$s_name','$d_name')";
$ret=mysqli_query($con,$sql);

if($ret){
    while($row=mysqli_fetch_array($ret)){
        $team_ids[$count] = $row["team_id"];
        $team_names[$count] = $row["name"];
        $team_count[$count] = $row["count"];
        $count = $count +1;
    }
}else{
    echo "데이터 조회실패"."<br>";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<hr width = "100%" color = "#FFD966" size = "60">

<h2>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 팀 선택 및 정보 기입 &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; </h2>

<hr width = "100%" color = "#FFD966" size = "10">

<h2>2.2 팀선택</h2>

<form method = "post", action = "/PolicePHP/incidentAdd4.php">
    
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
<input type = "text" name = "applicant" value=<?php echo $applicant?> hidden/>

<table  border="1" bordercolor="black" width ="40%" height="50" table-layout:fixed;>
    <tr>
        <th>팀</th>
    <td>
    <select name="team_number" size = "1">
        <?php      
            for($j=0; $j<$count; $j=$j+1) {
                echo "<option value='".$team_ids[$j]."'>".$team_names[$j].
                    "(".$team_count[$j]."건) </option>>";
            }
        ?>
    </select>
        
    </tr>
        <tr>
            <th>시작일시</th>
            <td><input type="datetime-local" name = "start_date" min = "2010-01-01" placeholder="ex)2020-10-20 13:00:00" required/></td>
        </tr>
        <tr>
            <th>종료일시</th>
            <td><input type="datetime-local" name = "end_date" min = "2010-01-01" placeholder="ex)2020-10-20 13:00:00" /></td>
        </tr>
</table>

   <hr>
   <input type = "submit" value = "다음">
</form>

<br>
</body>
</html>