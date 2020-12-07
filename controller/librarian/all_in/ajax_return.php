<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";

    $book = $_POST['book'];

    $sql = "SELECT Subfield FROM databib WHERE Field = 245 AND Barcode = '$book' ";
    $data = $conn->query($sql);
        $data_book = mysqli_fetch_assoc($data);

    if ($data_book!="") {
        $data_book_already_cut = calsub_arr($data_book['Subfield'],245);
        echo $data_book_already_cut['Title']['#a'];
    }
    

    


?>