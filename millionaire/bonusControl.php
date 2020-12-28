<?php
    require("dbconnect.php");
    require("lotterModel.php");
    $account = mysqli_real_escape_string($conn,$_POST['account']);
    $lottery_numer = mysqli_real_escape_string($conn,$_POST['lottery_numer']);
    $sql = "SELECT * FROM `record` WHERE `hash_lottery`=$lottery_numer";
    $result = mysqli_query($conn, $sql) or die("Insert failed, SQL query error");
    $rs=mysqli_fetch_assoc($result);
    if(check_lotter($rs['hash_form'])){
      $msg = '兌獎成功';
    }else{
      $msg = '兌獎失敗';
    }
    // header("Location:bonusresult.php?msg=$msg");
?>