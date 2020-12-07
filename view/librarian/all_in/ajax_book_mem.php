<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    $book = $_POST['data'];

    if ($book=="ใส่รหัสหนังสือ") {
        $book = "";
    }

    $sql = "SELECT Member FROM borrowandreturn WHERE Book = '{$book}' AND Due = '0000-00-00' ";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result)!=0) {
        $mem_id = $result->fetch_assoc();
        $sql = "SELECT * FROM member WHERE ID = '{$mem_id['Member']}' ";
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_main[$i] = $data->fetch_assoc();
        }
        echo json_encode($data_main);
        // print_r($data_main);
    }
    else{
        echo null;
    }

?>