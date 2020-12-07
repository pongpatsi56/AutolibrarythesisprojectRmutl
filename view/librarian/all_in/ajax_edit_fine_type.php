<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    $id = $_POST['id'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    print_r($id);
    
    if ($amount == "ไม่ได้กำหนดราคา") {
        $amount = "-";
    }

    if ($type == "สูญหาย") {
        $type = 2;
    }
    else {
        $type = 1;
    }

    if ($type == 1) {
        $sql = "SELECT * FROM borrowandreturn WHERE ID = '$id' ";
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_br=$data->fetch_assoc();
        }

        if ($data_br['Due']=="0000-00-00") {
            $data_br['Due'] = date('Y-m-d');
        }

        $diff = date_diff(date_create($data_br['Returns']),date_create($data_br['Due']));
        $amount=$diff->days;
    }

    $sql = "UPDATE finebook SET Type = '{$type}' , Amount = '{$amount}' WHERE Borrow_ID = '{$id}' ";
    echo $sql;
    // $conn->query($sql);
  
  

?>


