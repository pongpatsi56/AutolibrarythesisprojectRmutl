<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<br><br><br>
<section class="container">
<div class="row" style="padding-top: 20px;padding-bottom: 200px; background-color: #eee;">
<div class="col-md-12">
<!-- <a href="../librarian/librarian.php" class="btn btn-danger"><i class='far fa-arrow-alt-circle-left' style='font-size:20px'></i>&nbsp;BACK</a><br><br><br> -->
<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
$stack = '';
if (@$_SESSION['ISBN_Cart']) {
    foreach ($_SESSION['ISBN_Cart'] as $key => $value) {
        $stack .= " OR ISBN = $value";
    }
    $sql = "SELECT * FROM databibliography WHERE ISBN != null$stack  ";
    $res = $conn->query($sql);
    $r = 1;?>
<table >
        <thead>
            <tr>
            <th>ลำดับ</th>
            <th>Title</th>
            <th >Author</th>
            <th>Publisher</th>
            <th>Status</th>
            <!-- <th>Call Number</th>
            <th>Location</th> -->
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php
if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {?>
           <tr>
           <td ><?php echo $r; ?></td>
        <td ><?php echo $row['Title']; ?></td>
        <td><?php echo $row['Author']; ?></td>
        <td><?php echo $row['Publisher']; ?></td>
        <td><?php switch ($row['Status']) {
            case '0':
                echo "Available";
                break;
            default:
                echo "Not Available";
                break;
        }?></td>
        </tr>
      <?php $r = $r + 1;
        }
        ?><br>&nbsp;
    <input type="button" class="btn btn-success" id="confirm" onclick="confirm_cart()" value="confirm">
	<form method="get">&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-success" name="clearcart">clearcart</button></form>
    <!-- <input type="button" id="clearcart" onclick="clear_cart()" value="clearcart"> -->

    <?php
if (isset($_GET["clearcart"])) { ////// เช็ค clearcart //////
            unset($_SESSION['ISBN_Cart']);
            unset($_SESSION['btn']);
            echo "<script>location.reload();window.opener.location.reload();</script>";
        }
    }
} else {
    echo "ไม่พบหนังสือที่ต้องการจอง";
}
?>

<script src="/lib/script/reservations.js"></script>