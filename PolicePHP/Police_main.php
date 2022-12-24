<?php
$con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com",
                      "admin", "rnqhstlr123!", "PoliceDB") or dir("MySQL 접속 실패!!");

$role = $_GET["role"];
$teamId = $_GET["teamId"];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<hr width = "100%" color = "#FFD966" size = "60">

    
<form method = "GET", action = "/PolicePHP/home.php" style="width:25%;float:left;">
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
<input type = "submit" value = "사건 조회">
</form>
    
<form method = "GET", action = "/PolicePHP/Police_main.php" style="width:25%;float:left;">
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>    
<input type = "submit" value = "경찰관 관리">
</form>

<form method = "GET", action = "/PolicePHP/incidentAdd1.php" style="width:25%;float:left;">
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
<input type = "submit" value = "사건 등록">
</form>

<form method = "GET", action = "/PolicePHP/statistics1.php" style="width:25%;float:left;">
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>   
<input type = "submit" value = "통계">
</form>

<br>
<hr width = "100%" color = "#FFD966" size = "10">

<br>
<a href = "/PolicePHP/Police_add.php" > &nbsp;&nbsp; 경찰관 등록 &nbsp;&nbsp;</a><!--등록 페이지로 이동-->
<br>

<hr width = "100%" color = "#FFD966" size = "3">

<h2 style="color:#176CB9 ">경찰관 조회</h2>

<form method="get" action="/PolicePHP/Police_search.php">
    <!--전달받은 것들 -->
    <input type = "text" name = "role" value=<?php echo $role?> hidden/>
    <input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
    
<label for="">서</label>
<select name="s_name">
    <option value='null'>선택</option>
    <option value="동구경찰서">동구경찰서</option>
    <option value="서구경찰서">서구경찰서</option>
    <option value="중구경찰서">중구경찰서</option>
    <option value="북구경찰서">북구경찰서</option>
    <option value="남구경찰서">남구경찰서</option>
    <option value="수성구경찰서">수성구경찰서</option>
</select>

<label for="">부서</label>
<select name="d_name">
    <option value= 'null'>선택</option>
    <option value="형사과">형사과</option>
    <option value="수사과">수사과</option>
    <option value="교통과">교통과</option>
    <option value="여성청소년과">여성청소년과</option>
</select>

<label for="">팀</label>
<select name="t_name">
    <option value='null'>선택</option>
    <option value="1팀">1팀</option>
    <option value="2팀">2팀</option>
    <option value="3팀">3팀</option>
</select>

      이름<input type="search" name="name"/> 
      <input type="submit" value="검색"/>
</form> 

</body>
</html>