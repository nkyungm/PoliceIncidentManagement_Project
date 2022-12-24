<?php
//DB 연결
$db_host="policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com"; 
$db_user="admin";
$db_password="rnqhstlr123!";
$db_name="PoliceDB";
$con=mysqli_connect($db_host,$db_user,$db_password,$db_name) or die("MySQL 접속 실패!!");

$role = $_POST["role"]; //role 변수
$teamId = $_POST["teamId"]; //team_id 변수
$applicant=$_POST["applicant"]; //신고자 유무 확인 변수 -> 있으면 1, 없으면 0

$team_number=$_POST["team_number"];
$team_start_date=$_POST["team_start_date"];
$team_end_date=$_POST["team_end_date"];

$case=$_POST["case"];
$incident_start_date=$_POST["incident_start_date"];
$incident_address=$_POST["incident_address"];
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<hr width = "100%" color = "#FFD966" size = "60">

<h2> 사건 등록 완료 </h2>

<hr width = "100%" color = "#FFD966" size = "10">
    
<?php
    if($applicant=="1"){ #신고자가 있는 경우
        
        $sql="call incident_add_1('$case','$incident_start_date','$incident_address','$team_number','$team_start_date','$team_end_date')";
    }
    else{ #신고자가 없는 경우
        
        $sql="call incident_add_0('$case','$incident_start_date','$incident_address','
        $team_number','$team_start_date','$team_end_date')";
    }
    
    
    $ret=mysqli_query($con,$sql);
    if($ret){ //정상 작동할 경우
        echo '<h4> 사건 등록이 정상적으로 완료 되었습니다. </h4>';
    }
    else{
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