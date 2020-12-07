<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
    ?>
    <br>
    <br>
    <br>
    <section class="container">
        <div class="row" style="padding-top: 20px;padding-bottom: 400px; background-color: #eee;">
            <div class="col-md-12">

                <a href="/lib/view/librarian/add.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
                &nbsp;&nbsp;<b style="font-size: 25px;">แก้ไขบรรณานุกรม</b>
                <br>
                <br>
                <br>
                <div class="col-md-12">
                    <b>ค้นหา</b> <input type="text" class="btn btn-whit code_search" name="code_search">
                    <button class="btn_find btn btn-primary">ค้นหา</button>
                    <button class="btn_add  btn btn-primary">เพิ่มรายการ</button>
                    <button class="btn_save btn btn-success">บันทึก</button>
                    <br>
                    <br>

                    <table class="table_append">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="width: 800; left: -130;">
                                <div style="  background-color: #FAFAD2;">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="exampleModalLongTitle">Modal title</h2>
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
                                        <button type="button" class="btn btn-primary btn_modal_save">บันทึก</button>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                </div>
                            </div>
                        </div>
                    </div>


    <!----------------------------------modal_find_bib--------------------------------------------------------->
    <div class="modal fade" id="modal_find_bib" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 1000;left: -200;">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel"></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table_find_bib" > 
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
    <!----------------------------------modal_find_bib--------------------------------------------------------->



    <script>
        var id = null;
        var data_base = [];
        var inc1_pos = null;
        var inc2_pos = null;
        var sub_pos = null;
        var data_bib = null;
        var bib_id = null;

        Object.size = function(obj) {
            var size = 0,
                key;
            for (key in obj) {
                if (obj[key].length != 0) size++;
            }
            return size;
        };

        $('.btn_find').on('click', function() {
            id = $(document).find('input[name=code_search]').val();
            $('.table_append thead').empty();
            $('.table_append tbody').empty();
            $('.table_find_bib thead').empty();
            $('.table_find_bib tbody').empty();
            find_code(id);
        })
        
        $('.code_search').on('keypress', function(key) {
            if(key.which==13){
                id = $(document).find('.code_search').val();
                $('.table_append thead').empty();
                $('.table_append tbody').empty();
                $('.table_find_bib thead').empty();
                $('.table_find_bib tbody').empty();
                find_code(id);
            }
        })

        $('.btn_save').on('click', function() {
            var all_code = []
            var all_inc1 = []
            var all_inc2 = []
            var all_sub = []
            $('input[name=field]').each(function() {
                all_code.push($(this).val());
            })
            $('input[name=inc1]').each(function() {
                all_inc1.push($(this).val());
            })
            $('input[name=inc2]').each(function() {
                all_inc2.push($(this).val());
            })
            $('input[name=sub]').each(function() {
                all_sub.push($(this).val());
            })
            save(all_code, all_inc1, all_inc2, all_sub)
        })

        $('.table_append').on('click', '.btn_modal', function() {
            field = $(this).parent().parent().find('input[name=field]').val();
            inc1 = $(this).parent().parent().find('input[name=inc1]').val();
            inc1_pos = $(this).parent().parent().find('input[name=inc1]');
            inc2 = $(this).parent().parent().find('input[name=inc2]').val();
            inc2_pos = $(this).parent().parent().find('input[name=inc2]');
            sub = $(this).parent().parent().find('input[name=sub]').val();
            sub_pos = $(this).parent().parent().find('input[name=sub]');
            
            $('.table_modal_inc thead').empty();
            $('.table_modal_inc tbody').empty();
            $('.table_modal_sub thead').empty();
            $('.table_modal_sub tbody').empty();
            
            find_data_field(field, inc1, inc2, sub);
            $('#modal_edit').modal('toggle');
        })

        $('#modal_edit').on('click', '.btn_modal_save', function() {
            var temp = [];  
            var check_field = $(this).parent().parent().find('#exampleModalLongTitle').html().substr(-3,3)
            var myarray = ['001','002','003','004','005','006','007','008'];
                    if (jQuery.inArray(check_field, myarray) !== -1) {
                        $(sub_pos).val($(".modal_sub").val());
                    }
                    else {
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
                // sub = sub.replace('#','$');
            }

            $(sub_pos).val(sub);
        }

            $('#modal_edit').modal('toggle');

        })

        $('.btn_add').on('click', function() {
            var stack = "";
            stack += "<tr>";
                stack += "<td>";
                    stack += "<input type='text'     style='width: 150;' class='form-control' name='field' value=''>";
                stack += "</td>";
                stack += "<td>";
                    stack += "<input type='text'  style='width: 150;'  class='form-control' name='inc1' value='' disabled >";
                stack += "</td>";
                stack += "<td>";
                    stack += "<input type='text'  style='width: 150;' class='form-control'  name='inc2' value='' disabled >";
                stack += "</td>";
                stack += "<td>";
                    stack += "<input type='text'  style='width: 550;' class='form-control' name='sub' value='' disabled >";
                stack += "</td>";
                stack += "<td>";
                    stack += "<button class='btn_modal btn btn-link ' >แก้ไข</button>";
                stack += "</td>";
                stack += "<td>";
                    stack += "<button class='btn_del btn btn-danger' >ลบ</button>";
                stack += "</td>";
            stack += "</tr>";
            $('.table_append tbody').append(stack);
        })

        $('.table_append').on('click', '.btn_del', function() {
            var select = $(this).parent().parent();
            select.remove();
        })

        $('.table_find_bib').on('click', '.sel_bib', function() {
            bib_id = $(this).attr('value');
            $('#modal_find_bib').modal('toggle');
            append_table(bib_id,data_bib);
        })

        $("#modal_edit").on('hidden.bs.modal', function() {
            $('.table_modal thead').empty();
            $('.table_modal tbody').empty();
        });

        $("#modal_find_bib").on('hidden.bs.modal', function() {
            $('.table_find_bib thead').empty();
            $('.table_find_bib tbody').empty();
        });


        function find_code(id) {
            $.ajax({
                url: 'ajax_find.php',
                type: 'post',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response!=1) {
                        data_bib = JSON.parse(response)
                        console.log(data_bib)
                        append_find_bib(data_bib);
                    }
                    else{
                        $('.table_find_bib thead').html('<tr><th>ไม่พบข้อมูล</th></tr>');
                        $('#modal_find_bib').modal('toggle');
                    }
                    
                }
            });
        }

        function find_data_field(field, inc1, inc2, sub) {
            $.ajax({
                url: 'ajax_load_field.php',
                type: 'post',
                data: {
                    field: field
                },
                success: function(response) {
                    data_base = JSON.parse(response)
                    show_edit(field, inc1, inc2, sub, data_base)
                }
            });
        }

        function save(all_code, all_inc1, all_inc2, all_sub) {
            $.ajax({
                url: 'ajax_save.php',
                type: 'post',
                data: {
                    all_code: all_code,
                    all_inc1: all_inc1,
                    all_inc2: all_inc2,
                    all_sub: all_sub,
                    id: bib_id,
                },
                success: function(response) {
                    // console.log(response)
                    location.reload();
                    alert('แก้ไขบรรณานุกรมสำเร็จ');
                }
            });
        }

        function append_find_bib(data_bib){
            var stack = "";
            if (Object.size(data_bib)!=0) {
                stack += "<tr>";
                    stack += "<th>";
                        stack += "ลำดับ";
                    stack += "</th>";
                    stack += "<th>";
                        stack += "ชื่อทรัพยากร";
                    stack += "</th>";
                    stack += "<th>";
                        stack += "ISBN";
                    stack += "</th>";
                stack += "</tr>";
                $('.table_find_bib thead').append(stack);
                stack = "";
                count = 1;
                for (i in data_bib) {
                    stack += "<tr>";
                        stack += "<td>";
                            stack += count++;
                        stack += "</td>";
                        stack += "<td>";
                        var check = 0;
                        for (j in data_bib[i]) {
                            if (j=='245') {
                            stack += "<a class='sel_bib' value='"+i+"'>"+data_bib[i]['245']['cut']+"</a>";
                                check=1;
                            }
                        }
                        if (check==0) {
                            stack += "<a class='sel_bib' value='"+i+"'>-</a>";
                        }
                        stack += "</td>";
                        stack += "<td>";
                        check = 0;
                        for (j in data_bib[i]) {
                            if (j=='022'||j=='020') {
                                stack += data_bib[i][j]['cut'];
                                check=1;
                            }
                        }
                        if (check==0) {
                            stack += "-";
                        }
                        stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_find_bib tbody').append(stack);
            }
            $('#modal_find_bib').modal('toggle');
        }

        function append_table(bib_id,data_bib) {
            var stack = "";
            stack += "<tr>";
            stack += "<th>";
            stack += "<b>เขตข้อมูล";
            stack += "</th>";
            stack += "<th>";
            stack += "<b>ตัวบ่งชี้ 1 ";
            stack += "</th>";
            stack += "<th>";
            stack += "<b>ตัวบ่งชี้ 2 ";
            stack += "</th>";
            stack += "<th>";
            stack += "<b>เขตข้อมูลย่อย";
            stack += "</th>";
            stack += "</tr>";
            $('.table_append thead').append(stack);
            stack = "";
            for (i in data_bib[bib_id]) {
                stack += "<tr>";
                stack += "<td>";
                stack += "<input type='text'  style='width: 150;' class='form-control'  name='field' value='" +i+ "'>";
                stack += "</td>";
                stack += "<td>";
                if (data_bib[bib_id][i]['Indicator1'] == null) {
                    stack += "<input type='text'   style='width: 150;' class='form-control' name='inc1' value='' disabled >";
                } else {
                    stack += "<input type='text'  style='width: 150;' class='form-control' name='inc1' value='" + data_bib[bib_id][i]['Indicator1'] + "' disabled >";
                }
                stack += "</td>";
                stack += "<td>";
                if (data_bib[bib_id][i]['Indicator1'] == null) {
                    stack += "<input type='text'   style='width: 150;' class='form-control'  name='inc2' value='' disabled >";
                } else {
                    stack += "<input type='text'   style='width: 150;' class='form-control'  name='inc2' value='" + data_bib[bib_id][i]['Indicator2'] + "' disabled >";
                }
                stack += "</td>";
                stack += "<td>";
                stack += "<input type='text' style='width: 550;' class='form-control'  name='sub' value='" + data_bib[bib_id][i]['Subfield'] + "' disabled >";
                stack += "</td>";
                stack += "<td>";
                stack += "<button class='btn_modal btn btn-link ' >แก้ไข</button>";
                stack += "</td>";
                stack += "<td>";
                stack += "<button class='btn_del btn btn-danger' >ลบ</button>";
                stack += "</td>";
                stack += "</tr>";
            }
            $('.table_append tbody').append(stack);
        }

        function show_edit(field, inc1, inc2, sub, data_base) {
            console.log(field, inc1, inc2, sub, data_base);
            $('.modal-title').empty();
            $('.modal-title').append('เขตข้อมูล'+field);

            var check_inc1 = $('.table_modal_inc.order1 thead').children().length
            var check_inc2 = $('.table_modal_inc.order2 thead').children().length
            var check_sub = $('.table_modal_sub thead').children().length
            var stack = "";
            var has_inc1 = 0;
            var has_inc2 = 0;
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
                                stack += "<input type='text' style='width: 310;' class='form-control' value='" + data_base[1][i]['Description'] + "'  disabled>";
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
                    stack += "<tr class='text-primary'>";
                        stack += "<td class='code' >";
                            stack += data_base[0][i]['Code'].replace("#", "$");
                        stack += "</td>";

                        stack += "<td>";
                            stack += "<input type='text'  style='width: 310;' name='name_sub' class='form-control' value='" + data_base[0][i]['Name_Eng'] + "' disabled>";
                        stack += "</td>";
                    stack += "<td>";
                    var check = 0;
                    for (let j = 0; j < sub.length; j++) {
                        if (data_base[0][i]['Code'] == sub[j][0]) {
                            stack += "<input type='text'  style='width: 310;' class='modal_sub form-control' name='sub' value='" + sub[j][1] + "'>";
                            check = 1;
                        }
                    }
                    var myarray = ['001','002','003','004','005','006','007','008'];
                    if (check == 0 && jQuery.inArray(field, myarray) == -1) {
                        stack += "<input type='text' style='width: 310;'  class='modal_sub form-control' name='sub'>";
                    }
                    else if (check == 0 && jQuery.inArray(field, myarray) !== -1){
                        stack += "<input type='text' style='width: 310;'  class='modal_sub form-control' name='sub' value='" + sub + "'>";
                    }
                    stack += "</td>";
                    stack += "</tr>";
                }
                $('.table_modal_sub tbody').append(stack)
            }
        }
    </script>