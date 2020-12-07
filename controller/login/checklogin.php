<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

// variable
$username = $_POST['username'];
$password = $_POST['password'];
{
	$sql = mysqli_query($conn, "SELECT *
	FROM userstatus u
		left JOIN permission p ON u.status = p.Per_ID
		LEFT JOIN
		(                SELECT ID, Username, Password, FName, LName
			FROM librarian
		UNION
			SELECT ID, Username, Password, FName, LName
			FROM member) AS result ON u.User_ID = result.ID
	WHERE IsDelete = 0 AND result.username = '$username' AND result.Password = '$password'");
	$num = mysqli_num_rows($sql);
	{
		if ($num != 0) {
			while ($user = mysqli_fetch_assoc($sql)) {
				switch ($user['Status']) {
					case '1':
						$_SESSION['ses_id'] = session_id();
						$_SESSION['Username'] = $user['Username'];
						$_SESSION['Status'] = "librarian";
						header("refresh: 1; url= /lib/view/librarian/librarian.php ");
						break;

					case '2':
						$_SESSION['ses_id'] = session_id();
						$_SESSION['Username'] = $user['Username'];
						$_SESSION['Status'] = "member";
						header("refresh: 1; url= /lib/view/member/member.php");
						break;

					default:
						break;
				}
				$_SESSION['user_status'] = $user;
			}
		} else {
			$_SESSION['error'] = 'Invalid Username or Password';
			header("refresh: 1; url= /lib/view/login/login.php");
		}
	}
}
