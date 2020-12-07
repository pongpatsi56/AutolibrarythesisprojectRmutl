    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    ?>
    <br>
    <br>
    <br>
    <section class="container">
        <div class="row" style="padding-top: 20px;padding-bottom: 400px; background-color: #eee;">
            <div class="col-md-12">

                <a href="../buy/buy.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
                &nbsp;&nbsp;<b style="font-size: 25px;">แก้ไข</b>
                <br>
                <br>
                <?php

                $id = $_GET['id'];
                echo "<input type='hidden' value='$id' id='id_list'>";

                ?> &nbsp; &nbsp;
                <button class="btn btn-primary" id="add_item">เพิ่มรายการ</button>
                <!-- <button class="btn btn-primary " id="add_set">เพิ่มรายการแบบเซ็ท</button> -->
                <button class="btn btn-success" id="save_edit">บันทึก</button>

                <br>
                <br>
                <br>
                <table class="table_main">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                </table>


                <!-------------------------------------------------------------------------------------------------------------->

                <div class="modal fade" id="modal_set" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" style="margin: center;margin-left: 18%;">
                        <div class="modal-content" style="  width:150%; position:relative ;">
                            <div style="  background-color: #FAFAD2;">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="exampleModalLabel">Modal title</h2>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <button type="button" class="btn btn-primary btn_add_modal">เพิ่มรายการ</button>
                                    <br>
                                    <table class='table_modal'>

                                        <thead>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                    <button type="button" class="btn_save_modal btn btn-primary">บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <style type="text/css">
                        /* class สำหรับแถวส่วนหัวของตาราง */
                        .tr_head {
                            background-color: #eee;
                            color: #050505;
                        }

                        /* class สำหรับแถวแรกของรายละเอียด */
                        .tr_odd {
                            background-color: #fff;
                        }

                        /* class สำหรับแถวสองของรายละเอียด */
                        .tr_even {
                            background-color: #ddd;
                        }
                    </style>
                    <script>
                        var it = 0;
                        var global_id = $(document).find('#id_list').val();
                        var select_id = null;
                        var data_main = {
                            main: {},
                            modal: {},
                        };

                        Object.size = function(obj) {
                            var size = 0,
                                key;
                            for (key in obj) {
                                if (obj[key].length != 0) size++;
                            }
                            return size;
                        };

                        $(document).ready(function() {
                            ajax_find_detail()
                        });

                        $("#add_item").click(function() {
                            append_add_item();
                        });

                        $("#add_set").click(function() {
                            append_add_set();
                        });

                        $('.table_main').on('click', '.btn_modal', function() {
                            select_id = $(this).attr('id');
                            $('#modal_set').modal('toggle');
                        });

                        $('.table_main').on('click', '.btn_del', function() {
                            var select = $(this).parent().parent();
                            var id = $(this).attr('id');

                            $(select).remove();
                            if ($('.table_main tbody').children().length == 0) {
                                $('.table_main thead').empty();
                            }

                            if (Object.size(data_main.modal) != 0) {
                                for (var i in data_main.modal) {
                                    if (i == id) {
                                        delete data_main.modal[i];
                                    }
                                }
                            }
                            if (Object.size(data_main.main) != 0) {
                                for (var i in data_main.main) {
                                    if (i == id) {
                                        delete data_main.main[i];
                                    }
                                }
                            }
                        });

                        $('.table_modal').on('click', '.btn_del', function() {
                            var select = $(this).parent().parent();
                            $(select).remove();
                            if ($('.table_modal tbody').children().length == 0) {
                                $('.table_modal thead').empty();
                            }
                        });

                        $('#modal_set').on('show.bs.modal', function() {
                            $('.table_modal thead').empty();
                            $('.table_modal tbody').empty();
                            if (Object.size(data_main.modal) != 0) {
                                for (let i in data_main.modal) {
                                    if (i == select_id) {
                                        show_data();
                                    }
                                }
                            }
                        })

                        $('.modal-footer').on('click', '.btn_save_modal', function() {
                            var obj_modal = {};
                            var temp = {};
                            var count = 0;

                            $(".item_modal").each(function() {
                                if ($(this).attr('name') == 'title') {
                                    temp.Title = $(this).val();
                                } else if ($(this).attr('name') == 'author') {
                                    temp.Author = $(this).val();
                                } else if ($(this).attr('name') == 'edition') {
                                    temp.Edition = $(this).val();
                                } else if ($(this).attr('name') == 'publisher') {
                                    temp.Publisher = $(this).val();
                                } else if ($(this).attr('name') == 'books') {
                                    temp.Books = $(this).val();
                                }
                                if (Object.size(temp) != 0 && Object.keys(temp).length == 5) {
                                    obj_modal[count] = temp;
                                    temp = {};
                                    count++;
                                }
                            });
                            data_main.modal[select_id] = obj_modal;
                            $('#modal_set').modal('toggle');
                            $('.table_main tbody').find('input[name=books].pos' + select_id).val(count);
                            console.log(data_main)
                        });

                        $('#save_edit').on('click', function() {
                            var temp = {};
                            $('input.item').each(function() {
                                if ($(this).attr('name') == 'title') {
                                    temp.Title = $(this).val();
                                } 
                                else if ($(this).attr('name') == 'ISBN') {
                                    temp.ISBN = $(this).val();
                                }
                                // else if ($(this).attr('name') == 'author') {
                                //     temp.Author = $(this).val();
                                // } else if ($(this).attr('name') == 'edition') {
                                //     temp.Edition = $(this).val();
                                // } else if ($(this).attr('name') == 'publisher') {
                                //     temp.Publisher = $(this).val();
                                // } 
                                else if ($(this).attr('name') == 'price') {
                                    temp.Price = $(this).val();
                                } else if ($(this).attr('name') == 'books') {
                                    temp.Books = $(this).val();
                                }

                                if (Object.size(temp) != 0 && Object.keys(temp).length == 4) {
                                    var id = $(this).parent().parent().find('button.btn_del').attr('id')
                                    data_main.main[id] = temp;
                                    temp = {};
                                }
                            });
                            console.log(data_main)
                            ajax_save();

                        });

                        function ajax_find_detail() {
                            $.ajax({
                                url: 'ajax_buy_find_detail.php',
                                type: 'post',
                                data: {
                                    id: global_id
                                },
                                success: function(response) {
                                    object_item = JSON.parse(response);
                                    data_main['main'] = Object.assign({}, object_item['item']);
                                    // data_main['modal'] = Object.assign({}, object_item['item_set']);
                                    console.log(data_main)
                                    // set_data();
                                    append_data();
                                }
                            });
                        }


                        function append_data() {
                            $('#append_data').html('เลขรายการซื้อ : ' + global_id);
                            var check_table = $('.table_main thead').children().length
                            var stack = "";
                            if (check_table == 0) {

                                stack += "<tr>";
                                stack += "<th>";
                                stack += "<b>ชื่อเรื่อง";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>ISBN";
                                stack += "</th>";
                                // stack += "<th>";
                                // stack += "<b>ผู้แต่ง";
                                // stack += "</th>";
                                // stack += "<th>";
                                // stack += "<b>พิมพ์ครั้งที่";
                                // stack += "</th>";
                                // stack += "<th>";
                                // stack += "<b>สำนักพิมพ์";
                                // stack += "</th>";
                                stack += "<th>";
                                stack += "<b>ราคา";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>จำนวน";
                                stack += "</th>";
                                stack += "</tr>";
                                $('.table_main thead').append(stack)
                                stack = "";
                            }
                            for (var i in data_main['main']) {
                                if (data_main['main'][i]['Buy_ID'] == global_id) {
                                    stack += "<tr>";
                                    stack += "<td>";
                                    stack += "<input type='text' style='width: 400;' class='item form-control ' value='" + data_main['main'][i]['Title'] + "' name='title' >";
                                    stack += "</td>";
                                    stack += "<td>";
                                    stack += "<input type='text'style='width: 300;'  class='item form-control ' value='" + data_main['main'][i]['ISBN'] + "' name='ISBN' >";
                                    stack += "</td>";
                                    // stack += "<td>";
                                    // stack += "<input type='text' class='item form-control' value='" + data_main['main'][i]['Author'] + "' name='author' >";
                                    // stack += "</td>";
                                    // stack += "<td>";
                                    // stack += "<input type='text' class='item form-control' value='" + data_main['main'][i]['Edition'] + "' name='edition' >";
                                    // stack += "</td>";
                                    // stack += "<td>";
                                    // stack += "<input type='text' class='item form-control' value='" + data_main['main'][i]['Publisher'] + "' name='publisher' >";
                                    // stack += "</td>";
                                    stack += "<td>";
                                    stack += "<input type='text' class='item form-control' value='" + data_main['main'][i]['Price'] + "' name='price' >";
                                    stack += "</td>";
                                    // if (data_main['main'][i]['Type'] == 2) {
                                    //     stack += "<td>";
                                    //     stack += "<input type='text' class='form-control item pos" + it + "' value='" + data_main['main'][i]['Books'] + "' name='books' disabled >";
                                    //     stack += "<input type='hidden' value='" + data_main['main'][i]['Type'] + "' name='type' disabled >";
                                    //     stack += "</td>";
                                    // } else {
                                        stack += "<td>";
                                        stack += "<input type='text' class='form-control item' value='" + data_main['main'][i]['Books'] + "' name='books' >";
                                        // stack += "<input type='hidden' value='" + data_main['main'][i]['Type'] + "' name='type' disabled >";
                                        stack += "</td>";
                                    // }
                                    // if (data_main['main'][i]['Type'] == 2) {
                                    //     stack += "<td>";
                                    //     stack += "<button class='btn_del btn btn-danger' id='" + it + "' >ลบ</button>";
                                    //     stack += "</td>";
                                    //     stack += "<td>";
                                    //     stack += "<button id='" + it + "' class='btn_modal btn btn-link' >รายละเอียด</button>";
                                    //     stack += "</td>";
                                    //     stack += "</tr>";
                                    // } else if (data_main['main'][i]['Type'] == 1) {
                                        stack += "<td>";
                                        stack += "<button class='btn_del btn btn-danger' id='" + it + "'>ลบ</button>";
                                        stack += "</td>";
                                        stack += "</tr>";
                                    // }
                                }
                                it++;
                            }
                            $('.table_main tbody').append(stack);
                        }

                        function append_add_set() {
                            var check_table = $('.table_main thead').children().length
                            var stack = "";
                            if (check_table == 0) {
                                stack += "<tr>";
                                stack += "<th>";
                                stack += "<b>ชื่อเรื่อง";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>ผู้แต่ง";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>พิมพ์ครั้งที่";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>สำนักพิมพ์";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>ราคา";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>จำนวน";
                                stack += "</th>";
                                stack += "</tr>";
                                $('.table_main thead').append(stack)
                                stack = "";
                            }
                            stack += "<tr>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item pos" + it + "' name='title'>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item pos" + it + "' name='author'>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item pos" + it + "' name='edition'>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item pos" + it + "' name='publisher'>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item pos" + it + "' name='price'>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item pos" + it + "' name='books' disabled>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<button type='button' class='btn_del btn btn-danger' id='" + it + "'>ลบ</button>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<button type='button' class='btn_modal btn btn-link ' id='" + it + "'>รายละเอียด</button>";
                            stack += "</td>";
                            stack += "</tr>";
                            $('.table_main tbody').append(stack)
                            it++;
                        }

                        function append_add_item() {
                            var check_table = $('.table_main thead').children().length
                            var stack = "";
                            if (check_table == 0) {

                                stack += "<tr>";
                                stack += "<th>";
                                stack += "<b>ชื่อเรื่อง";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>ISBN";
                                stack += "</th>";
                                // stack += "<th>";
                                // stack += "<b>ผู้แต่ง";
                                // stack += "</th>";
                                // stack += "<th>";
                                // stack += "<b>พิมพ์ครั้งที่";
                                // stack += "</th>";
                                // stack += "<th>";
                                // stack += "<b>สำนักพิมพ์";
                                // stack += "</th>";
                                stack += "<th>";
                                stack += "<b>ราคา";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>จำนวน";
                                stack += "</th>";
                                stack += "</tr>";
                                $('.table_main thead').append(stack)
                                stack = "";
                            }
                            stack += "<tr>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item' name='title'>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item' name='ISBN'>";
                            stack += "</td>";
                            // stack += "<td>";
                            // stack += "<input type='text' class='form-control item' name='author'>";
                            // stack += "</td>";
                            // stack += "<td>";
                            // stack += "<input type='text' class='form-control item' name='edition'>";
                            // stack += "</td>";
                            // stack += "<td>";
                            // stack += "<input type='text' class='form-control item' name='publisher'>";
                            // stack += "</td>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item' name='price'>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item' name='books'>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<button type='button' class='btn_del btn btn-danger' id='" + it + "'>ลบ</button>";
                            stack += "</td>";
                            stack += "</tr>";
                            $('.table_main tbody').append(stack)
                            it++;
                        }

                        function set_data() {
                            var temp = {};
                            var obj_temp = {};
                            var r = 0;
                            for (var i in data_main.main) {
                                r = 0;
                                temp = {};
                                if (data_main.main[i]['Type'] == 2) {
                                    for (var j in data_main.modal) {
                                        if (data_main.main[i]['Item_ID'] == data_main.modal[j]['Item_ID']) {
                                            temp[r] = data_main.modal[j];
                                            r++;
                                        }
                                    }
                                    if (Object.size(temp) != 0) {
                                        obj_temp[i] = temp;
                                    }
                                }
                            }
                            data_main.modal = obj_temp;
                            console.log(data_main)
                        }

                        function show_data() {
                            var stack = "";
                            var check_table = $('.table_modal thead').children().length
                            if (check_table == 0) {

                                stack += "<tr>";
                                stack += "<th>";
                                stack += "<b>ชื่อเรื่อง";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>ผู้แต่ง";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>พิมพ์ครั้งที่";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>สำนักพิมพ์";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>จำนวน";
                                stack += "</th>";
                                stack += "</tr>";
                                $('.table_modal thead').append(stack)
                                stack = "";
                            }
                            for (let i = 0; i < Object.size(data_main.modal[select_id]); i++) {
                                stack = "";
                                stack += "<tr>";
                                stack += "<td>";
                                stack += "<input type='text' class='form-control item_modal' name='title' value='" + data_main.modal[select_id][i]['Title'] + "'>";
                                stack += "</td>";
                                stack += "<td>";
                                stack += "<input type='text' class='form-control item_modal' name='author' value='" + data_main.modal[select_id][i]['Author'] + "'>";
                                stack += "</td>";
                                stack += "<td>";
                                stack += "<input type='text' class='form-control item_modal' name='edition' value='" + data_main.modal[select_id][i]['Edition'] + "'>";
                                stack += "</td>";
                                stack += "<td>";
                                stack += "<input type='text' class='form-control item_modal' name='publisher' value='" + data_main.modal[select_id][i]['Publisher'] + "'>";
                                stack += "</td>";
                                stack += "<td>";
                                stack += "<input type='text' class='form-control item_modal' name='books' value='" + data_main.modal[select_id][i]['Books'] + "'>";
                                stack += "</td>";
                                stack += "<td>";
                                stack += "<button type='button' class='btn_del btn btn-danger'>ลบ</button>";
                                stack += "</td>";
                                stack += "</tr>";
                                $('.table_modal tbody').append(stack);
                            }
                        }

                        $('.modal-body').on('click', '.btn_add_modal', function() {
                            var check_table = $('.table_modal thead').children().length
                            var stack = "";
                            if (check_table == 0) {
                                stack += "<tr>";
                                stack += "<th>";
                                stack += "<b>ชื่อเรื่อง";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>ผู้แต่ง";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>พิมพ์ครั้งที่";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>สำนักพิมพ์";
                                stack += "</th>";
                                stack += "<th>";
                                stack += "<b>จำนวน";
                                stack += "</th>";
                                stack += "</tr>";
                                $('.table_modal thead').append(stack)
                                stack = "";
                            }
                            stack += "<tr>";
                            stack += "<td>";
                            stack += "<input type='text'  class='form-control item_modal' name='title'>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item_modal' name='author'>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item_modal' name='edition'>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item_modal' name='publisher'>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<input type='text' class='form-control item_modal' name='books'>";
                            stack += "</td>";
                            stack += "<td>";
                            stack += "<button type='button' class='btn_del btn btn-danger'>ลบ</button>";
                            stack += "</td>";
                            stack += "</tr>";
                            $('.table_modal tbody').append(stack)
                        });

                        function ajax_save() {
                            $.ajax({
                                url: 'ajax_save_buy.php',
                                type: 'post',
                                data: {
                                    data_main: data_main,
                                    id: global_id,
                                },
                                success: function(response) {
                                    alert('แก้ไขสำเร็จ');
                                    location.reload();
                                }
                            });
                        }
                    </script>

                    <style>
                        .modal-body {
                            overflow-x: auto;
                        }
                    </style>
                    <script language="javascript">
                        window.onload = function() {
                            var a = document.getElementById('mytable'); // อ้างอิงตารางด้วยตัวแปร a
                            for (i = 0; i < a.rows.length; i++) { // วน Loop นับจำนวนแถวในตาราง
                                if (i > 0) { // ตรวจสอบถ้าไม่ใช่แถวหัวข้อ
                                    if (i % 2 == 1) { // ตรวจสอบถ้าไม่ใช่แถวรายละเอียด
                                        a.rows[i].className = "tr_odd"; // กำหนด class แถวแรก
                                    } else {
                                        a.rows[i].className = "tr_even"; // กำหนด class แถวที่สอง
                                    }
                                } else { // ถ้าเป็นแถวหัวข้อกำหนด class 
                                    a.rows[i].className = "tr_head";
                                }
                            }
                        }
                    </script>