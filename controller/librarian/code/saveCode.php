<?php

include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

function get_id($field,$conn){

    $date = date('Y-m-d H:i:s');

    $stack = "('field','เพิ่มเขตข้อมูล','".$field."','$date','".$_SESSION['user_status']['ID']."')";

    $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";

    mysqli_query($conn,$sql_log);

}

$data_main = $_POST['data']; 


$sql_field = "INSERT INTO field(Field,Name) VALUES ('{$data_main[0][0]}','{$data_main[0][1]}') ";
$conn->query($sql_field);

if (isset($data_main[1])) {
    $stack = "";
    for ($i=0; $i < count($data_main[1]) ; $i++) { 
        $stack .= "('".$data_main[0][0]."','".$data_main[1][$i][0]."','".$data_main[1][$i][1]."','".$data_main[1][$i][2]."'),";
    }
    $numstr = strlen($stack)-1;
    $stack = substr("$stack",0,$numstr);

    $sql_inc = "INSERT INTO indicator (Field,Code,Description,`Order`) VALUES $stack ";
    $conn->query($sql_inc);
}

if (isset($data_main[2])) {
    $stack = "";
    for ($i=0; $i < count($data_main[2]) ; $i++) { 
        $stack .= "('".$data_main[0][0]."','".$data_main[2][$i][0]."','".$data_main[2][$i][1]."'),";
    }
    $numstr = strlen($stack)-1;
    $stack = substr("$stack",0,$numstr);

    $sql_sub = "INSERT INTO subfield (Field,Code,Name_Eng) VALUES $stack ";
    $conn->query($sql_sub);
}

get_id($data_main[0][0],$conn);


?> 