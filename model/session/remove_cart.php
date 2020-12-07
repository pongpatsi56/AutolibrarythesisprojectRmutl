<?php
session_start();

$ident = $_POST['ident'];

$_SESSION["btn"][$ident] = 0;

foreach ($_SESSION['BC_Cart'] as $key => $value) {

	if ($ident ==  $value['barcode']) {
		unset($_SESSION['BC_Cart'][$key]);
	}
}


//  header("location:/lib/view/search/main.php");
echo 'SUCCESS';
