<?php
include_once "../../include/connect.php";
function query_data($sql)
{
    global $conn;
    $getdata = mysqli_query($conn, $sql);
    $data = array();
    if (mysqli_num_rows($getdata) != 0) {
        while ($row = mysqli_fetch_assoc($getdata)) {
            array_push($data, $row);
        }
    }
    return $data;
}

if ($_POST['check'] == 'user') {
    $username = $_POST['username'];
    $results = query_data("SELECT * FROM member WHERE username = '$username'");
    if (count($results)) {
        echo '1';
    } else {
        echo '0';
    }
    exit();
}
if ($_POST['check'] == 'id') {
    $id = $_POST['id'];
    $results = query_data("SELECT * FROM member WHERE ID = '$id'");
    if (count($results)) {
        echo '1';
    } else {
        echo '0';
    }
    exit();
}
if ($_POST['check'] == 'email') {
    $email = $_POST['email'];
    $results = query_data("SELECT * FROM member WHERE Email = '$email'");
    if (count($results)) {
        echo '1';
    } else {
        echo '0';
    }
    exit();
}
