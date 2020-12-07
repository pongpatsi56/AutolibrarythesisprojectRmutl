
    <?php 
    
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    ?>
<style>
	.table {
		font-size: 12px;
		font-family: sans-serif;
	}

	.theadmodal {
		background-color: lightgray;
	}

	.tdmodal {
		background-color: #f5f5f5;
	}
	
	.sel_mem_id{
	    cursor:pointer;
	}
	
</style>
    <br><br><br>
    <link type="text/css" rel="stylesheet" href="/lib/css/jquery.autocomplete.css" />
    <section class="container">
        <div class="row" style="padding-top: 20px;paddingbottom: 200px; background-color: #eee;">
            <a href="/lib/view/librarian/add.php">
                <div class="col-md-12">
                    <img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i>
            </a>
            &nbsp;&nbsp;<b style="font-size: 25px;">จัดการข้อมูลสารสนเทศ</b>

            <div class="col-sm-12">
                <br>
                <div class="col-sm-1">
                    <b>ค้นหา:</b>
                </div>
                <div class="col-sm-3">
                    <select class="form-control temp_name"></select>
                </div>
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary btn_find">เลือก</button>
                    &nbsp; &nbsp;
                    <button class="add_item btn btn-primary" >เพิ่มเขตข้อมูล</button>
                    &nbsp; &nbsp;
                       <button class="add_bib_item btn btn-warning" style="color: #364238;">เพิ่มรายการ(Item)</button>
                    &nbsp; &nbsp;
                    <button class="btn btn-default"><input type='file' class=' modal_img' name='img'></button>
                    &nbsp; &nbsp;
                </div>
                <br>
                <br>
                <br>
                <div class="col-sm-2"> 
                    ประเภททรัพยากร : 
                </div>
                <div class="col-sm-3"> 
                <select name="resouce_type" id="resouce_type" class='form-control'>
                        <option value="#a=1">Mixed</option>
                        <option value="#b=1">Article</option>
                        <option value="#c=1" selected>Book</option>
                        <option value="#d=1">Computer File</option>
                        <option value="#e=1">Map</option>
                        <option value="#f=1">Music</option>
                        <option value="#g=1">Serial</option>
                        <option value="#h=1">Visual</option>
                    </select>
                </div>
                <div class="col-sm-1">
                    สถานที่ : 
                </div>
                <div class="col-sm-6">
                    <!-- <input type="text" class="form-control location_val" readonly> -->
                    <select name="location_res" id="location_res" class=' form-control'>
                        <option value="rmutl">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</option>
                        <option value="rmutl(7)">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา วิทยาเขตภาคพายัพ (เจ็ดยอด)</option>
                        <option value="rmutl(J)" selected>มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา จอมทอง</option>
                    </select>
                </div>
                <!-- <div class="col-sm-2">
                    <button class="btn-primary btn location_btn">คลิกเพื่อเลือกสถานที่</button>
                </div> -->
                <br><br><br>

                <center>
                    <table class='table_main'>
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table><br>
                    <button class="save btn btn-success">บันทึก</button>

                </center>
                <br><br><br>
                <br><br><br>
                <br><br><br>
                <br><br><br>
                <br><br><br>
                <br><br><br>
                <br><br>


    </section>

    <!----------------------------------modal_sub--------------------------------------------------------->
    <div class="modal fade" id="modal_set" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 800;left: -120;">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel"></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="sp_div">
                    </div>
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
                    <button type="button" class="btn_save btn btn-success ">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------modal_sub--------------------------------------------------------->

    
    <!----------------------------------modal_item--------------------------------------------------------->
    <div class="modal fade" id="modal_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 1000;left: -200;">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">เพิ่มItem</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                       <b> ค้นหาบรรณานุกรม<b> <input style="width: 300; display: inherit;" type="text" class="form-control find_bib" >
                        <button class="btn btn-primary btn_find_bib">ค้นหา</button>
                    </div>
                    <br>
                    <table class="table table_bib" > 
                        <thead class="theadmodal">
                        </thead>
                        <tbody class="tdmodal">
                        </tbody>
                    </table>
                                            

                    <div class="ppat" style="text-align: center;" >
                        <ul class="pagination" style="display:unset; float:unset;" >
                        
                        <li>
                            <button type="button" class="btn btn-default btn_data_bib_item_back">ย้อนกลับ</button>
                        </li>
                        <li>
                            <input type="button" class="btn text_data_bib_item_now" disabled>
                            <button class="btn" style="cursor: default;">/</button>
                            <input type="button" class="btn text_data_bib_item_all" disabled>
                        </li>
                        <li>
                            <button type="button" class="btn btn-default btn_data_bib_item_next" >ต่อไป</button>
                            </li>
                    </ul>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class=" btn btn-success ">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------modal_item--------------------------------------------------------->

    <!----------------------------------modal_add_item--------------------------------------------------------->
    <div class="modal fade" id="modal_add_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 1000;left: -210;">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">เพิ่มItem</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav class="navbar navbar-light">
                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="pill" href="#resouce_book_item" style="font-family:kanit;">ทรัพยากรสารสนเทศน์</a></li>
                            <li class="journal_bib"><a data-toggle="pill" href="#resouce_journal_item" style="font-family:kanit;">วารสาร</a></li>
                        </ul>
                    </nav>

                    <div class="tab-content">
                        <div id="resouce_book_item" class="tab-pane fade in active">
                            ฉบับที่ <input type="text" class="form-control text_copy" style="width: 300;display: initial;">
                            <button class=" btn btn-primary btn_add_bib_item">เพิ่มฉบับ</button>
                            <button class="btn btn-warning btn_show_marc" style="color: #364238;" >ดู MARC</button>
                            <br><br>
                            <table class="table table_bib_item" > 
                                <thead  class="theadmodal">
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <div id="resouce_journal_item" class="tab-pane fade in ">
                            <button class=" btn btn-primary btn_add_article">เพิ่มบทความ</button>
                            <table class="table table_article_item" > 
                                <thead  class="theadmodal">
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------modal_add_item--------------------------------------------------------->
   
    <!----------------------------------modal_show_marc--------------------------------------------------------->
    <div class="modal fade" id="modal_show_marc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 1000;left: -200;">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel"></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table_marc" > 
                        <thead class="theadmodal">
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------modal_show_marc--------------------------------------------------------->
    
    <!----------------------------------modal_add_article--------------------------------------------------------->
    <div class="modal fade" id="modal_add_article" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 1000;left: -200;">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel"></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button class="btn_primary btn_add_marc_article">เพิ่มเขตข้อมูล</button>
                    <table class="table table_marc_article" > 
                        <thead class="theadmodal">
                            <tr>
                                <th>
                                    เขตข้อมูล  
                                </th>
                                <th>
                                    ตัวบ่งชี้ 1
                                </th>
                                <th>
                                    ตัวบ่งชี้ 2
                                </th>
                                <th>
                                    เขตข้อมูลย่อย
                                </th>
                                <th>
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn_save_article btn btn-success ">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------modal_add_article--------------------------------------------------------->

    <!----------------------------------modal_sub_article--------------------------------------------------------->
    <div class="modal fade" id="modal_sub_article" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 800;left: -120;">
                <div class="modal-header">
                    <h2 class="modal-title-article" id="modal_title_sub_article"></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="sp_div_article">
                    </div>
                    <table class='table_modal_inc_article order1'>
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <table class='table_modal_inc_article order2'>
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <table class='table_modal_sub_article'>
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn_save_sub_article btn btn-success ">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------modal_sub_article--------------------------------------------------------->

    <!----------------------------------modal_location--------------------------------------------------------->
    <div class="modal fade" id="modal_location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 800;left: -120;">
                <div class="modal-header">
                    <h2 class="modal-title-article" id="modal_title_sub_article"></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <input type="checkbox" name="location_1" value="RMUTL" class="location_check">
                <label for="location_1">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</label><br>
                <input type="checkbox" name="location_2" value="RMUTL(7)" class="location_check">
                <label for="location_2">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา วิทยาเขตภาคพายัพ (เจ็ดยอด)</label><br>
                <input type="checkbox" name="location_3" value="RMUTL(J)" class="location_check">
                <label for="location_3">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา จอมทอง</label><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn_location_save btn btn-success ">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------modal_location--------------------------------------------------------->


    <script>
        var name_temp = null;
        var data_temp = null;
        var select_id = null;
        var it = 0;
        var arr_img = null;
        var file_data = null;
        var form_data = new FormData();
        var data_main = {};
        var inc1_pos = null;
        var inc2_pos = null;
        var sub_pos = null;
        var inc1_article_pos = null;
        var inc2_article_pos = null;
        var sub_article_pos = null;
        var data_item = [];
        var bib_id = null;
        var data_bib_item = [];
        var data_marc = [];
        var data_bib_item_all_page = 0;
        var data_bib_item_now_page = 0;
        var data_bib_item_page_1 = 0;
        var data_bib_item_page_2 = 0;
        var key_data_item = [];
        var data_article = [];
        


        Object.size = function(obj) {
            var size = 0,
                key;
            for (key in obj) {
                if (obj[key].length != 0) size++;
            }
            return size;
        };


        $(document).ready(function() {
            load_temp_name();
            // $('.save.btn').prop("disabled", true);
            check_enable_save();
        })

        $('.table_main').on('change','input[name=field]',function(){
            var edit_pos = $(this).parent().parent().find('.btn_edit')
            if ($(this).val()=="") {
                edit_pos.prop('disabled',true)
            }
            else{
                edit_pos.prop('disabled',false)
            }
            $(this).parent().parent().find('input[name=inc1]').val("")
            $(this).parent().parent().find('input[name=inc2]').val("")
            $(this).parent().parent().find('input[name=sub]').val("")

        })

        $('.location_btn').on('click',function(){
            var location_val = $(this).parent().parent().find('.location_val').val()
            check_location(location_val)
            $('#modal_location').modal('toggle')
        })

        $('.modal-footer').on('click','.btn_location_save',function(){
            var arr_val = [];
            $('.location_check:checked').each(function() {
                arr_val.push(this.value)
            });
            var char_stack = ""
            for (let i = 0; i < arr_val.length; i++) {
                char_stack += arr_val[i]+",";
            }
            char_stack = char_stack.substr(0,char_stack.length-1);
            $('.location_val').val(char_stack);
            $('#modal_location').modal('toggle')            
        })

        $('.btn_add_marc_article').on('click',function(){
            var stack = "";
            stack += "<tr>";
                stack += "<td>";
                    stack += "<input type='text' class='item_article' value='' name='field'>";
                stack += "</td>";
                stack += "<td>";
                    stack += "<input type='text' class='item_article' value='' name='inc1' disabled>";
                stack += "</td>";
                stack += "<td>";
                    stack += "<input type='text' class='item_article' value='' name='inc2' disabled>";
                stack += "</td>";
                stack += "<td>";
                    stack += "<input type='text' class='item_article' value='' name='subfield' disabled>";
                stack += "</td>";
                stack += "<td>";
                    stack += "<button class='btn-primary btn_edit_marc_article'>แก้ไข</button>";
                stack += "</td>";
                stack += "<td>";
                    stack += "<button class='btn-primary btn_del_marc_article'>ลบ</button>";
                stack += "</td>";
            stack += "</tr>";
            $('.table_marc_article tbody').append(stack);
        })

        $('.modal-footer').on('click','.btn_save_article',function(){
            var temp = {};
            var data_article_save = {};
            var i = 0;

            $('input.item_article').each(function() {
                if ($(this).attr('name') == 'field') {
                    temp.field = $(this).val();
                } else if ($(this).attr('name') == 'inc1') {
                    temp.inc1 = $(this).val();
                } else if ($(this).attr('name') == 'inc2') {
                    temp.inc2 = $(this).val();
                } else if ($(this).attr('name') == 'subfield') {
                    temp.sub = $(this).val();
                }
                if (Object.size(temp) != 0 && Object.keys(temp).length == 4) {
                    data_article_save[i] = temp;
                    temp = {};
                    i++
                }
            });
            // console.log(data_article_save)
            ajax_save_article(data_article_save);
        })

        $('.table_marc_article').on('click','.btn_del_marc_article',function(){
            $(this).parent().parent().remove();
        })

        $('.table_marc_article').on('click','.btn_edit_marc_article',function(){
            var field = $(this).parent().parent().find('input[name=field]').val();
            var inc1 = $(this).parent().parent().find('input[name=inc1]').val();
            var inc2 = $(this).parent().parent().find('input[name=inc2]').val();
            var subfield = $(this).parent().parent().find('input[name=subfield]').val();
            inc1_article_pos = $(this).parent().parent().find('input[name=inc1]');
            inc2_article_pos = $(this).parent().parent().find('input[name=inc2]');
            sub_article_pos = $(this).parent().parent().find('input[name=subfield]');
            load_article(field,inc1,inc2,subfield)
            $('#modal_sub_article').modal('toggle');
        })

        $('.find_bib').on('keypress',function(key){
            if (key.which == 13) {
                ajax_find_bib($(this).val());
            }
        })

        $('.btn_find_bib').on('click',function(){
                ajax_find_bib($(this).parent().find('.find_bib').val());
        })

        $('.table_bib').on('click','.add_item_bib',function(){
            bib_id = $(this).attr('value');
            ajax_find_isbn_item();
            $('#modal_add_item').modal('toggle');
        })

        $('.btn_add_bib_item').on('click',function(){
            var copy = $(this).parent().find('.text_copy').val();
            ajax_add_bib_item(copy);
        })

        $('.btn_show_marc').on('click',function(){
            ajax_databib();
            $('#modal_show_marc').modal('toggle');
        })

        $('.add_bib_item').on('click',function(){
            $('#modal_item').modal('toggle');
        })

        $('.btn_find').on('click', function() {
            var id = $(this).parent().parent().find('.temp_name').val();
            if ($('.table_main thead').children().length!=0) {
                $('.table_main thead').empty();
                $('.table_main tbody').empty();
            }
            load_temp_data(id);
        })

        $('.add_item').on('click', function() {
            add_item();
            check_enable_save();
        })

        $('.table_main').on('click', '.btn_del', function() {
            var select = $(this);
            var parent = select.parent().parent();
            $(parent).remove();
            var tbody_length = $(document).find('.table_main tbody').children().length;

            if (tbody_length==0) {
                $('.table_main thead').empty();
            }
            check_enable_save();
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

        $('#modal_set').on('show.bs.modal', function() {
            $('.table_modal_inc.order1 thead').empty();
            $('.table_modal_inc.order1  tbody').empty();
            $('.table_modal_inc.order2 thead').empty();
            $('.table_modal_inc.order2  tbody').empty();
            $('.table_modal_sub thead').empty();
            $('.table_modal_sub tbody').empty();
        });

        $('#modal_sub_article').on('hidden.bs.modal', function() {
            $('.table_modal_inc_article.order1 thead').empty();
            $('.table_modal_inc_article.order1 tbody').empty();
            $('.table_modal_inc_article.order2 thead').empty();
            $('.table_modal_inc_article.order2 tbody').empty();
            $('.table_modal_sub_article thead').empty();
            $('.table_modal_sub_article tbody').empty();
        });
        
        $('#modal_add_item').on('hidden.bs.modal', function() {
            $('.table_bib_item thead').empty();
            $('.table_bib_item tbody').empty();
            $('.table_article_item thead').empty();
            $('.table_article_item tbody').empty();
        });

        $('#modal_show_marc').on('hidden.bs.modal', function() {
            $('.table_marc thead').empty();
            $('.table_marc tbody').empty();
        });

        function check_location(val){
            val = val.split(',');
            $('.location_check').each(function() {
                if (jQuery.inArray(this.value, val) !== -1) {
                    $(this).prop( "checked", true )
                }
            });
            console.log(val)
        }

        function check_enable_save(){
            // console.log($('.table_main thead').children().length);
            if ($('.table_main thead').children().length==0) {
                $('.save.btn').prop("disabled", true);
            }
            else{
                $('.save.btn').prop("disabled", false);
            }
        }

        function append_data_marc() {
            var stack = "";
            stack += "<tr>";
                stack += "<th>";
                    stack += "เขตข้อมูล";
                stack += "</th>";
                stack += "<th>";
                    stack += "ตัวบ่งชี้ 1";
                stack += "</th>";
                stack += "<th>";
                    stack += "ตัวบ่งชี้ 2";
                stack += "</th>";
                stack += "<th>";
                    stack += "เขตข้อมูลย่อย";
                stack += "</th>";
            stack += "</tr>";
            $('.table_marc thead').append(stack);
            stack = "";
            for ( i in data_marc) {
                var temp = [];
                stack += "<tr>";
                    stack += "<th>";
                        stack += i;
                    stack += "</th>";
                    stack += "<th>";
                        stack += data_marc[i]['inc1'];
                    stack += "</th>";
                    stack += "<th>";
                        stack += data_marc[i]['inc2'];
                    stack += "</th>";
                    stack += "<th>";
                    temp = data_marc[i]['sub'].split('/')
                    for (let j = 0; j < temp.length; j++) {
                        if (j!="008") {
                            temp[j] = temp[j].replace('#','$');
                            temp[j] = temp[j].replace('=','');
                        }
                        stack += temp[j]+" ";
                    }
                    stack += "</th>";
                stack += "</tr>";
            }
            $('.table_marc tbody').append(stack);
        };

        function ajax_databib() {
            // console.log(bib_id)
            $.ajax({
                url: 'ajax_databib.php',
                type: 'post',
                data: {
                    val:bib_id,
                },
                success: function(response) {
                    // console.log(response);
                    data_marc = JSON.parse(response)
                    // console.log(data_marc);
                    append_data_marc();
                }
            });
        };

        function ajax_find_isbn_item() {
            // console.log(bib_id)
            $.ajax({
                url: 'ajax_find_isbn_item.php',
                type: 'post',
                data: {
                    val:bib_id,
                },
                success: function(response) {
                    // console.log(response);
                    data_bib_item = JSON.parse(response)
                    // console.log(data_bib_item);
                    var check_journal = 0
                    for (i in data_item[bib_id]) {
                        if (i=='022') {
                            check_journal = 1;
                        }
                    }
                    // console.log('check'+check_journal)
                    if (check_journal==0) {
                        $('.journal_bib').addClass('block_click');
                    }
                    else{
                        $('.journal_bib').removeClass('block_click');
                        // ajax_data_bib_article();
                    }
                    
                    append_data_bib_item();
                }
            });
        };
        
        function ajax_add_bib_item(copy) {
            $.ajax({
                url: 'ajax_add_bib_item.php',
                type: 'post',
                data: {
                    val:bib_id,
                    copy:copy,
                },
                success: function(response) {
                    console.log(response);
                    alert('เพิ่มทรัพยากรสำเร็จ');
                    $('.text_copy').val('');
                    $('.table_bib_item thead').empty();
                    $('.table_bib_item tbody').empty();
                    ajax_find_isbn_item();
                }
            });
        };

        // function ajax_data_bib_article(copy) {
        //     $.ajax({
        //         url: 'ajax_data_bib_article.php',
        //         type: 'post',
        //         data: {
        //             val:bib_id,
        //             copy:copy,
        //         },
        //         success: function(response) {
        //             alert('เพิ่มทรัพยากรสำเร็จ');
        //             $('.table_article_item thead').empty();
        //             $('.table_article_item tbody').empty();
        //             append_data_bib_article();
        //         }
        //     });
        // };
        function load_article(field, inc1, inc2, sub) {
            $.ajax({
                url: 'ajax_load_field.php',
                type: 'post',
                data: {
                    field: field,
                },
                success: function(response) {
                    if (response.length==7||response.length==10) {
                        show_edit_article(field, inc1, inc2, sub, "sp");
                    }
                    else{
                        data_article = JSON.parse(response);
                        // console.log(data_article)
                        show_edit_article(field, inc1, inc2, sub, data_article);
                    }
                }
            });
        }

        $('.modal-body').on('change','input.modal_inc[name=inc1]', function() {
            $('input.modal_inc[name=inc1]').not(this).prop('checked', false);  
        });

        $('.modal-body').on('change','input.modal_inc[name=inc2]', function() {
            $('input.modal_inc[name=inc2]').not(this).prop('checked', false);  
        });

        $('.modal-body').on('click', '.btn_add_article', function() {
            $('#modal_add_article').modal('toggle');
        })

        $('.modal-footer').on('click', '.btn_save_sub_article', function() {
            var temp = [];
            if ($('.sp_div_article').children().length!=0) {
                $(sub_article_pos).val($('.text_sub_sp_article').val());
            }
            else{
                $(".modal_inc").each(function() {
                    if ($(this).is(':checked')) {
                        var temp_minor = [];
                        temp_minor.push($(this).parent().parent().find('input[name=order]').val());
                        temp_minor.push($(this).val());
                        temp.push(temp_minor);
                    }
                });
                if (temp.length==2) {
                    for (let i = 0; i < temp.length; i++) {
                        if (temp[i][0] == 1) {
                            $(inc1_article_pos).val(temp[i][1]);
                        } 
                        else if (temp[i][0] == 2) {
                            $(inc2_article_pos).val(temp[i][1]);
                        }
                    }
                }
                else{
                    var check_t = 0;
                    for (let i = 0; i < temp.length; i++) {
                        if (temp[i][0] == 1) {
                            $(inc1_article_pos).val(temp[i][1]);
                            check_t = 1;
                        } 
                        else if (temp[i][0] == 2) {
                            $(inc2_article_pos).val(temp[i][1]);
                            check_t = 2;
                        }
                    }
                    if (check_t == 2) {
                        $(inc1_article_pos).val("");
                        // break;
                    }
                    else if (check_t == 1) {
                        $(inc2_article_pos).val("");
                        // break;
                    }
                    else if(check_t == 0){
                        $(inc1_article_pos).val("");
                        $(inc2_article_pos).val("");
                    }
                }
                

                temp = [];
                $(".modal_sub").each(function() {
                    if ($(this).val() != "") {
                        var temp_minor = [];
                        temp_minor.push($(this).parent().parent().find('.code').html());
                        temp_minor.push($(this).val());
                        // temp_minor[0] = temp_minor[0].replace('$','#');
                        temp.push(temp_minor);
                    }
                });
                var sub = ""
                for (let i = 0; i < temp.length; i++) {
                    sub += temp[i][0] + "=" + temp[i][1] + "/";
                }
                sub = sub.substr(0, sub.length - 1)

                for (let i = 0; i < sub.length; i++) {
                    sub = sub.replace('$','#');
                }
                // console.log(sub)
                // console.log(sub_article_pos)

                $(sub_article_pos).val(sub);
            }
            
            $('#modal_sub_article').modal('toggle');
        })

        $('.modal-footer').on('click', '.btn_save', function() {
            var temp = [];
            // console.log(inc1_pos)
            // console.log(inc2_pos)
            // console.log(sub_pos)
            if ($('.sp_div').children().length!=0) {
                $(sub_pos).val($('.text_sub_sp').val());
            }
            else{
                $(".modal_inc").each(function() {
                    if ($(this).is(':checked')) {
                        var temp_minor = [];
                        temp_minor.push($(this).parent().parent().find('input[name=order]').val());
                        temp_minor.push($(this).val());
                        temp.push(temp_minor);
                    }
                });
                if (temp.length==2) {
                    for (let i = 0; i < temp.length; i++) {
                        if (temp[i][0] == 1) {
                            $(inc1_pos).val(temp[i][1]);
                        } 
                        else if (temp[i][0] == 2) {
                            $(inc2_pos).val(temp[i][1]);
                        }
                    }
                }
                else{
                    var check_t = 0;
                    for (let i = 0; i < temp.length; i++) {
                        if (temp[i][0] == 1) {
                            $(inc1_pos).val(temp[i][1]);
                            check_t = 1;
                        } 
                        else if (temp[i][0] == 2) {
                            $(inc2_pos).val(temp[i][1]);
                            check_t = 2;
                        }
                    }
                    if (check_t == 2) {
                        $(inc1_pos).val("");
                        // break;
                    }
                    else if (check_t == 1) {
                        $(inc2_pos).val("");
                        // break;
                    }
                    else if(check_t == 0){
                        $(inc1_pos).val("");
                        $(inc2_pos).val("");
                    }
                }
                

                temp = [];
                $(".modal_sub").each(function() {
                    if ($(this).val() != "") {
                        var temp_minor = [];
                        temp_minor.push($(this).parent().parent().find('.code').html());
                        temp_minor.push($(this).val());
                        // temp_minor[0] = temp_minor[0].replace('$','#');
                        temp.push(temp_minor);
                    }
                });
                var sub = ""
                for (let i = 0; i < temp.length; i++) {
                    sub += temp[i][0] + "=" + temp[i][1] + "/";
                }
                sub = sub.substr(0, sub.length - 1)

                for (let i = 0; i < sub.length; i++) {
                    sub = sub.replace('$','#');
                }

                $(sub_pos).val(sub);
            }

            
            $('#modal_set').modal('toggle');

        });

        $('.save').on('click', function() {
            var temp = {};
            var i = 0;
            $('input.item').each(function() {
                if ($(this).attr('name') == 'field') {
                    temp.field = $(this).val();
                } else if ($(this).attr('name') == 'inc1') {
                    temp.inc1 = $(this).val();
                } else if ($(this).attr('name') == 'inc2') {
                    temp.inc2 = $(this).val();
                } else if ($(this).attr('name') == 'sub') {
                    temp.sub = $(this).val();
                }

                if (Object.size(temp) != 0 && Object.keys(temp).length == 4) {
                    data_main[i] = temp;
                    temp = {};
                    i++
                }
            });
                data_main[++i] = {'field':'951','inc1':'','inc2':'','sub':'#a='+$('#location_res').val()}
                data_main[++i] = {'field':'964','inc1':'','inc2':'','sub':$('#resouce_type').val()}
            ajax_upload();

        });

        $('.btn_data_bib_item_back').on('click',function(){
            data_bib_item_now_page--;
            data_bib_item_page_1=(data_bib_item_now_page-1)*10;
            data_bib_item_page_2=data_bib_item_page_1+10;
            append_data_item(data_bib_item_page_1,data_bib_item_page_2)
            if (data_bib_item_now_page==1) {
                $(this).prop("disabled", true)
            }
            else{
                $(this).prop("disabled", false)
            }
            if (data_bib_item_now_page!=data_bib_item_all_page) {
                $('.btn_data_bib_item_next').prop("disabled", false)
            }
            $('.text_data_bib_item_now').val(data_bib_item_now_page);
        })

        $('.btn_data_bib_item_next').on('click',function(){
            data_bib_item_now_page++;
            data_bib_item_page_1=(data_bib_item_now_page-1)*10;
            data_bib_item_page_2=data_bib_item_page_1+10;
            append_data_item(data_bib_item_page_1,data_bib_item_page_2)
            // console.log(data_bib_now_page)
            if (data_bib_item_now_page==data_bib_item_all_page) {
                $(this).prop("disabled", true)
            }
            else{
                $(this).prop("disabled", false)
            }
            if (data_bib_item_now_page!=1) {
                $('.btn_data_bib_item_back').prop("disabled", false)
            }
            $('.text_data_bib_item_now').val(data_bib_item_now_page);
        })

        function append_data_bib_item(){
            // console.log(data_item)
            var stack = "";
            stack += "<tr>";
                stack += "<th>";
                    stack += "ลำดับ";
                stack += "</th>";
                stack += "<th>";
                    stack += "ชื่อทรัพยากร";
                stack += "</th>";
                stack += "<th>";
                    stack += "ฉบับที่";
                stack += "</th>";
                stack += "<th>";
                    stack += "เลขเรียกทรัพยากร";
                stack += "</th>";
                stack += "<th>";
                    stack += "บาร์โค้ด";
                stack += "</th>";
            stack += "</tr>";
            $('.table_bib_item thead').append(stack);
            stack = "";
            for (let i = 0; i < data_bib_item['item'].length; i++) {
                stack += "<tr>";
                    stack += "<td>";
                        stack += i+1;
                    stack += "</td>";
                    stack += "<td>";
                        stack += data_item[data_bib_item['item'][i]['Bib_ID']]['245']['sub'];
                    stack += "</td>";
                    stack += "<td>";
                        stack += data_bib_item['item'][i]['Copy'];
                    stack += "</td>";
                    stack += "<td>";
                        var check_082 = 0;
                        for (j in data_item[data_bib_item['item'][i]['Bib_ID']]) {
                            if (j=='082') {
                                stack += data_item[data_bib_item['item'][i]['Bib_ID']]['082']['sub']['#a']+" "+data_item[data_bib_item['item'][i]['Bib_ID']]['082']['sub']['#b'];
                                check_082 = 1 ;
                                break;
                            }
                        }
                        if (check_082 == 0 ) {
                            stack += "-";
                        }
                    stack += "</td>";
                    stack += "<td>";
                        stack += data_bib_item['item'][i]['Barcode'];
                    stack += "</td>";
                stack += "</tr>";
            }
            $('.table_bib_item tbody').append(stack);

            if (data_bib_item['article']!=null) {
                stack = "";
                stack += "<tr>";
                    stack += "<th>";
                        stack += "ลำดับ";
                    stack += "</th>";
                    stack += "<th>";
                        stack += "ชื่อบทความ";
                    stack += "</th>";
                    stack += "<th>";
                        stack += "ฉบับ";
                    stack += "</th>";
                    stack += "<th>";
                        stack += "เลขประจำบทความ";
                    stack += "</th>";
                stack += "</tr>";
                $('.table_article_item thead').append(stack);

                stack = "";
                var run_count = 1;
                for (i in data_bib_item['article'][data_bib_item['item'][0]['Bib_ID']]) {
                    stack += "<tr>";
                        stack += "<td>";
                            stack += run_count++;
                        stack += "</td>";
                        stack += "<td>";
                        for (let j = 0; j < data_bib_item['article'][data_bib_item['item'][0]['Bib_ID']][i].length; j++) {
                            if (data_bib_item['article'][data_bib_item['item'][0]['Bib_ID']][i][j]['field']=='245') {
                                stack += data_bib_item['article'][data_bib_item['item'][0]['Bib_ID']][i][j]['sub'];
                            }
                        }
                        stack += "</td>";
                        stack += "<td>";
                        for (let j = 0; j < data_bib_item['article'][data_bib_item['item'][0]['Bib_ID']][i].length; j++) {
                            if (data_bib_item['article'][data_bib_item['item'][0]['Bib_ID']][i][j]['field']=='773') {
                                stack += data_bib_item['article'][data_bib_item['item'][0]['Bib_ID']][i][j]['sub'];
                            }
                        }
                        stack += "</td>";
                        stack += "<td>";
                            stack += i;
                        stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_article_item tbody').append(stack);
            }
            else{
                $('.table_article_item thead').append('<tr><th>ไม่มีข้อมูล</th></tr>');
            }

        }


        function ajax_find_bib(val){
            $('.table_bib thead').empty();
            $('.table_bib tbody').empty();
            $.ajax({
                url: 'ajax_find_bib.php',
                type: 'post',
                data: {
                    val:val
                },
                success: function(response) {
                    // console.log(response);
                    if (response==1) {
                        var stack = "";
                        stack = "<tr><td>ไม่มีข้อมูล</td></tr>";
                        $('.table_bib tbody').append(stack);
                    }
                    else{
                        data_item = JSON.parse(response);
                        // console.log(data_item);
                        cal_data_item();
                    }
                }
            });
        }

        function cal_data_item(){
            key_data_item = [];
            data_bib_item_all_page = Math.ceil(Object.size(data_item)/10);
            $('.text_data_bib_item_all').val(data_bib_item_all_page)
            $('.text_data_bib_item_now').val(1)
            data_bib_item_now_page = $('.text_data_bib_item_now').val();
            if (data_bib_item_now_page==1) {
                $('.btn_data_bib_item_back').prop("disabled", true)
            }
            if (data_bib_item_all_page>=2) {
                $('.btn_data_bib_item_next').prop("disabled", false)
            }
            else{
                $('.btn_data_bib_item_next').prop("disabled", true)
            }
            data_bib_item_page_1=0;
            data_bib_item_page_2=10;
            for(i in data_item){
                key_data_item.push([i,data_item[i]])
            }
            append_data_item(data_bib_item_page_1,data_bib_item_page_2);
            
        }

        function append_data_item(start,stop){
            $('.table_bib tbody').empty();
            var stack = "";
            if ($('.table_bib thead').children().length==0) {
                stack += "<tr>";
                    stack += "<th>";
                        stack += "<center>ลำดับ</center>";
                    stack += "</th>";
                    stack += "<th class='bg-primary text-white'>";
                        stack += "<center>ชื่อรายการทรัพยากร</center>";
                    stack += "</th>";
                    stack += "<th  class='bg-success text-white'>";
                        stack += "<center>ISBN</center>";
                    stack += "</th>";
                stack += "</tr>";
                $('.table_bib thead').append(stack);
            }
            stack = "";
                // console.log(key_data_item,start,stop)
                if (stop>key_data_item.length) {
                    stop = key_data_item.length;
                }
                for (let i = start; i < stop; i++) {
                    stack += "<tr>";
                        stack += "<td >";
                            stack += "<center>"+(i+1)+"</center>";
                        stack += "</td>";
                        stack += "<td >";
                            stack += "<a class='text-primary add_item_bib' value='"+key_data_item[i][0]+"' >"+key_data_item[i]['1']['245']['sub']+"</a>";
                        stack += "</td>";
                        stack += "<td class='text-success'>";
                        for ( j in key_data_item[i]['1'] ) {
                            if (j=='020'||j=='022') {
                                stack += key_data_item[i]['1'][j]['sub'];
                            }
                        }
                        stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_bib tbody').append(stack);
        }

        function ajax_upload() {
            file_data = $('.modal_img').prop('files')[0];
            form_data = new FormData();
            form_data.append("file", file_data);
            $.ajax({
                url: 'upload_img.php',
                dataType: 'text',
                cache: true,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(response) {
                    ajax_save(response);
                }
            });
        }

        function ajax_save(name_img) {
            $.ajax({
                url: 'ajax_save_new.php',
                type: 'post',
                data: {
                    img: name_img,
                    data: data_main,
                },
                success: function(response) {
                    // console.log(response);
                    alert('บันทึกสำเร็จ');
                    location.reload()
                }
            });
        }

        function ajax_save_article(data_article_save) {
            $.ajax({
                url: 'ajax_save_article.php',
                type: 'post',
                data: {
                    data: data_article_save,
                    Bib_ID : data_bib_item['item'][0]['Bib_ID'],
                },
                success: function(response) {
                    console.log(response);
                    if (response==1) {
                        alert('บันทึกสำเร็จ');
                        clear_add_article();
                    }
                    else{
                        alert('ไม่สามารถบันทึกได้');
                    }
                }
            });
        }

        function clear_add_article(){
            $('.table_marc_article thead').empty();
            $('.table_marc_article tbody').empty();
            $('#modal_add_article').modal('toggle');



        }

        function load_temp_name() {
            $.ajax({
                url: 'ajax_load_temp.php',
                type: 'post',
                success: function(response) {
                    name_temp = JSON.parse(response);
                    temp_name();
                }
            });
        }

        function upload_img() {

        }

        function load_temp_data(id) {
            $.ajax({
                url: 'ajax_data_temp.php',
                type: 'post',
                data: {
                    data: id,
                },
                success: function(response) {
                    // console.log(response);
                    data_temp = JSON.parse(response);
                    // console.log(data_temp);
                    main_table()
                    check_enable_save();
                }
            });
        }

        function load_field(field, inc1, inc2, sub) {
            $.ajax({
                url: 'ajax_load_field.php',
                type: 'post',
                data: {
                    field: field,
                },
                success: function(response) {
                    if (response.length==7||response.length==10) {
                        show_edit(field, inc1, inc2, sub, "sp");
                    }
                    else{
                        data_base = JSON.parse(response);
                        show_edit(field, inc1, inc2, sub, data_base);
                    }
                }
            });
        }

        function temp_name() {
            var stack = "";
            stack += "<option value='no' selected>โปรดเลือกรูปแบบระเบียน</option>";
            for (let i = 0; i < name_temp[0].length; i++) {
                stack += "<option value='" + name_temp[0][i] + "'>" + name_temp[1][i] + "</option>";
            }
            $('.temp_name').append(stack)
        }

        function main_table() {
            var check_table = $('.table_main thead').children().length
            var stack = "";
            if (check_table == 0) {
                stack += "<tr>";
                    stack += "<th>";
                        stack += "<b>เขตข้อมูล";
                    stack += "</th>";
                    stack += "<th>";
                        stack += "<b>ตัวบ่งชี้ที่ 1";
                    stack += "</th>";
                    stack += "<th>";
                        stack += "<b>ตัวบ่งชี้ที่ 2";
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
                $('.table_main thead').append(stack)
                stack = "";
            }
            for ( i in data_temp ) {
                stack += "<tr>";
                stack += "<td>";
                stack += "<input name='field'  style='width: 150;' class='form-control item' type='text' value='" + i + "'>";
                stack += "</td>";
                var check_inc = 0;
                var check_sub = 0;
                for ( j in data_temp[i]) {
                    if (j=='inc') {
                        var check_k = 0;
                        for (k in data_temp[i][j]) {
                            if (k==1) {
                                stack += "<td>";
                                    stack += "<input name='inc1' style='width: 150;' class='pos" + it + " input_hide item' type='text' value='" + data_temp[i][j][k] + "' disabled >";
                                stack += "</td>";
                                check_k++;
                            }
                            else if(k==2&&check_k==1){
                                stack += "<td>";
                                    stack += "<input name='inc2' style='width: 150;' class='pos" + it + " input_hide item' type='text' value='" + data_temp[i][j][k] + "' disabled >";
                                stack += "</td>";
                                check_k++;
                            }
                            // else{
                            //     stack += "<td>";
                            //         stack += "<input name='inc"+check_k+"' class='pos" + it + " form-control item' type='text'>";
                            //     stack += "</td>";
                            //     check_k++;
                            // }
                        }
                        if (check_k!=2) {
                            stack += "<td>";
                                stack += "<input name='inc"+(check_k+1)+"' style='width: 150;' class='pos" + it + " input_hide item' type='text' disabled >";
                            stack += "</td>";
                        }
                        check_inc = 1;
                    }
                    if (j=='sub') {
                        // stack += "<td>";
                        //     stack += "<input name='sub' class='pos" + it + " form-control item' type='text' value='" + data_temp[i][j] + "' >";
                        // stack += "</td>";
                        check_sub = 1;
                    }
                }
                if (check_inc!=1) {
                    for (let i = 0; i < 2; i++) {
                        stack += "<td>";
                            stack += "<input name='inc"+(i+1)+"' style='width: 150;' class='pos" + it + " input_hide item' type='text' disabled >";
                        stack += "</td>";
                    }
                }
                if (check_sub!=1) {
                    stack += "<td>";
                        stack += "<input name='sub' style='width: 550;' class='pos" + it + " input_hide item' type='text' disabled >";
                    stack += "</td>";
                }
                else if(check_sub==1){
                    stack += "<td>";
                        stack += "<input name='sub' style='width: 550;' class='pos" + it + " input_hide item' type='text' value='" + data_temp[i][j] + "' disabled >";
                    stack += "</td>";
                }
                
                stack += "<td>";
                stack += "<button class='btn_edit btn btn-link' id='" + it + "' disabled>แก้ไข</button>";
                stack += "</td>";
                stack += "<td>";
                stack += "<button class='btn_del btn btn-danger' id='" + it + "' >ลบ</button>";
                stack += "</td>";
                stack += "</tr>";
                it++
            }
            $('.table_main tbody').append(stack)
        }

        function add_item() {
            var check_table = $('.table_main thead').children().length
            var stack = "";
            if (check_table == 0) {
                stack += "<tr>";
                stack += "<th>";
                stack += "เขตข้อมูล";
                stack += "</th>";
                stack += "<th>";
                stack += "ตัวบ่งชี้ที่ 1";
                stack += "</th>";
                stack += "<th>";
                stack += "ตัวบ่งชี้ที่ 2";
                stack += "</th>";
                stack += "<th>";
                stack += "เขตข้อมูลย่อย";
                stack += "</th>";
                stack += "</tr>";
                $('.table_main thead').append(stack)
                stack = "";
            }
            stack += "<tr>";
            stack += "<td>";
            stack += "<input name='field' style='width: 150;' class='form-control item' type='text'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input name='inc1' style='width: 150;' class='input_hide  item' type='text' disabled>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input name='inc2' style='width: 150;' class='input_hide  item' type='text' disabled>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input name='sub' class='input_hide  item' type='text' disabled>";
            stack += "</td>";
            stack += "<td>";
            stack += "<button class='btn btn-link btn_edit' disabled>แก้ไข</button>";
            stack += "</td>";
            stack += "<td>";
            stack += "<button class='btn btn-danger btn_del' >ลบ</button>";
            stack += "</td>";
            stack += "</tr>";
            $('.table_main tbody').append(stack)
            it++;
        }

        function show_edit(field, inc1, inc2, sub, data_base) {
            $('.modal-title').empty();
            $('.sp_div').empty();
            $('.modal-title').append('เขตข้อมูล'+field);

            var check_inc1 = $('.table_modal_inc.order1 thead').children().length
            var check_inc2 = $('.table_modal_inc.order2 thead').children().length
            var check_sub = $('.table_modal_sub thead').children().length
            var stack = "";
            var has_inc1 = 0;
            var has_inc2 = 0;

            var sp_array = ['001','003','005','008','Leader'];

            if ((jQuery.inArray(field, sp_array) !== -1)) {
                stack = "<input class='form-control text_sub_sp'>";
                $('.sp_div').html(stack);
            }
            else{
                sub = sub.split("/");
                for (let i = 0; i < sub.length; i++) {
                    sub[i] = sub[i].split("=");
                    // sub[i][0] = sub[i][0].replace('$','#');
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
                        stack += "<th style='width:20%' >";
                            stack += "<center><b>ตำแหน่งที่ 1</center>";
                        stack += "</th>";
                        stack += "<th style='width:40%' >";
                            stack += "<b>ชื่อตัวบ่งชี้";
                        stack += "</th>";
                        stack += "<th style='width:40%' >";
                            stack += "<b>ข้อมูลตัวบ่งชี้";
                        stack += "</th>";
                    stack += "</tr>";
                    $('.table_modal_inc.order1 thead').append(stack)
                    stack = "";
                    for (let i = 0; i < data_base[1].length; i++) {
                        if (data_base[1][i]['Order']==1) {
                            stack += "<tr>";
                                stack += "<td style='width: 140;'>";
                                    stack += "<center>"+data_base[1][i]['Code']+"</center>";
                                stack += "</td>";
                                stack += "<td>";
                                    stack += "<p>" + data_base[1][i]['Description'] + "</p>";
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
                        stack += "<th style='width:20%' >";
                            stack += "<center><b>ตำแหน่งที่ 2</center>";
                        stack += "</th>";
                        stack += "<th style='width:40%' >";
                            stack += "<b>ชื่อตัวบ่งชี้";
                        stack += "</th>";
                        stack += "<th style='width:40%' >";
                            stack += "<b>ข้อมูลตัวบ่งชี้";
                        stack += "</th>";
                    stack += "</tr>";
                    $('.table_modal_inc.order2 thead').append(stack)
                    stack = "";
                    for (let i = 0; i < data_base[1].length; i++) {
                        if (data_base[1][i]['Order']==2) {
                            stack += "<tr>";
                                stack += "<td style='width: 140;'>";
                                    stack += "<center>"+data_base[1][i]['Code']+"</center>";
                                stack += "</td>";
                                stack += "<td>";
                                    stack += "<p>" + data_base[1][i]['Description'] + "</p>";
                                    stack += "<input type='hidden' name='order' value='" + data_base[1][i]['Order'] + "' >";
                                stack += "</td>";
                                stack += "<td>";
                                if (data_base[1][i]['Code'] == inc2) {
                                    stack += "<input type='checkbox' class='form-control modal_inc' name='inc2' value='" + data_base[1][i]['Code'] + "' checked >";
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
                        stack += "<th style='width:20%' >";
                            stack += "<center><b>รหัส</center>";
                        stack += "</th>";
                        stack += "<th style='width:40%' >";
                            stack += "<b>ชื่อเขตข้อมูลย่อย";
                        stack += "</th>";
                        stack += "<th style='width:40%' >";
                            stack += "<b>ข้อมูลเขตข้อมูลย่อย";
                        stack += "</th>";
                    stack += "</tr>";
                    $('.table_modal_sub thead').append(stack)
                    stack = "";
                    for (let i = 0; i < data_base[0].length; i++) {
                        stack += "<tr>";
                            stack += "<td class='code' >";
                                stack += data_base[0][i]['Code'].replace("#", "$");
                            stack += "</td>";

                            stack += "<td>";
                                stack += "<p name='name_sub'>"+data_base[0][i]['Name_Eng']+"</p>" ;
                            stack += "</td>";
                        stack += "<td>";
                        var check = 0;
                        for (let j = 0; j < sub.length; j++) {
                            if (data_base[0][i]['Code'] == sub[j][0]) {
                                stack += "<input type='text' class='modal_sub form-control' name='sub' value='" + sub[j][1] + "'>";
                                check = 1;
                            }
                        }
                        if (check == 0) {
                            stack += "<input type='text' style='width: 310;' class='modal_sub form-control' name='sub'>";
                        }
                        stack += "</td>";
                        stack += "</tr>";
                    }
                    $('.table_modal_sub tbody').append(stack)
                }
            }
            
        }

        function show_edit_article(field, inc1, inc2, sub, data_article) {
            $('.modal-title-article').empty();
            $('.sp_div_article').empty();
            $('.modal-title-article').append('เขตข้อมูล'+field);

            var check_inc1 = $('.table_modal_inc_article.order1 thead').children().length
            var check_inc2 = $('.table_modal_inc_article.order2 thead').children().length
            var check_sub = $('.table_modal_sub_article thead').children().length
            var stack = "";
            var has_inc1 = 0;
            var has_inc2 = 0;

            var sp_array = ['001','003','005','008','Leader'];

            if ((jQuery.inArray(field, sp_array) !== -1)) {
                stack = "<input class='form-control text_sub_sp_article'>";
                $('.sp_div_article').html(stack);
            }
            else{
                sub = sub.split("/");
                for (let i = 0; i < sub.length; i++) {
                    sub[i] = sub[i].split("=");
                    // sub[i][0] = sub[i][0].replace('$','#');
                }
                for (let i = 0; i < data_article[1].length; i++) {
                    if (data_article[1][i]['Order']==1) {
                        has_inc1 = 1;
                    }
                    else if(data_article[1][i]['Order']==2) {
                        has_inc2 = 1;
                    }
                }
                if (check_inc1 == 0 && has_inc1==1) {
                    stack += "<tr>";
                        stack += "<th style='width:20%' >";
                            stack += "<center><b>ตำแหน่งที่ 1</center>";
                        stack += "</th>";
                        stack += "<th style='width:40%' >";
                            stack += "<b>ชื่อตัวบ่งชี้";
                        stack += "</th>";
                        stack += "<th style='width:40%' >";
                            stack += "<b>ข้อมูลตัวบ่งชี้";
                        stack += "</th>";
                    stack += "</tr>";
                    $('.table_modal_inc_article.order1 thead').append(stack)
                    stack = "";
                    for (let i = 0; i < data_article[1].length; i++) {
                        if (data_article[1][i]['Order']==1) {
                            stack += "<tr>";
                                stack += "<td style='width: 140;'>";
                                    stack += data_article[1][i]['Code'];
                                stack += "</td>";
                                stack += "<td>";
                                    stack += "<p>" + data_article[1][i]['Description'] + "</p>";
                                    stack += "<input type='hidden' name='order' value='" + data_article[1][i]['Order'] + "' >";
                                stack += "</td>";
                                stack += "<td>";
                                if (data_article[1][i]['Code'] == inc1) {
                                    stack += "<input type='checkbox' class='form-control modal_inc' name='inc1' value='" + data_article[1][i]['Code'] + "' checked >";
                                } else {
                                    stack += "<input type='checkbox' class='form-control modal_inc' name='inc1' value='" + data_article[1][i]['Code'] + "'>";
                                }
                            stack += "</td>";
                            stack += "</tr>";
                        }
                    }
                    $('.table_modal_inc_article.order1 tbody').append(stack)
                    stack = "";
                }
                if (check_inc2 == 0 && has_inc2==1) {
                    stack += "<tr>";
                        stack += "<th style='width:20%' >";
                            stack += "<center><b>ตำแหน่งที่ 2</center>";
                        stack += "</th>";
                        stack += "<th style='width:40%' >";
                            stack += "<b>ชื่อตัวบ่งชี้";
                        stack += "</th>";
                        stack += "<th style='width:40%' >";
                            stack += "<b>ข้อมูลตัวบ่งชี้";
                        stack += "</th>";
                    stack += "</tr>";
                    $('.table_modal_inc_article.order2 thead').append(stack)
                    stack = "";
                    for (let i = 0; i < data_article[1].length; i++) {
                        if (data_article[1][i]['Order']==2) {
                            stack += "<tr>";
                                stack += "<td style='width: 140;'>";
                                    stack += data_article[1][i]['Code'];
                                stack += "</td>";
                                stack += "<td>";
                                    stack += "<p>" + data_article[1][i]['Description'] + "</p>";
                                    stack += "<input type='hidden' name='order' value='" + data_article[1][i]['Order'] + "' >";
                                stack += "</td>";
                                stack += "<td>";
                                if (data_article[1][i]['Code'] == inc2) {
                                    stack += "<input type='checkbox' class='form-control modal_inc' name='inc2' value='" + data_article[1][i]['Code'] + "' checked >";
                                } else {
                                    stack += "<input type='checkbox' class='form-control modal_inc' name='inc2' value='" + data_article[1][i]['Code'] + "'>";
                                }
                            stack += "</td>";
                            stack += "</tr>";
                        }
                    }
                    $('.table_modal_inc_article.order2 tbody').append(stack)
                    stack = "";
                }

                if (check_sub == 0) {
                    stack += "<tr>";
                        stack += "<th style='width:20%' >";
                            stack += "<center><b>รหัส</center>";
                        stack += "</th>";
                        stack += "<th style='width:40%'>";
                            stack += "<b>ชื่อเขตข้อมูลย่อย";
                        stack += "</th>";
                        stack += "<th style='width:40%'>";
                            stack += "<b>ข้อมูลเขตข้อมูลย่อย";
                        stack += "</th>";
                    stack += "</tr>";
                    $('.table_modal_sub_article thead').append(stack)
                    stack = "";
                    for (let i = 0; i < data_article[0].length; i++) {
                        stack += "<tr>";
                            stack += "<td class='code' >";
                                stack += data_article[0][i]['Code'].replace("#", "$");
                            stack += "</td>";

                            stack += "<td>";
                                stack += "<p name='name_sub' value='" + data_article[0][i]['Name_Eng'] + "'></p>" ;
                            stack += "</td>";
                        stack += "<td>";
                        var check = 0;
                        for (let j = 0; j < sub.length; j++) {
                            if (data_article[0][i]['Code'] == sub[j][0]) {
                                stack += "<input type='text' class='modal_sub form-control' name='sub' value='" + sub[j][1] + "'>";
                                check = 1;
                            }
                        }
                        if (check == 0) {
                            stack += "<input type='text' style='width: 310;' class='modal_sub form-control' name='sub'>";
                        }
                        stack += "</td>";
                        stack += "</tr>";
                    }
                    $('.table_modal_sub_article tbody').append(stack)
                }
            }
            
        }
    </script>

<style>
    
    .block_click{
        pointer-events:none;
        opacity:0.4;
    }
    
    .input_hide{
        border :0;
    }

</style>
