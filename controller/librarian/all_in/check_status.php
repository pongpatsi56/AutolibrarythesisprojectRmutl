<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    @$data = $_POST['data'];
    $item_fail = [];
    $run = 0;


    if (isset($data)) {
        $stack = "(";
        for ($i=0; $i < count($data) ; $i++) { 
            $stack .= "'".$data[$i]."',";
        }
        $stack = substr($stack,0,strlen($stack)-1);
        $stack .= ")";

        $sql = "SELECT Barcode,Status FROM rfidandstatus WHERE Barcode IN $stack ";
        $data_sql = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data_sql) ; $i++) { 
            $data_ID[$i] = $data_sql->fetch_assoc();
        }
        for ($i=0; $i < count($data_ID) ; $i++) { 
            if ($data_ID[$i]['Status']==1) {
                for ($j=0 ; $j < count($data) ; $j++) { 
                    if ($data[$j]==$data_ID[$i]['Barcode']) {
                        $item_fail[] = [$j => $data[$j]];
                        $run++;
                    }
                }
            }
        }
    }
    

    if (isset($item_fail)) {
        print_r(json_encode($item_fail)) ;
        // print_r($item_fail);
    }
    else{
        print_r(Null);
    }

    




?>