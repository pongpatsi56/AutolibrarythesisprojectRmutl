<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/ppat.php";

$sql = "SELECT Title,Author,Publisher,ISBN FROM databibliography ";

if (isset($_GET['type']) && $_GET['type'] != "" && isset($_GET['text_search']) && $_GET['text_search'] != "") {
    $sql .= " WHERE {$_GET['type']}  LIKE '%{$_GET['text_search']}%' ";
} else {
}




$result = $conn->query($sql);

@$total = mysqli_num_rows($result);
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
$sql .= " ORDER BY Title ASC LIMIT " . $s_page . ",$e_page";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { ?>
   	<tr>
    <td height="40"><?php echo $row['Title']; ?></td>
    <td height="40" ><?php echo $row['Author']; ?></td>
    <td height="40" ><?php echo $row['Publisher']; ?></td>
    <?php
    if (@$_SESSION["btn"][$row['ISBN']] == 1) { ?>
        <td><a class="text-warning" href="JavaScript:window.location='/lib/model/session/remove_cart.php? ISBN=<?php echo $row['ISBN']; ?>';"> &nbsp;Remove</a> </td>
    <?php 
} else { ?>
        <td ><a class="btn btn-link" href="JavaScript:window.location='/lib/model/session/add_cart.php? ISBN=<?php echo $row['ISBN']; ?>';"> &nbsp;Add to Cart</a> </td>
    <?php 
}
?>
    </tr>
  <?php 
}
}
$_count_cart = (@isset($_SESSION['ISBN_Cart']) ? count(@$_SESSION['ISBN_Cart']) : 0);
//  if (isset($_SESSION['ISBN_Cart'])) {
//      $_count_cart = count($_SESSION['ISBN_Cart']);
//  }
?>
<!-- <input type="button" id="confirm" onclick="confirm()" value="confirm"> -->
<form action="" method="post">
<input type="button" class=" btn btn-danger" id="shwcart" onclick="showcart()" value="CART <?php echo "(". $_count_cart . ")"  ?>">

</form>
<br><br>
<?php
#session_unset();
?>
<script src="/lib/script/reservations.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

