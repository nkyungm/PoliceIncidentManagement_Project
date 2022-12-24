<?php

    $con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com",
                      "admin", "rnqhstlr123!", "PoliceDB") or dir("MySQL 접속 실패!!");
    
    $role = $_POST["role"];
    $teamId = $_POST["teamId"];
    $incidentId = $_POST["incidentId"];
    $end_date = $_POST["end_date"];
    $progress = $_POST["progress"];
    
    $sql = "CALL update_Incident_Proc('".$incidentId."',";
    if($end_date == "") #공백인경우 
        $sql .= "null,";
    else
        $sql .= "'".$end_date."',";
    $sql .= "'".$progress."')";   

    $ret = mysqli_query($con, $sql);

    if($ret) {
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<meta charset='utf-8''>";
        echo "</head>";

        echo "<body>";
        echo "<hr width = '100%' color = '#1369B8' size = '60'>";
        echo "<h3> &nbsp&nbsp&nbsp&nbsp&nbsp사건 수정 결과 </h3>";
        echo "<hr width = '100%'' color = '#1369B8' size = '10'>";
        echo "<br>";
        echo "<p>사건 정보가 정상적으로 수정 완료되었습니다.</p>";
        
        echo "<a href=/PolicePHP/home.php?role=".$role."&teamId=".$teamId. 
            "> <--홈으로 </a>";
        
        echo "</body>";
        echo "</html>";
        
    }
    else {
        echo "데이터 조회 실패"."<br><br>";
        echo "실패 원인 :".mysqli_error($con);
        //echo "<br> <a href='/PoliceHtml/login.html'> <--로그인 화면</a> ";
        exit();
    }
   
    mysqli_close($con);
    
?>
