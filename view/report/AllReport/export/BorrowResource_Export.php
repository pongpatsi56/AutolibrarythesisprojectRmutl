<?php
date_default_timezone_set('asia/bangkok');
session_start();
$datas = json_decode($_POST['report_data'], true);
$getdate = $_POST['start_date'];
require $_SERVER['DOCUMENT_ROOT'] . '/lib/fpdf17/fpdf.php';

include $_SERVER['DOCUMENT_ROOT'] . '/lib/model/reportmodel.php';
//A4 width  = 219mm - margin (L/R)20mm = 189 mm
//and height = 297mm


///code by Aoey
// $datas = array();
// $getlibdata = get_data_report("SELECT * FROM librarian JOIN borrowandreturn ON librarian.Username = borrowandreturn.Librarian GROUP BY borrowandreturn.Librarian");
//     foreach ($getlibdata as $key) {
//         $getlibID = $key['Librarian'];
//         $getmemdata = get_data_report("SELECT * FROM Member JOIN borrowandreturn ON Member.ID = borrowandreturn.Member WHERE borrowandreturn.librarian = '$getlibID'
//     GROUP BY borrowandreturn.Member ");
//         $libdata = array(
//             'Librarian' => $key['Librarian'],
//             'FName' => $key['FName'],
//             'LName' => $key['LName'],
//             'submem' => array()
//         );
//         foreach ($getmemdata as $key1) {
//             $getID = $key1['Member'];
//             $getbookdata = get_data_report("SELECT *,CONCAT(databibliography.title,' / ',databibliography.author) AS NameBooks FROM borrowandreturn LEFT JOIN databibliography ON  borrowandreturn.Book = databibliography.Barcode
//             WHERE borrowandreturn.Member = '$getID'");
//             $memdata = array(
//                 'Member' => $key1['Member'],
//                 'FName' => $key1['FName'],
//                 'LName' => $key1['LName'],
//                 'subbook' => $getbookdata
//             );
//             array_push($libdata['submem'],$memdata);
//         }
//         array_push($datas,$libdata);
//     }

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
            if (count($data['submem']) > 0) {
                foreach ($data['submem'] as $submem) {
                    if (count($submem['subbook']) > 0) {
                        foreach ($submem['subbook'] as $subbook) {
                            $count_list = $count_list + 1;
                        }
                    }
                }
            }
        }
        return $count_list;
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
        $this->Cell(171, 8, iconv('UTF-8', 'TIS-620', 'รายงานสถิติการยืมทรัพยากร'), 0, 1, "R");
        //end line
        $this->SetFont('sara', '', 12);
        $this->Cell(25, 8, '', 0, 0, '');
        $this->Cell(75, 6, iconv('UTF-8', 'TIS-620', 'RMUTL'), 0, 0, '');
        $this->SetFont('sara', '', 16);
        $this->Cell(46, 8, iconv('UTF-8', 'TIS-620', 'รายงานประจำวันที่'), 0, 0, "");
        $this->Cell(50, 8, iconv('UTF-8', 'TIS-620', $this->convert_datethai_monthdot($this->_getstartdate)), 0, 1, "R");
        //end line
        $this->SetFont('sara', '', 12);
        $this->Cell(25, 8, '', 0, 0, '');
        $this->Cell(75, 1, iconv('UTF-8', 'TIS-620', 'งานห้องสมุด'), 0, 0, "");
        $this->SetFont('sara', '', 16);
        $this->Cell(72, 8, iconv('UTF-8', 'TIS-620', 'รวมทั้งหมด'), 0, 0, "R");
        $this->Cell(12, 8, iconv('UTF-8', 'TIS-620', $this->count_list($this->_getdata)), 0, 0, "R");
        $this->Cell(12, 8, iconv('UTF-8', 'TIS-620', 'เล่ม'), 0, 1, "R");
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
$pdf->Rect(8, 39, 196, 0.5, 'F');
$pdf->Cell(12, 7, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 0, 0, "L");
$pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', 'ผู้ให้บริการยืม'), 0, 0, "L");
$pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', 'รายการสมาชิก'), 0, 0, "C");
$pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', 'หมายเลข ISBN'), 0, 0, "L");
$pdf->Cell(90, 7, iconv('UTF-8', 'TIS-620', 'ชื่อเรื่อง'), 0, 0, "L");
$pdf->Cell(19, 7, iconv('UTF-8', 'TIS-620', 'กำหนดส่ง'), 0, 1, "L");
$pdf->Rect(8, 45.5, 196, 0.5, 'F');
//end line
$no = 1;
foreach ($datas as $data) {
    $pdf->SetFont('sara', 'B', 14);
    $pdf->Cell(12, 7, iconv('UTF-8', 'TIS-620', ''), 0, 0, "");
    $pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', (isset($data['FName'])? $data['FName']:'-') . ' ' . (isset($data['LName'])? $data['LName']:'-')), 0, 1, "L");
    if (count($data['submem']) > 0) {
        foreach ($data['submem'] as $submem) {
            $pdf->SetFont('sara', 'B', 14);
            $pdf->Cell(37, 7, iconv('UTF-8', 'TIS-620', ''), 0, 0, "");
            $pdf->Cell(50, 7, iconv('UTF-8', 'TIS-620', (isset($submem['FName'])?$submem['FName']:'-') . ' ' . (isset($submem['LName'])?$submem['LName']:'-')), 0, 1, "L");
            if (count($submem['subbook']) > 0) {
                foreach ($submem['subbook'] as $barcode => $subbook) {
                    $pdf->SetFont('sara', '', 14);
                    $pdf->Cell(12, 7, iconv('UTF-8', 'TIS-620', $no), 0, 0, "L");
                    $pdf->Cell(50, 7, iconv('UTF-8', 'TIS-620', ''), 0, 0, "");
                    $pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', (isset($subbook['ISBN']['#a']) ? $subbook['ISBN']['#a'] : '-')), 0, 0, "L");
                    $text = iconv('UTF-8', 'TIS-620', (isset($subbook['Title']['#a']) ? $subbook['Title']['#a'] : '-') . ' / ' . (isset($subbook['Author']['#a']) ? $subbook['Author']['#a'] : '-'));
                    $pdf->WordWrap($text, 95);
                    //$pdf->write(7,$text);
                    //$pdf->MultiCell(95, 7, iconv('UTF-8', 'TIS-620', $subbook['Title']['#a'] . ' / ' . $subbook['Author']['#a']), 1, 'L');
                    $h_next = $pdf->MultiAlignCell(90, 7, iconv('UTF-8', 'TIS-620', (isset($subbook['Title']['#a']) ? $subbook['Title']['#a'] : '-')), 0, 0, 'L');
                    //$pdf->Cell(95, 7,$text, 1,0, 'L');
                    //$curx = $pdf->GetX();
                    //$pdf->myCell(95, 7,$curx,$text);
                    $pdf->Cell(19, $h_next, iconv('UTF-8', 'TIS-620', $pdf->convert_datethai_monthdot($subbook['Returns'])), 0, 1);
                    $no = $no + 1;
                }
            }
        }
    }
}

$pdf->Output();

?>
<link rel="shortcut icon" href="../../../../assets/images/favicon_20170911140318.ico">
