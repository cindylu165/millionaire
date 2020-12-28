<?php
require("dbconnect.php");
$account = $_GET['account'];
$id = $_GET['id'];
$period = $_GET['period'];
$sql = "update record set status=1 where id=$id;";
$sql_2 = "update lottery_list set joincount=joincount+1 where period=$period;";
mysqli_query($conn, $sql) or die("update record failed, SQL query error"); //執行SQL
mysqli_query($conn, $sql_2) or die("update lottery failed, SQL query error");

header("Location: joinForm.php?account=$account");
?>