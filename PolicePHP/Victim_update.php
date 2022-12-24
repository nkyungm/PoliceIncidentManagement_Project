<?php
    $con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com", "admin", "rnqhstlr123!", "PoliceDB") 
    or die("MySQL 접속 실패!!");
    
    $role = $_GET["role"];
    $teamId = $_GET["teamId"];
    $victim_id = $_GET['victim_id'];
    
    $sql = "CALL searchVictim('".$victim_id."')";
    $ret = mysqli_query($con, $sql);
    if($ret) {
            $row = mysqli_fetch_array($ret);
    }
    else {
        echo "피해자 데이터 조회 실패 !!!!"."<br>";
        echo "실패 원인 :".mysqli_error($con);
        exit();
    }

    $name = $row['name'];
    $address = $row['address'];
    $birth = $row['birth'];
    $phone = $row['phone'];
    $gender = $row['gender'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charest="utf-8">
</head>
<body>
<hr width = "100%" color = "#1369B8" size = "60">
<h3> &nbsp&nbsp&nbsp&nbsp&nbsp피해자 정보 수정 </h3>
<hr width = "100%" color = "#1369B8" size = "10">
<br>
<form method = "post">
	이름: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type = "text" name = "name" value = "<?php echo $name; ?>" required > <br>
	주소: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type = "text" name = "address" value = "<?php echo $address ?>"> <br>
	<!-- php 로 생년월일 값 받아오면 변수를 value 값에 대입. 단, 날짜 형식을 맞춰서 해야한다 -->
	생년월일: <input type = "date" name = "birth" min = "1900-01-01" max = "2022-11-28" value = "<?php echo $birth ?>"> <br>
	전화번호: <input type = "tel" name = "phone" value = "<?php echo $phone ?>"
		pattern="[0-9]{2,3}-[0-9]{3,4}-{0-9}{4}"/> <br>
	<!-- php 로 성별 값 받아오면 조건문으로 어떤 성별이 check 되어 나가게 될 지 구성해야한다. -->
    성별: &nbsp;&nbsp;&nbsp;&nbsp;
    <?php 
        if($gender == '남성'){
            echo ' <input type = "radio" name = "gender" checked value = "남성"> 남성
            <input type = "radio" name = "gender" value = "여성"> 여성 <br>';
        }
        else{
            echo '<input type = "radio" name = "gender" value = "남성"> 남성
            <input type = "radio" name = "gender" checked value = "여성"> 여성 <br>';
        }
    ?>
    <br>
    <hr>
    <?php
    echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";
    echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";
    ?>
    <button type = "submit" formaction = "/PolicePHP/Victim_update_result.php?victim_id=<?php echo $victim_id; ?>"> 수정완료</button>

</body>
</html>

