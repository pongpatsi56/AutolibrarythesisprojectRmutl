<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/ppat.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    $member = $_POST['data'];

    if ($member=="ใส่รหัสสมาชิกหรือคำเพิ่อค้นหา") {
        $member = "";
    }

    $sql = "SELECT * FROM member ";

    if ($member != "") {
        $sql .= " WHERE ID LIKE '%{$member}%' 
                OR FName LIKE '%{$member}%'  
                OR LName LIKE '%{$member}%'
                OR Faculty LIKE '%{$member}%'
                OR Major LIKE '%{$member}%'
                OR Tel LIKE '%{$member}%'";
    } 

    $sql .= " ORDER BY ID DESC ";

    $result = $conn->query($sql);

    if (mysqli_num_rows($result)!=0) {
        for ($i=0; $i < mysqli_num_rows($result) ; $i++) { 
            $data_main[$i] = $result->fetch_assoc();
        }
        echo json_encode($data_main);
        // print_r($data_main);
    }
    else{
        echo null;
    }

?>


