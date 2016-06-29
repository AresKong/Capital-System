<?php
if(!isset($_POST['account'])){
	exit;
}

$con = mysql_connect("localhost","root","kwr");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("se", $con);

$ca = $_POST["account"];
$op = $_POST["orgPasswd"];
$pw = $_POST["newPasswd"];

$result = mysql_query("SELECT * FROM capitalaccount WHERE aid = '$ca'");  
$row = mysql_fetch_array($result);
if($row['password'] == $op) {
	if($row['active'] == 1) {
		$sql = "UPDATE capitalaccount SET password='$pw' WHERE aid = '$ca'";
	    if (!mysql_query($sql,$con)) {
	        die('Error: ' . mysql_error());
	    }
	    $sql = "UPDATE capitalrepo SET passwd='$pw' WHERE aid = '$ca'";
	    if (!mysql_query($sql,$con)) {
	        die('Error: ' . mysql_error());
	    }
		echo "<script>alert('修改密码成功');</script>";
		exit;
	}
	else {
		echo "<script>alert('该账户已被冻结');</script>";
		exit;
	}
}
else {
	echo "<script>alert('原始密码错误');</script>";
}
?>