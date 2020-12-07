<?php

include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";


// for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
//     $sub[] = $data->fetch_assoc();
// }
// for ($i=0; $i <count($sub) ; $i++) { 
//     if (substr($sub[$i]['Subfield'],0,1)=='#') {
//         $sub[$i] = str_replace("#","/#",$sub[$i]);
//         $sub[$i]['Subfield'] = substr($sub[$i]['Subfield'],1,strlen($sub[$i]['Subfield']));
//         $sub[$i] = str_replace("//","/",$sub[$i]);
//     }
// }
// echo "<pre>";
// print_r($sub);
// echo "</pre>";
// $sql = "SELECT ID FROM databib";
// $data = $conn->query($sql);
// for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
//     $id[] = $data->fetch_assoc();
// }
// echo "<pre>";
// print_r($id);
// echo "</pre>";
// for ($i=0; $i < count($sub) ; $i++) { 
//     $sql = "UPDATE databib SET Subfield = '{$sub[$i]['Subfield']}' WHERE ID = '$i' ";
//     echo $sql;
//     echo "<br>";
//         $conn->query($sql);
// }


$sql = "SELECT * FROM databib WHERE  Subfield LIKE '%%' ";

$data = querydata($sql);

echo "<pre>";
print_r($data);
echo "</pre>";

?>