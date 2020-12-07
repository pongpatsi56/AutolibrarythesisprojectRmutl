<?php
include_once "../../include/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/datehelper.php";


$logtype = $_POST['typelog'];
$datetype = $_POST['typedate'];
$start_date = $_POST['startdate'];
$start_month = $_POST['startmonth'];
$start_year = $_POST['startyear'];
$now_page = $_POST['now_page'];
if ($now_page==null) {
    $now_page = 1;
}

switch ($datetype) {
    case 'bydate':
        $wherecase = " convert(log.Day,DATE) = '$start_date'";
        break;
    case 'byperiod':
        $split = explode('-', $start_month);
        $wherecase = " MONTH(log.Day) = " . "'$split[1]'" . " AND YEAR(log.Day) = " . "'$split[0]'";
        break;
    case 'byyear':
        $wherecase = " YEAR(log.Day) = " . "'$start_year'";
        break;
    default:
        break;
}

    $sql = "SELECT * FROM log 
    WHERE log.Tables = '$logtype' AND $wherecase ORDER BY log.Day ";
    $data = mysqli_query($conn, $sql);

if (@mysqli_num_rows($data)!=0) {
    for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
        $data_log[$i] = $data->fetch_assoc();
    }
    $all_page = ceil(count($data_log)/10);
    echo $all_page."/";
    if ($now_page==1) {
        $run=1;
    }
    else{
        $run=(($now_page-1)*10)+1;
    }
    if ($now_page==1) {
        $start = 0;
    }
    elseif ($now_page!=1) {
        $start = 10*($now_page-1);
    }
    if ($now_page==$all_page) {
        $num = count($data_log);
    }
    else {
        $num = $start+10;
    }
    for ($i=0; $i < count($data_log) ; $i++) { 
        $date_temp = date("Y-m-d",strtotime($data_log[$i]['Day']));
        $data_log[$i]['Day'] = convert_datethai_monthdot($date_temp);
    }
    
    $stack = "";
        $stack .= "<table class='table table-bordered table-striped table_res' width='100%' border='0'>";
        if ($logtype=="borrowandreturn") {
            $stack .= "<tr>";
                $stack .= "<th>ลำดับ</th>";
                $stack .= "<th>รายการทรัพยากร</th>";
                $stack .= "<th>ISBN</th>";
                $stack .= "<th>วันที่</th>";
                $stack .= "<th>ผู้ใช้งาน</th>";
                $stack .= "<th>เจ้าหน้าที่</th>";
                $stack .= "<th>คำอธิบาย</th>";
            $stack .= "</tr>";
            $temp_stack = "(";
            for ($i=0; $i < count($data_log) ; $i++) { 
                $temp_stack .= "'{$data_log[$i]['Item']}',";
            }
            $temp_stack = substr($temp_stack,0,strlen($temp_stack)-1).")";
            $sql = "SELECT * FROM borrowandreturn WHERE ID IN {$temp_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_Item[$i] = $data -> fetch_assoc();
            }
            $book_stack = "(";
            for ($i=0; $i < count($data_Item) ; $i++) { 
                $book_stack .= "'{$data_Item[$i]['Book']}',";
            }
            $book_stack = substr($book_stack,0,strlen($book_stack)-1).")";
            $sql = "SELECT * FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID WHERE Barcode IN {$book_stack} AND Field IN ('245','020','022') ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_book[$i] = $data -> fetch_assoc();
            }
            $mem_stack = "(";
            for ($i=0; $i < count($data_Item) ; $i++) { 
                $mem_stack .= "'{$data_Item[$i]['Member']}',";
            }
            $mem_stack = substr($mem_stack,0,strlen($mem_stack)-1).")";
            $sql = "SELECT ID,FName,LName FROM member WHERE ID IN {$mem_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_mem[$i] = $data -> fetch_assoc();
            }
            $lib_stack = "(";
            for ($i=0; $i < count($data_Item) ; $i++) { 
                $lib_stack .= "'{$data_Item[$i]['Librarian']}',";
            }
            $lib_stack = substr($lib_stack,0,strlen($lib_stack)-1).")";
            $sql = "SELECT ID,FName,LName FROM librarian WHERE ID IN {$lib_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_lib[$i] = $data -> fetch_assoc();
            }
            foreach ($data_book as $i => $valuei) {
                if ($data_book[$i]['Field']=="245") {
                    $data_book_already_cut = calsub_arr($data_book[$i]['Subfield'],"245");
                    $data_book[$i]['Subfield'] = $data_book_already_cut['Title']['#a'];
                }
                if ($data_book[$i]['Field']=="022"||$data_book[$i]['Field']=="020") {
                    $data_book_already_cut = calsub_arr($data_book[$i]['Subfield'],"020");
                    $data_book[$i]['Subfield'] = $data_book_already_cut['ISBN']['#a'];
                }
            }

            for ($i=$start; $i < $num ; $i++) { 
                for ($j=0; $j < count($data_Item) ; $j++) { 
                    if ($data_log[$i]['Item']==$data_Item[$j]['ID']) {
                        $stack .= "<tr>";
                            $stack .= "<td>".$run++."</td>";
                            for ($k=0; $k < count($data_book) ; $k++) { 
                                if ($data_Item[$j]['Book']==$data_book[$k]['Barcode']&&$data_book[$k]['Field']=='245') {
                                    $stack .= "<td>{$data_book[$k]['Subfield']}</td>";
                                    break;
                                }
                            }
                            $check_ISBN =0;
                            for ($k=0; $k < count($data_book) ; $k++) { 
                                if ($data_Item[$j]['Book']==$data_book[$k]['Barcode']&&($data_book[$k]['Field']=='020'||$data_book[$k]['Field']=='022')) {
                                    $stack .= "<td>{$data_book[$k]['Subfield']}</td>";
                                    $check_ISBN =1;
                                    break;
                                }
                            }
                            if ($check_ISBN==0) {
                                $stack .= "<td> - </td>";
                            }
                            $stack .= "<td>".$data_log[$i]['Day']."</td>";
                            for ($k=0; $k < count($data_mem) ; $k++) { 
                                if ($data_Item[$j]['Member']==$data_mem[$k]['ID']) {
                                    $stack .= "<td>".$data_mem[$k]['FName']." ".$data_mem[$k]['LName']."</td>";
                                    break;
                                }
                            }
                            $check_lib=0;
                            for ($k=0; $k < count($data_lib) ; $k++) { 
                                if ($data_Item[$j]['Librarian']==$data_lib[$k]['ID']) {
                                    $stack .= "<td>".$data_lib[$k]['FName']." ".$data_lib[$k]['LName']."</td>";
                                    $check_lib=1;    
                                    break;
                                }
                            }
                            if ($check_lib==0) {
                                $stack .= "<td> - </td>";
                            }
                            $stack .= "<td>{$data_log[$i]['Sub']}</td>";
                        $stack .= "</tr>";
                        break;
                    }
                }
            }
            $stack .= "</table>";
            echo $stack;
        }
        else if ($logtype=="finebook") {
            $stack .= "<tr>";
                $stack .= "<th>ลำดับ</th>";
                $stack .= "<th>รายการทรัพยากร</th>";
                $stack .= "<th>ISBN</th>";
                $stack .= "<th>ประเภท</th>";
                $stack .= "<th>ค่าปรับ</th>";
                $stack .= "<th>เลขใบเสร็จ</th>";
                $stack .= "<th>วันที่</th>";
                $stack .= "<th>ผู้ใช้งาน</th>";
                $stack .= "<th>เจ้าหน้าที่</th>";
                $stack .= "<th>คำอธิบาย</th>";
            $stack .= "</tr>";
            $temp_stack = "(";
            for ($i=0; $i < count($data_log) ; $i++) { 
                $temp_stack .= "'{$data_log[$i]['Item']}',";
            }
            $temp_stack = substr($temp_stack,0,strlen($temp_stack)-1).")";
            $sql = "SELECT * FROM finebook WHERE Borrow_ID IN {$temp_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_fine[$i] = $data -> fetch_assoc();
            }
            $sql = "SELECT * FROM borrowandreturn WHERE ID IN {$temp_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_Item[$i] = $data -> fetch_assoc();
            }
            $book_stack = "(";
            for ($i=0; $i < count($data_Item) ; $i++) { 
                $book_stack .= "'{$data_Item[$i]['Book']}',";
            }
            $book_stack = substr($book_stack,0,strlen($book_stack)-1).")";
            $sql = "SELECT * FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID WHERE Barcode IN {$book_stack} AND Field IN ('245','020','022') ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_book[$i] = $data -> fetch_assoc();
            }
            $mem_stack = "(";
            for ($i=0; $i < count($data_Item) ; $i++) { 
                $mem_stack .= "'{$data_Item[$i]['Member']}',";
            }
            $mem_stack = substr($mem_stack,0,strlen($mem_stack)-1).")";
            $sql = "SELECT ID,FName,LName FROM member WHERE ID IN {$mem_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_mem[$i] = $data -> fetch_assoc();
            }
            $lib_stack = "(";
            for ($i=0; $i < count($data_Item) ; $i++) { 
                $lib_stack .= "'{$data_Item[$i]['Librarian']}',";
            }
            $lib_stack = substr($lib_stack,0,strlen($lib_stack)-1).")";
            $sql = "SELECT ID,FName,LName FROM librarian WHERE ID IN {$lib_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_lib[$i] = $data -> fetch_assoc();
            }
            foreach ($data_book as $i => $valuei) {
                if ($data_book[$i]['Field']=="245") {
                    $data_book_already_cut = calsub_arr($data_book[$i]['Subfield'],"245");
                    $data_book[$i]['Subfield'] = $data_book_already_cut['Title']['#a'];
                }
                if ($data_book[$i]['Field']=="022"||$data_book[$i]['Field']=="020") {
                    $data_book_already_cut = calsub_arr($data_book[$i]['Subfield'],"020");
                    $data_book[$i]['Subfield'] = $data_book_already_cut['ISBN']['#a'];
                }
            }
            // echo $num;
            for ($i=$start; $i < $num ; $i++) { 
                for ($j=0; $j < count($data_Item) ; $j++) { 
                    if ($data_log[$i]['Item']==$data_Item[$j]['ID']) {
                        $stack .= "<tr>";
                            $stack .= "<td>".$run++."</td>";
                            for ($k=0; $k < count($data_book) ; $k++) { 
                                if ($data_Item[$j]['Book']==$data_book[$k]['Barcode']&&$data_book[$k]['Field']=='245') {
                                    $stack .= "<td>{$data_book[$k]['Subfield']}</td>";
                                    break;
                                }
                            }
                            $check_ISBN =0;
                            for ($k=0; $k < count($data_book) ; $k++) { 
                                if ($data_Item[$j]['Book']==$data_book[$k]['Barcode']&&($data_book[$k]['Field']=='020'||$data_book[$k]['Field']=='022')) {
                                    $stack .= "<td>{$data_book[$k]['Subfield']}</td>";
                                    $check_ISBN =1;
                                    break;
                                }
                            }
                            if ($check_ISBN==0) {
                                $stack .= "<td> - </td>";
                            }
                            for ($k=0; $k < count($data_fine) ; $k++) { 
                                if ($data_Item[$j]['ID']==$data_fine[$k]['Borrow_ID']) {
                                    $stack .= "<td>{$data_fine[$k]['Type']}</td>";
                                    $stack .= "<td>{$data_fine[$k]['Amount']}</td>";
                                    $stack .= "<td>{$data_fine[$k]['receipt_NO']}</td>";
                                    break;
                                }
                            }
                            $stack .= "<td>".$data_log[$i]['Day']."</td>";
                            for ($k=0; $k < count($data_mem) ; $k++) { 
                                if ($data_Item[$j]['Member']==$data_mem[$k]['ID']) {
                                    $stack .= "<td>".$data_mem[$k]['FName']." ".$data_mem[$k]['LName']."</td>";
                                    break;
                                }
                            }
                            $check_lib=0;
                            for ($k=0; $k < count($data_lib) ; $k++) { 
                                if ($data_Item[$j]['Librarian']==$data_lib[$k]['ID']) {
                                    $stack .= "<td>".$data_lib[$k]['FName']." ".$data_lib[$k]['LName']."</td>";
                                    $check_lib=1;    
                                    break;
                                }
                            }
                            if ($check_lib==0) {
                                $stack .= "<td> - </td>";
                            }
                            $stack .= "<td>{$data_log[$i]['Sub']}</td>";
                        $stack .= "</tr>";
                        // break;
                    }
                }
            }
            $stack .= "</table>";
            echo $stack;
        }
        else if ($logtype=="buy") {
            $stack .= "<tr>";
                $stack .= "<th>ลำดับ</th>";
                $stack .= "<th>เลขรายการ</th>";
                $stack .= "<th>วันที่</th>";
                $stack .= "<th>เจ้าหน้าที่</th>";
                $stack .= "<th>คำอธิบาย</th>";
            $stack .= "</tr>";
            $temp_stack = "(";
            for ($i=0; $i < count($data_log) ; $i++) { 
                $temp_stack .= "'{$data_log[$i]['Item']}',";
            }
            $temp_stack = substr($temp_stack,0,strlen($temp_stack)-1).")";
            $sql = "SELECT * FROM buy WHERE ID IN {$temp_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_Item[$i] = $data -> fetch_assoc();
            }
            $lib_stack = "(";
            for ($i=0; $i < count($data_Item) ; $i++) { 
                $lib_stack .= "'{$data_Item[$i]['Librarian']}',";
            }
            $lib_stack = substr($lib_stack,0,strlen($lib_stack)-1).")";
            $sql = "SELECT ID,FName,LName FROM librarian WHERE ID IN {$lib_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_lib[$i] = $data -> fetch_assoc();
            }
            for ($i=$start; $i < $num ; $i++) { 
                for ($j=0; $j < count($data_Item) ; $j++) { 
                    if ($data_log[$i]['Item']==$data_Item[$j]['ID']) {
                        $stack .= "<tr>";
                            $stack .= "<td>".$run++."</td>";
                            $stack .= "<td>{$data_Item[$j]['ID']}</td>";
                            $stack .= "<td>".$data_log[$i]['Day']."</td>";
                            $check_lib=0;
                            for ($k=0; $k < count($data_lib) ; $k++) { 
                                if ($data_Item[$j]['Librarian']==$data_lib[$k]['ID']) {
                                    $stack .= "<td>".$data_lib[$k]['FName']." ".$data_lib[$k]['LName']."</td>";
                                    $check_lib=1;    
                                    break;
                                }
                            }
                            if ($check_lib==0) {
                                $stack .= "<td> - </td>";
                            }
                            $stack .= "<td>{$data_log[$i]['Sub']}</td>";
                        $stack .= "</tr>";
                        break;
                    }
                }
            }
            $stack .= "</table>";
            echo $stack;
        }
        else if ($logtype=="reservations") {
            $stack .= "<tr>";
                $stack .= "<th>ลำดับ</th>";
                $stack .= "<th>รายการทรัพยากร</th>";
                $stack .= "<th>ISBN</th>";
                $stack .= "<th>วันที่</th>";
                $stack .= "<th>ผู้ใช้งาน</th>";
                $stack .= "<th>เจ้าหน้าที่</th>";
                $stack .= "<th>คำอธิบาย</th>";
            $stack .= "</tr>";
            $temp_stack = "(";
            for ($i=0; $i < count($data_log) ; $i++) { 
                $temp_stack .= "'{$data_log[$i]['Item']}',";
            }
            $temp_stack = substr($temp_stack,0,strlen($temp_stack)-1).")";
            $sql = "SELECT * FROM reservations WHERE ID IN {$temp_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_Item[$i] = $data -> fetch_assoc();
            }
            $book_stack = "(";
            for ($i=0; $i < count($data_Item) ; $i++) { 
                $book_stack .= "'{$data_Item[$i]['Book']}',";
            }
            $book_stack = substr($book_stack,0,strlen($book_stack)-1).")";
            $sql = "SELECT * FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID WHERE Barcode IN {$book_stack} AND Field IN ('245','020','022') ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_book[$i] = $data -> fetch_assoc();
            }
            $mem_stack = "(";
            for ($i=0; $i < count($data_Item) ; $i++) { 
                $mem_stack .= "'{$data_Item[$i]['Member']}',";
            }
            $mem_stack = substr($mem_stack,0,strlen($mem_stack)-1).")";
            $sql = "SELECT ID,FName,LName FROM member WHERE ID IN {$mem_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_mem[$i] = $data -> fetch_assoc();
            }
            $lib_stack = "(";
            for ($i=0; $i < count($data_Item) ; $i++) { 
                $lib_stack .= "'{$data_Item[$i]['Member']}',";
            }
            $lib_stack = substr($lib_stack,0,strlen($lib_stack)-1).")";
            $sql = "SELECT ID,FName,LName FROM librarian WHERE ID IN {$lib_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_lib[$i] = $data -> fetch_assoc();
            }
            foreach ($data_book as $i => $valuei) {
                if ($data_book[$i]['Field']=="245") {
                    $data_book_already_cut = calsub_arr($data_book[$i]['Subfield'],"245");
                    $data_book[$i]['Subfield'] = $data_book_already_cut['Title']['#a'];
                }
                if ($data_book[$i]['Field']=="022"||$data_book[$i]['Field']=="020") {
                    $data_book_already_cut = calsub_arr($data_book[$i]['Subfield'],"020");
                    $data_book[$i]['Subfield'] = $data_book_already_cut['ISBN']['#a'];
                }
            }

            for ($i=$start; $i < $num ; $i++) { 
                for ($j=0; $j < count($data_Item) ; $j++) { 
                    if ($data_log[$i]['Item']==$data_Item[$j]['ID']) {
                        $stack .= "<tr>";
                            $stack .= "<td>".$run++."</td>";
                            for ($k=0; $k < count($data_book) ; $k++) { 
                                if ($data_Item[$j]['Book']==$data_book[$k]['Barcode']&&$data_book[$k]['Field']=='245') {
                                    $stack .= "<td>{$data_book[$k]['Subfield']}</td>";
                                    break;
                                }
                            }
                            $check_ISBN =0;
                            for ($k=0; $k < count($data_book) ; $k++) { 
                                if ($data_Item[$j]['Book']==$data_book[$k]['Barcode']&&($data_book[$k]['Field']=='020'||$data_book[$k]['Field']=='022')) {
                                    $stack .= "<td>{$data_book[$k]['Subfield']}</td>";
                                    $check_ISBN =1;
                                    break;
                                }
                            }
                            if ($check_ISBN==0) {
                                $stack .= "<td> - </td>";
                            }
                            $check_mem=0;
                            $stack .= "<td>".$data_log[$i]['Day']."</td>";
                            if (isset($data_mem)) {
                                for ($k=0; $k < count($data_mem) ; $k++) { 
                                    if ($data_Item[$j]['Member']==$data_mem[$k]['ID']) {
                                        $stack .= "<td>".$data_mem[$k]['FName']." ".$data_mem[$k]['LName']."</td>";
                                        $check_mem=1;
                                        break;
                                    }
                                }
                            }
                            if ($check_mem==0) {
                                $stack .= "<td> - </td>";
                            }
                            $check_lib=0;
                            if (isset($data_lib)) {
                                for ($k=0; $k < count($data_lib) ; $k++) { 
                                    if ($data_Item[$j]['Member']==$data_lib[$k]['ID']&&$check_mem==0) {
                                        $stack .= "<td>".$data_lib[$k]['FName']." ".$data_lib[$k]['LName']."</td>";
                                        $check_lib=1;    
                                        break;
                                    }
                                }
                            }
                            if ($check_lib==0) {
                                $stack .= "<td> - </td>";
                            }
                            $stack .= "<td>{$data_log[$i]['Sub']}</td>";
                        $stack .= "</tr>";
                        break;
                    }
                }
            }
            $stack .= "</table>";
            echo $stack;
        }
        else if ($logtype=="userstatus") {
            $stack .= "<tr>";
                $stack .= "<th>ลำดับ</th>";
                $stack .= "<th>ผู้ถูกแก้ไข</th>";
                $stack .= "<th>ผู้แก้ไข</th>";
                $stack .= "<th>วันที่</th>";
                $stack .= "<th>คำอธิบาย</th>";
            $stack .= "</tr>";
            $mem_stack = "(";
            for ($i=0; $i < count($data_log) ; $i++) { 
                $mem_stack .= "'{$data_log[$i]['Item']}',";
            }
            $mem_stack = substr($mem_stack,0,strlen($mem_stack)-1).")";
            $sql = "SELECT ID,FName,LName FROM member WHERE ID IN {$mem_stack} ";
            $data = $conn->query($sql);
            if (@mysqli_num_rows($data)!=0) {
                for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                    $data_mem[$i] = $data -> fetch_assoc();
                }
            }
            $lib_stack = "(";
            for ($i=0; $i < count($data_log) ; $i++) { 
                $lib_stack .= "'{$data_log[$i]['Item']}',";
            }
            for ($i=0; $i < count($data_log) ; $i++) { 
                $lib_stack .= "'{$data_log[$i]['Librarian']}',";
            }
            $lib_stack = substr($lib_stack,0,strlen($lib_stack)-1).")";
            $sql = "SELECT ID,FName,LName FROM librarian WHERE ID IN {$lib_stack} ";
            $data = $conn->query($sql);
            if (@mysqli_num_rows($data)!=0) {
                for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                    $data_lib[$i] = $data -> fetch_assoc();
                }
            }

            for ($i=$start; $i < $num ; $i++) { 
                $stack .= "<tr>";
                    $stack .= "<td>".$run++."</td>";
                    $check_mem=0;
                    for ($k=0; $k < count($data_mem) ; $k++) { 
                        if ($data_log[$i]['Item']==$data_mem[$k]['ID']) {
                            $stack .= "<td>".$data_mem[$k]['FName']." ".$data_mem[$k]['LName']."</td>";
                            $check_mem=1;
                            break;
                        }
                    }
                    if ($check_mem==0) {
                        for ($k=0; $k < count($data_lib) ; $k++) { 
                            if ($data_log[$i]['Item']==$data_lib[$k]['ID']) {
                                $stack .= "<td>".$data_lib[$k]['FName']." ".$data_lib[$k]['LName']."</td>";
                                $check_mem=1;
                                break;
                            }
                        }
                    }
                    $check_lib=0;
                    for ($k=0; $k < count($data_lib) ; $k++) { 
                        if ($data_log[$i]['Librarian']==$data_lib[$k]['ID']) {
                            $stack .= "<td>".$data_lib[$k]['FName']." ".$data_lib[$k]['LName']."</td>";
                            $check_lib=1;    
                            break;
                        }
                    }
                    if ($check_lib==0) {
                        $stack .= "<td> - </td>";
                    }
                    $stack .= "<td>".$data_log[$i]['Day']."</td>";
                    $stack .= "<td>{$data_log[$i]['Sub']}</td>";
                $stack .= "</tr>";
                break;
            }
            $stack .= "</table>";
            echo $stack;
        }
        else if ($logtype=="databib") {
            $stack .= "<tr>";
                $stack .= "<th>ลำดับ</th>";
                $stack .= "<th>รายการทรัพยากร</th>";
                $stack .= "<th>ISBN</th>";
                $stack .= "<th>วันที่</th>";
                $stack .= "<th>เจ้าหน้าที่</th>";
                $stack .= "<th>คำอธิบาย</th>";
            $stack .= "</tr>";
            $book_stack = "(";
            for ($i=0; $i < count($data_log) ; $i++) { 
                $book_stack .= "'{$data_log[$i]['Item']}',";
            }
            $book_stack = substr($book_stack,0,strlen($book_stack)-1).")";
            $sql = "SELECT * FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID WHERE databib_item.Bib_ID IN {$book_stack} AND Field IN ('245','020','022') ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_book[$i] = $data -> fetch_assoc();
            }
            
            $lib_stack = "(";
            for ($i=0; $i < count($data_log) ; $i++) { 
                $lib_stack .= "'{$data_log[$i]['Librarian']}',";
            }
            $lib_stack = substr($lib_stack,0,strlen($lib_stack)-1).")";
            $sql = "SELECT ID,FName,LName FROM librarian WHERE ID IN {$lib_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_lib[$i] = $data -> fetch_assoc();
            }
            
            foreach ($data_book as $i => $valuei) {
                if ($data_book[$i]['Field']=="245") {
                    $data_book_already_cut = calsub_arr($data_book[$i]['Subfield'],"245");
                    $data_book[$i]['Subfield'] = $data_book_already_cut['Title']['#a'];
                }
                if ($data_book[$i]['Field']=="022"||$data_book[$i]['Field']=="020") {
                    $data_book_already_cut = calsub_arr($data_book[$i]['Subfield'],"020");
                    $data_book[$i]['Subfield'] = $data_book_already_cut['ISBN']['#a'];
                }
            }
//             echo "<pre>";
//             print_r($data_log);
//             print_r($data_book);
//  echo "</pre>";
// echo $num;
            for ($i=$start; $i < $num ; $i++) { 
                $stack .= "<tr>";
                    $stack .= "<td>".$run++."</td>";
                    for ($k=0; $k < count($data_book) ; $k++) { 
                        // echo "{$data_log[$i]['Item']}=={$data_book[$k]['Barcode']}&&{$data_book[$k]['Field']}=='245'";
                        if ($data_book[$k]['Field']=='245'&&($data_log[$i]['Item']==$data_book[$k]['Bib_ID']||$data_log[$i]['Item']==$data_book[$k]['Barcode'])) {
                            
                            $stack .= "<td>{$data_book[$k]['Subfield']}</td>";
                            break;
                        }
                    }
                    $check_ISBN =0;
                    for ($k=0; $k < count($data_book) ; $k++) { 
                        if (($data_book[$k]['Field']=='020'||$data_book[$k]['Field']=='022')&&($data_log[$i]['Item']==$data_book[$k]['Bib_ID']||$data_log[$i]['Item']==$data_book[$k]['Barcode'])) {
                            $stack .= "<td>{$data_book[$k]['Subfield']}</td>";
                            $check_ISBN =1;
                            break;
                        }
                    }
                    if ($check_ISBN==0) {
                        $stack .= "<td> - </td>";
                    }
                    $stack .= "<td>".$data_log[$i]['Day']."</td>";
                    $check_lib=0;
                    for ($k=0; $k < count($data_lib) ; $k++) { 
                        if ($data_log[$i]['Librarian']==$data_lib[$k]['ID']) {
                            $stack .= "<td>".$data_lib[$k]['FName']." ".$data_lib[$k]['LName']."</td>";
                            $check_lib=1;    
                            break;
                        }
                    }
                    if ($check_lib==0) {
                        $stack .= "<td> - </td>";
                    }
                    $stack .= "<td>{$data_log[$i]['Sub']}</td>";
                $stack .= "</tr>";
                // break;
            }
            $stack .= "</table>";
            echo $stack;
        }
        else if ($logtype=="field") {
            $stack .= "<tr>";
                $stack .= "<th>ลำดับ</th>";
                $stack .= "<th>รายการเขตข้อมูล</th>";
                $stack .= "<th>วันที่</th>";
                $stack .= "<th>เจ้าหน้าที่</th>";
                $stack .= "<th>คำอธิบาย</th>";
            $stack .= "</tr>";
            $lib_stack = "(";
            for ($i=0; $i < count($data_log) ; $i++) { 
                $lib_stack .= "'{$data_log[$i]['Librarian']}',";
            }
            $lib_stack = substr($lib_stack,0,strlen($lib_stack)-1).")";
            $sql = "SELECT ID,FName,LName FROM librarian WHERE ID IN {$lib_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_lib[$i] = $data -> fetch_assoc();
            }
            for ($i=$start; $i < $num ; $i++) { 
                $stack .= "<tr>";
                    $stack .= "<td>".$run++."</td>";
                    $stack .= "<td>{$data_log[$i]['Item']}</td>";
                    $stack .= "<td>".$data_log[$i]['Day']."</td>";
                    $check_lib=0;
                    for ($k=0; $k < count($data_lib) ; $k++) { 
                        if ($data_log[$i]['Librarian']==$data_lib[$k]['ID']) {
                            $stack .= "<td>".$data_lib[$k]['FName']." ".$data_lib[$k]['LName']."</td>";
                            $check_lib=1;    
                            break;
                        }
                    }
                    if ($check_lib==0) {
                        $stack .= "<td> - </td>";
                    }
                    $stack .= "<td>{$data_log[$i]['Sub']}</td>";
                $stack .= "</tr>";
                break;
            }
            $stack .= "</table>";
            echo $stack;
        }
        if ($logtype=="template") {
            $stack .= "<tr>";
                $stack .= "<th>ลำดับ</th>";
                $stack .= "<th>รายการระเบียน</th>";
                $stack .= "<th>วันที่</th>";
                $stack .= "<th>เจ้าหน้าที่</th>";
                $stack .= "<th>คำอธิบาย</th>";
            $stack .= "</tr>";
            $temp_stack = "(";
            for ($i=0; $i < count($data_log) ; $i++) { 
                $temp_stack .= "'{$data_log[$i]['Item']}',";
            }
            $temp_stack = substr($temp_stack,0,strlen($temp_stack)-1).")";
            $sql = "SELECT * FROM template WHERE ID IN {$temp_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_Item[$i] = $data -> fetch_assoc();
            }
            $lib_stack = "(";
            for ($i=0; $i < count($data_log) ; $i++) { 
                $lib_stack .= "'{$data_log[$i]['Librarian']}',";
            }
            $lib_stack = substr($lib_stack,0,strlen($lib_stack)-1).")";
            $sql = "SELECT ID,FName,LName FROM librarian WHERE ID IN {$lib_stack} ";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_lib[$i] = $data -> fetch_assoc();
            }
            for ($i=$start; $i < $num ; $i++) { 
                for ($j=0; $j < count($data_Item) ; $j++) { 
                    if ($data_log[$i]['Item']==$data_Item[$j]['ID']) {
                        $stack .= "<tr>";
                            $stack .= "<td>".$run++."</td>";
                            $stack .= "<td>{$data_Item[$j]['Name']}</td>";
                            $stack .= "<td>".$data_log[$i]['Day']."</td>";
                            $check_lib=0;
                            for ($k=0; $k < count($data_lib) ; $k++) { 
                                if ($data_log[$i]['Librarian']==$data_lib[$k]['ID']) {
                                    $stack .= "<td>".$data_lib[$k]['FName']." ".$data_lib[$k]['LName']."</td>";
                                    $check_lib=1;    
                                    break;
                                }
                            }
                            if ($check_lib==0) {
                                $stack .= "<td> - </td>";
                            }
                            $stack .= "<td>{$data_log[$i]['Sub']}</td>";
                        $stack .= "</tr>";
                        break;
                    }
                }
            }
            $stack .= "</table>";
            echo $stack;
        }

}
else{
    echo "  ไม่พบข้อมูล";
}
