<?php

function add_data($tag,$inc1,$inc2,$sub){

    $sql = "INSERT INTO databib(Field,Indicator1,Indicator2,Subfield,Barcode) VALUES";
    $q = "";
    for ($i=0; $i < count($tag) ; $i++) { 
       $q .= "('".$tag[$i]."','".$inc1[$i]."','".$inc2[$i]."','".$sub[$i]."',' '),";
    }
    $sql .= substr($q,0,strlen($q)-1);
    return $sql;

}



?>