<?php
if(!isset($_POST['token'])){
	exit;
}

echo "<script>alert('error:000');</script>";

$con = mysql_connect("localhost","root","kwr");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("se", $con);

$sid = $_POST["token"];
echo "<script>alert('$sid');</script>";

echo "<script>alert('error:001');</script>";
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
echo "<script>alert('error:222');</script>";
if(empty($_POST['token'])){
    echo "<script>alert('error:022');</script>";
}
if(empty($sid)){
    echo "<script>alert('error:022');</script>";
}

$url = 'https://se.clarkok.com/stock/account';
$data = $sid;

echo "<script>alert('error:002-1');</script>";
$result = requestPost($url, $data);
echo "<script>alert('$result');</script>";

echo "<script>alert('error:002-11');</script>";
$states = json_decode($result);
echo "<script>alert('error:002-12');</script>";
$status = $states->state;       
echo "<script>alert('error:002-2');</script>";
if($status == 'error') {
    //echo "<script>alert('该证券账户不存在，无法注册');</script>";
    echo "<script>alert(".$state->info.");</script>";
    exit;
}
echo "<script>alert('error:002-3');</script>";
$sid = $states->account;

echo "<script>alert('error:003');</script>";

$result = mysql_query("SELECT * FROM capitalrepo WHERE sid = '$sid'");  
$row = mysql_fetch_array($result);
$capital = $row['capital'];
$frozen = $row['frozen'];

$data = array (
    'frozen' => $frozen,
    'unfrozen' => $capital
);

$output_data = json_encode($data);
echo $output_data;

echo "<script>alert('error:004');</script>";

?>
