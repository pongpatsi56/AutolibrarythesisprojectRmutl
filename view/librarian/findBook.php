<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";

$key = $_GET["key"];
// $sql = "SELECT Field,Subfield FROM databib WHERE Field IN ('245','100','260') AND Barcode = $key ";
$sql = "SELECT * FROM databib WHERE Barcode = $key ";

$query = mysqli_query($conn,$sql);
$data = calsub_arr($query,[245,100,260]);


    // print_r($data);

    // $i=0;
    // $arrayData = array();

    // while ($result = $query->fetch_array()) {        
    //     $sub[$i][0] = $result['Field'];
    //     $sub[$i][1] = $result['Subfield'];
    //     $i++;
    // }
    

    // for ($i=0; $i < @count($sub) ; $i++) {
    //     if(@$sub[$i][0]==245){
    //         $sub[$i][1]=substr($sub[$i][1],3);
    //     }
    //     elseif (@$sub[$i][0]==100) {
    //         $sub[$i][1]=substr($sub[$i][1],3);
    
    //     }
    //     elseif (@$sub[$i][0]==260) {
    //       $cut = explode("/",$sub[$i][1]);
    //       for ($j=0; $j < count($cut) ; $j++) { 
    //         if (substr($cut[$j],0,2)=="#b") {
    //             $sub[$i][1]=substr($cut[$j],3);
    //         }
    //       }
    //     }
    //     array_push($arrayData,$sub[$i]);
    //   }

    
    echo json_encode($data);
    
?>
