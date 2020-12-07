
<?php

session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

 mysqli_set_charset($conn, "utf8");

    $list_ID = $_POST['text_ID'];
    $list_FName = $_POST['text_FName'];
    $list_LName = $_POST['text_LName'];
    $list_Faculty = $_POST['text_Faculty'];
    $list_Major = $_POST['text_Major'];
    $list_Username = $_POST['text_Username'];
    $list_Password = $_POST['text_Password'];
    $list_Tel = $_POST['text_Tel'];
    $list_Email = $_POST['text_Email'];
    $list_Address = $_POST['text_Address'];
    $list_Status = $_POST['text_Status'];
    $ext = pathinfo(basename($_FILES['img']['name']),PATHINFO_EXTENSION);
    $new_image_name = 'img_'.uniqid().".".$ext;
    $image_path ="img/";
    $upload_path = $image_path.$new_image_name;
    move_uploaded_file($_FILES['img']['tmp_name'],$upload_path);
    $img = $new_image_name;
    $strSQL = "SELECT Name FROM member WHERE Name = '".trim($_POST["text_FName"])."' ";

 
    $sql1 = "INSERT INTO member (ID,FName,LName,Faculty,Major,Username,Password,Tel,Email,Address,Status,img) 
                  VALUES ('$list_ID','$list_FName','$list_LName','$list_Faculty','$list_Major','$list_Username','$list_Password','$list_Tel','$list_Email','$list_Address','$list_Status','$img')";
   

    $query = mysqli_query($conn,$sql1);
    


?>
  <form  method="get" action="lib/memberlogin.php" target="iframe_target">
  <input  class="btn btn-primary" type="submit" value="BACK">
  <input type="hidden" name="page" value="user">
</form>

</body>

</html>