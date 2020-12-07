<?php

    @session_start();
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/controller/librarian/cal_date.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/datehelper.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";

?><style>
	.table {
		font-size: 12px;
		font-family: sans-serif;
	}

	thead {
		background-color: lightgray;
	}

	td {
		background-color: #f5f5f5;
	}
	
	.sel_mem_id{
	    cursor:pointer;
	}
	
</style>

    <br><br><br>
    <section class="container">
    <div class="row" style="padding-top: 20px;padding-bottom: 350px; background-color: #eee;">
        <div class="col-md-12">
        <a href="../../librarian/librarian.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
        &nbsp;&nbsp;<b style="font-size: 25px;">รายการยืม-คืน</b><br>
        
       <br>
            <div class="col-md-12">
                <div class="col-md-1">
                </div>
                <br><br>
                <table>
                    <tbody>
                    <tr style=" background-color: #eee;">
                        <td style=" background-color: #eee;">
                            <label  >รหัสสมาชิก : </label>&nbsp;&nbsp;
                        </td>
                        <td>
                            <input placeholder="ใส่รหัสสมาชิกหรือคำเพิ่อค้นหา" type="text" class="form-control" name="text_member" id="text_member" autocomplete="off">
                        </td>
                        <td style=" background-color: #eee;">
                           &nbsp;&nbsp; <button class="btn btn-primary btn_sel_mem" >เลือก</button>
                        </td style=" background-color: #eee;">
                        <td style=" background-color: #eee;">
                          &nbsp;&nbsp;  <button class="btn btn-info btn_find_mem" >ค้นหา</button>
                        </td>
                   
                    <td style=" background-color: #eee;">
                       &nbsp;&nbsp; <label >รหัสหนังสือ : </label>&nbsp;&nbsp;
                        </td>
                        <td >
                            <input placeholder="ใส่รหัสหนังสือ" type="text" class="form-control" name="text_book" id="text_book" autocomplete="off">
                        </td>
                        <td style=" background-color: #eee;">
                        &nbsp;&nbsp;    <button class="btn btn-primary btn_sel_book" >เลือก</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
      
	<div class="col-md-12">
        <fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em;" class="mem_data">
				<legend style="width: auto;padding:0 5px 0 5px;">รายละเอียดสมาชิก</legend>
                <table>
                    <tbody>
                      
                            <td width = "7%" style=" background-color: #eee;"><label class="control-label col-sm-1" for="pwd">ชื่่อ:</label></td>
                            	
                            <td width = "18%" style=" background-color: #eee;"><input type="text" class="mem_fname form-control" disabled></td>
                            
                            <td width = "7%" style=" background-color: #eee;"><label class="control-label col-sm-1" for="pwd">นามสกุล:</label></td>
                          
                            <td width = "18%" style=" background-color: #eee;"><input type="text" class="mem_lname form-control" disabled></td>
                           
                            <td width = "7%" style=" background-color: #eee;"><label class="control-label col-sm-1" for="pwd">คณะ:</label></td>
                            
                            <td width = "18%"><input type="text" class="mem_fac form-control" disabled></td>
                             
                        </tr>
                    
                         <tr>
                             
                            <td width = "7%" style=" background-color: #eee;"><label class="control-label col-sm-1" for="pwd">สาขา:</label></td>
                            <td width = "18%" style=" background-color: #eee;"><input type="text" class="mem_major form-control" disabled></td>
                            <td width = "7%" style=" background-color: #eee;"><label class="control-label col-sm-1" for="pwd">เบอร์โทร:</label></td>
                            <td width = "18%" style=" background-color: #eee;"><input type="text" class="mem_tel form-control"  disabled></td>
                            <td width = "7%" style=" background-color: #eee;"><label class="control-label col-sm-1" for="pwd">อีเมล:</label></td>
                            <td width = "18%" style=" background-color: #eee;"><input type="text" class="mem_email form-control" disabled></td>
                        </tr>
                        <tr>
                            <td width = "7%" style=" background-color: #eee;"><label class="control-label " for="pwd" >&nbsp;&nbsp;&nbsp;ที่อยุ่:</label></td>
                            <td width = "18%" ><textarea class="mem_address form-control" disabled></textarea></td>
                        </tr>
                    </tbody>
                </table>
        </fieldset>


        <fieldset class="menu" style="border: 1px solid silver;margin: 0 1px;border-style:outset;border-color:FFFFCC;padding: .625em .625em .75em;margin: 0 0px; background-color:#ccc;">
            <div class="col-md-12">
                <div class="tab-content">
                    <ul class="nav nav-pills">
                        <li class=""><a class="a_book_borr" data-toggle="pill" href="#book_borr" style="font-family:kanit;">ยืมหนังสือ</a></li>
                        <li class=""><a class="a_book_ret" data-toggle="pill" href="#book_ret" style="font-family:kanit;">คืนหนังสือ</a></li>
                        <li class="active"><a data-toggle="pill" href="#book_due" style="font-family:kanit;">หนังสือค้าง</a></li>
                        <li class=""><a data-toggle="pill" href="#book_his" style="font-family:kanit;">ประวัติการยืม</a></li>
                        <li class=""><a data-toggle="pill" href="#book_fine" style="font-family:kanit;">ค่าปรับค้าง</a></li>
                        <li class=""><a data-toggle="pill" href="#book_his_fine" style="font-family:kanit;">ประวัติค่าปรับ</a></li>
                        <li class=""><a data-toggle="pill" href="#book_rep_fine" style="font-family:kanit;">ใบเสร็จค่าปรับ</a></li>
                    </ul>
                </div>
            </div>
        </fieldset>
<!-----------------------------tab_fade_menu------------------------------------------------->
<br>


<div class="tab-content">
    <div id="book_due" class="tab-pane fade in active">
        <table class="table table_book_due">
            <thead class="thead-light">
                <tr>
                    <th>
                        ลำดับ
                    </th>
                    <th>
                        ชื่อทรัพยากร
                    </th>
                    <th class="bg-success">
                        วันที่ยืม
                    </th>
                    <th class="bg-danger">
                        กำหนดคืน
                    </th>
                    <th>
                        เกินกำหนด(วัน)
                    </th>
                </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
        </table>
    </div>

    <div id="book_his" class="tab-pane fade">
        <table class="table table_book_his">
            <thead class="thead-light">
                <tr>
                    <th>
                        ลำดับ
                    </th>
                    <th>
                        ชื่อทรัพยากร
                    </th>
                    <th class="bg-success">
                        วันที่ยืม
                    </th>
                    <th class="bg-danger">
                        วันที่คืน
                    </th>
                    <th>
                        สถานะค่าปรับ
                    </th>
                </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
        </table>
        <ul class="pagination">
        <li><button type="button" class="btn btn-default btn_his_ppat_back">ย้อนกลับ</button></li>
        <li><input type="button" class="btn text_his_ppat_now" disabled><button class="btn" style="cursor: default;">/</button><input type="button" class="btn text_his_ppat_all" disabled></li>
        <!--<li><input type="button" class="text_his_ppat_all" disabled></li>-->
        <li><button type="button" class="btn btn-default btn_his_ppat_next" >ต่อไป</button></li>
        </ul>
    </div>

    <div id="book_ret" class="tab-pane fade">
        <table class="table table_book_ret">
            <thead class="thead-light">
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
            <tbody id="tbody">
            </tbody>
        </table>
        <center><button class="btn btn-success save_ret">บันทึก</button></center>
    </div>

    <div id="book_borr" class="tab-pane fade">
        <table class="table table_book_borr">
            <thead class="thead-light">
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
            <tbody id="tbody">
            </tbody>
        </table>
        <center><button class="save_borr btn btn-success">บันทึก</button></center>
    </div>

    <div id="book_fine" class="tab-pane fade">
        <table class="table table_book_fine">
            <thead class="thead-light">
                <tr>
                    <th>
                        ลำดับ
                    </th>
                    <th>
                        ชื่อทรัพยากร
                    </th>
                    <th class="bg-danger">
                        จำนวนค่าปรับ
                    </th>
                    <th>
                        ประเภทค่าปรับ
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
        </table>
        <center><button class="cal_fine btn btn-primary">จัดการค่าปรับ</button></center>
    </div>

    <div id="book_his_fine" class="tab-pane fade">
        <table class="table table_book_his_fine">
            <thead class="thead-light">
                <tr>
                    <th>
                        ลำดับ
                    </th>
                    <th>
                        ชื่อทรัพยากร
                    </th>
                    <th class="bg-danger">
                        จำนวนค่าปรับ
                    </th>
                    <th>
                        ประเภทค่าปรับ
                    </th>
                    <th>
                        ลำดับรายการใบเสร็จ
                    </th>
                </tr>
            </thead >
            <tbody id="tbody">
            </tbody>
        </table>
                <center><ul class="pagination">
                    <li>
                        <button type="button" class="btn btn-default btn_his_fine_ppat_back">ย้อนกลับ</button>
                    </li>
                    <li>
                        <input type="button" class="btn text_his_fine_ppat_now" disabled>
                        <button class="btn" style="cursor: default;">/</button>
                        <input type="button" class="btn text_his_fine_ppat_all" disabled>
                    </li>
                    <li>
                        <button type="button" class="btn btn-default btn_his_fine_ppat_next" >ต่อไป</button>
                        </li>
                </ul>
        <!--<button type="button" class="btn_his_fine_ppat_back btn btn-primary" >ย้อนกลับ</button>-->
        <!--<input type="text" class="text_his_fine_ppat_now" value="">-->
        <!--<input type="text" class="text_his_fine_ppat_all" disabled>-->
        <!--<button type="button" class="btn_his_fine_ppat_next btn btn-primary" >ต่อไป</button>-->
    </div>

    <div id="book_rep_fine" class="tab-pane fade">
        <table class="table table_book_rep_fine">
            <thead class="thead-light">
                <tr>
                    <th>
                        ลำดับ
                    </th>
                    <th>
                        เลขรายการใบเสร็จ
                    </th>
                    <th>
                        วันที่
                    </th>
                </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
        </table>
               <ul class="pagination">
                    <li>
                        <button type="button" class="btn btn-default btn_rep_fine_ppat_back">ย้อนกลับ</button>
                    </li>
                    <li>
                        <input type="button" class="btn text_rep_fine_ppat_now" disabled>
                        <button class="btn" style="cursor: default;">/</button>
                        <input type="button" class="btn text_rep_fine_ppat_all" disabled>
                    </li>
                    <li>
                        <button type="button" class="btn btn-default btn_rep_fine_ppat_next" >ต่อไป</button>
                        </li>
                </ul>
        <!--<button type="button" class="btn_rep_fine_ppat_back btn btn-primary" >ย้อนกลับ</button>-->
        <!--<input type="text" class="text_rep_fine_ppat_now" value="">-->
        <!--<input type="text" class="text_rep_fine_ppat_all" disabled>-->
        <!--<button type="button" class="btn_rep_fine_ppat_next btn btn-primary" >ต่อไป</button>-->
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
                                <th scope="col" width = "30%" class="text-primary" ><div align='center'>ชื่อ-นามสกุล</div></th>
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
                <div class="ppat" style="text-align: center;" >
                     <ul class="pagination" style="display:unset; float:unset;" >
                    
                    <li>
                        <button type="button" class="btn btn-default btn_ppat_back">ย้อนกลับ</button>
                    </li>
                    <li>
                        <input type="button" class="btn text_ppat_now" disabled>
                        <button class="btn" style="cursor: default;">/</button>
                        <input type="button" class="btn text_ppat_all" disabled>
                    </li>
                    <li>
                        <button type="button" class="btn btn-default btn_ppat_next" >ต่อไป</button>
                        </li>
                        
                </ul>
                </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-----------------------------modal_find_member------------------------------------------------->

<!-----------------------------modal_cal_fine------------------------------------------------->
<div class="modal fade" id="modal_cal_fine" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin: center;margin-left: 18%;">
        <div class="modal-content" style="  width:150%; position:relative ;">
            <div style="  background-color: #FAFAD2;">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">รายการค่าปรับ</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="no_fine"><center><h3>ไม่พบข้อมูลค่าปรับ</h3></center></div>
                    <table class='table_cal_fine table'>
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-success btn_save_cal_fine">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-----------------------------modal_cal_fine------------------------------------------------->

<!-----------------------------modal_rep_fine------------------------------------------------->
<div class="modal fade" id="modal_rep_fine" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="test">
    </div>
<div class="modal-dialog" role="document" style="width: 100%">
        <div class="modal-content" style="width: 100%">
            <div style="background-color: #FAFAD2;">
                <div class="modal-header text-center">
                    <h1 class="modal-title" id="exampleModalLabel">ใบเสร็จรับเงิน</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class='table_rep_fine table'>
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary hidden_print " data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn_print_rep_fine btn btn-primary hidden_print">พิมพ์ใบเสร็จ</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-----------------------------modal_rep_fine------------------------------------------------->

    <script>

        var mode = 0;
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
        var his_fine_all_page = 0;
        var his_fine_all_now = 0;
        var his_fine_page_1 = 0;
        var his_fine_page_2 = 0;
        var rep_fine_all_page = 0;
        var rep_fine_all_now = 0;
        var rep_fine_page_1 = 0;
        var rep_fine_page_2 = 0;
        var mem_main = [];
        var book_main = {};
        var data_book_ret= [];
        var data_book_borr= [];
        var count_book_ret = 1;
        var count_book_borr = 1;
        var total_amount = 0;
        var rep_NO = null;


        $(document).ready(function(){
            hide_menu();
            $('.text_his_fine_ppat_now').val(0);
            $('.text_his_fine_ppat_all').val(0);
        })

        Object.size = function(obj) {
            var size = 0,
                key;
            for (key in obj) {
                if (obj[key].length != 0) size++;
            }
            return size;
        };

        function hide_menu (){
            $('.mem_data').hide();
            $('.menu').hide();
            $('.tab-content').hide();
        }

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
                    hide_menu();
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
                            stack += "<a class='sel_mem_id text-primary' >";
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
                            stack += "<a class='sel_mem_id text-primary' >";
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
                            stack += "<a class='sel_mem_id text-primary' >";
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
            // console.log(book_main);
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
                        stack += "<td class='text-success'>";
                            stack += book_main[0][i]['Borrow'];
                        stack += "</td>";
                        stack += "<td class='text-danger'>";
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
                    stack += "<tr style='height:34px;'>";
                        // stack += "<td>";
                        // stack += "</td>";
                        // stack += "<td>";
                        // stack += "</td>";
                        // stack += "<td>";
                        // stack += "</td>";
                        // stack += "<td>";
                        // stack += "</td>";
                        // stack += "<td>";
                        // stack += "</td>";
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
                        stack += "<td class='text-success'>";
                            stack += book_main[0][i]['Borrow'];
                        stack += "</td>";
                        stack += "<td class='text-danger'>";
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

        function append_table_his_fine(start,stop){
            $('.table_book_his_fine tbody').empty();
            var stack = "";
            // console.log(book_main);
            if (stop>book_main[2].length) {
                for (let i = start; i < book_main[2].length; i++) {
                    stack += "<tr>";
                        stack += "<td>";
                            stack += "<center>"+(i+1)+"</center>";
                        stack += "</td>";
                        stack += "<td>";
                        for (let j = 0; j < book_main[0].length; j++) {
                            if (book_main[0][j]['ID']==book_main[2][i]['Borrow_ID']) {
                                stack += book_main[1][book_main[0][j]['Book']][245]['Subfield'];
                            }
                        }
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[2][i]['Amount'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[2][i]['Type'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[2][i]['receipt_NO'];
                        stack += "</td>";
                    stack += "</tr>";
                }
                for (let i = book_main[2].length; i < stop; i++) {
                    stack += "<tr style='height:34px;'>";
                        // stack += "<td>";
                        // stack += "</td>";
                        // stack += "<td>";
                        // stack += "</td>";
                        // stack += "<td>";
                        // stack += "</td>";
                        // stack += "<td>";
                        // stack += "</td>";
                        // stack += "<td>";
                        // stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_book_his_fine tbody').append(stack);
            }
            else{
                for (let i = start; i < stop; i++) {
                    stack += "<tr>";
                        stack += "<td>";
                            stack += "<center>"+(i+1)+"</center>";
                        stack += "</td>";
                        stack += "<td>";
                        for (let j = 0; j < book_main[0].length; j++) {
                            if (book_main[0][j]['ID']==book_main[2][i]['Borrow_ID']) {
                                stack += book_main[1][book_main[0][j]['Book']][245]['Subfield'];
                            }
                        }
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[2][i]['Amount'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[2][i]['Type'];
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[2][i]['receipt_NO'];
                        stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_book_his_fine tbody').append(stack);
            }
        }

        function append_table_rep_fine(start,stop){
            $('.table_book_rep_fine tbody').empty();
            var stack = "";
            if (stop>book_main[3].length) {
                for (let i = start; i < book_main[3].length; i++) {
                    stack += "<tr>";
                        stack += "<td>";
                            stack += "<center>"+(i+1)+"</center>";
                        stack += "</td>";
                        stack += "<td>";
                            stack += "<a class='text-primary rep_select' >"+book_main[3][i]['receipt_NO']+"</a>";
                        stack += "</td>";
                        stack += "<td>";
                        for (let j = 0; j < book_main[2].length; j++) {
                            if (book_main[2][j]['receipt_NO']==book_main[3][i]['receipt_NO']) {
                                stack += book_main[2][j]['Payment_Date'];
                                break;
                            }                            
                        }
                        stack += "</td>";
                    stack += "</tr>";
                }
                for (let i = book_main[3].length; i < stop; i++) {
                    stack += "<tr style='height:34px;'>";
                        // stack += "<td>";
                        // stack += "</td>";
                        // stack += "<td>";
                        // stack += "</td>";
                        // stack += "<td>";
                        // stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_book_rep_fine tbody').append(stack);
            }
            else{
                for (let i = start; i < stop; i++) {
                    stack += "<tr>";
                        stack += "<td>";
                            stack += "<center>"+(i+1)+"</center>";
                        stack += "</td>";
                        stack += "<td>";
                            stack += book_main[3][i]['receipt_NO'];
                        stack += "</td>";
                        stack += "<td>";
                        for (let j = 0; j < book_main[2].length; j++) {
                            if (book_main[2][j]['receipt_NO']==book_main[3][i]['receipt_NO']) {
                                stack += book_main[2][j]['Payment_Date'];
                                break;
                            }                            
                        }
                        stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_book_rep_fine tbody').append(stack);
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
                if (all_page>=2) {
                    $('.btn_ppat_next').prop("disabled", false)
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
                            stack += "<a class='text-primary btn_ret' value='"+book_main[0][i]['Book']+"'>"+book_main[1][j][245]['Subfield']+"</a>";
                            }    
                        }
                        stack += "</td>";
                        stack += "<td class='text-success'>";
                            stack += book_main[0][i]['Borrow'];
                        stack += "</td>";
                        stack += "<td class='text-danger'>";
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


            count = 1;
            stack = "";
            for (let i = 0; i < book_main[2].length; i++) {
                if (book_main[2][i]['receipt_NO']=="-") {
                    stack += "<tr>";
                        stack += "<td>";
                            stack += "<center>"+count+"</center>";
                        stack += "</td>";
                        stack += "<td>";
                        for (let j = 0; j < book_main[0].length; j++) {
                            if (book_main[0][j]['ID']==book_main[2][i]['Borrow_ID']) {
                                stack += "<input type='hidden' value='"+book_main[2][i]['Borrow_ID']+"' class='find_br_id' >";
                                stack += book_main[1][book_main[0][j]['Book']][245]['Subfield'];
                            }
                        }
                        stack += "</td>";
                        stack += "<td class='fine_amount'>";
                        if (book_main[2][i]['Amount']==0&&book_main[2][i]['Type']=='สูญหาย') {
                            stack += "ไม่ได้กำหนดราคา";
                        }
                        else{
                            stack += book_main[2][i]['Amount'];
                        }
                        stack += "</td>";
                        stack += "<td>";
                            stack += "<select class='form-control fine_type' disabled>";
                            if (book_main[2][i]['Type']=='คืนเกินกำหนด') {
                                stack += "<option value='คืนเกินกำหนด' selected >คืนเกินกำหนด</option>";
                                stack += "<option value='สูญหาย' >สูญหาย</option>";
                            }
                            else{
                                stack += "<option value='คืนเกินกำหนด' >คืนเกินกำหนด</option>";
                                stack += "<option value='สูญหาย' selected >สูญหาย</option>";
                            }
                            stack += "</select>";
                        stack += "</td>";
                        stack += "<td>";
                            stack += "<center><button class='btn btn-primary btn_edit_type_fine' >แก้ไข</button></center>";
                        stack += "</td>";

                    stack += "</tr>";
                    count++;
                }
            }
            $('.table_book_fine tbody').append(stack);
            if ($('.table_book_fine tbody').children().length==0) {
                $('.cal_fine').prop("disabled",true);
            }
            else{
                $('.cal_fine').prop("disabled",false);
            }


            
                
            his_all_page = Math.ceil(book_main[0].length/10);
            $('.text_his_ppat_all').val(his_all_page)
            $('.text_his_ppat_now').val(1)
            his_now_page = $('.text_his_ppat_now').val();
            if (his_now_page==1) {
                $('.btn_his_ppat_back').prop("disabled", true)
            }
            if (his_all_page>=2) {
                $('.btn_his_ppat_next').prop("disabled", false)
            }
            else{
                $('.btn_his_ppat_next').prop("disabled", true)
            }
            his_page_1=0;
            his_page_2=10;
            append_table_his(his_page_1,his_page_2);


            his_fine_all_page = Math.ceil(book_main[2].length/10);
            $('.text_his_fine_ppat_all').val(his_fine_all_page)
            $('.text_his_fine_ppat_now').val(1)
            his_fine_now_page = $('.text_his_fine_ppat_now').val();
            if (his_fine_now_page==1) {
                $('.btn_his_fine_ppat_back').prop("disabled", true)
            }
            if (his_fine_all_page>=2) {
                $('.btn_his_fine_ppat_next').prop("disabled", false)
            }
            else{
                $('.btn_his_fine_ppat_next').prop("disabled", true)
            }
            his_fine_page_1=0;
            his_fine_page_2=10;

            append_table_his_fine(his_fine_page_1,his_fine_page_2)

            rep_fine_all_page = Math.ceil(book_main[3].length/10);
            $('.text_rep_fine_ppat_all').val(rep_fine_all_page)
            $('.text_rep_fine_ppat_now').val(1)
            rep_fine_now_page = $('.text_rep_fine_ppat_now').val();
            if (rep_fine_now_page==1) {
                $('.btn_rep_fine_ppat_back').prop("disabled", true)
            }
            if (rep_fine_all_page>=2) {
                $('.btn_rep_fine_ppat_next').prop("disabled", false)
            }
            else{
                $('.btn_rep_fine_ppat_next').prop("disabled", true)
            }
            rep_fine_page_1=0;
            rep_fine_page_2=10;

            append_table_rep_fine(rep_fine_page_1,rep_fine_page_2)
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
                        clear_book_borr();
                        ajax_find_his();
                        $('.menu').show();
                        $('.tab-content').show();
                        // $('#book_due').attr('.in.active');
                    }
                    else{
                        clear_book_ret();
                        clear_book_borr();
                        hide_menu();
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
                        clear_book_borr();
                        ajax_find_his();
                        ajax_book_ret(mem_main[0]['ID'],val);
                        $('.menu').show();
                        $('.tab-content').show();
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
                        console.log(book_main)
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
                    // console.log(response)
                    if (response==1) {
                        alert('บันทึกการคินสำเร็จ');
                        clear_book_ret();
                        ajax_find_his();
                    }
                } 
            });
        }

        function ajax_save_borr() {
            $.ajax({
                url: 'ajax_save_borr.php',
                type: 'post',
                data: {
                    mem: mem_main[0],
                    data: data_book_borr,
                },
                success: function(response) {
                    // console.log(response)
                    if (response==1) {
                        alert('บันทึกการยืมสำเร็จ');
                        clear_book_borr();
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

        function ajax_book_borr(val) {
            $.ajax({
                url: 'ajax_book_borr.php',
                type: 'post',
                data: {
                    data: val,
                },
                success: function(response) {
                    // console.log(response)
                    if (response!=0&&response!=1) {
                        var book_borr = JSON.parse(response)
                        // console.log(book_borr);
                        show_book_borr(book_borr);
                    }
                    else if(response==0){
                        alert('ทรัพยากรไม่ว่าง');
                    }
                    else if(response==1){
                        alert('รหัสทรัพยากรไม่ถูกต้อง');
                    }
                } 
            });
        }

        function ajax_edit_fine_type(bar_fine,type_fine,fine_amount) {
            $.ajax({
                url: 'ajax_edit_fine_type.php',
                type: 'post',
                data: {
                    id: bar_fine,
                    type: type_fine,
                    amount: fine_amount,
                },
                success: function(response) {
                    console.log(response)
                } 
            });
        }

        
        function ajax_fine_due(id,pos) {
            $.ajax({
                url: 'ajax_fine_due.php',
                type: 'post',
                data: {
                    id: id,
                },
                success: function(response) {
                    pos.parent().parent().find('.fine_amount').html(parseFloat(response).toFixed(2));
                } 
            });
        }
        

        function ajax_save_fine(temp,data_fine) {
            $.ajax({
                url: 'ajax_save_fine.php',
                type: 'post',
                data: {
                    fine_book: temp,
                    fine_rep: data_fine,
                },
                success: function(response) {
                    // console.log(response)
                    alert('บันทึกค่าปรับสำเร็จ');
                    $('#modal_cal_fine').modal('toggle');
                    clear_book_fine();
                    ajax_find_his();
                } 
            });
        }

        function clear_book_ret (){
            data_book_ret= [];
            count_book_ret = 1;
            $('.table_book_fine tbody').empty(); 

            $('.table_book_ret tbody').empty();
            $('.text_his_ppat_now').val(0);
            $('.text_his_ppat_all').val(0);
            $('.btn_his_ppat_next').prop("disabled", true)
            $('.btn_his_ppat_back').prop("disabled", true)
        }

        function clear_book_borr (){
            data_book_borr= [];
            count_book_borr = 1;
            $('.table_book_fine tbody').empty(); 

            $('.table_book_borr tbody').empty();
        }

        function clear_book_fine (){
            total_amount = 0;
            $('.table_cal_fine thead').empty();
            $('.table_cal_fine tbody').empty();
            $('.table_book_fine tbody').empty();
            $('.table_book_his_fine tbody').empty();
            $('.text_his_fine_ppat_now').val(0);
            $('.text_his_fine_ppat_all').val(0);
        }

        function show_book_borr(book_borr){
            var stack = "";
            data_book_borr.push([book_borr['Barcode'],book_borr[245]['Subfield']])
            // console.log(data_book_borr);
            stack += "<tr>";
                stack += "<td class='find_book_count' ><center>";
                    stack += count_book_borr;
                stack += "</center></td>";
                stack += "<td class='find_book_name'>";
                    stack += book_borr[245]['Subfield'];
                stack += "</td>";
                stack += "<td>";
                    stack += "<button class='btn_cancel_borr btn btn-primary' >ยกเลิก</button>";
                stack += "</td>";
            stack += "</tr>";
            count_book_borr++;
            $('.table_book_borr tbody').append(stack);
        }


        function fine_type_change(type,br_id,pos){
            if (type=='คืนเกินกำหนด') {
                 ajax_fine_due(br_id,pos);
            }
            else{
                for (let i = 0; i < book_main[0].length; i++) {
                    if (br_id==book_main[0][i]['ID']) {
                        var check_365 = 0;
                        for (j in book_main[1][book_main[0][i]['Book']]) {
                            if (j==365) {
                                check_365 = 1;
                            }
                        }
                        if(check_365 == 1) {
                            var text = book_main[1][book_main[0][i]['Book']][365]['Subfield'].split("/")
                            for (let i = 0; i < text.length; i++) {
                                if (text[i].substr(0,2)=='#b') {
                                    var text_val = text[i].substr(3,text.length);
                                    pos.parent().parent().find('.fine_amount').html(parseFloat(text_val).toFixed(2));
                                }
                            }
                        }
                        else{
                            pos.parent().parent().find('.fine_amount').html('ไม่ได้กำหนดราคา');
                        }
                    }
                }
            }

        }

        var type_fine = null;
        $('.table_book_fine').on('click','.btn_edit_type_fine',function(){
            var sel_box = $(this).parent().parent().parent().find('.fine_type');
            type_fine = $(this).parent().parent().parent().find('.fine_type').val();
            $(sel_box).prop('disabled', false);
            $(this).replaceWith("<button class='btn btn-success btn_edit_type_fine_save' >บันทึก</button> &nbsp;<button class='btn btn-danger btn_edit_type_fine_cancel'>ยกเลิก</button>")
        });

        $('.cal_fine').on('click',function(){
            var arr_amount = [];
            var arr_type = [];
            total_amount = 0;
            $('.table_cal_fine thead').empty();
            $('.table_cal_fine tbody').empty();

            $('.fine_amount').each(function(){
                arr_amount.push($(this).html());
            });
            $('.fine_type').each(function(){
                arr_type.push($(this).val());
            });
            
            var stack = "";
            if (book_main[2].length!=0) {
                $('.no_fine').hide();
                if ($('.table_cal_fine thead').children().length==0) {
                    stack += "<tr>";
                        stack += "<th>";
                            stack += "ลำดับ";
                        stack += "</th>";
                        stack += "<th>";
                            stack += "ชื่อทรัพยากร";
                        stack += "</th>";
                        stack += "<th>";
                            stack += "ค่าปรับ";
                        stack += "</th>";
                        stack += "<th>";
                            stack += "ประเภท";
                        stack += "</th>";
                    stack += "</tr>";
                }
                
                $('.table_cal_fine thead').append(stack);
                stack = "";
                run = 1;
                if ($('.table_cal_fine tbody').children().length==0) {
                    for (let i = 0; i < book_main[2].length; i++) {
                        if (book_main[2][i]['receipt_NO']=="-") {
                            stack += "<tr>";
                                stack += "<td>";
                                    stack += run;
                                    run++;
                                stack += "</td>";
                                for (let j = 0; j < book_main[0].length; j++) {
                                    if (book_main[0][j]['ID']==book_main[2][i]['Borrow_ID']) {
                                        stack += "<td>";
                                            stack += "<input type='hidden' value='"+book_main[2][i]['Borrow_ID']+"' class='find_br_id_modal' >";
                                            stack += book_main[1][book_main[0][j]['Book']][245]['Subfield'];
                                        stack += "</td>";
                                    }
                                }
                                stack += "<td class='last_amount'>";
                                $('.find_br_id').each(function(){
                                    if ($(this).val()==book_main[2][i]['Borrow_ID']) {
                                        if ($(this).parent().parent().find('.fine_type').val()=="สูญหาย") {
                                            if ($(this).parent().parent().find('.fine_amount').html()=="ไม่ได้กำหนดราคา") {
                                                stack += "<input type='text' class='unknow_fine' value='0'>";
                                            }
                                            else{
                                                stack += "<input type='text' class='unknow_fine' value='"+parseFloat($(this).parent().parent().find('.fine_amount').html()).toFixed(2)+"'>";
                                                // total_amount = total_amount + parseInt($(this).parent().parent().find('.fine_amount').html());
                                            }
                                        }
                                        else{
                                            stack += parseFloat($(this).parent().parent().find('.fine_amount').html()).toFixed(2);
                                        }
                                        
                                    }
                                })
                                stack += "</td>";
                                stack += "<td class='last_type'>";
                                $('.find_br_id').each(function(){
                                    if ($(this).val()==book_main[2][i]['Borrow_ID']) {
                                        stack += $(this).parent().parent().find('.fine_type').val();
                                    }
                                })
                                stack += "</td>";
                            stack += "</tr>";
                        }
                        
                    }
                    stack += "<tr>";
                        stack += "<td>";
                            stack += "รวมค่าปรับ";
                        stack += "</td>";
                        stack += "<td class='total_fine'>";
                            // stack += parseFloat(total_amount).toFixed(2);
                        stack += "</td>";
                        stack += "<td>";
                            stack += "ละเว้น";
                        stack += "</td>";
                        stack += "<td>";
                            stack += "<input type='text' class='form-control except_fine' value='0'>";
                        stack += "</td>";
                    stack += "</tr>";
                    stack += "<tr>";
                        stack += "<td>";
                            stack += "รวม";
                        stack += "</td>";
                        stack += "<td class='total_payment'>";
                            stack += parseFloat(total_amount).toFixed(2);
                        stack += "</td>";
                        stack += "<td>";
                            stack += "หมายเหตุ";
                        stack += "</td>";
                        stack += "<td>";
                            stack += "<input type='text' class='form-control comment'>";
                        stack += "</td>";
                    stack += "</tr>";
                    stack += "<tr>";
                        stack += "<td>";
                            stack += "จ่ายเงิน";
                        stack += "</td>";
                        stack += "<td>";
                            stack += "<input type='text' class='form-control pay_fine' >";
                        stack += "</td>";
                        stack += "<td>";
                            stack += "เงินทอน";
                        stack += "</td>";
                        stack += "<td class='pay_ton'>";
                        stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_cal_fine tbody').append(stack);
            }
            cal_total_amount();
            cal_total_payment();
            $('#modal_cal_fine').modal('toggle');
        });
        
        $(".modal-footer").on('click','.btn_print_rep_fine', function() {
            // printElement($('#modal_rep_fine .modal-dialog .modal-content'));
            rep_pdf();
        });

        function rep_pdf(){
            window.open('rep_pdf.php?rep_NO='+rep_NO);
        }

        function printElement(elem) {
            console.log(elem[0])
            var d = elem.css( "width", "+=20px" );
            // var d = elem;
            var domClone = d[0].cloneNode(true);
            
            var $printSection = document.getElementById("printSection");
            
            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }
            
            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            // $('.test').html(domClone);
            window.print();
        }

        function cal_total_amount(){
            total_amount = 0;
            $('.last_amount').each(function(){
                console.log($(this));
                if ($(this).children().length==1) {
                    console.log($(this).children().val());
                    total_amount = total_amount + parseFloat($(this).children().val());
                }
                else{
                    // console.log($(this).html());
                    total_amount = total_amount + parseFloat($(this).html());
                }
            })
            $('.total_fine').html(parseFloat(total_amount).toFixed(2));
        }

        function cal_total_payment(){
            total_payment = 0;
            except_fine_ = parseFloat($('.except_fine').val());
            total_payment = total_amount - except_fine_;
            $('.total_payment').html(parseFloat(total_payment).toFixed(2));
        }

        $("#modal_rep_fine").on('hidden.bs.modal', function() {
            $('.table_rep_fine thead').empty();
            $('.table_rep_fine tbody').empty();
        });
        
        
        $('.table_book_rep_fine').on('click','.rep_select',function(){
            rep_NO = $(this).html();
            var stack = "";

            if ($('.table_rep_fine thead').children().length==0) {
                stack += "<tr>";
                    stack += "<th>";
                        stack += "ลำดับ";
                    stack += "</th>";
                    stack += "<th>";
                        stack += "ชื่อทรัพยากร";
                    stack += "</th>";
                    stack += "<th>";
                        stack += "ประเภท";
                    stack += "</th>";
                    stack += "<th>";
                        stack += "จำนวนค่าปรับ(บาท)";
                    stack += "</th>";
                stack += "</tr>";
            }
            $('.table_rep_fine thead').append(stack);

            stack = "";
            if ($('.table_rep_fine tbody').children().length==0) {
                var run = 1;
                for (let i = 0; i < book_main[2].length; i++) {
                    if (book_main[2][i]['receipt_NO']==rep_NO) {
                        stack += "<tr>";
                            stack += "<td>";
                                stack += run;
                                run++;
                            stack += "</td>";
                            for (let j = 0; j < book_main[0].length; j++) {
                                    if (book_main[0][j]['ID']==book_main[2][i]['Borrow_ID']) {
                                        stack += "<td>";
                                            stack += book_main[1][book_main[0][j]['Book']][245]['Subfield'];
                                        stack += "</td>";
                                    }
                                }
                            stack += "<td>";
                                stack += book_main[2][i]['Type'];
                            stack += "</td>";
                            stack += "<td>";
                                stack += book_main[2][i]['Amount'];
                            stack += "</td>";
                        stack += "</tr>";
                    }
                }
                $('.table_rep_fine tbody').append(stack);
            }
            $('#modal_rep_fine').modal('toggle');
        });

        $('.table_cal_fine').on('change','.unknow_fine',function(){
            // total_amount = total_amount - parseFloat($(this).parent().parent().find('.fine_amount').html());
            // total_amount = total_amount + parseInt($(this).val());
            cal_total_amount();
            cal_total_payment();
            $(this).parent().parent().parent().find('.total_payment').html(parseFloat(total_amount).toFixed(2))
            // $(this).parent().parent().parent().find('.total_fine').html(parseFloat(total_amount).toFixed(2))
            $(this).parent().parent().parent().find('.except_fine').val(0)
            $(this).parent().parent().parent().find('.pay_fine').val(0)
            $(this).parent().parent().parent().find('.pay_ton').html(" ")
        });

        $('.table_cal_fine').on('change','.except_fine',function(){
            var temp_pay = 0;
            var total_except = $(this).val();
            temp_pay = total_amount-total_except;
            if (temp_pay<0) {
                alert("ไม่สามารถละเว้นค่าปรับได้เนื่องจากค่าละเว้นมากกว่าค่าปรับ");
                $(this).val(0);
                $(this).parent().parent().parent().find('.total_payment').html(parseFloat(total_amount).toFixed(2))
            }
            else{
                $(this).parent().parent().parent().find('.total_payment').html(parseFloat(temp_pay).toFixed(2))
            }
            $(this).parent().parent().parent().find('.pay_fine').val(0)
            $(this).parent().parent().parent().find('.pay_ton').html(" ")
        });

        $('.table_cal_fine').on('change','.pay_fine',function(){
            var temp_ton = 0;
            var pay = $(this).val();
            var total_payment = $(this).parent().parent().parent().find('.total_payment').html();
            
            temp_ton = pay - parseInt(total_payment);
            if (temp_ton<0) {
                alert("จ่ายเงินไม่ครบ");
                $(this).val(0);
                $(this).parent().parent().find('.pay_ton').html(parseFloat(0).toFixed(2))
            }
            else{
                $(this).parent().parent().find('.pay_ton').html(parseFloat(temp_ton).toFixed(2))
            }
        });

        $('.btn_save_cal_fine').on('click',function(){
            var data_fine = {};
            var temp = [];        
            $('.find_br_id_modal').each(function(){
                if ($(this).parent().parent().find('.last_amount').children().length==0) {
                    temp.push([$(this).val(),parseFloat($(this).parent().parent().find('.last_amount').html()).toFixed(2)]);
                }
                else{
                    temp.push([$(this).val(),parseFloat($(this).parent().parent().find('.last_amount').find('input').val()).toFixed(2)]);
                }
            })
            data_fine['Payment_Total'] = parseFloat($('.table_cal_fine tbody').find('.total_fine').html()).toFixed(2);
            data_fine['Free'] = parseFloat($('.table_cal_fine tbody').find('.except_fine').val()).toFixed(2);
            data_fine['Payment_Real'] = parseFloat($('.table_cal_fine tbody').find('.total_payment').html()).toFixed(2);
            data_fine['Comment'] = $('.table_cal_fine tbody').find('.comment').val();
            data_fine['Paid'] = parseFloat($('.table_cal_fine tbody').find('.pay_fine').val()).toFixed(2);
            data_fine['Change'] = parseFloat($('.table_cal_fine tbody').find('.pay_ton').html()).toFixed(2);

            ajax_save_fine(temp,data_fine);

        });

        $('.table_book_fine').on('click','.btn_edit_type_fine_save',function(){
            var sel_box = $(this).parent().parent().parent().find('.fine_type');
            type_fine = $(this).parent().parent().parent().find('.fine_type').val();
            var bar_fine = $(this).parent().parent().parent().find('.find_br_id').attr('value');
            var fine_amount = $(this).parent().parent().parent().find('.fine_amount').html();
            $(sel_box).prop('disabled', true);
            fine_type_change(type_fine,bar_fine,$(this));
            ajax_edit_fine_type(bar_fine,type_fine,fine_amount);
            $(this).parent().replaceWith("<center><button class='btn btn-primary btn_edit_type_fine' >แก้ไข</button><center>")
        });

        $('.table_book_fine').on('click','.btn_edit_type_fine_cancel',function(){
            var sel_box = $(this).parent().parent().find('.fine_type');
            var bar_fine = $(this).parent().parent().find('.find_br_id').attr('value');

            $(sel_box).val(type_fine);
            $($(this).parent().parent().parent().find('.fine_type')).prop('disabled', true);
            fine_type_change(type_fine,bar_fine,$(this));
            $(this).parent().replaceWith("<center><button class='btn btn-primary btn_edit_type_fine' >แก้ไข</button><center>")
        });

        $('.table_book_fine').on('change','.fine_type',function(){
            var bar_fine = $(this).parent().parent().find('.find_br_id').attr('value');
            fine_type_change($(this).val(),bar_fine,$(this));
        });

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

        $('#text_member').on('keypress',function(key){
            if (key.which=='13') {
                var val = $(this).val();
                ajax_data_mem(val);
                $(this).val("");
            }
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
            // console.log(data_book_ret)
        })

        $('.table_book_borr').on('click','.btn_cancel_borr',function(){
            var val = $(this).parent().parent().find(".find_book_name").html();
            var count = 1;
            data_book_borr = jQuery.grep(data_book_borr, function(value) {
                return value[1] != val;
            });
            $(this).parent().parent().remove();
            count_book_borr = count_book_borr-1;
            $('.find_book_count').each(function(){
                $(this).html("<center>"+count+"</center>");
                count++;
            });
            // console.log(data_book_borr)
        })

        $('.btn_sel_book').on('click',function(){
            var val = $(this).parent().parent().find("input[name='text_book']").val();
            if (mem_main.length==0) {
                ajax_book_mem(val);
            }
            else{
                // console.log(mode)
                if (mode == 1) {
                    var check_same = 0;
                        for (let i = 0; i < data_book_borr.length; i++) {
                            if(val == data_book_borr[i][0]) {
                                check_same =1;
                                break;
                            }
                        }
                        if (check_same==0) {
                            ajax_book_borr(val);
                        }
                        else{
                            alert('ทรัพยากรอยู่ในคิวแล้ว');
                        }
                }else{
                    ajax_book_ret(mem_main[0]['ID'],val);
                }
            }
            $(this).parent().parent().find("input[name='text_book']").val("");
        })

        $('#text_book').on('keypress',function(key){
            if (key.which=='13') {
                var val = $(this).val();
                if (mem_main.length==0) {
                    ajax_book_mem(val);
                }
                else{
                    // console.log(mode)
                    if (mode == 1) {
                        var check_same = 0;
                        for (let i = 0; i < data_book_borr.length; i++) {
                            if(val == data_book_borr[i][0]) {
                                check_same =1;
                                break;
                            }
                        }
                        if (check_same==0) {
                            ajax_book_borr(val);
                        }
                        else{
                            alert('ทรัพยากรอยู่ในคิวแล้ว');
                        }
                    }else{
                        ajax_book_ret(mem_main[0]['ID'],val);
                    }
                }
                $(this).val("");
            }
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

        $('.btn_his_fine_ppat_back').on('click',function(){
            his_fine_now_page--;
            his_fine_page_1=(his_fine_now_page-1)*10;
            his_fine_page_2=his_fine_page_1+10;
            append_table_his_fine(his_fine_page_1,his_fine_page_2)
            if (his_fine_now_page==1) {
                $(this).prop("disabled", true)
            }
            else{
                $(this).prop("disabled", false)
            }
            if (his_fine_now_page!=his_fine_all_page) {
                $('.btn_his_fine_ppat_next').prop("disabled", false)
            }
            $('.text_his_fine_ppat_now').val(his_fine_now_page);
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

        $('.btn_his_fine_ppat_next').on('click',function(){
            his_fine_now_page++;
            his_fine_page_1=(his_fine_now_page-1)*10;
            his_fine_page_2=his_fine_page_1+10;
            append_table_his_fine(his_fine_page_1,his_fine_page_2)
            // console.log(his_fine_now_page)
            if (his_fine_now_page==his_fine_all_page) {
                $(this).prop("disabled", true)
            }
            else{
                $(this).prop("disabled", false)
            }
            if (his_fine_now_page!=1) {
                $('.btn_his_fine_ppat_back').prop("disabled", false)
            }
            $('.text_his_fine_ppat_now').val(his_fine_now_page);
        })

        $('.table_book_due').on('click','.btn_ret',function(){
            var val = $(this).attr('value');
            ajax_book_ret(mem_main[0]['ID'],val);
        })

        $('.save_ret').on('click',function(){
            ajax_save_ret();
        })

        $('.save_borr').on('click',function(){
            ajax_save_borr();
        })

        $('.a_book_borr').on('click',function(){
            mode = 1;
        })

        $('.a_book_ret').on('click',function(){
            mode = 0;
        })


    </script>
    
    <style>
        @page { 
            size: A4;
            /* width: 21cm;
            height: 29.7cm; */
            margin: 0 auto;
        }
        @page :left {
            margin-left: 2cm;
        }
        @page :right {
            margin-right: 1cm;
        }
        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {
            body * {
                visibility:hidden;
            }
            #printSection, #printSection * {
                visibility:visible;
            }
            #printSection {
                position:absolute;
                border: 1px solid black;
                /* left:0;
                right:0; */
                top:10px;
            }
            .hidden_print{
                visibility:hidden !important;
                display: hidden !important;
            }
        }

    </style>
