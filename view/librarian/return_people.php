<?php 

include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/ppat.php";

$member = (isset($_GET['text_member_find'])? $_GET['text_member_find']:"");

$sql = "SELECT * FROM member ";

if (isset($_GET['text_member_find']) && $_GET['text_member_find'] != "") {
    $sql .= " WHERE Member LIKE '%{$_GET['text_member_find']}%' 
            OR FName LIKE '%{$_GET['text_member_find']}%'  
            OR LName LIKE '%{$_GET['text_member_find']}%'
            OR Faculty LIKE '%{$_GET['text_member_find']}%'
            OR Major LIKE '%{$_GET['text_member_find']}%'
            OR Tel LIKE '%{$_GET['text_member_find']}%'";
} 

$result = $conn->query($sql);

$total = mysqli_num_rows($result);
if (isset($_GET['sel_page'])) {
    $e_page = $_GET['sel_page']; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า
} else {
    $e_page = 20;
}
$step_num = 0;

if (!isset($_GET['page1']) || (isset($_GET['page1']) && $_GET['page1'] == 0)) {
    $_GET['page1'] = 1;
    $step_num = 0;
    $s_page = 0;
} else {
    $s_page = $_GET['page1'] - 1;
    $step_num = $_GET['page1'] - 1;
    $s_page = $s_page * $e_page;
}
$sql .= " ORDER BY ID DESC LIMIT " . $s_page . ",$e_page";
$result = $conn->query($sql);


?>
<style type="text/css">
/* class สำหรับแถวส่วนหัวของตาราง */
.tr_head{ 
    background-color:#eee;
    color:#050505;
}
/* class สำหรับแถวแรกของรายละเอียด */
.tr_odd{
    background-color:#fff;
}
/* class สำหรับแถวสองของรายละเอียด */
.tr_even{
    background-color:#ddd;
}
</style>
     <table class="table table-bordered table-hover" id="mytable" width="100%" border="0" >
        <thead>
            <tr>
                <th scope="col" width = "12%"><center>ไอดี</center></th>
                <th scope="col" width = "13%" >ชื่อ</th>
                <th scope="col" width = "13%">นามสกุล</th>
                <th width = "13%">คณะ</th>
                <th width = "20%">สาขา</th>
                <th width = "13%">เบอร์โทร</th>
                <th width = "16%">อีเมล</th>
            </tr>
        </thead>
        <tbody>
        
<?php


if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { ?>
   	<tr>
        <td height="40"><?php echo $row['ID']; ?></td>
        <td height="40"><a class="text-primary" href="return.php?menu=1&text_member=<?php echo $row['ID']; ?>"><?php echo $row['FName']; ?></a></td>
        <td height="40" ><a class="text-primary" href="return.php?menu=1&text_member=<?php echo $row['ID']; ?>"><?php echo $row['LName']; ?></td>
        <td height="40"><?php echo $row['Faculty']; ?></td>
        <td height="40"><?php echo $row['Major']; ?></td>
        <td height="40"><?php echo $row['Tel']; ?></td>
        <td height="40"><?php echo $row['Email']; ?></td>
    </tr>
  <?php 
}
}



?>

        </tbody>
        </table>
<center>
<?php
    page_navi($total,(isset($_GET['page1']))?$_GET['page1']:1,$e_page,$_GET); 
?>
<script language="javascript">
window.onload = function () {    
      var a=document.getElementById('mytable'); // อ้างอิงตารางด้วยตัวแปร a
      for(i=0;i<a.rows.length;i++){ // วน Loop นับจำนวนแถวในตาราง
          if(i>0){  // ตรวจสอบถ้าไม่ใช่แถวหัวข้อ
              if(i%2==1){   // ตรวจสอบถ้าไม่ใช่แถวรายละเอียด
                  a.rows[i].className="tr_odd";     // กำหนด class แถวแรก
              }else{
                  a.rows[i].className="tr_even";  // กำหนด class แถวที่สอง
              }   
          }else{ // ถ้าเป็นแถวหัวข้อกำหนด class 
              a.rows[i].className="tr_head";  
          }   
      }
}
</script>