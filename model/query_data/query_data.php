<?php
	
	@session_start();
	$username = $_SESSION['Username'];
	$status = $_SESSION['Status'];
	$sql = "SELECT FName,LName,Username FROM $status WHERE Username = '$username' ";
    $q_data = $conn->query($sql); 

 ?>