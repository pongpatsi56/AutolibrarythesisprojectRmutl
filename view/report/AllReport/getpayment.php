<?php
include "../../../helper/calsubfield.php";
include "../../../model/reportmodel.php";
$receiptno = $_POST['receiptno'];
$paiddatatype1 = get_data_report("SELECT *,br.Book AS bcode FROM finebook
LEFT JOIN borrowandreturn br ON finebook.Borrow_ID = br.ID
WHERE type ='1' AND receipt_NO = '$receiptno'");
$paiddatatype2 = get_data_report("SELECT *,br.Book AS bcode FROM finebook
LEFT JOIN borrowandreturn br ON finebook.Borrow_ID = br.ID
WHERE type ='2' AND receipt_NO = '$receiptno'");
$paidamount = get_data_report("SELECT * FROM fine_receipt WHERE receipt_NO = '$receiptno'");
?>
<table id="friendsoptionstable" class="table table-striped">
    <thead>
        <tr>
            <th width="80%">ทรัพยากร</th>
            <th width="20%">ค่าปรับ(บาท)</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($paiddatatype1)) { ?>
            <tr>
                <td>รายการคืนเกินกำหนด</td>
            </tr>
            <?php
            foreach ($paiddatatype1 as $key => $value) { ?>
                <tr>
                    <td>
                        &nbsp;&nbsp;&nbsp;<?= gettitlebook($value['bcode']) ?>
                    </td>
                    <td style="text-align: center;">
                        <?= number_format($value['Amount'], 2, '.', '') ?>
                    </td>
                </tr>
        <?php
            }
        } ?>
        <?php if (count($paiddatatype2)) { ?>
            <tr>
                <td>รายการสูญหาย</td>
            </tr>
            <?php
            foreach ($paiddatatype2 as $key => $value) { ?>
                <tr>
                    <td>
                        &nbsp;&nbsp;&nbsp;<?= gettitlebook($value['bcode']) ?>
                    </td>
                    <td style="text-align: center;">
                        <?= number_format($value['Amount'], 2, '.', '') ?>
                    </td>
                </tr>
            <?php
            }
        }
        foreach ($paidamount as $totalamount) { ?>
            <tr>
                <td style="text-align: right;font-weight: bold;">รวม</td>
                <td style="text-align: center;font-weight: bold;"><?= number_format($totalamount['Payment_Total'], 2, '.', '') ?></td>
            </tr>
            <tr>
                <td style="text-align: right;font-weight: bold;">ส่วนลด</td>
                <td style="text-align: center;font-weight: bold;"><?= number_format($totalamount['Free'], 2, '.', '') ?></td>
            </tr>
            <tr>
                <td style="text-align: right;font-weight: bold;text-decoration-line: underline;">รวมสุทธิ</td>
                <td style="text-align: center;font-weight: bold;text-decoration-line: underline;"><?= number_format($totalamount['Payment_Real'], 2, '.', '') ?></td>
                <!-- <td style="text-align: center;font-weight: bold;"><?= number_format($sumamount, 2, '.', '') ?></td> -->
            </tr>
        <?php
            exit;
        }
        ?>
    </tbody>
</table>