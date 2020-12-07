<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
?>
<br><br><br>
<section class="container">
    <div class="row" style="padding-top: 20px;padding-bottom: 400px; background-color: #eee;">
        <div class="col-md-12">
            <a href="../librarian.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a><br><br><br>
            <div class="col-md-4">
                <br>
                <br>
                <br>
                <a onClick="menu(0)"><img src='/lib/iconimg/clipboard (2).png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onClick="menu(0)"><b style=" font-family:kanit;">เพิ่มใหม่</b></a>

            </div>
            <div class="col-md-4">
                <br>
                <br>
                <br>

                <a onClick="menu(1)"><img src='/lib/iconimg/faq.png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onClick="menu(1)"><b style=" font-family:kanit;">แก้ไข</b></a>
            </div>
            <div class="col-md-4">
                <br>
                <br>
                <br>

                <a onClick="menu(2)"><img src='/lib/iconimg/qr.png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onClick="menu(2)"><b style=" font-family:kanit;">+</b></a>

            </div>

        </div>
    </div>
    </div>


    <script>
        function menu(val) {
            if (val == 0) {
                window.location.href = '/lib/view/librarian/buy/buy_new.php';
            } else if (val == 1) {
                window.location.href = '/lib/view/librarian/buy/buy_edit.php';
            }
        }
    </script>