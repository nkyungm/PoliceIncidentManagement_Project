<?php 
$con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com",
                      "admin", "rnqhstlr123!", "PoliceDB") or dir("MySQL 접속 실패!!");

$role = $_GET["role"];
$teamId = $_GET["teamId"];
$user_id = $_GET["user_id"];

//프로시저 호출
$sql = "CALL Police_update_delete_Proc('".$user_id."')";
$ret = mysqli_query($con, $sql);

if($ret){
    $count = mysqli_num_rows($ret);
    if($count==0){
        echo $_GET['user_id']."아이디의 회원이 없음!!"."<br>";
        echo "<br> <a href='/PolicePHP/home.php'> <--초기 화면</a> "; 
        exit();
    }
}
else
{
    echo "데이터 조회 실패!!"."<br>";
    echo "실패 원인 :".mysqli_error($con);
    echo "<br> <a href='/PolicePHP/home.php'> <--초기 화면</a> "; 
    exit();
}

$row = mysqli_fetch_array($ret);
$s_name = $row['station'];
$d_name = $row['department'];
$t_name = $row['team'];
$id = $row['user_id'];
$password = $row['password'];
$name = $row['name'];
$birth = $row['birth'];
$phone = $row['phone'];
$rank = $row['rank'];
$address = $row['address'];
$gender = $row['gender'];

?>

<html>
<head>
<meta charset="utf-8">
</head>
<body>

<hr width = "100%" color = "#FFD966" size = "60">

<h2>경찰관 수정/삭제</h2>

<hr width = "100%" color = "#FFD966" size = "10">



<form method = "post", action = "/PolicePHP/Police_update.php">
    
<input type = "text" name = "role" value=<?php echo $role?> hidden/>
<input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/> 

<table  border="1" bordercolor="black" width ="40%" height="50" table-layout:fixed;>
<tr>
    <th>서</th>
<td>
<select name="s_name" size = "1">
    <option value = "동구경찰서" <?php if($s_name =="동구경찰서") echo "SELECTED";?>>동구경찰서</option>
    <option value = "남구경찰서" <?php if($s_name =="남구경찰서") echo "SELECTED";?>>남구경찰서</option>
    <option value = "서구경찰서" <?php if($s_name =="서구경찰서") echo "SELECTED";?>>서구경찰서</option>
    <option value = "북구경찰서" <?php if($s_name =="북구경찰서") echo "SELECTED";?>>북구경찰서</option>
    <option value = "중구경찰서" <?php if($s_name =="중구경찰서") echo "SELECTED";?>>중구경찰서</option>
    <option value = "수성구경찰서" <?php if($s_name =="수성구경찰서") echo "SELECTED";?>>수성구경찰서</option>
</select>
</td>
</tr>
            
<tr>
    <th>부서</th>
<td>
    <select name="d_name" size = "1">
    <option value = "수사과" <?php if($d_name =="수사과") echo "SELECTED";?>>수사과</option>
    <option value = "형사과" <?php if($d_name =="형사과") echo "SELECTED";?>>형사과</option>
    <option value = "교통과" <?php if($d_name =="교통과") echo "SELECTED";?>>교통과</option>
    <option value = "여성청소년과" <?php if($d_name =="여성청소년과") echo "SELECTED";?>>여성청소년과</option>
    </select>
</td>
</tr>
    
<tr>
    <th>팀</th>
<td>           
    <select name="t_name" size = "1">
    <option value = "1팀" <?php if($t_name =="1팀") echo "SELECTED";?>>1팀</option>
    <option value = "2팀" <?php if($t_name =="2팀") echo "SELECTED";?>> 2팀</option>
    <option value = "3팀" <?php if($t_name =="3팀") echo "SELECTED";?>> 3팀</option>
    </select>
</td>
    
</tr>
<tr>
<th>ID</th>
<td><input type = "text" name = "id" value = "<?php echo $id; ?>" required/></td>
</tr>
<tr>
    <th>비밀번호</th>
    <td><input type = "text" name = "password" value = "<?php echo $password; ?>" required /></td>
</tr>
<tr>
    <th>이름</th>
    <td><input type = "text" name = "name" value = "<?php echo $name; ?>" required/></td>
</tr>
<tr>
    <th>생년월일</th>
    <td><input type = "date" name = "birth" min = "1950-01-01" value = "<?php echo $birth ?>" required/></td>
</tr>
            
<tr>
    <th>성별</th>
    <td><input type = "radio" name = "gender" value ="남성" <?php if($gender == "남성") echo "checked";?>> 남성 
    <input type = "radio" name = "gender" value ="여성" <?php if($gender == "여성") echo "checked";?>> 여성 </td>
</tr>

<tr>
    <th>전화번호</th>
        <td><input type = "tel" name = "phone" value = "<?php echo $phone; ?>" pattern="[0-9]{2,3}-[0-9]{3,4}-{0-9}{4}" required/></td>
</tr>
    <tr>
    <th>직급</th>
    <td>        
    <select name="rank" size = "1">
    <option value = "경장" <?php if($rank =="경장") echo "SELECTED";?>>경장</option>
    <option value = "경사" <?php if($rank =="경사") echo "SELECTED";?>>경사</option>
    <option value = "순경" <?php if($rank =="순경") echo "SELECTED";?>>순경</option>
    <option value = "총경" <?php if($rank =="총경") echo "SELECTED";?>>총경</option>
</select><br></td>      
</tr>
<tr>
    <th>주소</th>
    <td><input type = "text" name = "address" value = "<?php echo $address; ?>" required/></td>
</tr>
</table>

  <hr>
   <input type = "submit" value = "수정하기">
</form>


<form method = "post", action = "/PolicePHP/Police_delete.php">
    <input type = "text" name = "role" value=<?php echo $role?> hidden/>
    <input type = "text" name = "teamId" value=<?php echo $teamId?> hidden/> 
    <input type = "text" name = "id" value = "<?php echo $id; ?>" hidden/>
    <input type = "submit" value = "삭제하기">
</form>

</body>
</html>