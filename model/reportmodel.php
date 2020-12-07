<?php
$root_url = $_SERVER['DOCUMENT_ROOT'];
// $condb = $root_url . "/lib/include/connect.php";
// include $condb;

function get_data_report($sql)
{
    //$dbconn = mysqli_connect("localhost","root","");
    // $dbconn = mysqli_connect("192.168.137.1:3306","root","1234");mysqli_select_db($dbconn, "autolib");
    //mysqli_query($dbconn,"SET NAMES UTF8");
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    $data = array();
    $num = 0;
    $result = mysqli_query($conn,$sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[$num] = $row;
            $num++;
        }
    }
    return $data;
}