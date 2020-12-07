<?php
function month_year($date, $type)
{
    $str = convert_datethai_monthfull($date);
    $result = explode(' ', $str);
    if ($type == 'byyear') {
        $str = $result[1] . ' ' . $result[2];
    }
    return $str;
};
// echo $start_date . '</br>';
// echo $start_month . '</br>';
// echo $start_year . '</br>';
$title_date = '';
if ($subreporttype == 'byyear') {
    $strsql = "YEAR(Borrow) = " . "'$start_year'" . "AND Member = '$mem_info'" . " GROUP BY month(Borrow)";
    $title_date = 'ปี ' . (543 + $start_year);
} elseif ($subreporttype == 'byperiod') {
    $split = explode('-', $start_month);
    $strsql = "MONTH(Borrow) = " . "'$split[1]'" . " AND YEAR(Borrow) = " . "'$split[0]'" . "AND Member = '$mem_info'" . " GROUP BY Borrow";
    $getsubdate = convert_datethai_monthfull($start_month . '-15');
    $subdate = explode(' ', $getsubdate);
    $title_date = $subdate[1] . ' ' . $subdate[2];
} else {
    $strsql = "Borrow = " . "'$start_date'" . "AND Member = '$mem_info'" . " GROUP BY Borrow";
    $title_date = convert_datethai_monthfull($start_date);
}
// echo '<br>' . $strsql;

/// region query data ///
$getmem_data = get_data_report("SELECT CONCAT(FName,' ',LName) AS FullName FROM Member WHERE ID = '$mem_info'");
$get_data = get_data_report("SELECT Borrow,count(Book) AS SUMBOOK FROM borrowandreturn WHERE $strsql");
/// end region ///
echo '<h4>' . "รายงานสถิติการยืมทรัพยากรของ " . $getmem_data[0]['FullName'] . " เมื่อ " . $title_date . '</h4>';
// echo '<pre>';
// print_r($get_data);
if (count($get_data) > 0) {?>
    <div>
      <table class="table table-bordered table-striped">
        <thead>
          <tr class="warning">
            <th style="vertical-align: middle;" class="t-cen" rowspan="2">ประจำ</th><th class="t-cen" colspan="4">วัสดุตีพิมพ์</th> <th class="t-cen" colspan="3">วัสดุไม่ตีพิมพ์</th> <th style="vertical-align: middle;" class="t-cen" rowspan="2">รวม</th>
          </tr>
          <tr class="warning">
            <th class="t-cen">หนังสือ</th><th class="t-cen">วารสาร</th><th class="t-cen">จุลสาร</th><th class="t-cen">กฤตภาค</th><th class="t-cen">โสตทัศนวัสดุ</th><th class="t-cen">วัสดุย่อส่วน</th><th class="t-cen">วัสดุอิเล็กทรอนิกส์</th>
          </tr>
        </thead>
        <tbody>
          <?php
$sumcol1 = 0;
    $sumcol2 = 0;
    $sumcol3 = 0;
    $sumcol4 = 0;
    $sumcol5 = 0;
    $sumcol6 = 0;
    $sumcol7 = 0;
    foreach ($get_data as $count => $data) {
        $stack = '<tr>';
        $stack .= '<td class="t-right">' . month_year($data['Borrow'], $subreporttype) . '</td>';
        $stack .= '<td class="t-cen">' . ($data['SUMBOOK'] != 0 ? $data['SUMBOOK'] : '-') . '</td>';
        $sumcol1 = $sumcol1 + $data['SUMBOOK'];
        $stack .= '<td class="t-cen">' . ($data['SUMBOOK'] != 0 ? $data['SUMBOOK'] : '-') . '</td>';
        $sumcol2 = $sumcol2 + $data['SUMBOOK'];
        $stack .= '<td class="t-cen">' . ($data['SUMBOOK'] != 0 ? $data['SUMBOOK'] : '-') . '</td>';
        $sumcol3 = $sumcol3 + $data['SUMBOOK'];
        $stack .= '<td class="t-cen">' . ($data['SUMBOOK'] != 0 ? $data['SUMBOOK'] : '-') . '</td>';
        $sumcol4 = $sumcol4 + $data['SUMBOOK'];
        $stack .= '<td class="t-cen">' . ($data['SUMBOOK'] != 0 ? $data['SUMBOOK'] : '-') . '</td>';
        $sumcol5 = $sumcol5 + $data['SUMBOOK'];
        $stack .= '<td class="t-cen">' . ($data['SUMBOOK'] != 0 ? $data['SUMBOOK'] : '-') . '</td>';
        $sumcol6 = $sumcol6 + $data['SUMBOOK'];
        $stack .= '<td class="t-cen">' . ($data['SUMBOOK'] != 0 ? $data['SUMBOOK'] : '-') . '</td>';
        $sumcol7 = $sumcol7 + $data['SUMBOOK'];
        $stack .= '<td class="t-cen">' . ($data['SUMBOOK'] + $data['SUMBOOK'] + $data['SUMBOOK'] + $data['SUMBOOK'] + $data['SUMBOOK'] + $data['SUMBOOK'] + $data['SUMBOOK']) . '</td>';
        $stack .= '</tr>';
        echo $stack;
    }
    $stack = '<tr>';
    $stack .= '<th>รวม</th>';
    $stack .= '<th>' . ($sumcol1 != 0 ? $sumcol1 : '-') . '</th>';
    $stack .= '<th>' . ($sumcol2 != 0 ? $sumcol2 : '-') . '</th>';
    $stack .= '<th>' . ($sumcol3 != 0 ? $sumcol3 : '-') . '</th>';
    $stack .= '<th>' . ($sumcol4 != 0 ? $sumcol4 : '-') . '</th>';
    $stack .= '<th>' . ($sumcol5 != 0 ? $sumcol5 : '-') . '</th>';
    $stack .= '<th>' . ($sumcol6 != 0 ? $sumcol6 : '-') . '</th>';
    $stack .= '<th>' . ($sumcol7 != 0 ? $sumcol7 : '-') . '</th>';
    $stack .= '<th>' . ($sumcol1 + $sumcol2 + $sumcol3 + $sumcol4 + $sumcol5 + $sumcol6 + $sumcol7) . '</th>';
    $stack .= '</tr>';
    echo $stack;
    ?>
    </tbody>
      </table>

      </body>
      <!-- <footer>
        <br/>
        <form target="_blank" action="AllReport/export/FineperUser_Export.php" method="post">
          <input type="hidden" value='<?=json_encode($get_data)?>' name="report_data">
          <input type="hidden" value='<?=$start_date?>' name="start_date">
          <input type="submit" value="Export PDF.">
        </form>
      </footer> -->
      <?php
} else {echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');}?>
    </div>
</html>
<style>
.table-report {
  background-color: black;
  color: white;
  margin: 20px;
  padding: 20px;
}
.t-cen{
  text-align: center;
}
.t-right{
  text-align: right;
}
.th-middle{
  vertical-align: middle;
}
</style>



