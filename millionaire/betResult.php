<?php
session_start();
if (! isset($_SESSION['account']) or $_SESSION['account']<="") {
	header("Location: homexx.php");
} 
require("dbconnect.php");
require("lotterModel.php");
$account=$_GET['account'];
$newID = $_GET['rid'];
$sql = "select record.period, lottery_list.ShowDate, lottery_list.bonus, record.num, record.price,record.hash_lottery from record, lottery_list where record.id = $newID and lottery_list.period = record.period;";

$sql_forPubK = "SELECT `public key` FROM `user` where account = '$account';";
$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
$result_forPubK = mysqli_query($conn,$sql_forPubK) or die("DB Error: Cannot retrieve message.");
$rs=mysqli_fetch_assoc($result);
$rs_forPubK = mysqli_fetch_assoc($result_forPubK);
echo $newID;
// echo $rs['hash_lottery'];
// $bonus_num = ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>lottery</title>
    <style>
    body {
        background-color: #e8eaf6;
        font-family: 'DFHsiuW3-B5';
    }
    </style>
</head>
<body>
<div id="contain" style="text-align:center;font-family: 華康秀風體;">
<h1>下注結果</h1>
<table id = bet width="300" border="5" style="font-size:24px;margin :auto;">
    <tr><td>下注編號</td><td> <?php echo $newID ?></td>

    <tr><td>下注帳號</td><td> <?php echo $account ?></td>

    <tr><td>期數 </td><td><?php echo $rs['period']?></tr>
    
    <tr><td>開獎時間</td><td> <?php echo $rs['ShowDate']?></td></tr>

    <tr><td>目前累積獎金 </td><td><?php echo $rs['bonus']?></td></tr>

    <tr><td>下注號碼 </td><td> <?php echo $rs['num'] ?></td></br>

    <tr><td>下注金額 </td><td><?php echo $rs['price'] ?></td></tr>

    <tr><td>加密後兌獎編號 </td><td>
        <?php 
        $h_value = ser_encrypt($rs['hash_lottery'],$rs_forPubK['public key']); 
        echo $h_value;
        ?></td></tr></br>
        
        
        <form method = "post">
        <tr><td>請輸入你的金鑰</td> <td><input name="pri_key" type="message" id="pri_key" /></br>
        <button type="submit" name = "button1" class="button" value = "確定">確定</button>
        </form>
    
        <!-- <button onclick="showWorkList()">Click me</button> -->
        </td></tr></br>
        <tr><td>解密後的兌獎編號 </td><td>
            <?php 
                if (isset($_POST['button1'])){
                    // echo 'button1';
                    $h_value = cli_decrypt($h_value,$_POST['pri_key']); 
                    echo $h_value;
                
                }
            ?> </td></tr>
        

    
</table>
<br>
        <div id="diffList">
            
        </div>
<div id="contain" style="text-align:center"><br>
<a href='firstview.php?account=<?php echo $account ?>' style="font-size:24px;color:#FFAC55"> HOME </a></div>
</body>
</html>
