<?php
require_once '../../helper/datehelper.php';
require_once '../../model/reportmodel.php';
require_once '../../helper/calsubfield.php';

$reporttype = $_POST['reporttype'];
$subreporttype = $_POST['subreporttype'];
$subsourcetype = $_POST['subsourcetype'];
$start_date = $_POST['startdate'];
$start_month = $_POST['startmonth'];
$start_year = $_POST['startyear'];
$end_date = $_POST['enddate'];
$mem_info = $_POST['memberinfo'];
if (isset($_POST['reporttype'])) {
    switch ($_POST['reporttype']) {
        case 'br_res_All':
            include "AllReport/BorrowResource_Report.php"; ////รายงานสถิติการยืมทรัพยากรของผู้ใช้
            break;
        case 'fine_byuser':
            include "AllReport/FineperUser_Report.php"; ///รายงานการชำระค่าปรับรายคน
            break;
        case 'br_res_percent':
            require_once "AllReport/BorrowResourcePercentage.php"; ///รายงานสถิติการยืมทรัพยากรเป็นร้อยละ
            break;
        case 'purchase_report':
            include "AllReport/purchase_report.php"; ////รายงานการซื้อทรัพยากร
            break;
        case 'br_res_byuser':
            include "Allreport/BorrowResourcebyUser_Report.php";
            break;
        case 'fine_day_bylib':
            include "AllReport/FineperDaybyLibrarian.php"; ////รายงานสรุปการชำระค่าปรับประจำวัน
            break;
        case 'index_journal':
            include "AllReport/index_journal.php"; // รายงานดัชนีบทความวารสาร);
            break;
        case 'rec_all_res':
            include "AllReport/Journal_summary.php"; // รายงานสรุปการลงวารสาร;
            break;
        case 'list_res':
            include "AllReport/ListResource.php"; ///รายงานสถิตการทำรายการทรัพยากร
            break;
        case 'list_res_bylib':
            include "AllReport/ListBorrowResourcebyLibrarian.php"; ///รายงานสถิติงานจัดทำรายการแยกตามชื่อพนักงาน
            break;
        default:
            echo ('<h4>ไม่พบรายงานที่คุณเลือก</h4>');
            exit;
    }
} else {
    echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
}
