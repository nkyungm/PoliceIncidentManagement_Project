<?php
    $con = mysqli_connect("policedb.cg9boi0b9viu.ap-northeast-2.rds.amazonaws.com", "admin", "rnqhstlr123!", "PoliceDB") 
    or die("MySQL 접속 실패!!");
    
    $role = $_GET["role"];
    $teamId = $_GET["teamId"];
    $report_id = $_GET['report_id'];

    $sql = "CALL searchReport('".$report_id."')";
    $ret = mysqli_query($con, $sql);
    if($ret) {
            $row = mysqli_fetch_array($ret);
    }
    else {
        echo "보고서 데이터 조회 실패 !!!!"."<br>";
        echo "실패 원인 :".mysqli_error($con);
        exit();
    }

    $title = $row['title'];
    $content = $row['content'];
    $re_date = $row['re_date'];
    $writer = $row['writer'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charest="utf-8">
</head>
<body>
	<hr width = "100%" color = "#1369B8" size = "60">
	<h3> &nbsp&nbsp&nbsp&nbsp&nbsp수사 보고서 수정 페이지 </h3>
	<hr width = "100%" color = "#1369B8" size = "10">
	<br>

<form method = "post">
    작성자: <br>
    <input type = "text" name = "writer" value = "<?php echo $writer; ?>" READONLY> <br>
	작성일: <br>
    <input type = "datetime-local" name = "re_date" value = "<?php echo $re_date ?>" READONLY> <br>
	제목: <br>
    <input type = "text" name = "title" value = "<?php echo $title ?>" required/> <br>
    <p> 수사 내용: <br>
        <textarea required name = "content" cols = "150" rows = "20"> <?php echo $content; ?></textarea>
    </p>

    <hr>
    <?php
    echo "<input type = 'text' name = 'role' value ='".$role."' hidden>";
    echo "<input type = 'text' name = 'teamId' value ='".$teamId."' hidden>";
    ?>
    <button type = "submit" formaction = "/PolicePHP/Report_update_result.php?report_id=<?php echo $report_id; ?>>"> 수정완료</button>
</form>
</body>
</html>

