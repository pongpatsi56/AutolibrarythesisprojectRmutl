<?php
//////รายงานการซื้อทรัพยากร/////
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
// echo $start_date . '</br>';
// echo $start_month . '</br>';
// echo $start_year . '</br>';
$title_date = '';
$title_type = '';
$fildate = '';
if ($subreporttype == 'byyear') {
  $strsql = " GROUP BY YEAR(buy.Date_Add)";
  $title_date = ' ทั้งหมด';
  $fildate = 'เมื่อปี';
} elseif ($subreporttype == 'byperiod') {
  $strsql = " WHERE YEAR(buy.Date_Add) = " . "'$start_year'" . " GROUP BY MONTH(buy.Date_Add) ";
  $title_date = 'เมื่อ ปี ' . (543 + $start_year);
  $fildate = 'เดือน/ปี';
} else {
  $strsql = " WHERE buy.Date_Add = " . "'$start_date'" . " GROUP BY buy.Date_Add";
  $title_date = ' เมื่อ ' . convert_datethai_monthfull($start_date);
  $fildate = 'วัน/เดือน/ปี';
}

// echo '<br>' . $strsql;
if ($subreporttype == 'bydate') {
  echo '<h4>' . "รายงานการซื้อทรัพยากร" . $title_date . '</h4>';
  $datas = array();
  $get_buy_data = get_data_report("SELECT buy.ID AS Buy_ID,CONCAT(librarian.FName,' ',librarian.LName) AS fullname FROM buy LEFT JOIN librarian ON buy.librarian = librarian.ID WHERE  buy.Date_Add = '$start_date'");
  foreach ($get_buy_data as $key) {
    $get_buyID = $key['Buy_ID'];
    $get_buy_item = get_data_report("SELECT * FROM buy_item WHERE Buy_ID = '$get_buyID' ");
    $buy_data = array(
      'Librarian' => $key['fullname'],
      'buy_item' => $get_buy_item,
    );
    if (count($buy_data['buy_item']) > 0) {
      array_push($datas, $buy_data);
    }
  }
  // echo '<pre>';
  // print_r($datas);
  // echo '</pre>';

  if (count($datas) > 0) {
?>
    <div id="table_id">
      <table class="table table-bordered table-striped">
        <tr>
          <th>ลำดับ</th>
          <th>ผู้ทำรายการ</th>
          <th>ชื่อทรัพยากร</th>
          <th>หมายเลข ISBN</th>
          <th>ราคา</th>
          <th>จำนวน</th>
        </tr>
        <?php
        $no = 1;
        $sum_amount = 0;
        $sum_book = 0;
        foreach ($datas as $data) {
          echo '<tr><td></td><th>' . $data['Librarian'] . '</th><td colspan="4"></td></tr>';
          if (count($data['buy_item']) > 0) {
            foreach ($data['buy_item'] as $subdata) {
              echo '<tr><td>' . $no . '</td><td></td>';
              echo '<td>' . $subdata['Title'] . '</td>';
              echo '<td>' . $subdata['ISBN'] . '</td>';
              echo '<td>' . $subdata['Price'] . '</td>';
              echo '<td>' . $subdata['Books'] . '</td></tr>';
              $no = $no + 1;
              $sum_amount = $sum_amount + (int)$subdata['Price'];
              $sum_book = $sum_book + (int)$subdata['Books'];
            }
          }
        }
        echo  '<tr><td colspan="3"></td><td class="t-cen" style="font-weight:bold ;text-decoration-line: underline;">รวมราคา</td><td style="font-weight:bold">' . $sum_amount . '</td><td style="font-weight:bold">บาท</td></tr>';
        echo  '<tr><td colspan="3"></td><td class="t-cen" style="font-weight:bold ;text-decoration-line: underline;">รวมจำนวน</td><td style="font-weight:bold">' . $sum_book . '</td><td style="font-weight:bold">หน่วย</td></tr>';
        ?>
      </table>
      </body>
      <footer>
        <br />
        <form target="_blank" action="AllReport/export/PurchaseReport_Export.php" method="post">
          <input type="hidden" value='<?= json_encode($datas) ?>' name="report_data">
          <input type="hidden" value='<?= $start_date ?>' name="start_date">
          <input type="submit" class="btn btn-success" value="Export PDF.">
        </form>
      </footer>
    <?php
  } else {
    echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
  }
} elseif ($subreporttype == 'byperiod') {
  echo '<h4>' . "รายงานการซื้อทรัพยากร" . $title_date . '</h4>';
  $get_data = get_data_report("SELECT buy.Date_Add AS buy_date,SUM(buy_item.Books) AS sum_book,SUM(buy_item.Price) AS sum_price FROM buy_item LEFT JOIN buy ON buy_item.Buy_ID = buy.ID $strsql");
  if (count($get_data) > 0) {
    $all_price = 0;
    $all_book = 0;
    ?>
      <table class="table table-bordered table-striped">
        <thead>
          <tr class="warning">
            <th class="t-cen">ลำดับ</th>
            <th class="t-cen"><?= $fildate ?></th>
            <th class="t-cen">ราคา(บาท)</th>
            <th class="t-cen">จำนวน(หน่วย)</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($get_data as $count => $data) { ?>
            <tr>
              <td class="t-cen"><?= ++$count ?></td>
              <td class="t-cen"><?= month_year($data['buy_date'], 'byperiod') ?></td>
              <td class="t-cen"><?= $data['sum_price'] ?></td>
              <td class="t-cen"><?= $data['sum_book'] ?></td>
            </tr>
          <?php
            $all_price = $all_price + (int)$data['sum_price'];
            $all_book = $all_book + (int)$data['sum_book'];
          } ?>
          <tr>
            <td class="t-cen" colspan="2" style="font-weight:bold ;text-decoration-line: underline;">รวม</td>
            <td class="t-cen" style="font-weight:bold;"><?= $all_price ?> บาท</td>
            <td class="t-cen" style="font-weight:bold;"><?= $all_book ?> หน่วย</td>
          </tr>
        </tbody>
      </table>
    <?php
  } else {
    echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
  }
} elseif ($subreporttype == 'byyear') {
  echo '<h4>' . "รายงานการซื้อทรัพยากร" . $title_date . '</h4>';
  $get_data = get_data_report("SELECT buy.Date_Add AS buy_date,SUM(buy_item.Books) AS sum_book,SUM(buy_item.Price) AS sum_price FROM buy_item LEFT JOIN buy ON buy_item.Buy_ID = buy.ID $strsql");
  if (count($get_data) > 0) {
    $all_price = 0;
    $all_book = 0;
    ?>
      <table class="table table-bordered table-striped">
        <thead>
          <tr class="warning">
            <th class="t-cen">ลำดับ</th>
            <th class="t-cen"><?= $fildate ?></th>
            <th class="t-cen">ราคา(บาท)</th>
            <th class="t-cen">จำนวน(หน่วย)</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($get_data as $count => $data) { ?>
            <tr>
              <td class="t-cen"><?= ++$count ?></td>
              <td class="t-cen"><?= month_year($data['buy_date'], 'byyear') ?></td>
              <td class="t-cen"><?= $data['sum_price'] ?></td>
              <td class="t-cen"><?= $data['sum_book'] ?></td>
            </tr>
          <?php
            $all_price = $all_price + (int)$data['sum_price'];
            $all_book = $all_book + (int)$data['sum_book'];
          } ?>
          <tr>
            <td class="t-cen" colspan="2" style="font-weight:bold ;text-decoration-line: underline;">รวม</td>
            <td class="t-cen" style="font-weight:bold;"><?= $all_price ?> บาท</td>
            <td class="t-cen" style="font-weight:bold;"><?= $all_book ?> หน่วย</td>
          </tr>
        </tbody>
      </table>
  <?php
  } else {
    echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
  }
}
  ?>
    </div>
    <script>
      $('#print_b').on('click', function() {
        var divContents = document.getElementById('ShowReportDetail').outerHTML;
        var title_report = document.getElementById('fil_report').options[document.getElementById('fil_report').selectedIndex].text;

        var printWindow = window.open('', '', 'height=700,width=1050,scrollbars=1');
        //สร้าง popup
        printWindow.document.write('<html><head><title>' + title_report + '</title>');
        printWindow.document.write('<link href="TableCSS.css" rel="stylesheet" type="text/css" />'); //css path  
        printWindow.document.write('</head><body onLoad="self.print();self.close();">');
        // สั่ง Print เมื่อ reder เสร็จ
        printWindow.document.write(divContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        //printWindow.print();   print แบบนี้มีปัญหา run ไม่ได้ทุก Browser
      });
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