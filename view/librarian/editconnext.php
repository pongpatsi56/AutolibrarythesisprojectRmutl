
<?php

session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";


 mysqli_set_charset($conn, "utf8");
 $list_ID = $_POST['ID'];

    $list_category = $_POST['text_category'];
    if ($list_category=="journal"){
      $list_group = $_POST['text_group2'];
    }else{
      $list_group = $_POST['text_group1'];
    }
    $list_Title = $_POST['text_Title'];
    $list_Author = $_POST['text_author'];
    $list_Publisher = $_POST['text_Publisher'];
    $list_Price = $_POST['text_Price'];
    $list_Quantiny = $_POST['text_Quantiny'];
    $list_From1 = $_POST['text_From1'];
    $list_year1 = $_POST['text_year1'];
    $list_Date1 = $_POST['start_date1'];
    $list_recommend  = (isset($_POST['recommend']) && $_POST['recommend']!="") ? 1 : 0 ;
    $ext = pathinfo(basename($_FILES['img']['name']),PATHINFO_EXTENSION);
    $new_image_name = 'img_'.uniqid().".".$ext;
    $image_path ="../../img/";
    $upload_path = $image_path.$new_image_name;
    move_uploaded_file($_FILES['img']['tmp_name'],$upload_path);
    $img = $new_image_name;
    
    // $sql1 = "INSERT INTO listbuy (category,group1,Title,Author,Publisher,Price,Quantiny,From1,year1,Date1,recommend,img) 
    //          VALUES ('$list_category','$list_group','$list_Title','$list_Author','$list_Publisher','$list_Price','$list_Quantiny','$list_From1','$list_year1','$list_Date1','$list_recommend','$img')";
    $sql1 = "UPDATE listbuy SET   category='$list_category',group1='$list_group',Title='$list_Title', 
            Publisher='$list_Publisher',Price='$list_Price',Quantiny='$list_Quantiny',From1='$list_From1',year1='$list_year1',
            Date1='$list_Date1',recommend='$list_recommend',img='$img' WHERE ID=$list_ID ";
    if ( mysqli_query($conn,$sql1)==true) {
      echo"<script>alert('บันทึกเรียบร้อย');window.location.href='listbuy.php?&nPage=1&perPage=10';</script>" ; 
    
    }else{
      echo"<script>alert('ไม่ได้');</script>" ;
   
    }
    


?>

</body>

</html>