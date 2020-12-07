<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/datehelper.php";
date_default_timezone_set('asia/bangkok');
$datetime_today = date_create(date('Y-m-d H:i:s'));
$datenow = $datetime_today->format('Y-m-d H:i:s');
$datetimes_tmr = new DateTime('+1 day');
$datetimes_reciv = $datetimes_tmr->format('Y-m-d');
$datereciv = convert_datethai_monthdot($datetimes_reciv);
if (isset($_POST['idmem'])) {
    $idmember = $_POST['idmem'];
    $data_mem_query = mysqli_query($conn, "SELECT * FROM member WHERE ID = '$idmember'");
    $data_mem = mysqli_fetch_assoc($data_mem_query);

    echo json_encode($data_mem);
}
if (isset($_POST['bcode'])) {
    $barcode = $_POST['bcode'];
    $databack = null;
    $no = 1;
    $str_stack = '';
    $data_reserv_query = mysqli_query($conn, "SELECT *,CONCAT(m.FName,' ',m.LName) AS FullName from reservations r LEFT JOIN member m ON  r.member = m.id WHERE r.book = '$barcode' AND r.IsDeleteorCancel = 0 AND r.Receive >= '$datenow' ORDER BY Date_Reserv ASC");
    $numrows =  mysqli_num_rows($data_reserv_query);
    if ($numrows != 0) {
        while ($data_reserv = mysqli_fetch_assoc($data_reserv_query)) {
            $str_stack .= '<tr>';
            $str_stack .= '<td>' . $no++ . '</td>';
            $str_stack .= '<td>' . $data_reserv['ID'] . '</td>';
            $str_stack .= '<td>' . $data_reserv['FullName'] . '</td>';
            $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $data_reserv['Date_Reserv']);
            $str_stack .= '<td>' . $datetime->format('d/m/Y - H:i:s') . '</td>';
            $str_stack .= '</tr>';
            $last_date = DateTime::createFromFormat('Y-m-d H:i:s', $data_reserv['Receive']);
        };
        $receive_date = $last_date->modify('+' . ($numrows * 7) . ' days');
        $receive_date_show = convert_datethai_monthdot($rcvdate = $receive_date->format('Y-m-d'));
        // $isresult = true;
    } else {
        $receive_date_show = $datereciv;
        $rcvdate = $datetimes_reciv;
        $str_stack = '<td>-</td><td>-</td><td>-</td><td>-</td>';
        // $isresult = false;
    }

    $data_book = querydata("SELECT * FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID WHERE Field = '245' AND Barcode = '$barcode'");
    if (count($data_book) == 0) {
        echo json_encode(false);
        exit;
    }
    foreach ($data_book as $key => $value) {
        $databook_back = array(
            // 'IsResult' => $isresult,
            'name' => $value['Title']['#a'] . ' / ' . $value['Author']['#a'],
            'type' => 'BOOK',
            'rcvdateshow' => $receive_date_show,
            'rcvdate' => $rcvdate,
            'datatable' => $str_stack
        );
        break;
    }
    //echo $datenow;
    echo json_encode($databook_back);
}
if (isset($_POST['id'])) {
    $datastack = array();
    $isRecord = 0;
    $get_idmem = $_POST['id'];
    $get_bcbook = $_POST['book'];
    $get_rsvt = $_POST['rsvt'];
    $get_reciv = $_POST['reciv'];

    $datetodiff = date_create($get_reciv);
    $diff = date_diff($datetime_today, $datetodiff);
    $result_diff = $diff->format("%R%a days");
    $data_reservation = mysqli_query($conn, "SELECT * FROM reservations WHERE Book = '$get_bcbook'  AND Receive >= '$get_reciv' AND IsDeleteorCancel = 0 ORDER BY Receive");
    if (mysqli_num_rows($data_reservation) > 1) {
        while ($result_rsvt = mysqli_fetch_assoc($data_reservation)) {
            if ($result_rsvt['Member'] == $get_idmem && $result_rsvt['Receive'] == $get_reciv) {
                $isRecord = 1;
            } elseif ($isRecord == 1) {
                $memid = $result_rsvt['Member'];
                $rcvday = date_format(date_modify(date_create($result_rsvt['Receive']), $result_diff), "Y-m-d H:i:s");
                mysqli_query($conn, "UPDATE reservations SET Receive = '$rcvday' WHERE Member = '$memid' AND Book = '$get_bcbook'");
            }
        }
    }
    //mysqli_query($conn, "UPDATE reservations SET IsDeleteorCancel = '1' WHERE Member = '$get_idmem' AND Book = '$get_bcbook'");
    if ($conn->query("UPDATE reservations SET IsDeleteorCancel = '1' WHERE Member = '$get_idmem' AND Book = '$get_bcbook'") === true) {
        mysqli_query($conn, "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES ('reservations','ยกเลิกการจอง','$get_bcbook','$datenow','$get_idmem')");
    }
    echo json_encode("สำเร็จ!");
}
