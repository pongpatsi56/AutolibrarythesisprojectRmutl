<?php
date_default_timezone_set('asia/bangkok');
session_start();
$datas = json_decode($_POST['report_data'], true);
$getdate = $_POST['start_date'];
require $_SERVER['DOCUMENT_ROOT'] . '/lib/fpdf17/fpdf.php';

include $_SERVER['DOCUMENT_ROOT'] . '/lib/model/reportmodel.php';
//A4 width  = 219mm - margin (L/R)20mm = 189 mm
//and height = 297mm

define('FPDF_FONTPATH', 'font/');
class PDF extends FPDF
{
    private $_getdata;
    private $_getstartdate;
    function set_value($_gdata, $_gdate)
    {
        $this->_getdata = $_gdata;
        $this->_getstartdate = $_gdate;
    }
    function count_list($param)
    {
        $count_list = 0;
        foreach ($param as $data) {
            if (count($data['buy_item']) > 0) {
                foreach ($data['buy_item'] as $subdata) {
                    $count_list = $count_list + 1;
                }
            }
        }
        return $count_list;
    }
    function count_res($param)
    {
        $count_res = 0;
        foreach ($param as $data) {
            if (count($data['buy_item']) > 0) {
                foreach ($data['buy_item'] as $subdata) {
                    $count_res = $count_res + (int)$subdata['Books'];
                }
            }
        }
        return $count_res;
    }
    function MultiAlignCell($w, $h, $text, $border = 0, $ln = 0, $align = 'L', $fill = false)
    {
        // Store reset values for (x,y) positions
        $textwidght = $this->GetStringWidth($text);
        $height_next = ($textwidght > $w) ? 2 * $h : $h;
        $x = $this->GetX() + $w;
        $y = $this->GetY();

        // Make a call to FPDF's MultiCell
        $this->MultiCell($w, $h, $text, $border, $align, $fill);

        // Reset the line position to the right, like in Cell
        if ($ln == 0) {
            $this->SetXY($x, $y);
        }
        return $height_next;
    }
    function myCell($w, $h, $x, $t)
    {
        $height = $h;
        $first = $height;
        $second = $height + $height;
        $space = $this->GetStringWidth(' ');
        $wordwidth = $this->GetStringWidth($t);

        $len = strlen($t);
        if ($len > 15) {
            $txt = str_split($t, 15);
            $this->SetX($x);
            $this->Cell($w, $first, $txt[0], '', '', '');
            $this->SetX($x);
            $this->Cell($w, $second, $txt[1], '', '', '');
            $this->SetX($x);
            $this->Cell($w, $h, '', 'LTRB', 0, 'L', 0);
        } else {
            $this->SetX($x);
            $this->Cell($w, $h, $t, 'LTRB', 0, 'L', 0);
        }
    }
    function WordWrap(&$text, $maxwidth)
    {
        $text = trim($text);
        if ($text === '')
            return 0;
        $space = $this->GetStringWidth(' ');
        $lines = explode("\n", $text);
        $text = '';
        $count = 0;

        foreach ($lines as $line) {
            $words = preg_split('/ +/', $line);
            $width = 0;

            foreach ($words as $word) {
                $wordwidth = $this->GetStringWidth($word);
                if ($wordwidth > $maxwidth) {
                    // Word is too long, we cut it
                    for ($i = 0; $i < strlen($word); $i++) {
                        $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
                        if ($width + $wordwidth <= $maxwidth) {
                            $width += $wordwidth;
                            $text .= substr($word, $i, 1);
                        } else {
                            $width = $wordwidth;
                            $text = rtrim($text) . "\n" . substr($word, $i, 1);
                            $count++;
                        }
                    }
                } elseif ($width + $wordwidth <= $maxwidth) {
                    $width += $wordwidth + $space;
                    $text .= $word . ' ';
                } else {
                    $width = $wordwidth + $space;
                    $text = rtrim($text) . "\n" . $word . ' ';
                    $count++;
                }
            }
            $text = rtrim($text) . "\n";
            $count++;
        }
        $text = rtrim($text);
        return $count;
    }
    function convert_datethai_monthdot($strDate)
    {
        //format('yyyy-mm-dd')
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
        $this->Cell(171, 8, iconv('UTF-8', 'TIS-620', 'รายงานการซื้อทรัพยากร'), 0, 1, "R");
        //end line
        $this->SetFont('sara', '', 12);
        $this->Cell(25, 8, '', 0, 0, '');
        $this->Cell(75, 6, iconv('UTF-8', 'TIS-620', 'RMUTL'), 0, 0, '');
        $this->SetFont('sara', '', 16);
        $this->Cell(46, 8, iconv('UTF-8', 'TIS-620', 'รายงานประจำวันที่'), 0, 0, "");
        $this->Cell(50, 8, iconv('UTF-8', 'TIS-620', $this->convert_datethai_monthfull($this->_getstartdate)), 0, 1, "R");
        //end line
        $this->SetFont('sara', '', 12);
        $this->Cell(25, 8, '', 0, 0, '');
        $this->Cell(75, 1, iconv('UTF-8', 'TIS-620', 'งานห้องสมุด'), 0, 0, "");
        $this->SetFont('sara', '', 16);
        $this->Cell(57, 8, iconv('UTF-8', 'TIS-620', 'รวมทั้งหมด'), 0, 0, "R");
        $this->Cell(8, 8, iconv('UTF-8', 'TIS-620', $this->count_list($this->_getdata)), 0, 0, "C");
        $this->Cell(13, 8, iconv('UTF-8', 'TIS-620', 'รายการ'), 0, 0, "R");
        $this->Cell(8, 8, iconv('UTF-8', 'TIS-620', $this->count_res($this->_getdata)), 0, 0, "C");
        $this->Cell(10, 8, iconv('UTF-8', 'TIS-620', 'หน่วย'), 0, 1, "R");
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
$pdf->set_value($datas, $getdate);
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
$pdf->Rect(8, 37.5, 196, 0.5, 'F');
$pdf->Cell(10, 4.5, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 0, 0, "L");
$pdf->Cell(20, 4.5, iconv('UTF-8', 'TIS-620', 'ผู้ทำรายการ'), 0, 0, "L");
$pdf->Cell(20, 4.5, iconv('UTF-8', 'TIS-620', ''), 0, 1, "L");
/////////end//
$pdf->Cell(15, 4, iconv('UTF-8', 'TIS-620', ''), 0, 0, "L");
$pdf->Cell(129, 4, iconv('UTF-8', 'TIS-620', 'ชื่อทรัพยากร'), 0, 0, "L");
$pdf->Cell(31, 4, iconv('UTF-8', 'TIS-620', 'หมายเลข ISBN'), 0, 0, "L");
$pdf->Cell(10, 4, iconv('UTF-8', 'TIS-620', 'ราคา'), 0, 0, "R");
$pdf->Cell(10, 4, iconv('UTF-8', 'TIS-620', 'จำนวน'), 0, 1, "C");
$pdf->Rect(8, 48, 196, 0.5, 'F');
//end line
$no = 1;
$sum_amount = 0;
$sum_book = 0;
foreach ($datas as $data) {
    $pdf->SetFont('sara', 'B', 14);
    $pdf->Cell(10, 8, iconv('UTF-8', 'TIS-620', ''), 0, 0, "");
    $pdf->Cell(20, 8, iconv('UTF-8', 'TIS-620', $data['Librarian']), 0, 1, "L");
    if (count($data['buy_item']) > 0) {
        foreach ($data['buy_item'] as $subdata) {
            $pdf->SetFont('sara', '', 14);
            $pdf->Cell(10, 7, iconv('UTF-8', 'TIS-620', $no), 0, 0, "L");
            $pdf->Cell(5, 7, iconv('UTF-8', 'TIS-620', ''), 0, 0, "");

            // $text = iconv('UTF-8', 'TIS-620', (isset($subdata['Title']) ? $subdata['Title'] : '-'));
            // $pdf->WordWrap($text, 95);
            // $h_next = $pdf->MultiAlignCell(90, 7, iconv('UTF-8', 'TIS-620', (isset($subdata['Price']) ? $subdata['Price'] : '-')), 0, 0, 'L');
            // $pdf->Cell(19, $h_next, iconv('UTF-8', 'TIS-620', (isset($subdata['Books']) ? $subdata['Books'] : '-')), 0, 0);

            $pdf->Cell(129, 7, iconv('UTF-8', 'TIS-620', (isset($subdata['Title']) ? $subdata['Title'] : '-')), 0, 0, "L");
            $pdf->Cell(31, 7, iconv('UTF-8', 'TIS-620', (isset($subdata['ISBN']) ? $subdata['ISBN'] : '-')), 0, 0, "L");
            $pdf->Cell(10, 7, iconv('UTF-8', 'TIS-620', (isset($subdata['Price']) ? $subdata['Price'] : '-')), 0, 0, "R");
            $pdf->Cell(10, 7, iconv('UTF-8', 'TIS-620', (isset($subdata['Books']) ? $subdata['Books'] : '-')), 0, 1, "C");

            $no = $no + 1;
            $sum_amount = $sum_amount + (int)$subdata['Price'];
            $sum_book = $sum_book + (int)$subdata['Books'];
        }
    }
}
$pdf->SetFont('sara', 'B', 14);
$pdf->Cell(144, 10, iconv('UTF-8', 'TIS-620', ''), 0, 0, "C");
$pdf->Cell(26, 10, iconv('UTF-8', 'TIS-620', 'รวมราคา'), 0, 0, "R");
$pdf->Cell(15, 10, iconv('UTF-8', 'TIS-620', $sum_amount), 0, 0, "R");
$pdf->Cell(10, 10, iconv('UTF-8', 'TIS-620', ' บาท'), 0, 1, "L");
/////end/////
$pdf->Cell(144, 2, iconv('UTF-8', 'TIS-620', ''), 0, 0, "C");
$pdf->Cell(26, 2, iconv('UTF-8', 'TIS-620', 'รวมจำนวน'), 0, 0, "R");
$pdf->Cell(15, 2, iconv('UTF-8', 'TIS-620', $sum_book), 0, 0, "R");
$pdf->Cell(10, 2, iconv('UTF-8', 'TIS-620', ' หน่วย'), 0, 1, "L");

$pdf->Output();
