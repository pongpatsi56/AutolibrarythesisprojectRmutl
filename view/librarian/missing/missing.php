<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
?>

<br><br><br>
<section class="container">
  <div class="row" style="padding-top: 20px;padding-bottom: 500px; background-color: #eee;">
    <div class="col-md-12">
      <a href="../librarian.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
      &nbsp;&nbsp;<b style="font-size: 25px;">แจ้งหาย</b>
      <div class="col-md-12">
        <form method="get">
          <div class="col-md-12">

            <fieldset style="border: 1px solid silver;margin: 0 2px;border-style:outset;border-color:FFFFCC;padding: .625em .625em .75em;margin: 0 290px; background-color:#CCC;">
              <div class="col-md-12">


                <div class="col-md-1">
                </div>
                <label class="control-label col-sm-2" for="pwd">สมาชิก:</label>

                <div class="col-md-6">
                  <input type="text" class="form-control" name="text_member" id="text_member" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary" name="menu" value="1">ค้นหา</button>
              </div>
        </form>
        <div class="col-md-12">
          <br>
        </div>
        <form method="get">
          <div class="col-md-12">
            <div class="col-md-1">
            </div>
            <label class="control-label col-sm-2" for="pwd">ค้นหา:</label>

            <div class="col-md-6">
              <input type="text" class="form-control" name="text_member_find" id="text_member_find" autocomplete="off">
            </div>

            <button type="submit" class="btn btn-primary" name="menu" value="2">ค้นหา</button>
          </div>
      </div>
      </form>
      </fieldset>
      <div class="col-md-12">
        <br>
      </div>
      <?php

      include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
      include $_SERVER['DOCUMENT_ROOT'] . "/lib/controller/librarian/cal_date.php";
      include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/datehelper.php";
      include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";

      if (isset($_GET['text_member'])) {
        $member = $_GET['text_member'];
      }

      if (isset($_GET['menu'])) {
        if ($_GET['menu'] == 1) {
          $path = $_SERVER['DOCUMENT_ROOT'] . "/lib/view/librarian/missing/missing_member.php";
        } elseif ($_GET['menu'] == 2) {
          $path = $_SERVER['DOCUMENT_ROOT'] . "/lib/view/librarian/missing/missing_people.php";
        }
        include($path);
        $path = $_SERVER['DOCUMENT_ROOT'] . "/lib/view/librarian/missing/missing_table.php";
        include($path);
        ?>
        <center>
        <?php

        }
        include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";

        ?>


        <script>
          function ajax_update(book_id, borrow_id, stat) {
            $.ajax({
              url: 'missing_ajax_update.php',
              type: 'post',
              data: {
                book_id: book_id,
                borrow_id: borrow_id,
                stat: stat
              },
              success: function(response) {
                location.reload();
              }
            });
          }

          $(document).ready(function() {
            $('.changeStat').attr("disabled", true);
          });

          var check_edit = [];

          $('.edit_staus').on('click', function() {
            var select = $(this).parent().parent().find('.changeStat');
            var select_class = $(this).attr('class');

            $(this).toggleClass("wait");

            if (select_class.includes('wait') == true) {
              $(select).attr("disabled", true);
              $(this).html('แก้ไข');
              book_id = $(this).parent().parent().find('.namebook').val();
              borrow_id = $(this).parent().parent().find('.Borrow_ID').val();
              stat = select.val();
              ajax_update(book_id, borrow_id, stat);
            } else {
              $(select).attr("disabled", false);
              $(this).html('บันทึก');
            }


          });
        </script>