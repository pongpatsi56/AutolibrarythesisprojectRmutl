<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
$code = $_GET['code'];
//  $name = $_GET['name'];

  $arr = explode("*",$code);

//     print_r($arr);
      echo json_encode($arr);
    //echo $arr;

?>
