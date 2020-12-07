    <?php

        include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";
            
        $book_id = $_POST['book_id'];
        $borrow_id = $_POST['borrow_id'];
        $stat = $_POST['stat'];

        $date = date('Y-m-d H:i:s',time());
        $date_day = date('Y-m-d');

        if ($stat==1) {
            $sql_update_status = "UPDATE rfidandstatus SET Status = 9 WHERE Barcode = $book_id";
            $conn->query($sql_update_status);

            $sql_due_status = "UPDATE borrowandreturn SET Due = '$date_day' , Due_Status = 0 WHERE ID = $borrow_id";
            $conn->query($sql_due_status);

            $sql = "SELECT * FROM databib WHERE Barcode = $book_id ";
            $res = $conn->query($sql);
            @$data_book = calsub_arr($res,[365]);
            
            if (isset($data_book[$book_id]['Price'])) {
                $val = "#b";
                $sql = "INSERT INTO finebook(Borrow_ID,Type,Amount) VALUES ('$borrow_id','2','".$data_book[$book_id]['Price'][$val]."')";
            }
            else{
                $data_book= "-";
                $sql = "INSERT INTO finebook(Borrow_ID,Type,Amount) VALUES ('$borrow_id','2','".$data_book."')";
            }
            $conn->query($sql);
        }
        else if($stat==0) {
            $sql_update_status = "UPDATE rfidandstatus SET Status = 1 WHERE Barcode = $book_id";
            $conn->query($sql_update_status);
    
            $sql_due_status = "UPDATE borrowandreturn SET Due = '0000-00-00' , Due_Status = NULL WHERE ID = $borrow_id";
            $conn->query($sql_due_status);
    
                $sql = "DELETE FROM finebook WHERE Borrow_ID = $borrow_id;";
            $conn->query($sql);
        }
        


    ?>