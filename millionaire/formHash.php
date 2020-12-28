<?php
require('lotterModel.php');
$result = getlotteLIst();
$data = 0;
while($rs = mysqli_fetch_assoc($result)){
  $data += (int)($rs['sign']); // 把本期參加人員的簽章加在一起
}
echo $data;
echo '<br>';
$file = fopen("test.txt","w+"); //開啟檔案
fwrite($file,$data);
fclose($file);
gen_key();
echo '<br>';
$q = cli_encrypt(123);
echo '<br>';
ser_decrypt($q);
echo '<br>';
$e = cli_sign(123,"1928561483,186029393");
echo '<br>';
ser_verify(123,"1928561483,65537",$e);
echo '<br>';
$q = ser_encrypt(123,"1928561483,65537");
echo '<br>';
cli_decrypt($q,"1928561483,186029393");
echo '<br>';
$q = ser_sign(123);
echo '<br>';
cli_verify(123,$q);
echo '<br>';
$hf = hashForm(1,1,2,22,5);
echo'';
close_lotter();
?> 