<?php
   include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
   include $_SERVER['DOCUMENT_ROOT'] . "/lib/model/query_data/query_data.php";
   $data = $q_data->fetch_assoc();
 ?>