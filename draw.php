<?php
$con = mysql_connect("localhost","root","kwr");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("se", $con);

$ca = $_POST["ca"];
$am = $_POST["am"];
$pw = $_POST["pw"];

$result = mysql_query("SELECT * FROM capitalrepo WHERE aid = '$ca'");  
$row = mysql_fetch_array($result);
if($row['passwd'] == $pw) {
	if($row['active'] == 1) {
		$capital = $row['capital'] - $am;
		if($capital < 0) {
			echo "<script>alert('余额不足');</script>";
			exit;
		}
		else {
			$sql = "UPDATE capitalrepo SET capital='$capital' WHERE aid = '$ca'";
	        if (!mysql_query($sql,$con)) {
	            die('Error: ' . mysql_error());
	        }
			echo "<script>alert('资金取出成功');</script>";
			exit;
		}
	}
	else {
		echo "<script>alert('该账户已被冻结');</script>";
		exit;
	}
}
else {
	echo "<script>alert('密码错误');</script>";
}
?>