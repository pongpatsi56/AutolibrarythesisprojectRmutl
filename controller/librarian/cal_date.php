<?php

function daysInMonth($year, $month)
{ 
    return date("t", strtotime($year . "-" . $month . "-01")); 
}





function cal_date($f_date,$l_date){
    
    
    $ar_f = explode("-", $f_date);
    $ar_l = explode("-", $l_date);

    $cal_f = $ar_f;
    $cal_l = $ar_l;

    $diff_day = $ar_l[2] - $ar_f[2];
    if($diff_day < 0){
        

        $cal_l[1] = $cal_l[1]-1;

       $d_m_l = daysInMonth($cal_l[0],$cal_l[1]);

       $cal_l[2] = $diff_day + $d_m_l;

       $diff_m = $cal_l[1] - $cal_f[1];
        
        if($diff_m < 0){

            $cal_l[0] = $cal_l[0]-1;

            $cal_l[1] = $diff_m + 12;

            $diff_y = $cal_l[0] - $cal_f[0];

        }
        else{

            $cal_l[1] = $diff_m;

            $diff_y = $cal_l[0] - $cal_f[0];

        }

    }

    else{
       
        $cal_l[2] = $diff_day; 

        $diff_m = $cal_l[1] - $cal_f[1];

        if($diff_m < 0){

            $cal_l[0] = $cal_l[0]-1;

            $cal_l[1] = $diff_m + 12;

            $diff_y = $cal_l[0] - $cal_f[0];

        }
        else{

            $cal_l[1] = $diff_m;
            
            $diff_y = $cal_l[0] - $cal_f[0];

        }


    }


    echo($diff_y);
    echo("ปี");
    echo($cal_l[1]);
    echo("เดือน");
    echo($cal_l[2]);
    echo("วัน");

    $sum = 0;


}



?>