<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
$ID1 = $_GET['Bibitem'];
$sql = "DELETE FROM listbuy WHERE ID='$ID1'";
  if (mysqli_query($conn, $sql) == true) {
        echo "<script>alert('ลบข้อมูลสำเร็จ');window.location='listbuy.php?&nPage=1&perPage=10'</script>";
       
    } else {
        echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
    }
    ?>