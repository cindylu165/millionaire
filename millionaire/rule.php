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
<title>規則說明-大樂透</title>
<style type="text/css">
body {
	background-color: #e8eaf6;
}
#rule {
    width:600px;
    height:350px;
    margin: auto;
    border: 3px double gray;
    background-color: ghostwhite;
}
#start {
width: 120px;
height: 60px;
font-size:24px;
font-family:'華康秀風體';
/* font-family: 微軟正黑體; */
border: 3px normal;
background-color: ivory;
}
</style>
</head>

<body>
<h1 align="center" style="font-family:'華康秀風體';">下注規則</h1>
<hr />
<div id = "rule" align="center">
基本玩法 :<br>
大樂透是一種樂透型遊戲。您必須從01~43中選1個號碼進行投注。開獎時，開獎單位將隨機開出一個號碼，該號碼就是該期大樂透的中獎號碼，也稱為「獎號」。在即將開獎前會通知您點選「參加開獎」，若您的選號如果有對中當期開出之號碼，即為中獎，並可依規定兌領獎金。</br>

投注方式 : <br>
每個大樂透表單上都有號碼、金額可以選擇並輸入，每個選號區都設有43個號碼(01~43)，您可以依照自己的喜好，進行投注。
在按下投注前，輸入自己的一組特殊金鑰(注意!該金鑰不要外漏給他人知道)，按下投注，便下注成功。<br>

售價 :<br>
大樂透每注售價為新臺幣50元的倍數起跳<br>
下注週期: <br>
一周分兩個周期，星期一到星期三為第一期下注時間，星期四到星期六為第二期下注時間
星期四為第一期公布時間，星期日為第二期公布時間

獎金分配方式 : <br>
當期總投注金額(銷售收入)乘以總獎金支出率即為當期『總獎金』，本遊戲之總獎金支出=80%。
獎金為(總獎金/中獎人數)，四捨五入計算。
</div><br>
<div id = "btns" align="center">
<a href='betForm.php?account=<?php echo $account ?>'>
<button id = "start" onclick="location.href='betForm.php'">Start</button> </a>
</div>

</body>
</head>