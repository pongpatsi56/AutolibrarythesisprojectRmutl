    <?php

        session_start();

        include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

        $field = $_POST['all_code'];
        $inc1 = $_POST['all_inc1'];
        $inc2 = $_POST['all_inc2'];
        $sub = $_POST['all_sub'];
        $id = $_POST['id'];

        function get_id($id,$conn){
    
            $date = date('Y-m-d H:i:s');
    
            $stack = "('databib','แก้ไขทรัพยากร','".$id."','$date','".$_SESSION['user_status']['ID']."')";
    
            $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";
    
            mysqli_query($conn,$sql_log);
    
        }
        
        // $sql = "SELECT Barcode FROM databib_item WHERE Bib_ID = '{$id}'";
        //  $data_bar = $conn->query($sql);
        //  $barcode = $data_bar->fetch_assoc();


        $sql = "DELETE FROM databib WHERE Bib_ID = {'$id'} ";
        // echo $sql;

        $conn->query($sql);

        $stack = "";
        for ($i=0; $i < count($field) ; $i++) { 
            if ($inc1[$i]=="") {
                $inc1[$i]=null;
            }
            if ($inc2[$i]=="") {
                $inc2[$i]=null;
            }
            $stack .= "('".$field[$i]."','".$inc1[$i]."','".$inc2[$i]."','".$sub[$i]."','".$id."'),";
        }
        $stack = substr($stack,0,strlen($stack)-1);

        $sql = "INSERT INTO databib(Field,Indicator1,Indicator2,Subfield,Bib_ID) VALUES {$stack} ";
        // echo $sql;
        $conn->query($sql);

        get_id($id,$conn)


    ?>