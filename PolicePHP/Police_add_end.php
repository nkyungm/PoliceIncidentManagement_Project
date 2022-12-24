<?php
//DB 연결
$db_host="policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com" ; 
$db_user="admin";
$db_password="rnqhstlr123!";
$db_name="PoliceDB";
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name) or die("MySQL 접속 실패!!");

$role = $_POST["role"]; //role 변수
$teamId = $_POST["teamId"]; //team_id 변수
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<hr width = "100%" color = "#FFD966" size = "60">
<h2> 경찰관 등록 완료 </h2>

<hr width = "100%" color = "#FFD966" size = "10">
<?php
$s_name=$_POST['s_name'];
$d_name=$_POST['d_name'];
$t_name=$_POST['t_name'];
$p_name=$_POST['name'];
$id=$_POST['id'];
$pw=$_POST['pw'];
$birth=$_POST['end_date'];

if($_POST['gender']=="1"){
    $gender="남성";
}
else{
    $gender="여성";
}

$phone=$_POST['phone'];
$p_rank=$_POST['rank'];
$address=$_POST['address'];

$sql="call police_add('$s_name','$d_name','$t_name','$p_name','$id','$pw','$birth','$gender','$phone','$p_rank','$address')";
$ret=mysqli_query($con,$sql);

    if($ret){ //정상 작동할 경우
        echo '<h4> 경찰관 등록이 정상적으로 완료 되었습니다. </h4>';
    }else{
        echo "조회 실패";
        echo "실패 원인:".mysqli_error($con);
    }
    mysqli_close($con); //종료
?>
    
<!-- 홈으로 가는 form(role,teamId hidden으로 전송) -->
<form method="get" action="/PolicePHP/home.php">
    <input type = "text" name = "role" value=<?php echo $role?> hidden/>
    <input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
    <input type="submit" value="<- 홈으로"/>
</form>
</body>
</html>