<?php
if (!session_id()) {session_start();}
;
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
$username = $_SESSION['user_status']['Username'];

if (isset($_POST['FName'])) {
    $firstname = $_POST['FName'];
    if ($conn->query("UPDATE member SET FName = '$firstname' WHERE member.Username = '$username';") === true) {
        echo "<strong>บันทึกชื่อจริงเรียบร้อยแล้ว</strong>";
    }
}
if (isset($_POST['LName'])) {
    $lastname = $_POST['LName'];
    if ($conn->query("UPDATE member SET LName = '$lastname' WHERE member.Username = '$username';") === true) {
        echo "<strong>บันทึกนามสกุลเรียบร้อยแล้ว</strong>";
    }
}
if (isset($_POST['Email'])) {
    $Email = $_POST['Email'];
    if ($conn->query("UPDATE member SET Email = '$Email' WHERE member.Username = '$username';") === true) {
        echo "<strong>บันทึกอีเมล์เรียบร้อยแล้ว</strong>";
    }
}
