<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    $date = $_POST['date'];
    $data_date = [];
    if ($date!=null||$date!="") {
        $date1 = new DateTime($date);
        $date1 = $date1->format('Y-m-d H:i:s');
    
        $date2 = new DateTime($date);
        $date2->add(new DateInterval('PT23H59M59S'));
        $date2 = $date2->format('Y-m-d H:i:s');
    
    
        $sql_date = "SELECT * FROM buy WHERE Date_Add BETWEEN '$date1' AND '$date2' ";
        $data = $conn->query($sql_date);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_date[$i] = $data->fetch_assoc();
        }
        if ($data_date!=null) {
            $stack = "(";
            for ($i=0; $i < count($data_date) ; $i++) { 
                $stack .= "'".$data_date[$i]['Librarian']."',";
            }
            $stack = substr($stack,0,strlen($stack)-1);
            $stack .= ")";
    
            $sql_lib = "SELECT ID,FName FROM librarian WHERE ID IN $stack ";
            $data = $conn->query($sql_lib);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_lib[$i] = $data->fetch_assoc();
            }
            
    
            for ($i=0; $i < count($data_date) ; $i++) { 
                for ($j=0; $j < count($data_lib) ; $j++) { 
                    if ($data_date[$i]['Librarian']==$data_lib[$j]['ID']) {
                        $data_date[$i]['Librarian']=$data_lib[$j]['FName'];
                    }
                }
            }
    
            echo json_encode($data_date);
        }
        else{
            $data_date = 1;
            echo $data_date;
        }
        
    }

    else {
        $data_date = 1;
        echo $data_date;
    }

 

?>