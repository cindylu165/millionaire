<?php
session_start();
require("lotterModel.php");
//if (! isset($_SESSION['uID']) or $_SESSION['uID']!="boss") {
//	header("Location: loginForm.php");
//} 

//require("todoModel.php");

//$id = (int)$_GET['id'];

$key = gen_key();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>註冊帳號</title>
<style>
body {
	background-color: #e8eaf6;
  font-family: 'DFHsiuW3-B5';
}
#enroll{
  margin :auto;
  font-family: 'DFHsiuW3-B5';
  font-size:28px;
}
</style>
</head>
<body>
<img src="./image/圖片2.png" alt="Flowers in Chania" style="height: 80px;top:15px;right:10px;position: absolute;">
<br><br><br><br>
<div id="contain" style="text-align:center">
<h1>註冊帳號</h1>
<form method="post" action="addaccount.php">
<table id = enroll width="300" border="5">
      <tr><td> name </td><td><input name="name" type="text" id="name" /> </td></tr>
      <tr><td>account </td><td><input name="account" type="text" id="account" /> </td></tr>
      <tr><td>password </td><td><input name="password" type="password" id="password" /> </td></tr>
      <tr><td>phone </td><td><input name="phone" type="text" id="phone" /> </td></tr>
      <tr><td>public_key</td><td><input name="pubKey" type="text" id="pubKey" value='<?php echo strval($key[0][0]);echo',';echo strval($key[0][1]);?>'/> </td></tr>
      <tr><td>private_key</td><td><input name="priKey" type="text" id="priKey" value='<?php echo strval($key[1][0]);echo',';echo strval($key[1][1]);?>'/> </td></tr>
	  
      <td><input type="submit" name="Submit" value="註冊" /></td>
  </table>
	</form>
  <!-- </tr> -->
  <br><br>
  <div style="font-size:24px;font-weight:bolder">
    溫馨提醒 : private_key代表就是你自己的私密金鑰，用來產生自己的數位簽章<br>
    在此遊戲裡，在下注的時候會需要用到，<br>本系統不會儲存您的私鑰<br>務必記好哦!!
  </div>
<a href="homexx.php" style="font-size:24px;color:#FFAC55"> HOME </a>
</div>
</body>
</html>