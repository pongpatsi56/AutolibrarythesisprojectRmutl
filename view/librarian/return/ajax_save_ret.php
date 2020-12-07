<?php
    session_start();
    
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    $book = $_POST['data'];
    $member = $_POST['mem'];

    // print_r($book);
    // print_r($member);

    
    $date = date('Y-m-d');
    
    function get_id($book,$conn){
        $date = date('Y-m-d H:i:s');
        $stack = "(";

        $stack = "";
        for ($i=0; $i < count($book) ; $i++) { 
            $stack .= "('borrowandreturn','คืน','".$book[$i]['ID']."','$date','".$_SESSION['user_status']['ID']."'),";
        }
        $stack = substr($stack,0,strlen($stack)-1);

        $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";

        mysqli_query($conn,$sql_log);

    }

    $stack_id = "(";
    for ($i=0; $i < count($book) ; $i++) { 
        $stack_id .= "'{$book[$i]['ID']}',";
    }
    $stack_id = substr($stack_id,0,strlen($stack_id)-1);
    $stack_id .= ")";

    $stack_book = "(";
    for ($i=0; $i < count($book) ; $i++) { 
        $stack_book .= "'{$book[$i]['Barcode']}',";
    }
    $stack_book = substr($stack_book,0,strlen($stack_book)-1);
    $stack_book .= ")";
    
    $sql_up_borr = "UPDATE borrowandreturn SET Due = '$date' WHERE ID IN $stack_id ";
    // $conn->query($sql_up_borr);
    // print_r($sql_up_borr);

    $sql_up_rfid = "UPDATE rfidandstatus SET Status = 0 WHERE Barcode IN $stack_book ";
    // $conn->query($sql_up_rfid);

    $data_diff = [];

    for ($i=0; $i < count($book) ; $i++) { 
        $diff = date_diff(date_create($book[$i]['Returns']),date_create($date));
        array_push($data_diff,$diff);
    }

    $data_fine = [];

    for ($i=0; $i < count($data_diff) ; $i++) { 
        if ($data_diff[$i]->invert==0) {
            array_push($data_fine,[$book[$i]['ID'],$data_diff[$i]->days]);
        }
    }

    $stack_fine = "";
    for ($i=0; $i < count($data_fine) ; $i++) { 
        $stack_fine .= "('".$data_fine[$i][0]."','1','".$data_fine[$i][1]."'),";    
    }
    $stack_fine = substr($stack_fine,0,strlen($stack_fine)-1);

    $sql_insert = "INSERT INTO finebook(Borrow_ID,Type,Amount) VALUES $stack_fine ";
    // $conn->query($sql_insert);
    // print_r($sql_insert);

    $stack_due_status = "(";
    for ($i=0; $i < count($data_fine) ; $i++) { 
        $stack_due_status .= "'".$data_fine[$i][0]."',";    
    }
    $stack_due_status = substr($stack_due_status,0,strlen($stack_due_status)-1);
    $stack_due_status .= ")";

    $sql_update_due = "UPDATE borrowandreturn SET Due_Status = 0 WHERE ID IN $stack_due_status ";
    // $conn->query($sql_update_due);
    // print_r($sql_update_due);

    if (mysqli_query($conn,$sql_up_borr)==TRUE) {
        if (mysqli_query($conn,$sql_up_rfid)==TRUE) {
            get_id($book,$conn);
            echo "1";
            if(count($data_fine)!=0){
                if (mysqli_query($conn,$sql_insert)==TRUE) {
                    if (mysqli_query($conn,$sql_update_due)==TRUE) {
                    }
                }
            }
        }
    }


?>