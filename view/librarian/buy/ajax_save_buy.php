<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php"; 

    $data_main = $_POST['data_main'];
    $id = $_POST['id'];

    function get_id($id,$conn){
    
        $date = date('Y-m-d H:i:s');

        $stack = "('buy','แก้ไขรายการซื้อ','".$id."','$date','".$_SESSION['user_status']['ID']."')";

        $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";

        mysqli_query($conn,$sql_log);

    }

    // $sql_item = "SELECT Item_ID FROM buy_item WHERE Buy_ID = $id AND Type = '2' ";
    // $data = $conn->query($sql_item);
    // for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
    //     $data_item[$i]=$data->fetch_assoc();
    // }

    // $stack = "(";
    // for ($i=0; $i < count($data_item) ; $i++) { 
    //     $stack .= "'".$data_item[$i]['Item_ID']."',";
    // }
    // $stack = substr($stack,0,strlen($stack)-1);
    // $stack .= ")";

    // $sql_del_set = "DELETE FROM buy_item_set WHERE Item_ID IN $stack ";
    // $conn->query($sql_del_set);

    $sql_del_item = "DELETE FROM buy_item WHERE Buy_ID = $id ";
    $conn->query($sql_del_item);

    $stack = "";
    foreach ($data_main['main'] as $key1 => $value1) {
        $type=1;
        // foreach ($data_main['modal'] as $key2 => $value2) {
        //     if ($key1==$key2) {
        //         $type=2;
        //     }
        // }
        $stack .= "('$id','{$data_main['main'][$key1]['Title']}','{$data_main['main'][$key1]['ISBN']}','{$data_main['main'][$key1]['Price']}','{$data_main['main'][$key1]['Books']}'),";
    }
    $stack = substr($stack,0,strlen($stack)-1);


    $sql_buy_item = "INSERT INTO buy_item(Buy_ID,Title,ISBN,Price,Books) VALUES ".$stack;
    mysqli_query($conn,$sql_buy_item);

    // $sql_ID_item = "SELECT Item_ID FROM buy_item WHERE Buy_ID = '$id' AND Type = '2' ";
    // $data_ID_item = $conn->query($sql_ID_item);
    // for ($i=0; $i < mysqli_num_rows($data_ID_item) ; $i++) { 
    //     $ID_item[$i] = $data_ID_item->fetch_assoc();
    // }

    // $stack = "";
    // $z=0;
    // foreach ($data_main['modal'] as $key1 => $value1) {
    //     foreach ($data_main['modal'][$key1] as $key2 => $value2) {
    //         $stack .= "('{$ID_item[$z]['Item_ID']}','{$data_main['modal'][$key1][$key2]['Title']}','{$data_main['modal'][$key1][$key2]['Author']}','{$data_main['modal'][$key1][$key2]['Edition']}','{$data_main['modal'][$key1][$key2]['Publisher']}','{$data_main['modal'][$key1][$key2]['Books']}'),";
    //     }
    //     $z++;
    // }
    // $stack = substr($stack,0,strlen($stack)-1);

    // $sql_buy_item_set = "INSERT INTO buy_item_set(Item_ID,Title,Author,Edition,Publisher,Books) VALUES ".$stack;
    // mysqli_query($conn,$sql_buy_item_set);

    get_id($id,$conn);

?>