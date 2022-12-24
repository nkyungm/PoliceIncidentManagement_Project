<?php
//DB 연결
$db_host="policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com" ; 
$db_user="admin";
$db_password="rnqhstlr123!";
$db_name="PoliceDB";
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name) or die("MySQL 접속 실패!!");

$role =$_POST["role"]; //role 변수
$teamId =$_POST["teamId"]; //team_id 변수
$applicant=$_POST["applicant"]; //신고자 유무 확인 변수 -> 있으면 1, 없으면 0

if($applicant=="1"){
    
    $name=$_POST["name"]; 
    $address=$_POST['address'];
    $birth=$_POST["birth"];
    $phone=$_POST["phone"];
    $report_date=$_POST["report_date"];
    
    if($_POST['gender']=="1"){
        $gender="남성";
    }
    else{
        $gender="여성";
    }
    
    $sql="call applicant_add('$name','$birth','$phone','$report_date','$gender','$address')";
    $ret=mysqli_query($con,$sql);
    if($ret){

    }else{
        echo "조회 실패"."<br><br>";
        echo "실패 원인:".mysqli_error($con);
    }
}


mysqli_close($con); //종료
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<hr width = "100%" color = "#FFD966" size = "60">

<h2>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 팀검색 &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; </h2>

<hr width = "100%" color = "#FFD966" size = "10">

<h2>2.1 팀선택을 위한 검색</h2>

<form method = "post", action = "/PolicePHP/incidentAdd3.php">
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
<input type = "text" name = "applicant" value=<?php echo $applicant?> hidden/>
    
<table  border="1" bordercolor="black" width ="40%" height="50" table-layout:fixed;>
<tr>
    <th>서</th>
    <td>
        <select name="s_name" size = "1">
        <option value = "동구경찰서" selected>동구경찰서</option>
        <option value = "남구경찰서" >남구경찰서</option>
        <option value = "서구경찰서" >서구경찰서</option>
        <option value = "북구경찰서" >북구경찰서</option>
        <option value = "중구경찰서" >중구경찰서</option>
        <option value = "수성구경찰서" >수성구경찰서</option>
    </select>
</td>
</tr>
<tr>
    <th>부서</th>
    <td>
        <select name="d_name" size = "1">
        <option value = "수사과" selected>수사과</option>
        <option value = "형사과" >형사과</option>
        <option value = "교통과" >교통과</option>
        <option value = "여성 청소년과" >여성 청소년과</option>
    </select>
</td>
</tr>
</table>
    
<hr>
   <input type = "submit" value = "다음">
</form>

</body>
</html>