<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/helper/datehelper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/helper/calsubfield.php';

///region query data///
            $datas = array();
            $getlibdata = get_data_report("SELECT * FROM librarian JOIN borrowandreturn ON librarian.ID = borrowandreturn.Librarian WHERE borrowandreturn.Borrow = '$start_date' GROUP BY borrowandreturn.Librarian");
            foreach ($getlibdata as $key) {
                $getlibID = $key['Librarian'];
                $getmemdata = get_data_report("SELECT * FROM member JOIN borrowandreturn ON member.ID = borrowandreturn.Member WHERE borrowandreturn.librarian = '$getlibID' AND borrowandreturn.Borrow = '$start_date'
                GROUP BY borrowandreturn.Member ");
                $libdata = array(
                    'Librarian' => $key['Librarian'],
                    'FName' => $key['FName'],
                    'LName' => $key['LName'],
                    'submem' => array(),
                );
                foreach ($getmemdata as $key1) {
                    $getID = $key1['Member'];
                    $getbookdata = querydatareport("SELECT *,Book AS Barcode  FROM borrowandreturn 
                        WHERE borrowandreturn.Member = '$getID' AND borrowandreturn.Borrow = '$start_date' ");
                    $memdata = array(
                        'Member' => $key1['Member'],
                        'FName' => $key1['FName'],
                        'LName' => $key1['LName'],
                        'subbook' => $getbookdata,
                    );
                    if (count($getbookdata) > 0) {
                        array_push($libdata['submem'], $memdata);
                    }
                }
                if (count($libdata['submem']) > 0) {
                    array_push($datas, $libdata);
                }
            }
            // echo "<pre>";
            // print_r($datas);
            // echo "</pre>";
            
            //// end region ///
            echo '<h4>' . "รายงานสถิติการยืมทรัพยากร ประจำวันที่ " . convert_datethai_monthdot($start_date) . '</h4>';
            if (count($datas) > 0) { ?>
            <style type="text/css">
                /* class สำหรับแถวส่วนหัวของตาราง */
                .tr_head {
                    background-color: #eee;
                    color: #050505;
                }
            
                /* class สำหรับแถวแรกของรายละเอียด */
                .tr_odd {
                    background-color: #F8F8F8;
                }
            
                /* class สำหรับแถวสองของรายละเอียด */
                .tr_even {
                    background-color: #ddd;
                }
            </style>
            <div>
                <table class="table table-bordered table-striped" width="100%" border="0">
                    <tr>
                        <th>ลำดับ</th>
                        <th>ผู้ให้บริการยืม</th>
                        <th>รายการสมาชิก</th>
                        <th>หมายเลข ISBN</th>
                        <th>ชื่อเรื่อง</th>
                        <th>กำหนดส่ง</th>
                    </tr>
                    <?php
                        $no = 1;
                        foreach ($datas as $data) {
                            echo '<tr><td></td><th>' . $data['FName'] . ' ' . $data['LName'] . '</th><td></td><td></td><td></td><td></td></tr>';
                            if (count($data['submem']) > 0) {
                                foreach ($data['submem'] as $submem) {
                                    echo '<tr><td></td><td></td><th>' . $submem['FName'] . ' ' . $submem['LName'] . '</th><td></td><td></td><td></td></tr>';
                                    if (count($submem['subbook']) > 0) {
                                        foreach ($submem['subbook'] as $barcode => $subbook) {
                                            echo '<tr><td>' . $no . '</td><td></td><td></td>';
                                            echo '<td>' . (isset($subbook['ISBN']['#a']) ? $subbook['ISBN']['#a'] : '-') . '</td>';
                                            echo '<td>' . (isset($subbook['Title']['#a']) ? $subbook['Title']['#a'] : '-') . '</td>';
                                            $dateshow = convert_datethai_monthdot($subbook['Returns']);
                                            echo '<td>' . $dateshow . '</td></tr>';
                                            $no = $no + 1;
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                </table>
                </body>
                <footer>
                    <br />
                    <form target="_blank" action="AllReport/export/BorrowResource_Export.php" method="post">
                        <input type="hidden" value='<?= json_encode($datas) ?>' name="report_data">
                        <input type="hidden" value='<?= $start_date ?>' name="start_date">
                        <input type="submit" class="btn btn-success" value="Export PDF.">
                    </form>
                </footer>
                <?php
                } else {
                    echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
                } ?>
            </div>
            
            </html>