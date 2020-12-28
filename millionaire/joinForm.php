<?php
session_start();
if (! isset($_SESSION['account']) or $_SESSION['account']<="") {
	header("Location: loginForm.php");
} 
require("dbconnect.php");
$account = $_GET['account'];
$sql = "select * from user,record where user.account = record.account and user.account='$account';";
$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>參加開獎-大樂透</title>
<style type="text/css">
body {
	background-color: gainsboro;
}
#CONFIRM {
display:none;
background-color:silver;
width: 400px;
height: 200px;
position: absolute;
top: 50%;
left: 50%;
margin: -150px 0 0 -250px;
border:3px double snow;
}
#sure2 {
width:60px;
height:30px;
font-size:16px;
background-color:grey;
border-radius:12px;
margin:80px 0 0 120px;
border:2px double gray;
}
#cancel2 {
width:60px;
height:30px;
font-size:16px;
background-color:grey;
border-radius:12px;
margin:80px 0 0 50px;
border:2px double gray;
}
#home {
    width:80px;
    height:30px;
    background-color:silver;
    font-size:26px;
}
</style>
<script type="text/javascript"> 
function updatestate(id, account, period) {
    console.log(id);
    ans = confirm('你確定要參加嗎');
    if(ans) {
        location.href = `update.php?id=${id}&account=${account}&period=${period}`
    }
}

function $(id) {
   return document.getElementById(id);
}
</script>
</head>

<body>
<h1 align="center">參加遊戲</h1>
<hr />
<table width="500" border="1" align="center">
<tr>
    <td>彩券編號</td>
    <td>下注帳號</td>
    <td>下注週期</td>
    <td>下注金額</td>
    <td>下注號碼</td>
    <td>status</td>
	<td>確認參加</td>
</tr>
<?php
while (	$rs=mysqli_fetch_assoc($result)) {

    echo "<tr><td>" . $rs['id'] . "</td>";
	echo "<td>" . $rs['account'] . "</td>";
	echo "<td>{$rs['period']}</td>";
    echo "<td>" , htmlspecialchars($rs['price']), "</td>";
    echo "<td>{$rs['num']}</td>" ;
    echo "<td> {$rs['status']}</td>";
    echo "<td><input type='button' id={$rs['id']} value='參加' onclick='updatestate(" . $rs['id'] . ",\"".$rs['account']."\",".$rs['period'].")'></td>";
}
//header("Location: firstview.php?account=$account");
?>
<div id= "home">
<a href="firstview.php?account=<?php echo $account?>"> HOME </a>
</div>
</table>
</body>
</head>