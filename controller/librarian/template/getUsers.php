<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

$departid = $_POST['depart'];   // department id

$sql = "SELECT ID,Code FROM indicator WHERE Field=".$departid;

$result = mysqli_query($conn,$sql);

$users_arr = array();

while( $row = mysqli_fetch_array($result) ){
    $userid = $row['ID'];
    $name = $row['Code'];
    $users_arr[] = array("ID" => $userid, "Code" => $name);
}

$html = '';
while ($result = mysqli_fetch_array($query)) {
    $html .= "<div onclick='toselect2(this)' class='valid_click' data-value='{$result['Code']}' style='padding-left: 0px; padding-right: 0px;'>{$result['Code']}</div>";
    
}

// encoding array to json format
echo json_encode($users_arr);?>