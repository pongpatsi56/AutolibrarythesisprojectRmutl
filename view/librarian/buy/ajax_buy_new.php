<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

$data_main = $_POST['data'];
$date = $_POST['date'];
// print_r($data_main);

function get_id($id,$conn){

    $date = date('Y-m-d H:i:s');

    $stack = "('buy','เพิ่มรายการซื้อ','".$id."','$date','".$_SESSION['user_status']['ID']."')";

    $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";

    mysqli_query($conn,$sql_log);

    // echo $sql_log;

}

$sql_ID = "SELECT max(ID) as ID FROM buy ";
$data_ID = $conn->query($sql_ID);
$ID = $data_ID->fetch_assoc();
$ID = $ID['ID'] + 1;

$sql_buy = "INSERT INTO buy(ID,Date_Add,Librarian) VALUES ('" . $ID . "','" . $date . "','{$_SESSION['user_status']['User_ID']}')";
mysqli_query($conn, $sql_buy);

$stack = "";
foreach ($data_main['main'] as $key1 => $value1) {
    $type = 1;
    $stack .= "('$ID','{$data_main['main'][$key1]['title']}','{$data_main['main'][$key1]['ISBN']}','{$data_main['main'][$key1]['price']}','{$data_main['main'][$key1]['books']}'),";
}
$stack = substr($stack, 0, strlen($stack) - 1);


$sql_buy_item = "INSERT INTO buy_item(Buy_ID,Title,ISBN,Price,Books) VALUES " . $stack;
// echo $sql_buy_item;
mysqli_query($conn, $sql_buy_item);

// $sql_ID_item = "SELECT Item_ID FROM buy_item WHERE Buy_ID = '$ID' AND Type = '2' ";
// $data_ID_item = $conn->query($sql_ID_item);
// for ($i = 0; $i < mysqli_num_rows($data_ID_item); $i++) {
//     $ID_item[$i] = $data_ID_item->fetch_assoc();
// }
// // print_r($sql_ID_item);
// // print_r($ID_item);
// if (isset($data_main['modal'])) {
//     $stack = "";
//     $z = 0;
//     foreach ($data_main['modal'] as $key1 => $value1) {
//         foreach ($data_main['modal'][$key1] as $key2 => $value2) {
//             $stack .= "('{$ID_item[$z]['Item_ID']}','{$data_main['modal'][$key1][$key2]['title']}','{$data_main['modal'][$key1][$key2]['author']}','{$data_main['modal'][$key1][$key2]['edition']}','{$data_main['modal'][$key1][$key2]['publisher']}','{$data_main['modal'][$key1][$key2]['books']}'),";
//         }
//         $z++;
//     }
//     $stack = substr($stack, 0, strlen($stack) - 1);

//     $sql_buy_item_set = "INSERT INTO buy_item_set(Item_ID,Title,Author,Edition,Publisher,Books) VALUES " . $stack;
//     // echo $sql_buy_item_set;
//     mysqli_query($conn, $sql_buy_item_set);
// }

    get_id($ID,$conn);



