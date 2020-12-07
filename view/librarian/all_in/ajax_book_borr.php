<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";


    $book = $_POST['data'];

    $sql = "SELECT * FROM databib_item 
    JOIN rfidandstatus ON databib_item.Barcode = rfidandstatus.Barcode 
    WHERE databib_item.Barcode = '{$book}' 
    AND rfidandstatus.Status = 0 ";
    $data = $conn->query($sql);
    if (mysqli_num_rows($data)!=0) {
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_book[$i] = $data->fetch_assoc();
        }
        // print_r($data_book);
        $data_main['Barcode'] = $data_book[0]['Barcode'];
        $sql = "SELECT * FROM databib WHERE Bib_ID = '{$data_book[0]['Bib_ID']}' ";
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_bib[$i] = $data->fetch_assoc();
        }
        for ($i=0; $i < count($data_bib) ; $i++) {
            $temp = array_slice($data_bib[$i],1,4);
            $data_main[$data_bib[$i]['Field']] = $temp;
        }
        $data_main_already_cut = calsub_arr($data_main[245]['Subfield'],245);
        $data_main[245]['Subfield'] = $data_main_already_cut['Title']['#a'];

        // print_r($data_main);
        echo json_encode($data_main);
    }
    else{
        $sql = "SELECT * FROM databib_item WHERE Barcode = '{$book}' ";
        $data = $conn->query($sql);
        // echo $sql;
        if (@mysqli_num_rows($data)!=0) {
            echo 0;
        }
        else {
            echo 1;
        }
    }

?>


