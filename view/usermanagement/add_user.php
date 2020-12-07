<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
mysqli_query($conn, "SET NAMES 'utf8'");
mysqli_set_charset($conn, "utf8");
$date_now = date('Y-m-d');
if (!empty($_FILES["book_file"]["name"])) {
    $allowed_ext = array("csv");
    $tmp = explode(".", $_FILES["book_file"]["name"]);
    $extension = end($tmp);
    if (in_array($extension, $allowed_ext)) {
        $file_data = fopen($_FILES["book_file"]["tmp_name"], 'r');
        fgetcsv($file_data);
        $sql_ID = "SELECT max(ID) as ID FROM buy ";
        $data_ID = $conn->query($sql_ID);
        $ID = $data_ID->fetch_assoc();
        $ID = $ID['ID'] + 1;
        $stack_member = "";
        $stack_user_status = "";
        while ($row = fgetcsv($file_data)) {
            $username = mysqli_real_escape_string($conn, iconv('TIS-620', 'UTF-8', $row[0]));
            $password = mysqli_real_escape_string($conn, iconv('TIS-620', 'UTF-8', $row[1]));
            $enc_pass = hash("MD5", $password);
            $citizen_id = mysqli_real_escape_string($conn, iconv('TIS-620', 'UTF-8', $row[2]));
            $first_name = mysqli_real_escape_string($conn, iconv('TIS-620', 'UTF-8', $row[3]));
            $last_name = mysqli_real_escape_string($conn, iconv('TIS-620', 'UTF-8', $row[4]));
            $faculty = mysqli_real_escape_string($conn, iconv('TIS-620', 'UTF-8', $row[5]));
            $major = mysqli_real_escape_string($conn, iconv('TIS-620', 'UTF-8', $row[6]));
            $telephone_num = mysqli_real_escape_string($conn, iconv('TIS-620', 'UTF-8', $row[7]));
            $email = mysqli_real_escape_string($conn, iconv('TIS-620', 'UTF-8', $row[8]));
            $address = mysqli_real_escape_string($conn, iconv('TIS-620', 'UTF-8', $row[9]));

            ////// insert table member ///////
            $stack_member = "('$citizen_id','$first_name', '$last_name', '$faculty', '$major', '$date_now', '$username', '$enc_pass', '$telephone_num', '$email', '$address', '2')";
            $sql_member = "INSERT INTO member (ID,FName,LName,Faculty,Major,LastTimeContact,Username,Password,Tel,Email,Address,Status) VALUES $stack_member ";
            mysqli_query($conn, $sql_member);

            ////// insert table user status //////
            $stack_user_status = "('$citizen_id','2', '0', '0', null)";
            $sql_user_status = "INSERT INTO userstatus (User_ID,Status,IsDelete,IsBan,lineuserId) VALUES $stack_user_status ";
            mysqli_query($conn, $sql_user_status);
        }
        // $stack_member = substr($stack_member, 0, strlen($stack_member) - 1);
        // $sql_member = "INSERT INTO member (ID,FName,LName,Faculty,Major,LastTimeContact,Username,Password,Tel,Email,Address,Status) VALUES $stack_member ";
        // mysqli_query($conn, $sql_member);

        // $stack_user_status = substr($stack_user_status, 0, strlen($stack_user_status) - 1);
        // $sql_user_status = "INSERT INTO userstatus (User_ID,Status,IsDelete,IsBan,lineuserId) VALUES $stack_user_status ";
        // mysqli_query($conn, $sql_user_status);
    }
}
