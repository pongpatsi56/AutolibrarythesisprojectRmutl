<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/lib/include/connect.php';
function calsub($arr, $field, $sub)
{

    for ($i = 0; $i < mysqli_num_rows($arr); $i++) {
        $res[$i] = $arr->fetch_assoc();
    }

    foreach ($res as $key => $value) {
        if ($res[$key]['Field'] == $field) {
            $data = $res[$key]['Subfield'];
        }
    }

    $data = explode("/", $data);

    for ($i = 0; $i < @count($data); $i++) {
        if (substr($data[$i], 0, 2) == $sub) {
            $data = substr($data[$i], 3);
        }
    }

    return $data;
}

function calsub_arr($array, $field)
{
    if (gettype($array)=='string') {
        $data = [];
        if ($field == '100') {
            $data['Author'] = $array;
        } elseif ($field == '260') {
            $data['Publication'] = $array;
        } elseif ($field == '245') {
            $data['Title'] = $array;
        } elseif ($field == '020' || $field == '022') {
            $data['ISBN'] = $array;
        } elseif ($field == '951') {
            $data['Location'] = $array;
        } elseif ($field == '650') {
            $data['Subject'] = $array;
        } elseif ($field == '964') {
            $data['mattype'] = $array;
        }elseif ($field == '962') {
            $data['View'] = $array;
        }elseif ($field == '960') {
            $data['Pic'] = $array;
        }elseif ($field == '773') {
            $data['Page'] = $array;
        } 
        else {
            $data[$field[0]] = $array;
        }

        foreach ($data as $i => $value) {
            $data[$i] = explode("/", $data[$i]);
        }

        foreach ($data as $i => $value) {
            foreach ($data[$i] as $j => $value) {
                $data[$i][substr($data[$i][$j], 0, 2)] = substr($data[$i][$j], 3);
                unset($data[$i][$j]);
            }
        }
    }
    
    else if(gettype($array)=='object'){
        for ($i = 0; $i < mysqli_num_rows($array); $i++) {
            $arr[$i] = $array->fetch_assoc();
        }
    
        foreach ($arr as $key => $value) {
            for ($i = 0; $i < count($field); $i++) {
                if ($arr[$key]['Field'] == $field[$i]) {
                    if ($arr[$key]['Field'] == '100') {
                        $data[$arr[$key]['Barcode']]['Author'] = $arr[$key]['Subfield'];
                    } elseif ($arr[$key]['Field'] == '260') {
                        $data[$arr[$key]['Barcode']]['Publication'] = $arr[$key]['Subfield'];
                    } elseif ($arr[$key]['Field'] == '245') {
                        $data[$arr[$key]['Barcode']]['Title'] = $arr[$key]['Subfield'];
                    } elseif ($arr[$key]['Field'] == '020' || $arr[$key]['Field'] == '022') {
                        $data[$arr[$key]['Barcode']]['ISBN'] = $arr[$key]['Subfield'];
                    } elseif ($arr[$key]['Field'] == '951') {
                        $data[$arr[$key]['Barcode']]['Location'] = $arr[$key]['Subfield'];
                    } elseif ($arr[$key]['Field'] == '650') {
                        $data[$arr[$key]['Barcode']]['Subject'] = $arr[$key]['Subfield'];
                    } elseif ($arr[$key]['Field'] == '365') {
                        $data[$arr[$key]['Barcode']]['Price'] = $arr[$key]['Subfield'];
                    } elseif ($arr[$key]['Field'] == '960') {
                        $data[$arr[$key]['Barcode']]['imgpath'] = $arr[$key]['Subfield'];
                    } else {
                        $data[$arr[$key]['Barcode']][$arr[$key]['Field']] = $arr[$key]['Subfield'];
                    }
                }
            }
        }
    
        foreach ($data as $i => $value) {
            foreach ($data[$i] as $j => $value) {
                $data[$i][$j] = explode("/", $data[$i][$j]);
            }
        }
    
        foreach ($data as $i => $value) {
            foreach ($data[$i] as $j => $value) {
                foreach ($data[$i][$j] as $t => $value) {
                    $data[$i][$j][substr($data[$i][$j][$t], 0, 2)] = substr($data[$i][$j][$t], 3);
                    unset($data[$i][$j][$t]);
                }
            }
        }
    }
    
    return $data;
}

function calstr($resu)
{

    for ($i = 0; $i < mysqli_num_rows($resu); $i++) {
        $res[$i] = $resu->fetch_assoc();
    }
    if (isset($res)) {
        $stack = "(";
        for ($i = 0; $i < count($res); $i++) {
            $stack .= "'" . $res[$i]['Barcode'] . "',";
        }
        $stack = substr($stack, 0, strlen($stack) - 1);
        $stack .= ")";
        return $stack;
    } else {
        return NULL;
    }
}
function calstrreport($resu)
{
    $data = array(
        'book' => array(),
        'stack' => ''
    );
    for ($i = 0; $i < mysqli_num_rows($resu); $i++) {
        $res[$i] = $resu->fetch_assoc();
        array_push($data['book'], $res[$i]);
    }

    $stack = "(";
    for ($i = 0; $i < count($res); $i++) {
        $stack .= "'" . $res[$i]['Barcode'] . "',";
    }
    $stack = substr($stack, 0, strlen($stack) - 1);
    $stack .= ")";
    // array_push($data['book'], $res);
    $data['stack'] = $stack;
    return $data;
}

function querydata($sql)
{
    global $conn;
    $res = $conn->query($sql);
    if ($res->num_rows == 0) {
        return null;
        exit;
    }
    $stack = calstr($res);
    $sql = " SELECT * FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID WHERE Barcode IN $stack ";
    $res = $conn->query($sql);
    $data = calsub_arr($res, ['020', '022', '245', '100', '260', '951', '650', '960']);
    return $data;
}

function gettitlebook($barcode)
{
    $data = querydata("SELECT * FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID WHERE Barcode = '$barcode'");
    return $data[$barcode]['Title']['#a'];
}

function GetTitleByBib_ID($bibid)
{
    global $conn;
    $data = mysqli_query($conn, "SELECT substring_index((substring_index(Subfield,'#a=',-1)),'/',1) AS title  FROM databib WHERE Field = '245' AND Bib_ID = '$bibid'");
    if ($data && $data->num_rows > 0) {
        while ($row = $data->fetch_assoc()) {
            return $row['title'];
        }
    } else {
        return '-';
    }
}
function GetISBNByBib_ID($bibid)
{
    global $conn;
    $data = mysqli_query($conn, "SELECT substring_index((substring_index(Subfield,'#a=',-1)),'/',1) AS ISBN FROM databib WHERE Field = '022' AND Bib_ID = '$bibid'");
    if ($data && $data->num_rows > 0) {
        while ($row = $data->fetch_assoc()) {
            return $row['ISBN'];
        }
    } else {
        return '-';
    }
}

function gettitleandauthorbook($barcode)
{
    $data = querydata("SELECT * FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID WHERE Barcode = '$barcode'");
    $str_title = isset($data[$barcode]['Title']['#a']) ? $data[$barcode]['Title']['#a'] : '-';
    $str_author = isset($data[$barcode]['Author']['#a']) ? $data[$barcode]['Author']['#a'] : '-';
    return $str_title . ' / ' . $str_author;
}

function querydatareport($sql)
{
    global $conn;
    $res = $conn->query($sql);
    $rescal = calstrreport($res);
    $stack = $rescal['stack'];
    $sql = " SELECT * FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID WHERE Barcode IN $stack ";
    $res = $conn->query($sql);
    $resbook = calsub_arr($res, ['020', '022', '245', '100', '260', '951', '650']);

    foreach ($rescal['book'] as $brnum => $brval) {
        foreach ($resbook as $booknum => $bookval) {
            if ($brval['Barcode'] == $booknum) {
                $resbook[$booknum]['Returns'] = $brval['Returns'];
            }
        }
    }
    return $resbook;
}
function count_ref($data, $find, $tag)
{
    $a = array();
    foreach ($data as $value) {
        if (isset($value[$find][$tag])) {
            array_push($a, $value[$find][$tag]);
        } else {
            array_push($a, '');
        }
    }
    return array_count_values($a);
}
function count_same($data, $find, $tag)
{
    $main_data = array();
    foreach ($data as $key => $value) {
        if ($find=='Author') {
            if (isset($data[$key]['100']['sub'])    ) {
                $cut = calsub_arr($data[$key]['100']['sub'],'100');
                if (isset($cut['Author']['#a'])) {
                    $data[$key]['100']['sub'] = $cut['Author']['#a'];
                }
                else{
                    $data[$key]['100']['sub'] = "ไม่มีชื่อผู้แต่ง";
                }
            }
            else {
                $data[$key]['100']['sub'] = "ไม่มีชื่อผู้แต่ง";
            }
        }
        elseif($find=='Title') {
            if (isset($data[$key]['245']['sub'])) {
                $cut = calsub_arr($data[$key]['245']['sub'],'245');
                $data[$key]['245']['sub'] = $cut['Title']['#a'];
            }
            else {
                $data[$key]['245']['sub'] = "ไม่มีชื่อเรื่อง";
            }
        }
        elseif($find=='Subject') {
            if (isset($data[$key]['650']['sub'])) {
                $cut = calsub_arr($data[$key]['650']['sub'],'650');
                $data[$key]['650']['sub'] = $cut['Subject']['#a'];
            }
            else {
                $data[$key]['650']['sub'] = "ไม่มีหัวเรื่อง";
            }
        }
        elseif($find=='Publication') {
            if (isset($data[$key]['260']['sub'])) {
                $cut = calsub_arr($data[$key]['260']['sub'],'260');
                if (isset($cut['Publication']['#c'])) {
                    $data[$key]['260']['sub'] = $cut['Publication']['#c'];
                }
                else{
                    $data[$key]['260']['sub'] = "ไม่มีปีที่พิมพ์";
                }
            }
            else {
                $data[$key]['260']['sub'] = "ไม่มีปีที่พิมพ์";
            }
        }
        elseif($find=='Location') {
            if (isset($data[$key]['951']['sub'])) {
                $cut = calsub_arr($data[$key]['951']['sub'],'951');
                $data[$key]['951']['sub'] = explode(',',$cut['Location']['#a']);
            }
            else {
                $data[$key]['951']['sub'] = [];
            }
        }
    }
    foreach ($data as $key => $value) {
        if ($find=='Author') {
            if (isset($data[$key]['100']['sub'])) {
                array_push($main_data, $data[$key]['100']['sub']);
            } else {
                array_push($main_data, '');
            }
        }
        elseif($find=='Title') {
            if (isset($data[$key]['245']['sub'])) {
                array_push($main_data, $data[$key]['245']['sub']);
            } else {
                array_push($main_data, '');
            }
        }
        elseif($find=='Subject') {
            if (isset($data[$key]['650']['sub'])) {
                array_push($main_data, $data[$key]['650']['sub']);
            } else {
                array_push($main_data, '');
            }
        }
        elseif($find=='Publication') {
            if (isset($data[$key]['260']['sub'])) {
                array_push($main_data, $data[$key]['260']['sub']);
            } else {
                array_push($main_data, '');
            }
        }
        elseif($find=='Location') {
            if (isset($data[$key]['951']['sub'])) {
                for ($i=0; $i < count($data[$key]['951']['sub']) ; $i++) { 
                    array_push($main_data, $data[$key]['951']['sub'][$i]);
                }
            } else {
                array_push($main_data, '');
            }
        }
    }
    return array_count_values($main_data);
}
    // use calsub
    // $sql = " SELECT * FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID WHERE Barcode = 1111 ";
    // $res = $conn->query($sql);
    // $stack = calstr($res);

    // print_r($stack);
    
    // $sql = " SELECT * FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID WHERE Barcode IN $stack ";
    // $res = $conn->query($sql);

    // $data = calsub_arr($res,[245,100,260]);
