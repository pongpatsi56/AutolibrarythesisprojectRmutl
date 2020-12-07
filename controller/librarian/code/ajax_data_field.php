<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";


    $field = $_POST['data'];

    $sql1   = "SELECT * FROM field WHERE Field = $field";
    $sql2  = "SELECT * FROM indicator WHERE Field = $field";
    $sql3  = "SELECT * FROM subfield WHERE Field = $field";

    $result_field = $conn->query($sql1);
    $result_indicator = $conn->query($sql2);
    $result_subfield = $conn->query($sql3);

    for ($i = 0; $i < mysqli_num_rows($result_field); $i++) {
        $res_field[$i] = $result_field->fetch_assoc();
    }
    if (mysqli_num_rows($result_indicator)!=0) {
        for ($i = 0; $i < mysqli_num_rows($result_indicator); $i++) {
            $res_indicator[$i] = $result_indicator->fetch_assoc();
        }
    }
    
    for ($i = 0; $i < mysqli_num_rows($result_subfield); $i++) {
        $res_subfield[$i] = $result_subfield->fetch_assoc();
    }

    $main = [];

    array_push($main,$res_field);
    if (isset($res_indicator)) {
        array_push($main,$res_indicator);
    }
    array_push($main,$res_subfield);

    print_r(JSON_ENCODE($main));
    // print_r($main);



?>