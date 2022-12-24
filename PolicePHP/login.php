<?php

    $con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com",
                      "admin", "rnqhstlr123!", "PoliceDB") or dir("MySQL 접속 실패!!");
    
    $userId = $_POST["user_id"];
    $userPass = $_POST["user_password"];
    
    $sql = "CALL loginProc('".$userId."','".$userPass."')";   

    $ret = mysqli_query($con, $sql);
    $temp = null;

    if($ret) {
        $row = mysqli_fetch_array($ret);
        $role = $row['role'];
        $teamId = $row['team_id'];
    }
    else {
        echo "데이터 조회 실패"."<br><br>";
        echo "실패 원인 :".mysqli_error($con);
        echo "<br> <a href='/PoliceHtml/login.html'> <--로그인 화면</a> ";
        exit();
    }


    if($role == "Police") { #경찰관 페이지
        
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<meta charset='utf-8'>";
        echo "</head>";
        
        echo "<body>";
        echo "<hr width = '100%'' color = '#1369B8' size = '60'>";
        echo "<h3> &nbsp&nbsp&nbsp&nbsp&nbsp사건 조회 </h3>";
        echo "<hr width = '100%'' color = '#1369B8' size = '10'>";
        echo "<br>";

        #form1
        echo "<form method = 'get', action = 'Incident_Search1.php'>";
	    echo "서: <select name = 'station_name' size ='1'>";
        echo "<option value= null > 선택 </option>";
		echo "<option value ='동구경찰서' > 동구경찰서 </option>";
		echo "<option> 중구경찰서 </option>" ;
		echo "<option> 북구경찰서 </option>" ;
		echo "<option> 서구경찰서 </option>"; 
		echo "<option> 수성구경찰서 </option>"; 
		echo "<option> 남구경찰서 </option>"; 
	    echo "</select>";
	
	    echo "부서: <select name = 'department_name' size ='1'>";
        echo "<option value= 'null' > 선택 </option>";
		echo "<option> 형사과 </option>"; 
		echo "<option> 수사과  </option>"; 
		echo "<option> 여성 청소년과 </option>"; 
		echo "<option> 교통과</option>";
	    echo "</select>";

	    echo "팀: <select name = 'team_name' size ='1'>";
        echo "<option value= 'null' > 선택 </option>";
		echo "<option> 1팀 </option>"; 
		echo "<option> 2팀 </option>"; 
		echo "<option> 3팀 </option>"; 
	    echo "</select>";

	    echo "진행도: <select name = 'progress_name' size ='1'>";
        echo "<option value= 'null' > 선택 </option>";
		echo "<option> 배정완료 </option>"; 
		echo "<option> 수사중 </option>" ;
		echo "<option> 수사완료 </option>"; 
		echo "<option> 미제사건 </option>" ;
	    echo "</select>"; 

	    echo "사건종류: <select name = 'type_name' size ='1'>";
        echo "<option value= 'null' > 선택 </option>";
		echo "<option> 살인 </option>"; 
		echo "<option> 폭행 </option>"; 
		echo "<option> 성폭행 </option>"; 
		echo "<option> 음주 </option>"; 
		echo "<option> 절도 </option>"; 
        echo "<option> 사기 </option>"; 
	    echo "</select>"; 

	    echo "주소: <input type = 'search'  name = 'address_name' placeholder = 'ex) 북구 칠곡중앙대로 52길 삼성아파트'/>";
        
        #경찰관 정보 넘겨주는 곳
        echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";
        echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";
	
	    echo "<button type = 'submit'> 검색 </button>"; 
        echo "</form> <br>";

        #form2
        echo "<form method = 'get' , action = 'Incident_Search2.php'>";
	    echo "사건 ID : <input type = 'text', name = 'Incident_id' required/>";
	
        #경찰관 정보 넘겨주는 곳
        echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";
        echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";
        
        echo "<button type = 'submit'> 검색 </button>";
        echo "</form> <br>";

        echo "</body>";
        echo "</html>";
         
    }
    else { #관리자 페이지
        
        $teamId = "none";
        
        echo "<!DOCTYPE html>";
        echo "<html>";
    
        echo "<head>";
        echo "<meta charset='utf-8'>";
        echo "</head>";
        echo "<body>";
        echo "<hr width = '100%'' color = '#FFD966' size = '60'>";

        echo "<form method = 'GET', action = '/PolicePHP/home.php' style='width:25%;float:left;' >";
        echo "<input type = 'text' name = 'role' value='".$role."' hidden/>";
        echo "<input type = 'text' name = 'teamId' value='".$teamId."' hidden/>";
        echo "<input type = 'submit' value = '사건 조회'>";
        echo "</form>";
        
        echo "<form method = 'GET', action = '/PolicePHP/Police_main.php' style='width:25%;float:left;' >";
        echo "<input type = 'text' name = 'role' value='".$role."' hidden/>";
        echo "<input type = 'text' name = 'teamId' value='".$teamId."' hidden/>";
        echo "<input type = 'submit' value = '경찰관 관리'>";
        echo "</form>";
        
        echo "<form method = 'GET', action = '/PolicePHP/incidentAdd1.php' style='width:25%;float:left;' >";
        echo "<input type = 'text' name = 'role' value='".$role."' hidden/>";
        echo "<input type = 'text' name = 'teamId' value='".$teamId."' hidden/>";
        echo "<input type = 'submit' value = '사건 등록'>";
        echo "</form>";
        
        echo "<form method = 'GET', action = '/PolicePHP/statistics1.php' style='width:25%;float:left;' >";
        echo "<input type = 'text' name = 'role' value='".$role."' hidden/>";
        echo "<input type = 'text' name = 'teamId' value='".$teamId."' hidden/>";
        echo "<input type = 'submit' value = '통계'>";
        echo "</form>";


        echo "<hr width = '100%' color = '#FFD966' size = '10'>";
        echo "<br>";
        
        #form1
        echo "<form method='get' action='Incident_Search1.php'>";
        
        echo "서: <select name = 'station_name' size ='1'>";
        echo "<option value= null > 선택 </option>";
		echo "<option value ='동구경찰서' > 동구경찰서 </option>";
		echo "<option> 중구경찰서 </option>" ;
		echo "<option> 북구경찰서 </option>" ;
		echo "<option> 서구경찰서 </option>"; 
		echo "<option> 수성구경찰서 </option>"; 
		echo "<option> 남구경찰서 </option>"; 
	    echo "</select>";

        echo "부서: <select name = 'department_name' size ='1'>";
        echo "<option value= 'null' > 선택 </option>";
		echo "<option> 형사과 </option>"; 
		echo "<option> 수사과  </option>"; 
		echo "<option> 여성 청소년과 </option>"; 
		echo "<option> 교통과</option>";
	    echo "</select>";

        echo "팀: <select name = 'team_name' size ='1'>";
        echo "<option value= 'null' > 선택 </option>";
		echo "<option> 1팀 </option>"; 
		echo "<option> 2팀 </option>"; 
		echo "<option> 3팀 </option>"; 
	    echo "</select>";

        echo "진행도: <select name = 'progress_name' size ='1'>";
        echo "<option value= 'null' > 선택 </option>";
		echo "<option> 배정완료 </option>"; 
		echo "<option> 수사중 </option>" ;
		echo "<option> 수사완료 </option>"; 
		echo "<option> 미제사건 </option>" ;
	    echo "</select>"; 

        echo "사건종류: <select name = 'type_name' size ='1'>";
        echo "<option value= 'null' > 선택 </option>";
		echo "<option> 살인 </option>"; 
		echo "<option> 폭행 </option>"; 
		echo "<option> 성폭행 </option>"; 
		echo "<option> 음주 </option>"; 
		echo "<option> 절도 </option>"; 
        echo "<option> 사기 </option>"; 
	    echo "</select>"; 
        
        echo "주소: <input type = 'search'  name = 'address_name' placeholder = 'ex) 북구 칠곡중앙대로 52길 삼성아파트'/>";
        
        #경찰관 정보 넘겨주는 곳
        echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";
        echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";
	
	    echo "<button type = 'submit'> 검색 </button>"; 
        echo "</form> <br>";

        #form2
        echo "<form method = 'get' , action = 'Incident_Search2.php'>";
	    echo "사건 ID : <input type = 'text', name = 'Incident_id' required/>";
	
        #경찰관 정보 넘겨주는 곳
        echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";
        echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";
        
        echo "<button type = 'submit'> 검색 </button>";
        echo "</form> <br>";

        echo "</body>";
        echo "</html>";
    }


    mysqli_close($con);
    
?>
