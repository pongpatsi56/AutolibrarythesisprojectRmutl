<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
?>
<?php
$sql = "SELECT max(ID) as ID FROM buy";
$data = $conn->query($sql);
$data_num_buy = $data->fetch_assoc();
$data_num_buy = $data_num_buy['ID'] + 1;
?>
<br><br><br>
<section class="container">
    <div class="row" style="padding-top: 20px;padding-bottom: 400px; background-color: #eee;">
        <div class="col-md-12">
            <a href="../buy/buy.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
            <div class=" pull-right">
                <label for="pwd">รหัสสมาชิก: <?php echo $data_num_buy; ?></label>
            </div><br><br><br>


            <div class="container-fluid">
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="pwd">
                            วันที่ซื้อ
                        </label>
                        <input class="btn btn-white" type="date" name="date" id="date">
                        <button onClick="item_add()" type="button" class=" btn btn-primary">+</button>
                        <button onClick="save()" type="button" class=" btn btn-primary">save</button>
                    </div>
                </div>

                <br><br>

                <table id="item">
                    <thead>
                        <tr>
                            <th for="">Title</th>


                            <th for="">Author</th>


                            <th for="">Edition</th>


                            <th for="">Publisher</th>


                            <th for="">Price</th>


                            <th for="">Books</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <input type="text" name="title" class="item find0 form-control">
                            </th>
                            <th>
                                <input type="text" name="author" class="item find0 form-control">
                            </th>
                            <th>
                                <input type="text" name="edition" class="item find0 form-control">
                            </th>
                            <th>
                                <input type="text" name="publisher" class="item find0 form-control">
                            </th>
                            <th>
                                <input type="text" name="price" class="item find0 form-control">
                            </th>
                            <th>
                                <input type="text" name="books" class="item find0 form-control">
                            </th>
                            <th>
                                <button type="button" class="btn_del btn btn-primary" id="0">x</button>
                            </th>
                        </tr>
                </table>
                <!----------------------------------------------------------------------------------->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Modal title</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div id="append_set">
                                    </div>

                                    <table id="item2">
                                        <thead>
                                            <tr>

                                                <th for="">Title</th>


                                                <th for="">Author</th>


                                                <th for="">Edition</th>


                                                <th for="">Publisher</th>


                                                <th for="">Books</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>
                                                    <input type="text" name="title" class="item2_modal find0 form-control">
                                                </th>
                                                <th>
                                                    <input type="text" name="author" class="item2_modal find0 form-control">
                                                </th>
                                                <th>
                                                    <input type="text" name="edition" class="item2_modal find0 form-control">
                                                </th>
                                                <th>
                                                    <input type="text" name="publisher" class="item2_modal find0 form-control">
                                                </th>
                                                <th>
                                                    <input type="text" name="books" class="item2_modal find0 form-control">
                                                </th>
                                                <th>
                                                    <button onClick="item_add2()" type="button" class="btn btn-primary">+</button>
                                                </th>
                                                <th>
                                                    <button onClick="set_val()" type="button" class="btn btn-primary">set value</button>
                                                </th>
                                            </tr>
                                        </tbody>

                                    </table>
                                    <div class="pull-right">

                                        <br>
                                        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                                        <button type="button" class="btn_save btn btn-primary ">Save changes</button>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <script>
                            var it = 1;
                            var it_modal = 1;
                            var set = "a1";
                            var arr_set = [];
                            var total_modal = {};
                            var temp = null;
                            var base_on = [];
                            var total_base = [];
                            var total_set = {};
                            var date;






                            function item_add() {
                                var stack = "";

                                stack += "<tr>";
                                stack += "<th class='item find" + it + "'><input type='text' name='title' class='form-control item find " + it + "'></th>";


                                stack += "<th class='item find" + it + "'><input type='text' name='author' class='form-control item find " + it + "'></th>";


                                stack += "<th class='item find" + it + "'><input type='text' name='edition' class='form-control item find " + it + "'></th>";


                                stack += "<th class='item find" + it + "'><input type='text' name='publisher' class='form-control item find " + it + "'></th>";


                                stack += "<th class='item find" + it + "'><input type='text' name='price' class='form-control item find " + it + "'></th>";


                                stack += "<th class='item find" + it + "'><input type='text' name='books' class='form-control item find " + it + "'></th>";


                                stack += "<th class=' item find" + it + "'><button type='button' class='btn_del btn btn-danger' id='" + it + "'>x</button> </th>";
                                stack += "<th class='item find" + it + "'><button type='button' class='btn btn-primary change' id='" + it + "'><-></button></th>";
                                stack += "</tr>";

                                it++;
                                $('#item').append(stack)
                            }

                            function item_add2() {
                                var stack = "";

                                stack += "<tr class='count_modal item2 find" + it_modal + "'>";


                                stack += "   <th ><input type='text' name='title' class='form-control item2_modal find" + it_modal + "'></th>";


                                stack += "   <th ><input type='text' name='author' class='form-control item2_modal find" + it_modal + "'></th>";


                                stack += "   <th ><input type='text' name='edition' class='form-control item2_modal find" + it_modal + "'></th>";


                                stack += "   <th ><input type='text' name='publisher' class='form-control item2_modal find" + it_modal + "'></th>";


                                stack += "   <th><input type='text' name='books' class='form-control item2_modal find" + it_modal + "'></th>";


                                stack += "   <th ><button type='button' class='btn_del btn btn-danger' id='" + it_modal + "'>x</button> ";

                                stack += "</tr>";
                                it_modal++;
                                $('#item2').append(stack)
                            }

                            $('#item').on('click', '.btn_del', function() {
                                var select = $(this);
                                var myid = $(this).attr('id');
                                var html = select.parent().parent().parent().find('.item.find' + myid + '');
                                $(html).remove();
                            });

                            $('#item2').on('click', '.btn_del', function() {
                                var select = $(this);
                                var myid = $(this).attr('id');
                                var html = select.parent().parent().parent().find('.item2.find' + myid + '');
                                $(html).remove();
                            });

                            $('.modal-footer').on('click', '.btn_save', function() {
                                var arr_modal = [];
                                var r = 0;
                                var size = Object.size(total_modal);

                                $(".count_modal").each(function() {
                                    arr_modal.push([r]);
                                    arr_modal[r].push($('input[name=title]', this).val());
                                    arr_modal[r].push($('input[name=author]', this).val());
                                    arr_modal[r].push($('input[name=edition]', this).val());
                                    arr_modal[r].push($('input[name=publisher]', this).val());
                                    arr_modal[r].push($('input[name=books]', this).val());
                                    arr_modal[r].shift();
                                    r++;
                                });
                                var key = $(this).parent().parent().find('input[name*=num]').val();
                                var check = 0;
                                if (size > 0) {
                                    for (var i in total_modal) {
                                        if (i == btn_select) {
                                            total_modal[btn_select] = arr_modal;
                                            check = 1;
                                        }
                                    }
                                    if (check == 0) {
                                        total_modal[key] = arr_modal;
                                    }
                                } else {
                                    total_modal[key] = arr_modal;
                                }
                                $('#exampleModal').modal('toggle');
                                change_base_on();
                            });

                            $('#exampleModal').on('hidden.bs.modal', function(e) {
                                $(this)
                                    .find("input")
                                    .val('')
                                    .end()
                            })


                            $('#item').on('click', '.btn_del_set', function() {
                                var key = $(this).attr('id').substr(1, set.length);
                                key = key - 1;
                                var html = $(this).parent().parent().parent().find('.item.find' + $(this).attr('id') + '');
                                var html2 = $(this).parent().parent().parent().find('.item.find' + arr_set[key] + '');
                                $(html).remove();
                                $(html2).remove();
                            });

                            $('#item').on('click', '.change', function() {
                                var select = $(this);
                                var myid = $(this).attr('id');
                                var html = select.parent().parent().parent().find('.item.find' + myid + '');
                                replace(select, myid);
                            });

                            function replace(select, myid) {
                                var location = select.parent().parent();
                                var stack = "";
                                stack += "<tr>";
                                stack += "<th><input type='text' name='title' class='form-control item2 find" + set + "'></th>";


                                stack += "<th><input type='text' name='author' class='form-control item2 find" + set + "'></th>";


                                stack += "<th><input type='text' name='edition' class='form-control item2 find" + set + "'></th>";


                                stack += "<th><input type='text' name='publisher' class='form-control item2 find" + set + "'></th>";

                                ;
                                stack += "<th><input type='text' name='price' class='form-control item2 find" + set + "'></th>";


                                stack += "<th><input type='text' name='books' class='form-control item2 find" + set + "'></th>";
                                stack += "<th><button type='button' class='btn_del_set btn btn-danger' id='" + set + "'>x</button> ";

                                stack += "<th><button type='button' class='btn_append btn_modal btn btn-primary btn_select' data-toggle='modal' data-target='#exampleModal' name='set" + set + "'>set" + set + "</button>";

                                stack += "<th><input type='hidden' name='num" + set + "' value='" + set + "'>";
                                stack += "</tr>";
                                set = set.substr(1, set.length);
                                set++;
                                set = "a" + set;
                                arr_set.push(myid);
                                $(location).html(stack);
                            }


                            $('#item').on('click', '.btn_append', function() {
                                $('#append_set').find('input[name*=num]').remove();
                                var vals = $(this).parent().find('input[name*=num]').val();
                                $('#append_set').append("<input type='hidden' name='num" + vals + "' value='" + vals + "'>")
                            });

                            var arr_check = [];
                            var btn_select = "";

                            $('#item').on('click', '.btn_select', function() {
                                var select = $(this).attr('name');
                                btn_select = select.substr(3, select.length);
                            });

                            Object.size = function(obj) {
                                var size = 0,
                                    key;
                                for (key in obj) {
                                    if (obj[key].length != 0) size++;
                                }
                                return size;
                            };


                            $('#exampleModal').on('show.bs.modal', function() {
                                it_modal = 1;
                                var size = Object.size(total_modal);
                                var size_base_on = Object.size(base_on);

                                if (size_base_on > 0 && size == 0) {
                                    for (let index = 0; index < (base_on[4] - 1); index++) {
                                        item_add2();
                                    }
                                } else if (size_base_on > 0 && size != 0) {
                                    if (size > 0) {
                                        var select_k = "";
                                        for (var i in total_modal) {
                                            if (i == btn_select) {
                                                if (base_on[4] > total_modal[i].length) {
                                                    for (let index = 0; index < (base_on[4] - total_modal[i].length); index++) {
                                                        item_add2();
                                                    }
                                                }
                                                for (var j in total_modal[i]) {
                                                    if (j != 0) {
                                                        item_add2();
                                                    }
                                                    for (var k in total_modal[i][j]) {
                                                        if (k == 0) {
                                                            select_k = $('#append_set').parent().find('input[name=title].find' + j + '', this);
                                                            $(select_k).val(total_modal[i][j][k]);
                                                        } else if (k == 1) {
                                                            select_k = $('#append_set').parent().find('input[name=author].find' + j + '', this);
                                                            $(select_k).val(total_modal[i][j][k]);
                                                        } else if (k == 2) {
                                                            select_k = $('#append_set').parent().find('input[name=edition].find' + j + '', this);
                                                            $(select_k).val(total_modal[i][j][k]);
                                                        } else if (k == 3) {
                                                            select_k = $('#append_set').parent().find('input[name=publisher].find' + j + '', this);
                                                            $(select_k).val(total_modal[i][j][k]);
                                                        } else if (k == 4) {
                                                            select_k = $('#append_set').parent().find('input[name=books].find' + j + '', this);
                                                            $(select_k).val(total_modal[i][j][k]);
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }


                            });

                            $("#exampleModal").on("hidden.bs.modal", function() {
                                var size = Object.size(total_modal);
                                if (size > 0) {
                                    for (var i in total_modal) {
                                        if (i == btn_select) {
                                            for (var j in total_modal[i]) {
                                                $("#item2").children('.item2:not(.item2.find0)').remove();
                                            }
                                        }
                                    }
                                }
                            });

                            $('#item').on('click', '.btn_modal', function() {
                                var arr_modal = [];
                                var point = null;

                                point = $(this).parent().parent().find('input[name=title].find' + btn_select + '').val();
                                arr_modal.push(point);
                                point = $(this).parent().parent().find('input[name=author].find' + btn_select + '').val();
                                arr_modal.push(point);
                                point = $(this).parent().parent().find('input[name=edition].find' + btn_select + '').val();
                                arr_modal.push(point);
                                point = $(this).parent().parent().find('input[name=publisher].find' + btn_select + '').val();
                                arr_modal.push(point);
                                point = $(this).parent().parent().find('input[name=books].find' + btn_select + '').val();
                                arr_modal.push(point);

                                base_on = arr_modal;

                            });

                            function change_base_on() {
                                $(document).find('input[name=books].find' + btn_select + '').val(total_modal[btn_select].length);
                            }


                            function set_val() {
                                var r = 0;
                                var count = 0;

                                modal_size = $(':input[name=title].item2_modal').length

                                for (let index = 0; index < modal_size; index++) {
                                    $('.count_modal').find('input[name=title].find' + r + '').val(base_on[0]);
                                    $('.count_modal').find('input[name=author].find' + r + '').val(base_on[1]);
                                    $('.count_modal').find('input[name=edition].find' + r + '').val(base_on[2]);
                                    $('.count_modal').find('input[name=publisher].find' + r + '').val(base_on[3]);
                                    $('.count_modal').find('input[name=books].find' + r + '').val(1);
                                    r++;
                                }
                            }

                            function save() {
                                var arr_temp_class = [];
                                var arr_temp_class_set = [];

                                $("input.item").each(function() {
                                    attr_class = $(this).attr('class').split(/\s+/);
                                    if (jQuery.inArray(attr_class[1], arr_temp_class) == -1) {
                                        arr_temp_class.push(attr_class[1]);
                                    }
                                });
                                $("input.item2").each(function() {
                                    attr_class = $(this).attr('class').split(/\s+/);
                                    if (jQuery.inArray(attr_class[1], arr_temp_class_set) == -1) {
                                        arr_temp_class_set.push(attr_class[1]);
                                    }
                                });
                                for (let i = 0; i < arr_temp_class.length; i++) {
                                    var temp = [];
                                    val = $('#item').find('input[name=title].' + arr_temp_class[i] + '').val();
                                    temp.push(val);
                                    val = $('#item').find('input[name=author].' + arr_temp_class[i] + '').val();
                                    temp.push(val);
                                    val = $('#item').find('input[name=edition].' + arr_temp_class[i] + '').val();
                                    temp.push(val);
                                    val = $('#item').find('input[name=publisher].' + arr_temp_class[i] + '').val();
                                    temp.push(val);
                                    val = $('#item').find('input[name=price].' + arr_temp_class[i] + '').val();
                                    temp.push(val);
                                    val = $('#item').find('input[name=books].' + arr_temp_class[i] + '').val();
                                    temp.push(val);

                                    total_base.push(temp);
                                }

                                for (let i = 0; i < arr_temp_class_set.length; i++) {
                                    var temp = [];
                                    val = $('#item').find('input[name=title].' + arr_temp_class_set[i] + '').val();
                                    temp.push(val);
                                    val = $('#item').find('input[name=author].' + arr_temp_class_set[i] + '').val();
                                    temp.push(val);
                                    val = $('#item').find('input[name=edition].' + arr_temp_class_set[i] + '').val();
                                    temp.push(val);
                                    val = $('#item').find('input[name=publisher].' + arr_temp_class_set[i] + '').val();
                                    temp.push(val);
                                    val = $('#item').find('input[name=price].' + arr_temp_class_set[i] + '').val();
                                    temp.push(val);
                                    val = $('#item').find('input[name=books].' + arr_temp_class_set[i] + '').val();
                                    temp.push(val);

                                    total_set[arr_temp_class_set[i].substr(4)] = temp;
                                }

                                date = $('#date').val();

                                ajax_save();

                            }


                            function ajax_save(deptid, obj) {
                                $.ajax({
                                    url: 'ajax_buy_new.php',
                                    type: 'post',
                                    data: {
                                        base: total_base,
                                        set_front: total_set,
                                        set_back: total_modal,
                                        date: date
                                    },
                                    success: function(response) {
                                        location.reload()
                                    }
                                });
                            }
                        </script>