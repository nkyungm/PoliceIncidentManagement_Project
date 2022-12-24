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
<h3> &nbsp&nbsp&nbsp&nbsp&nbsp사건 상세 페이지 </h3>
<hr width = "100%" color = "#1369B8" size = "10">
<br>
    
    
<form method="post" action="/PolicePHP/Incident_Update2.php">
    
    <input type = "text" name = "role" value=<?php echo $role ?> hidden/>
    <input type = "text" name = "teamId" value=<?php echo $teamId ?> hidden/> 

    
    <table border='1'>
        <tr>
            <th>사건 ID
            <td>
                <input type = "text" name = "incidentId" value=<?php echo $Incident_info[0]?> readonly />
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
                     <input type = "datetime" name = "end_date" min = "2010-01-01" 
                           value = "<?php echo $Incident_info[3]; ?>"/>
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
                    <select name="progress" size = "1">
                    <option value = "배정완료" 
                            <?php if($Incident_info[4] =="배정완료") echo "SELECTED";?>>배정완료
                    </option>
                    <option value = "수사중" 
                            <?php if($Incident_info[4] =="수사중") echo "SELECTED";?>> 수사중
                        </option>
                    <option value = "수사완료" 
                            <?php if($Incident_info[4] =="수사완료") echo "SELECTED";?>> 수사완료
                        </option>
                    <option value = "미제사건" 
                            <?php if($Incident_info[4] =="미제사건") echo "SELECTED";?>> 미제사건
                        </option>
                    </select>
                </td>
            </th>
        </tr>

        <tr>
            <th>신고자
                <td>
                    <?php echo $Incident_info[7]; ?>
                </td>
            </th>
        </tr>

        <tr>
            <th>가해자
                <td>
                    <?php
                        for($i=0; $i<$s_count; $i++) {
                            echo $suspect_info[$i]."<br>";
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
                            echo $victim_info[$i]."<br>";
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
                            echo $report_info[$i]."<br>";
                        }
                    ?>    
                </td>
            </th>
        </tr>

    </table>

<input type = "submit" value = "수정완료">
</form>

</body>

</html>
