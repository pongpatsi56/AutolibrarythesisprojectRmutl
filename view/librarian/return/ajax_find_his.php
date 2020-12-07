<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/datehelper.php";



    $member = $_POST['data'];

    $sql = "SELECT * FROM borrowandreturn WHERE Member = '{$member[0]['ID']}' ORDER BY Due,Borrow DESC ";
    $data = $conn->query($sql);

    $data_main = [];

    if (mysqli_num_rows($data)!=0) {
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_bor[$i] = $data->fetch_assoc();
        }
        for ($i=0; $i < count($data_bor) ; $i++) { 
            $startdate = date_create($data_bor[$i]['Returns']);
            $enddate = date_create(date('Y-m-d'));
            $datediff = date_diff($startdate, $enddate, false);
            if ($datediff->invert == 1) {
                $datediff = "ยังไม่เกินกำหนด (" . $datediff->format('%a') . ")";
            } 
            else {
                $datediff = $datediff->format('%r%a');
            }
            $data_bor[$i]['datediff'] = $datediff;
        }
    }
    else{
        $data_bor = [];
    }

    if (count($data_bor)!=0) {
        $stack = "(";
        for ($i=0; $i < count($data_bor) ; $i++) { 
            $stack .= "'{$data_bor[$i]['Book']}',";
        }
        $stack = substr($stack,0,strlen($stack)-1);
        $stack .= ")";
        $sql = "SELECT * FROM databib WHERE Barcode IN {$stack} ";
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) {
            $data_temp = $data->fetch_assoc();
            for ($j=0; $j < count($data_bor) ; $j++) { 
                if ($data_bor[$j]['Book']==$data_temp['Barcode']) {
                    $data_book[$data_bor[$j]['Book']][$data_temp['Field']] = $data_temp;
                }
            }
        }
        foreach ($data_book as $i => $valuei) {
            $data_book_already_cut = calsub_arr($data_book[$i][245]['Subfield'],245);
            $data_book[$i][245]['Subfield'] = $data_book_already_cut['Title']['#a'];
        }
        foreach ($data_bor as $key => $value) {
            $data_bor[$key]['Borrow'] = convert_datethai_monthdot($data_bor[$key]['Borrow']);
            $data_bor[$key]['Returns'] = convert_datethai_monthdot($data_bor[$key]['Returns']);
            $data_bor[$key]['Due'] = convert_datethai_monthdot($data_bor[$key]['Due']);
        }
        $data_main[0] = $data_bor;
        $data_main[1] = $data_book;

    }
    
    echo json_encode($data_main);
    // print_r($data_main);


    // print_r($sql);
    // print_r($data_book);

    


?>