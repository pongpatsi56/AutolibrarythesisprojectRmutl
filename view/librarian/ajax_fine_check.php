<?php

include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    $member = $_POST['member'];
    // $member = '59523203015-4';

    $sql = " SELECT * 
    FROM borrowandreturn 
    LEFT JOIN finebook
    ON borrowandreturn.ID = finebook.Borrow_ID
    WHERE borrowandreturn.Member = '$member' ";
    $data = $conn->query($sql);
    for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
        $data_main[$i] = $data->fetch_assoc();
    }

    echo "<pre>";
    print_r($data_main) ;
    echo "</pre>";


    $stack = "('',";
    for ($i=0; $i < count($data_main) ; $i++) { 
        $startdate = date_create($data_main[$i]['Returns']);
        $enddate = date_create($data_main[$i]['Due']); 
        $datediff = date_diff($startdate,$enddate,FALSE);

        if ($datediff->invert == 0&&$data_main[$i]['receipt_NO']==NULL) {
            $stack .= "'".$data_main[$i]['ID']."','1','".$datediff->format('%a')."','".NULL."'),('',";
        }
        
    }
    $stack = substr($stack,0,strlen($stack)-5);
    $sql = " INSERT INTO finebook(receipt_ID,Borrow_ID,Type,Amount,Payment_Date) VALUES $stack ";

    $conn->query($sql);
    
?>
