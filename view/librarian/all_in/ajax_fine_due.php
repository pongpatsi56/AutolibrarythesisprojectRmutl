<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";


    $id = $_POST['id'];

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

    echo $amount;
  
  

?>


