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
	echo "<script>alert('余额不足');</script>";
	exit;
}

$sql = "UPDATE capitalrepo SET capital='$capital' WHERE aid = '$aid'";
if (!mysql_query($sql,$con)) {
    die('Error: ' . mysql_error());
}
echo "<script>alert('取出资金成功');</script>";
exit;
?>
