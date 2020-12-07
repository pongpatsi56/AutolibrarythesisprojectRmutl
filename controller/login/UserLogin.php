<?php
session_start();
include "../../include/connect.php";
// variable
$username = $_POST['username'];
$password = $_POST['password'];
$enc_pass = hash("MD5", $password);
$sql = mysqli_query($conn, "SELECT *
FROM userstatus u
    left JOIN permission p ON u.status = p.Per_ID
    LEFT JOIN
    (SELECT ID, Username, Password, FName, LName
        FROM librarian
    UNION
        SELECT ID, Username, Password, FName, LName
        FROM member) AS result ON u.User_ID = result.ID
WHERE result.username = '$username' AND result.Password = '$enc_pass'");
$num = mysqli_num_rows($sql);
if ($num != 0) {
    while ($user = mysqli_fetch_assoc($sql)) {
        switch ($user['Status']) {
            case '1':
                $_SESSION['ses_id'] = session_id();
                $_SESSION['Username'] = $user['Username'];
                $_SESSION['Status'] = "librarian";
                // echo "JavaScript:window.location='../../view/librarian/librarian.php";
                break;

            case '2':
                $_SESSION['ses_id'] = session_id();
                $_SESSION['Username'] = $user['Username'];
                $_SESSION['Status'] = "member";
                // echo "JavaScript:window.location='../../view/member/member.php";
                break;
            case '3':
                $_SESSION['ses_id'] = session_id();
                $_SESSION['Username'] = $user['Username'];
                $_SESSION['Status'] = "administratior";
                break;

            default:
                break;
        }
        if ($user['IsBan'] == 1 || $user['IsDelete'] == 1) {
            $data = array(
                'IsResult' => false,
                'ermsg' => 'บัญชีของคุณถูกระงับใช้ หรือ ถูกลบ',
            );
            echo json_encode($data);
            exit;
        }
        $_SESSION['user_status'] = $user;
        $data = array(
            'IsResult' => true,
            'Status' => $user['Status']
        );
        echo json_encode($data);
    }
} else {
    $data = array(
        'IsResult' => false,
        'ermsg' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
    );
    echo json_encode($data);
    //$_SESSION['error'] = 'Invalid Username or Password';
    // header("refresh: 1; url= /lib/view/login/login.php");
}
