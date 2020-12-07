<?php 

session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";


    function get_id($id,$conn){
        $date = date('Y-m-d H:i:s');
        
        $stack = "";
        $stack .= "('template','เพิ่มระเบียน','".$id."','$date','".$_SESSION['user_status']['ID']."')";
    
        $sql_log = "INSERT INTO log(Tables,Sub,Item,Day,Librarian) VALUES $stack";
    
        mysqli_query($conn,$sql_log);
    }

    $name = $_POST['temp_name'];
    $type = $_POST['temp_type'];
    $descript = $_POST['temp_descript'];
    $data = $_POST['data'];

    print_r($data);
    
    $sql="SELECT max(ID) AS ID FROM template ";
    $id =  ($conn->query($sql))->fetch_assoc();
    $id['ID']++;


    $data_temp = "";
    $data_temp .= "('".$id['ID']."','".$name."','".$type."','".$descript."')"; 

    $sql_temp  = "INSERT INTO template(ID,Name,Type,Description) VALUES $data_temp";
    $conn->query($sql_temp);

    $data_tag = "";
    for ($i=0; $i < count($data) ; $i++) { 
        $data_tag .= "('".$id['ID']."','".$data[$i][0]."')"; 
        $data_tag .= ",";
    }
    $count_data_tag = strlen($data_tag);
    $data_tag = substr($data_tag,0,$count_data_tag-1);

    $sql_tag   = "INSERT INTO temp_field(Temp,Field) VALUES $data_tag";
    $conn->query($sql_tag);

    $data_inc = "";
    for ($i=0; $i < count($data) ; $i++) {
        if ($data[$i][1]!=null) {
            $data_inc .= "('".$id['ID']."','".$data[$i][0]."','".$data[$i][1]."','1')"; 
            $data_inc .= ",";
        }
        if ($data[$i][2]!=null) {
            $data_inc .= "('".$id['ID']."','".$data[$i][0]."','".$data[$i][2]."','2')"; 
            $data_inc .= ",";
        } 
    }
    $count_data_inc = strlen($data_inc);
    $data_inc = substr($data_inc,0,$count_data_inc-1);
    $sql_inc  = "INSERT INTO temp_indicator(Temp,Field,Indicator,`Order`) VALUES $data_inc";
    $conn->query($sql_inc);




    $data_sub = "";
    for ($i=0; $i < count($data) ; $i++) { 
        $data_sub .= "('".$id['ID']."','".$data[$i][0]."','".str_replace("$","#",$data[$i][3])."')"; 
        $data_sub .= ",";
    }
    $count_data_sub = strlen($data_sub);
    $data_sub = substr($data_sub,0,$count_data_sub-1);
    $sql_sub   = "INSERT INTO temp_subfield(Temp,Field,Subfield) VALUES $data_sub";
    $conn->query($sql_sub);

    get_id($id['ID'],$conn);



?>                   