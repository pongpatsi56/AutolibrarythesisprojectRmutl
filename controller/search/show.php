
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";

$stack = '';
foreach ($_SESSION['ISBN_Cart'] as $key => $value) {
    $stack .= " OR ISBN = $value";
}
$sql = "SELECT Title,Author,Publisher,ISBN FROM databibliography WHERE ISBN != null$stack  ";
$res = $conn->query($sql);
$r = 1;?>

<table >
        <thead>
            <tr>
            <th>ลำดับ</th>
                <th>Title</th>
                <th >Author</th>
                <th>Publisher</th>
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
        </tr>
      <?php $r = $r + 1;}}
?>