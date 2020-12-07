<?php 
session_start();
unset($_SESSION['BC_Cart']);
unset($_SESSION['btn']);
echo "success";
// echo "<script>window.close();window.opener.location.reload();</script>";
