    <?php 

        include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

        $id = $_POST['data'];
        $temp = [];

        $sql = "SELECT * FROM temp_field WHERE Temp = $id ";
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_field[$i] = $data->fetch_assoc();
        }

        $sql = "SELECT * FROM temp_indicator WHERE Temp = $id ";
        $data = $conn->query($sql);
        if (mysqli_num_rows($data)!=0) {
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_inc[$i] = $data->fetch_assoc();
            }
        }
        else {
            $data_inc = null;
        }
        
        

        $sql = "SELECT * FROM temp_subfield WHERE Temp = $id ";
        $data = $conn->query($sql);
        if (mysqli_num_rows($data)!=0) {
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_sub[$i] = $data->fetch_assoc();
            }
        }
        else {
            $data_sub = null;
        }
        
        
        for ($i=0; $i <count($data_field) ; $i++) {
            if ($data_inc!=null) {
                for ($j=0; $j < count($data_inc) ; $j++) { 
                    if ($data_field[$i]['Field']==$data_inc[$j]['Field']) {
                        $temp[$data_field[$i]['Field']]['inc'][$data_inc[$j]['Order']] = $data_inc[$j]['Indicator'];
                    }
                }
            }
            if ($data_sub!=null) {
                for ($j=0; $j < count($data_sub) ; $j++) { 
                    if ($data_field[$i]['Field']==$data_sub[$j]['Field']) {
                        $temp[$data_field[$i]['Field']]['sub'] = $data_sub[$j]['Subfield'];
                    }
                }
            }
            if ($data_inc==null&&$data_sub==null) {
                // array_push($temp,$data_field[$i]['Field']);
                $temp[$data_field[$i]['Field']] = 0;
            }
        }
        // print_r($temp);
        echo json_encode($temp);



    ?>