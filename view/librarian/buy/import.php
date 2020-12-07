<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    mysqli_set_charset($conn,"utf8");
    function get_id($id,$conn){

        $date = date('Y-m-d H:i:s');
    
        $stack = "('buy','เพิ่มรายการซื้อ','".$id."','$date','".$_SESSION['user_status']['ID']."')";
    
        $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";
    
        mysqli_query($conn,$sql_log);
    
        // echo $sql_log;
    
    }
if(!empty($_FILES["book_file"]["name"]))  
 {
    $allowed_ext = array("csv");  
    $tmp = explode(".", $_FILES["book_file"]["name"]);
    $extension = end($tmp);
    if(in_array($extension, $allowed_ext))  
    {  
        $file_data = fopen($_FILES["book_file"]["tmp_name"], 'r');  
        fgetcsv($file_data);  
        $sql_ID = "SELECT max(ID) as ID FROM buy ";
        $data_ID = $conn->query($sql_ID);
        $ID = $data_ID->fetch_assoc();
        $ID = $ID['ID'] + 1;
        $stack = "";
         while($row = fgetcsv($file_data))  
         {  
              $title = mysqli_real_escape_string($conn, iconv('TIS-620','UTF-8', $row[0]));  
              $isbn  = mysqli_real_escape_string($conn, iconv('TIS-620','UTF-8', $row[1]));  
              $price = mysqli_real_escape_string($conn, iconv('TIS-620','UTF-8', $row[2]));  
              $books = mysqli_real_escape_string($conn, iconv('TIS-620','UTF-8', $row[3]));  
              $stack .= "('$ID','$title', '$isbn', '$price', '$books'),";  
         }  
         $sql_buy = "INSERT INTO buy(ID,Date_Add,Librarian) VALUES ('" . $ID . "','" . $_POST['date'] . "','{$_SESSION['user_status']['User_ID']}')";
            mysqli_query($conn, $sql_buy);
            // echo $sql_buy;

         $stack = substr($stack,0,strlen($stack)-1);
         $sql = "INSERT INTO buy_item (Buy_ID,Title,ISBN,Price,Books) VALUES $stack ";
         mysqli_query($conn, $sql);
        //  echo $sql;
         get_id($ID,$conn);
    }
}

?>