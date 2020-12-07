<?php  
	if(isset($_GET['confirm'])){
	date_default_timezone_set('asia/bangkok');
	$n = 1;
	$date = date('Y-m-d');
	$date1 = str_replace('-', '/', $date);
	$n_date = date('Y-m-d',strtotime($date1 . "+7 days"));

	$username = $_SESSION['Username'];
	$mem = $_SESSION['member'][7];
	$b = $_SESSION['book'][3];

	$sql1 = "INSERT INTO borrowandreturn('Librarian','Member','Book','Borrow','Due','Return','Status','ID') VALUES ('$username','$mem','$b','$date',NULL,'$n_date','$n',NULL)";
	
	mysqli_query($conn,$sql1);
		
	$sql2 = "UPDATE ";
	$conn->query($sql2);
	}
	else{

	}


	?>