<br>
<br>

<?php
$IDmember = $user_status['User_ID'];
$result = $conn->query("SELECT * FROM borrowandreturn WHERE Member = '$IDmember'");
$num = mysqli_num_rows($result);
if ($num != 0) {
    ?>
    <style type="text/css">
        /* class สำหรับแถวส่วนหัวของตาราง */
        .tr_head {
            background-color: #fff;
            color: #050505;
        }

        /* class สำหรับแถวแรกของรายละเอียด */
        .tr_odd {
            background-color: #ddd;
        }

        /* class สำหรับแถวสองของรายละเอียด */
        .tr_even {
            background-color: #eee;
        }

        td {
            padding: 3px;
        }

        th {
            padding: 5px;
            text-align: center;
        }
    </style>
    <table id="mytable" align="center" border="5" bgcolor="#FFFFFF">
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อหนังสือ</th>
            <th class="bg-success">วันที่ยืม</th>
            <th class="bg-danger">กำหนดส่ง</th>
            <th class="bg-warning">สถานะ</th>
        </tr>

        <?php
            $no = 1;
            while ($showdata = mysqli_fetch_assoc($result)) {
                $status = ($showdata['Due'] == "0000-00-00") ? '<span class="text-warning">ยังไม่ได้คืน</span>' : '<span class="text-success">คืนแล้ว</span>';
                $style = ($showdata['Returns'] < $now) ? ' class="text-danger"' : '';
                ?>
            <tr>
                <td width="20px" style="text-align:center"><?php echo $no;
                                                                    $no++ ?></td>
                <td width="600px" height="40">
                    <center><?php echo gettitleandauthorbook($showdata['Book']) ?>
                </td>
                <td width="130px" style="text-align:right">
                    <center><?php echo convert_datethai_monthdot($showdata['Borrow']) ?>
                </td>
                <td width="130px" style="text-align:right">
                    <center><?php echo convert_datethai_monthdot($showdata['Returns']) ?>
                </td>
                <td width="130px" style="text-align:center">
                    <center><?php echo $status ?>
                </td>
            </tr>
    <?php }
    } else {
        echo '<h1>ไม่พบข้อมูล</h1>';
    }
    ?>
    </table>
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
    </script>