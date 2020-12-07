<?php

session_start();

$_count_cart = (isset($_SESSION['BC_Cart']) ? count($_SESSION['BC_Cart']) : 0);

include $_SERVER['DOCUMENT_ROOT'] . '/lib/include/connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/lib/layout/head.php';
include $_SERVER['DOCUMENT_ROOT'] . '/lib/helper/calsubfield.php';
include $_SERVER['DOCUMENT_ROOT'] . '/lib/helper/datehelper.php';

date_default_timezone_set('asia/bangkok');
function spec_field($type)
{
    switch ($type) {
        case 'ISBNISSN':
            return 'Field = 020 AND';
            break;
        case 'AUTHOR':
            return 'Field = 100 AND';
            break;
        case 'TITLE':
            return 'Field = 245 AND';
            break;
        case 'SUBJECT':
            return 'Field = 650 AND';
            break;
        case 'PUBLISHER':
            return 'Field = 260 AND';
            break;
        case 'LOCATION':
            return 'Field = 951 AND';
            break;
        case 'ALT':
            return 'Field = 400 AND';
            break;
        default:
            return '';
            break;
    }
}
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
/////basic/////
$getNtk = $_GET['Ntk']; //ตัวกรอง
$getNtt = $_GET['Ntt']; //คำค้น
/////advance/////
if (isset($_GET['Stype'])) {
    $getStype = $_GET['Stype']; //ประเภทแหล่งที่มา	
    $getLocal = isset($_GET['Local']) ? $_GET['Local'] : ''; //สาขาห้องสมุด
    $getYrst = isset($_GET['Yrst']) ? $_GET['Yrst'] : ''; //ปีที่เริ่ม	
    $getYren = isset($_GET['Yren']) ? $_GET['Yren'] : ''; //ปีที่สิ้นสุด

    // $fdata = array();
    // $yearsql = "SELECT * FROM (SELECT *,substring_index(Subfield,'#c=',-1) AS years FROM databib WHERE Field = 260) AS subquery WHERE years BETWEEN '$getYrst' AND '$getYren'";
    // $ydata = querydata($yearsql);
    // $localsql = "SELECT * FROM databib WHERE Field = 951 AND Subfield LIKE '%$getLocal%'";
    // $localdata = querydata($localsql);

    // if (count($ydata) && count($localdata)) {
    //     foreach ($ydata as $yrun => $yval) {
    //         foreach ($localdata as $lrun => $lval) {
    //             if ($yrun == $lrun) {
    //                 array_push($fdata, $lval);
    //             }
    //         }
    //     }
    // }

    $advquery = "SELECT * FROM (SELECT a.Bib_ID, substring_index(a.Subfield,'#c=',-1) AS years
    FROM databib LEFT JOIN databib_item ON databib.Bib_ID = databib_item.Bib_ID
    WHERE (Field = 260) AND (Field = 951 AND Subfield LIKE '%$getLocal%') AND (" . spec_field($getNtk) . " Subfield LIKE '%$getNtt%') ) AS subquery
    WHERE years BETWEEN '$getYrst' AND '$getYren' GROUP BY Bib_ID ";
    // $data = querydata($advquery);
} else {
    $sql = " SELECT * FROM databib  WHERE " . spec_field($getNtk) . " Subfield LIKE '%$getNtt%' ";
    // $data = querydata($sql);
    $data = $conn->query($sql);
    if (mysqli_num_rows($data)!=0) {
        $stack = "(";
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_fetch[$i] = $data->fetch_assoc();
        }
        for ($i=0; $i < count($data_fetch) ; $i++) { 
            $stack .= "'{$data_fetch[$i]['Bib_ID']}',";
        }
        $stack = substr($stack,0,strlen($stack)-1).")";
        $sql = " SELECT * FROM databib WHERE Bib_ID IN $stack ";
        // echo $sql;
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
            $data_fetch2[$i] = $data->fetch_assoc();
        }
        for ($i=0; $i < count($data_fetch2) ; $i++) { 
            $data_res[$data_fetch2[$i]['Bib_ID']][$data_fetch2[$i]['Field']] = ['inc1' => $data_fetch2[$i]['Indicator1'],'inc2' => $data_fetch2[$i]['Indicator2'],'sub' => $data_fetch2[$i]['Subfield']];
        }
    }
    
    
}

$autdata = isset($data_res) ? count_same($data_res, 'Author', '#a') : '';
$tidata = isset($data_res) ? count_same($data_res, 'Title', '#a') : '';
$yerdata = isset($data_res) ? count_same($data_res, 'Publication', '#c') : '';
$subjectdata = isset($data_res) ? count_same($data_res, 'Subject', '#a') : '';
$locatedata = isset($data_res) ? count_same($data_res, 'Location', '#a') : '';


// exit;
/////// pagination //////////
$getURL = explode("&nPage=", "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");


$Num_Rows = isset($data_res) ? count($data_res) : null;
$Per_Page = $_GET['perPage'];
$Page = $_GET["nPage"];
$paginate = "&nPage=" . '1' . "&perPage=" . $Per_Page;
if (!$_GET["nPage"]) {
    $Page = 1;
}

$Prev_Page = $Page - 1;
$Next_Page = $Page + 1;

$Page_Start = (($Per_Page * $Page) - $Per_Page);
// $pagi_sql = "SELECT * FROM databib  WHERE " . spec_field($getNtk) . " Subfield LIKE '%$getNtt%' ";

// $res_pagi_sql = querydata($pagi_sql);
// $data = $conn->query($pagi_sql);
//     if (mysqli_num_rows($data)!=0) {
//         for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
//             $res_pagi_sql[$i] = $data->fetch_assoc();
//         }
//     }

if ($Num_Rows <= $Per_Page) {
    $Num_Pages = 1;
} else if (($Num_Rows % $Per_Page) == 0) {
    $Num_Pages = ($Num_Rows / $Per_Page);
} else {
    $Num_Pages = ($Num_Rows / $Per_Page) + 1;
    $Num_Pages = (int) $Num_Pages;
}
/////////////////////////////
?>
    <link href="../../css/site.css" rel="stylesheet" type="text/css" />
    <link href="../../css/style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .lds-ring {
            display: inline-block;
            position: relative;
            width: 0px;
            height: 0px;
            margin: -25px;
        }

        .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 23px;
            height: 23px;
            /* margin: 20px; */
            margin-left: 95px;
            margin-top: 20px;
            border: 5px solid #989898;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: #989898 transparent transparent transparent;
        }

        .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
        }

        .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
        }

        .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }

        @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .pagination-wrapper {
            /* text-align: center; */
            /* margin: 40px 0; */
        }

        .pagination {
            display: inline-block;
            /* height: 70px; */
            /* margin-top: 70px; */
            padding: 0 25px;
            border-radius: 35px;
            background-color: #eee;
        }

        @media only screen and (max-width: 1199px) {
            .pagination {
                /* height: 50px; */
                margin-top: 50px;
                padding: 0 10px;
                border-radius: 25px;
            }
        }

        .page-numbers {
            display: block;
            padding: 0 15px;
            float: left;
            transition: 400ms ease;
            color: #595959;
            font-size: 12px;
            letter-spacing: 0.1em;
            line-height: 20px;
        }

        .page-numbers:hover,
        .page-numbers.current {
            background-color: #b97e3a;
            color: #fff;
        }

        .page-numbers.prev:hover,
        .page-numbers.next:hover {
            background-color: transparent;
            color: #b97e3a;
        }

        @media only screen and (max-width: 1199px) {
            .page-numbers {
                padding: 0 15px;
                font-size: 12px;
                line-height: 20px;
            }
        }

        @media only screen and (min-width: 120px) and (max-width: 1024px) {
            .page-numbers {
                padding: 0 14px;
                display: none;
            }

            .page-numbers:nth-of-type(2) {
                position: relative;
                padding-right: 50px;
            }

            .page-numbers:nth-of-type(2)::after {
                content: '...';
                position: absolute;
                font-size: 12px;
                top: 0;
                left: 45px;
            }

            .page-numbers:nth-child(-n+3),
            .page-numbers:nth-last-child(-n+3) {
                display: block;
            }

            .page-numbers:nth-last-child(-n+4) {
                padding-right: 14px;
            }

            .page-numbers:nth-last-child(-n+4)::after {
                content: none;
            }
        }
    </style>

    <body>

        <section class="container main-container">
            <div class="row" style="padding-bottom: 10px; background-color: #FFFFFF;">

                <!-- <div class="row">
        <img src="https://webs.rmutl.ac.th/assets/upload/logo/website_logo_th_20170905132018.jpg" alt="โลโก้เว็บไซต์ ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" class="img-responsive" />
    </div> -->

                <!-- Modal -->
                <div class="modal fade modal1" id="login-showmodal" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div>
                                    <span style="display:none" class="lds-ring">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </span>
                                    <h3 align="center"><span class='fas fa-user'> </span> RMUTL </h3>
                                </div>
                            </div>
                            <div class="modal-body">
                                <form name="formlogin" action="" method="POST" id="login" class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="username" id="username" class="form-control" name="username" placeholder="Username" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="password" id='password' class="form-control" name="password" placeholder="Password" required>
                                        </div>
                                        <span align="center" class="text-danger col-sm-12" id="valid">กรุณาล็อคอินก่อนใช้งาน</span>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input style="width:100%;" type="button" class="btn btn-primary" id="btn-modal-login" value="Login">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <center>
                                    <p align="center"> หากไม่สามารถเข้าใช้งานได้<br>กรุณาติดต่อเจ้าหน้าที่บริการ</p>
                            </div>
                        </div>
                    </div>
                    <!-------endModal------>
                </div>
                <!-- main menu -->
                <div id="warpper">
                    <div class="subnavigate">
                        <div class="ct">
                            <!-- navigative -->
                            
                            <!-- search box -->
                            <div class="right">
                                <div id="searchwrapper2">
                                    <form>
                                        <!-- <input type="checkbox" name=""> -->
                                        <!-- <FONT Size="2" color="#FFFFFF" style="font-family:kanit; " >สืบค้นจากผลลัพธ์</FONT> -->
                                        <input name="text_resurce" id="text_resurce" type="text" value="<?php echo $getNtt ?>" class="btn btn-white" style="padding:unset;border:1px solid darkgray;font-family:kanit; ">
                                        &nbsp;
                                        <span style="display:none;"></span>
                                        <select name="type_resource" id="type_resource" class="btn btn-white" style="padding:unset; border:1px solid darkgray;font-family:kanit;">
                                            <option value="KEYWORD" <?= (isset($_GET['Ntk']) && $_GET['Ntk'] == "KEYWORD") ? " selected" : "" ?>>ทั้งหมด</option>
                                            <option value="TITLE" <?= (isset($_GET['Ntk']) && $_GET['Ntk'] == "TITLE") ? " selected" : "" ?>>ชื่อเรื่อง</option>
                                            <option value="AUTHOR" <?= (isset($_GET['Ntk']) && $_GET['Ntk'] == "AUTHOR") ? " selected" : "" ?>>ชื่อผู้แต่ง</option>
                                            <!-- <option value="SUBJECT"<?= (isset($_GET['Ntk']) && $_GET['Ntk'] == "SUBJECT") ? " selected" : "" ?>>หัวเรื่อง</option> -->
                                            <!-- <option value="TAGS"<?= (isset($_GET['Ntk']) && $_GET['Ntk'] == "TAGS") ? " selected" : "" ?>>แท็ก</option> -->
                                            <option value="ISBNISSN" <?= (isset($_GET['Ntk']) && $_GET['Ntk'] == "ISBNISSN") ? " selected" : "" ?>>ISBN/ISSN</option>
                                            <!-- <option value="PUBLISHER"<?= (isset($_GET['Ntk']) && $_GET['Ntk'] == "PUBLISHER") ? " selected" : "" ?>>สำนักพิมพ์</option> -->
                                            <!-- <option value="JOURNALTITLE"<?= (isset($_GET['Ntk']) && $_GET['Ntk'] == "JOURNALTITLE") ? " selected" : "" ?>>ชื่อวารสาร</option>                             -->
                                        </select>
                                        &nbsp;<input type="button" id="btnsearch" onclick="Basic_go()" value="สืบค้น" title="สืบค้น" class="btn btn-info" style="padding: 1px 6px;font-size: 14px;border: 0.5px;font-family:kanit; ">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="sidebar">
                    <div class="box-facet">
                        <div class="box-facet-hearder">คำค้น</div>
                        <div class="box-facet-body-KeyWord">
                            <span><b>
                                    <?php
                                    if (isset($_GET['Ntk']) && $_GET['Ntk'] == "KEYWORD") {
                                        echo "ทั้งหมด";
                                    } elseif ($_GET['Ntk'] == "TITLE") {
                                        echo "ชื่อเรื่อง";
                                    } elseif ($_GET['Ntk'] == "AUTHOR") {
                                        echo "ชื่อผู้แต่ง";
                                    } elseif ($_GET['Ntk'] == "ISBNISSN") {
                                        echo "ISBN/ISSN";
                                    } elseif ($_GET['Ntk'] == "Year") {
                                        echo "ปีพิมพ์";
                                    } elseif ($_GET['Ntk'] == "type") {
                                        echo "ประเภทแหล่งที่มา";
                                    } else {
                                        echo "Unknow Type";
                                    }
                                    ?></b><br></span>
                            <a href="../../search.php">
                                <hk><?= (isset($_GET['Ntt'])) ? $getNtt : "" ?>
                                    &times;
                                    <br></hk>
                            </a>
                        </div>
                    </div>
                    <div>
                        <?php if ($Num_Rows != 0 || $Num_Rows != null) { ?>
                            <div class="box-facet">
                                <div class="box-facet-hearder">ผู้แต่ง</div>
                                <div class="box-facet-body">
                                    <table cellspacing="0" cellpadding="0" rules="all" style="border-width:0px;border-style:None;width:100%;border-collapse:collapse;">
                                        <tbody><?php
                                            // echo '<pre>';
                                            // print_r($autdata);
                                            // echo '</pre>';

                                             foreach ($autdata as $key => $value) {
                                                    ?>
                                                <tr>
                                                    <td style="border-width:0px;border-style:None;">
                                                        <div class="box-facet-GridItemStyle">
                                                            <a href="Result.php?Ntk=AUTHOR&Ntt=<?= $key . $paginate ?>" style="font-size: 12px;"><?= $key . ' (' . $value . ')' ?></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="box-facet">
                                <div class="box-facet-hearder">หัวเรื่อง</div>
                                <div class="box-facet-body">
                                    <table cellspacing="0" cellpadding="0" rules="all" style="border-width:0px;border-style:None;width:100%;border-collapse:collapse;">
                                        <tbody>
                                            <?php
                                            // echo '<pre>';
                                            // print_r($subjectdata);
                                            // echo '</pre>';
                                            foreach ($subjectdata as $key => $value) {
                                                    ?>
                                                <tr>
                                                    <td style="border-width:0px;border-style:None;">
                                                        <div class="box-facet-GridItemStyle">
                                                            <a href="Result.php?Ntk=Subject&Ntt=<?= $key . $paginate ?>" style="font-size: 12px;"><?= $key . ' (' . $value . ')' ?></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="box-facet">
                                <div class="box-facet-hearder">ปีพิมพ์</div>
                                <div class="box-facet-body">
                                    <table cellspacing="0" cellpadding="0" rules="all" style="border-width:0px;border-style:None;width:100%;border-collapse:collapse;">
                                        <tbody>
                                            <?php foreach ($yerdata as $key => $value) {
                                                    ?>
                                                <tr>
                                                    <td style="border-width:0px;border-style:None;">
                                                        <div class="box-facet-GridItemStyle">
                                                            <a href="Result.php?Ntk=Year&Ntt=<?= $key . $paginate ?>" style="font-size: 12px;"><?= $key . ' (' . $value . ')' ?></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="box-facet">
                                <div class="box-facet-hearder">ประเภทแหล่งที่มา</div>
                                <div class="box-facet-body">
                                    <table cellspacing="0" cellpadding="0" rules="all" style="border-width:0px;border-style:None;width:100%;border-collapse:collapse;">
                                        <tbody>
                                            <?php foreach ($subjectdata as $key => $value) {
                                                    ?>
                                                <tr>
                                                    <td style="border-width:0px;border-style:None;">
                                                        <div class="box-facet-GridItemStyle">
                                                            <a href="Result.php?Ntk=type&Ntt=<?= $key . $paginate ?>" style="font-size: 12px;"><?= ($key == '' ? "ไม่ทราบแหล่งที่มา" : $key) . ' (' . $value . ')' ?></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="box-facet">
                                <div class="box-facet-hearder">สาขาห้องสมุด</div>
                                <div class="box-facet-body">
                                    <table cellspacing="0" cellpadding="0" rules="all" style="border-width:0px;border-style:None;width:100%;border-collapse:collapse;">
                                        <tbody>
                                            <?php foreach ($locatedata as $key => $value) {
                                                    ?>
                                                <tr>
                                                    <td style="border-width:0px;border-style:None;">
                                                        <div class="box-facet-GridItemStyle">
                                                            <a href="Result.php?Ntk=type&Ntt=<?= $key . $paginate ?>" style="font-size: 12px;"><?= $key . ' (' . $value . ')' ?></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- <form> -->
                <div id="content2">
                    <div id="cphContent_PFound">
                        <div style="display:block;margin-bottom:5px;">
                            <div class="section-title">Found
                                <span>:
                                    <a id="totalResult"><?= $Num_Rows ?></a>&nbsp;ชื่อเรื่อง
                                    <!-- </span>เรียงลำดับโดย
                        <span>: 
                            <select name="" id="" style="width:136px;">
                                <option selected="selected" value="RELEVANCE">Relevance</option>
                                <option value="TITLE">Title A-Z</option>
                                <option value="PUBYEAR DESC">Pub date (newest)</option>
                                <option value="PUBYEAR ASC">Pub date (oldest)</option>
                                <option value="AUTHOR">Author A-Z</option>
                                <option value="CALLNUMBER">Call Number</option>
                            </select> -->
                                </span>แสดง<span>:
                                    <select name="perPage" id="perPage" style="width:48px;">
                                        <option value="5" <?= (isset($_GET['perPage']) && $_GET['perPage'] == "5") ? " selected" : "" ?>>5</option>
                                        <option value="10" <?= (isset($_GET['perPage']) && $_GET['perPage'] == "10") ? " selected" : "" ?>>10</option>
                                        <option value="15" <?= (isset($_GET['perPage']) && $_GET['perPage'] == "15") ? " selected" : "" ?>>15</option>
                                        <option value="20" <?= (isset($_GET['perPage']) && $_GET['perPage'] == "20") ? " selected" : "" ?>>20</option>
                                        <option value="25" <?= (isset($_GET['perPage']) && $_GET['perPage'] == "25") ? " selected" : "" ?>>25</option>
                                        <option value="30" <?= (isset($_GET['perPage']) && $_GET['perPage'] == "30") ? " selected" : "" ?>>30</option>
                                    </select>&nbsp; ต่อหน้า</span>
                                <button style="float:right;font-size:11px;margin-top:-6 ;font-family:kanit;" type="button" id="cartmodal" data-toggle='modal' data-target='#modal-show'>รถเข็น
                                    <div class="badge"><?= $_count_cart ?></div>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade modal1" id="modal-show" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <img src="../../img/Cart-PNG-Clipart.png">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">รถเข็น</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php if (isset($_SESSION['BC_Cart']) && !empty($_SESSION['BC_Cart'])) {
                                                        ?>
                                                    <table id="mytable" align="center" border="0" bgcolor="#FFFFFF">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><center>
                                                                    ลำดับ
                                                                </th>
                                                                <th scope="col" class="bg-dark">
                                                                    ชื่อเรื่อง
                                                                </th scope="col" class="bg-success">
                                                                <th>
                                                                    ชื่อผู้แต่ง
                                                                </th>
                                                                <!-- <th>
                                                            สำนักพิมพ์
                                                        </th> -->
                                                                <th scope="col" class="bg-warning">
                                                                    สถานะการจอง
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                    $userid = isset($_SESSION['user_status']['ID']) ? $_SESSION['user_status']['ID'] : false;
                                                                    $no = 1;
                                                                    $postdata = array();
                                                                    $tmr_date = new DateTime('+1 day');
                                                                    $tmr_date = $tmr_date->format('Y-m-d');
                                                                    foreach ($_SESSION['BC_Cart'] as $iscart) {
                                                                        if ($iscart['reciv'] != '-') {
                                                                            $date_recv_send = date_create($iscart['reciv']);
                                                                            $date_recv_send = date_modify($date_recv_send, '+ 7days');
                                                                            $date_recv_send = date_format($date_recv_send, "Y-m-d");
                                                                            $date_recv = "<i class='text-danger'>" . "ยืมได้เมื่อ : " . convert_datethai_monthdot($date_recv_send) . "</i>";
                                                                            $iscart['reciv'] = $date_recv_send;
                                                                        } else {
                                                                            $date_recv = "<i class='fas fa-check-circle' style='color: 82c91e;'></i>";
                                                                            $iscart['reciv'] = $tmr_date;
                                                                        }

                                                                        ?>
                                                                <tr>
                                                                    <td width="60px"><center><?= $no ?></td>
                                                                    <td width="300px"><?= $iscart['title'] ?></td>
                                                                    <td width="150px"><?= $iscart['author'] ?></td>
                                                                    <td width="180px"><?= $date_recv ?></td>
                                                                    <td width="100px"><center><input type="button" class="btn btn-warning" onclick="Javascript:var r =confirm('ต้องการที่จะลบหรือไม่?');if(r){do_delcart('<?= $iscart['barcode'] ?>')}" value="ลบ"></td>
                                                                </tr>
                                                            <?php
                                                                        $no++;
                                                                        array_push($postdata, $iscart);
                                                                    }
                                                                    ?>
                                                        </tbody>
                                                    </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button style="float: left;" type="button" class="btn btn-success" data-dismiss="modal" onclick="do_confcart()">ยืนยัน</button>
                                                <button style="float: left;" type="button" class="btn btn-danger" data-dismiss="modal" onclick="<?= $_count_cart != 0 ? "do_clrcart()" : ""; ?>">ล้างค่า</button>
                                            <?php
                                                } else { ?>
                                                <h2>ไม่พบข้อมูล</h2>
                                                <div class="modal-footer">
                                                <?php }  ?>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-------endModal------>
                                </div>
                                <?php
                                // echo "<pre>";
                                // print_r($res_pagi_sql);
                                // echo "</pre>";

                                ?>
                                <?php
                                // echo $Page_Start;
                                // echo $Per_Page;
                                // echo "<pre>";
                                // print_r(count(array_slice($data_res, $Page_Start, $Per_Page)));
                                // echo "</pre>";
                                
                                // foreach (array_slice($res_pagi_sql, $Page_Start, $Per_Page) as $key => $value) { 
                                    foreach (array_slice($data_res, $Page_Start, $Per_Page) as $key => $value) { ?>
                                    <div class="BookResult">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td width="100" height="110" valign="top">
                                                        <div class="photo" id="divphotob00124898">
                                                            <?php 
                                                            if (isset($data_res[$key]['960']['sub'])) {
                                                                $cut = calsub_arr($data_res[$key]['960']['sub'],'960');
                                                                if (isset($cut['Pic']['#a'])) {
                                                                    $cut = $cut['Pic']['#a'];
                                                                }
                                                                else {
                                                                    $cut = null;
                                                                }
                                                            }
                                                            else{
                                                                $cut = null;
                                                            }
                                                               
                                                            ?>
                                                            
                                                            <?php
                                                            $stack = "<img id='$cut' class='img-polaroid Book_thumb' src='/lib/img/";
                                                                if ($cut!=null) {
                                                                    $stack .= $cut ;
                                                                }
                                                                else{
                                                                    $stack .= 'Noimgbook.jpg';  
                                                                } 
                                                            $stack .= "' alt='image'>";
                                                            echo $stack ;
                                                            ?>

                                                        </div>
                                                    </td>
                                                    <td valign="top">
                                                        <table>
                                                            <tbody style="font-size: 12px;">
                                                                <tr>
                                                                    <td width="100" valign="top" class="BookLabel">ประเภทแหล่งที่มา</td>
                                                                    <td>
                                                                        <img src="../../img/book.png" height="16" width="16/"><?= 'BOOK' ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100" valign="top" class="BookLabel" style="padding-top: 7px;">ชื่อเรื่อง</td>
                                                                    <td style="padding-top: 7px;">
                                                                        <?php 
                                                                        if (isset($data_res[$key]['245']['sub'])) {
                                                                            $title_ = calsub_arr($data_res[$key]['245']['sub'],'245');
                                                                            if (isset($title_['Title']['#a'])) {
                                                                                $title_ = $title_['Title']['#a'];
                                                                            }
                                                                            else{
                                                                                $title_ = null;
                                                                            }
                                                                        }
                                                                        else{
                                                                            $title_ = null;
                                                                        }
                                                                        ?>
                                                                        <a title="<?= $title_ ?>" class="BookTitle" href='../../view/showbook/bibitem.php?Bibid=<?=$key?>'><?= $title_ = isset($title_) ? $title_ : 'ไม่มีชื่อ';?></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100" valign="top" class="BookLabel">สำนักพิมพ์</td>
                                                                    <td><?php
                                                                    if (isset($data_res[$key]['260']['sub'])) {
                                                                        $cut = calsub_arr($data_res[$key]['260']['sub'],'260');
                                                                        $cut = $cut['Publication']['#a'];
                                                                        echo $cut;
                                                                    }
                                                                    else {
                                                                        echo "-";
                                                                    }
                                                                            
                                                                     ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="100" valign="top" class="BookLabel">สาขาห้องสมุด</td>
                                                                    <td>
                                                                        <?php 
                                                                        if (isset($data_res[$key]['003']['sub'])) {
                                                                            echo $data_res[$key]['003']['sub'];
                                                                        }
                                                                        else{
                                                                            echo "-";
                                                                        }
                                                                            
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="AddTolist">
                                            <?php 
                                            $sql_barcode = query_data("SELECT Barcode FROM databib_item WHERE Bib_ID = $key");
                                            if (isset($_SESSION["btn"][$sql_barcode[0]['Barcode']]) && $_SESSION["btn"][$sql_barcode[0]['Barcode']] == 1) { ?>
                                                <input type="image" onclick="do_delcart('<?= $sql_barcode[0]['Barcode'] ?>')" title="remove" src="../../img/remove-cart.png">
                                            <?php } else { ?>
                                                <?php
                                                
                                                    if (isset($data_res[$key]['100']['sub'])) {
                                                        $author_ = calsub_arr($data_res[$key]['100']['sub'],'100');
                                                        if (isset($author_['Author']['#a'])) {
                                                            $author_ = $author_['Author']['#a'];
                                                        }
                                                        else{
                                                            $author_ = null;
                                                        }
                                                    }
                                                    else{
                                                        $author_ = null;
                                                    }
                                                ?>
                                                <input type="image" onclick="do_addcart('<?= $sql_barcode[0]['Barcode'] ?>','<?= $title_ ?>','<?= $author_ ?>')" title="add" src="../../img/add-cart.png">
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php }
                                    ?>
                                <div class="pagination-wrapper">
                                    <div class="pagination">
                                        <span class="prev page-numbers">Page :</span>
                                        <?php
                                            if ($Prev_Page) {
                                                // echo " <a href='$getURL[0]&nPage=$Prev_Page&perPage=$Per_Page'><< Back</a> ";
                                                echo "<a class='prev page-numbers'href='$getURL[0]&nPage=$Prev_Page&perPage=$Per_Page'>prev</a>";
                                            }

                                            for ($i = 1; $i <= $Num_Pages; $i++) {
                                                if ($i != $Page) {
                                                    // echo "[ <a href='$getURL[0]&nPage=$i&perPage=$Per_Page'>$i</a> ]";
                                                    echo " <a class='page-numbers' href='$getURL[0]&nPage=$i&perPage=$Per_Page'>$i</a>";
                                                } else {
                                                    echo "<span aria-current='page' class='page-numbers current'> $i </span>";
                                                }
                                            }
                                            if ($Page != $Num_Pages) {
                                                // echo " <a href ='$getURL[0]&nPage=$Next_Page&perPage=$Per_Page'>Next>></a> ";
                                                echo "<a class='next page-numbers' href='$getURL[0]&nPage=$Next_Page&perPage=$Per_Page'>next</a>";
                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    ?>
                </div>
            </div>
            <div id="content2">
                <div class="BookResult">
                    <h2>
                        <b> No results found </b>
                    </h2>
                </div>
            </div>
            
        <?php
        }
        ?>
        </form>
        
        </div>
        <!-- <div class="col-md-12" >
        <div class="row" >
    <span class="footer-divider"></span>
    </div> 
    <div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #eee;">
            <footer>
                            <div class="col-md-14">
                               
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-12" id="vertical-line">
                                    <div class="col-md-12">
                                        <img src="https://webs.rmutl.ac.th/assets/upload/logo/web_footer_20170911140318.png" class="rmutl-web-logo-footer img-responsive">
                                    </div>
                                    <div class="col-md-12 footer-about-text text-center">
                                        ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา<br>
                                        <span class="footer-span-comment">"มทร.ล้านนา"</span>
                                    </div>
                                    <div class="col-md-12 text-center">

                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <div class="list-text-footer row">
                                        <div class="col-md-4">
                                            <ul>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <ul>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <ul>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="address-text-fooster col-md-12">
                                        ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา : 128 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่ 50300<br>
                                        โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183 </div>
                                    <div class="address-text-fooster col-md-12" style="margin-top: 8px;">
                                        <div id=ipv6_enabled_www_test_logo></div>
                                        <script language="JavaScript" type="text/javascript">
                                            //var Ipv6_Js_Server = (("https:" === document.location.protocol) ? "https://" : "http://");
                                            //document.write(unescape("%3Cscript src='" + Ipv6_Js_Server + "www.ipv6forum.com/ipv6_enabled/sa/SA1.php?id=5070' type='text/javascript'%3E%3C/script%3E"));
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </footer>
                        <div class="credit" style="text-align:center; color: #fff;margin-top: 50px;margin-bottom: 15px;">
                            <p style="color: #666; font-family: 'kanit';">ออกแบบและพัฒนาโดย <a href="https://arit.rmutl.ac.th/" target="_blank">สำนักวิทยบริการและเทคโนโลยีสารสนเทศ</a> <a href="https://www.rmutl.ac.th/" target="_blank">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</a></p>
                        </div> -->
    </section>
    <input type="hidden" id="service_base_url" value="https://library.rmutl.ac.th/"> 
    <script src="https://library.rmutl.ac.th/assets/js/jquery.dcjqaccordion.min.js" type="text/javascript"></script>
    <script src="https://library.rmutl.ac.th/assets/js/owl.carousel.min.js" type="text/javascript"></script>
    <script src="https://library.rmutl.ac.th/assets/js/home.min.js" type="text/javascript"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-87588904-9"></script>
    <script src="/lib/script/search.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments)
        };
        gtag('js', new Date());

        gtag('config', 'UA-87588904-9');
    </script>

        
    
   
   

    </body>

    </html>
    <script type="text/javascript">
        function do_confcart() {
            var checkstatus = <?= isset($_SESSION['user_status']) ? json_encode($postdata) : '0'; ?>;
            if (checkstatus != '0') {
                var userid = '<?= isset($_SESSION['user_status']) ? $_SESSION['user_status']['ID'] : '-1'; ?>';
                $.ajax({
                    url: "/lib/model/session/confirm.php",
                    data: {
                        id: userid,
                        datacart: checkstatus
                    },
                    type: 'POST',
                    success: function(res) {
                        console.log(res);
                        alert(res);
                        window.location.reload();
                    },
                    error: function(e) {
                        console.log(e);
                        alert("something wrong!");
                    }
                });
            } else {
                // alert('Please login first');
                var myModal = $("#login-showmodal");
                myModal.modal();
                // window.open("/lib/view/login/login.php", " ", "menubar=no,resizable=no,scrollbars=no,top=50,left=250,width=600,height=500");
                // window.location = '/lib/view/login/login.php';
            }
        }
    </script>
    <script src="/lib/script/search.js"></script>
    <script src="/lib/script/reservations.js"></script>
    