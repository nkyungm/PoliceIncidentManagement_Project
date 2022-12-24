<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php 
$con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com",
                      "admin", "rnqhstlr123!", "PoliceDB") or dir("MySQL 접속 실패!!");

$role = $_GET["role"];
$teamId = $_GET["teamId"];
    
?>
    
<hr width = "100%" color = "#FFD966" size = "60">
    
<form method = "GET", action = "/PolicePHP/home.php">
<h2> 경찰관 조회 결과 </h2>
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>   
<input type = "submit" value = "&nbsp;&nbsp;<----- 홈으로&nbsp;&nbsp;">
</form>
<br>
    
<hr width = "100%" color = "#FFD966" size = "10">    
    
<?php
$s_name =$_GET["s_name"];//서 받아옴
$d_name =$_GET["d_name"];//부서 받아옴
$t_name =$_GET["t_name"];//팀 받아옴
$name = $_GET["name"];//검색한 이름 받아옴

//프로시저 호출
$sql = "CALL Police_search_Proc(";
if($s_name == "null"){//서 이름이 null인 경우
    $sql .="null,";
}else{
    $sql .="'".$s_name."',";
}
if($d_name == "null"){//부서 이름이 null인 경우
    $sql .="null,";
}else{
    $sql .="'".$d_name."',";
}
if($t_name == "null"){//팀 이름이 null인 경우
    $sql .="null,";
}else{
    $sql .="'".$t_name."',";
}
if($name == "null"){
    $sql .="null,";
}else{
    $sql .="'".$name."'";
}
$sql .= ");";

$ret = mysqli_query($con, $sql);

if($ret){
    echo "";
}
else{
    echo "조회 실패!!!"."<br>";
    echo "실패 원인 :".mysqli_error($con);
    exit();
}


echo "<TABLE border=1>";
echo "<th>아이디</th>";
echo "<th>비밀번호</th>";
echo "<th>이름</th>";
echo "<th>생년월일</th>";
echo "<th>성별</th>";
echo "<th>전화번호</th>";
echo "<th>직급</th>";
echo "<th>주소</th>";
echo "<th>서</th>";
echo "<th>부서</th>";
echo "<th>팀</th>";
echo "<th> </th>";
echo "<tbody>";
       
while($row = mysqli_fetch_array($ret)){
    echo "<tr>";
    echo "<td>", $row['user_id'], "</td>";
    echo "<td>", $row['password'], "</td>";
    echo "<td>", $row['name'], "</td>";
    echo "<td>", $row['birth'], "</td>";
    echo "<td>", $row['gender'], "</td>";
    echo "<td>", $row['phone'], "</td>";
    echo "<td>", $row['rank'], "</td>";
    echo "<td>", $row['address'], "</td>";
    echo "<td>", $row['station'], "</td>";
    echo "<td>", $row['department'], "</td>";
    echo "<td>", $row['team'], "</td>";
    echo "<td>", "<a href='/PolicePHP/Police_update_delete.php?user_id=".$row['user_id']."&role=".$role."&teamId=".$teamId. "'> 수정 및 삭제 </a></td>";
    echo "</tr>";
}

echo "</tbody>";
mysqli_close($con);
echo "</TABLE>";

?>

</body>
</html>


