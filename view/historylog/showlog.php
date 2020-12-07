<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/reportmodel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/helper/url_helper.php';
?>
<!-- <script src="<?=$url_path?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=$url_path?>assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?=$url_path?>assets/js/dist/css/bootstrap/zebra_datepicker.min.css" type="text/css">
<script src="<?=$url_path?>assets/js//dist/zebra_datepicker.min.js"></script> -->
<script src="<?= $url_path ?>assets/js/moment.js"></script>
<script>
    $(document).on("change", "#subfil_log", function() {
        var fil_date = $("#subfil_log").val();
        if (fil_date == 'bydate') {
            $("#startdate").show();
            $("#startmonth").hide();
            $("#startyear").hide();
        } else if (fil_date == 'byperiod') {
            $("#startdate").hide();
            $("#startmonth").show();
            $("#startyear").hide();
        } else if (fil_date == 'byyear') {
            $("#startdate").hide();
            $("#startmonth").hide();
            $("#startyear").show();
        } else {
            $("#startdate").hide();
            $("#startmonth").hide();
            $("#startyear").hide();
        }
    });

    var typelog = null;
    var typedate = null;
    var getstartdate = null;
    var getstartmonth = null;
    var getstartyear = null;
    var now_page = 1;
    var all_page = null;
    var temp_date = moment();
    var daydate = temp_date.format("YYYY-MM-DD");

    $(document).on("click", "#on_go", function() {
        typelog = $("#fil_log").val();
        typedate = $("#subfil_log").val();
        getstartdate = $("#start_date").val();
        getstartmonth = $("#start_month").val();
        getstartyear = $("#start_year").val();
        now_page = 1;
        show_table();
    });

    function show_table(){
        $.ajax({
            url: "ShowLogDetail.php",
            data: {
                typelog: typelog,
                typedate: typedate,
                startdate: getstartdate,
                startmonth: getstartmonth,
                startyear: getstartyear,
                now_page: now_page
            },
            type: "POST",
            success: function(data) {
                // console.log(data);
                for (let i = 0; i < data.length; i++) {
                    if (data.substr(i,1)=="+") {
                        data = data.substr(1)
                        break;
                    }
                    else if (data.substr(i,1)=="/") {
                        all_page = data.substr(0,i);
                        break;
                    }
                }
                table = data.substr((all_page.length+1),data.length);
                $("#ShowLogDetail").html(table);
                $('.text_now').val(now_page);
                $('.text_all').val(all_page);
                if (now_page==all_page) {
                    $('.btn_next').prop('disabled',true);
                }
                if (now_page!=1) {
                    $('.btn_back').prop('disabled',false);
                }
                if (now_page==1) {
                    $('.btn_back').prop('disabled',true);
                }
                if (now_page!=all_page) {
                    $('.btn_next').prop('disabled',false);
                }
                if (table!="<h2>ไม่พบข้อมูล</h2>") {
                    $('.pagination').show();
                }
                else{
                    $('.pagination').hide();
                }
            },
            error: function(e) {
                // console.log(e);
                alert("something wrong!");
            }
        });
    }

    

    var all_page = 0;
    var all_now = 0;
    var page_1 = 0;
    var page_2 = 0;

</script>
<br><br><br>
<section class="container">
    <div class="row" style="padding-top: 20px;padding-bottom: 200px; background-color: #eee;">
        <div class="col-md-12">
               <a href="../librarian/librarian.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>&nbsp;&nbsp;<b style="font-size: 25px;">ประวัตการแก้ไข</b><br><br><br
            <div class="container">
                <div>
                    <h3>ประวัติการทำรายการของเจ้าหน้าที่</h3>
                    <div class="col-md-12">
                        <form class="form">
                            <table class="table">
                                <tr>
                                    <td>ประเภท</td>
                                    <td>
                                        <select id="fil_log" class="btn btn-white">
                                            <option value="borrowandreturn" selected>ประวัติการยืมและคืนทรัพยากร</option>
                                            <option value="finebook" selected>ประวัติการค่าปรับ</option>
                                            <option value="buy" selected>ประวัติการซื้อทรัพยากร</option>
                                            <option value="reservations">ประวัติการจอง</option>
                                            <option value="userstatus">ประวัติการแก้ไขผู้ใช้</option>
                                            <option value="databib" selected>ประวัติข้อมูลทรัพยากร</option>
                                            <option value="field" selected>ประวัติข้อมูลเขตข้อมูล</option>
                                            <option value="template" selected>ประวัติข้อมูลระเบียนทรัพยากร</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr id="subfillog">
                                    <td>ช่วงเวลา</td>
                                    <td>
                                        <select class="btn btn-white" id="subfil_log">
                                            <option selected value="bydate">วัน</option>
                                            <option value="byperiod">เดือน</option>
                                            <option value="byyear">ปี</option>
                                        </select>
                                        &nbsp; ที่ &nbsp;
                                        <span id="startdate">
                                            <input type="text" class="btn btn-white form-control" style="background-color:#fff" name="start_date" id="start_date" data-zdp_show_clear_date="false" >
                                        </span>
                                        <span hidden id="startmonth">
                                            <input hidden type="text" class="btn btn-white form-control" style="background-color:#fff" name="start_month" id="start_month">
                                        </span>
                                        <span hidden id="startyear">
                                            <input hidden type="text" class="btn btn-white form-control" style="background-color:#fff" name="start_year" id="start_year">
                                        </span>
                                        <!-- <span id="startdate">
                                            <input type="date" class="btn btn-white" id="start_date" required>
                                        </span>
                                        <span hidden id="startmonth">
                                            <input hidden type="month" class="btn btn-white" id="start_month" required>
                                        </span>
                                        <span hidden id="startyear">
                                            <input hidden type="number" min="1900" max="2099" step="1" value="2019" class="btn btn-white" id="start_year">
                                        </span> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <!-- <input id="on_go" class="btn btn-primary send-email" type="button" value="แสดงรายงาน"> -->
                                        <button type="button" class="btn btn-primary send-email" id="on_go">ค้นหา</button>
                                        <button type="reset" class="btn btn-default" onclick="Javascript:$('#startdate').show();$('#startmonth').hide();$('#startyear').hide();">ล้างค่า</button>
                                    </td>
                                </tr>

                            </table>
                        </form>

                        <!-- Show Report Areas -->
                        <hr style="border-top: 2px solid #b1b1b1;">
                        
                        <div class="col-md-12" id="ShowLogDetail">
                            <h4>กรุณเลือกประวัติที่ต้องการ</h4>
                        </div>
                        <div class="pagination">
                            <button class='btn btn-default btn_back' >ย้อนกลับ</button>
                            <input type='text' class='btn text_now' value='' disabled>
                            <button class="btn" style="cursor: default;">/</button>
                            <input type='text' class='btn text_all' value='' disabled>
                            <button class='btn btn-default btn_next' >ต่อไป</button>
                        </div>
                        
                        <?php include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <footer>
        <div class="row">
            <span class="footer-divider"></span>
        </div>
        <div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #eee;">
            <div class="col-md-4 col-sm-12" id="vertical-line">
                <div class="col-md-12">
                    <img src="https://webs.rmutl.ac.th/assets/upload/logo/web_footer_20170911140318.png" class="rmutl-web-logo-footer img-responsive">
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
<script>
    $('#start_date').Zebra_DatePicker({
        format: 'Y-m-d',
        todayBtn: "linked"
    }).val(daydate);;
    $('#start_month').Zebra_DatePicker({
        format: 'Y-m',
        view: 'months'
    });
    $('#start_year').Zebra_DatePicker({
        format: 'Y',
        view: 'years'
    });
</script>
<input type="hidden" id="service_base_url" value="<?= $url_path ?>index.php">
<script src="<?=$url_path?>assets/js/jquery.dcjqaccordion.min.js" type="text/javascript"></script>
<script src="<?=$url_path?>assets/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?=$url_path?>assets/js/home.min.js" type="text/javascript"></script>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";
?>

<script>

    $('.btn_next').on('click',function(){
        if (now_page!=all_page) {
            now_page++;
            show_table();
        }
    });

    $('.btn_back').on('click',function(){
        if (now_page>1) {
            now_page--;
            show_table();
        }
    });

    $(document).ready(function(){
        $('.pagination').hide();
    })
    
    // $('#start_date').on('click',function(){
    //     console.log($(this).val())
    //     if($(this).val()!=""){
    //         $('#on_go').prop('disabled',false);
    //     }
    //     else{
    //         $('#on_go').prop('disabled',true);
    //     }
    // })
    
    
</script>