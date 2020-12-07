<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

$file = $_SERVER['DOCUMENT_ROOT'] . "/lib/view/librarian/buy/buy_list.csv";
if(!file_exists($file)){ // file does not exist
    die('file not found');
} else {
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=buy_list.csv");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");

    // read the file from disk
    readfile($file);
}



