<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/url_helper.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/datehelper.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
$user_status = $_SESSION['user_status'];
$FName1 = $_SESSION['user_status']['FName'];
$IDmember = $_SESSION['user_status']['ID'];
$sql = "SELECT * FROM member WHERE FName='$FName1'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

//$datatest = querydatareport("SELECT count(*) AS num,Book AS Barcode FROM borrowandreturn WHERE Member = '$IDmember'");
//echo('<pre>');
//print_r($datatest);
//exit;

$getcountbnr_his = $conn->query("SELECT count(*) AS num FROM borrowandreturn WHERE Member = '$IDmember'");
$countbnr_his = $getcountbnr_his->fetch_assoc(); ////ประวัติการยืมคืน////

$getcountrsvt = $conn->query("SELECT count(*) AS num FROM reservations WHERE Member = '$IDmember' AND IsDeleteorCancel = 0");
$countrsvt = $getcountrsvt->fetch_assoc(); ////จอง////

$getcountbnr = $conn->query("SELECT count(*) AS num FROM borrowandreturn WHERE Member = '$IDmember' AND Due = '0000-00-00'");
$countbnr = $getcountbnr->fetch_assoc(); ////รายการยืมและกำหนดส่ง////

$getcountfnbk = $conn->query("SELECT count(*) AS num FROM borrowandreturn WHERE Member = '$IDmember' AND Due = '0000-00-00' AND Returns < '$now'");
$countfnbk = $getcountfnbk->fetch_assoc(); ////รายการค่าปรับ////
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<section class="container main-container">
    <div class="row">
        <div id="warpper">
            <div class="subnavigate">
                <div class="ct">
                    <!-- navigative -->
                    <div class="left navi">
                        <p>
                            <?php
                            if (isset($_GET['Menu']) && $_GET['Menu'] != '') {
                                switch ($_GET['Menu']) {
                                    case 'brwnrt':
                                        echo '<FONT Size="3" color="#FFFFFF" >รายการยืมและกำหนดส่ง</FONT>';
                                        break;
                                    case 'reserv':
                                        echo '<FONT Size="3" color="#FFFFFF">รายการจอง</FONT>';
                                        break;
                                    case 'finebk':
                                        echo '<FONT Size="3" color="#FFFFFF">รายการค่าปรับ</FONT>';
                                        break;
                                    case 'missd':
                                        echo '<FONT Size="3" color="#FFFFFF">รายการแจ้งหาย</FONT>';
                                        break;
                                    case 'brwnrt_his':
                                        echo '<FONT Size="3" color="#FFFFFF">ประวัติการยืมคืน</FONT>';
                                        break;
                                    case 'edit_profile':
                                        echo '<FONT Size="3" color="#FFFFFF">แก้ไขข้อมูลส่วนตัว</FONT>';
                                        break;

                                    default:
                                        # code...
                                        break;
                                }
                            } else {
                                echo '<FONT Size="3" color="#FFFFFF">สมาชิก</FONT>';
                            }
                            ?></p>
                    </div>
                    <!-- search box -->
                    <div class="right">
                        <div id="searchwrapper2">
                            <form action="../../controller/search/Result.php" method="GET">
                                <input name="Ntt" id="Ntt" type="text" class="btn btn-white" style="padding:unset;border:px solid darkgray; ">
                                &nbsp;
                                <span style="display:none;"></span>
                                <select name="Ntk" id="Ntk" class="btn btn-white" style="padding:unset; border:1px solid darkgray;font-family:kanit; ">
                                    <option value="KEYWORD" selected>ทั้งหมด</option>
                                    <option value="TITLE">ชื่อเรื่อง</option>
                                    <option value="AUTHOR">ชื่อผู้แต่ง</option>
                                    <option value="SUBJECT">หัวเรื่อง</option>
                                    <option value="TAGS">แท็ก</option>
                                    <option value="ISBNISSN">ISBN/ISSN</option>
                                    <option value="PUBLISHER">สำนักพิมพ์</option>
                                    <option value="JOURNALTITLE">ชื่อวารสาร</option>
                                    <input type="hidden" name="nPage" value="1">
                                    <input type="hidden" name="perPage" value="15">
                                </select>
                                &nbsp;<input type="submit" id="btnsearch" value="สืบค้น" title="สืบค้น" class="btn btn-danger" style="padding: 1px 6px;font-size: 14px;border: 0.5px; font-family:kanit;">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="container ">
            <br>
            <div id="bodycontainer" style="margin: 0;">
                <!-- <div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #eee;"> -->
                <?php if (isset($_GET['Menu']) && $_GET['Menu'] != '') {
                    echo '<div id="sidebar">';
                    include $url_path . "view/member/member_sidebar.php";
                    echo '</div><div id="content3">';
                    switch ($_GET['Menu']) {
                        case 'brwnrt':
                            include $url_path . "view/member/member_Menu/mem_brwnrt.php";
                            break;
                        case 'reserv':
                            include $url_path . "view/member/member_Menu/mem_reserv.php";
                            break;
                        case 'finebk':
                            include $url_path . "view/member/member_Menu/mem_finebk.php";
                            break;
                        case 'missd':
                            include $url_path . "view/member/member_Menu/mem_missed.php";
                            break;
                        case 'brwnrt_his':
                            include $url_path . "view/member/member_Menu/mem_brwnrt_history.php";
                            break;
                        case 'edit_profile':
                            include $url_path . "view/member/member_Menu/edit_profile.php";
                            break;

                        default:
                            # code...
                            break;
                    }
                    echo '</div>';
                } else { ?>
                    <!-- <div class="col-md-12"> -->

                    <div class="col-md-3">
                        <div id="sidebar">

                            <center><img src="<?= isset($row['img']) && $row['img'] != "" ? "../../imgmember/" . $row['img'] : "../../img/no-pic.jpg"; ?>" width="150px" height="170px" style=";border-style:outset;border-width:2px;">
                                <button class="btn btn-link" style=" font-family:kanit;"> <?php echo $row['FName'] . '  ' . $row['LName']; ?></button>
                        </div>
                    </div>
                    <div id="content3">

                        <table class="GridItemStyle_Memberindex" cellspacing="0" id="cphContent_GridView1" style="border-width:0px;border-style:None;width:99%;border-collapse:collapse;">
                            <tbody>
                                <div class="col-md-12">
                                    <br>
                                </div>
                                <tr valign="top">
                                    <td valign="top">
                                        <table style="width:99%" border="0" cellspacing="0" cellpadding="10">
                                            <tbody>
                                                <div class="col-md-4">
                                                    <td width="5%" valign="top" style=" padding-bottom:20px;font-family:kanit;">
                                                        <img src="../../iconimg/calendar (1).png" width='90' height='90'><br>
                                                        <br>
                                                        <br>

                                                    <td width="45%" valign="top" style=" padding-bottom:20px;font-family:kanit;">
                                                        <a href="member.php?Menu=brwnrt">รายการยืมและกำหนดส่ง (<?= $countbnr['num'] ?>)</a>
                                                        <p class="Memberdetail">ผู้ใช้บริการสามารถตรวจสอบข้อมูลการยืมและกำหนดส่งทรัพยากรฯ ตามระเบียบการยืมของห้องสมุด</p>
                                                    </td>
                                                </div>
                                                <div class="col-md-4">
                                                    <td width="5%" valign="top" style=" padding-bottom:20px;font-family:kanit;">
                                                        <img src="../../iconimg/test (3).png" width='90' height='90'></td>
                                                    <td width="45%" valign="top" style=" padding-bottom:20px;font-family:kanit;">
                                                        <a href="member.php?Menu=reserv">รายการจอง (<?= $countrsvt['num'] ?>)</a>
                                                        <p>ผู้ใช้บริการสามารถตรวจสอบข้อมูลรายการจองทรัพยากรฯ ของห้องสมุด</p>
                                                    </td>
                                </tr>

                                <tr>
                                    <td width="5%" valign="top" style=" padding-bottom:20px;font-family:kanit;">

                                        <img src="../../iconimg/pay-per-click.png" width='90' height='90'>
                                        <br>
                                        <br>
                                        <br></td>

                                    <td width="45%" valign="top" style=" padding-bottom:20px;font-family:kanit;">
                                        <a href="member.php?Menu=finebk">รายการค่าปรับ (<?= $countfnbk['num'] ?>)</a>
                                        <p class="Memberdetail">ผู้ใช้บริการสามารถตรวจสอบข้อมูลรายการค่าปรับในกรณีที่ยืมทรัพยากรฯ เกินกำหนด โดยผู้ใช้บริการจะต้องเสียค่าปรับตามอัตราที่ห้องสมุดกำหนด</p>
                                    </td>
                                    <td width="5%" valign="top" style=" padding-bottom:20px;font-family:kanit;">
                                        <img src="../../iconimg/interview.png" width='90' height='90'></td>
                                    <td width="45%" valign="top" style=" padding-bottom:20px;font-family:kanit;">
                                        <a href="member.php?Menu=brwnrt_his">ประวัติการยืมคืน (<?= $countbnr_his['num'] ?>)</a>
                                        <p class="Memberdetail">ผู้ใช้บริการสามารถตรวจสอบประวัติการยืมและคืนทรัพยากรฯ ทั้งหมดที่มีการเข้ามาใช้บริการภายในห้องสมุด</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="5%" valign="top" style=" padding-bottom:20px;font-family:kanit;">
                                        <img src="../../iconimg/notebook (1).png" width='90' height='90'></td>
                                    <td width="45%" valign="top" style=" padding-bottom:20px;font-family:kanit;">
                                       <a href="member.php?Menu=edit_profile">แก้ไขข้อมูลส่วนตัว</a>
                                        <p class="Memberdetail">ผู้ใช้บริการสามารถแก้ไขข้อมูลส่วนตัว ในส่วนที่ระบบอนุญาติให้แก้ไขได้เท่านั้น</p>
                                    </td>
                                    <!--<td width="5%" valign="top" style=" padding-bottom:20px;font-family:kanit;">
                                        <img src="../../iconimg/faq.png" width='90' height='90'></td>
                                    <td width="45%" valign="top" style=" padding-bottom:20px;font-family:kanit;">
                                        <a href="member.php?Menu=edit_profile">แก้ไขข้อมูลส่วนตัว</a>
                                        <p class="Memberdetail">ผู้ใช้บริการสามารถแก้ไขข้อมูลส่วนตัว ในส่วนที่ระบบอนุญาติให้แก้ไขได้เท่านั้น</p>
                                    </td>-->
                                </tr>
                                <!--<tr>
                                        
                                        <td width="5%" valign="top" style=" padding-bottom:20px;font-family:kanit;">
                                        <img src="../../iconimg/books.png" width='64' height='64'></td>
                                        <td width="45%" valign="top" style=" padding-bottom:20px;font-family:kanit;">
                                        <a href="../Acquisition/Recommend.aspx">แนะนำหนังสือ</a><p class="Memberdetail">สมาชิกสามารถแนะนำทรัพยากรห้องสมุด เพื่อจัดซื้อจัดหาเข้ามาไว้ในห้องสมุดได้</p></td>
                                    </tr>
                                    <tr>
                                        <td width="5%" valign="top" style=" padding-bottom:20px;">
                                        <img src="../../iconimg/browser.png" width='64' height='64'></td>
                                        <td width="45%" valign="top" style=" padding-bottom:20px;">
                                        <a href="#">ประวัติการแนะนำหนังสือ (0)</a><p class="Memberdetail">ดูประวัติการแนะนำหนังสือของคุณเอง<br><br></p></td>
                                    </tr>
                                     <tr>
                                            <td width="5%" valign="top" style=" padding-bottom:20px;">
                                        <img src="../../iconimg/calendar1.png" width='64' height='64'></td>
                                        <td width="45%" valign="top" style=" padding-bottom:20px;">
                                        <a href="#">แท็ก (0)</a><p class="Memberdetail">ประโยคหรือคำสั้นๆ เด่นๆ ที่สามารถบอกได้เกี่ยวกับเนื้อหาที่ผู้ใช้กำหนดให้ โดยเป็นทางเลือกหนึ่งที่นำเสนอสิ่งที่ผู้ใช้ได้เขียนไว้ให้ค้นหาง่ายและสะดวกต่อการค้นหามากยิ่งขึ้น</p></td>
                                        <td width="5%" valign="top" style=" padding-bottom:20px;">
                                        <img src="../../iconimg/calendar1.png" width='64' height='64'></td>
                                        <td width="45%" valign="top" style=" padding-bottom:20px;">
                                        <a href="#">ทรัพยากรของฉัน (0)</a><p class="Memberdetail">เป็นเครื่องมือช่วยเก็บข้อมูลอีกอย่างหนึ่งในการสืบค้นทรัพยากรฯ ของห้องสมุด ใช้ในการเก็บประวัติการสืบค้น สามารถบันทึกไว้แล้วมาเรียกดูได้ในภายหลัง ไม่ต้องเริ่มต้นการค้นใหม่</p></td>
                                    </tr>
                                    <tr>
                                            <td width="5%" valign="top" style=" padding-bottom:20px;">
                                        <img src="../../iconimg/calendar1.png" width='64' height='64'></td>
                                        <td width="45%" valign="top" style=" padding-bottom:20px;">
                                        <a href="#">My Reviews (0)</a><p class="Memberdetail">เป็นการระบุคำวิจารณ์สั้นๆ ที่มีต่อทรัพยากรฯ นั้นๆ</p></td>
                                        <td width="5%" valign="top" style=" padding-bottom:20px;">
                                        <img src="../../iconimg/calendar1.png" width='64' height='64'></td>
                                        <td width="45%" valign="top" style=" padding-bottom:20px;">
                                        <a href="#">แนะนำทรัพยากรฯ (0)</a><p class="Memberdetail">เป็นการแนะนำทรัพยากรฯ ภายในห้องสมุด</p></td>
                                    </tr> -->
                            </tbody>
                        </table>
                        </td>
                        </tr>
                        </tbody>
                        </table>
                    </div>
            </div>
            <!-- <div>
            <div class="BookResult">
                             <div class="col-md-4">
                             <br>
                             <br>
                             <br>
                             <a href="member.php?Menu=brwnrt"><img src='/lib/iconimg/777.png' width='90' height='90' ></i></a>&nbsp;&nbsp;&nbsp;<a href="member.php?Menu=brwnrt"><b>รายการยืมและกำหนดส่ง</b></a>

                             </div>
                             <div class="col-md-4">
                             <br>
                             <br>
                             <br>

                             <a href="../search/main.php"><img src='/lib/iconimg/444.png' width='90' height='90'  ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="../search/main.php"><b>รายการจอง</b></a>

                             </div>
             </div>
                             <div class="col-md-4">
                             <br>
                             <br>
                             <br>

                             <a href="member.php?Menu=finebk"><img src='/lib/iconimg/888.png' width='90' height='90'  ></i></a>&nbsp;&nbsp;&nbsp;<a href="member.php?Menu=finebk"><b>รายการค่าปรับ</b></a>

                             </div>

                             <div class="col-md-4">
                             <br>
                             <br>
                             <br>

                             <a href="#"><img src='/lib/iconimg/7788.png' width='90' height='90' ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><b>รายการขอยืมข้ามสาขา</b></a>

                             </div>
                             <div class="col-md-3"></div>
                             <div class="col-md-4">
                             <br>
                             <br>
                             <br>
                             <a href="#"><img src='/lib/iconimg/987.png' width='90' height='90'  ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><b>รายการแจ้งหาย</b></a>

                             </div>
                             <div class="col-md-4">
                             <br>
                             <br>
                             <br>
                             <a href="#"><img src='/lib/iconimg/999.png' width='90' height='90' ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><b>Block</b></a>

                             </div>
                             <div class="col-md-3"></div>
                             <div class="col-md-4">
                             <br>
                             <br>
                             <br>
                             <a href="#"><img src='/lib/iconimg/12345.png' width='90' height='90'  ></i></a>&nbsp;&nbsp;<a href="member.php?Menu=brwnrt_his"><b>ประวัติการยืมคืน</b></a>

                             </div>
                             <div class="col-md-4">
                             <br>
                             <br>
                             <br>
                             <a href="#"><img src='/lib/iconimg/321.png' width='90' height='90' ></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><b>แนะนำหนังสือ</b></a>

                             </div>
                             <div class="col-md-3"></div>
         
                             <div class="col-md-4">
                             <br>
                             <br>
                             <br>
                             <a href="#"><img src='/lib/iconimg/1122.png' width='90' height='90'  ></i></a>&nbsp;&nbsp;&nbsp;<a href="member.php?Menu=edit_profile"><b>แก้ไขข้อมูลส่วนตัว</b></a>

                             </div>
                </div> -->
        <?php } ?>
    </div>


    </div>
    <footer>
        <div class="row">
            <span class="footer-divider"></span>
        </div>
        <div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #eee;">
            <div class="col-md-4 col-sm-12" id="vertical-line">
                <div class="col-md-12">
                    <img src="<?= $url_path ?>assets/upload/logo/web_footer_20170911140318.png" class="rmutl-web-logo-footer img-responsive">
                </div>
                <div class="col-md-12 footer-about-text text-center">
                    ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา<br>
                    <span class="footer-span-comment">"มทร.ล้านนา"</span>
                </div>

            </div>
            <div class="col-md-8 col-sm-12">
                <div class="list-text-footer row">

                    <div class="address-text-fooster col-md-12">
                        ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา : 128 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่ 50300<br>
                        โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183 </div>

                </div>
            </div>
        </div>
    </footer>
    <div class="row" style=" background-color: #eee;">
        <div class="credit" style="text-align:center; color: #eee;margin-top: 15px;margin-bottom: 15px;">
            <p style="color: #666; font-family: 'kanit';">ออกแบบและพัฒนาโดย <a href="https://arit.rmutl.ac.th/" target="_blank">สำนักวิทยบริการและเทคโนโลยีสารสนเทศ</a> <a href="https://www.rmutl.ac.th/" target="_blank">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</a></p>
        </div>
</section>
<input type="hidden" id="service_base_url" value="https://library.rmutl.ac.th/">
<script src="<?= $url_path ?>assets/js/jquery.dcjqaccordion.min.js" type="text/javascript"></script>
<script src="<?= $url_path ?>assets/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?= $url_path ?>assets/js/home.min.js" type="text/javascript"></script>

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

</section>
<input type="hidden" id="service_base_url" value="https://library.rmutl.ac.th/">
<script src="<?= $url_path ?>assets/js/jquery.dcjqaccordion.min.js" type="text/javascript"></script>
<script src="<?= $url_path ?>assets/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?= $url_path ?>assets/js/home.min.js" type="text/javascript"></script>

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
<input type="hidden" id="service_base_url" value="https://library.rmutl.ac.th/">
<script src="<?= $url_path ?>assets/js/jquery.dcjqaccordion.min.js" type="text/javascript"></script>
<script src="<?= $url_path ?>assets/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?= $url_path ?>assets/js/home.min.js" type="text/javascript"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-87588904-9"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments)
    };
    gtag('js', new Date());

    gtag('config', 'UA-87588904-9');
</script>
<!-- </div> -->

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";
?>