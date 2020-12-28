<?php
require("dbconnect.php");
require("lotterModel.php");
$account=$_GET['account'];
$period=mysqli_real_escape_string($conn,$_POST['period']);
$num=mysqli_real_escape_string($conn,$_POST['num']);
$price=mysqli_real_escape_string($conn,$_POST['price']);
$salt=mysqli_real_escape_string($conn,$_POST['salt']);
$key=mysqli_real_escape_string($conn,$_POST['key']);
$form_hash = hashForm($account,$period,$num,$price,$salt);//py檔、php function皆已寫好，剩下執行接收變數的函數
// $lotter_hash = hash($form_hash,$num);
if ($key) { //if key is not empty
	// $sql = "insert into record (account,period, num, price, salt) values ('$account', '$period', '$num', '$price', '$salt') ;";
	$sql = "insert into record (account,period, num, price, salt,hash_form,hash_lottery) values ('$account', '$period', '$num', '$price', '$salt','$form_hash[0]','$form_hash[1]') ;";
	$sql_2 = "update lottery_list set bonus='$price'+bonus where period = '$period';";
	mysqli_query($conn, $sql) or die("Insert failed, SQL query error");
	mysqli_query($conn, $sql_2) or die("Update failed, SQL query error");
} else {
	$msg = "key cannot be empty <br>";
}
$sql_3 = "select * from record order by id DESC;";
$result=mysqli_query($conn,$sql_3) or die("DB Error: Cannot retrieve message.");
$rs=mysqli_fetch_assoc($result);
$newID = $rs['id'];
header("Location:betResult.php?account=$account&rid=$newID");
?>