<?php

    $con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com",
                      "admin", "rnqhstlr123!", "PoliceDB") or dir("MySQL 접속 실패!!");
    
    $role = $_GET["role"];
    $teamId = $_GET["teamId"];
    $Incident_id = $_GET["incidentId"];
    
    $sql = "CALL search_Incident_Other_plus_Applicant_info_Proc('".$Incident_id."');";
    $sql .= "CALL search_Incident_Team_info_Proc('".$Incident_id."');";
    $sql .= "CALL search_Incident_Suspect_info_Proc('".$Incident_id."');";
    $sql .= "CALL search_Incident_Victim_info_Proc('".$Incident_id."');";
    $sql .= "CALL search_Incident_Report_info_Proc('".$Incident_id."');";

    #사건 정보( + 신고자 정보)
    $Incident_info = [];

    #팀정보
    $team_ids = [];
    $team_unit = [];
    $team_perid = [];
    $t_count =0; //팀의 개수
    
    #가해자 정보
    $suspect_ids =[];
    $suspect_info =[];
    $s_count =0;
    
    #피해자 정보
    $victim_ids = [];
    $victim_info = [];
    $v_count =0;

    #보고서 정보
    $report_ids = [];
    $report_info = [];
    $r_count =0;

    $level =0;
    if(mysqli_multi_query($con, $sql)){
        
        do{
            if($result = mysqli_store_result($con)){
                
                #사건 정보 쿼리
                if($level == 0) {
                    while($row = mysqli_fetch_array($result)){
                        $Incident_info[0] = $row['incident_id'];
                        $Incident_info[1] = $row['type'];
                        $Incident_info[2] = $row['start_date'];
                        $Incident_info[3] = $row['end_date'];
                        $Incident_info[4] = $row['progress'];
                        $Incident_info[5] = $row['address'];
                        
                        #신고자 정보 - 단일!
                        $Incident_info[6] = $row['applicant_id'];
                        $Incident_info[7] = $row['a_info'];
                    }
                #팀 정보 쿼리
                }
                else if($level == 1){
                    while($row = mysqli_fetch_array($result)){
                        $team_ids[$t_count] = $row['team_id'];
                        $team_unit[$t_count] = $row['Unit'];
                        $team_perid[$t_count] = $row['perid'];
                        $t_count = $t_count +1;
                    }
                }
                #가해자 정보 쿼리
                else if($level == 2) {
                    while($row = mysqli_fetch_array($result)){
                        $suspect_ids[$s_count] = $row['suspect_id'];
                        $suspect_info[$s_count] = $row['a_info'];
                        $s_count = $s_count +1;
                    }
                }
                #피해자 정보 쿼리
                else if($level == 3) {
                    while($row = mysqli_fetch_array($result)){
                        $victim_ids[$v_count] = $row['victim_id'];
                        $victim_info[$v_count] = $row['a_info'];
                        $v_count = $v_count +1;
                    }
                }
                #보고서 정보 쿼리
                else {
                    while($row = mysqli_fetch_array($result)){
                        $report_ids[$r_count] = $row['report_id'];
                        $report_info[$r_count] = $row['r_info'];
                        $r_count = $r_count +1;
                    }
                }
                
                $level = $level+1;
            }
        }while(mysqli_next_result($con));
    }

    mysqli_close($con);
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>

<body>
<hr width = "100%" color = "#1369B8" size = "60">
<h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 사건 상세 페이지 </h3>
<hr width = "100%" color = "#1369B8" size = "10">
<br>
    
    
<?php
    echo "<a href=/PolicePHP/home.php?role=".$role."&teamId=".$teamId. 
            "> <--홈으로 </a>";
?>

    
<?php
    #경찰관 일경우 -> 사건을 맡고 있는 팀인지 확인
    #관리자도 수정 못함.
    $check = false;
    if($role=="Police") {
                
        for($k=0; $k<$t_count; $k++) {
            if($teamId == $team_ids[$k]){
                $check = true;
                break;
            }
        }
        
        if($check == true) {
            echo "<a href=/PolicePHP/Incident_Update1.php?incidentId=".$Incident_info[0]."&role=".$role."&teamId=".$teamId. 
            "> 수정하로 가기 </a>";
        }
    }
    
    #뒤에서 사용하기 위한 변수
    if($check == false)
        $check = 0;
    else 
        $check = 1;
?>

    <table border='1'>
        <tr>
            <th>사건 ID
            <td>
                <?php
                    echo $Incident_info[0];
                ?>
            </td>
            </th>
        </tr>

        <tr>
        <th>사건 종류
            <td>
                <?php
                    echo $Incident_info[1];
                ?>
            </td>
        </th>
        </tr>

        <tr>
            <th>팀
                <td>
                    <?php
                        $str = "";
                        for($i=0; $i<$t_count; $i=$i+1){
                            $str .= $team_unit[$i]." ".$team_perid[$i]."<br>";       
                        }
                        echo $str;
                    ?> 
                </td>
               
            </th>
        </tr>

        <tr>
            <th>시작일시
                <td>
                    <?php
                        echo $Incident_info[2];
                    ?>
                </td>
            </th>
        </tr>

        <tr>
            <th>종료일시
                <td>
                    <?php
                        echo $Incident_info[3];
                    ?>
                </td>
            </th>
        </tr>

        <tr>
            <th>사건 발생 주소
                <td>
                    <?php
                        echo $Incident_info[5];
                    ?>
                </td>
            </th>
        </tr>

        <tr>
            <th>진행도
                <td>
                    <?php
                        echo $Incident_info[4];
                    ?>
                </td>
            </th>
        </tr>

        <tr>
            <th>신고자
                <td>
                    <?php
                        echo "<a href=/PolicePHP/Incident_Applicant.php?applicant_id=".$Incident_info[6]."&role=".$role."&teamId=".$teamId."&check=".$check. ">".$Incident_info[7]."</a>";
                    ?>
                </td>
            </th>
        </tr>

        <tr>
            <th>가해자
                <td>
                    <?php
                        
                        for($i=0; $i<$s_count; $i++) {
                            echo "<a href=/PolicePHP/Incident_Suspect.php?suspect_id=".$suspect_ids[$i]."&role=".$role."&teamId=".$teamId."&check=".$check.  ">".$suspect_info[$i]."</a> <br>";
                        }

                    ?>    
                </td>
            </th>
        </tr>

        <tr>
            <th>피해자
                <td>
                    <?php
                        
                        for($i=0; $i<$v_count; $i++) {
                            echo "<a href=/PolicePHP/Incident_Victim.php?victim_id=".$victim_ids[$i]."&role=".$role."&teamId=".$teamId."&check=".$check.  ">".$victim_info[$i]."</a> <br>";
                        }

                    ?>    
                </td>
            </th>
        </tr>

        <tr>
            <th>보고서
                <td>
                    <?php
                        
                        for($i=0; $i<$r_count; $i++) {
                            echo "<a href=/PolicePHP/Incident_Report.php?report_id=".$report_ids[$i]."&role=".$role."&teamId=".$teamId."&check=".$check.  ">".$report_info[$i]."</a> <br>";
                        }

                    ?>    
                </td>
            </th>
        </tr>

    </table>


</body>

</html>
