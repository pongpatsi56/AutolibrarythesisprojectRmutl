<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
$departid = $_POST['depart'];  
$sql = "SELECT Code,Description FROM indicator WHERE Field=".$departid;
$query = mysqli_query($conn,$sql);

if(mysqli_num_rows($query)!=0){
    $html = '';
    while ($result = $query->fetch_assoc()) {
        $html .= "<div onclick='toselect4(this)' title='{$result['Description']}' class='valid_click' data-value='{$result['Code']}' style='padding-left: 0px; padding-right: 0px;'>{$result['Code']}</div>";
    }
    echo $html;
}

?>
