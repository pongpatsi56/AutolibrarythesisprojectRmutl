    <?php  

        include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

        $sql="SELECT Name,ID FROM template ";
        $data = $conn->query($sql);
        $obj1 = [];
        $obj2 = [];
        $obj3 = [];

        for ($i=0; $i < mysqli_num_rows($data) ; $i++) {
            $data_temp[$i] = $data->fetch_assoc();
        }
        for ($i=0; $i < count($data_temp) ; $i++) { 
            array_push($obj1,$data_temp[$i]['ID']);
            array_push($obj2,$data_temp[$i]['Name']);
        }

        array_push($obj3,$obj1);
        array_push($obj3,$obj2);

        echo json_encode($obj3);
    ?>