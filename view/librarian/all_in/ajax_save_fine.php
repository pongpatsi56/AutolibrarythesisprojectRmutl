<?php
    session_start();
    
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    function get_id($book,$conn){
        $run = 0;
        $date = date('Y-m-d H:i:s');
        
        $stack = "";

        foreach($book as $key => $value){
            $stack .= "('finebook','ค่าปรับ','".$book[$key][0]."','$date','".$_SESSION['user_status']['ID']."'),";
        $run++;
        }
        $stack = substr($stack,0,strlen($stack)-1);
        $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";
        mysqli_query($conn,$sql_log);
    }

    $fine_book = $_POST['fine_book'];
    $fine_rep = $_POST['fine_rep'];

    print_r($fine_book);
    print_r($fine_rep);
    $date = date('Y-m-d H:i:s');

    $receipt_NO = "";
    $sql = "SELECT max(receipt_NO) as receipt_NO FROM finebook ";
    $rec = $conn->query($sql);
    if (mysqli_num_rows($rec)==0) {
        $rec_no = 0000;
    }
    else {
        $rec_no = $rec->fetch_assoc();
    }


    $year = substr(date('Y')+543,2);
    $cut =substr($rec_no['receipt_NO'],3);
    $res = $cut + 1;
    for ($i=0; 5 > strlen($res) ; $i++) { 
        $res = '0'.$res;
    }
    $receipt_NO = $year.'/'.$res;

    $stack="(";
    for ($i=0; $i < count($fine_book) ; $i++) { 
        $stack .= "'{$fine_book[$i][0]}',";
    }
    $stack = substr($stack,0,strlen($stack)-1).")";

    $sql_up_fine = "UPDATE finebook SET Payment_Date = '$date',receipt_NO = '$receipt_NO' WHERE Borrow_ID IN $stack";
    $conn->query($sql_up_fine);

    $sql = "UPDATE borrowandreturn SET Due_Status = '1' WHERE ID IN $stack";
    $conn->query($sql);

    $stack="";
    for ($i=0; $i < count($fine_book) ; $i++) { 
        $stack = "UPDATE finebook SET Amount = '{$fine_book[$i][1]}' WHERE Borrow_ID = '{$fine_book[$i][0]}' ";
        $conn->query($stack);
    }

    $sql = "INSERT INTO fine_receipt(receipt_NO,Payment_Total,Payment_Real,Paid,`Change`,Free,Comment) VALUES 
    ('{$receipt_NO}','{$fine_rep['Payment_Total']}','{$fine_rep['Payment_Real']}','{$fine_rep['Paid']}','{$fine_rep['Change']}','{$fine_rep['Free']}','{$fine_rep['Comment']}') ";
    $conn->query($sql);

    get_id($fine_book,$conn);


?>