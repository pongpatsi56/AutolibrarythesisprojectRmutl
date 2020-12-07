<?php
require_once "../include/connect.php";
require_once "../helper/datehelper.php";
require_once "../helper/calsubfield.php";
date_default_timezone_set('asia/bangkok');
/*Get Data From POST Http Request*/
$datas = file_get_contents('php://input');
/*Decode Json From LINE Data Body*/
$deCode = json_decode($datas, true);

file_put_contents('log_reply.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
$replyToken = $deCode['events'][0]['replyToken'];
$userId = $deCode['events'][0]['source']['userId'];
$GetMsg = isset($deCode['events'][0]['message']['text']) ? $deCode['events'][0]['message']['text'] : '';
$GetIdconfirm = isset($deCode['events'][0]['postback']['data']) ? $deCode['events'][0]['postback']['data'] : '';
/////////find member exist ///////
$lineidneed = query_data("SELECT * FROM userstatus WHERE User_ID='$GetMsg'");
$checklineid = query_data("SELECT * FROM userstatus WHERE lineuserId='$userId'");
$idexist = isset($checklineid[0]['User_ID']) ? $checklineid[0]['User_ID'] : '';
$userneed = query_data("SELECT * FROM userstatus u left JOIN permission p ON u.status = p.Per_ID LEFT JOIN (SELECT ID, Username, FName, LName FROM librarian UNION SELECT ID, Username, FName, LName FROM member) AS result ON u.User_ID = result.ID WHERE u.User_ID='$GetMsg'");
$userexist = query_data("SELECT * FROM userstatus u left JOIN permission p ON u.status = p.Per_ID LEFT JOIN (SELECT ID, Username, FName, LName FROM librarian UNION SELECT ID, Username, FName, LName FROM member) AS result ON u.User_ID = result.ID WHERE u.User_ID='$idexist'");
$date_now = date('Y-m-d');
// $date_now = date('2019-08-28');
if ((isset($_GET['alert']) && ($_GET['alert'] == 'RESERVATION'))) {
    $getidline = query_data("SELECT * FROM userstatus WHERE lineuserid != '' AND lineuserid IS NOT NULL");
    foreach ($getidline as $lineuser) {
        $getmemid = $lineuser['User_ID'];
        $getineid = $lineuser['lineuserId'];
        $dataresev = query_data("SELECT * FROM reservations WHERE Receive = '$date_now' AND Member = '$getmemid' AND IsDeleteorCancel = 0");
        $bookjson = [];
        foreach ($dataresev as $book) {
            $date_re = date_create($book['Date_Reserv']);
            $bookjsonarr = array(
                "type" => "box",
                "layout" => "baseline",
                "contents" => array(
                    array(
                        "type" => "text",
                        "text" => date_format($date_re, "d/m/Y"),
                        "flex" => 0,
                        "margin" => "sm",
                        "size" => "xs",
                        "weight" => "bold"
                    ),
                    array(
                        "type" => "text",
                        "text" => gettitlebook($book['Book']),
                        "margin" => "md",
                        "size" => "xs",
                        "align" => "start",
                        "color" => "#5D5D5D"
                    )
                )
            );
            array_push($bookjson, $bookjsonarr);
        }
        if (count($dataresev)) {
            pushbubblereserve($getineid, $bookjson);
        }
    }
}
if ((isset($_GET['alert']) && ($_GET['alert'] == 'ON'))) {
    $getidline = query_data("SELECT * FROM userstatus WHERE lineuserid != '' AND lineuserid IS NOT NULL");
    foreach ($getidline as $lineuser) {
        $getmemid = $lineuser['User_ID'];
        $getineid = $lineuser['lineuserId'];
        ///////////////////////borrowandreturn////////////////////////////
        $databnr = query_data("SELECT * FROM borrowandreturn WHERE Returns <= '$date_now' AND Due = '0000-00-00' AND Member = '$getmemid'");
        $bookbnrjson = [];
        foreach ($databnr as $book) {
            $date_re = date_create($book['Returns']);
            $danger = $book['Returns'] < $date_now ? '#C22F2B' : '#333333';
            $bookjsonarr = array(
                "type" => "box",
                "layout" => "baseline",
                "contents" => array(
                    array(
                        "type" => "text",
                        "text" => date_format($date_re, "d/m/Y"),
                        "flex" => 0,
                        "margin" => "sm",
                        "size" => "xs",
                        "weight" => "bold",
                        "color" => "$danger"
                    ),
                    array(
                        "type" => "text",
                        "text" => gettitlebook($book['Book']),
                        "margin" => "md",
                        "size" => "xs",
                        "align" => "start",
                        "color" => "#5D5D5D"
                    )
                )
            );
            array_push($bookbnrjson, $bookjsonarr);
        }
        if (count($databnr)) {
            pushbubblebnr($getineid, $bookbnrjson);
        }
        ///////////////////////reservation////////////////////////////
        $dataresev = query_data("SELECT * FROM reservations WHERE Receive = '$date_now' AND Member = '$getmemid' AND IsDeleteorCancel = 0");
        $bookrsvjson = [];
        foreach ($dataresev as $book) {
            $date_re = date_create($book['Date_Reserv']);
            $bookjsonarr = array(
                "type" => "box",
                "layout" => "baseline",
                "contents" => array(
                    array(
                        "type" => "text",
                        "text" => date_format($date_re, "d/m/Y"),
                        "flex" => 0,
                        "margin" => "sm",
                        "size" => "xs",
                        "weight" => "bold"
                    ),
                    array(
                        "type" => "text",
                        "text" => gettitlebook($book['Book']),
                        "margin" => "md",
                        "size" => "xs",
                        "align" => "start",
                        "color" => "#5D5D5D"
                    )
                )
            );
            array_push($bookrsvjson, $bookjsonarr);
        }
        if (count($dataresev)) {
            $conn->query("UPDATE 'reservations' SET 'IsDeleteorCancel' = '1' WHERE Receive = '$date_now';");
            pushbubblereserve($getineid, $bookrsvjson);
        }
    }
}
if ((isset($GetMsg) && ($GetMsg == '"Register"'))) {
    if (count($checklineid) && ($checklineid[0]['lineuserId'] == $userId)) {
        $msg = "บัญชีไลน์ของคุณได้ผูกกับ " . $userexist[0]['FName'] . " " . $userexist[0]['LName'] . " ไปแล้ว";
    } elseif (count($lineidneed) && ($lineidneed[0]['lineuserId'] != '')) {
        $msg = "รหัสประจำตัวนี้ได้ผูกกับบัญชีไลน์อื่นไปแล้ว";
    } else {
        $msg = "พิมพ์รหัสประจำตัวที่ต้องการลงทะเบียนแล้วกดส่ง \n (รูปแบบ 12345678912-9)";
    }
    sentreplymsg($replyToken, $msg);
}
if ((isset($GetIdconfirm) && ($GetMsg == 'sss'))) {
    $idnum = "56543206025-1";
    $idname = "Phongphat Singlek";
    replyconfirm($replyToken, $idnum, $idname);
}
// if ((isset($GetMsg) && ($GetMsg == '"Show List"'))) {
//     $msg = "พิมพ์รหัสประจำตัวที่ต้องการลงทะเบียนแล้วกดส่ง";
//     sentreplymsg($replyToken, $msg);
// }
if ((isset($GetMsg) && ($GetMsg == '"Show List"'))) {
    $bookexist = query_data("SELECT * FROM borrowandreturn WHERE Member='$idexist' AND Due = '0000-00-00'");
    if (count($bookexist)) {
        $bookjson = [];
        foreach ($bookexist as $book) {
            $date_re = date_create($book['Returns']);
            $danger = $book['Returns'] < $date_now ? '#C22F2B' : '#333333';
            $bookjsonarr = array(
                "type" => "box",
                "layout" => "baseline",
                "contents" => array(
                    array(
                        "type" => "text",
                        "text" => date_format($date_re, "d/m/Y"),
                        "flex" => 0,
                        "margin" => "sm",
                        "size" => "xs",
                        "weight" => "bold",
                        "color" => "$danger"
                    ),
                    array(
                        "type" => "text",
                        "text" => gettitlebook($book['Book']),
                        "margin" => "md",
                        "size" => "xs",
                        "align" => "start",
                        "color" => "#5D5D5D"
                    )
                )
            );
            array_push($bookjson, $bookjsonarr);
        }
        replybubblemsg($replyToken, $bookjson);
    } else {
        sentreplymsg($replyToken, "ไม่พบข้อมูลทรัพยากร");
    }
}

if (count($userneed)) {
    if (count($checklineid) && ($checklineid[0]['lineuserId'] == $userId)) { //////////case ไลน์ไอดีนี้ ได้ผูกบัญชีไว้แล้ว ////////
        $msg = "บัญชีไลน์ของคุณได้ผูกกับ " . $userexist[0]['FName'] . " " . $userexist[0]['LName'] . " ไปแล้ว";
        sentreplymsg($replyToken, $msg);
        // sentpushmsg($userId, $detailmsg);
    } elseif (count($lineidneed) && ($lineidneed[0]['lineuserId'] != '')) { ///////////// case รหัสประจำตัวที่ลงทะเบียนมา มีการผูกไว้อยู่แล้ว ///////////////
        $msg = "รหัสประจำตัวนี้ได้ผูกกับบัญชีไลน์อื่นไปแล้ว";
        sentreplymsg($replyToken, $msg);
    } else { ////////////ลงทะเบียนผูกบัญชีใหม่/////////////
        if ($conn->query("UPDATE userstatus SET lineuserId = '$userId' WHERE User_ID = '$GetMsg';") === true) {
            $msg = "ผูกกับบัญชี " . $userneed[0]['FName'] . " " . $userneed[0]['LName'] . " สำเร็จ!";
            sentreplymsg($replyToken, $msg);
        } else {
            $msg = "เกิดข้อผิดพลาดกรุณาติดต่อห้องสมุดโดยตรงค่ะ";
            sentreplymsg($replyToken, $msg);
        }
    }
} else {
    $msg = "ไม่พบข้อมูล";
    sentreplymsg($replyToken, $msg);
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
function pushbubblereserve($id, $bodyrendor)
{
    $jsonobj = json_decode('{
        "type": "flex",
        "altText": "คุณมีหนังสือที่จองไว้",
        "contents": {
          "type": "bubble",
          "body": {
            "type": "box",
            "layout": "vertical",
            "spacing": "md",
            "contents": [
              {
                "type": "text",
                "text": "รายการจอง",
                "size": "md",
                "weight": "bold"
              },
              {
                "type": "box",
                "layout": "baseline",
                "contents": [
                  {
                    "type": "text",
                    "text": "จองเมื่อ",
                    "flex": 0,
                    "margin": "sm",
                    "size": "xxs",
                    "color": "#5D5D5D"
                  },
                  {
                    "type": "text",
                    "text": "  ชื่อหนังสือ",
                    "margin": "xxl",
                    "size": "xxs",
                    "align": "center",
                    "color": "#5D5D5D"
                  }
                ]
              },
              {
                "type": "box",
                "layout": "vertical",
                "spacing": "sm",
                "contents": []
              },
              {
                "type": "text",
                "text": "**สามารถเข้ามายืมหนังสือได้วันนี้ ที่ห้องสมุดRMUTL**",
                "size": "xxs",
                "color": "#AAAAAA",
                "wrap": true
              }
            ]
          }
        }
      }', true);
    $jsonobj['contents']['body']['contents'][2]['contents'] = $bodyrendor;

    $messages['to'] = $id;
    $messages['messages'][0] = $jsonobj;

    $encodeJson = json_encode($messages);

    $LINEDatas['url'] = "https://api.line.me/v2/bot/message/push";
    $LINEDatas['token'] = "JEDAQXE2AIw/S54oea99RDa6wtDX/bfnt1AEszrMe5j0WX+ddti39yFyk5TXpIb1gli19DzwzmZh8YBzWD9iv1wdVT76Q/5WU26mj/IqSVeRSpaDdUnUaPQ7zlD5RQWHTy2TX0fSoialqGSorZ69mAdB04t89/1O/w1cDnyilFU=";

    $results = sentMessage($encodeJson, $LINEDatas);
    return $results;
}
function pushbubblebnr($id, $bodyrendor)
{
    $jsonobj = json_decode('{
        "type": "flex",
        "altText": "คุณมีหนังสือที่ต้องคืน",
        "contents": {
          "type": "bubble",
          "body": {
            "type": "box",
            "layout": "vertical",
            "spacing": "md",
            "contents": [
              {
                "type": "text",
                "text": "หนังสือที่ต้องคืน",
                "size": "md",
                "weight": "bold"
              },
              {
                "type": "box",
                "layout": "baseline",
                "contents": [
                  {
                    "type": "text",
                    "text": "กำหนดคืน",
                    "flex": 0,
                    "margin": "sm",
                    "size": "xxs",
                    "color": "#5D5D5D"
                  },
                  {
                    "type": "text",
                    "text": "  ชื่อหนังสือ",
                    "margin": "xxl",
                    "size": "xxs",
                    "align": "center",
                    "color": "#5D5D5D"
                  }
                ]
              },
              {
                "type": "box",
                "layout": "vertical",
                "spacing": "sm",
                "contents": []
              },
              {
                "type": "text",
                "text": "งานห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา",
                "size": "xxs",
                "color": "#AAAAAA",
                "wrap": true
              }
            ]
          }
        }
      }', true);
    $jsonobj['contents']['body']['contents'][2]['contents'] = $bodyrendor;

    $messages['to'] = $id;
    $messages['messages'][0] = $jsonobj;

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
function replyconfirm($replyToken, $idmem, $idname)
{
    $datas = array(
        "type" => "template",
        "altText" => "this is a confirm template",
        "template" => array(
            "type" => "confirm",
            "actions" => array(
                array(
                    "type" => "postback",
                    "label" => "Yes",
                    "data" => $idmem
                ),
                array(
                    "type" => "message",
                    "label" => "No",
                    "text" => "\"No\""
                ),
            ),
            "text" => "ผูกกับ:" . $idname
        )
    );
    $messages = [];
    $messages['replyToken'] = $replyToken;
    $messages['messages'][0] = $datas;

    $encodeJson = json_encode($messages);

    $LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
    $LINEDatas['token'] = "JEDAQXE2AIw/S54oea99RDa6wtDX/bfnt1AEszrMe5j0WX+ddti39yFyk5TXpIb1gli19DzwzmZh8YBzWD9iv1wdVT76Q/5WU26mj/IqSVeRSpaDdUnUaPQ7zlD5RQWHTy2TX0fSoialqGSorZ69mAdB04t89/1O/w1cDnyilFU=";

    $results = sentMessage($encodeJson, $LINEDatas);
    return $results;
}
function replybubblemsg($replyToken, $bodyrendor)
{
    $jsonobj = json_decode('{
        "type": "flex",
        "altText": "คุณมีหนังสือที่ต้องคืน",
        "contents": {
          "type": "bubble",
          "body": {
            "type": "box",
            "layout": "vertical",
            "spacing": "md",
            "contents": [
              {
                "type": "text",
                "text": "หนังสือที่ต้องคืน",
                "size": "md",
                "weight": "bold"
              },
              {
                "type": "box",
                "layout": "baseline",
                "contents": [
                  {
                    "type": "text",
                    "text": "กำหนดคืน",
                    "flex": 0,
                    "margin": "sm",
                    "size": "xxs",
                    "color": "#5D5D5D"
                  },
                  {
                    "type": "text",
                    "text": "  ชื่อหนังสือ",
                    "margin": "xxl",
                    "size": "xxs",
                    "align": "center",
                    "color": "#5D5D5D"
                  }
                ]
              },
              {
                "type": "box",
                "layout": "vertical",
                "spacing": "sm",
                "contents": []
              },
              {
                "type": "text",
                "text": "งานห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา",
                "size": "xxs",
                "color": "#AAAAAA",
                "wrap": true
              }
            ]
          }
        }
      }', true);
    $jsonobj['contents']['body']['contents'][2]['contents'] = $bodyrendor;

    $messages = [];
    $messages['replyToken'] = $replyToken;
    $messages['messages'][0] = $jsonobj;

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
