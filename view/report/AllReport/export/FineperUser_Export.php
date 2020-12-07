<?php
date_default_timezone_set('asia/bangkok');
session_start();
$datas = json_decode($_POST['report_data'],true);
$get_date = $_POST['start_date'];
require $_SERVER['DOCUMENT_ROOT'] . '/lib/fpdf17/fpdf.php';
//A4 width  = 219mm - margin (L/R)20mm = 189 mm
//and height = 297mm
define('FPDF_FONTPATH', 'font/');
class PDF extends FPDF
{
    private $_getdata;
    private $_getstartdate;
    function set_value($_gdata,$_gdate)
    {
    $this->_getdata = $_gdata;
    $this->_getstartdate = $_gdate;
    }
    function count_list($datas)
    {
        $count_list = 0;
        foreach ($datas as $data ) {
            $count_list = $count_list + 1;
        }
        return $count_list;
    }
    function convert_datethai_monthdot($strDate)
    {
        //format('yyy/mm/dd')
        $strDate = explode('-', $strDate);
        $strYear = $strDate[0] + 543;
        $strMonthThai = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strDate[1] < 10 ? $strDate[1] = substr($strDate[1], 1, 1) : $strDate[1];
        $strDate[2] < 10 ? $strDate[2] = substr($strDate[2], 1, 1) : $strDate[2];
        $strMonth = $strMonthThai[$strDate[1]];
        $strDay = $strDate[2];
        return "$strDay $strMonth $strYear";
    }
    function convert_datethai_monthfull($strDate)
    {
        //format('yyyy-mm-dd')
        $strDate = explode('-', $strDate);
        $strYear = $strDate[0] + 543;
        $strMonthThai = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        $strDate[1] < 10 ? $strDate[1] = substr($strDate[1], 1, 1) : $strDate[1];
        $strDate[2] < 10 ? $strDate[2] = substr($strDate[2], 1, 1) : $strDate[2];
        $strMonth = $strMonthThai[$strDate[1]];
        $strDay = $strDate[2];
        return "$strDay $strMonth $strYear";
    }
    function Header()
    {
        $this->AddFont('angsa', '', 'angsa.php');
        $this->AddFont('sara', '', 'THSarabunNew.php');
        $this->AddFont('sara', 'B', 'THSarabunNew_b.php');
        //logo , title
        $this->Image('logo.png', 10, 8, 15);
        $this->SetFont('sara', 'B', 18);
        $this->Cell(25, 8, '', 0, 0, '');
        $this->Rect(108, 13, 96, 0.7, 'F');
        $this->Cell(171, 8, iconv('UTF-8', 'TIS-620', 'รายงานการชำระค่าปรับรายคน'), 0, 1, "R");
        //end line
        $this->SetFont('sara', '', 12);
        $this->Cell(25, 8, '', 0, 0, '');
        $this->Cell(75, 6, iconv('UTF-8', 'TIS-620', 'RMUTL'), 0, 0, '');
        $this->SetFont('sara', '', 16);
        $this->Cell(46, 8, iconv('UTF-8', 'TIS-620', ''),0, 0, "");
        $this->Cell(50, 8, iconv('UTF-8', 'TIS-620', $this->convert_datethai_monthdot($this->_getstartdate)), 0, 1, "R");
        
        //end line
        $this->SetFont('sara', '', 12);
        $this->Cell(25, 8, '', 0, 0, '');
        $this->Cell(75, 1, iconv('UTF-8', 'TIS-620', 'งานห้องสมุด'), 0, 0, "");
        $this->SetFont('sara', '', 16);
        $this->Cell(72, 8, iconv('UTF-8', 'TIS-620', 'ทั้งหมด'), 0, 0, "R");
        $this->Cell(10, 8, iconv('UTF-8', 'TIS-620', $this->count_list($this->_getdata)), 0, 0, "R");
        $this->Cell(14, 8, iconv('UTF-8', 'TIS-620', 'รายการ'), 0, 1, "R");
        //endline
        $this->SetFont('sara', '', 12);
        $this->Cell(25, 4, '', 0, 0, '');
        $this->Cell(75, -4, iconv('UTF-8', 'TIS-620', 'มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา'), 0, 0, "");
        $this->Ln(10);
    }

    function Footer()
    {
        $_date = $this->convert_datethai_monthfull(date('Y-m-d'));
        $this->AddFont('sara', '', 'THSarabunNew.php');
        $this->SetY(-10);
        $this->SetFont('sara', '', 12);
        $this->Rect(8, 287, 196, 0.5, 'F');
        $this->Cell(98, 8, iconv('UTF-8', 'TIS-620', 'วันที่พิมพ์ : ' . $_date), 0, 0, "");
        $this->Cell(98, 8, iconv('UTF-8', 'TIS-620', 'หน้า ' . $this->PageNo() . ' จาก {nb}'), 0, 1, "R");
    }
};


$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->set_value($datas, $get_date);
$pdf->SetMargins(8, 5, 8);
$pdf->AddPage();
$pdf->AddFont('angsa', '', 'angsa.php');
$pdf->AddFont('angsa', 'B', 'angsab.php');
$pdf->AddFont('angsa', 'I', 'angsai.php');
$pdf->AddFont('sara', '', 'THSarabunNew.php');
$pdf->AddFont('sara', 'B', 'THSarabunNew_b.php');
$pdf->AddFont('sara', 'I', 'THSarabunNew_i.php');
$pdf->AddFont('sara', 'BI', 'THSarabunNew_bi.php');
////title report////
$pdf->SetFont('sara', '', 20);
$pdf->SetTitle(iconv('UTF-8', 'cp874', 'RMUTL Library Report'));
//cell { width , height , text , border , end line , [align] }
$pdf->SetFont('sara', 'B', 14);
$pdf->Rect(8, 39, 196, 0.5, 'F');
$pdf->Cell(12, 7, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 0, 0, "L");
$pdf->Cell(30, 7, iconv('UTF-8', 'TIS-620', 'เลขที่ใบเสร็จ'), 0, 0, "L");
$pdf->Cell(94, 7, iconv('UTF-8', 'TIS-620', 'ผู้จ่ายเงิน'), 0, 0, "L");
$pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', 'ผู้รับเงิน'), 0, 0, "L");
$pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', 'จำนวนเงินที่จ่าย'), 0, 1, "L");
$pdf->Rect(8, 45.5, 196, 0.5, 'F');
//end line
$pdf->SetFont('sara', '', 14);
$total = 0;
foreach ($datas as $count => $data) {
    $pdf->Cell(12, 7, iconv('UTF-8', 'TIS-620', ' ' . ++$count), 0, 0, "L");
    $pdf->SetFont('sara', 'B', 14);
    $pdf->Cell(30, 7, iconv('UTF-8', 'TIS-620', (isset($data['receipt_NO']) ? $data['receipt_NO'] : '-')), 0, 0, "L");
    $pdf->SetFont('sara', '', 14);
    $pdf->Cell(30, 7, iconv('UTF-8', 'TIS-620', (isset($data['ID']) ? $data['ID'] : '-')), 0, 0, "L");
    $pdf->Cell(64, 7, iconv('UTF-8', 'TIS-620', (isset($data['memname']) ? $data['memname'] : '-')), 0, 0, "L");
    $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', (isset($data['libname']) ? $data['libname'] : '-')), 0, 0, "L");
    $pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', (isset($data['Amount']) ? $data['Amount'] : '0')), 0, 0, "R");
    $pdf->Cell(10, 7, iconv('UTF-8', 'TIS-620', ' บาท'), 0, 1, "L");
    $total = $total +  $data['Amount'];
}
$pdf->SetFont('sara', 'B', 14);
$pdf->Cell(171, 7, iconv('UTF-8', 'TIS-620', 'รวม  '), 0, 0, "R");
$pdf->Cell(15, 7, iconv('UTF-8', 'TIS-620', number_format($total, 2)), 0, 0, "R");
$pdf->Cell(10, 7, iconv('UTF-8', 'TIS-620', ' บาท'), 0, 1, "L");


$pdf->Output();

