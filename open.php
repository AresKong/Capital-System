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
/*
function requestPost($url = '', $param = '') {
    if (empty($url) || empty($param)) {
        return false;
    }
    
    $postUrl = $url;
    $curlPost = $param;
    $ch = curl_init();  //初始化curl
    curl_setopt($ch, CURLOPT_URL,$postUrl); //抓取指定网页
    curl_setopt($ch, CURLOPT_HEADER, 0);    //设置header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    //要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_POST, 1);  //post提交方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    $res = curl_exec($ch); //运行curl
    curl_close($ch);
    
    return $res;
}

$url = '/stock/account';
$data = array (
    'token' => $sid 
);
$result = requestPost($url, $data);
$state = json_decode($result);
$status = $state->state;       

if($status == 'error') {
    //echo "<script>alert('该证券账户不存在，无法注册');</script>";
    echo "<script>alert(".$state->info.");</script>";
    exit;
}
*/
if(empty($row)) {
	$sql = "INSERT INTO capitalaccount (aid, password, sid, tpassword) VALUES ('$aid', '$spw', '$sid', '$tpw')";
    if (!mysql_query($sql,$con)) {
        die('Error: ' . mysql_error());
    }
    $sql = "INSERT INTO capitalrepo (aid, passwd, capital, frozen) VALUES ('$aid', '$spw', '0', '0')";
    if (!mysql_query($sql,$con)) {
        die('Error: ' . mysql_error());
    } 
	echo "<script>alert('开户成功');</script>";
}
else {
	echo "<script>alert('该身份证已绑定了资金账号');</script>";
}
?>

