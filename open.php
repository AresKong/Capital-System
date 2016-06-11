<?php
$con = mysql_connect("localhost","root","kwr");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("se", $con);

$aid = $_POST["aid"];
$sid = $_POST["sid"];
$spw = $_POST["spw"];
$tpw = $_POST["tpw"];


$aid = implode(array_reverse(str_split($aid)));
$result = mysql_query("SELECT * FROM capitalaccount WHERE aid = '$aid'");  
$row = mysql_fetch_array($result);
if($sid == '000000000000000000') {
    echo "<script>alert('该证券账户不存在，无法注册');</script>";
    exit;
}
if(empty($row)) {
	$sql = "INSERT INTO capitalaccount (aid, password, sid, tpassword) VALUES ('$aid', '$spw', '$sid', '$tpw')";
    if (!mysql_query($sql,$con)) {
        die('Error: ' . mysql_error());
    }
    $sql = "INSERT INTO capitalrepo (aid, passwd, capital, frozen) VALUES ('$aid', '$spw', '0', '0')";
    if (!mysql_query($sql,$con)) {
        die('Error: ' . mysql_error());
    }
	echo "<script>alert('开户成功，您的资金账户号为 $aid');</script>";
	exit;
}
else {
	echo "<script>alert('该身份证已绑定了资金账号');</script>";
}
?>

