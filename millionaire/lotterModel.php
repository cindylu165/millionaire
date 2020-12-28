<?php
require("dbconnect.php");
function getlotteLIst(){
    global $conn;
    $sql = "SELECT encryptdata.periodID, encryptdata.sign from encryptdata,periodhash where encryptdata.periodID = periodhash.pID AND TIMESTAMPDIFF(DAY, encryptdata.time, periodhash.time) <= 3 ;";
    $result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
    // $rs=mysqli_fetch_assoc($result);
    return $result;
}

function setNum($hash_data){ // 設定中獎號碼
    global $conn;
    $num = shell_exec("C:\Users\cindy\AppData\Local\Programs\Python\Python37\python.exe  D:\\xampp\\htdocs\\資安實作\\實作_python_code_orignal\\實作_python_code\\RSA.py $hash_data");
    $num = json_decode($num);
    // echo var_dump($num);
    $sql = "UPDATE periodhash SET number = '$num'  where pID = 6";
    mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
    return $num;
}

function gen_key(){
    global $conn;
    $key = shell_exec("C:\Users\cindy\AppData\Local\Programs\Python\Python37\python.exe D:\\資安\\Create_keys.py");
    $key =  json_decode($key);
    // echo '$key:';
    // echo '<br>pub_key<br>';
    // echo strval($key[0][0]);
    // echo ",";
    // echo $key[0][1];
    // echo '<br>pri_key<br>';
    // echo $key[1][0];
    // echo ",";
    // echo $key[1][1];
    // echo 'end_key';
    return $key;
    //echo var_dump($key);
}
function hashForm($account,$period,$num,$price,$salt){
    // 雜湊下注表單，error:hashForm為NULL
    global $conn;
    echo var_dump($price);
    echo var_dump($salt);
    echo $price;
    echo $salt;
    $account = strval($account);
    $period = strval($period);
    $num = strval($num);
    $price = strval($price);
    $salt = strval($salt);
    $hashForm = shell_exec("C:\Users\cindy\AppData\Local\Programs\Python\Python37\python.exe  D:\\xampp\\htdocs\\資安實作\\實作_python_code_orignal\\實作_python_code\\hash.py $account $period $num $price $salt");
    //echo var_dump($hashForm);
    $hashForm = json_decode($hashForm);
    // echo"<br>";
    // echo"hashForm:";
    // echo"<br>";
    // echo var_dump($hashForm);
    $we_need = hashLottery($hashForm,$num);
    return $we_need;
}
function hashLottery($Form_mes,$num){
    // 雜湊下注表單+number，產生彩券編號，error:hashForm為NULL
    global $conn;
    $hashForm_ori = $Form_mes;
    $hashForm_num = shell_exec("C:\Users\cindy\AppData\Local\Programs\Python\Python37\python.exe  D:\\xampp\\htdocs\\資安實作\\實作_python_code_orignal\\實作_python_code\\hash_num.py $hashForm_ori $num");
    // echo"<br>";
    // echo"hashForm:";
    // echo"<br>";
    $hashNum = json_decode($hashForm_num);
    // print($hashForm_num);
    // echo "<br>";
    // print($hashForm_ori);
    $hash_array = Array($hashForm_ori,$hashNum);
    return $hash_array;
}
function check_lotter($hash_lot){
    global $conn;
    $sql = "SELECT `number` FROM periodhash where pID = 6;";
    $rs_num_sql = mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
    $rs_num= mysqli_fetch_assoc($rs_num_sql);
    // echo '$number:<br>';
    // echo $rs_num['number'];
    // echo $hash_lot;
    $sql_hash_form = "SELECT hash_form FROM record where hash_lottery = $hash_lot;";
    $result_hash_form = mysqli_query($conn,$sql_hash_form) or die("DB Error: Cannot retrieve message.");
    $rs_hash_form= mysqli_fetch_assoc($result_hash_form);
    // echo "rs_hash_form:<br>";
    // echo $rs_hash_form['hash_form'];
    $need_this = hashLottery($rs_hash_form['hash_form'],$rs_num['number']);
    $final = FALSE;
    if ($need_this[1] == $hash_lot){
        $final = TRUE;
    } else{
        $final = FALSE;
    }
    return $final;
}
function cli_encrypt($form){// user傳表單資訊給我們
    global $conn;
    $form = strval($form);
    $enc_mes = shell_exec("C:\Users\cindy\AppData\Local\Programs\Python\Python37\python.exe D:\\xampp\\htdocs\\資安實作\\實作_python_code\\實作_python_code\\cli_Encrypt_Rsa.py $form");
    //$enc_mes = ;
    $enc_mes = json_decode($enc_mes);
    // echo $enc_mes;
    //print_r($out);
    return $enc_mes;
    //echo var_dump($key);
    
}
function cli_decrypt($enc_mes,$guest_prikey){ // 
    global $conn;
    $guest_prikey = strval($guest_prikey);
    $enc_mes = strval($enc_mes);
    $light_mes = shell_exec("C:\Users\cindy\AppData\Local\Programs\Python\Python37\python.exe  D:\\xampp\\htdocs\\資安實作\\實作_python_code\\實作_python_code\\cli_Decrypt_Rsa.py $enc_mes $guest_prikey");
    $light_mes =  json_decode($light_mes);
    // echo $light_mes;
    return $light_mes;
    //echo var_dump($key);
    
}
function ser_encrypt($mes,$guest_pubkey){// 我們傳兌獎序號給user
    global $conn;
    $mes = strval($mes);
    $guest_pubkey =strval($guest_pubkey);
    $enc_mes = shell_exec("C:\Users\cindy\AppData\Local\Programs\Python\Python37\python.exe  D:\\xampp\\htdocs\\資安實作\\實作_python_code\\實作_python_code\\ser_Encrypt_Rsa.py $mes $guest_pubkey");
    $enc_mes =  json_decode($enc_mes);
    echo $enc_mes;
    return $enc_mes;
    //echo var_dump($key);
    
}

function ser_decrypt($enc_mes){
    global $conn;
    $enc_mes = strval($enc_mes);
    $light_mes = shell_exec("C:\Users\cindy\AppData\Local\Programs\Python\Python37\python.exe D:\\xampp\\htdocs\\資安實作\\實作_python_code\\實作_python_code\\ser_Decrypt_Rsa.py $enc_mes");
    $light_mes =  json_decode($light_mes);
    echo $light_mes;
    return $light_mes;
    //echo var_dump($key);
    
}

function cli_sign($mes,$guest_prikey){
    global $conn;
    $mes = strval($mes);
    $guest_prikey = strval($guest_prikey);
    $sign_data = shell_exec("C:\Users\cindy\AppData\Local\Programs\Python\Python37\python.exe D:\\xampp\\htdocs\\資安實作\\實作_python_code\\實作_python_code\\cli_sign_Rsa.py $mes $guest_prikey");
    $sign_data = json_decode($sign_data);
    echo $sign_data;
    return $sign_data;
    //echo var_dump($key);
    
}
function cli_verify($mes,$sign){
    global $conn;
    $mes = strval($mes);
    $sign = strval($sign);
    $sign_data = shell_exec("C:\Users\cindy\AppData\Local\Programs\Python\Python37\python.exe  D:\\xampp\\htdocs\\資安實作\\實作_python_code\\實作_python_code\\cli_check_sign_Rsa.py $mes $sign");
    $sign_data =  json_decode($sign_data);
     echo $sign_data;
    return $sign_data;
    //echo var_dump($key);
   
}
function ser_sign($mes){
    global $conn;
    $mes = strval($mes);
    $sign_data = shell_exec("C:\Users\cindy\AppData\Local\Programs\Python\Python37\python.exe  D:\\xampp\\htdocs\\資安實作\\實作_python_code\\實作_python_code\\ser_sign_Rsa.py $mes");
    $sign_data =  json_decode($sign_data);
    echo $sign_data;
    return $sign_data;
    //echo var_dump($key);
    
}

function ser_verify($mes,$guest_pubkey,$sign){
    global $conn;
    $mes = strval($mes);
    $guest_pubkey = strval($guest_pubkey);
    $sign = strval($sign);
    $sign_data = shell_exec("C:\Users\cindy\AppData\Local\Programs\Python\Python37\python.exe D:\\xampp\\htdocs\\資安實作\\實作_python_code\\實作_python_code\\ser_check_sign_Rsa.py $mes $guest_pubkey $sign");
    $sign_data = json_decode($sign_data);
    
    echo $sign_data;
    return $sign_data;
    //echo var_dump($key);
    
}
function search_okstatus(){
    echo 'search_okstatus';
    global $conn;
    $all_mes = 0;
    $sql = "SELECT hash_lottery from record ;";
    $result=mysqli_query($conn,$sql) or die("DB Error: Cannot retrieve message.");
    while($rs=mysqli_fetch_assoc($result)){
        if (empty($rs['hash_lottery'])){
            continue;
        }else{
            $all_mes += intval($rs['hash_lottery']);
        }
    }
    echo "<br>";
    echo "all_mes[0];";
    echo strval($all_mes);
    return $all_mes;
}
function close_lotter(){ //週期會執行的function,關閉樂透會執行
    global $conn;
    $all_mes = search_okstatus();
    $all_mes = strval($all_mes);
    $hash_data = shell_exec("C:\Users\cindy\AppData\Local\Programs\Python\Python37\python.exe  D:\\xampp\\htdocs\\資安實作\\實作_python_code\\實作_python_code\\close.py $all_mes"); 
    $hash_data =  json_decode($hash_data); // period 的hash:所有參加者的hash再hash
    $sign_data = ser_sign($hash_data);     // 本期hash值+本遊戲的私鑰產生這期的簽章
    // $sql = "update periodhash set hash='$hash_data' where period = '$period';";
    $sql = "update periodhash set `hash`='$hash_data',`sign`='$sign_data' where pID = 6;";
	mysqli_query($conn, $sql) or die("Insert failed, SQL query error");
    echo 'sign_data:';
    echo var_dump($sign_data);
    echo $sign_data;
    $winner_num = setNum($hash_data);
    echo "<br>number_win:";
    echo $winner_num;
    return $sign_data;
    
}
?>