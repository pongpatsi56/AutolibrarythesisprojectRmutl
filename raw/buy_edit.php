    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    ?>

    <br><br><br>
    <section class="container">
        <div class="row" style="padding-top: 20px;padding-bottom: 400px; background-color: #eee;">
            <div class="col-md-12">
                <a href="../buy/buy.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
                <br><br><br>
                <?php

                $id = $_GET['id'];
                echo "<input type='hidden' value='$id' id='id_list'>";

                ?>
                <button class="btn" id="add_item">เพิ่มรายการ</button>
                <button class="btn" id="add_set">เพิ่มรายการแบบเซ็ท</button>

                <div id="append_data">
                </div>


                <!-------------------------------------------------------------------------------------------------------------->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <button type="button" class="btn btn-secondary btn_add_modal">เพิ่มรายการ</button>
                                <div class="container-fluid">
                                    <div id="append_set">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label for="">ชื่อทรัพยากร</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="">ชื่อผู้แต่ง</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="">พิมพ์ครั้งที่</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="">สำนักพิมพ์</label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="">จำนวน</label>
                                        </div>
                                    </div>
                                    <div class="row" id="item2">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                <button type="button" class="btn_save_modal btn btn-primary">บันทึก</button>
                            </div>
                        </div>
                    </div>
                </div>



                <script>
                    var global_id = $(document).find('#id_list').val();
                    var object_item = {};
                    var count_item = 0;
                    var count_set = 0;
                    var selected = "";



                    function ajax_find_detail() {
                        $.ajax({
                            url: 'ajax_buy_find_detail.php',
                            type: 'post',
                            data: {
                                id: global_id
                            },
                            success: function(response) {
                                object_item = JSON.parse(response);
                                append_data();
                            }
                        });
                    }

                    $(document).ready(function() {
                        ajax_find_detail()
                    });

                    function append_data() {
                        console.log(object_item)
                        $('#append_data').html('เลขรายการซื้อ : ' + global_id);
                        var append = "";
                        append += "<table class='table' id='table_data'>";
                        append += "<thead>";
                        append += "<tr>";
                        append += "<th>";
                        append += "ลำดับรายการ";
                        append += "</th>";
                        append += "<th>";
                        append += "ชื่อทรัพยากร";
                        append += "</th>";
                        append += "<th>";
                        append += "ชื่อผู้แต่ง";
                        append += "</th>";
                        append += "<th>";
                        append += "พิมพ์ครั้งที่";
                        append += "</th>";
                        append += "<th>";
                        append += "สำนักพิมพ์";
                        append += "</th>";
                        append += "<th>";
                        append += "จำนวน";
                        append += "</th>";
                        append += "<th>";
                        append += "ราคา";
                        append += "</th>";
                        append += "</tr>";
                        append += "</thead>";
                        append += "<tbody>";
                        for (var i in object_item) {
                            for (var j in object_item[i]) {
                                if (object_item[i][j]['Buy_ID'] == global_id) {
                                    append += "<tr class='count_base item find" + count_item + "'>";
                                    append += "<td>";
                                    append += object_item[i][j]['Item_ID'];
                                    append += "</td>";
                                    append += "<td>";
                                    append += "<input type='text' value='" + object_item[i][j]['Title'] + "' name='title' >";
                                    append += "</td>";
                                    append += "<td>";
                                    append += "<input type='text' value='" + object_item[i][j]['Author'] + "' name='author' >";
                                    append += "</td>";
                                    append += "<td>";
                                    append += "<input type='text' value='" + object_item[i][j]['Edition'] + "' name='edition' >";
                                    append += "</td>";
                                    append += "<td>";
                                    append += "<input type='text' value='" + object_item[i][j]['Publisher'] + "' name='publisher' >";
                                    append += "</td>";
                                    if (object_item[i][j]['Type'] == 2) {
                                        append += "<td>";
                                        append += "<input type='text' value='" + object_item[i][j]['Books'] + "' name='books' disabled >";
                                        append += "<input type='hidden' value='" + object_item[i][j]['Type'] + "' name='type' disabled >";
                                        append += "</td>";
                                    } else {
                                        append += "<td>";
                                        append += "<input type='text' value='" + object_item[i][j]['Books'] + "' name='books' >";
                                        append += "<input type='hidden' value='" + object_item[i][j]['Type'] + "' name='type' disabled >";
                                        append += "</td>";
                                    }
                                    append += "<td>";
                                    append += "<input type='text' value='" + object_item[i][j]['Price'] + "' name='price' >";
                                    append += "</td>";
                                    if (object_item[i][j]['Type'] == 2) {
                                        append += "<td>";
                                        append += "<a class='item find" + count_item + " btn_del' id='find" + count_item + "' >ลบ</a>";
                                        append += "</td>";
                                        append += "<td>";
                                        append += "<a data-toggle='modal' data-target='#exampleModal' aria-expanded='false' id='" + count_item + "' class='btn_modal' >รายละเอียด</a>";
                                        append += "</td>";
                                        append += "</tr>";
                                    } else if (object_item[i][j]['Type'] == 1) {
                                        append += "<td>";
                                        append += "<a class='item find" + count_item + " btn_del' id='find" + count_item + " '>ลบ</a>";
                                        append += "</td>";
                                    }
                                    count_item++;
                                }
                            }
                        }
                        append += "</tbody>";
                        append += "</table>";

                        $('#append_data').append(append);

                    }

                    function append_add_set() {
                        var append = "";
                        append += "<tr class='count_base item find" + count_item + "' >";
                        append += "<td>";
                        append += "</td>";
                        append += "<td>";
                        append += "<input type='text' name='title' value=''>";
                        append += "</td>";
                        append += "<td>";
                        append += "<input type='text' name='author' value=''>";
                        append += "</td>";
                        append += "<td>";
                        append += "<input type='text' name='edition' value=''>";
                        append += "</td>";
                        append += "<td>";
                        append += "<input type='text' name='publisher' value=''>";
                        append += "</td>";
                        append += "<td>";
                        append += "<input type='text' name='books' value='' disabled>";
                        append += "<input type='hidden' value='2' name='type' disabled >";
                        append += "</td>";
                        append += "<td>";
                        append += "<input type='text' name='price' value=''>";
                        append += "</td>";
                        append += "<td>";
                        append += "<a class='item find" + count_item + " btn_del' id='find" + count_item + "' >ลบ</a>";
                        append += "</td>";
                        append += "<td>";
                        append += "<a data-toggle='modal' data-target='#exampleModal' aria-expanded='false' class='btn_modal' id='" + count_item + "'>รายละเอียด</a>";
                        append += "</td>";
                        append += "</tr>";

                        $('#append_data tbody').append(append);
                        count_item++;
                    }

                    function append_add_item() {
                        var append = "";
                        append += "<tr class='count_base item find" + count_item + " '>";
                        append += "<td>";
                        append += "</td>";
                        append += "<td>";
                        append += "<input type='text' name='title' value=''>";
                        append += "</td>";
                        append += "<td>";
                        append += "<input type='text' name='author' value=''>";
                        append += "</td>";
                        append += "<td>";
                        append += "<input type='text' name='edition' value=''>";
                        append += "</td>";
                        append += "<td>";
                        append += "<input type='text' name='publisher' value=''>";
                        append += "</td>";
                        append += "<td>";
                        append += "<input type='text' name='books' value=''>";
                        append += "<input type='hidden' value='1' name='type' disabled >";
                        append += "</td>";
                        append += "<td>";
                        append += "<input type='text' name='price' value=''>";
                        append += "</td>";
                        append += "<td>";
                        append += "<a class='item find" + count_item + " btn_del' id='find" + count_item + " '>ลบ</a>";
                        append += "</td>";
                        append += "</tr>";
                        $('#append_data tbody').append(append);
                        count_item++;
                    }

                    $("#add_item").click(function() {
                        append_add_item();
                    });
                    $("#add_set").click(function() {
                        append_add_set();
                    });

                    $('#append_data').on('click', '.btn_modal', function() {
                        $('.item2').remove();
                        id = $(this).attr('id');
                        selected = id
                        show_in_modal(id);
                    });

                    $('#item2').on('click', '.btn_del_modal', function() {
                        id = $(this).attr('id');
                        val = '.item2.' + id;
                        $(val).remove();
                    });

                    $('#append_data').on('click', '.btn_del', function() {
                        id = $(this).attr('id');
                        val = '.item.' + id;
                        $(val).remove();
                    });

                    $('.modal-body').on('click', '.btn_add_modal', function() {
                        stack = "";
                        stack += "<div class='count_modal item2 find" + count_set + "'>";
                        stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                        stack += "<input type='text' name='title' class='item2_modal find" + count_set + " order" + selected + " ' >";
                        stack += "</div>";
                        stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                        stack += "<input type='text' name='author' class='item2_modal find" + count_set + " order" + selected + " ' >";
                        stack += "</div>";
                        stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                        stack += "<input type='text' name='edition' class='item2_modal find" + count_set + " order" + selected + " ' >";
                        stack += "</div>";
                        stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                        stack += "<input type='text' name='publisher' class='item2_modal find" + count_set + " order" + selected + " ' >";
                        stack += "</div>";
                        stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                        stack += "<input type='text' name='books' class='item2_modal find" + count_set + " order" + selected + " ' >";
                        stack += "</div>";
                        stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                        stack += "<a class='item2 find" + count_set + " btn_del_modal' id='find" + count_set + "'>ลบ</a>";
                        stack += "</div>";
                        stack += "</div>";
                        stack += "<br class='item2 find" + count_set + "'>";
                        stack += "<br class='item2 find" + count_set + "'>";
                        $('#item2').append(stack);
                        count_set++;
                    });

                    Object.size = function(obj) {
                        var size = 0,
                            key;
                        for (key in obj) {
                            if (obj[key].length != 0) size++;
                        }
                        return size;
                    };

                    function show_in_modal(key) {
                        var size = Object.size(object_item);
                        if (size > 0) {
                            for (let i = 0; i < object_item['item_set'].length; i++) {
                                if (object_item['item_set'][i]['Item_ID'] == object_item['item'][key]['Item_ID']) {
                                    stack = "";
                                    stack = "<div class='count_modal item2 find" + count_set + "'>";
                                    stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                                    stack += "<input type='text' name='title' class='item2_modal find" + count_set + " order" + selected + "' value='" + object_item['item_set'][i]['Title'] + "'>";
                                    stack += "</div>";
                                    stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                                    stack += "<input type='text' name='author' class='item2_modal find" + count_set + " order" + selected + "' value='" + object_item['item_set'][i]['Author'] + "'>";
                                    stack += "</div>";
                                    stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                                    stack += "<input type='text' name='edition' class='item2_modal find" + count_set + " order" + selected + "' value='" + object_item['item_set'][i]['Edition'] + "'>";
                                    stack += "</div>";
                                    stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                                    stack += "<input type='text' name='publisher' class='item2_modal find" + count_set + " order" + selected + "' value='" + object_item['item_set'][i]['Publisher'] + "'>";
                                    stack += "</div>";
                                    stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                                    stack += "<input type='text' name='books' class='item2_modal find" + count_set + " order" + selected + "' value='" + object_item['item_set'][i]['Books'] + "'>";
                                    stack += "</div>";
                                    stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                                    stack += "<a class='item2 find" + count_set + " btn_del_modal' id='find" + count_set + "'>ลบ</a>";
                                    stack += "</div>";
                                    stack += "<br class='item2 find" + count_set + "'>";
                                    stack += "<br class='item2 find" + count_set + "'>";
                                    $('#item2').append(stack);
                                    count_set++;
                                    stack = "</div>";
                                } else if (object_item['item_set'][i]['Pos'] == key) {
                                    stack = "";
                                    stack = "<div class='count_modal item2 find" + count_set + "'>";
                                    stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                                    stack += "<input type='text' name='title' class='item2_modal find" + count_set + " order" + selected + "' value='" + object_item['item_set'][i]['Title'] + "'>";
                                    stack += "</div>";
                                    stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                                    stack += "<input type='text' name='author' class='item2_modal find" + count_set + " order" + selected + "' value='" + object_item['item_set'][i]['Author'] + "'>";
                                    stack += "</div>";
                                    stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                                    stack += "<input type='text' name='edition' class='item2_modal find" + count_set + " order" + selected + "' value='" + object_item['item_set'][i]['Edition'] + "'>";
                                    stack += "</div>";
                                    stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                                    stack += "<input type='text' name='publisher' class='item2_modal find" + count_set + " order" + selected + "' value='" + object_item['item_set'][i]['Publisher'] + "'>";
                                    stack += "</div>";
                                    stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                                    stack += "<input type='text' name='books' class='item2_modal find" + count_set + " order" + selected + "' value='" + object_item['item_set'][i]['Books'] + "'>";
                                    stack += "</div>";
                                    stack += "<div class='col-sm-2 item2 find" + count_set + "'>";
                                    stack += "<a class='item2 find" + count_set + " btn_del_modal' id='find" + count_set + "'>ลบ</a>";
                                    stack += "</div>";
                                    stack += "<br class='item2 find" + count_set + "'>";
                                    stack += "<br class='item2 find" + count_set + "'>";
                                    $('#item2').append(stack);
                                    count_set++;
                                    stack = "</div>";
                                }
                            }
                        }
                    }

                    $('#exampleModal').on('hidden.bs.modal', function() {
                        count_set = 0;
                    });

                    $('.modal-footer').on('click', '.btn_save_modal', function() {
                        var arr_modal = [];
                        var r = 0;
                        var target = "";

                        get_pos();

                        $('.count_modal').each(function() {

                            arr_modal.push({
                                Pos: selected,
                                Title: $('input[name=title]', this).val(),
                                Author: $('input[name=author]', this).val(),
                                Edition: $('input[name=edition]', this).val(),
                                Publisher: $('input[name=publisher]', this).val(),
                                Books: $('input[name=books]', this).val(),
                            });
                        });

                        var temp = [];

                        for (let i = 0; i < object_item['item'].length; i++) {
                            if (i == selected) {
                                target = object_item['item'][i]['Item_ID'];
                            }
                        }

                        for (let i = 0; i < object_item['item_set'].length; i++) {
                            if (object_item['item_set'][i]['Item_ID'] == target) {
                                temp.push(i);
                            } else if (object_item['item_set'][i]['Pos'] == selected) {
                                temp.push(i);
                            }
                        }

                        for (var i = temp.length - 1; i >= 0; i--) {
                            object_item['item_set'].splice(temp[i], 1);
                        }

                        for (let i = 0; i < arr_modal.length; i++) {
                            object_item['item_set'].push(arr_modal[i]);
                        }

                        ajax_save_buy();

                    });

                    function get_pos() {
                        var arr_modal = [];
                        $('.count_base').ready(function() {
                            arr_modal.push({
                                Pos: $('.btn_del', this).attr('id').substr(4),
                                Item_ID: object_item['item'][selected]['Item_ID'],
                                Title: $('input[name=title]', this).val(),
                                Author: $('input[name=author]', this).val(),
                                Edition: $('input[name=edition]', this).val(),
                                Publisher: $('input[name=publisher]', this).val(),
                                Books: $('input[name=books]', this).val(),
                                Price: $('input[name=price]', this).val(),
                                Type: $('input[name=type]', this).val(),
                            });
                        });
                        object_item['item'][selected] = arr_modal[0];
                        console.log(object_item)
                    }


                    function ajax_save_buy() {
                        $.ajax({
                            url: 'ajax_save_buy.php',
                            type: 'post',
                            data: {
                                object_item: object_item,
                                id: global_id,
                                selected: selected,
                            },
                            success: function(response) {
                                console.log(response)
                            }
                        });
                    }
                </script>