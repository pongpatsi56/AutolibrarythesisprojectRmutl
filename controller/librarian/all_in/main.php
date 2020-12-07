   
   
    <?php
        session_start();
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/controller/librarian/cal_date.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/datehelper.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";
        
    ?>
   <br><br><br>
   <input type="hidden" class="username" value="<?php echo $_SESSION['Username']; ?>">


    <section class="container">
        <div class="row" style="padding-top: 20px;padding-bottom: 200px; background-color: #eee;">
            <a href="../librarian/librarian.php" ><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40' ></i></a>
            <center>
                <fieldset style="border: 1px solid silver;margin: 0 2px;border-style:outset;border-color:FFFFCC;padding: .625em .625em .75em;margin: 0 290px; background-color:#CCC;">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <label  class="control-label col-sm-2" for="pwd">สมาชิก:</label>
                            <input type="text" tabindex="-1" class="form-control input_member_code" autocomplete="off">
                            <button type="submit" class="btn btn-primary btn_member_code" name="menu">ค้นหา</button>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <label  class="control-label col-sm-2" for="pwd">ค้นหา:</label>
                            <input type="text" tabindex="-1" class="form-control input_member_find" autocomplete="off">
                            <button type="submit" class="btn btn-primary btn_member_find" name="menu">ค้นหา</button>
                        </div>
                    </div>
                </fieldset>
            </center>
        </div>

        <table class="table table_member">
            <thead>
            </thead>
            <tbody>
            </tbody>
        </table>

        <fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em;" class="mem_detail">
        </fieldset> 

        <nav>
            <div class="nav nav-tabs " id="nav-tab" role="tablist">
                <ul class="nav nav-pills">
                    <li><a class="nav-item nav-link active" id="nav-borrow-tab" data-toggle="tab" href="#nav-borrow" role="tab" aria-controls="nav-borrow" aria-selected="true">ยืม</a></li>
                    <li><a class="nav-item nav-link" id="nav-return-tab" data-toggle="tab" href="#nav-return" role="tab" aria-controls="nav-return" aria-selected="false">คืน</a></li>
                    <li><a class="nav-item nav-link" id="nav-fine-tab" data-toggle="tab" href="#nav-fine" role="tab" aria-controls="nav-fine" aria-selected="false">ค่าปรับ</a></li>
                    <li><a class="nav-item nav-link" id="nav-miss-tab" data-toggle="tab" href="#nav-miss" role="tab" aria-controls="nav-miss" aria-selected="false">แจ้งหาย</a></li>
                </ul>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-borrow" role="tabpanel" aria-labelledby="nav-borrow-tab"></div>
            <div class="tab-pane fade" id="nav-return" role="tabpanel" aria-labelledby="nav-return-tab"></div>
            <div class="tab-pane fade" id="nav-fine" role="tabpanel" aria-labelledby="nav-fine-tab"></div>
            <div class="tab-pane fade" id="nav-miss" role="tabpanel" aria-labelledby="nav-miss-tab"></div>
        </div>

    </section>

    <br><br><br><br><br>
    <footer>
        <div class="row" >
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
            <div class="col-md-8 col-sm-12" >
                <div class="list-text-footer row" >
            
                <div class="address-text-fooster col-md-12" >
                    ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา : 128 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่ 50300<br>
                    โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183            </div>
    
                </div>
            </div>
        </div> 
    </footer>

    <script>

        var data_member = null;
        var table_pag = null;
        var his_select_text_book = [];
        var borrow_bookVal = [];
        var k=0;
        var keep = [];
        var username = $('.username').val();



        Object.size = function(obj) {
            var size = 0,
                key;
            for (key in obj) {
                if (obj[key].length != 0) size++;
            }
                return size;
        };


        $(document).ready(function () {
            
        });

        $(document).ready(function(){
            if ($('.mem_detail').children().length==0) {
                $('.mem_detail').hide()
            }
        });

        $('.btn_member_code').on('click',function(){
            val = $(this).parent().find('.input_member_code').val();
            member_code(val,1);
            $(this).parent().find('.input_member_code').val(null);
        });

        $('.btn_member_find').on('click',function(){
            val = $(this).parent().find('.input_member_find').val();
            member_code(val,2);
            $(this).parent().find('.input_member_find').val(null);
        });

        $('.input_member_code').keypress(function (e) {
            var key = e.which;
            if(key == 13)
            {
                val = $(this).val();
                member_code(val,1);
                $(this).val(null);
            }
        });    

        $('.input_member_find').keypress(function (e) {
            var key = e.which;
            if(key == 13)
            {
                val = $(this).val();
                member_code(val,2);
                $(this).val(null);
            }
        });


        $('#nav-borrow-tab').on('click',function(){
            $('#nav-borrow').empty();
            var stack = "";
            if (data_member != null) {
                stack += "<div>";
                    stack += "<input type='text' class='form-control borrow_book'>";
                    stack += "<table class='borrow_table_res'>";
                        stack += "<thead>";
                        stack += "</thead>";
                        stack += "<tbody>";
                        stack += "</tbody>";
                    stack += "</table>";
                    stack += "<button class='borrow_submit' >ยืนยัน</button>";
                stack += "<div>";
            }
            $('#nav-borrow').append(stack);
        });

        $('#nav-borrow').on('keyup',function(){
            var select = $('.borrow_book').val();
            if (select.length==3&&$.inArray(select, his_select_text_book) < 0) {
                table_check();
                find_book(select);
                his_select_text_book.push(select);
                $('.borrow_book').val('');
            }
            else if(select.length==3&&$.inArray(select, his_select_text_book) >= 0){
                $('.borrow_book').val('');
            }
        });

        $('#nav-borrow').on('click','.del', function() {
            var select = $(this);
            var myid = $(this).attr('id').substr(4);
            var parent = select.parent().parent().parent().find('.text'+myid);
            $(parent).remove();
            his_select_text_book[myid]="";
            borrow_bookVal[myid] = "";
            var tbody_count = $('.borrow_table_res tbody tr').length;
            if (tbody_count==0) {
                $('.borrow_table_res thead tr').remove();
            }
        });

        $('#nav-borrow').on('click','.borrow_submit', function(){
            borrow_check_status(borrow_bookVal);
        });


        function borrow_check_status(borrow_bookVal) {
            $.ajax({
                url: 'check_status.php',
                type: 'post',
                data: {
                    data : borrow_bookVal
                },
                success: function (response) {
                    var arr_item = JSON.parse(response);
                    if (arr_item.length != 0 ) {
                        alert_cant(arr_item);
                    }
                    else{
                        savebook(borrow_bookVal,data_member[0]);
                    }
                }
            });
        }

        function alert_cant(obj) {
            stack = "";
            stack += "ไม่สามารถยืมได้เนื่องจากรายการมีหนังสือที่ไม่ว่าง";
            alert(stack);
        }

        function savebook(borrow_bookVal,member) {
            var jsonString = JSON.stringify(borrow_bookVal);
            $.ajax({
                url: 'savebook.php',
                type: 'post',
                data: {
                        data : jsonString,
                        member : member,
                        username : username,
                },
                success: function (response) {
                    console.log(response);
                    alert("ยืมสำเร็จ");
                    location.reload();
                }
            });
        }

        function find_book(id) {
            $.ajax({
                url: 'findBook.php',
                type: 'post',
                data:{
                    key : id,
                },
                success: function (response) {
                    if (response=='no') {
                        
                    }
                    else{
                        var arr_data = JSON.parse(response);
                    }
                    cre_text(arr_data,id);
                }
            });
        }

        function cre_text(code,id) {
            var size = Object.size(code[id]);
            var i = 0;

            if(size!=0){
                borrow_bookVal.push(id);
            }
            if (size==3){
                $('.borrow_table_res tbody').append('<tr class="text'+k+'" >');
                for (key in code[id]) {
                    if (key ==  "Author") {
                        $('.borrow_table_res tbody tr.text'+k).append('<td><input type="text" name="booktext[]" class="form-control text'+k+'" value="'+code[id][key]['#a']+'" id="text'+k+'" disabled></td>');
                    }
                    else if(key == "Publication"){
                        $('.borrow_table_res tbody tr.text'+k).append('<td><input type="text" name="booktext[]" class="form-control text'+k+'" value="'+code[id][key]['#b']+'" id="text'+k+'" disabled></td>');
                    }
                    else if(key == "Title"){
                        $('.borrow_table_res tbody tr.text'+k).append('<td><input type="text" name="booktext[]" class="form-control text'+k+'" value="'+code[id][key]['#a']+'" id="text'+k+'" disabled></td>');
                    }
                }
            }

            if (size!=3&&size != 0){
                var temp_code = [];
                for (key in code[id]) {
                    temp_code.push(key);
                }
                $('.borrow_table_res tbody').append('<tr class="text'+k+'" >');
                if ($.inArray('Author',temp_code) < 0) {
                    $('.borrow_table_res tbody tr.text'+k).append('<td><input type="text" name="booktext[]" class="form-control" value="'+code[id]['Title']['#a']+'" id="text'+k+'" disabled></td>');
                    $('.borrow_table_res tbody tr.text'+k).append('<td><input type="text" name="booktext[]" class="form-control" value="-" id="text'+k+'" disabled></td>');
                    $('.borrow_table_res tbody tr.text'+k).append('<td><input type="text" name="booktext[]" class="form-control" value="'+code[id]['Publication']['#b']+'" id="text'+k+'" disabled></td>');
                }
                else if($.inArray('Publication',temp_code) < 0){
                    $('.borrow_table_res tbody tr.text'+k).append('<td><input type="text" name="booktext[]" class="form-control" value="'+code[id]['Title']['#a']+'" id="text'+k+'" disabled></td>');
                    $('.borrow_table_res tbody tr.text'+k).append('<td><input type="text" name="booktext[]" class="form-control" value="'+code[id]['Author']['#a']+'" id="text'+k+'" disabled></td>');
                    $('.borrow_table_res tbody tr.text'+k).append('<td><input type="text" name="booktext[]" class="form-control" value="-" id="text'+k+'" disabled></td>');
                }
                else if($.inArray('Title',temp_code) < 0){
                    $('.borrow_table_res tbody tr.text'+k).append('<td><input type="text" name="booktext[]" class="form-control" value="-" id="text'+k+'" disabled></td>');
                    $('.borrow_table_res tbody tr.text'+k).append('<td><input type="text" name="booktext[]" class="form-control" value="'+code[id]['Author']['#a']+'" id="text'+k+'" disabled></td>');
                    $('.borrow_table_res tbody tr.text'+k).append('<td><input type="text" name="booktext[]" class="form-control" value="'+code[id]['Publication']['#b']+'" id="text'+k+'" disabled></td>');
                }
            }
            if (size != 0) {
                $('.borrow_table_res tbody tr.text'+k).append('<td><button id="text'+k+'" class="btn del" type="button" >ยกเลิก</button></td></tr>');
                keep.push(k);
            }
            k++;
        }

        function table_check(){
            head = $('.borrow_table_res thead tr').length ;
            stack = "";
            stack += "<tr>";
            stack += "<th>";
                stack += "<label class='control-label' for='pwd'>ชื่อเรื่อง</label>";
            stack += "</th>";
            stack += "<th>";
                stack += "<label class='control-label' for='pwd'>ผู้เขียน</label>";
            stack += "</th>";
            stack += "<th>";
                stack += "<label class='control-label' for='pwd'>สำนักพิมพ์</label>";
            stack += "</th>";
            stack += "</tr>";
            if (head==0) {
            $('.borrow_table_res thead').append(stack);
            }
        }


        $('.table_member').on('click','.select_member',function(){
            mem = $(this).parent().parent().find('td.id_mem').html();
            for (let i = 0; i < data_member.length; i++) {
                if (data_member[i]['ID']==mem) {
                    data_member[0] = data_member[i];
                }                
            }
            $('.mem_detail').empty();
            $('.table_member thead').empty();
            $('.table_member tbody').empty();
            show_member_detail();
        });

        function member_code(val,type){
            $.ajax({
                url: 'ajax_member.php',
                type: 'post',
                data:{
                    val:val,
                    type:type,
                },
                success: function (response) {
                    if (response!=1) {
                        data_member = JSON.parse(response)
                    }
                    $('.mem_detail').empty();
                    if($('.table_member thead').children().length!=0||$('.table_member tbody').children().length!=0){
                        $('.table_member thead').empty();
                        $('.table_member tbody').empty();
                    }
                    if(response==1){
                        $('.table_member thead').append('<th>ไม่มีข้อมูล</th>');
                        $('.mem_detail').hide();
                    }
                    if (type==2&&response!=1) {
                        $('.mem_detail').hide();
                        show_table_member();
                    }
                    else if(type==1&&response!=1){
                        show_member_detail();
                    }
                }
             });
        }

        function show_table_member(){
            var stack = "";
            if ($('.table_member thead').children().length==0) {
                stack += "<tr>";
                    stack += "<th scope='col' width = '12%'>";
                        stack += "<center>รหัส</center>";
                    stack += "</th>";
                    stack += "<th scope='col' width = '15%'>";
                        stack += "ชื่อ";
                    stack += "</th>";
                    stack += "<th scope='col' width = '15%'>";
                        stack += "นามสกุล";
                    stack += "</th>";
                    stack += "<th width = '13%'>";
                        stack += "คณะ";
                    stack += "</th>";
                    stack += "<th width = '15%'>";
                        stack += "สาขา";
                    stack += "</th>";
                    stack += "<th width = '13%'>";
                        stack += "เบอร์โทร";
                    stack += "</th>";
                    stack += "<th width = '16%'>";
                        stack += "อีเมล";
                    stack += "</th>";
                stack += "</tr>";
            }
            $('.table_member thead').append(stack);
            stack = "";
            if ($('.table_member tbody').children().length==0) {
                for (let i = 0; i < data_member.length; i++) {
                    stack += "<tr>";
                        stack += "<td height='40' class='id_mem'>";
                            stack += data_member[i]['ID'];
                        stack += "</td>";
                        stack += "<td height='40'>";
                            stack += "<a class='text-primary select_member'>"+data_member[i]['FName']+"</a>";
                        stack += "</td>";
                        stack += "<td height='40'>";
                            stack += "<a class='text-primary select_member'>"+data_member[i]['LName']+"</a>";
                        stack += "</td>";
                        stack += "<td height='40'>";
                            stack += data_member[i]['Faculty'];
                        stack += "</td>";
                        stack += "<td height='40'>";
                            stack += data_member[i]['Major'];
                        stack += "</td>";
                        stack += "<td height='40'>";
                            stack += data_member[i]['Tel'];
                        stack += "</td>";
                        stack += "<td height='40'>";
                            stack += data_member[i]['Email'];
                        stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_member tbody').append(stack);
            }
        }

        function show_member_detail(){
                $('.mem_detail').empty();
                $('.mem_detail').show();
            var stack = "";
            stack += "<legend style+='width: auto;padding:0 5px 0 5px;'>รายละเอียดสมาชิก</legend>";
            stack += "<br>";
            stack += "<div class='form-group'>";
                stack += "<label class='control-label col-sm-1' for='pwd'>ชื่อ:</label>";
                    stack += "<div class='col-sm-3'>";
                        stack += "<input type='text' class='form-control'  value='"+data_member[0]['FName']+"' disabled >";
                    stack += "</div>";
                stack += "<label class='control-label col-sm-1' for='pwd'>นามสกุล:</label>";
                    stack += "<div class='col-sm-3'> ";
                        stack += "<input type='text' class='form-control'  value='"+data_member[0]['LName']+"' disabled>";
                    stack += "</div>";
            stack += "<div class='form-group'>";
                stack += "<label class='control-label col-sm-1' for='pwd'>คณะ:</label>";
                    stack += "<div class='col-sm-3'>";
                        stack += "<input type='text' class='form-control'  value='"+data_member[0]['Faculty']+"' disabled>";
                    stack += "</div>";
                stack += "<br><br><br>";
            stack += "<div class='form-group'>";
                stack += "<label class='control-label col-sm-1' for='pwd'>สาขา:</label>";
                    stack += "<div class='col-sm-3'>";
                        stack += "<input type='text' class='form-control'  value='"+data_member[0]['Major']+"' disabled>";
                    stack += "</div>";
            stack += "<div class='form-group'>";
                stack += "<label class='control-label col-sm-1' for='pwd'>เบอร์โทร:</label>";
                    stack += "<div class='col-sm-3'> ";
                        stack += "<input type='text' class='form-control'  value='"+data_member[0]['Tel']+"' disabled>";
                    stack += "</div>";
                stack += "<label class='control-label col-sm-1' for='pwd'>อีเมล:</label>";
                    stack += "<div class='col-sm-3'>";
                        stack += "<input type='text' class='form-control'  value='"+data_member[0]['Email']+"' disabled>";
                    stack += "</div>";
                stack += "<br><br><br>";
            stack += "<div class='form-group'>";
                stack += "<label class='control-label col-sm-1' for='pwd'>ที่อยุ่:</label>";
                    stack += "<div class='col-sm-3'>";
                        stack += "<textarea class='form-control' disabled>"+data_member[0]['Address']+"</textarea>";
                stack += "<br><br><br>";
            $('.mem_detail').append(stack);
        }

    // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // return_code
        var ret_book_his_main=[];
        var ret_book_his_lib=[];
        var ret_book_his_book=[];
            var vals = [];
        var his_book = [];

    $('.unturn').hover(function() {
        $('.unturn').css('cursor', 'pointer');
        $(this).css('text-decoration', 'underline');
    }, function() {
        $(this).css('text-decoration', 'none');
    });
    var lastValue = '';

    function start() {
        setInterval(function() {
            if ($(".return_book").val() != lastValue) {
                lastValue = $(".return_book").val();
                book_ajax(lastValue);
            }
        }, 500);
    }
    
    $('#nav-return-tab').on('click',function(){
        his_book_show();
        $('#nav-borrow').empty();
        $('#nav-return').empty();
        var stack = "";
        if (data_member != null) {
            stack += "<div>";
                stack += "<input type='text' class='form-control return_book'>";
                stack += "<button class='return_submit' >ยืนยัน</button>";
            stack += "<div>";
            stack += "<table class='return_table_res'>";
                stack += "<thead>";
                stack += "</thead>";
                stack += "<tbody>";
                stack += "</tbody>";
            stack += "</table>";
            stack += "<table class='ret_table'>";
                stack += "<thead>";
                stack += "</thead>";
                stack += "<tbody>";
                stack += "</tbody>";
            stack += "</table>";
        }
        $('#nav-return').append(stack);
        start() 
    });

    $('#nav-return').on('click', '.del_book', function() {
            //   check_table_res();
              var select = $(this);
              var select_par = $(this).parent().parent();
              var select_input_name = $(this).parent().parent().find('input[name=namebook]');
              var select_input_val = $(this).parent().parent().find('input[name=vals]');
              var item_name = select_input_name.val();
              var item_val = select_input_val.val();
              console.log('in');

              his_book = jQuery.grep(his_book, function(value) {
                return value != item_name;
              });

              vals = jQuery.grep(vals, function(value) {
                return value != item_val;
              });

              select_par.remove();
            });

    function check_table_res() {
        if ($('.ret_table tbody tr').length == 1) {
        $('.ret_table').hide();
        }
    }

    function his_book_show(){
        $.ajax({
            url: 'ajax_return_his_main.php',
            type: 'post',
            data: {
                member: data_member[0]['ID'],
            },
            success: function(response) {
                if (response != "") {
                    ret_book_his_main=JSON.parse(response);
                }
                console.log(ret_book_his_main);
            }
        });
        $.ajax({
            url: 'ajax_return_his_lib.php',
            type: 'post',
            data: {
                member: data_member[0]['ID'],
            },
            success: function(response) {
                if (response != "") {
                    ret_book_his_lib=JSON.parse(response);
                }
                console.log(ret_book_his_lib);
            }
        });
        $.ajax({
            url: 'ajax_return_his_book.php',
            type: 'post',
            data: {
                member: data_member[0]['ID'],
            },
            success: function(response) {
                if (response != "") {
                    ret_book_his_book=JSON.parse(response);
                    append_table_ret();
                }
                console.log(ret_book_his_book);
            }
        });
    }

    function append_table_ret(){
        stack = "";
        stack += "<tr>";
            stack += "<th width='15%'>ผู้ให้ยืม</th>";
            stack += "<th width='20%'>สมาชิก</th>";
            stack += "<th width='25%'>ชื่อทรัพยากร</th>";
            stack += "<th width='10%'>ยืมวันที่</th>";
            stack += "<th width='10%'>กำหนดคืน</th>";
            stack += "<th width='10%'>วันที่คืน</th>";
            stack += "<th width='10%'>สถานะ</th>";
        stack += "</tr>";
        $('.return_table_res thead').append(stack);
        stack = "";
        console.log(ret_book_his_book.length);
        if (ret_book_his_book.length!=0) {
            for (let i = 0; i < ret_book_his_book.length; i++) {
                stack += "<tr>";
                stack += "<td>"+ret_book_his_lib[i]['FName']+"</td>";
                stack += "<td>"+data_member[i]['FName']+"</td>";
                stack += "<td  class='unturn'>"+ret_book_his_book[i]['Subfield']+"</td>";
                stack += "<td>"+ret_book_his_main[i]['Borrow']+"</td>";
                stack += "<td>"+ret_book_his_main[i]['Returns']+"</td>";
                stack += "<td>"+ret_book_his_main[i]['Due']+"</td>";
                if (ret_book_his_main[i]['Due']=="-") {
                    stack += "<td>ยังไม่ได้คืน</td>";
                }
                else{
                    stack += "<td>คืนแล้ว</td>";
                }
                stack += "</tr>";
                $('.return_table_res tbody').append(stack);
                stack = "";
            }
        }
    }

    function book_ajax(valBook) {
        $.ajax({
            url: 'ajax_return.php?',
            type: 'post',
            data: {
                book: valBook
            },
            success: function(response) {
                if (response != "") {
                    if (jQuery.inArray(response, his_book) == -1) {
                        append_book(valBook, response);
                        his_book.push(response);
                    }
                }
            }
        });
    }

    function append_book(valBook, nameBook) {
        if ($('.ret_table thead tr').length == 0) {
            var stack = "";
            stack += "<tr>";
                stack += "<th>";
                    stack += "<b>Barcode";
                stack += "</th>";
                stack += "<th>";
                    stack += "<b>ชื่อหนังสือ";
                stack += "</th>";
                stack += "<th>";
                    stack += "";
                stack += "</th>";
            stack += "</tr>";
            $('.ret_table thead').append(stack);
            stack = "<tr>";
                stack += "<input type='hidden' name='namebook' value='" + nameBook + "'>";
                stack += "<input type='hidden' name='vals' value='" + valBook + "'>";
                stack += "<td>";
                    stack += valBook;
                stack += "</td>";
                stack += "<td>";
                    stack += nameBook;
                stack += "</td>";
                stack += "<td>";
                    stack += "<a class='btn btn-danger del_book'>ลบ</a>";
                stack += "</td>";
            stack += "</tr>";
            stack += "";
            $('.ret_table tbody').append(stack);
            } 
            else if ($('.ret_table thead tr').length != 0) {
                var stack = "";
                stack += "<tr>";
                stack += "<input type='hidden' name='namebook' value='" + nameBook + "'>";
                stack += "<input type='hidden' name='vals' value='" + valBook + "'>";
                    stack += "<td>";
                        stack += valBook;
                    stack += "</td>";
                    stack += "<td>";
                        stack += nameBook;
                    stack += "</td>";
                    stack += "<td>";
                        stack += '<a class="btn btn-danger del_book">ลบ</a>';
                    stack += "</td>";
                stack += "</tr>";
                $('.table_res tbody').append(stack);
              }
            }

    </script>
        
        <style>
            .unturn {
                color: blue;
            }
        </style>