<?php
if(isset($_POST['token'])){
    if(!empty($_POST['amount'])){
    	exit;
    }
}

if(!isset($_POST['token'])){
    exit;
}

$con = mysql_connect("localhost","root","kwr");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("se", $con);

$sid = $_POST["token"];
$amount = $_POST["amount"];

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
$states = json_decode($result);
$status = $states->state;       

if($status == 'error') {
    //echo "<script>alert('该证券账户不存在，无法注册');</script>";
    echo "<script>alert(".$state->info.");</script>";
    exit;
}

$sid = $states->account;

$result = mysql_query("SELECT * FROM capitalrepo WHERE sid = '$sid'");  
$row = mysql_fetch_array($result);
$capital = $row['capital'] + $amount;

$sql = "UPDATE capitalrepo SET capital='$capital' WHERE sid = '$sid'";
if (!mysql_query($sql,$con)) {
    die('Error: ' . mysql_error());
}
echo "<script>alert('添加资金成功');</script>";
exit;
?>
