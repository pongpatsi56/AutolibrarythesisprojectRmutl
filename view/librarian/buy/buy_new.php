<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
?>
<br>
<br>
<br>

<?php
$sql = "SELECT max(ID) as ID FROM buy";
$data = $conn->query($sql);
$data_num_buy = $data->fetch_assoc();
$data_num_buy = $data_num_buy['ID'] + 1;
?>

<section class="container">
    <div class="row" style="padding-top: 20px;padding-bottom: 400px; background-color: #eee;">
        <div class="col-md-12">
            <a href="../buy/buy.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
            &nbsp;&nbsp;<b style="font-size: 25px;">ทำรายการเพิ่มทรัพยากรที่ซื้อใหม่</b>
            <div class=" pull-right">
                <label for="pwd">เลขรายการซื้อ: <?php echo $data_num_buy; ?></label>
            </div><br><br><br>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label col-sm-1" for="pwd">ชื่อ:</label></b>
                        <!--<input type="date" name="date" id="date" class="btn btn-white"> -->
                        <form id="upload_csv" method="post" enctype="multipart/form-data">  
                            <input type="text" class="btn btn-white" name="date" id="date" style="width: 300; background-color:#fff">
                            <button onClick="item_add()" type="button" class="btn btn-primary">เพิ่มรายการเดี่ยว</button>
                            <input type="file" class="btn btn-white" name="book_file" style="border-width: 1px;border-color: #b1a5a5;display: inline;width:300;background-color: white;" />
                              <input type="submit" name="upload" id="upload" value="อัพโหลด" 
     class="btn btn-info" />   
    <button onClick="save()" type="button" 
     class="btn btn-success">บันทึก</button>
                           <button type="button" style="position: relative;left: 520px;" class="btn btn-primary download_file_btn ">
                               โหลดไฟล์รูปแบบการลงข้อมูลExcel</button>
                          
                            <div style="clear:both"></div> 
                        </form>  
                        <!-- <button onClick="set_add()" type="button" class="btn btn-primary">เพิ่มรายการหมู่</button> -->
                        
                    </div>
                </div>
                <br><br>
                <table class="table_main">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>

<!----------------------------------------------------------------------------------->
<div class="modal fade" id="modal_set" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin: center;margin-left: 18%;">
        <div class="modal-content" style="  width:150%; position:relative ;">
            <div style="  background-color: #FAFAD2;">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">ชื่อ Modal</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <button onClick="item_add_modal()" type="button" class=" btn btn-primary">เพิ่มรายการเดี่ยว</button>
                    
                    <table class='table_modal'>
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn_save btn btn-primary">บันทึก</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#date').Zebra_DatePicker({
            format: 'Y-m-d',
            todayBtn: "linked"
        });
        
        var it = 0;
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

        $('#upload_csv').on("submit", function(e){  
                e.preventDefault(); //form will not submitted  
                $.ajax({  
                     url:"import.php",  
                     method:"POST",  
                     data:new FormData(this),  
                     contentType:false,          // The content type used when sending data to the server.  
                     cache:false,                // To unable request pages to be cached  
                     processData:false,          // To send DOMDocument or non processed data file it is set to false  
                     success: function(data){  
                        //  console.log(data)
                        alert('บันทึกสำเร็จ');
                        location.reload()
                     }  
                })  
           });  
           
           
        $('.download_file_btn').on('click', function() {
            console.log(1234)
            $.ajax({
                url: 'ajax_download_file.php',
                success: function(response) {
                    window.location = 'ajax_download_file.php';
                }
            });
        });


        $('.table_modal').on('click', '.btn_del', function() {
            console.log(134)
            var select = $(this).parent().parent();
            $(select).remove();
            if ($('.table_modal tbody').children().length == 0) {
                $('.table_modal thead').empty();
            }
        });
        $('.table_main').on('click', '.btn_del', function() {
            console.log(134)
            var select = $(this).parent().parent();
            $(select).remove();
            if ($('.table_main tbody').children().length == 0) {
                $('.table_main thead').empty();
            }
        });

        $('.table_main').on('click', '.btn_edit', function() {
            select_id = $(this).attr('id');
            $('#modal_set').modal('toggle');
        });

        $('.modal-footer').on('click', '.btn_save', function() {
            var obj_modal = {};
            var temp = {};
            var count = 0;

            $(".item_modal.form-control").each(function() {
                if ($(this).attr('name') == 'title') {
                    temp.title = $(this).val();
                } else if ($(this).attr('name') == 'author') {
                    temp.author = $(this).val();
                } else if ($(this).attr('name') == 'edition') {
                    temp.edition = $(this).val();
                } else if ($(this).attr('name') == 'publisher') {
                    temp.publisher = $(this).val();
                } else if ($(this).attr('name') == 'books') {
                    temp.books = $(this).val();
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

        function show_data() {
            var stack = "";
            var check_table = $('.table_modal thead').children().length
            if (check_table == 0) {
                stack += "<br>";
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
                stack += "<input type='text' class='item_modal form-control' name='title' value='" + data_main.modal[select_id][i]['title'] + "'>";
                stack += "</td>";
                stack += "<td>";
                stack += "<input type='text' class='item_modal form-control' name='author' value='" + data_main.modal[select_id][i]['author'] + "'>";
                stack += "</td>";
                stack += "<td>";
                stack += "<input type='text' class='item_modal form-control' name='edition' value='" + data_main.modal[select_id][i]['edition'] + "'>";
                stack += "</td>";
                stack += "<td>";
                stack += "<input type='text' class='item_modal form-control' name='publisher' value='" + data_main.modal[select_id][i]['publisher'] + "'>";
                stack += "</td>";
                stack += "<td>";
                stack += "<input type='text' class='item_modal form-control' name='books' value='" + data_main.modal[select_id][i]['books'] + "'>";
                stack += "</td>";
                stack += "<td>";
                stack += "<button type='button' class='btn_del btn btn-danger'>ลบ</button>";
                stack += "</td>";
                stack += "</tr>";
                $('.table_modal tbody').append(stack)
            }
        }

        function item_add() {
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
            stack += "<input type='text' style='width: 450;' class='item form-control' name='title'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input type='text'  class='item form-control' name='ISBN'>";
            stack += "</td>";
            // stack += "<td>";
            // stack += "<input type='text' class='item form-control' name='author'>";
            // stack += "</td>";
            // stack += "<td>";
            // stack += "<input type='text' class='item form-control' name='edition'>";
            // stack += "</td>";
            // stack += "<td>";
            // stack += "<input type='text' class='item form-control' name='publisher'>";
            // stack += "</td>";
            stack += "<td>";
            stack += "<input type='text' class='item form-control' name='price'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input type='text' class='item form-control' name='books'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<button type='button' class='btn_del btn btn-danger' id='" + it + "'>ลบ</button>";
            stack += "</td>";
            stack += "</tr>";
            $('.table_main tbody').append(stack)
            it++;
        }

        function set_add() {
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
            stack += "<input type='text' class='item form-control pos" + it + "' name='title'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input type='text' class='item form-control pos" + it + "' name='author'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input type='text' class='item form-control pos" + it + "' name='edition'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input type='text' class='item form-control pos" + it + "' name='publisher'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input type='text' class='item form-control pos" + it + "' name='price'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input type='text' class='item form-control pos" + it + "' name='books' disabled>";
            stack += "</td>";
            stack += "<td>";
            stack += "<button type='button' class='btn_del btn btn-danger' id='" + it + "'>ลบ</button>";
            stack += "</td>";
            stack += "<td>";
            stack += "<button type='button' class='btn_edit btn btn-link' id='" + it + "'>แก้ไข</button>";
            stack += "</td>";
            stack += "</tr>";
            $('.table_main tbody').append(stack)
            it++;
        }

        function item_add_modal() {
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
            stack += "<input type='text'  class='item_modal form-control' name='title'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input type='text' class='item_modal form-control' name='author'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input type='text' class='item_modal form-control' name='edition'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input type='text' class='item_modal form-control' name='publisher'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<input type='text' class='item_modal form-control' name='books'>";
            stack += "</td>";
            stack += "<td>";
            stack += "<button type='button' class='btn_del btn btn-danger'>ลบ</button>";
            stack += "</td>";
            stack += "</tr>";
            $('.table_modal tbody').append(stack)
        }

        function save() {
            var temp = {};

            $('input.item.form-control').each(function() {
                if ($(this).attr('name') == 'title') {
                    temp.title = $(this).val();
                }
                else if ($(this).attr('name') == 'ISBN') {
                    temp.ISBN = $(this).val();
                } 
                // else if ($(this).attr('name') == 'author') {
                //     temp.author = $(this).val();
                // } else if ($(this).attr('name') == 'edition') {
                //     temp.edition = $(this).val();
                // } else if ($(this).attr('name') == 'publisher') {
                //     temp.publisher = $(this).val();
                // } 
                else if ($(this).attr('name') == 'price') {
                    temp.price = $(this).val();
                } 
                else if ($(this).attr('name') == 'books') {
                    temp.books = $(this).val();
                }
                // console.log(temp)

                if (Object.size(temp) != 0 && Object.keys(temp).length == 4) {
                    var id = $(this).parent().parent().find('button.btn_del').attr('id')
                    data_main.main[id] = temp;
                    temp = {};
                }
            });
            // console.log(data_main)
            date = $('#date').val();
            ajax_save(date);
        }


        function ajax_save(date) {
            // console.log(data_main);

            $.ajax({
                url: 'ajax_buy_new.php',
                type: 'post',
                data: {
                    data: data_main,
                    date: date
                },
                success: function(response) {
                    // console.log(response);
                    alert('บันทึกสำเร็จ');
                    location.reload()
                }
            });
        }
    </script>

    <style>
        .modal-body {
            overflow-x: auto;
        }
    </style>