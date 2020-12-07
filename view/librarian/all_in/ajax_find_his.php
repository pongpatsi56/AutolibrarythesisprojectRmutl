<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/datehelper.php";



    $member = $_POST['data'];

    $sql = "SELECT * FROM borrowandreturn WHERE Member = '{$member[0]['ID']}' ORDER BY Borrow DESC ";
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
        $sql = "SELECT * FROM databib_item WHERE Barcode IN {$stack} ";
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_bib_item[$i] = $data->fetch_assoc(); 
        }
        $stack = "(";
        for ($i=0; $i < count($data_bib_item) ; $i++) { 
            $stack .= "'{$data_bib_item[$i]['Bib_ID']}',";
        }
        $stack = substr($stack,0,strlen($stack)-1).")";
        $sql = "SELECT * FROM databib WHERE Bib_ID IN {$stack} ";
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_temp[$i] = $data->fetch_assoc(); 
        }
        for ($j=0; $j < count($data_bib_item) ; $j++) { 
            for ($i=0; $i < count($data_temp) ; $i++) { 
                if ($data_bib_item[$j]['Bib_ID']==$data_temp[$i]['Bib_ID']) {
                    $data_bib[$data_bib_item[$j]['Bib_ID']][$data_temp[$i]['Field']] = ['Indicator1'=>$data_temp[$i]['Indicator1'],'Indicator2'=>$data_temp[$i]['Indicator2'],'Subfield'=>$data_temp[$i]['Subfield']];
                }
            }
        }
        // print_r($data_bib);
        // echo json_encode($data_temp);
        
        
        for ($i=0; $i < count($data_bor) ; $i++) {
            for ($j=0; $j < count($data_bib_item) ; $j++) { 
                if ($data_bor[$i]['Book']==$data_bib_item[$j]['Barcode']) {
                    // foreach ($data_bib[$data_bib_item[$j]['Bib_ID']] as $key => $value) {
                        $data_book[$data_bor[$i]['Book']] = $data_bib[$data_bib_item[$j]['Bib_ID']];
                    // }
                }
            }
        }
        foreach ($data_book as $i => $valuei) {
            $data_book_already_cut = calsub_arr($data_book[$i]['245']['Subfield'],'245');
            $data_book[$i]['245']['Subfield'] = $data_book_already_cut['Title']['#a'];
        }
        foreach ($data_bor as $key => $value) {
            $data_bor[$key]['Borrow'] = convert_datethai_monthdot($data_bor[$key]['Borrow']);
            $data_bor[$key]['Returns'] = convert_datethai_monthdot($data_bor[$key]['Returns']);
            $data_bor[$key]['Due'] = convert_datethai_monthdot($data_bor[$key]['Due']);
        }
        $temp_arrange = [];
        foreach ($data_bor as $key => $value) {
           if ($data_bor[$key]['Due']=="-") {
               array_push($temp_arrange,$data_bor[$key]);
               unset($data_bor[$key]);
           }
        }
        foreach ($data_bor as $key => $value) {
            array_push($temp_arrange,$data_bor[$key]);
        }

        $data_main[0] = $temp_arrange;
        // $data_main[0] = $data_bor;
        $data_main[1] = $data_book;
        // print_r($data_book);
        $stack = "(";
        for ($i=0; $i < count($data_main[0]) ; $i++) { 
            if ($data_main[0][$i]['Due_Status']!=null) {
                $stack .= "'{$data_main[0][$i]['ID']}',";
            }
        }
        $stack = substr($stack,0,strlen($stack)-1);
        $stack .= ")";

        $sql = "SELECT * FROM finebook WHERE Borrow_ID IN {$stack} ";
        $data = $conn->query($sql);

        if (@mysqli_num_rows($data)!=0) {
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_fine[$i] = $data->fetch_assoc();
            }
            for ($i=0; $i < count($data_fine); $i++) { 
                if ($data_fine[$i]['Type']==1) {
                    $data_fine[$i]['Type'] = "คืนเกินกำหนด";
                }
                else if($data_fine[$i]['Type']==2){
                    $data_fine[$i]['Type'] = "สูญหาย";
                }

                if ($data_fine[$i]['receipt_NO'] == "") {
                    $data_fine[$i]['receipt_NO'] = "-";
                }
                else{
                    $date_temp = date("Y-m-d",strtotime($data_fine[$i]['Payment_Date']));
                    $data_fine[$i]['Payment_Date'] = convert_datethai_monthdot($date_temp);
                }
                
            }
            $data_main[2] = $data_fine;
        }
        else {
            $data_main[2] = [];
        }

        if (count($data_main[2])!=0) {
            $temp_rep = [];
            for ($i=0; $i < count($data_main[2]) ; $i++) { 
                if ($data_main[2][$i]['receipt_NO']!=""&&!in_array($data_main[2][$i]['receipt_NO'],$temp_rep)) {
                    array_push($temp_rep,$data_main[2][$i]['receipt_NO']);
                }
            }

            if (count($temp_rep)!=0) {
                $stack = "(";
                for ($i=0; $i < count($temp_rep) ; $i++) { 
                    $stack .= "'{$temp_rep[$i]}',";
                }
                $stack = substr($stack,0,strlen($stack)-1).")";

                $sql = "SELECT * FROM fine_receipt WHERE receipt_NO IN {$stack} ";
                $data = $conn->query($sql);

                $temp_rep = [];
                for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                    $temp_rep[$i] = $data->fetch_assoc();
                }
                $data_main[3]=$temp_rep;
            }
            else{
                $data_main[3]=[];
            }
        }
        echo json_encode($data_main);
        // print_r($data_main);

    }

    

   
    


    // print_r($sql);
    // print_r($data_book);

    


?>