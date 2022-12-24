<!DOCTYPE html>
<html>
<head>
<meta charest="utf-8">
</head>

<body>
	<hr width = "100%" color = "#1369B8" size = "60">
	<h3> &nbsp&nbsp&nbsp&nbsp&nbsp수사 보고서 작성 </h3>
	<hr width = "100%" color = "#1369B8" size = "10">
	<br>

	<form method = "post">
	<input type = "text", name = "incident_id" , value=<?php echo $_GET['incident_id'] ?> READONLY hidden >
    <input type = "text", name = "teamId" , value=<?php echo $_GET['teamId'] ?> READONLY hidden >
    <input type = 'text' name = 'role' value = <?php echo $_GET['role'] ?> READONLY hidden>
	
	제목: <br> 
        <input type = "text" name = "title" placeholder = "제목을 입력하세요" required/> <br>
    
    <p> 수사 내용: <br>
        <textarea required name = "content" cols = "150" rows = "20"></textarea>
    </p>

	<hr>
    <button type = "submit" formaction = "/PolicePHP/Report_Insert_result.php"> 등록하기</button>
</form>
</body>
</html>