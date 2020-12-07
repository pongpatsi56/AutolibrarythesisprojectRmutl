<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
session_start();
function get_id($book,$conn){

    $data_id = [];
    $run = 0;
    $date = date('Y-m-d H:i:s');

    $stack = "(";
    foreach($book as $data){
        $stack .= "'$data',";
    }
    $stack = substr($stack,0,strlen($stack)-1);
    $stack .= ")";

    $sql_id = "SELECT ID FROM borrowandreturn WHERE Borrow = (SELECT max(Borrow) FROM borrowandreturn) AND Book IN $stack";
    $data = $conn->query($sql_id);
    for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
        $data_id[$i] = $data->fetch_assoc();
    }

    $stack = "";
    foreach($book as $data){
        $stack .= "('borrowandreturn','ยืม','".$data_id[$run]['ID']."','$date','".$_SESSION['user_status']['ID']."'),";
        $run++;
    }
    $stack = substr($stack,0,strlen($stack)-1);

    $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";


    mysqli_query($conn,$sql_log);

}


$book = json_decode(stripslashes($_POST['data']));
$member = $_POST['member'];
$username = $_POST['username'];
$date = date('Y-m-d');
$date1 = new DateTime('+7 day');
$n_date = $date1->format('Y-m-d');

print_r($book);
print_r($member);

$stack = "";

foreach($book as $data){
    $stack .= "('$username','{$member['ID']}','$data','$date','$n_date'),";
}
$stack = substr($stack,0,strlen($stack)-1);

$sql  = "INSERT INTO borrowandreturn(Librarian,Member,Book,Borrow,Returns) VALUES".$stack;
  

$stack = "";
$stack .= "(";
foreach($book as $data){
    $stack .= "'$data',";
}
$stack = substr($stack,0,strlen($stack)-1);
$stack .= ")";

$sql2 = "UPDATE rfidandstatus SET Status = 1 WHERE Barcode IN ".$stack;
print_r($sql2);


if (mysqli_query($conn,$sql)==TRUE) {
    if (mysqli_query($conn,$sql2)==TRUE) {
        get_id($book,$conn);
    }
}

?>