<?php
$con = mysql_connect("localhost","root","kwr");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("se", $con);

$aid = $_POST["aid"];
$sid = $_POST["sid"];
$pw = $_POST["pw"];

$result = mysql_query("SELECT * FROM capitalrepo WHERE aid = '$aid'");  
$row = mysql_fetch_array($result);
if($row['passwd'] == $pw) {
	if($row['capital'] > 0 || $row['frozen'] > 0) {
		echo "<script>alert('销户失败，有未取出资金');</script>";
		exit;
	}
	else {
		$sql = "DELETE FROM capitalrepo WHERE aid='$aid'";
        if (!mysql_query($sql,$con)) {
            die('Error: ' . mysql_error());
        }
        $sql = "DELETE FROM capitalaccount WHERE aid='$aid'";
        if (!mysql_query($sql,$con)) {
            die('Error: ' . mysql_error());
        }
		echo "<script>alert('销户成功');</script>";
		exit;
	}
}
else {
	echo "<script>alert('账户不存在/密码错误');</script>";
}
?>

