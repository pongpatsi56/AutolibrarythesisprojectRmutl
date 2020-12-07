<?php
session_start();
include "../../include/connect.php";
date_default_timezone_set('asia/bangkok');
function per_name($stat)
{
    switch ($stat) {
        case '0':
            return 'admin';
            break;
        case '1':
            return 'บรรณารักษ์ ';
            break;
        case '2':
            return 'นักศึกษา';
            break;
        default:
            return '';
            break;
    }
}
$date = date('Y-m-d H:i:s');
$idlib = $_SESSION['user_status']['ID'];
$userid = $_POST['user'];
$oldstatus = $_POST['oldstat'];
$status = $_POST['stat'];

if ($conn->query("UPDATE userstatus SET Status = '$status' WHERE User_ID = '$userid';") === true) {
    if ($conn->query("INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES ('userstatus','แก้ไข(จาก" . per_name($oldstatus) . "เป็น" . per_name($status) . ")','$userid','$date','$idlib')") === true) {
        echo "INSERT SUCCESS";
    }
    echo "UPDATE SUCCESS";
}
