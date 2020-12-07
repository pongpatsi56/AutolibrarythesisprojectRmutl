<?php
// $data_book = querydata("SELECT * FROM databib WHERE Field = '245' AND Barcode = '$barcode'");
// if (count($data_book) == 0) {
//     echo json_encode(false);
//     exit;
// }
$rsvt = mysqli_query($conn, "SELECT * FROM reservations WHERE Member = '$IDmember' AND IsDeleteorCancel = 0");





?>
<br>
<br>
<br>
<style type="text/css">
/* class สำหรับแถวส่วนหัวของตาราง */
.tr_head{
    background-color:#fff;
    color:#050505;
}
/* class สำหรับแถวแรกของรายละเอียด */
.tr_odd{
    background-color:#ddd;
}
/* class สำหรับแถวสองของรายละเอียด */
.tr_even{
    background-color:#eee;
}
td{
    padding: 3px;
}
th{
    padding: 5px;
    text-align: center;
}
</style>
<div class="row">
    <?php
    if (mysqli_num_rows($rsvt) > 0) {
        $no = 1;
        ?>
    <table id="mytable" align="center" border="0" bgcolor="#FFFFFF">
            <tr>
                <th scope="col">ลำดับ</th>
                <th scope="col" class="bg-dark">ชื่อหนังสือ / ผู้แต่ง</th>
                <th scope="col" class="bg-success">วันที่จอง</th>
                <th scope="col" class="bg-warning">วันที่คาดว่าจะได้รับ</th>
                <th scope="col" class="bg-danger">ยกเลิกจอง</th>
            </tr>
            <?php
                while ($data_rsvt = mysqli_fetch_assoc($rsvt)) {
                    $barcode = $data_rsvt['Book'];
                    $data_book = querydata("SELECT * FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID WHERE Barcode = '$barcode'");
                    $date_rsvt = convert_datethai_monthdot(date_format(date_create($data_rsvt['Date_Reserv']), "Y-m-d"));
                    $date_rcv = convert_datethai_monthdot(date_format(date_create($data_rsvt['Receive']), "Y-m-d"));
                    ?>
            <tr>
                <td width="20px"><center><?= $no++ ?></td>
                <td width="500px"><center><?= $data_book[$barcode]['Title']['#a'] . ' / ' . $data_book[$barcode]['Author']['#a'] ?></td>
                <td width="180px" class="text-success"><center><?= $date_rsvt ?></td>
                <td width="180px"><center><?= $date_rcv ?></td>
                <td width="100px"><center><input type="button" class="btn btn-danger" onclick="cancel_rsvt('<?= $IDmember ?>','<?= $barcode ?>','<?= $data_rsvt['Date_Reserv'] ?>','<?= $data_rsvt['Receive'] ?>')" value="ยกเลิก"></td>
            </tr>
            <?php
                }
                ?>
    </table>
    <?php
    } else {
        ?>
</div>
<?php
}
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
<script src="/lib/script/reservations.js"></script>