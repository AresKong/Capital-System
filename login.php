<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</head>
<body id="login">
  <div class="login-logo">
    <a><img src="images/logo.png" alt=""/></a>
  </div>
  <h2 class="form-heading">login</h2>
  <div class="app-cam">
	  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
		<input type="text" class="text" value="用户名" id="username" name="username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '用户名';}">
		<input type="password" value="密码" id="passwd" name="passwd" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '密码';}">
		<div class="submit"><input type="submit" value="登录"></div>
	</form>
  </div>

<?php
$con = mysql_connect("localhost","root","kwr");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("se", $con);
$url = "index.html";
$name = $_POST['username'];
$password = $_POST['passwd'];
if($name == '') {
  exit;
}
else {
  $result = mysql_query("SELECT * FROM user WHERE name = '$name'");  
  $row = mysql_fetch_array($result);
  if($row['passwd'] == $password) {
    echo "<script>alert('登录成功');location.href='$url'</script>";
    exit;
  }
  else {
    echo "<script>alert('账号/密码错误');</script>";
  }
}
?>
</body>
</html>
