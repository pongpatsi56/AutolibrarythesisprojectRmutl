<?php
////รายงานสถิติงานจัดทำรายการแยกตามชื่อพนักงาน//////
function month_year($date, $type)
{
  $subspace = explode(' ', $date);
  $str = convert_datethai_monthdot($subspace[0]);
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
$fildate = '';
if ($subreporttype == 'byyear') {
  $strsql = " WHERE librarian = '$mem_info' AND YEAR(Day) = " . "'$start_year'";
  $title_date = 'ปี ' . (543 + $start_year);
  $fildate = 'ปี';
} elseif ($subreporttype == 'byperiod') {
  $split = explode('-', $start_month);
  $strsql = " WHERE librarian = '$mem_info' AND MONTH(Day) = " . "'$split[1]'" . " AND YEAR(Day) = " . "'$split[0]'";
  $getsubdate = convert_datethai_monthfull($start_month . '-15');
  $subdate = explode(' ', $getsubdate);
  $title_date = $subdate[1] . ' ' . $subdate[2];
  $fildate = 'เดือน/ปี';
} else {
 $strsql = "WHERE librarian = '$mem_info' AND DATE(Day) = " . "'$start_date'";
  $title_date = convert_datethai_monthfull($start_date);
  $fildate = 'วัน/เดือน/ปี';
}
// echo '<br>' . $strsql;

/// region query data ///
$getmem_data = get_data_report("SELECT CONCAT(FName,' ',LName) AS FullName FROM librarian WHERE ID = '$mem_info'");
$get_data = get_data_report("SELECT *,substring_index((substring_index(Subfield,'#a=',-1)),'/',1) AS title FROM
(SELECT log.Day,log.Sub,databib.Subfield,log.librarian,CONCAT(librarian.FName,' ',librarian.LName) AS fullname FROM log
LEFT JOIN databib ON log.Item = databib.Bib_ID
LEFT JOIN librarian ON log.Librarian = librarian.ID
WHERE log.Sub in ('เพิ่มบรรณาณุกรมทรัพยากร','เพิ่มบทความ','แก้ไขทรัพยากร')
AND databib.Field = '245'
AND NULLIF(log.librarian,'') IS NOT NULL
UNION
SELECT log.Day,log.Sub,databib.Subfield,log.librarian,CONCAT(librarian.FName,' ',librarian.LName) AS fullname FROM log
LEFT JOIN databib_item ON log.Item = databib_item.Barcode
LEFT JOIN databib ON databib_item.Bib_ID = databib.Bib_ID
LEFT JOIN librarian ON log.Librarian = librarian.ID
WHERE log.Sub = ('เพิ่มฉบับทรัพยากร')
AND databib.Field = '245'
AND NULLIF(log.librarian,'') IS NOT NULL)AS subq1 $strsql");
/// end region ///
//echo '<h4>' . "รายงานสถิติงานจัดทำรายการแยกตามชื่อพนักงานของ " . $getmem_data[0]['FullName'] . " เมื่อ " . $title_date . '</h4>';
// echo '<pre>';
// print_r($get_data);
if ($getmem_data) {
echo '<h4>' . "รายงานสถิติงานจัดทำรายการแยกตามชื่อพนักงานของ " . $getmem_data[0]['FullName'] . " เมื่อ " . $title_date . '</h4>';
if (count($get_data)) {
?>
  <div>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="warning">
          <th class="t-cen">ลำดับ</th>
          <th class="t-cen"><?= $fildate ?></th>
          <th class="t-cen">การปฏิบัติ</th>
          <th class="t-cen">ชื่อทรัพยากร</th>
          <th class="t-cen">ผู้ทำรายการ</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sum = 0;
        foreach ($get_data as $no => $val) {
        ?>
          <tr>
            <td class="t-cen"><?= ++$no ?></td>
            <td class="t-cen"><?= month_year($val['Day'], 'bydate') ?></td>
            <td class="float-md-left"><?= $val['Sub'] ?></td>
            <td class="float-md-left"><?= $val['title'] ?></td>
            <td class="t-cen"><?= $val['fullname'] ?></td>
          </tr>
        <?php
          $sum = $sum + 1;
        }
        ?>
        <tr>
          <td class="t-cen" colspan="4">รวม(รายการ)</td>
          <td class="t-cen"><?= $sum ?></td>
        </tr>
      </tbody>
    </table>
  <?php
} else {
  echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
}
} else {
  echo ('<h4 class="text-danger">ไม่พบข้อมูลบุคลากร</h4>');
}
  ?>
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