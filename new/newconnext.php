
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
    $list_Title = $_POST['text_Title'];
    $list_Story = $_POST['text_Story'];
    $list_Date1 = $_POST['start_date1'];
    $ext = pathinfo(basename($_FILES['img']['name']),PATHINFO_EXTENSION);
    $new_image_name = 'img_'.uniqid().".".$ext;
    $image_path ="../imgnew/";
    $upload_path = $image_path.$new_image_name;
    move_uploaded_file($_FILES['img']['tmp_name'],$upload_path);
    $img = $new_image_name;
    // $strSQL = "SELECT Name FROM listbuy WHERE Name = '".trim($_POST["text_Title"])."' ";
    
    $sql1 = "INSERT INTO news (Title,Story,Date1,img) 
             VALUES ('$list_Title','$list_Story','$list_Date1','$img')";

    if ( mysqli_query($conn,$sql1)==true) {
      echo"<script>alert('บันทึกเรียบร้อย');window.location.href='newadd.php';</script>" ; 

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