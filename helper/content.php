<?php
$_SERVER['DOCUMENT_ROOT'] . '/lib/include/connect.php';


?>
<!DOCTYPE html>
<html>
<link rel='stylesheet' href='../fonts/thsarabunnew.css' />
<style type='text/css'>
    body {
        font-family: 'THSarabunNew', sans-serif;
    }
</style>

<head>
    <meta charset=utf-8>
    <title>ทดสอบการส่ง Email</title>
</head>

<body>
    <table>
        <tr>
            <td><img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeJSjirb8pyZBJ6cfFOphvfxBXvrjZKKc7jZV5qw_-jyG2FRgDMQ' style='width: 80px;margin-right: 10px;'></td>
            <td>
                <div style='font-size:16px;font-weight:bold;'>งานห้องสมุดมหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</div>
                <div style='font-size:13px;'>128 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่ 50300</div>
                <div style='font-size:13px;'>โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183</div>
            </td>
        </tr>
    </table>
    <hr style='border-top: 2px solid #b1b1b1;width:98%'>
    <div style='padding: 0 2%;'>
        <p>เรื่อง แจ้งรายการหนังสือที่เกินกำหนดส่ง<br>เรียน คุณ<?= 555555555555555555 ?> </p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;ตามที่ท่านได้ยืมหนังสือจากห้องสมุดมหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา ขณะนี้<br>
            หนังสือดังกล่าวเกินวันกำหนดส่งแล้ว ตามรายการดังนี้</p>
    </div>
    <hr style='border-top: 2px solid #b1b1b1;width:98%'>
    <div style='text-align:center;font-size:13px;'>
        2019 © Autolibrary Rajamangala University of Technology Lanna
    </div>
</body>

</html>