<?php
$IDmember = $user_status['User_ID'];
$result = $conn->query("SELECT * FROM borrowandreturn WHERE Member = '$IDmember' AND Due = '0000-00-00'");
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
<br>    <br><table id="mytable" align="center" border="0" bgcolor="#FFFFFF">
        <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">ชื่อหนังสือ</th>
            <th scope="col" class="bg-success">วันที่ยืม</th>
            <th scope="col" class="bg-danger">กำหนดส่ง</th>
        </tr>

        <?php
            $no = 1;
            while ($showdata = mysqli_fetch_assoc($result)) {
                $style = ($showdata['Returns'] < $now) ? ' class="text-danger"' : '';
                ?>
            <tr>
                <td width="20px" height="40">
                    <center><?php echo $no;
                                    ++$no ?>
                </td>
                <td width="600px">
                    <center><?php echo  gettitleandauthorbook($showdata['Book']) ?>
                </td>
                <td width="195px" class="text-success">
                    <center><?php echo convert_datethai_monthdot($showdata['Borrow']) ?>
                </td>
                <td width="195px">
                    <center><?php echo '<span' . $style . ' >' .  convert_datethai_monthdot($showdata['Returns']) . '</span>' ?>
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