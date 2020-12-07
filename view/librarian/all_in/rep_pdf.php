<?php

    date_default_timezone_set('asia/bangkok');
    session_start();
    $rep_NO = $_GET['rep_NO'];
    require $_SERVER['DOCUMENT_ROOT'] . '/lib/fpdf17/fpdf.php';
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/datehelper.php";


    $sql = "SELECT * FROM fine_receipt WHERE receipt_NO = '{$rep_NO}' ";
    $data = $conn->query($sql);
    for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
        $data_rep[$i] = $data ->fetch_assoc();
    }

    $sql = "SELECT * FROM finebook WHERE receipt_NO = '{$rep_NO}' ";
    $data = $conn->query($sql);
    for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
        $data_fine[$i] = $data ->fetch_assoc();
    }

    $stack = "(";
    for ($i=0; $i < count($data_fine) ; $i++) { 
        $stack .= "'{$data_fine[$i]['Borrow_ID']}',";
    }
    $stack = substr($stack,0,strlen($stack)-1).")";

    $sql = "SELECT * FROM borrowandreturn WHERE ID IN {$stack} ";

    $data = $conn->query($sql);
    for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
        $data_bor[$i] = $data ->fetch_assoc();
    }

    $stack = "(";
    for ($i=0; $i < count($data_bor) ; $i++) { 
        $stack .= "'{$data_bor[$i]['Book']}',";
    }
    $stack = substr($stack,0,strlen($stack)-1).")";

    $sql = "SELECT * FROM databib_item
    LEFT JOIN databib ON databib_item.Bib_ID = databib.Bib_ID
    WHERE Barcode IN {$stack} ";
    $data = $conn->query($sql);
    for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
        $data_book[$i] = $data ->fetch_assoc();
    }
    // print_r($data_book);
    for ($i=0; $i < count($data_fine) ; $i++) { 
        if ($data_rep[0]['receipt_NO']==$data_fine[$i]['receipt_NO']) {
            $date_temp = date("Y-m-d",strtotime($data_fine[$i]['Payment_Date']));
            $data_fine[$i]['Payment_Date'] = convert_datethai_monthdot($date_temp);
        }
    }


    define('FPDF_FONTPATH', 'font/');
    class PDF extends FPDF
    {
        private $data_uiq;

        function set_value($data_fine)
        {
            $this->data_uiq = $data_fine;
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
            $this->Image('logo.png', 15, 3, 11);
            $this->SetFont('sara', 'B', 18);
            $this->Cell(25, 8, '', 0, 0, '');
            $this->Rect(108, 13, 96, 0.7, 'F');
            $this->Cell(171, 8, iconv('UTF-8', 'TIS-620', 'ใบเสร็จค่าปรับ'), 0, 1, "R");
            //end line
            $this->SetFont('sara', '', 18);
            $this->Cell(25, 8, '', 0, 0, '');
            $this->Cell(75, -4, iconv('UTF-8', 'TIS-620', 'RMUTL'), 0, 0, '');
            $this->SetFont('sara', '', 16);
            $this->Cell(15, 8, iconv('UTF-8', 'TIS-620', 'วันที่'), 0, 0, "");
            $this->SetFont('sara', '', 16);
            $this->Cell(75, 8, iconv('UTF-8', 'TIS-620', $this->data_uiq[0]['Payment_Date']), 0, 0, "");
            $this->SetFont('sara', '', 16);
            $this->Cell(72, 8, iconv('UTF-8', 'TIS-620', 'รวมทั้งหมด'), 0, 0, "R");
            // $this->Cell(12, 8, iconv('UTF-8', 'TIS-620', $this->count_list($this->_getdata)), 0, 0, "R");
            $this->Cell(12, 8, iconv('UTF-8', 'TIS-620', 'เล่ม'), 0, 1, "R");
            //endline
            $this->SetFont('sara', '', 18);
            $this->Cell(25, 4, '', 0, 0, '');
            $this->Cell(75, -8, iconv('UTF-8', 'TIS-620', 'มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา'), 0, 0, "");
            $this->Ln(10);
        }

        function Footer()
        {
            // $_date = $this->convert_datethai_monthfull(date('Y-m-d'));
            $this->AddFont('sara', '', 'THSarabunNew.php');
            $this->SetY(-10);
            $this->SetFont('sara', '', 12);
            $this->Rect(8, 287, 196, 0.5, 'F');
            $this->Cell(25, 8, iconv('UTF-8', 'TIS-620', 'วันที่ออกใบเสร็จ : ' ), 0, 0, "");
            $this->Cell(30, 8, iconv('UTF-8', 'TIS-620', convert_datethai_monthdot(date('Y-m-d'))), 0, 0, "");

            // $this->Cell(98, 8, iconv('UTF-8', 'TIS-620', 'หน้า ' . $this->PageNo() . ' จาก {nb}'), 0, 1, "R");
        }
    };



    // echo "<pre>";
    // echo "-------------------------><br>";
    // print_r($data_bor);
    // echo "-------------------------><br>";
    // print_r($data_book);
    // echo "</pre>";


    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->AliasNbPages();
    $pdf->set_value($data_fine);
    $pdf->SetMargins(8, 5, 8);
    $pdf->AddPage();
    $pdf->AddFont('angsa', '', 'angsa.php');
    $pdf->AddFont('angsa', 'B', 'angsab.php');
    $pdf->AddFont('angsa', 'I', 'angsai.php');
    $pdf->AddFont('sara', '', 'THSarabunNew.php');
    $pdf->AddFont('sara', 'B', 'THSarabunNew_b.php');
    $pdf->AddFont('sara', 'I', 'THSarabunNew_i.php');
    $pdf->AddFont('sara', 'BI', 'THSarabunNew_bi.php');
    // ////title report////
    $pdf->SetFont('sara', '', 20);
    $pdf->SetTitle(iconv('UTF-8', 'cp874', 'Rep Report'));
    // cell { width , height , text , border , end line , [align] }
    $pdf->SetFont('sara', 'B', 14);
    $pdf->Rect(8, 25, 196, 0.5, 'F');
    $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620', 'ลำดับ'), 1, 0, "C");
    $pdf->Cell(80, 7, iconv('UTF-8', 'TIS-620', 'รายการทรัพยากร'), 1, 0, "C");
    $pdf->Cell(40, 7, iconv('UTF-8', 'TIS-620', 'หมายเลข ISBN'), 1, 0, "C");
    $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', 'ประเภทค่าปรับ'), 1, 0, "C");
    $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620', 'ค่าปรับ(บาท)'), 1, 1, "C");

    $pdf->SetFont('sara', '', 14);
    for ($i=0; $i < count($data_fine) ; $i++) { 
        $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620', ($i+1)), 0, 0, "C");
        for ($j=0; $j < count($data_bor) ; $j++) { 
            if ($data_fine[$i]['Borrow_ID']==$data_bor[$j]['ID']) {
                for ($k=0; $k < count($data_book) ; $k++) { 
                    if ($data_book[$k]['Barcode']==$data_bor[$j]['Book']&&$data_book[$k]['Field']=="245") {
                        $data_book_already_cut = calsub_arr($data_book[$k]['Subfield'],'245');
                        $name = $data_book_already_cut['Title']['#a'];
                        $pdf->Cell(80, 7, iconv('UTF-8', 'TIS-620', $name), 0, 0, "L");
                    break;
                    }
                }
                $check = 0;
                for ($k=0; $k < count($data_book) ; $k++) { 
                    if ($data_book[$k]['Barcode']==$data_bor[$j]['Book']&&$data_book[$k]['Field']=="020") {
                        // print_r(calsub_arr($data_book[$k]['Subfield'],'020'));
                        $data_book_already_cut = calsub_arr($data_book[$k]['Subfield'],'020');
                        $ISBN = $data_book_already_cut['ISBN']['#a'];
                        $pdf->Cell(40, 7, iconv('UTF-8', 'TIS-620', $ISBN), 0, 0, "L");
                        $check = 1;
                        break;
                    }
                }
                if($check == 0){
                    $pdf->Cell(40, 7, iconv('UTF-8', 'TIS-620', "-"), 0, 0, "L");
                }
                if ($data_fine[$i]['Type']==1) {
                    $data_fine[$i]['Type'] = "คืนเกินกำหนด";
                }
                else{
                    $data_fine[$i]['Type'] = "สูญหาย";
                }
                $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', $data_fine[$i]['Type']), 0, 0, "L");
                $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620', $data_fine[$i]['Amount']), 0, 1, "L");
            break;    
            }
        }
    }
    // print_r(($data_rep));
    $pdf->Cell(1, 7, iconv('UTF-8', 'TIS-620', ""), 0, 1, "L");
    $pdf->SetFont('sara', 'B', 14);
    $pdf->Cell(140, 7, iconv('UTF-8', 'TIS-620', ""), 0, 0, "L");
    $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', "รวมค่าปรับ"), 0, 0, "L");
    $pdf->SetFont('sara', '', 14);
    $pdf->SetFont('sara', '', 14);
    $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620', $data_rep[0]['Payment_Total']), 0, 1, "L");
    $pdf->Cell(140, 7, iconv('UTF-8', 'TIS-620', ""), 0, 0, "L");
    $pdf->SetFont('sara', 'B', 14);
    $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', "ลดหย่อน"), 0, 0, "L");
    $pdf->SetFont('sara', '', 14);
    $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620', $data_rep[0]['Free']), 0, 1, "L");
    $pdf->Cell(140, 7, iconv('UTF-8', 'TIS-620', ""), 0, 0, "L");
    $pdf->SetFont('sara', 'B', 14);
    $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', "ค่าปรับสุทธิ"), 0, 0, "L");
    $pdf->SetFont('sara', '', 14);
    $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620', $data_rep[0]['Payment_Real']), 0, 1, "L");
    $pdf->Cell(140, 7, iconv('UTF-8', 'TIS-620', ""), 0, 0, "L");
    $pdf->SetFont('sara', 'B', 14);
    $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', "เงินสด"), 0, 0, "L");
    $pdf->SetFont('sara', '', 14);
    $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620', $data_rep[0]['Paid']), 0, 1, "L");
    $pdf->Cell(140, 7, iconv('UTF-8', 'TIS-620', ""), 0, 0, "L");
    $pdf->SetFont('sara', 'B', 14);
    $pdf->Cell(35, 7, iconv('UTF-8', 'TIS-620', "เงินทอน"), 0, 0, "L");
    $pdf->SetFont('sara', '', 14);
    $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620', $data_rep[0]['Change']), 0, 1, "L");
    if ($data_rep[0]['Comment']!="") {
        $pdf->SetFont('sara', 'B', 14);
        $pdf->Cell(20, 7, iconv('UTF-8', 'TIS-620', "*หมายเหตุ"), 0, 0, "L");
        $pdf->SetFont('sara', '', 14);
        $pdf->Cell(175, 7, iconv('UTF-8', 'TIS-620', $data_rep[0]['Comment']), 0, 1, "L");
    }




    // $pdf->Rect(8, 45.5, 196, 0.5, 'F');
    // //end line
    // $no = 1;
    // foreach ($datas as $data) {
    //     $pdf->SetFont('sara', 'B', 14);
    //     $pdf->Cell(12, 7, iconv('UTF-8', 'TIS-620', ''), 0, 0, "");
    //     $pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', $data['FName'] . ' ' . $data['LName']), 0, 1, "L");
    //     if (count($data['submem']) > 0) {
    //         foreach ($data['submem'] as $submem) {
    //             $pdf->SetFont('sara', 'B', 14);
    //             $pdf->Cell(37, 7, iconv('UTF-8', 'TIS-620', ''), 0, 0, "");
    //             $pdf->Cell(50, 7, iconv('UTF-8', 'TIS-620', $submem['FName'] . ' ' . $submem['LName']), 0, 1, "L");
    //             if (count($submem['subbook']) > 0) {
    //                 foreach ($submem['subbook'] as $barcode => $subbook) {
    //                     $pdf->SetFont('sara', '', 14);
    //                     $pdf->Cell(12, 7, iconv('UTF-8', 'TIS-620', $no), 0, 0, "L");
    //                     $pdf->Cell(50, 7, iconv('UTF-8', 'TIS-620', ''), 0, 0, "");
    //                     $pdf->Cell(25, 7, iconv('UTF-8', 'TIS-620', $subbook['ISBN']['#a']), 0, 0, "L");
    //                     $text = iconv('UTF-8', 'TIS-620', $subbook['Title']['#a'] . ' / ' . $subbook['Author']['#a']);
    //                     $pdf->WordWrap($text, 95);
    //                     //$pdf->write(7,$text);
    //                     //$pdf->MultiCell(95, 7, iconv('UTF-8', 'TIS-620', $subbook['Title']['#a'] . ' / ' . $subbook['Author']['#a']), 1, 'L');
    //                     $h_next = $pdf->MultiAlignCell(90, 7, iconv('UTF-8', 'TIS-620', $subbook['Title']['#a']), 0, 0, 'L');
    //                     //$pdf->Cell(95, 7,$text, 1,0, 'L');
    //                     //$curx = $pdf->GetX();
    //                     //$pdf->myCell(95, 7,$curx,$text);
    //                     $pdf->Cell(19, $h_next, iconv('UTF-8', 'TIS-620', $pdf->convert_datethai_monthdot($subbook['Returns'])), 0, 1);
    //                     $no = $no + 1;
    //                 }
    //             }
    //         }
    //     }
    // }

    $pdf->Output();
