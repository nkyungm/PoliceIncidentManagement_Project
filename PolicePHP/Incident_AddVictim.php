<!DOCTYPE html>
<html>
<head>
<meta charest="utf-8">
</head>

<body>
	<hr width = "100%" color = "#1369B8" size = "60">
	<h3> &nbsp&nbsp&nbsp&nbsp&nbsp피해자 정보 등록 </h3>
	<hr width = "100%" color = "#1369B8" size = "10">
	<br>

	<form method = "post">
	<!--앞서 전달받은 사건 ID 전송-->
	<input type = 'text' name = 'role' value = <?php echo $_GET['role'] ?> READONLY hidden>
	<input type = 'text' name = 'teamId' value = <?php echo $_GET['teamId'] ?> READONLY hidden>
    <input type = "text", name = "incident_id" , value=<?php echo $_GET['incident_id'] ?> READONLY hidden >
	이름: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type = "text" name = "name" placeholder = "홍길동" required/> <br>
	주소: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type = "text" name = "address" placeholder = "북구 123로 상세주소"/> <br>
	생년월일: <input type = "date" name = "birth" min = "1900-01-01" max = "2022-11-28"/> <br>
	전화번호: <input type = "tel" name = "phone" placeholder= "123-1234-1234"
		pattern="[0-9]{2,3}-[0-9]{3,4}-{0-9}{4}"/> <br>
	성별: &nbsp;&nbsp;&nbsp;&nbsp; <input type = "radio" name = "gender" value = "남성" required> 남성
								   <input type = "radio" name = "gender" value = "여성" required> 여성 <br>
	
	<hr>
	<button type = "submit" formaction = "/PolicePHP/Victim_Insert_result.php"> 등록하기</button>
</form> 

</body>
</html>