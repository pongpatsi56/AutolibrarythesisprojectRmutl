   <?php 
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";

        $find_val = $_POST['val'];

        $sql = "SELECT Bib_ID FROM databib WHERE Field IN ('245','020','022') AND Subfield LIKE '%{$find_val}%' ";
        // echo $sql;
        $data = $conn->query($sql);
        if (@mysqli_num_rows($data)!=0) {
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_bib_ID[$i] = $data->fetch_assoc();
            }
            $stack = "(";
            for ($i=0; $i < count($data_bib_ID) ; $i++) { 
                $stack .= "'{$data_bib_ID[$i]['Bib_ID']}',";
            }
            $stack = substr($stack,0,strlen($stack)-1).")";
            $sql = "SELECT * FROM databib WHERE Bib_ID IN $stack";
            $data = $conn->query($sql);
            for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
                $data_book[$i] = $data->fetch_assoc();
            }
            for ($i=0; $i < count($data_book) ; $i++) { 
                $data_main[$data_book[$i]['Bib_ID']][$data_book[$i]['Field']] = ['inc1'=> $data_book[$i]['Indicator1'],'inc2'=> $data_book[$i]['Indicator2'],'sub'=> $data_book[$i]['Subfield'], ];
            }
            foreach ($data_main as $i => $val1 ) {
                foreach ($data_main[$i] as $j => $val2 ) {
                    if ($j == '245') {
                        $data_main_already_cut = calsub_arr($data_main[$i][$j]['sub'],'245');
                        $data_main[$i][$j]['sub'] = $data_main_already_cut['Title']['#a'];
                    }
                    else if ($j == '020') {
                        $data_main_already_cut = calsub_arr($data_main[$i][$j]['sub'],'020');
                        $data_main[$i][$j]['sub'] = $data_main_already_cut['ISBN']['#a'];
                    }
                    else if ($j == '022') {
                        $data_main_already_cut = calsub_arr($data_main[$i][$j]['sub'],'022');
                        $data_main[$i][$j]['sub'] = $data_main_already_cut['ISBN']['#a'];
                    }
                    else if ($j == '082') {
                        $data_main_already_cut = calsub_arr($data_main[$i][$j]['sub'],'082');
                        $data_main[$i][$j]['sub'] = $data_main_already_cut[0];
                    }
                }
            }
            // print_r($data_book);
            echo JSON_ENCODE($data_main);
        }
        else{
            echo 1;
        }

    ?>