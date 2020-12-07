<?php
////รายงานสรุปการลงวารสาร////
function month_year($date, $type)
{
  $str = convert_datethai_monthdot($date);
  $result = explode(' ', $str);
  if ($type == 'byyear') {
    $str = $result[2];
  }
  if ($type == 'byperiod') {
    $str = $result[1] . substr($result[2], 2);
  }
  if ($type == 'byall') {
    $str = $result[2];
  }
  return $str;
};
// echo $start_date . '</br>';
// echo $start_month . '</br>';
// echo $start_year . '</br>';
$title_date = '';
$fildate = '';
if ($subreporttype == 'byyear') {
  $strsql = "YEAR(log.Day) = " . "'$start_year'" . " GROUP BY databib_item.Bib_ID";
  $title_date = 'ปี ' . (543 + $start_year);
  $fildate = 'ปี';
} elseif ($subreporttype == 'byperiod') {
  $split = explode('-', $start_month);
  $strsql = "MONTH(log.Day) = " . "'$split[1]'" . " AND YEAR(log.Day) = " . "'$split[0]'" . " GROUP BY databib_item.Bib_ID";
  $getsubdate = convert_datethai_monthfull($start_month . '-15');
  $subdate = explode(' ', $getsubdate);
  $title_date = $subdate[1] . ' ' . $subdate[2];
  $fildate = 'เดือน/ปี';
} else {
  $strsql = "log.Day LIKE " . "'%$start_date%'" . " GROUP BY databib_item.Bib_ID";
  $title_date = convert_datethai_monthfull($start_date);
  $fildate = 'วัน/เดือน/ปี';
}
// echo '<br>' . $strsql;

/// region query data ///
$get_data = get_data_report("SELECT DATE(log.Day) AS Day,count(log.Day) as summ,databib_item.Bib_ID,CONCAT(librarian.FName,' ',librarian.LName) AS fullname FROM log
LEFT JOIN databib_item ON log.Item = databib_item.Barcode
LEFT JOIN databib ON databib_item.Bib_ID = databib.Bib_ID
LEFT JOIN librarian ON log.Librarian = librarian.ID
WHERE log.Tables = ('databib_item')
AND databib.Field = '964'
AND databib.SubField LIKE '%#g%'
AND NULLIF(log.librarian,'') IS NOT NULL AND  $strsql");
/// end region ///
echo '<h4>' . "รายงานสรุปการลงวารสาร เมื่อ " . $title_date . '</h4>';
if (count($get_data) > 0) { ?>
  <div>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="warning">
          <th class="t-cen">ลำดับ</th>
          <th class="t-cen"><?= $fildate ?></th>
          <th class="t-cen">หมายเลข ISBN</th>
          <th class="t-cen">ชื่อวารสาร</th>
          <th class="t-cen">ผู้ทำรายการ</th>
          <th class="t-cen">จำนวน(รายการ)</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sum = 0;
        foreach ($get_data as $no => $val) {
        ?>
          <tr>
            <td class="t-cen"><?= ++$no ?></td>
            <td class="t-cen"><?= month_year($val['Day'], $subreporttype) ?></td>
            <td class="t-cen"><?= GetISBNByBib_ID($val['Bib_ID']) ?></td>
            <td class="t-cen"><?= GetTitleByBib_ID($val['Bib_ID']) ?></td>
            <td class="t-cen"><?= $val['fullname'] ?></td>
            <td class="t-cen"><?= $val['summ'] ?></td>
          </tr>
        <?php
          $sum = $sum + $val['summ'];
        }
        ?>
        <tr>
          <td class="t-cen"colspan="5"><b>รวม(รายการ)</b></td>
          <td class="t-cen"><b><?= $sum ?></b></td>
        </tr>
      </tbody>
    </table>

    </body>
    <!-- <footer>
          <br/>
          <form target="_blank" action="AllReport/export/FineperUser_Export.php" method="post">
            <input type="hidden" value='<?= json_encode($get_data) ?>' name="report_data">
            <input type="hidden" value='<?= $start_date ?>' name="start_date">
            <input type="submit" value="Export PDF.">
          </form>
        </footer> -->
  <?php
} else {
  echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
} ?>
  </div>

  </html>
  <style>
    .table-report {
      background-color: black;
      color: white;
      margin: 20px;
      padding: 20px;
    }

    .t-cen {
      text-align: center;
    }

    .t-right {
      text-align: right;
    }

    .th-middle {
      vertical-align: middle;
    }
  </style>