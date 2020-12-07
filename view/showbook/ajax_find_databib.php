<?php

include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";

$Bib_ID = $_POST['Bib_ID'];

$sql = "SELECT Subfield FROM databib WHERE Field='962' AND Bib_ID = '{$Bib_ID}' ";
$data = $conn->query($sql);
$num = $data->fetch_assoc();

$num = $num['Subfield'] + 1;
$sql = "UPDATE databib SET Subfield = '{$num}' WHERE Field = '962' AND Bib_ID = '{$Bib_ID}' ";
$conn->query($sql);

$sql = "SELECT * FROM databib WHERE Bib_ID = '{$Bib_ID}' ";
$data = $conn->query($sql);
for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
    $obj_book[$i] = $data->fetch_assoc();
}

$sql = "SELECT * FROM databib_item WHERE Bib_ID = '{$Bib_ID}' ";
$data = $conn->query($sql);
for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
    $obj_barcode[$i] = $data->fetch_assoc();
}

$stack = "(";
for ($i=0; $i < count($obj_barcode) ; $i++) { 
    $stack .= "'{$obj_barcode[$i]['Barcode']}',";
}
$stack = substr($stack,0,strlen($stack)-1).")";

$sql = "SELECT * FROM rfidandstatus WHERE Barcode in {$stack} ";
$data = $conn->query($sql);
for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
    $obj_status[$i] = $data->fetch_assoc();
}
// print_r($data_book);

for ($i=0; $i < count($obj_book) ; $i++) { 
    if ($obj_book[$i]['Field']=='245') {
        $cut = calsub_arr($obj_book[$i]['Subfield'],'245');
        $obj_book[$i]['Subfield'] = $cut['Title']['#a'];
    }
    else if ($obj_book[$i]['Field']=='260') {
        $obj_book[$i]['Subfield'] = calsub_arr($obj_book[$i]['Subfield'],'260');
    }
    else if ($obj_book[$i]['Field']=='960') {
        $cut = calsub_arr($obj_book[$i]['Subfield'],'960');
        $obj_book[$i]['Subfield'] = $cut['Pic']['#a'];
    }
    else if ($obj_book[$i]['Field']=='964') {
        $cut = calsub_arr($obj_book[$i]['Subfield'],'964');
        $obj_book[$i]['Subfield'] = $cut['mattype'];
    }
    else if ($obj_book[$i]['Field']=='050') {
        $cut = calsub_arr($obj_book[$i]['Subfield'],'050');
        $obj_book[$i]['Subfield'] = $cut['0'];
    }
}

for ($i=0; $i < count($obj_book) ; $i++) { 
    $data_book[$obj_book[$i]['Field']] = ['inc1'=>$obj_book[$i]['Indicator1'],'inc2'=>$obj_book[$i]['Indicator2'],'sub'=>$obj_book[$i]['Subfield']];
}


$main_data = ['marc'=>$data_book,'barcode'=>$obj_barcode,'status'=>$obj_status];
// print_r($main_data);
echo json_encode($main_data);

?>