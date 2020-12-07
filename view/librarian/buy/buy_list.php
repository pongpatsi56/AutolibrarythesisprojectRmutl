<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
?>
<style>
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
</style>
<br>
<br>
<br>
<section class="container">
    <div class="row" style="padding-top: 20px;padding-bottom: 400px; background-color: #eee;">
        <div class="col-md-12">
            <a href="../buy/buy.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
            &nbsp;&nbsp;<b style="font-size: 25px;"> แก้ไขทรัพยากรที่ซื้อใหม่</b>

            <div class="container-fluid">
                <br>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <b>วันที่ซื้อ</b>
                         <!-- <input type="date" name="date" id="date" class="btn btn-white"> -->
                        <input type="text" class="btn btn-white" name="date" id="date" style="width: 300; background-color:#fff">
                        <button onClick="find()" type="button" class=" btn btn-primary">ค้นหา</button>
                    </div>
                </div>
            </div>
            <br>
            <div id="append_table">
            </div>



            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="margin: center;margin-left: 18%;">
                    <div class="modal-content" style="  width: 900;height: initial;">
                        <div style="  background-color: #FAFAD2;">
                            <div class="modal-header">
                                <h2 class="modal-title" id="exampleModalLabel"></h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="modal_body">

                            </div>
                            <div width="500%" height="100%" class="modal-footer">

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
                    $('#date').Zebra_DatePicker({
                        format: 'Y-m-d',
                        todayBtn: "linked"
                    });
                    
                    var object_item = {};

                    function find() {
                        if ($("#append_table").children().length !=0) {
                            remove_table();
                        }
                        var date = $(document).find('#date').val();
                        ajax_find(date);
                    }

                    function remove_table() {
                        $('#append_table').html(" ");
                    }

                    function ajax_find(date) {
                        $.ajax({
                            url: 'ajax_buy_find.php',
                            type: 'post',
                            data: {
                                date: date
                            },
                            success: function(response) {
                                if (response != 1) {
                                    var array_date = JSON.parse(response);
                                    table(array_date);
                                } else if (response == 1) {
                                    $('#append_table').html('<table><th>ไม่พบข้อมูล</th></table>');
                                }
                            }
                        });
                    }

                    function table(array_date) {
                        // console.log(array_date)
                        var append = "";
                        append += "<table class='table table-bordered table-hover' id='mytable' width='100%' border='0'>";
                         append += "<thead class='thead-light'>";
                        append += "<tr>";
                        append += "<th>";
                        append += "ลำดับรายการ";
                        append += "</th>";
                        append += "<th>";
                        append += "วันที่เพิ่มรายการ";
                        append += "</th>";
                        append += "<th>";
                        append += "ผู้เพิ่มรายการ";
                        append += "</th>";
                        append += "<th>";
                        append += "<center>แก้ไข้</center>";
                        append += "</th>";
                        append += "<th>";
                        append += "<center>เรียกดู</center>";
                        append += "</th>";
                        append += "</tr>";
                        for (let i = 0; i < array_date.length; i++) {
                            append += "<tr>";
                             append += "</thead>";
                            append += "<tbody id='tbody'>";
                            append += "<td>";
                            append += array_date[i]['ID'];
                            // append += i+1;
                            append += "</td>";
                            append += "<td>";
                            append += array_date[i]['Date_Add'];
                            append += "</td>";
                            append += "<td>";
                            append += array_date[i]['Librarian'];
                            append += "</td>";
                            append += "<td>";
                            append += "<center><button class='btn btn-link btn_edit' id='" + array_date[i]['ID'] + "' >แก้ไข</button></center>";
                            append += "</td>";
                            append += "<td>";
                            append += "<center><button class='btn btn-primary btn_modal' data-toggle='modal' data-target='#exampleModal' id='" + array_date[i]['ID'] + "'>เรียกดู</button></center>";
                            append += "</td>";
                            append += "</tr>";
                        }
                        append += "</table>";
                        $('#append_table').append(append);
                    }

                    $('#append_table').on('click', '.btn_modal', function() {
                        id = $(this).attr('id');
                        ajax_find_detail(id);
                    });

                    function ajax_find_detail(id) {
                        $.ajax({
                            url: 'ajax_buy_find_detail.php',
                            type: 'post',
                            data: {
                                id: id
                            },
                            success: function(response) {
                                // console.log(response);
                                object_item = JSON.parse(response);
                                // console.log(response);
                                append_modal_data(id);
                            }
                        });
                    }
                   
                    function append_modal_data(id) {
                        // console.log(id);
                        console.log(object_item);

                        $('#exampleModalLabel').html('เลขรายการซื้อ : ' + id);
                        var append = "";
                        append += "<table class='table_res table table-bordered table-hover' id='table_modal'  width='100%' border='0'>";
                        append += "<thead class='thead-light'>";
                        append += "<tr>";
                        append += "<th>";
                        append += "<b>ลำดับรายการ";
                        append += "</th>";
                        append += "<th>";
                        append += "<b>ชื่อทรัพยากร";
                        append += "</th>";
                        append += "<th>";
                        append += "<b>ISBN";
                        append += "</th>";
                        append += "<th>";
                        append += "<b>ราคา";
                        append += "</th>";
                        // append += "<th>";
                        // append += "<b>ชื่อผู้แต่ง";
                        // append += "</th>";
                        // append += "<th>";
                        // append += "<b>พิมพ์ครั้งที่";
                        // append += "</th>";
                        // append += "<th>";
                        // append += "<b>สำนักพิมพ์";
                        // append += "</th>";
                        append += "<th>";
                        append += "<b>จำนวน";
                        append += "</th>";
                           append += "</thead>";
                            append += "<tbody id='tbody'>";
                        append += "</tr>";
                        var run = 1;
                        for (var i in object_item) {
                            for (var j in object_item[i]) {
                                if (object_item[i][j]['Buy_ID'] == id) {
                                    append += "<tr>";
                                    append += "<td  class='findID' >";
                                    // append += object_item[i][j]['Item_ID'];
                                    append += run++;
                                    append += "</td>";
                                    append += "<td>";
                                    append += object_item[i][j]['Title'];
                                    append += "</td>";
                                    append += "<td>";
                                    append += object_item[i][j]['ISBN'];
                                    append += "</td>";
                                    append += "<td>";
                                    append += object_item[i][j]['Price'];
                                    append += "</td>";
                                    // append += "<td>";
                                    // append += object_item[i][j]['Author'];
                                    // append += "</td>";
                                    // append += "<td>";
                                    // append += object_item[i][j]['Edition'];
                                    // append += "</td>";
                                    // append += "<td>";
                                    // append += object_item[i][j]['Publisher'];
                                    // append += "</td>";
                                    append += "<td>";
                                    append += object_item[i][j]['Books'];
                                    append += "</td>";
                                    // if (object_item[i][j]['Type'] == 1) {
                                    //     append += "<td>";
                                    //     append += "</td>";
                                    // }
                                    // if (object_item[i][j]['Type'] == 2) {
                                    //     append += "<td>";
                                    //     append += "<button class='btn btn-link' data-toggle='collapse' data-target='.multi-collapse" + object_item['item'][j]['Item_ID'] + "' aria-expanded='false' aria-controls='multiCollaps" + object_item['item'][j]['Item_ID'] + "'>รายละเอียด</button>";
                                    //     append += "</td>";
                                    //     append += "</tr>";
                                    //     append += "<tr>";
                                    //     append += "<div>";
                                    //     append += "<div class='card card-body'>";
                                    //     for (var a in object_item['item_set']) {
                                    //         if (object_item['item_set'][a]['Item_ID'] == object_item['item'][j]['Item_ID']) {
                                    //             append += "<tr class='collapse multi-collapse" + object_item['item_set'][a]['Item_ID'] + "'>";
                                    //             append += "<td>";
                                    //             append += "</td>";
                                    //             append += "<td>";
                                    //             append += object_item['item_set'][a]['Title'];
                                    //             append += "</td>";
                                    //             append += "<td>";
                                    //             append += object_item['item_set'][a]['Author'];
                                    //             append += "</td>";
                                    //             append += "<td>";
                                    //             append += object_item['item_set'][a]['Edition'];
                                    //             append += "</td>";
                                    //             append += "<td>";
                                    //             append += object_item['item_set'][a]['Publisher'];
                                    //             append += "</td>";
                                    //             append += "<td>";
                                    //             append += object_item['item_set'][a]['Books'];
                                    //             append += "</td>";
                                    //             append += "<td>";
                                    //             append += "</td>";
                                    //             append += "</tr>";
                                    //         }
                                    //     }
                                    //     append += "</div>";
                                    //     append += "</div>";
                                    // }
                                    append += "</tr>";

                                }
                            }
                        }

                        append += "</table>";

                        $('#modal_body').append(append);

                    }

                    $('#exampleModal').on('hidden.bs.modal', function() {
                        $('#modal_body').empty();
                    })

                    $('#append_table').on('click', '.btn_edit', function() {
                        id = $(this).attr('id');
                        console.log(id);
                        window.location.href = "buy_edit.php?id=" + id + "";
                    });
                    
                </script>

                <style>
                    .modal-content {
                        /* 80% of window height */
                        height: 60%;
                        width: 150%;
                        position: relative;
                        overflow-y: auto;

                        background-color: #99FFCC;
                    }
                </style>
                <script language="javascript">
                    // window.onload = function() {
                    //     var a = document.getElementById('mytable'); // อ้างอิงตารางด้วยตัวแปร a
                    //     for (i = 0; i < a.rows.length; i++) { // วน Loop นับจำนวนแถวในตาราง
                    //         if (i > 0) { // ตรวจสอบถ้าไม่ใช่แถวหัวข้อ
                    //             if (i % 2 == 1) { // ตรวจสอบถ้าไม่ใช่แถวรายละเอียด
                    //                 a.rows[i].className = "tr_odd"; // กำหนด class แถวแรก
                    //             } else {
                    //                 a.rows[i].className = "tr_even"; // กำหนด class แถวที่สอง
                    //             }
                    //         } else { // ถ้าเป็นแถวหัวข้อกำหนด class 
                    //             a.rows[i].className = "tr_head";
                    //         }
                    //     }
                    // }
                </script>