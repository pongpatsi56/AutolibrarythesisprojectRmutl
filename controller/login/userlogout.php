<?php
session_start();
if (isset($_SESSION['user_status'])) {
    session_destroy();
}
header("refresh: 1; url= /lib/view/login/login.php");
