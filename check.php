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
$capital = $row['capital'];
$frozen = $row['frozen'];

$data = array (
    'frozen' => $frozen 
    'unfrozen' => $capital 
);

echo $data;

?>
