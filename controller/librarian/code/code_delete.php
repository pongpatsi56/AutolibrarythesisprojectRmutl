<?php

    session_start();

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    function get_id($field,$conn){

        $date = date('Y-m-d H:i:s');

        $stack = "('field','ลบเขตข้อมูล','".$field."','$date','".$_SESSION['user_status']['ID']."')";

        $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";

        mysqli_query($conn,$sql_log);

    }

    $code = $_POST['code'];
    $sql1 = "DELETE FROM field WHERE Field = '$code'";
    $sql2 = "DELETE FROM indicator WHERE Field = '$code'";
    $sql3 = "DELETE FROM subfield WHERE Field = '$code'";
    $sql4 = "DELETE FROM temp_field WHERE Field = '$code'";
    $sql5 = "DELETE FROM temp_indicator WHERE Field = '$code'";
    $sql6 = "DELETE FROM temp_subfield WHERE Field = '$code'";



    $conn->query($sql1);
    $conn->query($sql2);
    $conn->query($sql3);
    $conn->query($sql4);
    $conn->query($sql5);
    $conn->query($sql6);


    get_id($code,$conn);

?>
