<?php
require_once("dbconnect.php");

function checkUserIDPwd($account, $passWord) {
	global $conn;
$account = mysqli_real_escape_string($conn,$account);
$isValid = false;

$sql = "SELECT password FROM user WHERE account='$account'";
if ($result = mysqli_query($conn,$sql)) {
	if ($row=mysqli_fetch_assoc($result)) {
		if ($row['password'] == $passWord) {
			//keep the user ID in session as a mark of login
			//$_SESSION['uID'] = $row['id'];
			//provide a link to the message list UI
			$isValid = true;
		}
	}
}
return $isValid; 
}

function getUserId($account){
	global $conn;
	$sql="select account from user where account='$account';";
	$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
	return $result;
}

function getUserPwd() {
	global $conn;
	$sql = "select * from user;";
	$result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
	return $result;
}

function setUserPassword($account){
		return false;
}

?>










