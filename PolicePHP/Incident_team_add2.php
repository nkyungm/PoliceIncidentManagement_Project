<?php
$con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com",
                      "admin", "rnqhstlr123!", "PoliceDB") or dir("MySQL 접속 실패!!");

$incident_id = $_GET["incident_id"];//incident_id 받아옴
$role = $_GET["role"];
$teamId = $_GET["teamId"];

?>

<html>
<head>
<meta charset="utf-8">
</head>
    
<body>
<hr width = "100%" color = "#FFD966" size = "60">
<h3> 사건 팀 추가 &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; </h3>

<hr width = "100%" color = "#FFD966" size = "10">
<br>


   <form method = "POST", action = "/PolicePHP/Incident_addEnd.php">

<table border="1" bordercolor="black" width ="40%" height="50" table-layout:fixed;>

        <!--앞에서 전달받은 것들-->
        <input type = "text" name = "incident_id" value=<?php echo $incident_id?>  hidden/>
        <input type = "text" name = "role" value=<?php echo $role?> hidden/>
        <input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
    
        <tr>
            <th>서</th>
        <td>
                                                            
        <select name="s_name" size = "1">
        <option value = "동구경찰서" selected>동구경찰서</option>
        <option value = "남구경찰서" selected>남구경찰서</option>
        <option value = "서구경찰서" selected>서구경찰서</option>
        <option value = "북구경찰서" selected>북구경찰서</option>
        <option value = "중구경찰서" selected>중구경찰서</option>
        <option value = "수성구경찰서" selected>수성구경찰서</option>
        </select>
        </td>
        </tr>
    
        <tr>
            <th>부서</th>
        <td>
        <select name="d_name" size = "1">
        <option value = "수사과" selected>수사과</option>
        <option value = "형사과" selected>형사과</option>
        <option value = "교통과" selected>교통과</option>
        <option value = "여성 청소년과" selected>여성 청소년과</option>
        </select>
        </td>
        </tr>
    
        <tr>
            <th>팀</th>
        <td>    
        <select name="t_name" size = "1">
        <option value = "1팀" selected>1팀</option>
        <option value = "2팀" selected>2팀</option>
        <option value = "3팀" selected>3팀</option>
        </select>
        </td>
        </tr>
    
        <tr>
            <th>시작일시</th>
        <td><input type="datetime" name = "start" min = "2010-01-01" placeholder="ex)2020-10-20 13:00:00" required/></td>
        </tr>
    
        <tr>
            <th>종료일시</th>
        <td><input type="datetime" name = "end" min = "2010-01-01" placeholder="ex)2020-10-20 13:00:00" required/></td>
        </tr>
    
</table>

<input type = "submit" value = "등록하기">
</form>

<br>
</body>
</html>

