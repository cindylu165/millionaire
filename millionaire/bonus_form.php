<?php
session_start();
if (! isset($_SESSION['account']) or $_SESSION['account']<="") {
	header("Location: homexx.php");
} 
require("dbconnect.php");
require("lotterModel.php");
$account = $_GET['account'];
$sql = "select * from lottery_list  where now() between startTime and endTime;";
$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
$rs=mysqli_fetch_assoc($result);
$sql_1 = "select * from lottery_list  where period = 6;";//要改
$result_1=mysqli_query($conn,$sql_1) or die("DB Error: Cannot retrieve message.");
$rs_1=mysqli_fetch_assoc($result_1);
// $r = rand(0, 1000);
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
    font-family: 'DFHsiuW3-B5';
}
#bet {
    margin :auto;
    font-family:' DFHsiuW3-B5';
}
</style>
<body>
  <br><br><br><br><br>
<h1 align = "center" style="font-family:DFHsiuW3-B5;font-size:50px">~~兌獎~~</h1>
<table id = bet width="300" border="5">
<!-- <form method="post" action="betControl.php?account=<?php echo $account ?>"> -->
<form method="post">
    <tr><td>下注帳號</td><td><input value=<?php echo $account ?> /></td></tr>
    
    <input name="period" type="hidden" id="period" value="<?php echo $rs['period']?>"/>

    <!-- <tr><td>下注</td> 
            <td><select name="num" id="num"><option>請選擇你要的號碼</option>
            <?php 
            for ($i=1; $i<44; $i++)
                echo '<option value ="', $i, '">', $i, '</option>';
            ?>
            </select>
            </td></tr>

    <tr><td>下注金額</td> <td><input name="price" type="text" id="price" /></td></tr> -->

    <tr><td>本期累積金額</td> <td><?php echo $rs_1['bonus']?></td></tr>
    <tr><td>請輸入你的彩券編號</td> <td><input name="lottery_numer" type="message" id="lottery_numer" /></td></tr>
    <!-- <input name="salt" type="hidden" id="salt" value=<?php echo $r?>/> -->

    <!-- <tr><td align = "center"><input type="submit" name="Submit" value="確認" /></td></tr> -->
    <tr><td align = "center"><button type="submit" name="button1" value="確認" >確認</button></td></tr>

</form>
    <tr><td align = "center">
    <?php
        if (isset($_POST['button1'])){
            // $account = mysqli_real_escape_string($conn,$_POST['account']);
            $lottery_numer = mysqli_real_escape_string($conn,$_POST['lottery_numer']);
            // echo $lottery_numer;
            $sql_lottery_hash = "SELECT * FROM `record` WHERE `hash_lottery`='$lottery_numer'";
            // $sql_lottery_hash = "SELECT * FROM `record` WHERE `hash_lottery`= 232054689587522680482266929363190617770768099341";
            $result_haLottery = mysqli_query($conn, $sql_lottery_hash) or die("Insert failed, SQL query error");
            $rs=mysqli_fetch_assoc($result_haLottery);
            if(check_lotter($rs['hash_lottery'])){
                echo $msg = '兌獎成功';
            }else{
                echo $msg = '兌獎失敗';
            }
        }
    // header("Location:bonusresult.php?msg=$msg");
    ?>
</table>
<div id="contain" style="text-align:center"><br>
<a href='firstview.php?account=<?php echo $account ?>' style="font-size:24px;color:#FFAC55"> HOME </a></div>
</body>
</html>
