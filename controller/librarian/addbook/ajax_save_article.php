   
   <?php 

        session_start();
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

        $data_main = $_POST['data']; 
        $Bib_ID = $_POST['Bib_ID']; 


        function get_id($ID,$conn){

            $date = date('Y-m-d H:i:s');
        
            $stack = "('databib','เพิ่มบทความ','".$ID."','$date','".$_SESSION['user_status']['ID']."')";
        
            $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";
        
            if (mysqli_query($conn,$sql_log)==TRUE) {
                echo "1";
            }
            else{
                echo "0";
            }
            
        }
        
        $arrayName = array('field' => 961,'inc1' => "",'inc2' => "",'sub' => "0" );
        array_push($data_main,$arrayName);
        $arrayName = array('field' => 962,'inc1' => "",'inc2' => "",'sub' => "" );
        array_push($data_main,$arrayName);

        // print_r($data_main);
        
        $sql = "SELECT max(ID) as ID FROM databib_article ";
        $data = $conn->query($sql);
        $ID = $data->fetch_assoc();

        $ID = $ID['ID']+1;

        if (strlen($ID)!=3) {
            for ($i=strlen($ID); $i < 3 ; $i++) { 
                $ID = '0'.$ID;
            }
        }


        $stack = "";
        for ($i=0; $i < count($data_main) ; $i++) { 
            $stack .= "('".$ID."','".$Bib_ID."','".$data_main[$i]['field']."','".$data_main[$i]['inc1']."','".$data_main[$i]['inc2']."','".$data_main[$i]['sub']."'),";
        }
        $stack = substr($stack,0,strlen($stack)-1);

        $sql = "INSERT INTO databib_article(`ID`,`Bib_ID`,`Field`,`Indicator1`,`Indicator2`,`Subfield`) VALUES $stack ";

        if (mysqli_query($conn,$sql)==TRUE) {
            get_id($ID,$conn);
        }
        else{
            echo $sql;
        }


    ?>