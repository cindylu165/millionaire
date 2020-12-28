<?php
session_start();
//set the login mark to empty
$_SESSION['account'] = "";
?>
<h1 align="center">Login Form</h1><hr />
<table align="center" border="3">
<form method="post" action="loginCheck.php">
<tr><td>Account  </td><td><input type="text" name="account"></td></tr>
<tr><td>Password </td><td><input type="password" name="password"></td><td><input type="submit"></td></tr>
</form>
</table>
<hr>
<div align = center>
<a href='getUserPassword.php'>忘記密碼</a>
<a href='enroll.php?uid=-1'>註冊</a>
</div>