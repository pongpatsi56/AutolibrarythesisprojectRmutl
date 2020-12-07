<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";

$key = $_POST["key"];
$sql = "SELECT * FROM databib WHERE Barcode = $key ";

$query = mysqli_query($conn,$sql);

if (mysqli_num_rows($query)!=0) {
    $data = calsub_arr($query,[245,100,260]);
    echo json_encode($data);
}
else{
    echo 'no';
}
    
    
?>
