<?php
require("mail/PHPMailerAutoload.php"); 
header('Content-Type: text/html; charset=utf-8');

$mail = new PHPMailer;
$mail->CharSet = "utf-8";
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;


$gmail_username = "autolibrary.rmutl.projecttest@gmail.com"; // gmail ที่ใช้ส่ง
$gmail_password = "autolib2561"; // รหัสผ่าน gmail
// ตั้งค่าอนุญาตการใช้งานได้ที่นี่ https://myaccount.google.com/lesssecureapps?pli=1


$sender = "LibraryRMUTL"; // ชื่อผู้ส่ง
$email_sender = "autolibrary.rmutl.projecttest@gmail.com"; // เมล์ผู้ส่ง 
$email_receiver = "ps43638@gmail.com"; // เมล์ผู้รับ ***

$subject = "ทดสอบส่งEmail LibraryRMUTL"; // หัวข้อเมล์


$mail->Username = $gmail_username;
$mail->Password = $gmail_password;
$mail->setFrom($email_sender, $sender);
$mail->addAddress($email_receiver);
$mail->Subject = $subject;

$email_content = "
";

//  ถ้ามี email ผู้รับ
if ($email_receiver) {
    $mail->msgHTML($email_content);
    // $mail->msgHTML(file_get_contents('content.php'), dirname(__FILE__));


    if (!$mail->send()) {  // สั่งให้ส่ง email

        // กรณีส่ง email ไม่สำเร็จ
        echo "<h3 class='text-center'>ระบบมีปัญหา กรุณาลองใหม่อีกครั้ง</h3>";
        echo $mail->ErrorInfo; // ข้อความ รายละเอียดการ error
    } else {
        // กรณีส่ง email สำเร็จ
        echo "ระบบได้ส่งข้อความไปเรียบร้อย";
    }
}

