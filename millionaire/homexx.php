<?php
    session_start();
    //set the login mark to empty
    $_SESSION['tID'] = "";
    $_SESSION['mode'] = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Translation</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <!-- cs -->
  <link rel="stylesheet" href="./stylesheet/login.css">
  <style type="text/css">
    body {
      background-color:#e8eaf6;
      background-image: url('../image/Image001-1.png');
      background-repeat: no-repeat;
      /* background-image: url('./010-1.jpg'); */

      /* background: #c8e6c9; */
    }

    .container {
      background-image: url('../image/010-1.jpg');
      /* background-position: 1px 50px; */
      background-repeat: no-repeat;
      text-align: center;
      width: 1000px;
      height: 720px;
    }

    #T1 {
      /* top: 1000px; */
      position: absolute;
      /* left: 715px; */
      left: 552px;
      top: 480px;
      font-family: '華康秀風體';

    }

    #log {
      top: 1000px;
      font-size: 2cm;

    }
  </style>
</head>

<body class="">
  <div id="main">
    <div class="container" style="text-align: center;">
      <img src="./image/圖片1.png" alt="Flowers in Chania" style="height: 400px;top:75px;position: relative;">

      <div id="T1" >
        <!-- <button class="button" style="font-family: '華康秀風體';font-size:45px;background-color: grey;color:white">登入</button> -->
        <form id="log" method="post" action="loginCheck.php" style="font-size: 20px;font-weight: bolder;">
          Account : <input type="text" name="account" style="text-align: center;"><br />
          Password : <input type="password" name="password" style="text-align: center;"><br />
          <!-- <input type="submit" value="登入"> -->
          <a><button type="submit" style="font-family: '華康秀風體';">進入</button></a>
        </form>
        <div style="text-align:center;font-size:24px;position: absolute;left: 50px;top: 200px;">
        <a href='getUserPassword.php'>忘記密碼</a>
        |
        <a href='enroll.php?uid=-1'>註冊</a></div>
      </div>


    </div>
  </div>
  <!-- 使用materialize -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <!-- 使用jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- js -->
  <script src="./stylesheet/home.js" type="text/javascript"></script>
</body>

</html>