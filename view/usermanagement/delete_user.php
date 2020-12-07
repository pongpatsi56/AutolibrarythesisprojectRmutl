<?php
session_start();
include "../../include/connect.php";
date_default_timezone_set('asia/bangkok');
$date = date('Y-m-d H:i:s');
$idlib = $_SESSION['user_status']['ID'];
$userid = $_POST['user'];

if ($conn->query("UPDATE userstatus SET IsDelete = 1 WHERE User_ID = '$userid';") === true) {
    if ($conn->query("INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES ('userstatus','ลบ','$userid','$date','$idlib')") === true) {
        echo "INSERT SUCCESS";
    }
    echo "UPDATE SUCCESS";
}
