<?php
//////รายงานสถิติการยืมทรัพยากรเป็นร้อยละ/////
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/helper/datehelper.php';
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
$title_type = '';
$fildate = '';
if ($subreporttype == 'byyear') {
  $strsql = " GROUP BY YEAR(Borrow)";
  $title_date = ' ทั้งหมด';
  $fildate = 'เมื่อปี';
} elseif ($subreporttype == 'byperiod') {
  $strsql = " AND YEAR(Borrow) = " . "'$start_year'" . " GROUP BY month(Borrow)";
  $title_date = 'เมื่อ ปี ' . (543 + $start_year);
  $fildate = 'เดือน/ปี';
} else {
  $strsql = " AND Borrow = " . "'$start_date'" . " GROUP BY Borrow";
  $title_date = ' เมื่อ ' . convert_datethai_monthfull($start_date);
  $fildate = 'วัน/เดือน/ปี';
}
// echo '<br>' . $strsql;

if ($subsourcetype == 'bycalendar') {
  if ($subreporttype == 'byperiod') {
    $title_type = 'ปฏิทิน';
    $title_date = 'ปี ' . (543 + $start_year);
    echo '<h4>' . "รายงานสถิติการยืมทรัพยากรเป็นร้อยละแยกตาม" . $title_type . " เมื่อ " . $title_date . '</h4>'; ?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="warning">
          <th style="vertical-align: middle;" class="t-cen">ประจำ</th>
          <?php for ($i = 1; $i <= 31; $i++) { ?>
            <th style="vertical-align: middle;" class="t-cen"><?= $i ?></th>
          <?php
          } ?>
          <th style="vertical-align: middle;" class="t-cen"><b>รวม</b></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $get_datamonth = get_data_report("SELECT DATE_FORMAT(Borrow,'%Y-%m-%d') AS Borrows, month(Borrow) AS months FROM borrowandreturn WHERE YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
        if (count($get_datamonth)) {
          foreach ($get_datamonth as $run => $data) {
            $mnth = $data['months'];
            $get_dataday = get_data_report("SELECT DAY(Borrow) AS days,count(Book) AS num FROM borrowandreturn WHERE YEAR(Borrow) = '$start_year' AND MONTH(Borrow) = '$mnth' GROUP BY Borrow");
            echo '<tr><td class="t-cen">' . month_year($data['Borrows'], 'byperiod');
            $summ = 0;
            for ($j = 1; $j <= 31; $j++) {
              if (count($get_dataday)) {
                foreach ($get_dataday as $arr => $e) {
                  if ($j == $e['days']) {
                    echo '<td class="t-cen">' . $e['num'] . '</td>';
                    $summ = $summ + $e['num'];
                    unset($get_dataday[$arr]);
                    break;
                  } else {
                    echo '<td class="t-cen">-</td>';
                    break;
                  }
                }
              } else {
                echo '<td class="t-cen">-</td>';
              }
            }
            echo '<td class="t-cen"><b>' . $summ . '</b></td>';
            echo '</tr>';
          }
        } ?>
      </tbody>
    <?php
  } elseif ($subreporttype == 'byyear') {
    $get_data = get_data_report("SELECT DAY(Borrow) AS days,count(Book) AS num FROM borrowandreturn WHERE YEAR(Borrow) = '$start_year' GROUP BY Borrow");
    $title_type = 'ปฏิทิน';
    echo '<h4>' . "รายงานสถิติการยืมทรัพยากรเป็นร้อยละแยกตาม" . $title_type . '</h4>'; ?>
      <table class="table table-bordered table-striped">
        <thead>
          <tr class="warning">
            <th style="vertical-align: middle;" class="t-cen">ประจำ</th>
            <th style="vertical-align: middle;" class="t-cen">ม.ค</th>
            <th style="vertical-align: middle;" class="t-cen">ก.พ</th>
            <th style="vertical-align: middle;" class="t-cen">มี.ค</th>
            <th style="vertical-align: middle;" class="t-cen">เม.ย</th>
            <th style="vertical-align: middle;" class="t-cen">พ.ค</th>
            <th style="vertical-align: middle;" class="t-cen">มิ.ย</th>
            <th style="vertical-align: middle;" class="t-cen">ก.ค</th>
            <th style="vertical-align: middle;" class="t-cen">ส.ค</th>
            <th style="vertical-align: middle;" class="t-cen">ก.ย</th>
            <th style="vertical-align: middle;" class="t-cen">ต.ค</th>
            <th style="vertical-align: middle;" class="t-cen">พ.ย</th>
            <th style="vertical-align: middle;" class="t-cen">ธ.ค</th>
            <th style="vertical-align: middle;" class="t-cen"><b>รวม</b>(%)</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get_datayear = get_data_report("SELECT DATE_FORMAT(Borrow,'%Y-%m-%d') AS Borrows,YEAR(Borrow) AS years FROM borrowandreturn GROUP BY YEAR(Borrow)");
          $get_sumofmonth = get_data_report("SELECT MONTH(Borrow) AS months,count(Book) AS num,(Count(Book)* 100 / (Select Count(*) From borrowandreturn)) as percent FROM borrowandreturn GROUP BY MONTH(Borrow)");
          $get_total = get_data_report("SELECT COUNT(Book) AS totals FROM borrowandreturn");
          if (count($get_datayear)) {
            $totaly = 0;
            foreach ($get_datayear as $run => $data) {
              $years = $data['years'];
              $get_dataday = get_data_report("SELECT MONTH(Borrow) AS months,count(Book) AS num FROM borrowandreturn WHERE YEAR(Borrow) = '$years' GROUP BY MONTH(Borrow)");
              echo '<tr><td class="t-cen">' . month_year($data['Borrows'], 'byall') . '</td>';
              $sumy = 0;
              for ($j = 1; $j <= 12; $j++) {
                if (count($get_dataday)) {
                  foreach ($get_dataday as $arr => $e) {
                    if ($j == $e['months']) {
                      echo '<td class="t-cen">' . $e['num'] . '</td>';
                      $sumy = $sumy + $e['num'];
                      unset($get_dataday[$arr]);
                      break;
                    } else {
                      echo '<td class="t-cen">-</td>';
                      break;
                    }
                  }
                } else {
                  echo '<td class="t-cen">-</td>';
                }
              }
              $per = ($sumy * 100) / (int) $get_total[0]['totals'];
              echo '<td class="t-cen"><b>' . $sumy . '</b>(' . number_format($per, 0, '.', '') . '%)</td>';
              echo '</tr>';
              $totaly = $totaly + $sumy;
            }
            echo '<tr><td class="t-cen"><b>รวม</b>(%)</td>';
            $temp_data = $get_sumofmonth;
            for ($j = 1; $j <= 12; $j++) {
              if (count($temp_data)) {
                foreach ($temp_data as $arr => $e) {
                  if ($j == $e['months']) {
                    echo '<td class="t-cen"><b>' . $e['num'] . '</b>(' . number_format($e['percent'], 0, '.', '') . '%)</td>';
                    unset($temp_data[$arr]);
                    break;
                  } else {
                    echo '<td class="t-cen">-</td>';
                    break;
                  }
                }
              } else {
                echo '<td class="t-cen">-</td>';
              }
            }
            echo '<td class="t-cen"><b>' . $totaly . '</b>(100%)</td></tr>';
          } ?>
        </tbody>
        <?php
      }
    } elseif ($subsourcetype == 'byddc') {
      if ($subreporttype == 'bydate') {
        $getdatadate = get_data_report("SELECT  count(*) AS sum,Borrow FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 000 AND 999 AND Borrow = '$start_date' GROUP BY Borrow");
        @$total = $getdatadate[0]['sum'];
        $ddc000 = get_data_report("SELECT  count(*) AS sum,Borrow FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 000 AND 099 AND Borrow = '$start_date' GROUP BY Borrow");
        $ddc100 = get_data_report("SELECT  count(*) AS sum,Borrow FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 100 AND 199 AND Borrow = '$start_date' GROUP BY Borrow");
        $ddc200 = get_data_report("SELECT  count(*) AS sum,Borrow FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 200 AND 299 AND Borrow = '$start_date' GROUP BY Borrow");
        $ddc300 = get_data_report("SELECT  count(*) AS sum,Borrow FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 300 AND 399 AND Borrow = '$start_date' GROUP BY Borrow");
        $ddc400 = get_data_report("SELECT  count(*) AS sum,Borrow FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 400 AND 499 AND Borrow = '$start_date' GROUP BY Borrow");
        $ddc500 = get_data_report("SELECT  count(*) AS sum,Borrow FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 500 AND 599 AND Borrow = '$start_date' GROUP BY Borrow");
        $ddc600 = get_data_report("SELECT  count(*) AS sum,Borrow FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 600 AND 699 AND Borrow = '$start_date' GROUP BY Borrow");
        $ddc700 = get_data_report("SELECT  count(*) AS sum,Borrow FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 700 AND 799 AND Borrow = '$start_date' GROUP BY Borrow");
        $ddc800 = get_data_report("SELECT  count(*) AS sum,Borrow FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 800 AND 899 AND Borrow = '$start_date' GROUP BY Borrow");
        $ddc900 = get_data_report("SELECT  count(*) AS sum,Borrow FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 900 AND 999 AND Borrow = '$start_date' GROUP BY Borrow");
        $title_type = 'หมวดหมู่หนังสือ';
        echo '<h4>' . "รายงานสถิติการยืมทรัพยากรเป็นร้อยละแยกตาม" . $title_type . $title_date . '</h4>';
        if (count($getdatadate) > 0) { ?>
          <div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr class="warning">
                  <th style="vertical-align: middle;" class="t-cen">ประจำ</th>
                  <th class="t-cen">หมวด 000</th>
                  <th class="t-cen">หมวด 100</th>
                  <th class="t-cen">หมวด 200</th>
                  <th class="t-cen">หมวด 300</th>
                  <th class="t-cen">หมวด 400</th>
                  <th class="t-cen">หมวด 500</th>
                  <th class="t-cen">หมวด 600</th>
                  <th class="t-cen">หมวด 700</th>
                  <th class="t-cen">หมวด 800</th>
                  <th class="t-cen">หมวด 900</th>
                  <th style="vertical-align: middle;" class="t-cen"><b>รวม</b></th>
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
                $sumcol8 = 0;
                $sumcol9 = 0;
                $sumcol10 = 0;
                foreach ($getdatadate as $num => $data) { ?>
                  <tr>
                    <td class="t-cen"><?= convert_datethai_monthdot($data['Borrow']) ?></td>
                    <td class="t-cen">
                      <?php if (isset($ddc000)) {
                        foreach ($ddc000 as $value) {
                          if ($data['Borrow'] == $value['Borrow']) {
                            echo $value['sum'];
                            $sumcol1 = $sumcol1 + $value['sum'];
                          }
                        }
                      } else {
                        echo '-';
                      }; ?>
                    </td>
                    <td class="t-cen">
                      <?php if (isset($ddc100)) {
                        foreach ($ddc100 as $value) {
                          if ($data['Borrow'] == $value['Borrow']) {
                            echo $value['sum'];
                            $sumcol2 = $sumcol2 + $value['sum'];
                          }
                        }
                      } else {
                        echo '-';
                      }; ?>
                    </td>
                    <td class="t-cen">
                      <?php if (isset($ddc200)) {
                        foreach ($ddc200 as $value) {
                          if ($data['Borrow'] == $value['Borrow']) {
                            echo $value['sum'];
                            $sumcol3 = $sumcol3 + $value['sum'];
                          }
                        }
                      } else {
                        echo '-';
                      }; ?>
                    </td>
                    <td class="t-cen">
                      <?php if (isset($ddc300)) {
                        foreach ($ddc300 as $value) {
                          if ($data['Borrow'] == $value['Borrow']) {
                            echo $value['sum'];
                            $sumcol4 = $sumcol4 + $value['sum'];
                          }
                        }
                      } else {
                        echo '-';
                      }; ?>
                    </td>
                    <td class="t-cen">
                      <?php if (isset($ddc400)) {
                        foreach ($ddc400 as $value) {
                          if ($data['Borrow'] == $value['Borrow']) {
                            echo $value['sum'];
                            $sumcol5 = $sumcol5 + $value['sum'];
                          }
                        }
                      } else {
                        echo '-';
                      }; ?>
                    </td>
                    <td class="t-cen">
                      <?php if (isset($ddc500)) {
                        foreach ($ddc500 as $value) {
                          if ($data['Borrow'] == $value['Borrow']) {
                            echo $value['sum'];
                            $sumcol6 = $sumcol6 + $value['sum'];
                          }
                        }
                      } else {
                        echo '-';
                      }; ?>
                    </td>
                    <td class="t-cen">
                      <?php if (isset($ddc600)) {
                        foreach ($ddc600 as $value) {
                          if ($data['Borrow'] == $value['Borrow']) {
                            echo $value['sum'];
                            $sumcol7 = $sumcol7 + $value['sum'];
                          }
                        }
                      } else {
                        echo '-';
                      }; ?>
                    </td>
                    <td class="t-cen">
                      <?php if (isset($ddc700)) {
                        foreach ($ddc700 as $value) {
                          if ($data['Borrow'] == $value['Borrow']) {
                            echo $value['sum'];
                            $sumcol8 = $sumcol8 + $value['sum'];
                          }
                        }
                      } else {
                        echo '-';
                      }; ?>
                    </td>
                    <td class="t-cen">
                      <?php if (isset($ddc800)) {
                        foreach ($ddc800 as $value) {
                          if ($data['Borrow'] == $value['Borrow']) {
                            echo $value['sum'];
                            $sumcol9 = $sumcol9 + $value['sum'];
                          }
                        }
                      } else {
                        echo '-';
                      }; ?>
                    </td>
                    <td class="t-cen">
                      <?php if (isset($ddc900)) {
                        foreach ($ddc900 as $value) {
                          if ($data['Borrow'] == $value['Borrow']) {
                            echo $value['sum'];
                            $sumcol10 = $sumcol10 + $value['sum'];
                          }
                        }
                      } else {
                        echo '-';
                      }; ?>
                    </td>
                    <td class="t-cen"><b><?= $data['sum'] ?></b></td>
                  </tr>
                <?php
                } ?>
                <tr>
                  <td class="t-cen">รวม(%)</td>
                  <td class="t-cen"><?= ($sumcol1 != 0 ? convperc($sumcol1, $total) : '-') ?></td>
                  <td class="t-cen"><?= ($sumcol2 != 0 ? convperc($sumcol2, $total) : '-') ?></td>
                  <td class="t-cen"><?= ($sumcol3 != 0 ? convperc($sumcol3, $total) : '-') ?></td>
                  <td class="t-cen"><?= ($sumcol4 != 0 ? convperc($sumcol4, $total) : '-') ?></td>
                  <td class="t-cen"><?= ($sumcol5 != 0 ? convperc($sumcol5, $total) : '-') ?></td>
                  <td class="t-cen"><?= ($sumcol6 != 0 ? convperc($sumcol6, $total) : '-') ?></td>
                  <td class="t-cen"><?= ($sumcol7 != 0 ? convperc($sumcol7, $total) : '-') ?></td>
                  <td class="t-cen"><?= ($sumcol8 != 0 ? convperc($sumcol8, $total) : '-') ?></td>
                  <td class="t-cen"><?= ($sumcol9 != 0 ? convperc($sumcol9, $total) : '-') ?></td>
                  <td class="t-cen"><?= ($sumcol10 != 0 ? convperc($sumcol10, $total) : '-') ?></td>
                  <td class="t-cen"><b><?= ($sumtotal = $sumcol1 + $sumcol2 + $sumcol3 + $sumcol4 + $sumcol5 + $sumcol6 + $sumcol7 + $sumcol8 + $sumcol9 + $sumcol10) . '</b>(' . ($sumtotal * 100) / $total . '%)' ?></td>
                </tr>
              </tbody>
            </table>
            </body>
          <?php
        } else {
          echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
        }
      } elseif ($subreporttype == 'byperiod') {
        $gettotal = get_data_report("SELECT  count(*) AS sum FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 000 AND 999 AND YEAR(Borrow) = '$start_year'");
        @$total = $gettotal[0]['sum'];
        $getdatamonth = get_data_report("SELECT  count(*) AS sum,MONTH(Borrow) AS months,Borrow FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 000 AND 999 AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
        $ddc000 = get_data_report("SELECT  count(*) AS sum,MONTH(Borrow) AS months FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 000 AND 099 AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
        $ddc100 = get_data_report("SELECT  count(*) AS sum,MONTH(Borrow) AS months FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 100 AND 199 AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
        $ddc200 = get_data_report("SELECT  count(*) AS sum,MONTH(Borrow) AS months FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 200 AND 299 AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
        $ddc300 = get_data_report("SELECT  count(*) AS sum,MONTH(Borrow) AS months FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 300 AND 399 AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
        $ddc400 = get_data_report("SELECT  count(*) AS sum,MONTH(Borrow) AS months FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 400 AND 499 AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
        $ddc500 = get_data_report("SELECT  count(*) AS sum,MONTH(Borrow) AS months FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 500 AND 599 AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
        $ddc600 = get_data_report("SELECT  count(*) AS sum,MONTH(Borrow) AS months FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 600 AND 699 AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
        $ddc700 = get_data_report("SELECT  count(*) AS sum,MONTH(Borrow) AS months FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 700 AND 799 AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
        $ddc800 = get_data_report("SELECT  count(*) AS sum,MONTH(Borrow) AS months FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 800 AND 899 AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
        $ddc900 = get_data_report("SELECT  count(*) AS sum,MONTH(Borrow) AS months FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 900 AND 999 AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
        $title_type = 'หมวดหมู่หนังสือ';
        echo '<h4>' . "รายงานสถิติการยืมทรัพยากรเป็นร้อยละแยกตาม" . $title_type . $title_date . '</h4>';
        if (count($getdatamonth) > 0) { ?>
            <div>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr class="warning">
                    <th style="vertical-align: middle;" class="t-cen">ประจำ</th>
                    <th class="t-cen">หมวด 000</th>
                    <th class="t-cen">หมวด 100</th>
                    <th class="t-cen">หมวด 200</th>
                    <th class="t-cen">หมวด 300</th>
                    <th class="t-cen">หมวด 400</th>
                    <th class="t-cen">หมวด 500</th>
                    <th class="t-cen">หมวด 600</th>
                    <th class="t-cen">หมวด 700</th>
                    <th class="t-cen">หมวด 800</th>
                    <th class="t-cen">หมวด 900</th>
                    <th style="vertical-align: middle;" class="t-cen"><b>รวม</b>(%)</th>
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
                  $sumcol8 = 0;
                  $sumcol9 = 0;
                  $sumcol10 = 0;
                  foreach ($getdatamonth as $num => $data) { ?>
                    <tr>
                      <td class="t-cen"><?= month_year($data['Borrow'], 'byperiod') ?></td>
                      <td class="t-cen">
                        <?php if (isset($ddc000)) {
                          foreach ($ddc000 as $value) {
                            if ($data['months'] == $value['months']) {
                              echo $value['sum'];
                              $sumcol1 = $sumcol1 + $value['sum'];
                            }
                          }
                        } else {
                          echo '-';
                        }; ?>
                      </td>
                      <td class="t-cen">
                        <?php if (isset($ddc100)) {
                          foreach ($ddc100 as $value) {
                            if ($data['months'] == $value['months']) {
                              echo $value['sum'];
                              $sumcol2 = $sumcol2 + $value['sum'];
                            }
                          }
                        } else {
                          echo '-';
                        }; ?>
                      </td>
                      <td class="t-cen">
                        <?php if (isset($ddc200)) {
                          foreach ($ddc200 as $value) {
                            if ($data['months'] == $value['months']) {
                              echo $value['sum'];
                              $sumcol3 = $sumcol3 + $value['sum'];
                            }
                          }
                        } else {
                          echo '-';
                        }; ?>
                      </td>
                      <td class="t-cen">
                        <?php if (isset($ddc300)) {
                          foreach ($ddc300 as $value) {
                            if ($data['months'] == $value['months']) {
                              echo $value['sum'];
                              $sumcol4 = $sumcol4 + $value['sum'];
                            }
                          }
                        } else {
                          echo '-';
                        }; ?>
                      </td>
                      <td class="t-cen">
                        <?php if (isset($ddc400)) {
                          foreach ($ddc400 as $value) {
                            if ($data['months'] == $value['months']) {
                              echo $value['sum'];
                              $sumcol5 = $sumcol5 + $value['sum'];
                            }
                          }
                        } else {
                          echo '-';
                        }; ?>
                      </td>
                      <td class="t-cen">
                        <?php if (isset($ddc500)) {
                          foreach ($ddc500 as $value) {
                            if ($data['months'] == $value['months']) {
                              echo $value['sum'];
                              $sumcol6 = $sumcol6 + $value['sum'];
                            }
                          }
                        } else {
                          echo '-';
                        }; ?>
                      </td>
                      <td class="t-cen">
                        <?php if (isset($ddc600)) {
                          foreach ($ddc600 as $value) {
                            if ($data['months'] == $value['months']) {
                              echo $value['sum'];
                              $sumcol7 = $sumcol7 + $value['sum'];
                            }
                          }
                        } else {
                          echo '-';
                        }; ?>
                      </td>
                      <td class="t-cen">
                        <?php if (isset($ddc700)) {
                          foreach ($ddc700 as $value) {
                            if ($data['months'] == $value['months']) {
                              echo $value['sum'];
                              $sumcol8 = $sumcol8 + $value['sum'];
                            }
                          }
                        } else {
                          echo '-';
                        }; ?>
                      </td>
                      <td class="t-cen">
                        <?php if (isset($ddc800)) {
                          foreach ($ddc800 as $value) {
                            if ($data['months'] == $value['months']) {
                              echo $value['sum'];
                              $sumcol9 = $sumcol9 + $value['sum'];
                            }
                          }
                        } else {
                          echo '-';
                        }; ?>
                      </td>
                      <td class="t-cen">
                        <?php if (isset($ddc900)) {
                          foreach ($ddc900 as $value) {
                            if ($data['months'] == $value['months']) {
                              echo $value['sum'];
                              $sumcol10 = $sumcol10 + $value['sum'];
                            }
                          }
                        } else {
                          echo '-';
                        }; ?>
                      </td>
                      <td class="t-cen"><?= convperc((int) $data['sum'], $total) ?></td>
                    </tr>
                  <?php
                  } ?>
                  <tr>
                    <td class="t-cen"><b>รวม</b>(%)</td>
                    <td class="t-cen"><?= ($sumcol1 != 0 ? convperc($sumcol1, $total) : '-') ?></td>
                    <td class="t-cen"><?= ($sumcol2 != 0 ? convperc($sumcol2, $total) : '-') ?></td>
                    <td class="t-cen"><?= ($sumcol3 != 0 ? convperc($sumcol3, $total) : '-') ?></td>
                    <td class="t-cen"><?= ($sumcol4 != 0 ? convperc($sumcol4, $total) : '-') ?></td>
                    <td class="t-cen"><?= ($sumcol5 != 0 ? convperc($sumcol5, $total) : '-') ?></td>
                    <td class="t-cen"><?= ($sumcol6 != 0 ? convperc($sumcol6, $total) : '-') ?></td>
                    <td class="t-cen"><?= ($sumcol7 != 0 ? convperc($sumcol7, $total) : '-') ?></td>
                    <td class="t-cen"><?= ($sumcol8 != 0 ? convperc($sumcol8, $total) : '-') ?></td>
                    <td class="t-cen"><?= ($sumcol9 != 0 ? convperc($sumcol9, $total) : '-') ?></td>
                    <td class="t-cen"><?= ($sumcol10 != 0 ? convperc($sumcol10, $total) : '-') ?></td>
                    <td class="t-cen"><b><?= ($sumtotal = $sumcol1 + $sumcol2 + $sumcol3 + $sumcol4 + $sumcol5 + $sumcol6 + $sumcol7 + $sumcol8 + $sumcol9 + $sumcol10) . '</b>(' . ($sumtotal * 100) / $total . '%)' ?></td>
                  </tr>
                </tbody>
              </table>
              </body>
            <?php
          } else {
            echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
          }
        } elseif ($subreporttype == 'byyear') {
          $gettotal = get_data_report("SELECT  count(*) AS sum FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 000 AND 999");
          @$total = $gettotal[0]['sum'];
          $getdatayear = get_data_report("SELECT  count(*) AS sum,YEAR(Borrow) AS years FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 000 AND 999 GROUP BY YEAR(Borrow)");
          $ddc000 = get_data_report("SELECT  count(*) AS sum,YEAR(Borrow) AS years FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 000 AND 099 GROUP BY YEAR(Borrow)");
          $ddc100 = get_data_report("SELECT  count(*) AS sum,YEAR(Borrow) AS years FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 100 AND 199 GROUP BY YEAR(Borrow)");
          $ddc200 = get_data_report("SELECT  count(*) AS sum,YEAR(Borrow) AS years FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 200 AND 299 GROUP BY YEAR(Borrow)");
          $ddc300 = get_data_report("SELECT  count(*) AS sum,YEAR(Borrow) AS years FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 300 AND 399 GROUP BY YEAR(Borrow)");
          $ddc400 = get_data_report("SELECT  count(*) AS sum,YEAR(Borrow) AS years FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 400 AND 499 GROUP BY YEAR(Borrow)");
          $ddc500 = get_data_report("SELECT  count(*) AS sum,YEAR(Borrow) AS years FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 500 AND 599 GROUP BY YEAR(Borrow)");
          $ddc600 = get_data_report("SELECT  count(*) AS sum,YEAR(Borrow) AS years FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 600 AND 699 GROUP BY YEAR(Borrow)");
          $ddc700 = get_data_report("SELECT  count(*) AS sum,YEAR(Borrow) AS years FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 700 AND 799 GROUP BY YEAR(Borrow)");
          $ddc800 = get_data_report("SELECT  count(*) AS sum,YEAR(Borrow) AS years FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 800 AND 899 GROUP BY YEAR(Borrow)");
          $ddc900 = get_data_report("SELECT  count(*) AS sum,YEAR(Borrow) AS years FROM (SELECT br.Borrow,SUBSTRING(db.Subfield, 4, 3) AS ddc FROM borrowandreturn br LEFT JOIN databib db ON br.Book = db.Barcode WHERE db.Field = '082' )AS sub1 WHERE sub1.ddc BETWEEN 900 AND 999 GROUP BY YEAR(Borrow)");
          $title_type = 'หมวดหมู่หนังสือ';
          echo '<h4>' . "รายงานสถิติการยืมทรัพยากรเป็นร้อยละแยกตาม" . $title_type . $title_date . '</h4>';
          if (count($getdatayear) > 0) { ?>
              <div>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr class="warning">
                      <th style="vertical-align: middle;" class="t-cen">ประจำ</th>
                      <th class="t-cen">หมวด 000</th>
                      <th class="t-cen">หมวด 100</th>
                      <th class="t-cen">หมวด 200</th>
                      <th class="t-cen">หมวด 300</th>
                      <th class="t-cen">หมวด 400</th>
                      <th class="t-cen">หมวด 500</th>
                      <th class="t-cen">หมวด 600</th>
                      <th class="t-cen">หมวด 700</th>
                      <th class="t-cen">หมวด 800</th>
                      <th class="t-cen">หมวด 900</th>
                      <th style="vertical-align: middle;" class="t-cen"><b>รวม</b>(%)</th>
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
                    $sumcol8 = 0;
                    $sumcol9 = 0;
                    $sumcol10 = 0;
                    foreach ($getdatayear as $num => $data) { ?>
                      <tr>
                        <td class="t-cen"><?= (int) $data['years'] + 543 ?></td>
                        <td class="t-cen">
                          <?php if (isset($ddc000)) {
                            foreach ($ddc000 as $value) {
                              if ($data['years'] == $value['years']) {
                                echo $value['sum'];
                                $sumcol1 = $sumcol1 + $value['sum'];
                              }
                            }
                          } else {
                            echo '-';
                          }; ?>
                        </td>
                        <td class="t-cen">
                          <?php if (isset($ddc100)) {
                            foreach ($ddc100 as $value) {
                              if ($data['years'] == $value['years']) {
                                echo $value['sum'];
                                $sumcol2 = $sumcol2 + $value['sum'];
                              }
                            }
                          } else {
                            echo '-';
                          }; ?>
                        </td>
                        <td class="t-cen">
                          <?php if (isset($ddc200)) {
                            foreach ($ddc200 as $value) {
                              if ($data['years'] == $value['years']) {
                                echo $value['sum'];
                                $sumcol3 = $sumcol3 + $value['sum'];
                              }
                            }
                          } else {
                            echo '-';
                          }; ?>
                        </td>
                        <td class="t-cen">
                          <?php if (isset($ddc300)) {
                            foreach ($ddc300 as $value) {
                              if ($data['years'] == $value['years']) {
                                echo $value['sum'];
                                $sumcol4 = $sumcol4 + $value['sum'];
                              }
                            }
                          } else {
                            echo '-';
                          }; ?>
                        </td>
                        <td class="t-cen">
                          <?php if (isset($ddc400)) {
                            foreach ($ddc400 as $value) {
                              if ($data['years'] == $value['years']) {
                                echo $value['sum'];
                                $sumcol5 = $sumcol5 + $value['sum'];
                              }
                            }
                          } else {
                            echo '-';
                          }; ?>
                        </td>
                        <td class="t-cen">
                          <?php if (isset($ddc500)) {
                            foreach ($ddc500 as $value) {
                              if ($data['years'] == $value['years']) {
                                echo $value['sum'];
                                $sumcol6 = $sumcol6 + $value['sum'];
                              }
                            }
                          } else {
                            echo '-';
                          }; ?>
                        </td>
                        <td class="t-cen">
                          <?php if (isset($ddc600)) {
                            foreach ($ddc600 as $value) {
                              if ($data['years'] == $value['years']) {
                                echo $value['sum'];
                                $sumcol7 = $sumcol7 + $value['sum'];
                              }
                            }
                          } else {
                            echo '-';
                          }; ?>
                        </td>
                        <td class="t-cen">
                          <?php if (isset($ddc700)) {
                            foreach ($ddc700 as $value) {
                              if ($data['years'] == $value['years']) {
                                echo $value['sum'];
                                $sumcol8 = $sumcol8 + $value['sum'];
                              }
                            }
                          } else {
                            echo '-';
                          }; ?>
                        </td>
                        <td class="t-cen">
                          <?php if (isset($ddc800)) {
                            foreach ($ddc800 as $value) {
                              if ($data['years'] == $value['years']) {
                                echo $value['sum'];
                                $sumcol9 = $sumcol9 + $value['sum'];
                              }
                            }
                          } else {
                            echo '-';
                          }; ?>
                        </td>
                        <td class="t-cen">
                          <?php if (isset($ddc900)) {
                            foreach ($ddc900 as $value) {
                              if ($data['years'] == $value['years']) {
                                echo $value['sum'];
                                $sumcol10 = $sumcol10 + $value['sum'];
                              }
                            }
                          } else {
                            echo '-';
                          }; ?>
                        </td>
                        <td class="t-cen"><?= convperc((int) $data['sum'], $total) ?></td>
                      </tr>
                    <?php
                    } ?>
                    <tr>
                      <td class="t-cen"><b>รวม</b>(%)</td>
                      <td class="t-cen"><?= ($sumcol1 != 0 ? convperc($sumcol1, $total) : '-') ?></td>
                      <td class="t-cen"><?= ($sumcol2 != 0 ? convperc($sumcol2, $total) : '-') ?></td>
                      <td class="t-cen"><?= ($sumcol3 != 0 ? convperc($sumcol3, $total) : '-') ?></td>
                      <td class="t-cen"><?= ($sumcol4 != 0 ? convperc($sumcol4, $total) : '-') ?></td>
                      <td class="t-cen"><?= ($sumcol5 != 0 ? convperc($sumcol5, $total) : '-') ?></td>
                      <td class="t-cen"><?= ($sumcol6 != 0 ? convperc($sumcol6, $total) : '-') ?></td>
                      <td class="t-cen"><?= ($sumcol7 != 0 ? convperc($sumcol7, $total) : '-') ?></td>
                      <td class="t-cen"><?= ($sumcol8 != 0 ? convperc($sumcol8, $total) : '-') ?></td>
                      <td class="t-cen"><?= ($sumcol9 != 0 ? convperc($sumcol9, $total) : '-') ?></td>
                      <td class="t-cen"><?= ($sumcol10 != 0 ? convperc($sumcol10, $total) : '-') ?></td>
                      <td class="t-cen"><b><?= ($totalsum = $sumcol1 + $sumcol2 + $sumcol3 + $sumcol4 + $sumcol5 + $sumcol6 + $sumcol7 + $sumcol8 + $sumcol9 + $sumcol10) . '</b>(' . ($totalsum * 100) / $total . '%)' ?></td>
                    </tr>
                  </tbody>
                </table>
                </body>
              <?php
            } else {
              echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
            }
          }
        } elseif ($subsourcetype == 'bysourcetype') {
          if ($subreporttype == 'bydate') {
            $getdatadate = get_data_report("SELECT  count(*) AS sum,Borrow FROM (SELECT br.Borrow FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964')AS sub1 WHERE Borrow = '$start_date' GROUP BY Borrow");
            $total = isset($getdatadate[0]['sum']) ? $getdatadate[0]['sum'] : 0;
            $get_mt1 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'a' AND Borrow = '$start_date' GROUP BY Borrow");
            $get_mt2 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'b' AND Borrow = '$start_date' GROUP BY Borrow");
            $get_mt3 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'c' AND Borrow = '$start_date' GROUP BY Borrow");
            $get_mt4 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'd' AND Borrow = '$start_date' GROUP BY Borrow");
            $get_mt5 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'e' AND Borrow = '$start_date' GROUP BY Borrow");
            $get_mt6 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'f' AND Borrow = '$start_date' GROUP BY Borrow");
            $get_mt7 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'g' AND Borrow = '$start_date' GROUP BY Borrow");
            $get_mt8 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'h' AND Borrow = '$start_date' GROUP BY Borrow");
            $title_type = 'ประเภทวัสดุ';
            echo '<h4>' . "รายงานสถิติการยืมทรัพยากรเป็นร้อยละแยกตาม" . $title_type . $title_date . '</h4>';
            $titlegraph = "รายงานสถิติการยืมทรัพยากรเป็นร้อยละแยกตาม" . $title_type . $title_date;
            $piedata = get_data_report("SELECT  count(*) AS SUMM,Borrow,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964')AS sub1 WHERE Borrow = '$start_date' GROUP BY mattype");
            $datapie = [];
            foreach ($piedata as $value) {
              $namemattype = findmattypename($value['mattype']);
              array_push($datapie, array("label" => $namemattype, "y" => $value['SUMM']));
            }
            if (count($getdatadate) > 0) {
              ?>
                <div>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr class="warning">
                        <th style="vertical-align: middle;" class="t-cen" rowspan="2">วัน/เดือน/ปี</th>
                        <th class="t-cen" colspan="8">ประเภท</th>
                        <th style="vertical-align: middle;" class="t-cen" rowspan="2">รวม</th>
                      </tr>
                      <tr class="warning">
                      <?php $headtype = get_data_report("SELECT Name_Eng FROM subfield WHERE FIELD = '964' ORDER BY Code");
                        foreach ($headtype as $value) {
                          echo "<th class='t-cen'>" . $value['Name_Eng'] . "</th>";
                        } ?>
                        <!--<th class="t-cen">Mixed</th>-->
                        <!--<th class="t-cen">Article</th>-->
                        <!--<th class="t-cen">Book</th>-->
                        <!--<th class="t-cen">Computer File</th>-->
                        <!--<th class="t-cen">Map</th>-->
                        <!--<th class="t-cen">Music</th>-->
                        <!--<th class="t-cen">Serial</th>-->
                        <!--<th class="t-cen">Visual</th>-->
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
                      $sumcol8 = 0;
                      foreach ($getdatadate as $num => $data) { ?>
                        <tr>
                          <td class="t-cen"><?= convert_datethai_monthdot($data['Borrow']) ?></td>
                          <td class="t-cen">
                            <?php if (count($get_mt1)) {
                              foreach ($get_mt1 as $value) {
                                if ($data['Borrow'] == $value['Borrow']) {
                                  echo $value['sum'];
                                  $sumcol1 = $sumcol1 + $value['sum'];
                                }
                              }
                            } else {
                              echo '-';
                            }; ?>
                          </td>
                          <td class="t-cen">
                            <?php if (count($get_mt2)) {
                              foreach ($get_mt2 as $value) {
                                if ($data['Borrow'] == $value['Borrow']) {
                                  echo $value['sum'];
                                  $sumcol2 = $sumcol2 + $value['sum'];
                                }
                              }
                            } else {
                              echo '-';
                            }; ?>
                          </td>
                          <td class="t-cen">
                            <?php if (count($get_mt3)) {
                              foreach ($get_mt3 as $value) {
                                if ($data['Borrow'] == $value['Borrow']) {
                                  echo $value['sum'];
                                  $sumcol3 = $sumcol3 + $value['sum'];
                                }
                              }
                            } else {
                              echo '-';
                            }; ?>
                          </td>
                          <td class="t-cen">
                            <?php if (count($get_mt4)) {
                              foreach ($get_mt4 as $value) {
                                if ($data['Borrow'] == $value['Borrow']) {
                                  echo $value['sum'];
                                  $sumcol4 = $sumcol4 + $value['sum'];
                                }
                              }
                            } else {
                              echo '-';
                            }; ?>
                          </td>
                          <td class="t-cen">
                            <?php if (count($get_mt5)) {
                              foreach ($get_mt5 as $value) {
                                if ($data['Borrow'] == $value['Borrow']) {
                                  echo $value['sum'];
                                  $sumcol5 = $sumcol5 + $value['sum'];
                                }
                              }
                            } else {
                              echo '-';
                            }; ?>
                          </td>
                          <td class="t-cen">
                            <?php if (count($get_mt6)) {
                              foreach ($get_mt6 as $value) {
                                if ($data['Borrow'] == $value['Borrow']) {
                                  echo $value['sum'];
                                  $sumcol6 = $sumcol6 + $value['sum'];
                                }
                              }
                            } else {
                              echo '-';
                            }; ?>
                          </td>
                          <td class="t-cen">
                            <?php if (count($get_mt7)) {
                              foreach ($get_mt7 as $value) {
                                if ($data['Borrow'] == $value['Borrow']) {
                                  echo $value['sum'];
                                  $sumcol7 = $sumcol7 + $value['sum'];
                                }
                              }
                            } else {
                              echo '-';
                            }; ?>
                          </td>
                          <td class="t-cen">
                            <?php if (count($get_mt8)) {
                              foreach ($get_mt8 as $value) {
                                if ($data['Borrow'] == $value['Borrow']) {
                                  echo $value['sum'];
                                  $sumcol8 = $sumcol8 + $value['sum'];
                                }
                              }
                            } else {
                              echo '-';
                            }; ?>
                          </td>
                          <td class="t-cen"><?= convperc((int) $data['sum'], $total) ?></td>
                        </tr>
                      <?php
                      } ?>
                      <tr>
                        <td class="t-cen">รวม(%)</td>
                        <td class="t-cen"><?= ($sumcol1 != 0 ? convperc($sumcol1, $total) : '-') ?></td>
                        <td class="t-cen"><?= ($sumcol2 != 0 ? convperc($sumcol2, $total) : '-') ?></td>
                        <td class="t-cen"><?= ($sumcol3 != 0 ? convperc($sumcol3, $total) : '-') ?></td>
                        <td class="t-cen"><?= ($sumcol4 != 0 ? convperc($sumcol4, $total) : '-') ?></td>
                        <td class="t-cen"><?= ($sumcol5 != 0 ? convperc($sumcol5, $total) : '-') ?></td>
                        <td class="t-cen"><?= ($sumcol6 != 0 ? convperc($sumcol6, $total) : '-') ?></td>
                        <td class="t-cen"><?= ($sumcol7 != 0 ? convperc($sumcol7, $total) : '-') ?></td>
                        <td class="t-cen"><?= ($sumcol8 != 0 ? convperc($sumcol8, $total) : '-') ?></td>
                        <td class="t-cen"><?= ($sumtotal = $sumcol1 + $sumcol2 + $sumcol3 + $sumcol4 + $sumcol5 + $sumcol6 + $sumcol7 + $sumcol8) . '(' . ($sumtotal * 100) / $total . '%)' ?></td>
                      </tr>
                    </tbody>
                  </table>
                  </body>
                  <input type="button" value="แสดงกราฟ" onclick="showpie()">
                <?php
              } else {
                echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
              }
            } elseif ($subreporttype == 'byperiod') {
              $gettotal = get_data_report("SELECT  count(*) AS sum FROM (SELECT br.Borrow FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964')AS sub1 WHERE YEAR(Borrow) = '$start_year'");
              $total = isset($gettotal[0]['sum']) ? $gettotal[0]['sum'] : 0;
              $getdatamonth = get_data_report("SELECT count(*) AS sum,MONTH(Borrow) AS months,Borrow FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964')AS sub1 WHERE YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
              $get_mt1 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'a' AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
              $get_mt2 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'b' AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
              $get_mt3 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'c' AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
              $get_mt4 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'd' AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
              $get_mt5 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'e' AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
              $get_mt6 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'f' AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
              $get_mt7 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'g' AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
              $get_mt8 = get_data_report("SELECT  count(*) AS sum,Borrow,MONTH(Borrow) AS months,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'h' AND YEAR(Borrow) = '$start_year' GROUP BY month(Borrow)");
              $title_type = 'ประเภทวัสดุ';
              echo '<h4>' . "รายงานสถิติการยืมทรัพยากรเป็นร้อยละแยกตาม" . $title_type . $title_date . '</h4>';
              $titlegraph = "รายงานสถิติการยืมทรัพยากรเป็นร้อยละแยกตาม" . $title_type . $title_date;
              $piedata = get_data_report("SELECT count(Book) AS SUMM, substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br
              LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode
              WHERE db.Field = '964' AND YEAR(Borrow) = '$start_year' GROUP BY mattype");
              $datapie = [];
              foreach ($piedata as $value) {
                $namemattype = findmattypename($value['mattype']);
                array_push($datapie, array("label" => $namemattype, "y" => $value['SUMM']));
              }
              if (count($getdatamonth) > 0) {
                ?>
                  <div>
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr class="warning">
                          <th style="vertical-align: middle;" class="t-cen" rowspan="2">เดือน/ปี</th>
                          <th class="t-cen" colspan="8">ประเภท</th>
                          <th style="vertical-align: middle;" class="t-cen" rowspan="2">รวม</th>
                        </tr>
                        <tr class="warning">
                        <?php $headtype = get_data_report("SELECT Name_Eng FROM subfield WHERE FIELD = '964' ORDER BY Code");
                        foreach ($headtype as $value) {
                          echo "<th class='t-cen'>" . $value['Name_Eng'] . "</th>";
                        } ?>
                          <!--<th class="t-cen">Mixed</th>-->
                          <!--<th class="t-cen">Article</th>-->
                          <!--<th class="t-cen">Book</th>-->
                          <!--<th class="t-cen">Computer File</th>-->
                          <!--<th class="t-cen">Map</th>-->
                          <!--<th class="t-cen">Music</th>-->
                          <!--<th class="t-cen">Serial</th>-->
                          <!--<th class="t-cen">Visual</th>-->
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
                        $sumcol8 = 0;
                        foreach ($getdatamonth as $num => $data) { ?>
                          <tr>
                            <td class="t-cen"><?= month_year($data['Borrow'], 'byperiod') ?></td>
                            <td class="t-cen">
                              <?php if (count($get_mt1)) {
                                foreach ($get_mt1 as $value) {
                                  if ($data['months'] == $value['months']) {
                                    echo $value['sum'];
                                    $sumcol1 = $sumcol1 + $value['sum'];
                                  }
                                }
                              } else {
                                echo '-';
                              }; ?>
                            </td>
                            <td class="t-cen">
                              <?php if (count($get_mt2)) {
                                foreach ($get_mt2 as $value) {
                                  if ($data['months'] == $value['months']) {
                                    echo $value['sum'];
                                    $sumcol2 = $sumcol2 + $value['sum'];
                                  }
                                }
                              } else {
                                echo '-';
                              }; ?>
                            </td>
                            <td class="t-cen">
                              <?php if (count($get_mt3)) {
                                foreach ($get_mt3 as $value) {
                                  if ($data['months'] == $value['months']) {
                                    echo $value['sum'];
                                    $sumcol3 = $sumcol3 + $value['sum'];
                                  }
                                }
                              } else {
                                echo '-';
                              }; ?>
                            </td>
                            <td class="t-cen">
                              <?php if (count($get_mt4)) {
                                foreach ($get_mt4 as $value) {
                                  if ($data['months'] == $value['months']) {
                                    echo $value['sum'];
                                    $sumcol4 = $sumcol4 + $value['sum'];
                                  }
                                }
                              } else {
                                echo '-';
                              }; ?>
                            </td>
                            <td class="t-cen">
                              <?php if (count($get_mt5)) {
                                foreach ($get_mt5 as $value) {
                                  if ($data['months'] == $value['months']) {
                                    echo $value['sum'];
                                    $sumcol5 = $sumcol5 + $value['sum'];
                                  }
                                }
                              } else {
                                echo '-';
                              }; ?>
                            </td>
                            <td class="t-cen">
                              <?php if (count($get_mt6)) {
                                foreach ($get_mt6 as $value) {
                                  if ($data['months'] == $value['months']) {
                                    echo $value['sum'];
                                    $sumcol6 = $sumcol6 + $value['sum'];
                                  }
                                }
                              } else {
                                echo '-';
                              }; ?>
                            </td>
                            <td class="t-cen">
                              <?php if (count($get_mt7)) {
                                foreach ($get_mt7 as $value) {
                                  if ($data['months'] == $value['months']) {
                                    echo $value['sum'];
                                    $sumcol7 = $sumcol7 + $value['sum'];
                                  }
                                }
                              } else {
                                echo '-';
                              }; ?>
                            </td>
                            <td class="t-cen">
                              <?php if (count($get_mt8)) {
                                foreach ($get_mt8 as $value) {
                                  if ($data['months'] == $value['months']) {
                                    echo $value['sum'];
                                    $sumcol8 = $sumcol8 + $value['sum'];
                                  }
                                }
                              } else {
                                echo '-';
                              }; ?>
                            </td>
                            <td class="t-cen"><?= convperc((int) $data['sum'], $total) ?></td>
                          </tr>
                        <?php
                        } ?>
                        <tr>
                          <td class="t-cen">รวม(%)</td>
                          <td class="t-cen"><?= ($sumcol1 != 0 ? convperc($sumcol1, $total) : '-') ?></td>
                          <td class="t-cen"><?= ($sumcol2 != 0 ? convperc($sumcol2, $total) : '-') ?></td>
                          <td class="t-cen"><?= ($sumcol3 != 0 ? convperc($sumcol3, $total) : '-') ?></td>
                          <td class="t-cen"><?= ($sumcol4 != 0 ? convperc($sumcol4, $total) : '-') ?></td>
                          <td class="t-cen"><?= ($sumcol5 != 0 ? convperc($sumcol5, $total) : '-') ?></td>
                          <td class="t-cen"><?= ($sumcol6 != 0 ? convperc($sumcol6, $total) : '-') ?></td>
                          <td class="t-cen"><?= ($sumcol7 != 0 ? convperc($sumcol7, $total) : '-') ?></td>
                          <td class="t-cen"><?= ($sumcol8 != 0 ? convperc($sumcol8, $total) : '-') ?></td>
                          <td class="t-cen"><?= ($sumtotal = $sumcol1 + $sumcol2 + $sumcol3 + $sumcol4 + $sumcol5 + $sumcol6 + $sumcol7 + $sumcol8) . '(' . ($sumtotal * 100) / $total . '%)' ?></td>
                        </tr>
                      </tbody>
                    </table>

                    </body>
                    <input type="button" value="แสดงกราฟ" onclick="showpie()">
                  <?php
                } else {
                  echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
                }
              } elseif ($subreporttype == 'byyear') {
                $gettotal = get_data_report("SELECT  count(*) AS sum FROM (SELECT br.Borrow FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964')AS sub1");
                $total = isset($gettotal[0]['sum']) ? $gettotal[0]['sum'] : 0;
                $getdatayear = get_data_report("SELECT count(*) AS sum,YEAR(Borrow) AS years,Borrow FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964')AS sub1 GROUP BY YEAR(Borrow)");
                $get_mt1 = get_data_report("SELECT  count(*) AS sum,Borrow,YEAR(Borrow) AS years,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'a' GROUP BY YEAR(Borrow)");
                $get_mt2 = get_data_report("SELECT  count(*) AS sum,Borrow,YEAR(Borrow) AS years,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'b' GROUP BY YEAR(Borrow)");
                $get_mt3 = get_data_report("SELECT  count(*) AS sum,Borrow,YEAR(Borrow) AS years,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'c' GROUP BY YEAR(Borrow)");
                $get_mt4 = get_data_report("SELECT  count(*) AS sum,Borrow,YEAR(Borrow) AS years,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'd' GROUP BY YEAR(Borrow)");
                $get_mt5 = get_data_report("SELECT  count(*) AS sum,Borrow,YEAR(Borrow) AS years,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'e' GROUP BY YEAR(Borrow)");
                $get_mt6 = get_data_report("SELECT  count(*) AS sum,Borrow,YEAR(Borrow) AS years,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'f' GROUP BY YEAR(Borrow)");
                $get_mt7 = get_data_report("SELECT  count(*) AS sum,Borrow,YEAR(Borrow) AS years,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'g' GROUP BY YEAR(Borrow)");
                $get_mt8 = get_data_report("SELECT  count(*) AS sum,Borrow,YEAR(Borrow) AS years,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964' )AS sub1 WHERE mattype = 'h' GROUP BY YEAR(Borrow)");
                $title_type = 'ประเภทวัสดุ';
                echo '<h4>' . "รายงานสถิติการยืมทรัพยากรเป็นร้อยละแยกตาม" . $title_type . $title_date . '</h4>';
                $titlegraph = "รายงานสถิติการยืมทรัพยากรเป็นร้อยละแยกตาม" . $title_type . $title_date;
                $piedata = get_data_report("SELECT  count(*) AS SUMM,mattype FROM (SELECT br.Borrow,substring(db.Subfield,2,1) AS mattype FROM borrowandreturn br LEFT JOIN (SELECT databib.Subfield,databib.Field,databib_item.Barcode FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID)AS db ON br.Book = db.Barcode WHERE db.Field = '964')AS sub1 GROUP BY mattype");
                $datapie = [];
                foreach ($piedata as $value) {
                  $namemattype = findmattypename($value['mattype']);
                  array_push($datapie, array("label" => $namemattype, "y" => $value['SUMM']));
                }
                if (count($getdatayear) > 0) {
                  ?>
                    <div>
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr class="warning">
                            <th style="vertical-align: middle;" class="t-cen" rowspan="2">เมื่อปี</th>
                            <th class="t-cen" colspan="8">ประเภท</th>
                            <th style="vertical-align: middle;" class="t-cen" rowspan="2">รวม</th>
                          </tr>
                          <tr class="warning">
                        <?php $headtype = get_data_report("SELECT Name_Eng FROM subfield WHERE FIELD = '964' ORDER BY Code");
                        foreach ($headtype as $value) {
                          echo "<th class='t-cen'>" . $value['Name_Eng'] . "</th>";
                        } ?>
                            <!--<th class="t-cen">Mixed</th>-->
                            <!--<th class="t-cen">Article</th>-->
                            <!--<th class="t-cen">Book</th>-->
                            <!--<th class="t-cen">Computer File</th>-->
                            <!--<th class="t-cen">Map</th>-->
                            <!--<th class="t-cen">Music</th>-->
                            <!--<th class="t-cen">Serial</th>-->
                            <!--<th class="t-cen">Visual</th>-->
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
                          $sumcol8 = 0;
                          foreach ($getdatayear as $num => $data) { ?>
                            <tr>
                              <td class="t-cen"><?= (int) $data['years'] + 543 ?></td>
                              <td class="t-cen">
                                <?php if (count($get_mt1)) {
                                  foreach ($get_mt1 as $value) {
                                    if ($data['years'] == $value['years']) {
                                      echo $value['sum'];
                                      $sumcol1 = $sumcol1 + $value['sum'];
                                    }
                                  }
                                } else {
                                  echo '-';
                                }; ?>
                              </td>
                              <td class="t-cen">
                                <?php if (count($get_mt2)) {
                                  foreach ($get_mt2 as $value) {
                                    if ($data['years'] == $value['years']) {
                                      echo $value['sum'];
                                      $sumcol2 = $sumcol2 + $value['sum'];
                                    }
                                  }
                                } else {
                                  echo '-';
                                }; ?>
                              </td>
                              <td class="t-cen">
                                <?php if (count($get_mt3)) {
                                  foreach ($get_mt3 as $value) {
                                    if ($data['years'] == $value['years']) {
                                      echo $value['sum'];
                                      $sumcol3 = $sumcol3 + $value['sum'];
                                    }
                                  }
                                } else {
                                  echo '-';
                                }; ?>
                              </td>
                              <td class="t-cen">
                                <?php if (count($get_mt4)) {
                                  foreach ($get_mt4 as $value) {
                                    if ($data['years'] == $value['years']) {
                                      echo $value['sum'];
                                      $sumcol4 = $sumcol4 + $value['sum'];
                                    }
                                  }
                                } else {
                                  echo '-';
                                }; ?>
                              </td>
                              <td class="t-cen">
                                <?php if (count($get_mt5)) {
                                  foreach ($get_mt5 as $value) {
                                    if ($data['years'] == $value['years']) {
                                      echo $value['sum'];
                                      $sumcol5 = $sumcol5 + $value['sum'];
                                    }
                                  }
                                } else {
                                  echo '-';
                                }; ?>
                              </td>
                              <td class="t-cen">
                                <?php if (count($get_mt6)) {
                                  foreach ($get_mt6 as $value) {
                                    if ($data['years'] == $value['years']) {
                                      echo $value['sum'];
                                      $sumcol6 = $sumcol6 + $value['sum'];
                                    }
                                  }
                                } else {
                                  echo '-';
                                }; ?>
                              </td>
                              <td class="t-cen">
                                <?php if (count($get_mt7)) {
                                  foreach ($get_mt7 as $value) {
                                    if ($data['years'] == $value['years']) {
                                      echo $value['sum'];
                                      $sumcol7 = $sumcol7 + $value['sum'];
                                    }
                                  }
                                } else {
                                  echo '-';
                                }; ?>
                              </td>
                              <td class="t-cen">
                                <?php if (count($get_mt8)) {
                                  foreach ($get_mt8 as $value) {
                                    if ($data['years'] == $value['years']) {
                                      echo $value['sum'];
                                      $sumcol8 = $sumcol8 + $value['sum'];
                                    }
                                  }
                                } else {
                                  echo '-';
                                }; ?>
                              </td>
                              <td class="t-cen"><?= convperc((int) $data['sum'], $total) ?></td>
                            </tr>
                          <?php
                          } ?>
                          <tr>
                            <td class="t-cen">รวม(%)</td>
                            <td class="t-cen"><?= ($sumcol1 != 0 ? convperc($sumcol1, $total) : '-') ?></td>
                            <td class="t-cen"><?= ($sumcol2 != 0 ? convperc($sumcol2, $total) : '-') ?></td>
                            <td class="t-cen"><?= ($sumcol3 != 0 ? convperc($sumcol3, $total) : '-') ?></td>
                            <td class="t-cen"><?= ($sumcol4 != 0 ? convperc($sumcol4, $total) : '-') ?></td>
                            <td class="t-cen"><?= ($sumcol5 != 0 ? convperc($sumcol5, $total) : '-') ?></td>
                            <td class="t-cen"><?= ($sumcol6 != 0 ? convperc($sumcol6, $total) : '-') ?></td>
                            <td class="t-cen"><?= ($sumcol7 != 0 ? convperc($sumcol7, $total) : '-') ?></td>
                            <td class="t-cen"><?= ($sumcol8 != 0 ? convperc($sumcol8, $total) : '-') ?></td>
                            <td class="t-cen"><?= ($sumtotal = $sumcol1 + $sumcol2 + $sumcol3 + $sumcol4 + $sumcol5 + $sumcol6 + $sumcol7 + $sumcol8) . '(' . ($sumtotal * 100) / $total . '%)' ?></td>
                          </tr>
                        </tbody>
                      </table>
                      </body>
                      <input type="button" value="แสดงกราฟ" onclick="showpie()">
                <?php
                } else {
                  echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
                }
              }
            } else {
              echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
            }
                ?>
                    </div>
                    <!-------Modal--------->
                    <div class="modal fade modal1" id="pierender" role="dialog">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                          </div>
                          <div class="modal-footer">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-------endModal------>
                    <script>
                      function showpie() {
                        var chart = new CanvasJS.Chart("chartContainer", {
                          animationEnabled: true,
                          exportEnabled: true,
                          // title: {
                          //   text: <?= json_encode($titlegraph) ?>
                          // },
                          subtitles: [{
                            text: <?= json_encode($titlegraph) ?>
                          }],
                          data: [{
                            type: "pie",
                            showInLegend: "true",
                            legendText: "{label}",
                            indexLabelFontSize: 16,
                            indexLabel: "{label} : #percent%",
                            yValueFormatString: "#,##0",
                            dataPoints: <?php echo json_encode($datapie, JSON_NUMERIC_CHECK); ?>
                          }]
                        });
                        chart.render();
                        var myModal = $("#pierender");
                        myModal.modal();
                      }
                    </script>

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