<?php
    $code = $_GET['code'];
?>
    <input type="hidden" id="code" value="<?php echo $code ?>">
    <div class="col-sm-12">
        <fieldset style="border: 2px solid silver;margin: 0 2px;padding: .625em .625em 5.75em; background-color: #eee;">
            <legend style="width: auto;padding:0 5px 0 5px;">รายละเอียดสมาชิก</legend>
            <br>
            <center>
                <div class="name_field"></div>
            </center>
            <br><br>
            <table class="table_main field table">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
            <table class="table_main inc1 table">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
            <table class="table_main inc2 table">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
            <table class="table_main sub table">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
            <center>
                <br>
                <button class="btn btn-success" id="btn_save">save</button>
                <button class="btn btn-danger" id="btn_remove">ลบ</button>
            </center>
            <script>

                var field = $('#code').val();

                $(document).ready(function(){
                    load_data_field();
                });

                $("#btn_remove").click(function() {
                    var code = "";
                    code = $(document).find('#code').val();
                    ajax_delete(code);
                });


                $("#btn_save").click(function() {
                    var main_save = [];
                    var temp = [];

                    temp.push($(".field input[name='code']").val());
                    temp.push($(".field input[name='name']").val());
                    main_save.push(temp);
                    temp = [];
                    $(".inc1 input[name='code']").each(function() {
                        name = $(this).parent().parent().find("input[name='name']").val();
                        temp.push([$(this).val(),name]);
                    });
                    main_save.push(temp);
                    temp = [];
                    $(".inc2 input[name='code']").each(function() {
                        name = $(this).parent().parent().find("input[name='name']").val();
                        temp.push([$(this).val(),name]);
                    });
                    main_save.push(temp);
                    temp = [];
                    $(".sub input[name='code']").each(function() {
                        name = $(this).parent().parent().find("input[name='name']").val();
                        temp.push([$(this).val(),name]);
                    });
                    main_save.push(temp);
                    console.log(main_save)

                    ajax_save_edit(main_save);

                });

                function ajax_save_edit(main_save) {
                    $.ajax({
                        url: 'code_editsave.php',
                        type: 'post',
                        data: {
                            data: main_save,
                        },
                        success: function(response) {
                            // console.log(response)
                            alert('แก้ไขสำเร็จ');
                            location.reload();
                        }
                    });
                }

                function ajax_delete(code) {
                    $.ajax({
                        url: 'code_delete.php',
                        type: 'post',
                        data: {
                            code: code
                        },
                        success: function(response) {
                            // console.log(response)
                            window.location.href = "/lib/controller/librarian/code/code_main.php";
                        }
                    });
                }

                function load_data_field() {
                    $.ajax({
                        url: 'ajax_data_field.php',
                        data: {
                            data: field
                        },
                        type: 'post',
                        success: function(response) {
                            // console.log(response)
                            main_data = JSON.parse(response);
                            table_main(main_data);
                            console.log(main_data)
                        }
                    });
                }

                function table_main(main_data){
                    var field_head_len = $('.table_main.field thead').children().length;
                    var field_body_len = $('.table_main.field tbody').children().length;
                    var inc1_head_len = $('.table_main.inc1 thead').children().length;
                    var inc1_body_len = $('.table_main.inc1 tbody').children().length;
                    var inc2_head_len = $('.table_main.inc2 thead').children().length;
                    var inc2_body_len = $('.table_main.inc2 tbody').children().length;
                    var sub_head_len = $('.table_main.sub thead').children().length;
                    var sub_body_len = $('.table_main.sub tbody').children().length;

                    var stack = "";
                    $('.name_field').html("เขตข้อมูล : "+main_data[0][0]['Field']);
                    if (field_head_len==0) {
                        stack += "<tr>";
                            stack += "<th>";
                                stack += "รหัสเขตข้อมูล";
                            stack += "</th>";
                            stack += "<th>";
                                stack += "ชื่อเขตข้อมูล";
                            stack += "</th>";
                        stack += "</tr>";
                        $('.table_main.field thead').append(stack)
                    }
                    if (field_body_len==0) {
                        stack = ""
                        stack += "<tr>";
                            stack += "<td>";
                                stack += "<input type='text' class='form-control field' name='code' disabled value='"+main_data[0][0]['Field']+"' >";
                            stack += "</td>";
                            stack += "<td>";
                                stack += "<input type='text' class='form-control field' name='name' value='"+main_data[0][0]['Name']+"' >";
                            stack += "</td>";
                        stack += "</tr>";
                        $('.table_main.field tbody').append(stack)
                    }
                    if (main_data.length==3) {
                        var ck_order1 = 0;
                        var ck_order2 = 0;
                        for (let i = 0; i < main_data[1].length; i++) {
                            if (main_data[1][i]['Order']==1) {
                                if (inc1_head_len==0&&ck_order1==0) {
                                    stack = ""
                                    stack += "<tr>";
                                        stack += "<th>";
                                            stack += "รหัสตัวบ่งชี้ตำแหน่งที่ 1";
                                        stack += "</th>";
                                        stack += "<th>";
                                            stack += "ชื่อตัวบ่งชี้";
                                        stack += "</th>";
                                    stack += "</tr>";
                                    $('.table_main.inc1 thead').append(stack)
                                    ck_order1=1;
                                }
                                stack = ""
                                stack += "<tr>";
                                    stack += "<th>";
                                        stack += "<input type='text' class='form-control inc1' name='code' disabled value='"+main_data[1][i]['Code']+"' >";
                                    stack += "</th>";
                                    stack += "<th>";
                                        stack += "<input type='text' class='form-control inc1' name='name' value='"+main_data[1][i]['Description']+"' >";
                                    stack += "</th>";
                                stack += "</tr>";
                                $('.table_main.inc1 tbody').append(stack)
                            }
                            else if(main_data[1][i]['Order']==2) {
                                if (inc2_head_len==0&&ck_order2==0) {
                                    stack = ""
                                    stack += "<tr>";
                                        stack += "<th>";
                                            stack += "รหัสตัวบ่งชี้ตำแหน่งที่ 2";
                                        stack += "</th>";
                                        stack += "<th>";
                                            stack += "ชื่อตัวบ่งชี้";
                                        stack += "</th>";
                                    stack += "</tr>";
                                    $('.table_main.inc2 thead').append(stack);
                                    ck_order2 = 1;
                                }
                                stack = ""
                                stack += "<tr>";
                                    stack += "<th>";
                                        stack += "<input type='text' class='form-control inc2' name='code' disabled value='"+main_data[1][i]['Code']+"' >";
                                    stack += "</th>";
                                    stack += "<th>";
                                        stack += "<input type='text' class='form-control inc2' name='name' value='"+main_data[1][i]['Description']+"' >";
                                    stack += "</th>";
                                stack += "</tr>";
                                $('.table_main.inc2 tbody').append(stack)
                            }
                            
                        }
                    }
                    if (sub_head_len==0) {
                        stack = ""
                        stack += "<tr>";
                            stack += "<th>";
                                stack += "รหัสเขตข้อมูลย่อย";
                            stack += "</th>";
                            stack += "<th>";
                                stack += "ชื่อเขตข้อมูลย่อย";
                            stack += "</th>";
                        stack += "</tr>";
                        $('.table_main.sub thead').append(stack);
                    }
                    for (let i = 0; i < main_data[2].length; i++) {
                        stack = ""
                        stack += "<tr>";
                            stack += "<th>";
                                stack += "<input type='text' class='form-control sub' name='code' disabled value='"+main_data[2][i]['Code']+"' >";
                            stack += "</th>";
                            stack += "<th>";
                                stack += "<input type='text' class='form-control sub' name='name' value='"+main_data[2][i]['Name_Eng']+"' >";
                            stack += "</th>";
                        stack += "</tr>";
                        $('.table_main.sub thead').append(stack);
                    }
                }

        </script>