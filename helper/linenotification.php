<?php
require_once "../include/connect.php";
require_once "../helper/datehelper.php";
require_once "../helper/calsubfield.php";
date_default_timezone_set('asia/bangkok');
/*Get Data From POST Http Request*/
$datas = file_get_contents('php://input');
/*Decode Json From LINE Data Body*/
$deCode = json_decode($datas, true);

file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
$replyToken = $deCode['events'][0]['replyToken'];
$userId = $deCode['events'][0]['source']['userId'];
$IDmember = isset($deCode['events'][0]['message']['text']) ? $deCode['events'][0]['message']['text'] : '';
$bnrdata = query_data("SELECT * FROM borrowandreturn WHERE Member='$IDmember'");
$lineidneed = query_data("SELECT * FROM userstatus WHERE User_ID='$IDmember'");
$checklineid = query_data("SELECT * FROM userstatus WHERE lineuserId='$userId'");
$idexist = $checklineid[0]['User_ID'];
$userneed = query_data("SELECT * FROM userstatus u left JOIN permission p ON u.status = p.Per_ID LEFT JOIN (SELECT ID, Username, FName, LName FROM librarian UNION SELECT ID, Username, FName, LName FROM member) AS result ON u.User_ID = result.ID WHERE u.User_ID='$IDmember'");
$userexist = query_data("SELECT * FROM userstatus u left JOIN permission p ON u.status = p.Per_ID LEFT JOIN (SELECT ID, Username, FName, LName FROM librarian UNION SELECT ID, Username, FName, LName FROM member) AS result ON u.User_ID = result.ID WHERE u.User_ID='$idexist'");
$date_now = date('Y-m-d');
// $date_now = date('2019-08-28');
if ((isset($_GET['alert']) && ($_GET['alert'] == 'RESERVATION'))) {
    $getidline = query_data("SELECT * FROM userstatus WHERE lineuserid != '' AND lineuserid IS NOT NULL");
    foreach ($getidline as $lineuser) {
        $detailmsg = "หนังสือที่คุณจองสามารถยืมได้แล้ว ดังนี้ \n";
        $getmemid = $lineuser['User_ID'];
        $getineid = $lineuser['lineuserId'];
        $dataresev = query_data("SELECT * FROM reservations WHERE Receive = '$date_now' AND Member = '$getmemid' AND IsDeleteorCancel = 0");
        foreach ($dataresev as $book) {
            $detailmsg .= gettitlebook($book['Book']) . " จองเมื่อ ";
            $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $book['Date_Reserv']);
            $detailmsg .= $datetime->format('d/m/Y') . " \n";
        }
        $detailmsg .= "**สามารถเข้ามายืมหนังสือได้วันนี้ ที่ห้องสมุดRMUTL**";
        if (count($dataresev)) {
            sentpushmsg($getineid, $detailmsg);
        }
    }
}
if ((isset($_GET['alert']) && ($_GET['alert'] == 'ON'))) {
    $getidline = query_data("SELECT * FROM userstatus WHERE lineuserid != '' AND lineuserid IS NOT NULL");
    foreach ($getidline as $lineuser) {
        $detailmsg = "คุณมีหนังสือที่ต้องคืน: \n";
        $getmemid = $lineuser['User_ID'];
        $getineid = $lineuser['lineuserId'];
        $databnr = query_data("SELECT * FROM borrowandreturn WHERE Returns <= '$date_now' AND Member = '$getmemid'");
        foreach ($databnr as $book) {
            $detailmsg .= gettitlebook($book['Book']) . " กำหนดส่ง ";
            $detailmsg .= convert_datethai_monthdot($book['Returns']) . " \n";
        }
        if (count($databnr)) {
            sentpushmsg($getineid, $detailmsg);
        }
    }
}
if ($IDmember != '') {
    if (count($userneed)) {
        if (count($checklineid) && ($checklineid[0]['lineuserId'] == $userId)) { //////////case ไลน์ไอดีนี้ ได้ผูกบัญชีไว้แล้ว ////////
            $msg = "บัญชีไลน์ของคุณได้ผูกกับ " . $userexist[0]['FName'] . " " . $userexist[0]['LName'] . " ไปแล้ว";
            $bookexist = query_data("SELECT * FROM borrowandreturn WHERE Member='$idexist'");
            $detailmsg = " คุณมีหนังสือที่ต้องคืน: \n";
            foreach ($bookexist as $book) {
                $detailmsg .= gettitlebook($book['Book']) . " กำหนดส่ง ";
                $detailmsg .= convert_datethai_monthdot($book['Returns']) . ",\n";
            }
            sentreplymsg($replyToken, $msg);
            sentpushmsg($userId, $detailmsg);
        } elseif (count($lineidneed) && ($lineidneed[0]['lineuserId'] != '')) { ///////////// case รหัสประจำตัวที่ลงทะเบียนมา มีการผูกไว้อยู่แล้ว ///////////////
            $msg = "รหัสประจำตัวนี้ได้ผูกกับบัญชีไลน์อื่นไปแล้ว";
            sentreplymsg($replyToken, $msg);
        } else { ////////////ลงทะเบียนผูกบัญชีใหม่/////////////
            if ($conn->query("UPDATE userstatus SET lineuserId = '$userId' WHERE User_ID = '$IDmember';") === true) {
                $msg = "ผูกกับบัญชี " . $userneed[0]['FName'] . " " . $userneed[0]['LName'] . " สำเร็จ!" . $detailmsg;
                $bookneed = query_data("SELECT * FROM borrowandreturn WHERE Member='$IDmember'");
                $detailmsg = " คุณมีหนังสือที่ต้องคืน: \n";
                foreach ($bookneed as $book) {
                    $detailmsg .= gettitlebook($book['Book']) . " กำหนดส่ง ";
                    $detailmsg .= convert_datethai_monthdot($book['Returns']) . ",\n";
                }
                sentreplymsg($replyToken, $msg);
                sentpushmsg($userId, $detailmsg);
            } else {
                $msg = "เกิดข้อผิดพลาดกรุณาติดต่อห้องสมุดโดยตรงค่ะ";
                sentreplymsg($replyToken, $msg);
            }
        }
    } else {
        $msg = "ไม่พบข้อมูล";
        sentreplymsg($replyToken, $msg);
    }
}
/*Return HTTP Request 200*/
http_response_code(200);
function query_data($sql)
{
    global $conn;
    $getdata = mysqli_query($conn, $sql);
    $data = array();
    if (mysqli_num_rows($getdata) != 0) {
        while ($row = mysqli_fetch_assoc($getdata)) {
            array_push($data, $row);
        }
    }
    return $data;
}
function sentpushmsg($id, $msg)
{
    $messages['to'] = $id;
    $messages['messages'][0] = getFormatTextMessage("$msg");

    $encodeJson = json_encode($messages);

    $LINEDatas['url'] = "https://api.line.me/v2/bot/message/push";
    $LINEDatas['token'] = "JEDAQXE2AIw/S54oea99RDa6wtDX/bfnt1AEszrMe5j0WX+ddti39yFyk5TXpIb1gli19DzwzmZh8YBzWD9iv1wdVT76Q/5WU26mj/IqSVeRSpaDdUnUaPQ7zlD5RQWHTy2TX0fSoialqGSorZ69mAdB04t89/1O/w1cDnyilFU=";

    $results = sentMessage($encodeJson, $LINEDatas);
    return $results;
}
function sentreplymsg($replyToken, $msg)
{
    $messages = [];
    $messages['replyToken'] = $replyToken;
    $messages['messages'][0] = getFormatTextMessage("$msg");

    $encodeJson = json_encode($messages);

    $LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
    $LINEDatas['token'] = "JEDAQXE2AIw/S54oea99RDa6wtDX/bfnt1AEszrMe5j0WX+ddti39yFyk5TXpIb1gli19DzwzmZh8YBzWD9iv1wdVT76Q/5WU26mj/IqSVeRSpaDdUnUaPQ7zlD5RQWHTy2TX0fSoialqGSorZ69mAdB04t89/1O/w1cDnyilFU=";

    $results = sentMessage($encodeJson, $LINEDatas);
    return $results;
}
function getFormatTextMessage($text)
{
    $datas = [];
    $datas['type'] = 'text';
    $datas['text'] = $text;

    return $datas;
}

function sentMessage($encodeJson, $datas)
{
    $datasReturn = [];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $datas['url'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $encodeJson,
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer " . $datas['token'],
            "cache-control: no-cache",
            "content-type: application/json; charset=UTF-8",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        $datasReturn['result'] = 'E';
        $datasReturn['message'] = $err;
    } else {
        if ($response == "{}") {
            $datasReturn['result'] = 'S';
            $datasReturn['message'] = 'Success';
        } else {
            $datasReturn['result'] = 'E';
            $datasReturn['message'] = $response;
        }
    }

    return $datasReturn;
}
