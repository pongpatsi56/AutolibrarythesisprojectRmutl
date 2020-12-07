<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/lib/include/connect.php";
include($path);

$departid = $_POST['depart'];   // department id

$sql = "SELECT ID,Code FROM indicator WHERE Field=".$departid;

$result = mysqli_query($conn,$sql);

$users_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $userid = $row['ID'];
    $name = $row['Code'];

    $users_arr[] = array("ID" => $userid, "Code" => $name);
}

// encoding array to json format
echo json_encode($users_arr);?>