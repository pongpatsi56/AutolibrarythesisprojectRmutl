<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";

    $bib_id = $_POST['val'];

    $sql = "SELECT * FROM databib_item WHERE Bib_ID = '{$bib_id}'" ;
    $data = $conn->query($sql);
    for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
        $data_item[$i] = $data->fetch_assoc();
    }
    $sql = "SELECT * FROM databib_article WHERE Bib_ID = '{$bib_id}'" ;
    $data = $conn->query($sql);
    if (mysqli_num_rows($data)!=0) {
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $temp_article[$i] = $data->fetch_assoc();
        }
        $temp_id = [];
        $temp_Bib_ID = [];
        for ($i=0; $i < count($temp_article) ; $i++) { 
            if (count($temp_id)!=0) {
                 // for ($j=0; $j < count($temp_Bib_ID) ; $j++) { 
                    if (!in_array($temp_article[$i]['ID'], $temp_id)) {
                        array_push($temp_id,$temp_article[$i]['ID']);
                        // break;
                    }
                // }
            }
            else {
                array_push($temp_id,$temp_article[$i]['ID']);
            }
            // if (count($temp_Bib_ID)!=0) {
            //     // for ($j=0; $j < count($temp_Bib_ID) ; $j++) { 
            //         if (!in_array($temp_article[$i]['Bib_ID'], $temp_Bib_ID)) {
            //             array_push($temp_Bib_ID,$temp_article[$i]['Bib_ID']);
            //             // break;
            //         }
            //     // }
            // }
            // else {
            //     array_push($temp_Bib_ID,$temp_article[$i]['Bib_ID']);
            // }
        }
        $pos_run = 0;
        $keep_same = null;
    // echo JSON_ENCODE($temp_id);

        for ($i=0; $i < count($temp_article) ; $i++) { 
            // for ($j=0; $j < count($temp_Bib_ID) ; $j++) { 
            //    if ($temp_article[$i]['Bib_ID']==$temp_Bib_ID[$j]) {

                for ($k=0; $k < count($temp_id) ; $k++) { 
                    if ($temp_article[$i]['ID']==$temp_id[$k]) {
                        if ($keep_same==null) {
                            $keep_same=$temp_id[$k];
                        }
                        else {
                            if ($keep_same!=$temp_id[$k]) {
                                $pos_run = 0;
                                $keep_same=$temp_id[$k];
                            }
                        }
                        $data_article[$temp_article[$i]['Bib_ID']][$temp_id[$k]][$pos_run] = ['field'=>$temp_article[$i]['Field'],'inc1'=>$temp_article[$i]['Indicator1'],'inc2'=>$temp_article[$i]['Indicator2'],'sub'=>$temp_article[$i]['Subfield']];
                        if ($data_article[$temp_article[$i]['Bib_ID']][$temp_id[$k]][$pos_run]['field'] == '245') {
                            $data_main_already_cut = calsub_arr($data_article[$temp_article[$i]['Bib_ID']][$temp_id[$k]][$pos_run]['sub'],'245');
                            $data_article[$temp_article[$i]['Bib_ID']][$temp_id[$k]][$pos_run]['sub'] = $data_main_already_cut['Title']['#a'];
                        }
                        if ($data_article[$temp_article[$i]['Bib_ID']][$temp_id[$k]][$pos_run]['field'] == '773') {
                            $data_main_already_cut = calsub_arr($data_article[$temp_article[$i]['Bib_ID']][$temp_id[$k]][$pos_run]['sub'],'773');
                            $data_article[$temp_article[$i]['Bib_ID']][$temp_id[$k]][$pos_run]['sub'] = $data_main_already_cut['Page']['#g'];
                        }
                        $pos_run++;
                    }
                 }
            //    }
            // }
        }
    }
    else {
        $data_article = null;
    }
    
    $data_all = ['item'=>$data_item,'article'=>$data_article];

    // print_r($data_all);
    echo JSON_ENCODE($data_all);

?>