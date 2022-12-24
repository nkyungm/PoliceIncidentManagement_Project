<?php

    $con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com",
                      "admin", "rnqhstlr123!", "PoliceDB") or dir("MySQL 접속 실패!!");
    
    $role = $_GET["role"];
    $teamId = $_GET["teamId"];
    $Incident_id = $_GET["Incident_id"];
    
    $sql =  "CALL search_Incident_Other_info_Proc('".$Incident_id."');";
    $sql .= "CALL search_Incident_Team_info_Proc('".$Incident_id."');";

    $Incident_info = [];
    $team_ids = [];
    $team_unit = [];
    $team_perid = [];
    $level =0;
    $count =0; //팀의 개수

    if(mysqli_multi_query($con, $sql)){
        
        do{
            if($result = mysqli_store_result($con)){
                
                #첫 번째 쿼리 
                if($level == 0) {
                    while($row = mysqli_fetch_array($result)){
                        
                        $Incident_info[0] = $row['incident_id'];
                        $Incident_info[1] = $row['type'];
                        $Incident_info[2] = $row['start_date'];
                        $Incident_info[3] = $row['end_date'];
                        $Incident_info[4] = $row['progress'];
                        $Incident_info[5] = $row['address'];
                        $Incident_info[6] = $row['applicant_id'];
                    }
                #두 번째 쿼리
                }
                else {
                    while($row = mysqli_fetch_array($result)){
                        $team_ids[$count] = $row['team_id'];
                        $team_unit[$count] = $row['Unit'];
                        $team_perid[$count] = $row['perid'];
                        $count = $count +1;
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
<h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 사건 조회 결과 </h3>
<hr width = "100%" color = "#1369B8" size = "10">
<br>
    
<?php
    echo "<a href=/PolicePHP/home.php?role=".$role."&teamId=".$teamId. 
            "> <--홈으로 </a>";
?>
    
    <table width='1100' border='1' cellpadding='1' cellspace='0' style='table-layout:fixed;'>
	<th>사건 ID</th>
	<th>종류</th>
    <th>시작일시</th>
    <th>종료일시</th>
    <th>진행도</th>
    <th>주소</th>
    <th>팀</th>

        
    <!-- while문으로 반복 -->
	<tr><!-- 첫번째 줄 시작 -->
	    <td>
            <?php
                echo "<a href=/PolicePHP/Incident_Details.php?incidentId=".$Incident_info[0]."&role=".$role."&teamId=".$teamId.  ">".$Incident_info[0]."</a>";
            ?>
        </td>

	    <td>
            <?php
                echo $Incident_info[1];
            ?>
        </td>
    
        <td>
            <?php
                echo $Incident_info[2];
            ?>
        </td>
        
        <td>
            <?php
                echo $Incident_info[3];
            ?>
        </td>
        
        <td>
            <?php
                echo $Incident_info[4];
            ?>
        </td>

        <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
            <?php
                echo "<span class='tooltip' title='".$Incident_info[5]."'>".$Incident_info[5]."</span>";
            ?>
        </td>

        <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
            <span class="tooltip" title="
                  <?php
                        for($i=0; $i<$count; $i=$i+1){
                            echo $team_unit[$i]." ".$team_perid[$i]."\n";
                        }
                  ?>"
            >
            <?php
                for($i=0; $i<$count; $i=$i+1){
                    echo $team_unit[$i]." ".$team_perid[$i];       
                }
            ?> 
            </span>
        </td>
        
        <?php
        
            #경찰관 일경우 -> 사건을 맡고 있는 팀인지 확인
            $check = false;
            if($role=="Police") {
                
                if($Incident_info[4] != "수사완료") {
                
                    foreach($team_ids as $team_id) {
                        if($team_id == $teamId){
                            $check = true;
                            break;
                        }
                    }

                    if($check == true) { #사건을 맡은 팀인경우
                        if(is_null($Incident_info[6])) {
                            echo "<td>";
                            echo "<form method = 'get' , action = 'Incident_AddApplicant.php'>";
                            echo "<input type = 'text' name = 'incident_id' value ='".$Incident_info[0]."' hidden>";
                            echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";
                            echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";
                            echo "<button type = 'submit'> 신고자 등록 </button>";
                            echo "</form>";
                            echo "</td>";
                        }

                        echo "<td>";
                        echo "<form method = 'get' , action = 'Incident_AddSuspect.php'>";
                        echo "<input type = 'text' name = 'incident_id' value ='".$Incident_info[0]."' hidden>";
                        echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";
                        echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";
                        echo "<button type = 'submit'> 가해자 추가 </button>";
                        echo "</form>";
                        echo "</td>";

                        echo "<td>";
                        echo "<form method = 'get' , action = 'Incident_AddVictim.php'>";
                        echo "<input type = 'text' name = 'incident_id' value ='".$Incident_info[0]."' hidden>";
                        echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";
                        echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";
                        echo "<button type = 'submit'> 피해자 추가 </button>";
                        echo "</form>";
                        echo "</td>";

                        echo "<td>";
                        echo "<form method = 'get' , action = 'Incident_AddReport.php'>";
                        echo "<input type = 'text' name = 'incident_id' value ='".$Incident_info[0]."' hidden>";
                        echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";
                        echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";
                        echo "<button type = 'submit'> 보고서 쓰기 </button>";
                        echo "</form>";
                        echo "</td>";
                    }
                    
                }
                
            }
            #관리자일 경우
            else {
                if($Incident_info[4] !="수사완료") {
                    echo "<td>";
                    echo "<form method = 'get' , action = 'Incident_team_add2.php?'>";
                    echo "<input type = 'text' name = 'incident_id' value ='".$Incident_info[0]."' hidden>";
                    echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";

                    $teamId = "none";
                    echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";

                    echo "<button type = 'submit'> 팀 추가 </button>";
                    echo "</form>";
                }
                
            }
        ?>
        
	</tr><!-- 첫번째 줄 끝 -->

</body>

</html>

