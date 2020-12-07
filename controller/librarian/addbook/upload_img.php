    
    <?php
    if (isset($_FILES['file']['name'])) {
        $imageFileType = pathinfo(basename($_FILES['file']['name']),PATHINFO_EXTENSION);
        $filename = 'img_'.uniqid().".".$imageFileType;

        $location = $_SERVER['DOCUMENT_ROOT'] ."/lib/img/".$filename;

        move_uploaded_file($_FILES['file']['tmp_name'],$location);

        echo $filename;
    }
    else{
        echo "0";
    }
        

    ?>