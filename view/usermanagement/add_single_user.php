<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
mysqli_set_charset($conn, "utf8");
$date_now = date('Y-m-d');
$citizen_id = $_POST['user_id'];
$username = $_POST['new_username'];
$password = $_POST['new_password'];
$enc_pass = hash("MD5", $password);
$first_name = isset($_POST['FName']) ? $_POST['FName'] : '-';
$last_name = isset($_POST['LName']) ? $_POST['LName'] : '-';
$faculty = isset($_POST['Facul']) ? $_POST['Facul'] : '-';
$major = isset($_POST['Major']) ? $_POST['Major'] : '-';
$telephone_num = isset($_POST['tel']) ? $_POST['tel'] : '-';
$email = isset($_POST['mail']) ? $_POST['mail'] : '-';
$address = isset($_POST['addr']) ? $_POST['addr'] : '-';
$sql_member = "INSERT INTO member (ID,FName,LName,Faculty,Major,LastTimeContact,Username,Password,Tel,Email,Address,Status) VALUES ('$citizen_id','$first_name', '$last_name', '$faculty', '$major', '$date_now', '$username', '$enc_pass', '$telephone_num', '$email', '$address', '2') ";
$sql_user_status = "INSERT INTO userstatus (User_ID,Status,IsDelete,IsBan,lineuserId) VALUES ('$citizen_id','2', '0', '0', null) ";
if ((mysqli_query($conn, $sql_member) === true) && (mysqli_query($conn, $sql_user_status) === true)) {
    echo "1";
}
