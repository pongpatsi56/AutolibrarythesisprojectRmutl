<?php

    session_start();
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    function get_id($field,$conn){

        $date = date('Y-m-d H:i:s');
    
        $stack = "('field','แก้ไขเขตข้อมูล','".$field."','$date','".$_SESSION['user_status']['ID']."')";
    
        $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";
    
        mysqli_query($conn,$sql_log);
    
    }

    $data_main = $_POST['data'];


    $sql_field = "UPDATE field SET Name = '{$data_main[0][1]}' WHERE Field = '{$data_main[0][0]}'";
    $conn->query($sql_field);

    if (isset($data_main[1])) {
        $stack ="UPDATE indicator SET Description = CASE Code ";
        for ($i=0; $i < count($data_main[1]) ; $i++) { 
            $stack .= " WHEN '".$data_main[1][$i][0]."' THEN '" .$data_main[1][$i][1]."'";
        }
        $stack .=" ELSE Code END ";
        $stack .=" WHERE Field = '{$data_main[0][0]}' AND `Order` = '1' ";
        $sql_inc1 = $stack;
    $conn->query($sql_inc1);
    }

    if (isset($data_main[2])) {
        $stack ="UPDATE indicator SET Description = CASE Code ";
        for ($i=0; $i < count($data_main[2]) ; $i++) { 
            $stack .= " WHEN '".$data_main[2][$i][0]."' THEN '" .$data_main[2][$i][1]."'";
        }
        $stack .=" ELSE Code END ";
        $stack .=" WHERE Field = '{$data_main[0][0]}' AND `Order` = '2' ";
        $sql_inc2 = $stack;
    $conn->query($sql_inc2);
    }

    if (isset($data_main[3])) {
        $stack ="UPDATE subfield SET Name_Eng = CASE Code ";
        for ($i=0; $i < count($data_main[3]) ; $i++) { 
            $stack .= " WHEN '".$data_main[3][$i][0]."' THEN '" .$data_main[3][$i][1]."'";
        }
        $stack .=" ELSE Code END ";
        $stack .=" WHERE Field = '{$data_main[0][0]}' ";
        $sql_sub = $stack;
    $conn->query($sql_sub);
    }

    get_id($data_main[0][0],$conn);

?>
