<?php
session_start();
require("dbconnect.php");
require("userModel.php");
$uid = $_GET['uid'];
$account = $_POST['account'];
$passWord = $_POST['password'];

if (checkUserIDPwd($account, $passWord)) {
	$_SESSION['account'] = $account;
	header("Location: firstview.php?account=$account");
} else {
	$_SESSION['account']="";
	header("Location: homexx.php");
}
?>
