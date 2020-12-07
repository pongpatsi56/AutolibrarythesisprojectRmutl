<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
?>
<br>
<br>
<br>
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                วันที่ซื้อ <input type="date" name="date" id="date"> 
                <button onClick="find()" type="button" class=" btn btn-primary">ค้นหา</button>
            </div>
        </div>
    </div>

    <div id="append_table">
    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_body">
                
            </div>
            <div class="modal-footer">
                
            </div>
            </div>
        </div>
    </div>
    

    

<script>
    var check_find = 0;
    var object_item = {};

    function find(){
        check_find = 1;
        if (check_find==1) {
            remove_table();
        }
        var date = $(document).find('#date').val();
        ajax_find(date);
    }

    function remove_table(){
        $('table').remove();
    }

    function ajax_find(date) {
        $.ajax({
            url: 'ajax_buy_find.php',
            type: 'post',
            data: { 
            date : date 
        },
            success: function (response) {
                if (response!=1) {
                    var array_date = JSON.parse(response);
                    table(array_date);
                }
                else if(response==1){
                    $('#append_table').append('<table><th>ไม่พบข้อมูล</th></table>');
                }
            }
        });
    }

    function table(array_date){
        var append = "";
        append += "<table class='table'>";
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
            append += "</tr>";
        for (let i = 0; i < array_date.length; i++) {
            append += "<tr>";
                append += "<td>";
                    append += array_date[i]['ID'];
                append += "</td>";
                append += "<td>";
                    append += array_date[i]['Date_Add'];
                append += "</td>";
                append += "<td>";
                    append += array_date[i]['Librarian'];
                append += "</td>";
                append += "<td>";
                    append += "<button class='btn btn-primary btn_edit' id='"+array_date[i]['ID']+"' >แก้ไข</button>";
                append += "</td>";
                append += "<td>";
                    append += "<button class='btn btn-primary btn_modal' data-toggle='modal' data-target='#exampleModal' id='"+array_date[i]['ID']+"'>เรียกดู</button>";
                append += "</td>";
            append += "</tr>";
        }
        append += "</table>";
        $('#append_table').append(append);
    }

    $('#append_table').on('click','.btn_modal', function(){
        id = $(this).attr('id');
        ajax_find_detail(id);
    });

    function ajax_find_detail(id) {
        $.ajax({
            url: 'ajax_buy_find_detail.php',
            type: 'post',
            data: {
            id : id 
        },
            success: function (response) {
                object_item = JSON.parse(response);
                append_modal_data(id);
            }
        });
    }

    function append_modal_data(id) {
        console.log(id);
        console.log(object_item);

        $('#exampleModalLabel').html('เลขรายการซื้อ : '+id);
        var append = "";
        append += "<table class='table' id='table_modal'>";
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
            append += "</tr>";
            for (var i in object_item){
                for (var j in object_item[i]){
                    if (object_item[i][j]['Buy_ID']==id) {
                        append += "<tr>";
                            append += "<td>";
                                append += object_item[i][j]['Item_ID'];
                            append += "</td>";
                            append += "<td>";
                                append += object_item[i][j]['Title'];
                            append += "</td>";
                            append += "<td>";
                                append += object_item[i][j]['Author'];
                            append += "</td>";
                            append += "<td>";
                                append += object_item[i][j]['Edition'];
                            append += "</td>";
                            append += "<td>";
                                append += object_item[i][j]['Publisher'];
                            append += "</td>";
                            append += "<td>";
                                append += object_item[i][j]['Books'];
                            append += "</td>";  
                        if (object_item[i][j]['Type']==2) {
                                append += "<td>";
                                    append += "<a data-toggle='collapse' data-target='.multi-collapse"+object_item['item'][j]['Item_ID']+"' aria-expanded='false' aria-controls='multiCollaps"+object_item['item'][j]['Item_ID']+"'>Detail</a>";
                                append += "</td>";
                            append += "</tr>";
                            append += "<tr>";
                                append += "<td>";
                                            append += "<div '>";
                                                append += "<div class='card card-body'>";
                                                    // append += "<table>";
                                                        // append += "<tr class='collapse multi-collapse' id='multiCollapseExample1'>";
                                                        //     append += "<th>";
                                                        //         append += "ลำดับรายการ";
                                                        //     append += "</th>";
                                                        //     append += "<th>";
                                                        //         append += "ชื่อทรัพยากร";
                                                        //     append += "</th>";
                                                        //     append += "<th>";
                                                        //         append += "ชื่อผู้แต่ง";
                                                        //     append += "</th>";
                                                        //     append += "<th>";
                                                        //         append += "พิมพ์ครั้งที่";
                                                        //     append += "</th>";
                                                        //     append += "<th>";
                                                        //         append += "สำนักพิมพ์";
                                                        //     append += "</th>";
                                                        //     append += "<th>";
                                                        //         append += "จำนวน";
                                                        //     append += "</th>";
                                                        // append += "</tr>";
                                                        for (var a in object_item['item_set']) {
                                                            if (object_item['item_set'][a]['Item_ID']==object_item['item'][j]['Item_ID']) {
                                                                append += "<tr class='collapse multi-collapse"+object_item['item_set'][a]['Item_ID']+"'>";
                                                                    append += "<td>";
                                                                        // append += object_item['item_set'][a]['Item_ID_Set'];
                                                                    append += "</td>";
                                                                    append += "<td>";
                                                                        append += object_item['item_set'][a]['Title'];
                                                                    append += "</td>";
                                                                    append += "<td>";
                                                                        append += object_item['item_set'][a]['Author'];
                                                                    append += "</td>";
                                                                    append += "<td>";
                                                                        append += object_item['item_set'][a]['Edition'];
                                                                    append += "</td>";
                                                                    append += "<td>";
                                                                        append += object_item['item_set'][a]['Publisher'];
                                                                    append += "</td>";
                                                                    append += "<td>";
                                                                        append += object_item['item_set'][a]['Books'];
                                                                    append += "</td>";
                                                                append += "</tr>";
                                                            }
                                                        }
                                                append += "</div>";
                                            append += "</div>";
                                append += "<td>";
                        }
                        append += "</tr>";

                    }
                }
            }

        append += "</table>";

        $('#modal_body').append(append);

    }

    $('#exampleModal').on('hidden.bs.modal', function () {
        $('#table_modal').remove();
    })

    $('#append_table').on('click','.btn_edit', function(){
        id = $(this).attr('id');
        console.log(id);
        window.location.href = "buy_edit.php?id="+id+"";
    });



</script>

<style>

.modal-content {
    /* 80% of window height */
    height: 70%;
    position: relative;
    overflow-y: auto;

    background-color:#99FFCC;
}       

</style>
 