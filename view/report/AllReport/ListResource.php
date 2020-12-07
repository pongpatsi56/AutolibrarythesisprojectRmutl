<?php
////รายงานสถิตการทำรายการทรัพยากร////
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/helper/datehelper.php';
function month_year($date, $type)
{
  $subspace = explode(' ', $date);
  $str = convert_datethai_monthdot($subspace[0]);
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
function convperc($val, $total)
{
  $per = ($val * 100) / $total;
  $str = '<b>' . $val . '</b>(' . number_format($per, 0, '.', '') . '%)';
  return $str;
}
function findmattypename($matnum)
{
  switch ($matnum) {
    case 'a':
      return 'Mixed';
      break;
    case 'b':
      return 'Article';
      break;
    case 'c':
      return 'Book';
      break;
    case 'd':
      return 'Computer File';
      break;
    case 'e':
      return 'Map';
      break;
    case 'f':
      return 'Music';
      break;
    case 'g':
      return 'Serial';
      break;
    case 'h':
      return 'Visual';
      break;
  }
};
// echo $start_date . '</br>';
// echo $start_month . '</br>';
// echo $start_year . '</br>';
$title_date = '';
$fildate = '';
if ($subreporttype == 'byyear') {
  $strsql = " ORDER BY Day";
  $title_date = ' ทั้งหมด';
  $fildate = 'ปี';
} elseif ($subreporttype == 'byperiod') {
  $strsql = " WHERE YEAR(Day) = " . "'$start_year'" . " ORDER BY Day";
  $title_date = 'เมื่อ ปี ' . (543 + $start_year);
  $fildate = 'เดือน/ปี';
} else {
  $strsql = " WHERE DATE(Day) = " . "'$start_date'" . " ORDER BY Day";
  $title_date = ' เมื่อ ' . convert_datethai_monthfull($start_date);
  $fildate = 'วัน/เดือน/ปี';
}

$get_data = get_data_report("SELECT *,substring_index((substring_index(Subfield,'#a=',-1)),'/',1) AS title FROM
(SELECT log.Day,log.Sub,databib.Subfield,CONCAT(librarian.FName,' ',librarian.LName) AS fullname FROM log
LEFT JOIN databib ON log.Item = databib.Bib_ID
LEFT JOIN librarian ON log.Librarian = librarian.ID
WHERE log.Sub in ('เพิ่มบรรณาณุกรมทรัพยากร','เพิ่มบทความ','แก้ไขทรัพยากร')
AND databib.Field = '245'
AND NULLIF(log.librarian,'') IS NOT NULL
UNION
SELECT log.Day,log.Sub,databib.Subfield,CONCAT(librarian.FName,' ',librarian.LName) AS fullname FROM log
LEFT JOIN databib_item ON log.Item = databib_item.Barcode
LEFT JOIN databib ON databib_item.Bib_ID = databib.Bib_ID
LEFT JOIN librarian ON log.Librarian = librarian.ID
WHERE log.Sub = ('เพิ่มฉบับทรัพยากร')
AND databib.Field = '245'
AND NULLIF(log.librarian,'') IS NOT NULL)AS subq1 $strsql");
  echo '<h4>' . "รายงานสถิตการทำรายการทรัพยากร " . $title_date . '</h4>';
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