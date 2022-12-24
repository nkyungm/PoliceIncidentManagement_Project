<?php

    $con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com",
                      "admin", "rnqhstlr123!", "PoliceDB") or dir("MySQL 접속 실패!!");
    
    $s_n = $_GET["station_name"];
    $d_n = $_GET["department_name"];
    $t_n = $_GET["team_name"];
    $ip_n = $_GET["progress_name"];
    $it_n = $_GET["type_name"];
    $id_n = $_GET["address_name"];

    $role = $_GET["role"];
    $teamId = $_GET["teamId"];

    $sql = "CALL search_IncidentByFilter_Other_info_Proc(";
    if($s_n == "null"){
        $sql .= "null,";
    }else{
        $sql .= "'".$s_n."',";
    }
    if($d_n == "null"){
        $sql .= "null,";
    }else{
        $sql .= "'".$d_n."',";
    }
    if($t_n == "null"){
        $sql .= "null,";
    }else{
        $sql .= "'".$t_n."',";
    }
    if($ip_n == "null"){
        $sql .= "null,";
    }else{
        $sql .= "'".$ip_n."',";
    }
    if($it_n == "null"){
        $sql .= "null,";
    }else{
        $sql .= "'".$it_n."',";
    }
    if($id_n == "null"){
        $sql .= "null";
    }else{
        $sql .= "'".$id_n."'";
    }
    $sql .= ");";

    
    #사건 리스트들의 정보를 받아옴
    $incident_ids =[];
    $types = [];
    $start_dates = [];
    $end_dates = [];
    $progress_s = [];
    $address_s = [];
    $applicant_ids =[];
    $ret = mysqli_query($con, $sql);
    $count = 0; //총 사건 개수
    while($row = mysqli_fetch_array($ret)){
        $incident_ids[$count] = $row['incident_id'];
        $types[$count] = $row['type'];
        $start_dates[$count] = $row['start_date'];
        $end_dates[$count] = $row['end_date'];
        $progress_s[$count] = $row['progress'];
        $address_s[$count] = $row['address'];
        $applicant_ids[$count] = $row['applicant_id'];
        $count = $count+1;
    }
   
    #각 사건에 맡는 팀리스트를 가져옴
    $team_list =array();
    foreach($incident_ids as $data) {
        
        mysqli_close($con);
        $con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com",
                      "admin", "rnqhstlr123!", "PoliceDB") or dir("MySQL 접속 실패!!");
        
        $sql = "CALL search_Incident_Team_info_Proc('".$data."');";
        $ret = mysqli_query($con, $sql);
        
        if(!$ret) {
            echo "데이터 조회 실패"."<br><br>";
            echo "실패 원인 :".mysqli_error($con);
            exit();
        }
        
        $array =array();
        while($row = mysqli_fetch_array($ret)){
            
            $temp = array( 
                'team_id' => $row['team_id'] , 
                'Unit' => $row['Unit'] , 
                'perid' => $row['perid']);
                
            array_push($array, $temp); 
        }
        array_push($team_list, $array);
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
<h3> &nbsp;&nbsp&nbsp;&nbsp;&nbsp; 사건 조회 결과 </h3>
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
    <?php
      
        for($i=0;$i<$count;$i=$i+1) {
            echo "<tr>";
            
            echo "<td>";
            echo "<a href=/PolicePHP/Incident_Details.php?incidentId=".$incident_ids[$i]."&role=".$role."&teamId=".$teamId.  ">".$incident_ids[$i]."</a>";
            echo "</td>";
            
            echo "<td>";
            echo $types[$i];
            echo "</td>";
            
            echo "<td>";
            echo $start_dates[$i];
            echo "</td>";
            
            echo "<td>";
            echo $end_dates[$i];
            echo "</td>";
            
            echo "<td>";
            echo $progress_s[$i];
            echo "</td>";
            
            echo "<td style='text-overflow: ellipsis; overflow: hidden; white-space: nowrap;'>";
            echo "<span class='tooltip' title='".$address_s[$i]."'>".$address_s[$i]."</span>";
            echo "</td>";
            
            //각 사건에 해당하는 팀 리스트 출력
            $str = "";
            for($j=0; $j<count($team_list[$i]); $j++){
                $str .= $team_list[$i][$j]['Unit']." ".$team_list[$i][$j]['perid']."\n";
            }
            echo "<td style='text-overflow: ellipsis; overflow: hidden; white-space: nowrap;'>";
            echo "<span class='tooltip' title='".$str."'>".$str."</span>";
            echo "</td>";
            
            
            #경찰관 일경우 -> 사건을 맡고 있는 팀인지 확인
            $check = false;
            if($role=="Police") {
                
                if($progress_s[$i] != "수사완료") {
                    
                    for($k=0; $k<count($team_list[$i]); $k++) {
                        if($teamId == $team_list[$i][$k]['team_id']){
                            $check = true;
                            break;
                        }
                    }
                    if($check == true) { #사건을 맡은 팀인경우
                        if(is_null($applicant_ids[$i])) {
                            echo "<td>";
                            echo "<form method = 'get' , action = 'Incident_AddApplicant.php'>";
                            echo "<input type = 'text' name = 'incident_id' value ='".$incident_ids[$i]."' hidden>";
                            echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";
                            echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";
                            echo "<button type = 'submit'> 신고자 등록 </button>";
                            echo "</form>";
                            echo "</td>";
                        }
                        echo "<td>";
                        echo "<form method = 'get' , action = 'Incident_AddSuspect.php'>";
                        echo "<input type = 'text' name = 'incident_id' value ='".$incident_ids[$i]."' hidden>";
                        echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";
                        echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";
                        echo "<button type = 'submit'> 가해자 추가 </button>";
                        echo "</form>";
                        echo "</td>";

                        echo "<td>";
                        echo "<form method = 'get' , action = 'Incident_AddVictim.php'>";
                        echo "<input type = 'text' name = 'incident_id' value ='".$incident_ids[$i]."' hidden>";
                        echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";
                        echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";
                        echo "<button type = 'submit'> 피해자 추가 </button>";
                        echo "</form>";
                        echo "</td>";

                        echo "<td>";
                        echo "<form method = 'get' , action = 'Incident_AddReport.php'>";
                        echo "<input type = 'text' name = 'incident_id' value ='".$incident_ids[$i]."' hidden>";
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
                if($progress_s[$i] !="수사완료") {
                    echo "<td>";
                    echo "<form method = 'get' , action = 'Incident_team_add2.php?'>";
                    echo "<input type = 'text' name = 'incident_id' value ='".$incident_ids[$i]."' hidden>";
                    echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";

                    $teamId = "none";
                    echo "<input type = 'text' name = 'teamId' value ='".$teamId."'
                    hidden>";

                    echo "<button type = 'submit'> 팀 추가 </button>";
                    echo "</form>";
                }
                
            }
            
            echo "</tr>";
        }
    ?>

</body>

</html>
