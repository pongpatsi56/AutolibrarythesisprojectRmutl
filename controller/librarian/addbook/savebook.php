    <?php
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
        //  include $_SERVER['DOCUMENT_ROOT'] . "/lib/controller/librarian/addbook/filter_tag.php";
        //  include $_SERVER['DOCUMENT_ROOT'] . "/lib/controller/librarian/addbook/directory_book.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/controller/librarian/addbook/add_data.php";
    ?>

        <br><br><br>

    <?php
    
        $tag = $_POST['tag'];
        $inc1 = $_POST['inc1'];
        $inc2 = $_POST['inc2'];
        $sub = $_POST['sub'];
        $leader = $_POST['leader'];

        for ($i=0; $i < count($sub) ; $i++) { 
            $sub[$i] = str_replace("$","#",$sub[$i]);
        }

        print_r($sub);

        // $dic_array = build_data($tag,$inc1,$inc2,$sub);
        // $data_dic = build_directory($tag,$dic_array);
        // $data_sub_dic = build_sub_dir($tag,$inc1,$inc2,$sub);
        // $dir = combine_dir($leader,$data_dic,$data_sub_dic);
        // echo $dir;
        $sql = add_data($tag,$inc1,$inc2,$sub);
        //  if (mysqli_query($conn,$sql)==TRUE) {
        //     echo "<script>alert('บันทึกสำเร็จ');window.location.assign('/lib/controller/librarian/addbook/add.php');</script>";
        //  }



    ?>