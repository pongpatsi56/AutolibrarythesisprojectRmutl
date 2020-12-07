
<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/ppat.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/model/reportmodel.php";

$sql = "SELECT * FROM listbuy ";
$data = $conn->query($sql);
for ($i=0; $i < mysqli_num_rows($data); $i++) { 
    $row[$i] = $data->fetch_assoc();
}

/////// pagination //////////
$actual_link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$getURL = explode("&nPage=", $actual_link);
$Num_Rows = count($row);
$Per_Page = $_GET['perPage'];
$Page = $_GET["nPage"];
$paginate = "&nPage=" . '1' . "&perPage=" . $Per_Page;
if (!$_GET["nPage"]) {
    $Page = 1;
}

$Prev_Page = $Page - 1;
$Next_Page = $Page + 1;

$Page_Start = (($Per_Page * $Page) - $Per_Page);
$pagi_sql = "SELECT * FROM listbuy LIMIT " . $Page_Start . ",$Per_Page";

$res_pagi_sql = get_data_report($pagi_sql);

if ($Num_Rows <= $Per_Page) {
    $Num_Pages = 1;
} else if (($Num_Rows % $Per_Page) == 0) {
    $Num_Pages = ($Num_Rows / $Per_Page);
} else {
    $Num_Pages = ($Num_Rows / $Per_Page) + 1;
    $Num_Pages = (int) $Num_Pages;
}
/////////////////////////////

?>
 <br>
  <br>
  <br>
<section class="container ">
    <div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #eee;">
        <div class="col-md-12">
            <a href="../librarian/buy.php"><img src='/lib/iconimg/left-arrow.png' width='30' height='30'></i></a><br><br><br>
           <center> <form action="bowrrow.php">
                แสดง<span>:
                    <select name="perPage" id="perPage" style="width:48px;">
                        <option value="10" <?= (isset($_GET['perPage']) && $_GET['perPage'] == "10") ? " selected" : "" ?>>10</option>
                        <option value="15" <?= (isset($_GET['perPage']) && $_GET['perPage'] == "15") ? " selected" : "" ?>>15</option>
                        <option value="20" <?= (isset($_GET['perPage']) && $_GET['perPage'] == "20") ? " selected" : "" ?>>20</option>
                    </select>&nbsp; ต่อหน้า</span>
                    <br>
                    <br>
                <style type="text/css">
                    .pagination-wrapper {
                        /* text-align: center; */
                        /* margin: 40px 0; */
                    }

                    .pagination {
                        display: inline-block;
                        /* height: 70px; */
                        /* margin-top: 70px; */
                        padding: 0 25px;
                        border-radius: 35px;
                        background-color: #eee;
                    }

                    @media only screen and (max-width: 1199px) {
                        .pagination {
                            /* height: 50px; */
                            margin-top: 50px;
                            padding: 0 10px;
                            border-radius: 25px;
                        }
                    }

                    .page-numbers {
                        display: block;
                        padding: 0 15px;
                        float: left;
                        transition: 400ms ease;
                        color: #595959;
                        font-size: 12px;
                        letter-spacing: 0.1em;
                        line-height: 20px;
                    }

                    .page-numbers:hover,
                    .page-numbers.current {
                        background-color: #b97e3a;
                        color: #fff;
                    }

                    .page-numbers.prev:hover,
                    .page-numbers.next:hover {
                        background-color: transparent;
                        color: #b97e3a;
                    }

                    @media only screen and (max-width: 1199px) {
                        .page-numbers {
                            padding: 0 15px;
                            font-size: 12px;
                            line-height: 20px;
                        }
                    }

                    @media only screen and (min-width: 120px) and (max-width: 1024px) {
                        .page-numbers {
                            padding: 0 14px;
                            display: none;
                        }

                        .page-numbers:nth-of-type(2) {
                            position: relative;
                            padding-right: 50px;
                        }

                        .page-numbers:nth-of-type(2)::after {
                            content: '...';
                            position: absolute;
                            font-size: 12px;
                            top: 0;
                            left: 45px;
                        }

                        .page-numbers:nth-child(-n+3),
                        .page-numbers:nth-last-child(-n+3) {
                            display: block;
                        }

                        .page-numbers:nth-last-child(-n+4) {
                            padding-right: 14px;
                        }

                        .page-numbers:nth-last-child(-n+4)::after {
                            content: none;
                        }
                    }

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
              
                <table id="mytable" border="0">
                    <thead>
                        <tr>
                            <th scope="col" width="15%" align='left'>หมวด</th>
                            <th scope="col" width="13%" align='left'>ชื่อเรื่อง</th>
                            <th scope="col" width="10%" align='left'>ชื่อผู้แต่ง</th>
                            <th width="18%" align='left'>สำนักพิมพ์</th>
                            <th width="5%" align='left'>ราคา</th>
                            <th width="8%" align='left'>จำนวน</th>
                            <th width="18%" align='left'>พิมพ์จาก</th>
                            <th width="10%" align='left'>วันที่ซื้อ</th>
                            <th width="8%" >แก้ไข</th>
                            <th width="8%" >ลบ</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        for ($i = 0; $i < count($res_pagi_sql); $i++) {
                            ?>
                        <tr>

                            <td height="40"><?php echo $res_pagi_sql[$i]['group1']; ?></td>
                            <td height="40"><?php echo $res_pagi_sql[$i]['Title']; ?></td>
                            <td height="40"><?php echo $res_pagi_sql[$i]['Author']; ?></td>
                            <td height="40"><?php echo $res_pagi_sql[$i]['Publisher']; ?></td>
                            <td height="40"><?php echo $res_pagi_sql[$i]['Price']; ?></td>
                            <td height="40"><?php echo $res_pagi_sql[$i]['Quantiny']; ?></td>
                            <td height="40"><?php echo $res_pagi_sql[$i]['From1']; ?></td>
                            <td height="40"><?php echo $res_pagi_sql[$i]['Date1']; ?></td>
                            <td><a class='btn btn-sm btn-warning' href="editbuy.php?Bibitem=<?= $row[$i]['ID'] ?>">
                                    <i></i> &nbsp;แก้ไข</a> </td>
                            <td><a class='btn btn-sm btn-danger' href="deletebuy.php?Bibitem=<?= $row[$i]['ID'] ?>">
                                    <i></i> &nbsp;ลบ</a> </td>


                        </tr>
                        <?php
                        }
                        ?>
                </table>
                <center>
                <div class="pagination-wrapper">
                    <div class="pagination">
                        <span class="prev page-numbers">Page :</span>
                        <?php
                        if ($Prev_Page) {
                            // echo " <a href='$getURL[0]&nPage=$Prev_Page&perPage=$Per_Page'><< Back</a> ";
                            echo "<a class='prev page-numbers'href='$getURL[0]&nPage=$Prev_Page&perPage=$Per_Page'>prev</a>";
                        }

                        for ($i = 1; $i <= $Num_Pages; $i++) {
                            if ($i != $Page) {
                                // echo "[ <a href='$getURL[0]&nPage=$i&perPage=$Per_Page'>$i</a> ]";
                                echo " <a class='page-numbers' href='$getURL[0]&nPage=$i&perPage=$Per_Page'>$i</a>";
                            } else {
                                echo "<span aria-current='page' class='page-numbers current'> $i </span>";
                            }
                        }
                        if ($Page != $Num_Pages) {
                            // echo " <a href ='$getURL[0]&nPage=$Next_Page&perPage=$Per_Page'>Next>></a> ";
                            echo "<a class='next page-numbers' href='$getURL[0]&nPage=$Next_Page&perPage=$Per_Page'>next</a>";
                        }
                        ?>
                    </div>
                </div>
                <script language="javascript">
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
                    $(document).on("change", "#perPage", function(e) {
                        var getperPage = $("#perPage").val();
                        window.location.replace(
                            "/lib/view/librarian/listbuy.php?" + '&nPage=1&' + "perPage=" + getperPage
                        );
                    });
                </script>