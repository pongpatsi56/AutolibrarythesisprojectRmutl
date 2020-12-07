<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
$key = $_POST["key"];
$sql = "SELECT Field,Name FROM field WHERE Field like '%".$key."%' GROUP BY Field";
$query = mysqli_query($conn,$sql);



    $html = '';
    while ($result = $query->fetch_assoc()) {
        $html .= "<div onclick='toselect(this)' title='{$result['Name']}' class='valid_click' data-value='{$result['Field']}' style='padding-left: 0px; padding-right: 0px;'>{$result['Field']}</div>";
    }
    echo $html;
?>
