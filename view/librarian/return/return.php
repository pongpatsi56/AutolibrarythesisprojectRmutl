<?php

    @session_start();
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/controller/librarian/cal_date.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/datehelper.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";

?>

    <br><br><br>
    <section class="container">
    <div class="row" style="padding-top: 20px;padding-bottom: 250px; background-color: #eee;">
        <div class="col-md-12">
        <a href="../../librarian/librarian.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
        &nbsp;&nbsp;<b style="font-size: 25px;">คืน</b><br>
        
        <fieldset style="border: 1px solid silver;margin: 0 1px;border-style:outset;border-color:FFFFCC;padding: .625em .625em .75em;margin: 0 100px; background-color:#ccc;">
            <div class="col-md-12">
                <div class="col-md-1">
                </div>
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <label >รหัสสมาชิก : </label>
                        </td>
                        <td>
                            <input placeholder="ใส่รหัสสมาชิกหรือคำเพิ่อค้นหา" type="text" class="form-control" name="text_member" id="text_member" autocomplete="off">
                        </td>
                        <td>
                            <button class="btn btn-primary btn_sel_mem" >เลือก</button>
                        </td>
                        <td>
                            <button class="btn btn-primary btn_find_mem" >ค้นหา</button>
                        </td>
                    </tr>
                    <tr>
                    <td>
                        <label >รหัสหนังสือ : </label>
                        </td>
                        <td>
                            <input placeholder="ใส่รหัสหนังสือ" type="text" class="form-control" name="text_book" autocomplete="off">
                        </td>
                        <td>
                            <button class="btn btn-primary btn_sel_book" >เลือก</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>

        <fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em;" class="mem_data">
				<legend style="width: auto;padding:0 5px 0 5px;">รายละเอียดสมาชิก</legend>
                <table>
                    <tbody>
                        <tr>
                            <td width = "7%">ชื่อ</td>
                            <td width = "18%"><input type="text" class="mem_fname form-control" disabled></td>
                            <td width = "7%">นามสกุล</td>
                            <td width = "18%"><input type="text" class="mem_lname form-control" disabled></td>
                            <td width = "7%">คณะ</td>
                            <td width = "18%"><input type="text" class="mem_fac form-control" disabled></td>
                        </tr>
                        </tr>
                            <td width = "7%">สาขา</td>
                            <td width = "18%"><input type="text" class="mem_major form-control" disabled></td>
                            <td width = "7%">เบอร์โทร</td>
                            <td width = "18%"><input type="text" class="mem_tel form-control"  disabled></td>
                            <td width = "7%">อีเมล</td>
                            <td width = "18%"><input type="text" class="mem_email form-control" disabled></td>
                        </tr>
                        <tr>
                            <td width = "7%">ที่อยุ่</td>
                            <td width = "18%"><textarea class="mem_address form-control" disabled></textarea></td>
                        </tr>
                    </tbody>
                </table>
        </fieldset>


        <fieldset class="menu" style="border: 1px solid silver;margin: 0 1px;border-style:outset;border-color:FFFFCC;padding: .625em .625em .75em;margin: 0 100px; background-color:#ccc;">
            <div class="col-md-12">
                <ul class="nav nav-pills">
                    <li class=""><a data-toggle="pill" href="#book_ret" style="font-family:kanit;">คืนหนังสือ</a></li>
                    <li class="active"><a data-toggle="pill" href="#book_due" style="font-family:kanit;">หนังสือค้าง</a></li>
                    <li class=""><a data-toggle="pill" href="#book_his" style="font-family:kanit;">ประวัติการยืม</a></li>
                </ul>
            </div>
        </fieldset>
<!-----------------------------tab_fade_menu------------------------------------------------->
<div class="tab-content">
    <div id="book_due" class="tab-pane fade in active">
        <table class="table table_book_due">
            <thead>
                <tr>
                    <th>
                        ลำดับ
                    </th>
                    <th>
                        ชื่อทรัพยากร
                    </th>
                    <th>
                        วันที่ยืม
                    </th>
                    <th>
                        กำหนดคืน
                    </th>
                    <th>
                        เกินกำหนด(วัน)
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div id="book_his" class="tab-pane fade">
        <table class="table table_book_his">
            <thead>
                <tr>
                    <th>
                        ลำดับ
                    </th>
                    <th>
                        ชื่อทรัพยากร
                    </th>
                    <th>
                        วันที่ยืม
                    </th>
                    <th>
                        วันที่คืน
                    </th>
                    <th>
                        สถานะค่าปรับ
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <button type="button" class="btn_his_ppat_back btn btn-primary" >ย้อนกลับ</button>
        <input type="text" class="text_his_ppat_now" value="">
        <input type="text" class="text_his_ppat_all" disabled>
        <button type="button" class="btn_his_ppat_next btn btn-primary" >ต่อไป</button>
    </div>

    <div id="book_ret" class="tab-pane fade">
        <table class="table table_book_ret">
            <thead>
                <tr>
                    <th>
                        ลำดับ
                    </th>
                    <th>
                        ชื่อทรัพยากร
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <center><button class="save_ret btn btn-primary">บันทึก</button></center>
    </div>

</div>
<!-----------------------------tab_fade_menu------------------------------------------------->


<!-----------------------------modal_find_member------------------------------------------------->
<div class="modal fade" id="modal_find_mem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin: center;margin-left: 18%;">
        <div class="modal-content" style="  width:150%; position:relative ;">
            <div style="  background-color: #FAFAD2;">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">รายการค้นหา</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="no_info"><center><h3>ไม่พบข้อมูล</h3></center></div>
                    <table class='table_find_mem table'>
                        <thead>
                            <tr>
                                <th scope="col" width = "20%"> <div align='center'>รหัสประจำตัว</div></th>
                                <th scope="col" width = "30%" ><div align='center'>ชื่อ-นามสกุล</div></th>
                                <th width = "15%"><div align='center'>คณะ</div></th>
                                <th width = "15%"><div align='center'>สาขา</div></th>
                                <th width = "10%"><div align='center'>เบอร์โทร</div></th>
                                <th width = "10%"><div align='center'>อีเมล</div></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                <div align='center' class="ppat">
                    <button type="button" class="btn_ppat_back btn btn-primary" >ย้อนกลับ</button>
                    <input type="text" class="text_ppat_now" value="">
                    <input type="text" class="text_ppat_all" disabled>
                    <button type="button" class="btn_ppat_next btn btn-primary" >ต่อไป</button>
                </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn_save btn btn-primary">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
<!-----------------------------modal_find_member------------------------------------------------->


    <script>

        var data_mem = [];
        var book = [];
        var all_page = 0;
        var all_now = 0;
        var page_1 = 0;
        var page_2 = 0;
        var his_all_page = 0;
        var his_all_now = 0;
        var his_page_1 = 0;
        var his_page_2 = 0;
        var mem_main = [];
        var book_main = {};
        var data_book_ret= [];
        var count_book_ret = 1;

        $(document).ready(function(){
            $('.mem_data').hide();
            $('.menu').hide();
        })

        Object.size = function(obj) {
            var size = 0,
                key;
            for (key in obj) {
                if (obj[key].length != 0) size++;
            }
            return size;
        };

        function ajax_find_mem(val) {
            $.ajax({
            url: 'ajax_find_mem.php',
            type: 'post',
            data: {
                data: val,
            },
            success: function(response) {
                // console.log(response)
                if (response!="") {
                    data_mem = JSON.parse(response);
                    // console.log(data_mem)
                        table_find_mem();
                        $('#modal_find_mem').modal('toggle');
                }
                else{
                    data_mem = [];
                    $('.mem_data').hide();
                    $('.menu').hide();
                    table_find_mem();
                    $('#modal_find_mem').modal('toggle');
                }
                
            }
            });
        }

        function append_table_find_mem(start,stop){
            var stack = "";
            $('.table_find_mem tbody').empty();
            if (stop>data_mem.length) {
                for (let i = start; i < data_mem.length; i++) {
                    stack += "<tr>";
                        stack += "<td class='target_mem_id'>";
                            stack += data_mem[i]['ID'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += "<a class='sel_mem_id' >";
                                stack += data_mem[i]['FName']+"  "+data_mem[i]['LName'];
                            stack += "</a>";
                        stack += "</td>";
                        stack += "<td>";
                            stack += data_mem[i]['Faculty'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += data_mem[i]['Major'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += data_mem[i]['Tel'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += data_mem[i]['Email'];
                        stack += "</td>";
                    stack += "</tr>";
                }
                for (let i = data_mem.length; i < stop; i++) {
                    stack += "<tr>";
                        stack += "<td class='target_mem_id'>";
                        stack += "</td>";
                        stack += "<td>";
                            stack += "<a class='sel_mem_id' >";
                            stack += "</a>";
                        stack += "</td>";
                        stack += "<td>";
                        stack += "</td>";
                        stack += "<td>";
                        stack += "</td>";
                        stack += "<td>";
                        stack += "</td>";
                        stack += "<td>";
                        stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_find_mem tbody').append(stack);
            }
            else{
                for (let i = start; i < stop; i++) {
                    stack += "<tr>";
                        stack += "<td class='target_mem_id'>";
                            stack += data_mem[i]['ID'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += "<a class='sel_mem_id' >";
                                stack += data_mem[i]['FName']+"  "+data_mem[i]['LName'];
                            stack += "</a>";
                        stack += "</td>";
                        stack += "<td>";
                            stack += data_mem[i]['Faculty'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += data_mem[i]['Major'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += data_mem[i]['Tel'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += data_mem[i]['Email'];
                        stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_find_mem tbody').append(stack);
            }
        }

        function append_table_his(start,stop){
            $('.table_book_his tbody').empty();
            var stack = "";
            console.log(book_main);
            if (stop>book_main[0].length) {
                for (let i = start; i < book_main[0].length; i++) {
                    stack += "<tr>";
                        stack += "<td>";
                            stack += "<center>"+(i+1)+"<center>";
                        stack += "</td>";
                        stack += "<td>";
                        for (j in book_main[1]) {
                            if (j==book_main[0][i]['Book']) {
                                stack += book_main[1][j][245]['Subfield'];
                            }    
                        }
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[0][i]['Borrow'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[0][i]['Due'];
                        stack += "</td>";
                        stack += "<td>";
                        if (book_main[0][i]['Due_Status']==null) {
                            stack += "-";
                        }
                        else if(book_main[0][i]['Due_Status']==0){
                            stack += "ยังไม่ได้ชำระ";
                        }
                        else if(book_main[0][i]['Due_Status']==1){
                            stack += "ชำระแล้ว";
                        }
                        stack += "</td>";
                    stack += "</tr>";
                }
                for (let i = book_main[0].length; i < stop; i++) {
                    stack += "<tr>";
                        stack += "<td>";
                        stack += "</td>";
                        stack += "<td>";
                        stack += "</td>";
                        stack += "<td>";
                        stack += "</td>";
                        stack += "<td>";
                        stack += "</td>";
                        stack += "<td>";
                        stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_book_his tbody').append(stack);
            }
            else{
                for (let i = start; i < stop; i++) {
                    stack += "<tr>";
                        stack += "<td>";
                            stack += "<center>"+(i+1)+"<center>";
                        stack += "</td>";
                        stack += "<td>";
                        for (j in book_main[1]) {
                            if (j==book_main[0][i]['Book']) {
                                stack += book_main[1][j][245]['Subfield'];
                            }    
                        }
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[0][i]['Borrow'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[0][i]['Due'];
                        stack += "</td>";
                        stack += "<td>";
                        if (book_main[0][i]['Due_Status']==null) {
                            stack += "-";
                        }
                        else if(book_main[0][i]['Due_Status']==0){
                            stack += "ยังไม่ได้ชำระ";
                        }
                        else if(book_main[0][i]['Due_Status']==1){
                            stack += "ชำระแล้ว";
                        }
                        stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_book_his tbody').append(stack);
            }
        }

        function table_find_mem(){
            var stack = "";
            var count = data_mem.length;
            if (count==0) {
                $('.table_find_mem').hide();
                $('.no_info').show();
                $('.ppat').hide();
            }
            if (count!=0) {
                $('.table_find_mem').show();
                $('.ppat').show();
                $('.no_info').hide();
                $('.show').hide();
                all_page = Math.ceil(count/8);
                $('.text_ppat_all').val(all_page)
                $('.text_ppat_now').val(1)
                now_page = $('.text_ppat_now').val();
                if (now_page==1) {
                    $('.btn_ppat_back').prop("disabled", true)
                }
                page_1=0;
                page_2=8;
                append_table_find_mem(page_1,page_2)
            }
        }

        function show_mem_data() {
            $('.mem_data').show();
            $('.mem_data').find('.mem_fname').val(mem_main[0]['FName']);
            $('.mem_data').find('.mem_lname').val(mem_main[0]['LName']);
            $('.mem_data').find('.mem_fac').val(mem_main[0]['Faculty']);
            $('.mem_data').find('.mem_major').val(mem_main[0]['Major']);
            $('.mem_data').find('.mem_tel').val(mem_main[0]['Tel']);
            $('.mem_data').find('.mem_email').val(mem_main[0]['Email']);
            $('.mem_data').find('.mem_address').val(mem_main[0]['Address']);
        }

        function show_book_ret(book_ret){
            var stack = "";
            data_book_ret.push(book_ret)
            console.log(data_book_ret);
            stack += "<tr>";
                stack += "<td class='find_book_count' ><center>";
                    stack += count_book_ret;
                stack += "</center></td>";
                stack += "<td class='find_book_name'>";
                    stack += book_ret['Subfield'];
                stack += "</td>";
                stack += "<td>";
                    stack += "<button class='btn_cancel_ret btn btn-primary' >ยกเลิก</button>";
                stack += "</td>";
            stack += "</tr>";
            count_book_ret++;
            $('.table_book_ret tbody').append(stack);
        }

        function show_ret() {
            var stack = "";
            var count = 1;
            $('.table_book_due tbody').empty();
            $('.table_book_his tbody').empty();
            // console.log(book_main)
            for (i in book_main[0]) {
                if (book_main[0][i]['Due']=="-") {
                    stack += "<tr>";
                        stack += "<td>";
                            stack += "<center>"+count+"<center>";
                        stack += "</td>";
                        stack += "<td>";
                        for (j in book_main[1]) {
                            if (j==book_main[0][i]['Book']) {
                            stack += "<a class='btn_ret' value='"+book_main[0][i]['Book']+"'>"+book_main[1][j][245]['Subfield']+"</a>";
                            }    
                        }
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[0][i]['Borrow'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[0][i]['Returns'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[0][i]['datediff'];
                        stack += "</td>";
                    stack += "</tr>";
                    count ++;
                }
            }
            $('.table_book_due tbody').append(stack);
                
            his_all_page = Math.ceil(book_main[0].length/10);
            $('.text_his_ppat_all').val(his_all_page)
            $('.text_his_ppat_now').val(1)
            his_now_page = $('.text_his_ppat_now').val();
            if (his_now_page==1) {
                $('.btn_his_ppat_back').prop("disabled", true)
            }
            his_page_1=0;
            his_page_2=10;
            append_table_his(his_page_1,his_page_2);
        }

        function ajax_data_mem(val) {
            $.ajax({
                url: 'ajax_data_mem.php',
                type: 'post',
                data: {
                    data: val,
                },
                success: function(response) {
                    // console.log(response)
                    if (response!="") {
                        mem_main = JSON.parse(response);
                        // console.log(mem_main)
                        show_mem_data();
                        clear_book_ret();
                        ajax_find_his();
                        $('.menu').show();
                        // $('#book_due').attr('.in.active');
                    }
                    else{
                        clear_book_ret();
                        $('.mem_data').hide();
                        $('.menu').hide();
                        alert('ไม่พบรหัสผู้ใช้งานกรุณาใส่รหัสใหม่หรือค้นหาผู้ใช้ที่ถูกต้องด้วยปุ่มค้นหา');
                    }
                } 
            });
        }

        function ajax_book_mem(val) {
            $.ajax({
                url: 'ajax_book_mem.php',
                type: 'post',
                data: {
                    data: val,
                },
                success: function(response) {
                    // console.log(response)
                    if (response!="") {
                        $('.btn_sel_book').parent().parent().find("input[name='text_book']").val("");
                        mem_main = JSON.parse(response);
                        // console.log(mem_main)
                        show_mem_data();
                        clear_book_ret();
                        ajax_find_his();
                        ajax_book_ret(mem_main[0]['ID'],val);
                        $('.menu').show();
                    }
                    else{
                        alert('ไม่พบรหัสหนังสือกรุณาใส่รหัสใหม่');
                    }
                } 
            });
        }

        function ajax_find_his() {
            $.ajax({
                url: 'ajax_find_his.php',
                type: 'post',
                data: {
                    data: mem_main,
                },
                success: function(response) {
                    // console.log(response)
                    if (response!="") {
                        book_main = JSON.parse(response);
                        show_ret();
                        // console.log(book_main)
                    }
                    else{

                    }
                } 
            });
        }

        function ajax_save_ret() {
            $.ajax({
                url: 'ajax_save_ret.php',
                type: 'post',
                data: {
                    mem: mem_main[0],
                    data: data_book_ret,
                },
                success: function(response) {
                    console.log(response)
                    if (response==1) {
                        alert('บันทึกการคินสำเร็จ');
                        clear_book_ret();
                        ajax_find_his();
                    }
                } 
            });
        }

        function ajax_book_ret(mem,val) {
            $.ajax({
                url: 'ajax_book_ret.php',
                type: 'post',
                data: {
                    mem:mem,
                    data: val,
                },
                success: function(response) {
                    // console.log(response)
                    if (response!=0) {
                        book_ret = JSON.parse(response);
                        // console.log(book_ret)
                        if (data_book_ret.length!=0) {
                            var check = 0;
                            for (let i = 0; i < data_book_ret.length; i++) {
                                if (data_book_ret[i]['Book']==book_ret['Book']) {
                                    check = 1;
                                }
                            }
                            if (check!=1) {
                                show_book_ret(book_ret);
                                // console.log("incheck");

                            }
                            else{
                                alert("รหัสซ้ำ");
                            }
                        }
                        else{
                            show_book_ret(book_ret);
                        // console.log("inelse");

                        }
                    }
                    else{
                        alert("สมาชิกไม่ได้ยืมทรัพยากรนี้");
                    }
                } 
            });
        }

        function clear_book_ret (){
            data_book_ret= [];
            count_book_ret = 1;
            $('.table_book_ret tbody').empty();
        }

        $('.table_find_mem').on('click','.sel_mem_id',function(){
            var val = $(this).parent().parent().find(".target_mem_id").html();
            ajax_data_mem(val);
            $('#modal_find_mem').modal('toggle');
        })

        $('.btn_find_mem').on('click',function(){
            var val = $(this).parent().parent().find("input[name='text_member']").val();
            ajax_find_mem(val);
        })

        $('.btn_sel_mem').on('click',function(){
            var val = $(this).parent().parent().find("input[name='text_member']").val();
            ajax_data_mem(val);
            $(this).parent().parent().find("input[name='text_member']").val("");
        })

        $('.table_book_ret').on('click','.btn_cancel_ret',function(){
            var val = $(this).parent().parent().find(".find_book_name").html();
            var count = 1;
            data_book_ret = jQuery.grep(data_book_ret, function(value) {
                return value['Subfield'] != val;
            });
            $(this).parent().parent().remove();
            count_book_ret = count_book_ret-1;
            $('.find_book_count').each(function(){
                $(this).html("<center>"+count+"</center>");
                count++;
            });
            console.log(data_book_ret)
        })

        $('.btn_sel_book').on('click',function(){
            var val = $(this).parent().parent().find("input[name='text_book']").val();
            if (mem_main.length==0) {
                ajax_book_mem(val);
            }
            else{
                ajax_book_ret(mem_main[0]['ID'],val);
            }
            $(this).parent().parent().find("input[name='text_book']").val("");
        })

        $('.btn_ppat_back').on('click',function(){
            now_page--;
            page_1=(now_page-1)*8;
            page_2=page_1+8;
            append_table_find_mem(page_1,page_2)
            if (now_page==1) {
                $(this).prop("disabled", true)
            }
            else{
                $(this).prop("disabled", false)
            }
            if (now_page!=all_page) {
                $('.btn_ppat_next').prop("disabled", false)
            }
            $('.text_ppat_now').val(now_page);
        })

        $('.btn_his_ppat_back').on('click',function(){
            his_now_page--;
            his_page_1=(his_now_page-1)*10;
            his_page_2=his_page_1+10;
            append_table_his(his_page_1,his_page_2)
            if (his_now_page==1) {
                $(this).prop("disabled", true)
            }
            else{
                $(this).prop("disabled", false)
            }
            if (his_now_page!=his_all_page) {
                $('.btn_his_ppat_next').prop("disabled", false)
            }
            $('.text_his_ppat_now').val(his_now_page);
        })

        $('.btn_ppat_next').on('click',function(){
            now_page++;
            page_1=(now_page-1)*8;
            page_2=page_1+8;
            append_table_find_mem(page_1,page_2)
            // console.log(now_page)
            if (now_page==all_page) {
                $(this).prop("disabled", true)
            }
            else{
                $(this).prop("disabled", false)
            }
            if (now_page!=1) {
                $('.btn_ppat_back').prop("disabled", false)
            }
            $('.text_ppat_now').val(now_page);
        })

        $('.btn_his_ppat_next').on('click',function(){
            his_now_page++;
            his_page_1=(his_now_page-1)*10;
            his_page_2=his_page_1+10;
            append_table_his(his_page_1,his_page_2)
            // console.log(his_now_page)
            if (his_now_page==his_all_page) {
                $(this).prop("disabled", true)
            }
            else{
                $(this).prop("disabled", false)
            }
            if (his_now_page!=1) {
                $('.btn_his_ppat_back').prop("disabled", false)
            }
            $('.text_his_ppat_now').val(his_now_page);
        })

        $('.table_book_due').on('click','.btn_ret',function(){
            var val = $(this).attr('value');
            ajax_book_ret(mem_main[0]['ID'],val);
        })

        $('.save_ret').on('click',function(){
            ajax_save_ret();
        })


    </script>
