<?php
include "../../include/connect.php";

$getdata = mysqli_query($conn,"SELECT * FROM databibliography");
echo '<pre>';
if (mysqli_num_rows($getdata) != 0) {
    while($row = mysqli_fetch_assoc($getdata)){
        print_r($row);
    }
}

