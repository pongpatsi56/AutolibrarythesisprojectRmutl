<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";


    $book = $_POST['data'];
    $member = $_POST['mem'];


    if ($book=="ใส่รหัสหนังสือ") {
        $book = "";
    }

    $sql = "SELECT * FROM databib 
    JOIN borrowandreturn ON borrowandreturn.Book = databib.Barcode 
    WHERE databib.Barcode = '{$book}' 
        AND databib.Field = '245' 
        AND borrowandreturn.Member = '{$member}' 
        AND borrowandreturn.Due = '0000-00-00' ";
    $result = $conn->query($sql);

    if (mysqli_num_rows($result)!=0) {
        $data_main = $result->fetch_assoc();
        $data_book_already_cut = calsub_arr($data_main['Subfield'],245);
        $data_main['Subfield'] = $data_book_already_cut['Title']['#a'];
        echo json_encode($data_main);
        // print_r($data_main);
    }
    else{
        echo 0;
    }

?>


