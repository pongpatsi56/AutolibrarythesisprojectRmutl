<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    function get_id($Barcode,$conn){
        $date = date('Y-m-d H:i:s');
        $stack = "('databib_item','เพิ่มฉบับทรัพยากร','".$Barcode."','$date','".$_SESSION['user_status']['ID']."')";
        $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";
        mysqli_query($conn,$sql_log);
        // echo $sql_log;
    }

    $bib_id = $_POST['val'];
    $copy = $_POST['copy'];


    $sql = "SELECT max(Barcode) as Barcode FROM databib_item WHERE Bib_ID = '{$bib_id}' ";
    $data = $conn->query($sql);
    $barcode = $data->fetch_assoc();
    $barcode = $barcode['Barcode'];
    $front_barcode = substr($barcode,0,3);
    $front_barcode = (int)$front_barcode;
    $front_barcode = $front_barcode+1;

    for ($i=strlen($front_barcode); $i < 3 ; $i++) { 
        $front_barcode = "0".$front_barcode;
    }
    
    $barcode = $front_barcode.substr($barcode,3,strlen($barcode));

    $sql = "INSERT INTO databib_item(Barcode,Bib_ID,Copy) VALUES ('$barcode','{$bib_id}','{$copy}')";
    $sql2 = "INSERT INTO rfidandstatus(Barcode,Status,RFID) VALUES ('{$barcode}','0','{$barcode}')";
    if (mysqli_query($conn,$sql)===TRUE) {
        if (mysqli_query($conn,$sql2)===TRUE) {
            get_id($barcode,$conn);
        }
    }

?>