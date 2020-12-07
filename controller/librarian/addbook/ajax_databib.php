<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

    $bib_id = $_POST['val'];


    $sql = "SELECT * FROM databib WHERE Bib_ID = '{$bib_id}' ORDER BY Field ASC";
    $data = $conn->query($sql);
    for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
        $data_marc[$i] = $data->fetch_assoc();
    }

    for ($i=0; $i < count($data_marc) ; $i++) { 
        $data_main[$data_marc[$i]['Field']] = ['inc1'=>$data_marc[$i]['Indicator1'],'inc2'=>$data_marc[$i]['Indicator2'],'sub'=>$data_marc[$i]['Subfield']];
    }

    // print_r($data_main);
    echo JSON_ENCODE($data_main);



?>