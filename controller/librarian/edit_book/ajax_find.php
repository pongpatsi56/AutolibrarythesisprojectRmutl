    <?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";


    $id = $_POST['id'];

    $sql = "SELECT * FROM databib 
    -- LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID
    WHERE databib.Field IN ('245','020','022') AND databib.Subfield Like '%{$id}%' ";
    $data = $conn->query($sql);
    if (@mysqli_num_rows($data)!=0) {
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_book[$i] = $data->fetch_assoc();
        }
        $stack = "(";
        for ($i=0; $i < count($data_book) ; $i++) { 
            $stack .= "'{$data_book[$i]['Bib_ID']}',";
        }
        $stack = substr($stack,0,strlen($stack)-1).")";
    
        $sql = "SELECT * FROM databib WHERE Bib_ID IN $stack ";
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_book[$i] = $data->fetch_assoc();
        }
        for ($i=0; $i < count($data_book) ; $i++) { 
            if ($data_book[$i]['Field']=='245') {
                $cut = calsub_arr($data_book[$i]['Subfield'],'245');
                $databib[$data_book[$i]['Bib_ID']][$data_book[$i]['Field']] = ['Indicator1'=>$data_book[$i]['Indicator1'],'Indicator2'=>$data_book[$i]['Indicator2'],'Subfield'=>$data_book[$i]['Subfield'],'cut'=>$cut['Title']['#a']];
            }
            elseif ($data_book[$i]['Field']=='020'||$data_book[$i]['Field']=='022') {
                $cut = calsub_arr($data_book[$i]['Subfield'],'020');

                $databib[$data_book[$i]['Bib_ID']][$data_book[$i]['Field']] = ['Indicator1'=>$data_book[$i]['Indicator1'],'Indicator2'=>$data_book[$i]['Indicator2'],'Subfield'=>$data_book[$i]['Subfield'],'cut'=>$cut['ISBN']['#a']];
            }
            else {
                $databib[$data_book[$i]['Bib_ID']][$data_book[$i]['Field']] = ['Indicator1'=>$data_book[$i]['Indicator1'],'Indicator2'=>$data_book[$i]['Indicator2'],'Subfield'=>$data_book[$i]['Subfield']];
            }
        }
        echo json_encode($databib);
    }
    else{
        echo 1;
    }
    
    ?>