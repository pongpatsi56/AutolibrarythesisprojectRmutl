   
   <?php 

        session_start();
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

        $img = $_POST['img'];
        $data_main = $_POST['data']; 

        function get_id($Barcode,$conn){

            $date = date('Y-m-d H:i:s');
        
            $stack = "('databib','เพิ่มทรัพยากร','".$Barcode."','$date','".$_SESSION['user_status']['ID']."')";
        
            $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";
        
            mysqli_query($conn,$sql_log);
        
            echo $sql_log;
            
        }

        if ($img!="0") {
            $arrayName = array('field' => 960,'inc1' => "",'inc2' => "",'sub' => "#a=".trim($img) );
            array_push($data_main,$arrayName);
        }
        else{
            $arrayName = array('field' => 960,'inc1' => "",'inc2' => "",'sub' => "#a=" );
            array_push($data_main,$arrayName);
        }
        
        $arrayName = array('field' => 961,'inc1' => "",'inc2' => "",'sub' => "0" );
        array_push($data_main,$arrayName);
        $arrayName = array('field' => 962,'inc1' => "",'inc2' => "",'sub' => "" );
        array_push($data_main,$arrayName);

        print_r($data_main);
        
        $sql = "SELECT max(Bib_ID) as Bib_ID FROM databib ";
        $data = $conn->query($sql);
        $Bib_ID = $data->fetch_assoc();

        $Bib_ID = $Bib_ID['Bib_ID']+1;

        if (strlen($Bib_ID)!=3) {
            for ($i=strlen($Bib_ID); $i < 3 ; $i++) { 
                $Bib_ID = '0'.$Bib_ID;
            }
        }

        $date = date('dmy');
        $Barcode = '001'.$date.$Bib_ID;

        $sql_rfid = "INSERT INTO rfidandstatus(Barcode,Status,RFID) VALUES ('$Barcode','0','$Barcode')";

        $stack = "";
        for ($i=0; $i < count($data_main) ; $i++) { 
            $stack .= "('".$data_main[$i]['field']."','".$data_main[$i]['inc1']."','".$data_main[$i]['inc2']."','".$data_main[$i]['sub']."','".$Bib_ID."'),";
        }
        $stack = substr($stack,0,strlen($stack)-1);

        $sql_databib = "INSERT INTO databib(Field,Indicator1,Indicator2,Subfield,Bib_ID) VALUES $stack ";
        // echo $sql;
        $sql_databib_item = "INSERT INTO databib_item(Barcode,Bib_ID,Copy) VALUES ('{$Barcode}','{$Bib_ID}','1') ";

        if (mysqli_query($conn,$sql_rfid)==TRUE) {
            if (mysqli_query($conn,$sql_databib)==TRUE) {
                if (mysqli_query($conn,$sql_databib_item)==TRUE) {
                    get_id($Barcode,$conn);
                }
            }            
        }


    ?>