<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    $id = $_POST['id'];
    $data_item = [];

    $sql_item = "SELECT * FROM buy_item WHERE Buy_ID = $id";
    $query_item = $conn->query($sql_item);
    for ($i=0; $i < mysqli_num_rows($query_item) ; $i++) { 
        $data_item[$i] = $query_item -> fetch_assoc();
    }
    echo json_encode(array('item'=>$data_item));


    // $stack = "(";
    // for ($i=0; $i < count($data_item) ; $i++) { 
    //     if ($data_item[$i]['Type']==2) {
    //        $stack .= "'".$data_item[$i]['Item_ID']."',";
    //     }
    // }
    // $stack = substr($stack,0,strlen($stack)-1);
    // $stack .= ")";

    // $sql_item_set = "SELECT * FROM buy_item_set WHERE Item_ID IN $stack";
    // $query_item_set = $conn->query($sql_item_set);
// echo $sql_item_set;
    // if (mysqli_num_rows($query_item_set)!=0) {
        // for ($i=0; $i < mysqli_num_rows($query_item_set) ; $i++) { 
        //     $data_item_set[$i] = $query_item_set -> fetch_assoc();
        // }
        // print_r(array('item'=>$data_item,'item_set'=>$data_item_set));
        // echo json_encode(array('item'=>$data_item,'item_set'=>$data_item_set));
    // }
    // else{
        // print_r(array('item'=>$data_item));
        // echo json_encode(array('item'=>$data_item));
    // }

    

?>