<?php

include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";

$book = $_POST['book'];
$member = $_POST['member'];

$sql = " SELECT Book FROM borrowandreturn WHERE Member = '$member' AND Due = '0000-00-00' ";
$data = mysqli_query($conn,$sql);

for( $i=0 ; $i < mysqli_num_rows($data) ; $i++ ){
    $data_member[$i] = mysqli_fetch_assoc($data);
}

$stack = "(";
for( $i=0 ; $i < count($data_member) ; $i++ ){
    $stack .= "'".$data_member[$i]['Book']."',";
}
$stack = substr($stack,0,strlen($stack)-1);
$stack .= ")";

$sql = "SELECT Subfield FROM databib WHERE Field = 245 AND Barcode = '$book' AND Barcode IN $stack";
$data = $conn->query($sql);
    $data_book = mysqli_fetch_assoc($data);

if ($data_book!="") {
    $data_book_already_cut = calsub_arr($data_book['Subfield'],245);
    echo $data_book_already_cut['Title']['#a'];
}


?>