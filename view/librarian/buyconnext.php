
<?php

session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
// echo '<br>' . $list_category = $_POST['text_category'];
// echo '<br>' . $list_group1 = $_POST['text_group1'];
// echo '<br>' . $list_Title = $_POST['text_Title'];
// echo '<br>' . $list_Author = $_POST['text_author'];
// echo '<br>' . $list_Publisher = $_POST['text_Publisher'];
// echo '<br>' . $list_Price = $_POST['text_Price'];
// echo '<br>' . $list_Quantiny = $_POST['text_Quantiny'];
// echo '<br>' . $list_From1 = $_POST['text_From1'];
// echo '<br>' . $list_year1 = $_POST['text_year1'];
// echo '<br>' . $list_Date1 = $_POST['start_date1'];
// exit;
 mysqli_set_charset($conn, "utf8");
    $list_category = $_POST['text_category'];
    if ($list_category=="journal"){
      $list_group = $_POST['text_group2'];
    }else{
      $list_group = $_POST['text_group1'];
    }
    if ($list_category=="journal"){
      $list_Title = $_POST['text_Title2'];
    }else{
      $list_Title = $_POST['text_Title'];
    }
    $list_Author = $_POST['text_author'];
    $list_Publisher = $_POST['text_Publisher'];
    $list_Price = $_POST['text_Price'];
    $list_Quantiny = $_POST['text_Quantiny'];
    $list_From1 = $_POST['text_From1'];
    $list_year1 = $_POST['text_year1'];
    $list_Date1 = $_POST['start_date1'];
    $list_IDU = $_POST['IDU'];
    @$list_recommend = $_POST['rank_recommend']; 
    $ext = pathinfo(basename($_FILES['img']['name']),PATHINFO_EXTENSION);
    $new_image_name = 'img_'.uniqid().".".$ext;
    $image_path ="../../img/";
    $upload_path = $image_path.$new_image_name;
    move_uploaded_file($_FILES['img']['tmp_name'],$upload_path);
    $img = $new_image_name;
    // $strSQL = "SELECT Name FROM listbuy WHERE Name = '".trim($_POST["text_Title"])."' ";
    
    $sql1 = "INSERT INTO listbuy (category,group1,Title,Author,Publisher,Price,Quantiny,From1,year1,Date1,User_ID,recommend,img) 
             VALUES ('$list_category','$list_group','$list_Title','$list_Author','$list_Publisher','$list_Price','$list_Quantiny','$list_From1','$list_year1','$list_Date1','$list_IDU','$list_recommend','$img')";

    if ( mysqli_query($conn,$sql1)==true) {
      echo"<script>alert('บันทึกเรียบร้อย');window.location.href='listbuy.php?&nPage=1&perPage=10';</script>" ; 

    }else{
      echo"<script>alert('ไม่ได้');</script>" ;
    }
    // $query = mysqli_query($conn,$sql1);



?>

  <!-- <form  method="get" action="lib/view/librarian/buy.php" target="iframe_target">
  <a href="buy.php" ><img src='/lib/iconimg/left-arrow.png' width='30' height='30' ></i></a><br><br><br>
</form> -->

</body>

</html>