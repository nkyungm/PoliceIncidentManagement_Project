<?php
$con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com",
                      "admin", "rnqhstlr123!", "PoliceDB") or dir("MySQL 접속 실패!!");

$role = $_POST["role"];
$teamId = $_POST["teamId"];

$s_name = $_POST['s_name'];
$d_name = $_POST['d_name'];
$t_name = $_POST['t_name'];
$name = $_POST['name'];
$birth = $_POST['birth'];
$phone = $_POST['phone'];
$rank = $_POST['rank'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$user_id = $_POST['id'];

////프로시저 호출
$sql = "CALL Police_update_Proc('".$name."','".$birth."','".$gender."','".$phone."','".$rank."','".$address."','".$s_name."','".$d_name."','".$t_name."','".$user_id."')";

$ret = mysqli_query($con, $sql);

if($ret){
    echo "";
}
else{
    echo "User 업데이트 실패!!!"."<br>";
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
<h2> 경찰관 수정 완료 </h2>

<hr width = "100%" color = "#FFD966" size = "10">

<h4> 경찰관 수정이 정상적으로 완료 되었습니다. </h4>

<form method = "GET", action = "/PolicePHP/home.php">
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
    
<input type = "submit" value = "<---- 홈으로">
</form>
    
</body>
</html>
