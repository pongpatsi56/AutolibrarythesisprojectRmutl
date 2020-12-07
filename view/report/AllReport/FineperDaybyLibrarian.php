<?php
////รายงานสรุปการชำระค่าปรับประจำวัน////
function month_year($date, $type)
{
  $str = convert_datethai_monthfull($date);
  $result = explode(' ', $str);
  if ($type == 'byperiod') {
    $str = $result[1] . ' ' . $result[2];
  } elseif ($type == 'byyear') {
    $str = $result[2];
  }
  return $str;
};
// echo $start_date . '</br>';
// echo $start_month . '</br>';
// echo $start_year . '</br>';
$title_date = '';
$getmem_data = get_data_report("SELECT CONCAT(FName,' ',LName) AS FullName FROM librarian WHERE ID = '$mem_info'");
if ($getmem_data) {
if ($subreporttype == 'byyear') {
  $get_data = get_data_report("SELECT DATE_FORMAT(Payment_Date,'%Y-%m-%d') AS Paiddate,YEAR(Payment_Date) AS yearpaid,
  IF(finebook.Type=1,SUM(Amount),'-') AS sumtype1,
  IF(finebook.Type=2,SUM(Amount),'-') AS sumtype2,
  IF(finebook.Type=1,count(receipt_NO),'-') AS counttype1,
  IF(finebook.Type=2,count(receipt_NO),'-') AS counttype2
  FROM finebook
  LEFT JOIN borrowandreturn b ON finebook.Borrow_ID = b.ID
  LEFT JOIN librarian l ON b.librarian = l.ID
  WHERE l.ID = '$mem_info' AND NULLIF(finebook.receipt_NO,'') IS NOT NULL
  GROUP BY YEAR(Payment_Date),finebook.Type
  ORDER BY YEAR(Payment_Date)");

  for ($i = 0; $i < count($get_data); $i++) {
    if (@$get_data[$i]['yearpaid'] == @$get_data[$i + 1]['yearpaid']) {
      $get_data[$i]['sumtype2'] = $get_data[$i + 1]['sumtype2'];
      $get_data[$i]['counttype2'] = $get_data[$i + 1]['counttype2'];
      unset($get_data[$i + 1]);
    }
  }

  echo '<h4>' . "รายงานสรุปการชำระค่าปรับประจำวัน " . $getmem_data[0]['FullName'] . ' รายปี</h4>';
  if (count($get_data)) { ?>
    <table class="table table-striped table-bordered">
      <thead>
        <tr class="warning">
          <th width="20px" style="vertical-align: middle;font-weight:bold" class="t-cen">ลำดับ</th>
          <th style="font-weight:bold" class="t-cen">ประจำ</th>
          <th style="font-weight:bold" class="t-cen">ค่าปรับคืนเกินกำหนด(บาท/รายการ)</th>
          <th style="font-weight:bold" class="t-cen">ค่าปรับสูญหาย(บาท/รายการ)</th>
          <th style="font-weight:bold" class="t-cen">รวม(บาท/รายการ)</th>
        </tr>
      </thead>
      <?php
      $no = 1;
      $totalc = 0;
      $totalt = 0;
      $sumc = 0;
      $sumt = 0;
      foreach ($get_data as $data) {
        $sumt = ceil($data['sumtype1']) + ceil($data['sumtype2']);
        $sumc = ceil($data['counttype1']) + ceil($data['counttype2']);
        $str = '';
        $str .= '<tr><td class="t-cen">' . $no++ . '</td><td>' . month_year($data['Paiddate'], $subreporttype) . '</td><td class="t-cen">' . $data['sumtype1'] . ' / ' . $data['counttype1'] . '</td><td class="t-cen">' . $data['sumtype2'] . ' / ' . $data['counttype2'] . '</td><td class="t-cen">' . number_format($sumt, 2, '.', '') . ' / ' . $sumc . '</td></tr>';
        echo str_replace('- / -', '-', $str);
        $totalc += $sumc;
        $totalt += $sumt;
      }
      echo '<tr class="success"><td></td><td></td><td></td><td class="t-cen" style="font-weight:bold">รวม</td><td class="t-cen" style="font-weight:bold">' . number_format($totalt, 2, '.', '') . ' / ' . $totalc . '</td></tr>';
      ?>
    </table>
  <?php
  } else {
    echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
  }
} elseif ($subreporttype == 'byperiod') {
  $title_date = 'ปี ' . (543 + $start_year);

  $get_data = get_data_report("SELECT DATE_FORMAT(Payment_Date,'%Y-%m-%d') AS Paiddate,MONTH(Payment_Date) AS mountpaid,
  IF(finebook.Type=1,SUM(Amount),'-') AS sumtype1,
  IF(finebook.Type=2,SUM(Amount),'-') AS sumtype2,
  IF(finebook.Type=1,count(receipt_NO),'-') AS counttype1,
  IF(finebook.Type=2,count(receipt_NO),'-') AS counttype2
  FROM finebook
  LEFT JOIN borrowandreturn b ON finebook.Borrow_ID = b.ID
  LEFT JOIN librarian l ON b.librarian = l.ID
  WHERE YEAR(Payment_Date)= ' $start_year' AND l.ID = '$mem_info'
  GROUP BY MONTH(Payment_Date),finebook.Type ORDER BY MONTH(Payment_Date)");

  for ($i = 0; $i < count($get_data); $i++) {
    if (@$get_data[$i]['mountpaid'] == @$get_data[$i + 1]['mountpaid']) {
      $get_data[$i]['sumtype2'] = $get_data[$i + 1]['sumtype2'];
      $get_data[$i]['counttype2'] = $get_data[$i + 1]['counttype2'];
      unset($get_data[$i + 1]);
    }
  }

  echo '<h4>' . "รายงานสรุปการชำระค่าปรับ " . $getmem_data[0]['FullName'] . " เมื่อ " . $title_date . '</h4>';
  if (count($get_data)) { ?>
    <table class="table table-striped table-bordered">
      <thead>
        <tr class="warning">
          <th width="20px" style="vertical-align: middle;font-weight:bold" class="t-cen">ลำดับ</th>
          <th style="font-weight:bold" class="t-cen">ประจำ</th>
          <th style="font-weight:bold" class="t-cen">ค่าปรับคืนเกินกำหนด(บาท/รายการ)</th>
          <th style="font-weight:bold" class="t-cen">ค่าปรับสูญหาย(บาท/รายการ)</th>
          <th style="font-weight:bold" class="t-cen">รวม(บาท/รายการ)</th>
        </tr>
      </thead>
      <?php
      $no = 1;
      $totalc = 0;
      $totalt = 0;
      $sumc = 0;
      $sumt = 0;
      foreach ($get_data as $data) {
        $sumt = ceil($data['sumtype1']) + ceil($data['sumtype2']);
        $sumc = ceil($data['counttype1']) + ceil($data['counttype2']);
        $str = '';
        $str .= '<tr><td class="t-cen">' . $no++ . '</td><td>' . month_year($data['Paiddate'], $subreporttype) . '</td><td class="t-cen">' . $data['sumtype1'] . ' / ' . $data['counttype1'] . '</td><td class="t-cen">' . $data['sumtype2'] . ' / ' . $data['counttype2'] . '</td><td class="t-cen">' . number_format($sumt, 2, '.', '') . ' / ' . $sumc . '</td></tr>';
        echo str_replace('- / -', '-', $str);
        $totalc += $sumc;
        $totalt += $sumt;
      }
      echo '<tr class="success"><td></td><td></td><td></td><td class="t-cen" style="font-weight:bold">รวม</td><td class="t-cen" style="font-weight:bold">' . number_format($totalt, 2, '.', '') . ' / ' . $totalc . '</td></tr>';
      ?>
    </table>
  <?php
  } else {
    echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
  }
} elseif ($subreporttype == 'bydate') {
 $get_data = get_data_report("SELECT m.ID AS ID,fr.Free AS discount,fr.Payment_Real AS Amount,fr.Payment_Total AS total,fr.receipt_NO,CONCAT(m.FName,' ',m.LName) AS memname,CONCAT(l.FName,' ',l.LName) AS libname 
    FROM fine_receipt fr
            LEFT JOIN finebook fb ON fb.receipt_NO = fr.receipt_NO
            LEFT JOIN borrowandreturn b ON fb.Borrow_ID = b.ID
            LEFT JOIN librarian l ON b.librarian = l.ID
            LEFT JOIN member m ON b.Member = m.ID
    WHERE NULLIF(fr.receipt_NO,'') IS NOT NULL AND DATE(Payment_Date) = '$start_date' AND l.ID = '$mem_info' GROUP BY fr.receipt_NO");

    echo '<h4>' . "รายงานสรุปการชำระค่าปรับประจำวัน " . $getmem_data[0]['FullName'] . " เมื่อ " . convert_datethai_monthfull($start_date) . '</h4>';
    if (count($get_data)) {
    ?>
      <table class="table table-striped table-bordered">
        <tr class="warning">
          <th width="20px" style="vertical-align: middle;font-weight:bold" class="t-cen">ลำดับ</th>
          <th style="font-weight:bold" class="t-cen">เลขที่ใบเสร็จ</th>
          <th style="font-weight:bold" class="t-cen">ผู้จ่ายเงิน</th>
          <th style="font-weight:bold" class="t-cen">ผู้รับเงิน</th>
          <th style="font-weight:bold" class="t-cen">จำนวนเงินที่จ่าย</th>
        </tr>
        <?php
        $sum_amount = 0;
        foreach ($get_data as $count => $data) {
          $recptno = "'" . $data['receipt_NO'] . "'";
          // echo '<tr><td class="t-cen">' . ++$count . '</td><td>' . $data['memname'] . '</td><td><a class="text-primary" onclick="showreceipt(' . $recptno . ')">' . $data['receipt_NO'] . '</a></td><td>' . $data['libname'] . '</td></tr>';
        ?>
          <tr>
            <td class="t-cen"><?= ++$count ?></td>
            <td class="t-cen"><a class="text-primary" onclick="showreceipt(<?= $recptno ?>)"><?= $data['receipt_NO'] ?></a></td>
            <td class="t-cen"><?= $data['memname'] ?></td>
            <td class="t-cen"><?= $data['libname'] ?></td>
            <td class="t-cen"><?= number_format($data['Amount'], 2, '.', '') ?></td>
          </tr>
        <?php
          $sum_amount = $sum_amount + $data['Amount'];
        }
        ?>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td style="font-weight:bold ;text-decoration-line: underline;" class="t-cen">รวม</td>
          <td style="font-weight:bold ;text-decoration-line: underline;" class="t-cen"><?= number_format($sum_amount, 2, '.', '') ?></td>
        </tr>
      </table>
<?php
  } else {
    echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
  }
}
} else {
  echo ('<h4 class="text-danger">ไม่พบข้อมูลบุคลากร</h4>');
}
?>

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

<!-------Modal--------->
<div class="modal fade modal1" id="paidmodal" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div>
          <h3>Payment</h3>
        </div>
      </div>
      <div class="modal-body" id="showpayment">
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-------endModal------>
<script>
  function showreceipt(rcptno) {
    $.ajax({
      url: "/lib/view/report/AllReport/getpayment.php",
      data: {
        receiptno: rcptno
      },
      type: "POST",
      success: function(data) {
        console.log(data);
        $("#showpayment").html(data);
        var myModal = $("#paidmodal");
        myModal.modal();
      },
      error: function(e) {
        console.log(e);
        alert("something wrong!");
      }
    });
  }
</script>