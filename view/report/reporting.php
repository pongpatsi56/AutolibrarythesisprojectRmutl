<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/model/reportmodel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/helper/url_helper.php';
?>
<!-- <script src="http://localhost:8080/lib/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="http://localhost:8080/lib/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<!-- jQuery -->
<!-- <script src="http://localhost:8080/lib/assets/js/jquery-3.1.1.min.js" type='text/javascript'></script> -->

<!-- Bootstrap -->
<!-- <link href='http://localhost:8080/lib/assets/js/bootstrap/css/bootstrap.min.css' rel='stylesheet' type='text/css'> -->
<!-- <script src='http://localhost:8080/lib/assets/js/bootstrap/js/bootstrap.min.js' type='text/javascript'></script> -->

<!-- Datepicker -->
<!-- <link href='http://localhost:8080/lib/assets/js/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css' rel='stylesheet' type='text/css'> -->
<!-- <script src='http://localhost:8080/lib/assets/js/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js' type='text/javascript'></script> -->
<link rel="stylesheet" href="<?= $url_path ?>assets/js/dist/css/bootstrap/zebra_datepicker.min.css" type="text/css">
<!-- <link rel="stylesheet" href="http://localhost:8080/lib/assets/js/dist/examples.css" type="text/css"> -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/zebra_pin@2.0.0/dist/zebra_pin.min.js"></script> -->
<script src="<?= $url_path ?>assets/js/dist/zebra_datepicker.min.js"></script>
<script src="<?= $url_path ?>assets/js/validate.min.js"></script>
<script src="<?= $url_path ?>assets/js/moment.js"></script>
<script src="<?= $url_path ?>assets/js/canvasjs.min.js"></script>
<!-- <script src="http://localhost:8080/lib/assets/js/dist/examples.js"></script> -->
<script>
    var date = moment(); //Get the current date
    var dateday = date.format("YYYY-MM-DD"); //2014-07-10
    var datemonth = date.format("YYYY-MM"); //2014-07
    var dateyear = date.format("YYYY"); //2014
    $(document).ready(function() {
        $('#reportform').validate({
            rules: {
                // "start_date": {
                //     require: true
                // },
                // "start_month": {
                //     require: true
                // },
                // "start_year": {
                //     require: true
                // },
                "mem-info": {
                    require: true
                },
            },
            messages: {
                // "start_date": "โปรดระบุ ปี-เดือน-วัน",
                // "start_month": "โปรดระบุ ปี-เดือน",
                // "start_year": "โปรดระบุ ปี",
                "mem-info": "โปรดระบุสมาชิก"
            },
            // tooltip_options: {
            //     "start_date": {
            //         trigger: 'focus'
            //     },
            // },
        });
    });
    $(document).on("change", "#fil_report", function() {
        $("#bydate").show();
        var x = $("#fil_report").val();
        if (x == 'br_res_All' || x == 'fine_byuser') {
            // $("#enddate").hide();
            $("#txt-since").html('วันที่');
            $("#subfilreport").hide();
            $("#subtypereport").hide();
            $("#bydate").show();
            $("#startdate").show();
            $("#startmonth").hide();
            $("#startyear").hide();
            $("#member-info").hide();
            // $("#startquarter").hide();
        } else if (x == 'br_res_percent') {
            $("#subfilreport").show();
            $("#subfil_report").val('bydate');
            $("#txt-since").html('วันที่');
            $("#subtypereport").hide();
            $("#startdate").show();
            $("#startmonth").hide();
            $("#startyear").hide();
            $("#member-info").hide();
            $("#enddate").hide();
            $("#bydate").show();
        } else if (x == 'purchase_report') {
            $("#subfilreport").show();
            $("#subfil_report").val('bydate');
            $("#txt-since").html('วันที่');
            $("#subtypereport").hide();
            $("#startdate").show();
            $("#startmonth").hide();
            $("#startyear").hide();
            $("#member-info").hide();
            $("#enddate").hide();
            $("#bydate").show();
        } else if (x == 'br_res_byuser') {
            $("#subfilreport").show();
            $("#subfil_report").val('bydate');
            $("#subtypereport").hide();
            $("#bydate").show();
            $("#txt-since").html('วันที่');
            $("#startdate").show();
            $("#startmonth").hide();
            $("#startyear").hide();
            $("#mem-info").val('');
            $("#member-info").show();
        } else if (x == 'fine_day_bylib') {
            $("#subfilreport").show();
            $("#subfil_report").val('bydate');
            $("#subtypereport").hide();
            $("#bydate").show();
            $("#txt-since").html('วันที่');
            $("#startdate").show();
            $("#startmonth").hide();
            $("#startyear").hide();
            $("#mem-info").val('');
            $("#mem-name").val('ชื่อ-สกุล');
            $("#member-info").show();
        } else if (x == 'index_journal') {
            $("#subtypereport").hide();
            $("#bydate").show();
            $("#subfilreport").show();
            $("#subfil_report").val('bydate');
            $("#txt-since").html('วันที่');
            $("#startdate").show();
            $("#startmonth").hide();
            $("#startyear").hide();
            $("#member-info").hide();
        } else if (x == 'rec_all_res') {
            $("#subtypereport").hide();
            $("#bydate").show();
            $("#subfilreport").show();
            $("#subfil_report").val('bydate');
            $("#txt-since").html('วันที่');
            $("#startdate").show();
            $("#startmonth").hide();
            $("#startyear").hide();
            $("#member-info").hide();
        } else if (x == 'list_res') {
            $("#subfilreport").show();
            $("#subfil_report").val('bydate');
            $("#txt-since").html('วันที่');
            $("#subtypereport").hide();
            $("#startdate").show();
            $("#startmonth").hide();
            $("#startyear").hide();
            $("#member-info").hide();
            $("#enddate").hide();
            $("#bydate").show();
        } else if (x == 'list_res_bylib') {
            $("#subtypereport").hide();
            $("#bydate").show();
            $("#subfilreport").show();
            $("#subfil_report").val('bydate');
            $("#txt-since").html('วันที่');
            $("#startdate").show();
            $("#startmonth").hide();
            $("#startyear").hide();
            $("#mem-info").val('');
            $("#mem-name").val('ชื่อ-สกุล');
            $("#member-info").show();
        } else {
            // $("#enddate").show();
            $("#subtypereport").hide();
            $("#bydate").show();
            $("#subfilreport").show();
            $("#subfil_report").val('bydate');
            $("#txt-since").html('วันที่');
            $("#startdate").show();
            $("#startmonth").hide();
            $("#startyear").hide();
            $("#mem-info").val('');
            $("#member-info").show();
        }
    });
    $(document).on("change", "#subfil_report", function() {
        var fil_date = $("#subfil_report").val();
        var fil_report = $("#fil_report").val();
        if (fil_report == 'fine_day_bylib' || fil_report == 'br_res_percent' || fil_report == 'list_res' || fil_report == 'purchase_report') {
            if (fil_date == 'bydate') {
                $("#txt-since").html('วันที่');
                $("#startdate").show();
                $("#startmonth").hide();
                $("#startyear").hide();
            } else if (fil_date == 'byperiod') {
                $("#txt-since").html('ปีที่');
                $("#startdate").hide();
                $("#startmonth").hide();
                $("#startyear").show();
            } else if (fil_date == 'byyear') {
                $("#txt-since").html('');
                $("#startdate").hide();
                $("#startmonth").hide();
                $("#startyear").hide();
            } else {
                $("#startdate").hide();
                $("#startmonth").hide();
                $("#startyear").hide();
            }
        } else {
            if (fil_date == 'bydate') {
                $("#txt-since").html('วันที่');
                $("#startdate").show();
                $("#startmonth").hide();
                $("#startyear").hide();
                // $("#startquarter").hide();
            } else if (fil_date == 'byperiod') {
                $("#txt-since").html('เดือนที่');
                $("#startdate").hide();
                $("#startmonth").show();
                $("#startyear").hide();
                // $("#startquarter").hide();
            } else if (fil_date == 'byyear') {
                $("#txt-since").html('ปีที่');
                $("#startdate").hide();
                $("#startmonth").hide();
                $("#startyear").show();
                // $("#startquarter").hide();
            } else {
                $("#startdate").hide();
                $("#startmonth").hide();
                $("#startyear").hide();
                // $("#startquarter").show();
            }
        }
    });
    $(document).on("change", "#subtype_report", function() {
        var str = $("#subtype_report").val();
        if (str == "bycalendar") {
            $("#subfil_report").val('byperiod');
            $("#txt-since").html('ปีที่');
            $("#startdate").hide();
            $("#startmonth").hide();
            $("#startyear").show();
            $("#bydate").hide();
        } else {
            $("#bydate").show();
        }
    });
    $(document).on("click", "#on_go", function() {
        var getfil_report = $("#fil_report").val();
        var getsubfil_report = $("#subfil_report").val();
        var getsubtype_report = $("#subtype_report").val();
        var getstartdate = $("#start_date").val();
        var getstartmonth = $("#start_month").val();
        var getstartyear = $("#start_year").val();
        var getenddate = $("#end_date").val();
        var getmemberinfo = $("#mem-info").val();
        if ((getfil_report == 'fine_day_bylib' || getfil_report == 'list_res_bylib') && (getmemberinfo == '' || getmemberinfo == 'โปรดระบุรหัสประจำตัวสมาชิก')) {
            $("#reportform").valid();
            return false;
        }
        $.ajax({
            url: "ShowReportDetail.php",
            data: {
                reporttype: getfil_report,
                subreporttype: getsubfil_report,
                subsourcetype: getsubtype_report,
                startdate: getstartdate,
                startmonth: getstartmonth,
                startyear: getstartyear,
                memberinfo: getmemberinfo,
                enddate: getenddate
            },
            type: "POST",
            success: function(data) {
                console.log(data);
                $("#ShowReportDetail").html(data);

            },
            error: function(e) {
                console.log(e);
                alert("something wrong!");
            }
        });
    });
    $(document).on("click", "#btngoinfo", function() {
        var getkeyword = $("#mem-info").val();
        var getfil_report = $("#fil_report").val();
        var gettype = "";
        if (getfil_report == 'fine_day_bylib' || getfil_report == 'list_res_bylib') {
            gettype = "Staff";
        } else {
            gettype = "Member";
        }
        $.ajax({
            url: "AllReport/getmemberinfo.php",
            data: {
                meminfo: getkeyword,
                memtype: gettype
            },
            type: "POST",
            success: function(data) {
                console.log(data);
                $("#meminfobody").html(data);
                var myModal = $("#meminfomodal");
                myModal.modal();
            },
            error: function(e) {
                console.log(e);
                alert("something wrong!");
            }
        });
        // return window.open("AllReport/getmemberinfo.php?meminfo=" + getkeyword + "&memtype=" + gettype, "_blank", "scrollbars=yes,top=30,left=100,width=1000,height=600");
    });

    function pickuser(id, name) {
        $("#mem-info").val(id);
        $("#mem-name").val(name);
        $(".close").click();
    };
    $(document).keydown(function(e) {
        //ESC pressed
        if (e.keyCode == 27) {
            $(".close").click();
        }
    });
</script>
<!-- <style>
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }
    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }
    tr:nth-child(even) {
    background-color: #dddddd;
    }
</style> -->
<br><br><br>
<section class="container">
    <div class="row" style="padding-top: 20px;padding-bottom: 200px; background-color: #eee;">
        <div class="col-md-12">
            <a href="../librarian/librarian.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
             &nbsp;&nbsp;<b style="font-size: 25px;">ทำรายการออกรายงาน</b><br>
            <div class="container">
                <!-------Modal--------->
                <div class="modal fade modal1" id="meminfomodal" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div>
                                    <h3>กรุณาเลือกสมาชิก</h3>
                                </div>
                            </div>
                            <div class="modal-body" id="meminfobody">
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>
                <!-------endModal------>
                <div>
                    <h1>รายงาน</h1>
                    <div class="col-md-12">
                        <form class="form" action="reporting.php" method="post" id="reportform">
                            <table class="table">
                                <tr>
                                    <td>ประเภทรายงาน</td>
                                    <td>
                                        <select id="fil_report" class="btn btn-white" name="fil_report">
                                            <option value="br_res_All" selected>รายงานสถิติการยืมทรัพยากรของผู้ใช้</option>
                                            <option value="br_res_percent">รายงานสถิติการยืมทรัพยากรเป็นร้อยละ</option>
                                            <option value="purchase_report">รายงานการซื้อทรัพยากร</option>
                                            <option value="fine_byuser">รายงานการชำระค่าปรับรายคน</option>
                                            <!-- <option value="br_res_byuser">รายงานสถิติการยืมทรัพยากรของผู้ใช้</option> -->
                                            <!-- <option value="fine_day_byuser">รายงานการชำระค่าปรับ ที่จ่ายประจำวัน รายคน</option> -->
                                            <option value="fine_day_bylib">รายงานสรุปการชำระค่าปรับ(แยกตามผู้รับ)</option>
                                            <option value="index_journal">รายงานดัชนีบทความวารสาร</option> 
                                            <option value="rec_all_res">รายงานสรุปการลงวารสาร</option>
                                            <option value="list_res">รายงานสถิตการทำรายการทรัพยากร</option>
                                            <option value="list_res_bylib">รายงานสถิติงานจัดทำรายการแยกตามชื่อพนักงาน</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr hidden id="member-info">
                                    <td>ระบุข้อมูลสมาชิก</td>
                                    <td>
                                        <input type="text" class="btn btn-white" id="mem-info" placeholder="โปรดระบุรหัสประจำตัวสมาชิก" required>
                                        <input type="text" class="btn btn-white" id="mem-name" placeholder="ชื่อ-สกุล" disabled>
                                        <input type="button" class="btn btn-info" value="ตรวจสอบ" id="btngoinfo">
                                    </td>
                                </tr>
                                <tr hidden id="subfilreport">
                                    <td>ประจำ</td>
                                    <td>
                                        <select class="btn btn-white" name="subfil_report" id="subfil_report">
                                            <option selected value="bydate" id="bydate">รายวัน</option>
                                            <option value="byperiod">รายเดือน</option>
                                            <option value="byyear">รายปี</option>
                                            <!-- <option value="byquarter">รายไตรมาส</option> -->
                                        </select>
                                    </td>
                                </tr>
                                <tr hidden id="subtypereport">
                                    <td>แยกตาม</td>
                                    <td>
                                        <select class="btn btn-white" name="subtype_report" id="subtype_report">
                                            <option value="bycalendar">ปฏิทิน</option>
                                            <option value="byddc">หมวดหมู่หนังสือ</option>
                                            <option selected value="bysourcetype">ประเภทวัสดุ</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td id="txt-since">วันที่</td>
                                    <td>
                                        <div id="startdate">
                                            <input type="text" class="btn btn-white form-control" style="background-color:#fff" name="start_date" id="start_date" data-zdp_show_clear_date="false" required>
                                        </div>
                                        <span hidden id="startmonth">
                                            <input hidden type="text" class="btn btn-white form-control" style="background-color:#fff" name="start_month" data-zdp_show_clear_date="false" id="start_month" required>
                                        </span>
                                        <span hidden id="startyear">
                                            <input hidden type="text" class="btn btn-white form-control" style="background-color:#fff" name="start_year" data-zdp_show_clear_date="false" id="start_year" required>
                                        </span>
                                        <!-- <span hidden id="startyear">
                                            <input hidden type="number" min="1900" max="2099" step="1" value="2019" class="btn btn-white" name="start_year" id="start_year">
                                        </span> -->
                                        <!-- <span hidden id="startquarter">
                        <input hidden type="text" class="btn btn-white" name="start_quarter" id="start_quarter">
                    </span> -->
                                        <span hidden id="enddate">&nbsp;ถึง &nbsp;
                                            <input type="date" class="btn btn-white" name="end_date" id="end_date">
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <!-- <input id="on_go" class="btn btn-primary send-email" type="button" value="แสดงรายงาน"> -->
                                        <button type="button" class="btn btn-primary send-email" id="on_go">แสดงรายงาน</button>
                                        <button type="reset" class="btn btn-default">ล้างค่า</button>
                                    </td>
                                </tr>

                            </table>
                        </form>

                        <!-- Show Report Areas -->
                        <div>
                            <hr style="border-top: 2px solid #b1b1b1;">
                            <button id="print_b" style="float: right;margin-top: -15px;font-size:18px;font-family: sans-serif;"><i class="fa fa-print" style="font-family: 'Font Awesome 5 Free';font-weight: 900;"></i> Print.</button>
                        </div>
                        <div class="col-md-12" id="ShowReportDetail">
                            <h4>กรุณเลือกประเภทรายงานที่ต้องการ</h4>
                        </div>
                        <?php include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php"; ?>

                        <script>
                            var input = document.getElementById("mem-info");
                            input.addEventListener("keyup", function(event) {
                                if (event.keyCode === 13) {
                                    event.preventDefault();
                                    document.getElementById("btngoinfo").click();
                                }
                            });
                            $('#start_date').Zebra_DatePicker({
                                format: 'Y-m-d',
                                todayBtn: "linked"
                            }).val(dateday);
                            $('#start_month').Zebra_DatePicker({
                                format: 'Y-m',
                                view: 'months'
                            }).val(datemonth);
                            $('#start_year').Zebra_DatePicker({
                                format: 'Y',
                                view: 'years'
                            }).val(dateyear);
                            
                            $('#print_b').on('click', function() {
                                var divContents = document.getElementById('ShowReportDetail').outerHTML;
                                var title_report = document.getElementById('fil_report').options[document.getElementById('fil_report').selectedIndex].text;

                                var printWindow = window.open('', '', 'height=700,width=1050,scrollbars=1');
                                //สร้าง popup
                                printWindow.document.write('<html><head><title>' + title_report + '</title>');
                                printWindow.document.write('<link href="TableCSS.css" rel="stylesheet" type="text/css" />'); //css path  
                                printWindow.document.write('</head><body onLoad="self.print();self.close();">');
                                // สั่ง Print เมื่อ reder เสร็จ
                                printWindow.document.write(divContents);
                                printWindow.document.write('</body></html>');
                                printWindow.document.close();
                                //printWindow.print();   print แบบนี้มีปัญหา run ไม่ได้ทุก Browser
                            });
                        </script>
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
                    <img src="<?=$url_path?>assets/upload/logo/web_footer_20170911140318.png" class="rmutl-web-logo-footer img-responsive">
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
<input type="hidden" id="service_base_url" value="<?= $url_path ?>index.php">
<script src="<?=$url_path?>assets/js/jquery.dcjqaccordion.min.js" type="text/javascript"></script>
<script src="<?=$url_path?>assets/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?=$url_path?>assets/js/home.min.js" type="text/javascript"></script>

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
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";
?>