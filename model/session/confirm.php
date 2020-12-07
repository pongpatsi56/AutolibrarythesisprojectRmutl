<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

date_default_timezone_set('asia/bangkok');
$date_now = date('Y-m-d H:i:s');
$userid = $_POST['id'];
$data = $_POST['datacart'];
// foreach ($data as $key => $value) {
//     echo $value;
// }
// exit;
//////////check ISBN//////////
// $stack_chk = '';
// $r = 0;
// foreach ($_SESSION['ISBN_Cart'] as $_key => $value) {
//     $stack_chk .= " OR ISBN = $value";
// }
// $_numstack_chk = strlen($stack_chk);
// $_numstack_chk = $_numstack_chk - 3;
// $stack_chk = substr($stack_chk, 3, $_numstack_chk);

// $get_cart = current($_SESSION['ISBN_Cart']);
// $sql_chk = "SELECT * FROM databibliography WHERE Status = 0 AND$stack_chk";
// $result = mysqli_query($conn, $sql_chk);
// if ($result && $result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         if ($row['ISBN'] == $get_cart) {
//             $keep_stack[$r] = $row['ISBN'];
//             $get_cart = next($_SESSION['ISBN_Cart']);
//             //echo $keep_stack[$r];
//             $r++;
//         }
//     }
// }
//////////SAVE to DB//////////
$stack = '';
$stacklog = '';
foreach ($data as $key => $value) {
    $bcode = $value['barcode'];
    $reciv = $value['reciv'];
    $stack .= "(NULL,'$userid','$bcode','$date_now','$reciv','0'),";
    $stacklog .= "('reservations','จอง','$bcode','$date_now','$userid'),";
}
$_numstack = strlen($stack);
$_numstack = $_numstack - 1;
$stack = substr($stack, 0, $_numstack);
//////////SAVELOG//////////
$_numstacklog = strlen($stacklog);
$_numstacklog = $_numstacklog - 1;
$stacklog = substr($stacklog, 0, $_numstacklog);

$sql = "INSERT INTO reservations (ID,Member, Book, Date_Reserv, Receive, IsDeleteorCancel) VALUES $stack";

if(mysqli_query($conn, $sql) === true){
mysqli_query($conn,"INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stacklog");
echo "บันทึกข้อมูลสำเร็จ";
unset($_SESSION['BC_Cart']);
unset($_SESSION['btn']);    
}else{
    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้";
}


//if (mysqli_query($conn, $sql)) {
//    mysqli_query($conn,"INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stacklog");
//    echo "บันทึกข้อมูลสำเร็จ";
//   unset($_SESSION['BC_Cart']);
//    unset($_SESSION['btn']);
//} else {
//    echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้";
//}
