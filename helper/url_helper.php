<?php 
if(!session_id()){session_start();};
    $url = explode("/",$_SERVER['REQUEST_URI']);
    $url = count($url)-3;
    $url_path = "";
    for ($i=0; $i < $url; $i++) { 
        $url_path .= "../";
}

?>