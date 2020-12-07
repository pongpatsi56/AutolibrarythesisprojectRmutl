<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
$key = $_GET["key"];
$sql = "SELECT Code,Name_Eng FROM Subfield WHERE Field = $key";
$query = mysqli_query($conn,$sql);


    $i=0;
    while ($result = $query->fetch_array()) {
        $i++;
        $sub[$i][0] = $result['Code'];
        $sub[$i][1] = $result['Name_Eng'];
    }
    
    echo json_encode($sub);
    
?>
