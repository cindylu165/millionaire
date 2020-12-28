<?php
require("dbconnect.php");
$uid=(int)$_GET['uid'];
$name=mysqli_real_escape_string($conn,$_POST['name']);
$account=mysqli_real_escape_string($conn,$_POST['account']);
$password=mysqli_real_escape_string($conn,$_POST['password']);
$phone=mysqli_real_escape_string($conn,$_POST['phone']);
$pubKey=mysqli_real_escape_string($conn,$_POST['pubKey']);
if ($account) { 
    $sql = "insert into user (uid, name, account, password, phone,`public key`) values ('$uid','$name', '$account', '$password', '$phone', '$pubKey');";
    mysqli_query($conn, $sql) or die("Insert failed, SQL query");
} else {
	$msg= "Message stuid cannot be empty";
}
header("Location: homexx.php?uid=$uid");
?>