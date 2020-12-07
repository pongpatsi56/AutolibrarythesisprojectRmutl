<?php
$now = date('Y-m-d');
function convert_datethai_monthdot($strDate)
{
  //กำหนด format ต้องเป็น 'yyyy-mm-dd' เท่านั้น
  if ($strDate == '') {
    return '';
    exit;
  } elseif ($strDate == '0000-00-00') {
    return '-';
    exit;
  }
  $strDate = explode('-', $strDate);
  $strYear = $strDate[0] + 543;
  $strMonthThai = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
  $strDate[1] < 10 ? $strDate[1] = substr($strDate[1], 1, 1) : $strDate[1];
  $strDate[2] < 10 ? $strDate[2] = substr($strDate[2], 1, 1) : $strDate[2];
  $strMonth = $strMonthThai[$strDate[1]];
  $strDay = $strDate[2];
  return "$strDay $strMonth $strYear";
  //return เป็น format 'd m yyyy' ver.thai
}
function convert_datethai_monthfull($strDate)
{
  //กำหนด format ต้องเป็น 'yyyy-mm-dd' เท่านั้น
  if ($strDate == '') {
    return '';
    exit;
  }

  $strDate = explode('-', $strDate);
  $strYear = $strDate[0] + 543;
  $strMonthThai = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
  $strDate[1] < 10 ? $strDate[1] = substr($strDate[1], 1, 1) : $strDate[1];
  $strDate[2] < 10 ? $strDate[2] = substr($strDate[2], 1, 1) : $strDate[2];
  $strMonth = $strMonthThai[$strDate[1]];
  $strDay = $strDate[2];
  return "$strDay $strMonth $strYear";
  //return เป็น format 'd m yyyy' ver.thai
}
function convthaitimestamp($strinput)
{
  //กำหนด format ต้องเป็น 'yyyy-mm-dd h:i:s' เท่านั้น
  if ($strinput == '') {
    return '';
    exit;
  }
  $date = date_create($strinput);
  $strTime = date_format($date, "H:i:s");
  $strTime = "เวลา " . $strTime . " น.";
  $strDate = date_format($date, "Y-m-d");
  $strDate = explode('-', $strDate);
  $strYear = $strDate[0] + 543;
  $strMonthThai = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
  $strDate[1] < 10 ? $strDate[1] = substr($strDate[1], 1, 1) : $strDate[1];
  $strDate[2] < 10 ? $strDate[2] = substr($strDate[2], 1, 1) : $strDate[2];
  $strMonth = $strMonthThai[$strDate[1]];
  $strDay = $strDate[2];
  return "$strDay $strMonth $strYear $strTime";
  //return เป็น format 'd m yyyy' ver.thai
}
function datediff($format, $start, $end = null)
{
  if ($start == '') {
    return '';
    exit;
  }
  $startdate = date_create($start);
  $enddate = date_create($end); ///ถ้า end เป็น null จะใช้เป็นวันเวลาปัจจุบันแทน
  $datediff = date_diff($startdate, $enddate, false);
  return $datediff->format($format);
  //////////////////////////////////////////////////////////////////////
  //PARA: Date Should In YYYY-MM-DD Format
  //RESULT FORMAT:
  // '%y Year %m Month %d Day %h Hours %i Minute %s Seconds'        =>  1 Year 3 Month 14 Day 11 Hours 49 Minute 36 Seconds
  // '%y Year %m Month %d Day'                                    =>  1 Year 3 Month 14 Days
  // '%m Month %d Day'                                            =>  3 Month 14 Day
  // '%d Day %h Hours'                                            =>  14 Day 11 Hours
  // '%d Day'                                                        =>  14 Days
  // '%h Hours %i Minute %s Seconds'                                =>  11 Hours 49 Minute 36 Seconds
  // '%i Minute %s Seconds'                                        =>  49 Minute 36 Seconds
  // '%h Hours                                                    =>  11 Hours
  // '%a Days                                                        =>  468 Days
  //////////////////////////////////////////////////////////////////////
}
