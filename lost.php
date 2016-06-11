<?php
$con = mysql_connect("localhost","root","kwr");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("se", $con);

$id = $_POST["id"];
$sa = $_POST["sa"];

$aid = implode(array_reverse(str_split($id)));
$result = mysql_query("SELECT * FROM capitalaccount WHERE aid = '$aid'");  
$row = mysql_fetch_array($result);
if($row['sid'] == $sa) {
	$sql = "UPDATE capitalaccount SET active='0' WHERE aid = '$aid'";
    if (!mysql_query($sql,$con)) {
        die('Error: ' . mysql_error());
    }
    $result = mysql_query("SELECT * FROM capitalrepo WHERE aid = '$aid'");  
	$row = mysql_fetch_array($result);
	$capital = $row['capital'];
	$sql = "UPDATE capitalrepo SET active='0', capital='0', frozen='$capital' WHERE aid = '$aid'";
    if (!mysql_query($sql,$con)) {
        die('Error: ' . mysql_error());
    }
	echo "<script>alert('资金账户 $aid 冻结成功');</script>";
	exit;
}
else {
	echo "<script>alert('该账户不存在');</script>";
}
?>

