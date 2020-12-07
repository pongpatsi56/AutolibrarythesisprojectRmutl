<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";


    $book = $_POST['data'];
    $member = $_POST['mem'];


    if ($book=="ใส่รหัสหนังสือ") {
        $book = "";
    }

    $sql = "SELECT * FROM databib_item 
    JOIN borrowandreturn ON borrowandreturn.Book = databib_item.Barcode 
    WHERE databib_item.Barcode = '{$book}' 
        AND borrowandreturn.Member = '{$member}' 
        AND borrowandreturn.Due = '0000-00-00' ";
    $data = $conn->query($sql);

    if (mysqli_num_rows($data)!=0) {
        $databib_item = $data->fetch_assoc();
        $sql = "SELECT * FROM databib WHERE Bib_ID = '{$databib_item['Bib_ID']}' ";
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_temp[$i] = $data->fetch_assoc();
        }
        for ($i=0; $i < count($data_temp) ; $i++) { 
            if ($data_temp[$i]['Field']=='245') {
                $data_book_already_cut = calsub_arr($data_temp[$i]['Subfield'],245);
                $data_cut['Subfield'] = $data_book_already_cut['Title']['#a'];
            }
        }
        $data_main = [
            'Barcode'=>$databib_item['Barcode'],
            'Bib_ID'=>$databib_item['Bib_ID'],
            'Book'=>$databib_item['Book'],
            'Borrow'=>$databib_item['Borrow'],
            'Copy'=>$databib_item['Copy'],
            'Due'=>$databib_item['Due'],
            'Due_Status'=>$databib_item['Due_Status'],
            'ID'=>$databib_item['ID'],
            'Librarian'=>$databib_item['Librarian'],
            'Member'=>$databib_item['Member'],
            'Returns'=>$databib_item['Returns'],
            'Subfield'=>$data_cut['Subfield']
        ];
        
        echo json_encode($data_main);
        // print_r($data_main);
    }
    else{
        echo 0;
    }

?>


