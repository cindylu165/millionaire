<?php
session_start();
if (! isset($_SESSION['account']) or $_SESSION['account']<="") {
	header("Location: homexx.php");
} 
require("dbconnect.php");
$account = $_GET['account'];
$sql = "select * from lottery_list  where now() between startTime and endTime;";
$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
$rs=mysqli_fetch_assoc($result);
$r = rand(0, 1000);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>下注-大樂透</title>
</head>
<style type="text/css">
body {
	background-color: #e8eaf6;
}
#bet {
    margin :auto;
}
</style>
<body>
<h1 align = "center" style="font-family:'DFHsiuW3-B5';">下注表單</h1>
<table id = bet width="300" border="5">
<form method="post" action="betControl.php?account=<?php echo $account ?>">
    <tr><td>下注帳號</td><td><input value=<?php echo $account ?> /></td></tr>
    
    <input name="period" type="hidden" id="period" value="<?php echo $rs['period']?>"/>

    <tr><td>本期下注期間</td> <td> <?php echo $rs['startTime'], " ~ ", $rs['endTime'] ?> </td></tr>

    <tr><td>本期開獎時間</td> <td><?php echo $rs['showDate'] ?></td></tr>

    <tr><td>目前累積獎金</td> <td><?php echo $rs['bonus'] ?></td></tr>

    <tr><td>下注號碼</td> 
            <td><select name="num" id="num"><option>請選擇你要的號碼</option>
            <?php 
            for ($i=1; $i<44; $i++)
                echo '<option value ="', $i, '">', $i, '</option>';
            ?>
            </select>
            </td></tr>

    <tr><td>下注金額</td> <td><input name="price" type="text" id="price" /></td></tr>

    <tr><td>請輸入你的金鑰</td> <td><input name="key" type="message" id="key" /></td></tr>

    <input name="salt" type="hidden" id="salt" value=<?php echo $r?>/>

    <tr><td align = "center"><input type="submit" name="Submit" value="確認下注" /></td></tr>

</form>

</table>
<div id="contain" style="text-align:center"><br>
<a href='firstview.php?account=<?php echo $account ?>' style="font-size:24px;color:#FFAC55;
    font-family: 'DFHsiuW3-B5';"> HOME </a></div>
</body>
</html>
