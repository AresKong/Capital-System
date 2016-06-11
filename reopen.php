<?php
$con = mysql_connect("localhost","root","kwr");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("se", $con);

$nca = $_POST["nca"];
$oca = $_POST["oca"];

$result = mysql_query("SELECT * FROM capitalrepo WHERE aid = '$oca'");  
$row = mysql_fetch_array($result);
if(!empty($row)) {
	if($row['active'] == 0) {
		$frozen = $row['frozen'];
		$result = mysql_query("SELECT * FROM capitalrepo WHERE aid = '$nca'");  
		$row = mysql_fetch_array($result);
		if(!empty($row)) {
			$capital = $row['capital'] + $frozen;
			$sql = "UPDATE capitalrepo SET capital='$capital' WHERE aid = '$nca'";
	    	if (!mysql_query($sql,$con)) {
	        	die('Error: ' . mysql_error());
	    	}
	    	$sql = "DELETE FROM capitalrepo WHERE aid='$oca'";
	        if (!mysql_query($sql,$con)) {
	            die('Error: ' . mysql_error());
	        }
	        $sql = "DELETE FROM capitalaccount WHERE aid='$oca'";
	        if (!mysql_query($sql,$con)) {
	            die('Error: ' . mysql_error());
	        }
	        echo "<script>alert('原账户资金已转入新账户');</script>";
		}
		else {
			echo "<script>alert('新账户不存在');</script>";
			exit;
		}
	}
	else {
		echo "<script>alert('原账户并未被冻结');</script>";
	}
}
else {
	echo "<script>alert('原账户不存在');</script>";
}
?>

