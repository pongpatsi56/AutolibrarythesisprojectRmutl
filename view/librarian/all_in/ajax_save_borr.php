<?php
    session_start();
    
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    function get_id($book,$conn){
        $date = date('Y-m-d H:i:s');

        $stack = "";
        for ($i=0; $i < count($book) ; $i++) { 
            $stack .= "('borrowandreturn','ยืม','".$book[$i][0]."','$date','".$_SESSION['user_status']['ID']."'),";
        }
        $stack = substr($stack,0,strlen($stack)-1);

        $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";

        if (mysqli_query($conn,$sql_log)==TRUE) {
            echo 1;
        }
    }

    $book = $_POST['data'];
    $member = $_POST['mem'];

    // print_r($book);
    // print_r($member);

    
    $date = date('Y-m-d');
    $date1 = new DateTime('+7 day');
    $n_date = $date1->format('Y-m-d');
    

    $stack = "";
    for ($i=0; $i < count($book) ; $i++) { 
        $stack .= "('{$_SESSION['user_status']['ID']}','{$member['ID']}','{$book[$i][0]}','$date','$n_date'),";
    }
    $stack = substr($stack,0,strlen($stack)-1);


    $sql1  = "INSERT INTO `borrowandreturn`(Librarian,Member,Book,Borrow,Returns) VALUES ".$stack;
    // $conn->query($sql1);
// print_r($sql1);
    $stack = "(";
    for ($i=0; $i < count($book) ; $i++) { 
        $stack .= "'{$book[$i][0]}',";
    }
    $stack = substr($stack,0,strlen($stack)-1);
    $stack .= ")";
    
    $sql2 = "UPDATE rfidandstatus SET Status = 1 WHERE Barcode IN ".$stack;
    // $conn->query($sql2);

    if (mysqli_query($conn,$sql1)==TRUE) {
        if (mysqli_query($conn,$sql2)==TRUE) {
            get_id($book,$conn);
        }
    }


?>