<?php

include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

$field = $_POST['field'];

$sql = "SELECT * FROM subfield WHERE Field = $field ";
$data = $conn->query($sql);
for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
    $data_sub[$i] = $data->fetch_assoc();
}

echo json_encode($data_sub);

?>