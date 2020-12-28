<?php
session_start();
if (! isset($_SESSION['account']) or $_SESSION['account']<="") {
	header("Location: loginForm.php");
} 
$account = $_GET['account'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首頁-大樂透</title>
<style type="text/css">
body {
	background-color:#e8eaf6;
}
#bet {
width: 120px;
/* height: 60px; */
font-size:24px;
font-family: 微軟正黑體;
border: 5px double grey;
background-color: ivory;
width:100px;
height:100px;
border-radius: 20% 20% 20% 20%;
}
#join {
width: 120px;
/* height: 60px; */
font-size:24px;
font-family: 微軟正黑體;
border: 5px double grey;
background-color: ivory;
width:100px;
height:100px;
border-radius: 20% 20% 20% 20%;
}
#bonus{
	width: 120px;
	/* height: 60px; */
	font-size:24px;
	font-family: 微軟正黑體;
	border: 5px double grey;
	background-color: ivory;
	width:100px;
	height:100px;
	border-radius: 20% 20% 20% 20%;
}
</style>
</head>

<body>
<div style="text-align:center">
<!-- <img src="./image/圖片6.png" alt="Flowers in Chania" style="height: 500px;top:50px;position: absolute;right:450px;"> -->
<!-- <h1 align="center" font-color="chocolate" style="font-family:'華康秀風體';font-size:100px;right:300px;position: absolute;">Let's Play Lottery</h1> -->
<!-- <h1 align="center" font-color="chocolate" style="font-family:'華康秀風體';font-size:100px;right:240px;position: absolute;">Let's Play Lottery</h1> -->
<img src="./image/圖片9.png" alt="Flowers in Chania" style="height: 180px;top:115px;right:190px;position: absolute;">
<img src="./image/圖片2.png" alt="Flowers in Chania" style="height: 100px;top:15px;right:10px;position: absolute;">
</div>
<br />
<br />
<br />
<br />
<div id = "btns" align="center" style="position: absolute;top:330px;right:515px;">
<a href='rule.php?account=<?php echo $account ?>'>
<button id = "bet" onclick="location.href='rule.php'" style="font-family:'華康秀風體';font-weight:bolder;">下注</button> </a>
<a href='joinForm.php?account=<?php echo $account ?>'>
<button id = "join" style="font-family:'華康秀風體';font-weight:bolder;">參加</button></a>
<a href='bonus_Form.php?account=<?php echo $account ?>'>
<button id = "bonus" style="font-family:'華康秀風體';font-weight:bolder;">兌獎</button></a>
</div>
<?php
//echo "<a href='rule.php'>下注</a><br>";
//echo "<a href='joinForm.php?uid=$uid'>參加</a>";
?>
</body>
</head>