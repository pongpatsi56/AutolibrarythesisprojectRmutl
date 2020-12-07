

<?php 
 include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
 include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
$GETID=$_GET['Bibitem'];
$sql = "SELECT * FROM listbuy WHERE ID='$GETID'";
$sql1 = "SELECT * FROM listbuy WHERE recommend='1' AND ID='$GETID' ";
$result= $conn->query($sql);
$result1= $conn->query($sql1);
$row = $result->fetch_assoc();
$NEWCOUNT = $row["Count"]+1;
$sql1 = "UPDATE listbuy SET  Count=$NEWCOUNT WHERE ID=$GETID ";
$conn->query($sql1);
?>

<style>
.type1 {
    width :100%;
}
.type1, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
#t01 {
    background-color: #f1f1c1;
}
</style>
<br>
    <br>
    <br>
	<section class="container">
<div class="row" style="padding-top: 20px;padding-bottom: 500px; background-color: #eee;">
<div class="col-md-1">
</div>
     

                            <br>
                            <br>
                            <br>
                            <div class="col-md-2">
                            &nbsp;&nbsp;<img src="../img/<?php echo $row['img']; ?>" width="150px" height="200px">
                            </div>
                      
    <div class="col-md-7">

    

                           
     <table class="type1" id="t01" border="2"s height="200px" >
     <tr >
    <td width="15%"><p><B> &nbsp; Title </td><td> &nbsp; <?php echo $row['Title']; ?></p>  </td>  
    </tr><tr> 
    <td width="15%"><p> <B>&nbsp; Published </td><td> &nbsp; <?php echo $row['Publisher']; ?></p></td>
    </tr><tr> 
    <td width="15%"><p> <B>&nbsp; Detail </td><td> &nbsp; <?php echo $row['group1']; ?></p></td>
    </tr><tr> 
    <td width="15%"><p> <B>&nbsp; Subject</td><td>  &nbsp;<?php echo $row['category']; ?></p></td>
      
    </tr>
    </table>
</div>

    <div class="col-md-3">

    <nav style="background-color:#AFEEEE;" >
 <ul class="nav">
     <li ><FONT Size = "3" color="#000000"> <B>Review</B> </FONT></li>
 </ul>
                   
<div style="background-color:#F0F8FF;" >
<br>
<FONT Size = "2" > &nbsp; คนเข้ามาดู[<?php echo $row['Count']; ?>] </FONT>
<br>
<?php 

if(mysqli_num_rows($result1) == 1) {
    ?>
    <FONT Size = "2" > &nbsp; แนะนำ + </FONT>
<?php
}
?>
<br>
<br>

 <nav style="background-color:#AFEEEE	;">
 <ul class="nav">
     <li ><FONT Size = "3" color="#000000"><B> New </B></FONT></li>
 </ul>
                   
<div style="background-color:#F0F8FF;" >
<br>
<br>
<br>
<br>
</div>

</div>
</div>
<div class="address-text-fooster col-md-12">
            
            ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา : 128 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่ 50300<br>
            โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183            </div>
        <div class="address-text-fooster col-md-12" style="margin-top: 8px;">
            <div id=ipv6_enabled_www_test_logo></div>

</footer>

<div class="credit" style="text-align:center; color: #fff;margin-top: 15px;margin-bottom: 15px;">
<p style="color: #666; font-family: 'kanit';">ออกแบบและพัฒนาโดย <a href="https://arit.rmutl.ac.th/" target="_blank">สำนักวิทยบริการและเทคโนโลยีสารสนเทศ</a> <a href="https://www.rmutl.ac.th/" target="_blank">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</a></p>
</div>
<?php
 include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";
 ?>
 

