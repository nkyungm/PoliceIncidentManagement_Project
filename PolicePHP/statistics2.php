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
    <style>
        table {
            width: 100%;
            border: 0.5px solid #444444;
            border-collapse: collapse;
        }
        th, td {
            border: 0.5px solid #444444;
            padding: 10px;
        }
    </style>
</head>
<body>
<hr width = "100%" color = "#FFD966" size = "60">
<h2 style="display: inline">서,부서,팀 별 사건 처리 개수 통계 결과</h2>

<!-- 홈으로 가는 form(role,teamId hidden으로 전송) -->
<form method="get" action="/PolicePHP/home.php">
    <input type = "text" name = "role" value=<?php echo $role?> hidden/>
    <input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
    <input type="submit" value="<- 홈으로"/>
</form>

<hr width = "100%" color = "#FFD966" size = "10">
<br>
    <table>
        <?php
    $s_n= true; //서, 디폴트 값으로 체크 됨(고정값)
    $d_n= isset($_GET['statistics1'])? true:false; //부서 -> checkbox에 check된 경우에 true, 아니면 false
    $t_n=isset($_GET['statistics2'])? true:false; //팀 -> checkbox에 check된 경우에 true, 아니면 false

    $sql="call statistics1('$s_n','$d_n','$t_n')"; //스토어드 프로시저 statistics1 불러와서 사용

    $ret=mysqli_query($con,$sql);
    if($ret){ //정상 작동할 경우
        echo "<tr><th>Unit </th><th>살인</th><th>사기</th><th>음주</th><th>폭행</th><th>성폭행</th><th>절도</th></tr>";
        while($row=mysqli_fetch_array($ret)){ //while문 사용해 row 출력
            echo "<tr>";
            echo "<td>", $row['Unit'],"</td>";
            echo "<td>", $row['살인'],"</td>";
            echo "<td>", $row['사기'],"</td>";
            echo "<td>", $row['음주'],"</td>";
            echo "<td>", $row['폭행'],"</td>";
            echo "<td>", $row['성폭행'],"</td>";
            echo "<td>", $row['절도'],"</td>";
            echo "</td>";
        }
    }
    else{ //조회 실패 경우
        echo "조회 실패"."<br><br>";
        echo "실패 원인:".mysqli_error($con);
    }

    mysqli_close($con); //종료
    echo "</table>";

?>
    </table>
   
</body>
</html>