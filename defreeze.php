<?php
if(isset($_POST['account'])){
    if(!empty($_POST['amount'])){

    }
}

$con = mysql_connect("localhost","root","kwr");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("se", $con);

$aid = $_POST["account"];
$amount = $_POST["amount"];

$result = mysql_query("SELECT * FROM capitalrepo WHERE aid = '$aid'");  
$row = mysql_fetch_array($result);
$frozen = $row['frozen'] - $amount;
if($frozen < 0) {
	echo "<script>alert('解冻结的资金大于冻结资金总量');</script>";
	exit;
}
$capital = $row['capital'] + $amount;

$sql = "UPDATE capitalrepo SET capital='$capital', frozen='$frozen' WHERE aid = '$aid'";
if (!mysql_query($sql,$con)) {
    die('Error: ' . mysql_error());
}
echo "<script>alert('账户 $aid 解冻资金 $amount 成功');</script>";
exit;
?>
