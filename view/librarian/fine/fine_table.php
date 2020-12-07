
    <?php
        if (isset($_GET['text_member'])) {
    ?>


<fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em;">
    <legend style="width: auto;padding:0 5px 0 5px;">สถานะหนังสือ</legend>
    <br>
    <?php

    $member = $_GET['text_member'];


    $sql = "SELECT * FROM borrowandreturn WHERE Member = '$member' AND Due_status = '0' ";
    $data = $conn->query($sql);
    $row = $data->num_rows;
    for ($i = 0; $i < $row; $i++) {
        $data_main[$i] = $data->fetch_assoc();
    }

    $stack = "(";
    for ($i = 0; $i < $row; $i++) {
        $stack .= "'" . $data_main[$i]['Librarian'] . "',";
    }
    $stack = substr($stack, 0, strlen($stack) - 1);
    $stack .= ")";

    $sql_lib = "SELECT FName,LName,Username FROM librarian WHERE Username IN $stack ";
    $data = $conn->query($sql_lib);
    for ($i = 0; $i < $row; $i++) {
        $data_lib[$i] = $data->fetch_assoc();
    }

    $sql_member = "SELECT FName,LName FROM member WHERE ID = '$member' ";
    $data = $conn->query($sql_member);
    $data_member = $data->fetch_assoc();

    $stack = "(";
    for ($i = 0; $i < $row; $i++) {
        $stack .= $data_main[$i]['Book'] . ",";
    }
    $stack = substr($stack, 0, strlen($stack) - 1);
    $stack .= ")";
    $sql_lib = "SELECT databib.Subfield,databib.Barcode,rfidandstatus.status as Status,borrowandreturn.Due,borrowandreturn.member 
    FROM borrowandreturn 
    JOIN rfidandstatus ON borrowandreturn.Book=rfidandstatus.Barcode 
    JOIN databib ON borrowandreturn.Book=databib.Barcode 
    WHERE databib.Field = '245'
    AND databib.Barcode IN $stack
    AND borrowandreturn.member = '$member'";
    $data = $conn->query($sql_lib);
    for ($i = 0; $i < $row; $i++) {
        $data_book[$i] = $data->fetch_assoc();
    }

    $stack = "(";
    for ($i = 0; $i < $row; $i++) {
        $stack .= $data_main[$i]['ID'] . ",";
    }
    $stack = substr($stack, 0, strlen($stack) - 1);
    $stack .= ")";
    $sql_fine = "SELECT * FROM finebook WHERE Borrow_ID IN $stack";
    $data = $conn->query($sql_fine);
    if (isset($data) == 1 && $conn->query($sql_fine) == TRUE) {
        for ($i = 0; $i < mysqli_num_rows($data); $i++) {
            $data_fine[$i] = $data->fetch_assoc();
        }
    } else {
        $data_fine = NULL;
    }

    ?>
    <div class="append_found"></div>

    <table class="table table-bordered table-hover table_fine" id="mytable" align="center" border="2" width="100%">
        <thead>
            <tr>
                <th width="20%">ทรัพยากรณ์</th>
                <th width="10%">ยืมวันที่</th>
                <th width="10%">กำหนดคืน</th>
                <th width="10%">วันที่คืน</th>
                <th width="10%">สถานะ</th>
                <th width="14%">เกินกำหนด(วัน)</th>
                <th width="13%">การชำระ</th>
                <th width="13%">หมายเหตุ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $cal_ret = array();
            $cal_due = array();

            if (isset($row)) {
                for ($i = 0; $i < $row; $i++) {
                    $startdate = date_create($data_main[$i]['Returns']);
                    $enddate = date_create($data_main[$i]['Due']);
                    $datediff = date_diff($startdate, $enddate, FALSE);
                    for ($j = 0; $j < count($data_book); $j++) {
                        if ($data_main[$i]['Book'] == $data_book[$j]['Barcode']) {
                            for ($k = 0; $k < count($data_book); $k++) {
                                if ($data_main[$i]['ID'] == $data_fine[$k]['Borrow_ID']) {
                                    if ($datediff->invert == 0 || $data_book[$j]['Status'] == 9) {
                                        ?>
                                        <tr>
                                            <?php
                                                                        if ($data_book[$j]['Barcode'] == $data_main[$i]['Book']) {
                                                                            if ($data_book[$j] != "") {
                                                                                $data_book_already_cut = calsub_arr($data_book[$j]['Subfield'], 245);
                                                                            }
                                                                            ?><td><?php echo $data_book_already_cut['Title']['#a']; ?></td>
                                            <?php
                                                                        }
                                                                        ?>
                                            <td>
                                                <?php
                                                                            $day_con = convert_datethai_monthdot($data_main[$i]['Borrow']);
                                                                            echo $day_con;
                                                                            ?>
                                            </td>
                                            <td>
                                                <?php
                                                                            $day_con = convert_datethai_monthdot($data_main[$i]['Returns']);
                                                                            echo $day_con;
                                                                            ?>
                                            </td>
                                            <td>
                                                <?php
                                                                            $day_con = convert_datethai_monthdot($data_main[$i]['Due']);
                                                                            echo $day_con;
                                                                            ?>
                                            </td>
                                            <?php
                                                                        if ($data_book[$j]['Barcode'] == $data_main[$i]['Book']) {
                                                                            if ($data_book[$j]['Status'] == 1) {
                                                                                ?><td><?php echo "ยังไม่ได้คืน"; ?></td><?php

                                                                                                        } elseif ($data_book[$j]['Status'] == 9 && $data_main[$i]['Due_Status'] == 0) {
                                                                                                            ?><td><?php echo "แจ้งหายแล้ว"; ?></td><?php


                                                                                                        } else {
                                                                                                            ?><td><?php echo "คืนแล้ว"; ?></td><?php
                                                                                                    }
                                                                                                }
                                                                                                $startdate = date_create($data_main[$i]['Returns']);
                                                                                                $enddate = date_create($data_main[$i]['Due']);
                                                                                                $datediff = date_diff($startdate, $enddate, false);

                                                                                                if ($datediff->invert == 1) {
                                                                                                    ?><td><?php echo "คืนก่อนกำหนด(" . $datediff->format('%a') . ")";; ?></td><?php
                                                                                                                            } else {
                                                                                                                                ?><td><?php echo $datediff->format('%r%a');; ?></td><?php
                                                                                                            }

                                                                                                            if (isset($data_fine) == 1) {
                                                                                                                if ($data_fine[$k]['Borrow_ID'] == $data_main[$i]['ID']) {
                                                                                                                    if ($data_fine[$k]['Payment_Date'] == "0000-00-00 00:00:00") {
                                                                                                                        ?><td><?php echo "ยังไม่ได้ชำระ"; ?></td>
                                                        <input type="hidden" class="namebook" value="<?php echo $data_fine[$k]['Borrow_ID']; ?>">
                                                    <?php

                                                                                        } else {
                                                                                            ?><td><?php echo "ชำระแล้ว"; ?></td><?php

                                                                                                            }
                                                                                                        }
                                                                                                        if ($data_fine[$k]['Type'] == 1) {
                                                                                                            ?><td><?php echo "คืนเกินกำหนด"; ?></td><?php
                                                                                                            } elseif ($data_fine[$k]['Type'] == 2) {
                                                                                                                ?><td><?php echo "สูญหาย"; ?></td><?php
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                        </tr>
            <?php
                                    }
                                }
                            }
                        }
                    }
                }
            }
            ?>
            <tr>
               <center> <td><button  class="btn btn-success" id='myModal' style='
    margin-left: 60';
">จ่ายเงิน</button></td>
            </tr>
        </tbody>
    </table>
</fieldset>
</section>
    <?php
        }
    ?>
<script>
    $(document).ready(function() {
        check_table_fine();
    });
</script>