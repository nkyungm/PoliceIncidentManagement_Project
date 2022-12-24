<?php
//DB 연결
    $db_host="policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com" ; 
    $db_user="admin";
    $db_password="rnqhstlr123!";
    $db_name="PoliceDB";
    $con=mysqli_connect($db_host,$db_user,$db_password,$db_name) or die("MySQL 접속 실패!!");

    $role = "Polic"; //role 변수
    $teamId = 1; //team_id 변수
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>

<hr width = "100%" color = "#FFD966" size = "60">
<h2>  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;  경찰관 등록 &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; </h2>

<hr width = "100%" color = "#FFD966" size = "10">


<form method = "post", action = "/PolicePHP/police_add_end.php">
    <input type = "text" name = "role" value=<?php echo $role?> hidden/>
    <input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/>
<table  border="1" bordercolor="black" width ="40%" height="50" table-layout:fixed;>
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
                <td>    <select name="t_name" size = "1">
        <option value = "1팀" selected>1팀</option>
        <option value = "2팀" selected>2팀</option>
        <option value = "3팀" selected>3팀</option>
    </select>
</td>
            </tr>
            <tr>
                <th>이름</th>
                <td><input type = "text" name = "name" required/></td>
            </tr> 
            <tr>
                <th>ID</th>
                <td><input type = "text" name = "id" required/></td>
            </tr>
            <tr>
                <th>비밀번호</th>
                <td><input type = "password" name = "pw" required/></td>
            </tr>
            <tr>
                <th>생년월일</th>
                <td><input type="date" name = "end_date" min = "1950-01-01" placeholder="ex)2020-10-20" required/></td>
            </tr>
            <tr>
                <th>성별</th>
                <td><input type = "radio" name = "gender" value ="1" ondblclick="this.checked=false" required/> 남성
                    <input type = "radio" name = "gender" vaule = "2" ondblclick="this.checked=false"/> 여성</td>
            </tr> 
            <tr>
                <th>전화번호</th>
                <td><input type = "tel" name = "phone" placeholder= "123-1234-1234" pattern="[0-9]{2,3}-[0-9]{3,4}-{0-9}{4}" required/></td>
            </tr>
            <tr>
                <th>직급</th>
                <td>        
<select name="rank" size = "1" required>
            <option value = "경장" selected>경장</option>
            <option value = "경사" selected>경사</option>
            <option value = "순경" selected>순경</option>
            <option value = "총경" selected>총경</option>
        </select><br></td>
            </tr>
            <tr>
                <th>주소</th>
                <td><input type = "text" name = "address" placeholder = "북구 123로 12 상세주소" required/></td>
            </tr>

</table>
  <hr>
   <input type = "submit" value = "등록하기">
</form>

</body>
</html>