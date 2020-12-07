<?php

// $conn = mysqli_connect("localhost", "root", "");
$conn = mysqli_connect("databases.000webhost.com", "id9586454_autolibdemo", "QwxkqBz#pbGAmNv2oURQ", "id9586454_autolib");
// mysqli_select_db($conn, "id9586454_autolib");
mysqli_query($conn, "SET NAMES UTF8");

//////////////////////////////////////
$result = mysqli_query($conn, "SELECT * FROM member");
echo '<pre>';
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
}
