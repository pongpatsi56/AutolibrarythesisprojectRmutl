   
    <?php

        include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

        $val = $_POST['val'];
        $type = $_POST['type'];

        if ($type==1) {
            $sql = "SELECT * FROM member WHERE ID = '$val' ";   
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_member[$i] = $data->fetch_assoc();
            }
        }
        else if($type==2){
            $sql = "SELECT * FROM member WHERE ID LIKE '%$val%' 
                    OR FName LIKE '%$val%'  
                    OR LName LIKE '%$val%'
                    OR Faculty LIKE '%$val%'
                    OR Major LIKE '%$val%'
                    OR Email LIKE '%$val%'
                    OR Tel LIKE '%$val%'"; 
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_member[$i] = $data->fetch_assoc();
            }
        }
        if (isset($data_member)) {
            echo json_encode($data_member);
        }
        else{
            echo 1;
        }


    ?>