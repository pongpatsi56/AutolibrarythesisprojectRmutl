    <?php

        include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";
        

    // -----------------------------------------------------Newest--------------------------------------------------------
        $sql = "SELECT log.item,max(log.Day) as Day,databib_item.Barcode,databib_item.Bib_ID FROM log 
        LEFT JOIN databib_item ON log.Item = databib_item.Barcode
        WHERE log.Sub = 'เพิ่มฉบับทรัพยากร'
        GROUP BY databib_item.Bib_ID  
        ORDER BY `Day` DESC LIMIT 12";
        $data = $conn->query($sql);
        $new_book = [];
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $temp[$i] = $data->fetch_assoc();
            array_push($new_book,$temp[$i]['Bib_ID']);
        }
        // print_r($sql);
        // print_r($new_book);

    // -----------------------------------------------------Newest--------------------------------------------------------

    // -----------------------------------------------------Recommand--------------------------------------------------------
        $sql = "SELECT * FROM databib_item 
        LEFT JOIN log ON databib_item.Barcode = log.Item 
        LEFT JOIN databib ON databib_item.Bib_ID = databib.Bib_ID 
        WHERE log.Sub IN ('เพิ่มฉบับทรัพยากร') 
        AND databib.Field = '961' 
        AND databib.Subfield LIKE '%1%' 
        GROUP BY databib_item.Bib_ID 
        ORDER BY log.Day DESC 
        LIMIT 12";
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $rec_add[$i] = $data->fetch_assoc();
        }
// print_r($sql);

        $sql = "SELECT * FROM log 
        LEFT JOIN databib ON log.Item  = databib.Bib_ID 
        WHERE log.Sub = ('แก้ไขทรัพยากร') 
        AND databib.Field = '961' 
        AND databib.Subfield LIKE '%1%' 
        GROUP BY databib.Bib_ID 
        ORDER BY log.Day DESC 
        LIMIT 12";
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $rec_edit[$i] = $data->fetch_assoc();
        }
        // echo json_encode([$rec_edit,$rec_add]);

        $arr_temp_rec = [];
        $obj_rec = [];

        for ($i=0; $i < count($rec_add) ; $i++) { 
            for ($j=0; $j < count($rec_edit) ; $j++) { 
                if ($rec_add[$i]['Bib_ID']==$rec_edit[$j]['Bib_ID']) {
                    if ($rec_add[$i]['Day']>$rec_edit[$j]['Day']) {
                        array_push($arr_temp_rec,$rec_add[$i]['Bib_ID']);
                    }
                    else {
                        array_push($arr_temp_rec,$rec_edit[$j]['Bib_ID']);
                    }
                    break;
                }
            }
        }
        // print_r($arr_temp_rec);
        for ($i=0; $i < count($rec_add) ; $i++) { 
            if (!in_array($rec_add[$i]['Bib_ID'],$arr_temp_rec)) {
                array_push($arr_temp_rec,$rec_add[$i]['Bib_ID']);
            }
        }
        // print_r($arr_temp_rec);
        for ($i=0; $i < count($rec_edit) ; $i++) { 
            if (!in_array($rec_edit[$i]['Bib_ID'],$arr_temp_rec)) {
                array_push($arr_temp_rec,$rec_edit[$i]['Bib_ID']);
                // print_r($rec_edit[$i]);
                // print_r($arr_temp_rec);
            }
        }
        // print_r($arr_temp_rec);
    // -----------------------------------------------------Recommand--------------------------------------------------------
    // -----------------------------------------------------Most_View--------------------------------------------------------
        
        $sql = "SELECT * FROM databib 
        WHERE databib.Field = '962'
        ORDER BY databib.Subfield DESC
        LIMIT 12";
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $view[$i] = $data->fetch_assoc();
        }
    //     $temp_view = [];
    //     for ($i=0; $i < count($view) ; $i++) { 
    //       $cut = calsub_arr($view[$i]['Subfield'],"962");
    //       $view[$i]['Subfield'] = $cut['View']['#a'];
    //       $temp_view[$i] = $cut['View']['#a'];
    //     }
    //     rsort($temp_view);
    //     $temp_view = array_slice($temp_view,0,12);
    //   print_r($temp_view);
        $sort_view = [];
        for ($i=0; $i < count($view) ; $i++) { 
            array_push($sort_view,$view[$i]['Bib_ID']);
        }
        // print_r($sort_view);

    // -----------------------------------------------------Most_View--------------------------------------------------------

    // -----------------------------------------------------sql_MAIN--------------------------------------------------------
    
        $stack = "(";
        for ($i=0; $i <count($new_book) ; $i++) { 
            $stack .= "'{$new_book[$i]}',";
        }
        for ($i=0; $i <count($arr_temp_rec) ; $i++) { 
            $stack .= "'{$arr_temp_rec[$i]}',";
        }
        for ($i=0; $i <count($sort_view) ; $i++) { 
            $stack .= "'{$sort_view[$i]}',";
        }
        $stack = substr($stack,0,strlen($stack)-1).")";

        $sql = "SELECT * FROM databib 
        WHERE databib.Field IN (245,960) 
        AND Bib_ID IN $stack 
        ORDER BY databib.Bib_ID ASC ";
        $data = $conn->query($sql);
        // echo $sql;
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_main[$i] = $data->fetch_assoc();
        }
    
    // -----------------------------------------------------sql_MAIN--------------------------------------------------------


        $main_data = [];

        for ($i=0; $i < count($data_main) ; $i++) { 
            if ($data_main[$i]['Field']=='245') {
                $cut = calsub_arr($data_main[$i]['Subfield'],'245');
                $data_main[$i]['Subfield'] = $cut['Title']['#a'];
            }
            elseif ($data_main[$i]['Field']=='960') {
                $cut = calsub_arr($data_main[$i]['Subfield'],'960');
                $data_main[$i]['Subfield'] = $cut['Pic']['#a'];
            }
            
         }

        for ($i=0; $i < count($data_main) ; $i++) { 
            $main_data[$data_main[$i]['Bib_ID']][$data_main[$i]['Field']] = ['inc1' => $data_main[$i]['Indicator1'] ,'inc2' => $data_main[$i]['Indicator2'] ,'sub' => $data_main[$i]['Subfield'] ]; 
        }

        // print_r($new_book);

        $obj_book = ['new'=>$new_book,'rec'=>$arr_temp_rec,'view'=>$sort_view,'main'=>$main_data];
        // print_r($obj_book);
        echo json_encode($obj_book);




    ?>