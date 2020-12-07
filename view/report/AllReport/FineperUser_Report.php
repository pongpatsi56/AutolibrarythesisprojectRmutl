<?php
////รายงานการชำระค่าปรับรายคน////
            require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/helper/datehelper.php';
            
            // //// get between date ///
            // $getmax_date = get_data_report("SELECT MAX(Day) AS _MAX FROM finebook");
            // $Lastend_date = $end_date != '' ? $end_date : $getmax_date[0]['_MAX'] ;
            
/// region query data ///
$get_data = get_data_report("SELECT m.ID AS ID,fr.Free AS discount,fr.Payment_Real AS Amount,fr.Payment_Total AS total,fr.receipt_NO,CONCAT(m.FName,' ',m.LName) AS memname,CONCAT(l.FName,' ',l.LName) AS libname FROM finebook
LEFT JOIN fine_receipt fr ON finebook.receipt_NO = fr.receipt_NO
LEFT JOIN borrowandreturn b ON finebook.Borrow_ID = b.ID
LEFT JOIN librarian l ON b.librarian = l.ID
LEFT JOIN member m ON b.Member = m.ID
WHERE NULLIF(finebook.receipt_NO,'') IS NOT NULL AND DATE(Payment_Date) = '$start_date' GROUP BY fr.receipt_NO");
/// end region ///
echo '<h4>' . "รายงานการชำระค่าปรับรายคน ประจำวันที่ " . convert_datethai_monthdot($start_date) . '</h4>';
if (count($get_data) > 0) { ?>
  <div>
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
    <footer>
      <form target="_blank" action="AllReport/export/FineperUser_Export.php" method="post">
        <input type="hidden" value='<?= json_encode($get_data) ?>' name="report_data">
        <input type="hidden" value='<?= $start_date ?>' name="start_date">
        <input type="submit" class="btn btn-success" value="Export PDF.">
      </form>
    </footer>
  <?php
} else {
  echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
} ?>
  </div>
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

  </html>