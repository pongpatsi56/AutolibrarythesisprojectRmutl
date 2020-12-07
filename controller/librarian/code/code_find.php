<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/ppat.php";
?>

<?php


$sql = "SELECT * FROM field ";

if (isset($_GET['search_text']) && $_GET['search_text'] != "") {
    $sql .= " WHERE Field LIKE '%{$_GET['search_text']}%' ";
}

$result = $conn->query($sql);

$total = mysqli_num_rows($result);
if (isset($_GET['sel_page'])) {
    $e_page = $_GET['sel_page']; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า
} else {
    $e_page = 10;
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
$sql .= " GROUP BY field.Field " . " ORDER BY field.Field ASC LIMIT " . $s_page . ",$e_page";
$result = $conn->query($sql);


?>
<style type="text/css">
    /* class สำหรับแถวส่วนหัวของตาราง */
    .tr_head {
        background-color: #eee;
        color: #050505;
    }

    /* class สำหรับแถวแรกของรายละเอียด */
    .tr_odd {
        background-color: #fff;
    }

    /* class สำหรับแถวสองของรายละเอียด */
    .tr_even {
        background-color: #ddd;
    }
</style>
<div class="col-sm-2">
</div>
<div class="col-sm-8">
    <table class="table table-bordered table-hover" id="mytable" width="100%" border="0">
        <thead>
            <tr>
                <th scope="col" width="30%">
                    <center>เขตข้อมูล</center>
                </th>
                <th scope="col" width="70%">
                    <center>ลักษณะ</center>
                </th>
            </tr>
        </thead>
        <tbody>

            <?php


            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td height="40"><a class="btn btn-link" href="code_main.php?menu=3&code=<?php echo $row['Field']; ?>"><?php echo $row['Field']; ?></a></td>
                        <td height="40"><?php echo $row['Name']; ?></td>
                    </tr>
            <?php
                }
            }



            ?>

        </tbody>
    </table>
    <center>
        <?php
        page_navi($total, (isset($_GET['page1'])) ? $_GET['page1'] : 1, $e_page, $_GET);
        ?><script language="javascript">
            window.onload = function() {
                var a = document.getElementById('mytable'); // อ้างอิงตารางด้วยตัวแปร a
                for (i = 0; i < a.rows.length; i++) { // วน Loop นับจำนวนแถวในตาราง
                    if (i > 0) { // ตรวจสอบถ้าไม่ใช่แถวหัวข้อ
                        if (i % 2 == 1) { // ตรวจสอบถ้าไม่ใช่แถวรายละเอียด
                            a.rows[i].className = "tr_odd"; // กำหนด class แถวแรก
                        } else {
                            a.rows[i].className = "tr_even"; // กำหนด class แถวที่สอง
                        }
                    } else { // ถ้าเป็นแถวหัวข้อกำหนด class 
                        a.rows[i].className = "tr_head";
                    }
                }
            }
        </script>