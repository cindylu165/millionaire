<?php
  function callpy() {
      $test_data= exec("/usr/bin/python  D:\\資安\\hash.py");
      return $test_data ;
  }
?>