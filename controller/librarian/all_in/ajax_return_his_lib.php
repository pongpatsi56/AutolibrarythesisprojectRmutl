<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";

    $member = $_POST['member'];

    $sql = "SELECT * FROM borrowandreturn WHERE Member = '$member' ";
    $data = $conn->query($sql);
    $row = $data->num_rows;
    for ($i = 0; $i < $row; $i++) {
        $data_main[$i] = $data->fetch_assoc();
    }


    $stack = "(";
    for ($i = 0; $i < $row; $i++) {
        $stack .= "'" . $data_main[$i]['Librarian'] . "',";
    }
    $stack = substr($stack, 0, strlen($stack) - 1);
    $stack .= ")";
    $sql_lib = "SELECT FName,LName,Username FROM librarian WHERE Username IN $stack ";
    $data = $conn->query($sql_lib);
    for ($i = 0; $i < $row; $i++) {
        $data_lib[$i] = $data->fetch_assoc();
    }

    $sql_member = "SELECT FName,LName FROM member WHERE ID = '$member' ";
    $data = $conn->query($sql_member);
    $data_member = $data->fetch_assoc();


    $stack = "(";
    for ($i = 0; $i < $row; $i++) {
        $stack .= $data_main[$i]['Book'] . ",";
    }
    $stack = substr($stack, 0, strlen($stack) - 1);
    $stack .= ")";
    $sql_lib = "SELECT databib.Subfield,databib.Barcode,rfidandstatus.status as Status,borrowandreturn.Due,borrowandreturn.member 
    FROM borrowandreturn 
    JOIN rfidandstatus ON borrowandreturn.Book=rfidandstatus.Barcode 
    JOIN databib ON borrowandreturn.Book=databib.Barcode 
    WHERE databib.Field = '245' 
    AND databib.Barcode IN $stack
    AND borrowandreturn.member = '$member'";

    $data = $conn->query($sql_lib);
    for ($i = 0; $i < $row; $i++) {
        $data_book[$i] = $data->fetch_assoc();
    }

    echo json_encode($data_lib);


?>