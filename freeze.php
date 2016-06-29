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
$capital = $row['capital'] - $amount;
if($capital < 0) {
	echo "<script>alert('冻结的资金大于账户余额');</script>";
	exit;
}
$frozen = $row['frozen'] + $amount;

$sql = "UPDATE capitalrepo SET capital='$capital', frozen='$frozen' WHERE aid = '$aid'";
if (!mysql_query($sql,$con)) {
    die('Error: ' . mysql_error());
}
echo "<script>alert('账户 $aid 冻结资金 $amount 成功');</script>";
exit;
?>
