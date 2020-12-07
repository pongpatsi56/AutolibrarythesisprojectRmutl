<?php

    function build_data($tag,$inc1,$inc2,$sub) {
        foreach ($tag as $key => $value) {
            $dic = "";
                if($tag[$key]=="008"){
                    $dic .= $sub[$key];
                }
                else{
                    $dic .= $inc1[$key];
                    $dic .= $inc2[$key];
                    $dic .= $sub[$key];
                }
                $dic_array[$key] = $dic;
        }
        return $dic_array ;
    }

    function build_length($len_dic){
        $num = strlen($len_dic);
        if($num==0){
            $length = "0000";
        }
        else if($num==1){
            $length = "000".$len_dic;
        }
        else if($num==2){
            $length = "00".$len_dic;
        }
        else if($num==3){
            $length = "0".$len_dic;
        }
        else if($num==4){
            $length = $len_dic;
        }
        return $length;
    }

    function build_pos($last_pos){
        $num = strlen($last_pos);
        if($num==0){
            $length_pos = "00000";
        }
        else if($num==1){
            $length_pos = "0000".$last_pos;
        }
        else if($num==2){
            $length_pos = "000".$last_pos;
        }
        else if($num==3){
            $length_pos = "00".$last_pos;
        }
        else if($num==4){
            $length_pos = "0".$last_pos;
        }
        else if($num==5){
            $length_pos = $last_pos;
        }
        return $length_pos;


    }

    function build_directory($tag,$dic_array){
        $last_pos = 0;
        $data_dic = "";
        foreach ($dic_array as $key => $value) {
            $len_dic = strlen($dic_array[$key])+1;
            $data_dic .= $tag[$key];
            $length = build_length($len_dic);
            $data_dic .= $length;
            $length_pos = build_pos($last_pos);
            $data_dic .= $length_pos;
            $last_pos = $last_pos + $len_dic;
        }
        return $data_dic;
    }

    function build_sub_dir($tag,$inc1,$inc2,$sub){
        $data_sub_dic= "";
        foreach ($tag as $key => $value) {
            $data_sub_dic .= "^";
            $data_sub_dic .= $inc1[$key].$inc2[$key].$sub[$key];
        }
        $data_sub_dic = substr(($data_sub_dic),0,strlen($data_sub_dic)-1);
        return $data_sub_dic ;
    }

    function combine_dir($leader,$data_dic,$data_sub_dic){
        $dir = $leader.$data_dic.$data_sub_dic;
        return $dir;
    }


?>