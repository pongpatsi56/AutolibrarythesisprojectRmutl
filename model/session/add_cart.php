<?php
session_start();
require_once "../../include/connect.php";

$ident = $_POST['ident'];
$title = $_POST['title'];
$author = $_POST['author'];
/////////เช็คการกดปุ่มaddมากกว่า1ครั้ง///////////////////////
foreach ($_SESSION["BC_Cart"] as $key => $value) {
	if ($ident == $value['barcode']) {
		exit;
	}
}
///////////////////////////////////////////////////////

///////////query หาวันที่ยืมได้ล่าสุด ////////////////////////////////////////////////
$data = mysqli_query($conn, "SELECT *, MAX(Receive) AS Receive FROM reservations WHERE Book = '$ident' AND IsDeleteorCancel = 0");
if (mysqli_num_rows($data) != 0) {
	$data = mysqli_fetch_assoc($data);
} else {
	$data = '';
}
////////////////////////////////////////////////////////////////////////////////

if (!isset($_SESSION["Run"])) {

	$_SESSION["Run"] = 0;
	$_SESSION["BC_Cart"][0] = array(
		'barcode' => $ident,
		'title' => $title,
		'author' => $author,
		'reciv' => isset($data['Receive']) ? $data['Receive'] : '-'
	);
	$_SESSION["btn"][$ident] = 1;

	//  header("location:/lib/view/search/main.php");
} else {

	$intNewLine = $_SESSION["Run"] + 1;
	$_SESSION["Run"] = $intNewLine;
	$_SESSION["BC_Cart"][$intNewLine] = array(
		'barcode' => $ident,
		'title' => $title,
		'author' => $author,
		'reciv' => isset($data['Receive']) ? $data['Receive'] : '-'
	);
	$_SESSION["btn"][$ident] = 1;
	//  header("location:/lib/view/search/main.php");

}

echo 'SUCCESS';
