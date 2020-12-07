<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
?>

<section class="container main-container">
    <div class="row" style="padding-top: 20px;padding-bottom: 100px; background-color: #eee;">

        <div class="col-md-12">
            <a href="/lib/view/librarian/add.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
            &nbsp;&nbsp;<b style="font-size: 25px;">สร้างเทมเพลต</b><br><br><br>
            <link type="text/css" rel="stylesheet" href="/lib/css/jquery.autocomplete.css" />
            <link type="text/css" rel="stylesheet" href="/lib/css/jquery.autocomplete.css" />


                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label class="control-label" for="pwd">ชื่อระเบียน:</label>
                            <input type="text" class="form-control" placeholder="โปรดระบุชื่อระเบียน" name="temp_name" id="temp_name" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label class="control-label " for="pwd">ประเภทระเบียน:</label>
                                <input type="text" class="form-control" placeholder="โปรดระบุประเภทระเบียน " name="temp_type" autocomplete="off" />
                            </div>
                            <div class="col-md-12">
                                <br>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label class="control-label " for="pwd">คำอธิบายเพิ่มเติม:</label>
                                    <textarea class="form-control" placeholder="โปรดระบุคำอธิบายเพิ่มเติม" name="temp_descript" autocomplete="off" ></textarea>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>
                            <br>
                            <br>

                            <div class="row">


                            </div>

                            <br>
                            <br>
                            <fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em;">
                                <legend style="width: auto;padding:0 5px 0 5px;">รายละเอียดของระเบียน</legend>
                                <br>
                                <div class="col-md-12">

                                    <div class="col-sm-4">
                                        <button class="btn_add btn btn-primary" type="button">เพิ่มรายการเขตข้อมูลของระเบียน</button>
                                    </div>
                                    <!-- <div class="col-sm-4">
                                        <center><input type="text" class="form-control" value="#####nam##22######a#4500" id="leader" name="leader" size="25">
                                    </div>
                                    <button type="button" class="leaderModal btn btn-primary">แก้ไข</button> -->


                                    <br><br>
                                        <center>
                                            <table class="table table_main">
                                                <thead>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </center>

                                        <center> 
                                            <input type="button" name="save" class="save_main btn btn-success" value="บันทึก"> 
                                        </center>

            <br>
            <br>
            <br>
            </fieldset>


            <div class="container">
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="row">
    </div>
    <footer>
        <div class="row">

        </div>
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
    </div>
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
<input type="hidden" id="service_base_url" value="https://library.rmutl.ac.th/">
<script src="https://library.rmutl.ac.th/assets/js/jquery.dcjqaccordion.min.js" type="text/javascript"></script>
<script src="https://library.rmutl.ac.th/assets/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="https://library.rmutl.ac.th/assets/js/home.min.js" type="text/javascript"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-87588904-9"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments)
    };
    gtag('js', new Date());

    gtag('config', 'UA-87588904-9');
</script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->

<!----------------------------------------------------------------------------------------------------------->
<div class="modal fade" id="modal_set" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content"  style="
    width: 800;
    left: -130;
">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel"></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class='table_modal_inc order1'>
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <table class='table_modal_inc order2'>
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <table class='table_modal_sub'>
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn_save btn btn-primary btn_save">บันทึก</button>
                </div>
            </div>
        </div>
    </div>

<!-- leader modal
<div class="modal fade modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div style="  background-color: #FAFAD2;">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">แก้ไข Leader</h2>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <table>
                        <tr>
                            <th><label>REC LENGTH</label>
                                <input type="text" name="leader[]" class="REC_LENGTH form-control ">
                            </th>

                            <th><label>REC STAT</label><br>
                                <select class="select REC_STAT form-control">
                                    <option title="Increase in encoding level" value="a">a</option>
                                    <option title="Corrected or revised" value="c">c</option>
                                    <option title="Deleted" value="d">d</option>
                                    <option title="New" value="n">n</option>
                                    <option title="Increase in encoding level from prepublication" value="p">p</option>
                                </select>
                            </th>
                            <th><label>REC TYPE</label><br>
                                <select class="select REC_TYPE form-control">
                                    <option title="Language material" value="a">a</option>
                                    <option title="Notated music" value="c">c</option>
                                    <option title="Manuscript notated music" value="d">d</option>
                                    <option title="Cartographic material" value="e">e</option>
                                    <option title="Manuscript cartographic material" value="f">f</option>
                                    <option title="Projected medium" value="g">g</option>
                                    <option title="Nonmusical sound recording" value="i">i</option>
                                    <option title="Musical sound recording" value="j">j</option>
                                    <option title="Two-dimensional nonprojectable graphic" value="k">k</option>
                                    <option title="Computer file" value="m">m</option>
                                    <option title="Kit" value="o">o</option>
                                    <option title="Mixed materials" value="p">p</option>
                                    <option title="Three-dimensional artifact or naturally occurring object" value="r">r</option>
                                    <option title="Manuscript language material" value="t">t</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th><label>BIB LEVEL</label><br>
                                <select class="select BIB_LEVEL form-control">
                                    <option title="Monographic component part" value="a">a</option>
                                    <option title="Serial component part" value="b">b</option>
                                    <option title="Collection" value="c">c</option>
                                    <option title="Submit" value="d">d</option>
                                    <option title="Integrating resource" value="i">i</option>
                                    <option title="Monograph/Item" value="m">m</option>
                                    <option title="Serial" value="s">s</option>
                                </select>
                            </th>
                            <th><label>ARC CTRL</label>
                                <select class="select ARC_CTRL form-control">
                                    <option title="No specified type" value="#">#</option>
                                    <option title="Archival" value="a">a</option>
                                </select>
                            </th>
                            <th><label>CHAR ENC</label>
                                <select class="select CHAR_ENC form-control">
                                    <option title="MARC-8" value="#">#</option>
                                    <option title="UCS/Unicode" value="a">a</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th><label>IND CNT</label>
                                <select class="select IND_CNT form-control">
                                    <option title="Number of character positions used for indicators" value="2">2</option>
                                </select>
                            </th>
                            <th><label>SFLD CNT</label>
                                <select class="select SFLD_CNT form-control">
                                    <option title="Number of character positions used for a subfield code" value="2">2</option>
                                </select>
                            </th>
                            <th><label>BASE ADDRESS</label>
                                <input type="text" name="leader[]" class="BASE_ADDRESS form-control">
                            </th>
                        </tr>
                        <tr>
                            <th><label>ENC LEVEL</label>
                                <select class="select ENC_LEVEL form-control">
                                    <option title="Full level" value="#">#</option>
                                    <option title="Full level, material not examined" value="1">1</option>
                                    <option title="Less-than-full level, material not examined" value="2">2</option>
                                    <option title="Abbreviated level" value="3">3</option>
                                    <option title="Core level" value="4">4</option>
                                    <option title="Partial (preliminary) level" value="5">5</option>
                                    <option title="Minimal level" value="7">7</option>
                                    <option title="Prepublication level" value="8">8</option>
                                    <option title="Unknown" value="u">u</option>
                                    <option title="Not applicable" value="z">z</option>
                                </select>
                            </th>
                            <th><label>CAT FORM</label>
                                <select class="select CAT_FORM form-control">
                                    <option title="Non-ISBD" value="#">#</option>
                                    <option title="AACR 2" value="a">a</option>
                                    <option title="ISBD punctuation omitted" value="c">c</option>
                                    <option title="ISBD punctuation included" value="i">i</option>
                                    <option title="Non-ISBD punctuation omitted" value="n">n</option>
                                    <option title="Unknown" value="u">u</option>
                                </select>
                            </th>
                            <th><label>LINKED REC</label>
                                <select class="select LINKED_REC form-control">
                                    <option title="Not specified or not applicable" value="#">#</option>
                                    <option title="Set" value="a">a</option>
                                    <option title="Part with independent title" value="b">b</option>
                                    <option title="Part with dependent title" value="c">c</option>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th><label>LEN FIELD</label><input type="text" name="leader[]" class="LEN_FIELD form-control"></th>
                            <th><label>LEN START</label><input type="text" name="leader[]" class="LEN_START form-control"></th>
                            <th><label>LINKED IMPL</label><input type="text" name="leader[]" class="LINKED_IMPL form-control"></th>
                        </tr>
                        <tr>
                            <th><label>UNDIFIND</label> <input type="text" name="leader[]" class="UNDIFIND form-control"></th>
                        </tr>
                    </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="save">บันทึก</button>
            </div>
        </div>
    </div>
</div> -->


<script>

    stack_num = $('input').parent().find('input[name="stack"]').val();
    var inc1_pos = null;
    var inc2_pos = null;
    var sub_pos = null;


    function toselect(obj) {
        var selector_text = $(obj).text();
        var find_parent = $(obj).parent();
        var find_parent_parent = find_parent.parent().find('input');
        $(find_parent_parent).val(selector_text)
        $(find_parent).html('')
    }


    function callajax1(deptid, obj) {
        // var deptid = $('#text1.tape').val();
        $.ajax({
            url: 'getTag.php',
            type: 'post',
            data: {
                key: deptid
            },
            success: function(response) {
                $(obj).html(response);
            }
        });
    }


    function callajax2(head, deptid, obj) {
        $.ajax({
            url: 'getIndicator.php',
            type: 'post',
            data: {
                depart: head,
                value: deptid
            },
            success: function(response) {
                $(obj).html(response);
            }
        });
    }

    // function callajax3(head, deptid, obj) {
    //     $.ajax({
    //         url: 'getSubfield.php',
    //         type: 'post',
    //         data: {
    //             depart: head,
    //             value: deptid
    //         },
    //         success: function(response) {
    //             $(obj).html(response);
    //         }
    //     });
    // }

    var r = 2;

    function temp_addInput() {
        var thead_length = $(document).find('.table_main thead').children().length;

        var stack = "";
        if (thead_length==0) {
            stack += "<tr>";
                stack += "<th>";
                    stack += "<b>เขตข้อมูล";
                stack += "</th>";
                stack += "<th>";
                    stack += "<b>ตัวบ่งชี้ที่1";
                stack += "</th>";
                stack += "<th>";
                    stack += "<b>ตัวบ่งชี้ที่2";
                stack += "</th>";
                stack += "<th>";
                    stack += "<b>เขตข้อมูลย่อย";
                stack += "</th>";
                stack += "<th>";
                    stack += "";
                stack += "</th>";
                stack += "<th>";
                    stack += "";
                stack += "</th>";
            stack += "</tr>";
            $('.table_main thead').append(stack);
        }

        var stack = "";

        stack += "<tr>";
            stack += "<td>";
                stack += "<input autocomplete='off'  type='text'  style='width: 100;' class='tape text_data form-control' name='field' />";
                stack += "<div class='append_ap'></div>";
            stack += "</td>";
            stack += "<td>";
                stack += "<input autocomplete='off' type='text'   style='width: 100;'  class='tape2 text_data form-control' name='inc1' disabled/>";
                stack += "<div class='append_ap'></div>";
            stack += "</td>";
            stack += "<td>";
                stack += "<input autocomplete='off' type='text'  style='width: 100;' class='tape2 text_data form-control' name='inc2' disabled/>";
                stack += "<div class='append_ap'></div>";
            stack += "</td>";
            stack += "<td>";
                stack += "<input autocomplete='off'  type='text'  style='width: 550;' class='tape3 text_data form-control' name='sub' disabled/>";
                stack += "<div class='append_ap'></div>";
            stack += "</td>";
            stack += "<td>";
                stack += "<button class='btn_edit btn btn-link' >แก้ไข</button>";
            stack += "</td>";
            stack += "<td>";
                stack += "<button class='btn_del btn btn-danger' >ลบ</button>";
            stack += "</td>";
        stack += "</tr>";
        $('.table_main tbody').append(stack)
    }


    function save_Temp() {
        window.open("/lib/controller/librarian/template/saveTemp.php", " ");
    }

    function load_field(field, inc1, inc2, sub) {
        $.ajax({
            url: 'ajax_load_field.php',
            type: 'post',
            data: {
                field: field,
            },
            success: function(response) {
                data_base = JSON.parse(response);
                show_edit(field, inc1, inc2, sub, data_base);
            }
        });
    }

    function show_edit(field, inc1, inc2, sub, data_base) {
        $('.modal-title').empty();
        $('.modal-title').append('เขตข้อมูล'+field);
        console.log(data_base);
        var check_inc1 = $('.table_modal_inc.order1 thead').children().length
        var check_inc2 = $('.table_modal_inc.order2 thead').children().length
        var check_sub = $('.table_modal_sub thead').children().length
        var stack = "";
        var has_inc1 = 0;
        var has_inc2 = 0;
        // if(sub.lent){
            
        // }
        sub = sub.split("/");
        for (let i = 0; i < sub.length; i++) {
            sub[i] = sub[i].split("=");
            sub[i][0] = sub[i][0].replace('$','#');
        }
        for (let i = 0; i < data_base[1].length; i++) {
            if (data_base[1][i]['Order']==1) {
                has_inc1 = 1;
            }
            else if(data_base[1][i]['Order']==2) {
                has_inc2 = 1;
            }
        }
        if (check_inc1 == 0 && has_inc1==1) {
            stack += "<tr>";
                stack += "<th>";
                    stack += "<b>ตำแหน่งที่1";
                stack += "</th>";
                stack += "<th>";
                    stack += "<b>ชื่อตัวบ่งชี้";
                stack += "</th>";
                stack += "<th>";
                    stack += "<b>ข้อมูลตัวบ่งชี้";
                stack += "</th>";
            stack += "</tr>";
            $('.table_modal_inc.order1 thead').append(stack)
            stack = "";
            for (let i = 0; i < data_base[1].length; i++) {
                if (data_base[1][i]['Order']==1) {
                    stack += "<tr>";
                        stack += "<td style='width: 140;'>";
                            stack += data_base[1][i]['Code'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += "<input type='text' style='width: 310;' class='form-control' value='" + data_base[1][i]['Description'] + "'  disabled>";
                            stack += "<input type='hidden' name='order' value='" + data_base[1][i]['Order'] + "' >";
                        stack += "</td>";
                        stack += "<td>";
                        if (data_base[1][i]['Code'] == inc1) {
                            stack += "<input type='checkbox' class='form-control modal_inc' name='inc1' value='" + data_base[1][i]['Code'] + "' checked >";
                        } else {
                            stack += "<input type='checkbox' class='form-control modal_inc' name='inc1' value='" + data_base[1][i]['Code'] + "'>";
                        }
                    stack += "</td>";
                    stack += "</tr>";
                }
            }
            $('.table_modal_inc.order1 tbody').append(stack)
            stack = "";
        }
        if (check_inc2 == 0 && has_inc2==1) {
            stack += "<tr>";
                stack += "<th>";
                    stack += "<b>ตำแหน่งที่2";
                stack += "</th>";
                stack += "<th>";
                    stack += "<b>ชื่อตัวบ่งชี้";
                stack += "</th>";
                stack += "<th>";
                    stack += "<b>ข้อมูลตัวบ่งชี้";
                stack += "</th>";
            stack += "</tr>";
            $('.table_modal_inc.order2 thead').append(stack)
            stack = "";
            for (let i = 0; i < data_base[1].length; i++) {
                if (data_base[1][i]['Order']==2) {
                    stack += "<tr>";
                        stack += "<td style='width: 140;'>";
                            stack += data_base[1][i]['Code'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += "<input type='text' style='width: 310;'  class='form-control' value='" + data_base[1][i]['Description'] + "'  disabled>";
                            stack += "<input type='hidden' name='order' value='" + data_base[1][i]['Order'] + "' >";
                        stack += "</td>";
                        stack += "<td>";
                        if (data_base[1][i]['Code'] == inc2) {
                            stack += "<input type='checkbox' style='width: 310;' class='form-control modal_inc' name='inc2' value='" + data_base[1][i]['Code'] + "' checked >";
                        } else {
                            stack += "<input type='checkbox' class='form-control modal_inc' name='inc2' value='" + data_base[1][i]['Code'] + "'>";
                        }
                    stack += "</td>";
                    stack += "</tr>";
                }
            }
            $('.table_modal_inc.order2 tbody').append(stack)
            stack = "";
        }
        
        if (check_sub == 0) {
            stack += "<tr>";
                stack += "<th>";
                    stack += "<b class='text-primary'>รหัสเขตข้อมูลย่อย &nbsp;";
                stack += "</th>";
                stack += "<th>";
                    stack += "<b>ชื่อเขตข้อมูลย่อย";
                stack += "</th>";
                stack += "<th>";
                    stack += "<b>ข้อมูลเขตข้อมูลย่อย";
                stack += "</th>";
            stack += "</tr>";
            $('.table_modal_sub thead').append(stack)
            stack = "";
            for (let i = 0; i < data_base[0].length; i++) {
                stack += "<tr>";
                    stack += "<td class='code text-primary' >";
                        stack += data_base[0][i]['Code'].replace("#", "$");
                    stack += "</td>";

                    stack += "<td>";
                        stack += "<input type='text' style='width: 310;' name='name_sub' class='form-control' value='" + data_base[0][i]['Name_Eng'] + "' disabled>";
                    stack += "</td>";
                stack += "<td>";
                var check = 0;
                for (let j = 0; j < sub.length; j++) {
                    if (data_base[0][i]['Code'] == sub[j][0]) {
                        stack += "<input type='text' style='width: 310;'class='modal_sub form-control' name='sub' value='" + sub[j][1] + "'>";
                        check = 1;
                    }
                }
                if (check == 0) {
                    stack += "<input type='text'style='width: 310;' class='modal_sub form-control' name='sub'>";
                }
                stack += "</td>";
                stack += "</tr>";
            }
            $('.table_modal_sub tbody').append(stack)
        }
    }

    $('#modal_set').on('show.bs.modal', function() {
        $('.table_modal_inc.order1 thead').empty();
        $('.table_modal_inc.order1  tbody').empty();
        $('.table_modal_inc.order2 thead').empty();
        $('.table_modal_inc.order2  tbody').empty();
        $('.table_modal_sub thead').empty();
        $('.table_modal_sub tbody').empty();
    });

    $('.table_main').on('click', '.btn_edit', function() {
        field = $(this).parent().parent().find('input[name=field]').val();
        inc1 = $(this).parent().parent().find('input[name=inc1]').val();
        inc1_pos = $(this).parent().parent().find('input[name=inc1]');
        inc2 = $(this).parent().parent().find('input[name=inc2]').val();
        inc2_pos = $(this).parent().parent().find('input[name=inc2]');
        sub = $(this).parent().parent().find('input[name=sub]').val();
        sub_pos = $(this).parent().parent().find('input[name=sub]');

        load_field(field,inc1,inc2,sub)
        $('#modal_set').modal('toggle');
    });

    $('.modal-footer').on('click', '.btn_save', function() {
        var temp = [];

        $(".modal_inc").each(function() {
            if ($(this).is(':checked')) {
                var temp_minor = [];
                temp_minor.push($(this).parent().parent().find('input[name=order]').val());
                temp_minor.push($(this).val());
                temp.push(temp_minor);
            }
        });

        for (let i = 0; i < temp.length; i++) {
            if (temp[i][0] == 1) {
                $(inc1_pos).val(temp[i][1]);
            } else if (temp[i][0] == 2) {
                $(inc2_pos).val(temp[i][1]);
            }
        }

        temp = [];
        $(".modal_sub").each(function() {
            if ($(this).val() != "") {
                var temp_minor = [];
                temp_minor.push($(this).parent().parent().find('.code').html());
                temp_minor.push($(this).val());
                temp_minor[0] = temp_minor[0].replace('$','#');
                temp.push(temp_minor);
            }
        });
        var sub = ""
        for (let i = 0; i < temp.length; i++) {
            sub += temp[i][0] + "=" + temp[i][1] + "/";
        }
        sub = sub.substr(0, sub.length - 1)

        for (let i = 0; i < sub.length; i++) {
            sub = sub.replace('#','$');
        }

        $(sub_pos).val(sub);
        $('#modal_set').modal('toggle');

    });

    $(document).on('keyup', '.tape', function(event) {
        var value = $(this).val();
        var append = $(this).parent().find('.append_ap');
        callajax1(value, append);
    });
    $(document).on('keyup', '.tape2', function(event) {
        var find_parent_parent = $(this).parent().parent();
        var find_tape_class = find_parent_parent.find('.tape').val();
        var value = $(this).val();
        var append = $(this).parent().find('.append_ap');
        callajax2(find_tape_class, value, append);
    });
    // $(document).on('keyup', '.tape3', function(event) {
    //     var find_parent_parent = $(this).parent().parent();
    //     var find_tape_class = find_parent_parent.find('.tape').val();
    //     var value = $(this).val();
    //     var append = $(this).parent().find('.append_ap');
    //     callajax3(find_tape_class, value, append);
    // });

    var arr_stack = [];
    var arr_tape = [];

    function save_temp(name,type,descript,arr_tape) {
        $.ajax({
            url: 'saveTemp.php',
            type: 'post',
            data: {
                temp_name: name,
                temp_type: type,
                temp_descript: descript,
                data: arr_tape,
            },
            success: function(response) {
                // console.log(response)
                alert('บันทึกสำเร็จ');
                location.reload();
            }
        });
    }

    $(document).on('click','.btn_add', function(){
        temp_addInput();
    });


    $(document).on('click', '.save_main', function(event) {
        arr_tape = [];
        $('.text_data').each(function(i) {
            arr_stack.push($(this).val());
            if (arr_stack.length == 4) {
                arr_tape.push(arr_stack);
                arr_stack = [];
            }
        });
        name = $(document).find('input[name="temp_name"]').val();
        type = $(document).find('input[name="temp_type"]').val();
        descript = $(document).find('textarea[name="temp_descript"]').val();

        save_temp(name,type,descript,arr_tape);
    });

    // $('.leaderModal').click(function() {
    //     var selector = $(this);
    //     var selector_parent = selector.parent();
    //     var value = selector_parent.find('#leader').val();

    //     var REC_LENGTH = value.substr(0, 5);
    //     $('.REC_LENGTH').val(REC_LENGTH)
    //     var REC_STAT = value.substr(5, 1);
    //     $('.REC_STAT').val(REC_STAT)
    //     var REC_TYPE = value.substr(6, 1);
    //     $('.REC_TYPE').val(REC_TYPE)
    //     var BIB_LEVEL = value.substr(7, 1);
    //     $('.BIB_LEVEL').val(BIB_LEVEL)
    //     var ARC_CTRL = value.substr(8, 1);
    //     $('.ARC_CTRL').val(ARC_CTRL)
    //     var CHAR_ENC = value.substr(9, 1);
    //     $('.CHAR_ENC').val(CHAR_ENC)
    //     var IND_CNT = value.substr(10, 1);
    //     $('.IND_CNT').val(IND_CNT)
    //     var SFLD_CNT = value.substr(11, 1);
    //     $('.SFLD_CNT').val(SFLD_CNT)
    //     var BASE_ADDRESS = value.substr(12, 5);
    //     $('.BASE_ADDRESS').val(BASE_ADDRESS)
    //     var ENC_LEVEL = value.substr(17, 1);
    //     $('.ENC_LEVEL').val(ENC_LEVEL)
    //     var CAT_FORM = value.substr(18, 1);
    //     $('.CAT_FORM').val(CAT_FORM)
    //     var LINKED_REC = value.substr(19, 1);
    //     $('.LINKED_REC').val(LINKED_REC)
    //     var LEN_FIELD = value.substr(20, 1);
    //     $('.LEN_FIELD').val(LEN_FIELD)
    //     var LEN_START = value.substr(21, 1);
    //     $('.LEN_START').val(LEN_START)
    //     var LINKED_IMPL = value.substr(22, 1);
    //     $('.LINKED_IMPL').val(LINKED_IMPL)
    //     var UNDIFIND = value.substr(23, 1);
    //     $('.UNDIFIND').val(UNDIFIND)

    //     $('.select .REC_STAT').val('REC_STAT');
    //     $('.select .REC_TYPE').val('REC_TYPE');


    //     var myModal = $('.modal1');
    //     myModal.modal();
    // })


    // $('#save').on('click', function() {
    //     var mix_val = ""
    //     mix_val = $('.REC_LENGTH').val()
    //     mix_val += $('.select.REC_STAT').val()
    //     mix_val += $('.select.REC_TYPE').val()
    //     mix_val += $('.select.BIB_LEVEL').val()
    //     mix_val += $('.select.ARC_CTRL').val()
    //     mix_val += $('.select.CHAR_ENC').val()
    //     mix_val += $('.select.IND_CNT').val()
    //     mix_val += $('.select.SFLD_CNT').val()
    //     mix_val += $('.BASE_ADDRESS').val()
    //     mix_val += $('.select.ENC_LEVEL').val()
    //     mix_val += $('.select.CAT_FORM').val()
    //     mix_val += $('.select.LINKED_REC').val()
    //     mix_val += $('.LEN_FIELD').val()
    //     mix_val += $('.LEN_START').val()
    //     mix_val += $('.LINKED_IMPL').val()
    //     mix_val += $('.UNDIFIND').val()

    //     $('#leader').val(mix_val);
    // });

    $('.table_main').on('click', '.btn_del', function() {
        var select = $(this);
        var parent = select.parent().parent();
        $(parent).remove();
        var tbody_length = $(document).find('.table_main tbody').children().length;

        if (tbody_length==0) {
            $('.table_main thead').empty();
        }
    });

    // $(document).ready(function() {
    //     $(document).on('mouseover', '.tape2', function() {
    //         $(this).prop("disabled", true);
    //         if ($(this).parent().parent().find('.tape').val() != '') {
    //             $(this).prop("disabled", false);
    //         }
    //     });
    // });
    // $(document).ready(function() {
    //     $(document).on('mouseover', '.tape3', function() {
    //         $(this).prop("disabled", true);
    //         if ($(this).parent().parent().find('.tape').val() != '') {
    //             $(this).prop("disabled", false);
    //         }
    //     });
    // });


    function closeMenu() {
        $('.valid_click').fadeOut(1);
    }

    $(document.body).click(function() {
        closeMenu();
    });

</script>



<style>
    .valid_click {
        cursor: pointer;
        border: 1px solid black
    }

    .valid_click:hover {
        background: lightblue
    }

    .append_ap {
        position: absolute;
        width: 10.7rem;
        background-color: white;
        z-index: 999;
    }
</style>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php"; ?>