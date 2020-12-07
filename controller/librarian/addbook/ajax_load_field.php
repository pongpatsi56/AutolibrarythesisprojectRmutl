    <?php 

        include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

        $field = $_POST['field'];

        $special_field = ['001','003','005','008','Leader'];

        if (in_array($field,$special_field)) {
            echo $field;
        }
        else {
            $sql = "SELECT * FROM subfield WHERE Field = $field ";
            $data = $conn->query($sql);
            $data_field = [];
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                array_push($data_field,$data->fetch_assoc());
            }

            $sql = "SELECT * FROM indicator WHERE Field = $field ";
            $data = $conn->query($sql);
            $data_inc = [];
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                array_push($data_inc,$data->fetch_assoc());
            }

            $data = [];
            array_push($data,$data_field);
            array_push($data,$data_inc);

            echo json_encode($data);
        }
        

    ?>