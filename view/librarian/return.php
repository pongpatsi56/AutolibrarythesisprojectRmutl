<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
?>

<br><br><br>
<section class="container">
  <div class="row" style="padding-top: 20px;padding-bottom: 250px; background-color: #eee;">
    <div class="col-md-12">
      <a href="../librarian/librarian.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
      &nbsp;&nbsp;<b style="font-size: 25px;">คืน</b><br>
      <div class="col-md-12">
        <form method="get">
          <div class="col-md-12">

            <fieldset style="border: 1px solid silver;margin: 0 1px;border-style:outset;border-color:FFFFCC;padding: .625em .625em .75em;margin: 0 290px; background-color:#ccc;">
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
      if (isset($_GET['menu']) == 0) {
      ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

      <?php
      }
      ?>
      <br>
      <br>
      <br>

      <?php
      @session_start();

      include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
      include $_SERVER['DOCUMENT_ROOT'] . "/lib/controller/librarian/cal_date.php";
      include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/datehelper.php";
      include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";


      if (isset($_GET['menu'])) {
        if ($_GET['menu'] == 1) {
          $path = $_SERVER['DOCUMENT_ROOT'] . "/lib/view/librarian/return_book.php";
          include($path);
          $path = $_SERVER['DOCUMENT_ROOT'] . "/lib/view/librarian/return_find.php";
          include($path);
        } elseif ($_GET['menu'] == 2) {
          $path = $_SERVER['DOCUMENT_ROOT'] . "/lib/view/librarian/return_people.php";
          include($path);
        }
      }

      if (isset($_GET['menu']) != NULL && $_GET['menu'] == 1) {
      ?>

        <div align='left'>
          <fieldset style="border: 1px solid silver;margin: 0 1px;border-style:outset;border-color:FFFFCC;padding: .625em .625em .75em;margin: 0 325px; background-color:#ccc;">

            <center><label for="">หนังสือ </label></center>
            <input type="text" class="form-control book">

        </div>
        </fieldset>
        <br><br>
      <?php
      }
      if (isset($_GET['text_member']) != NULL && $_GET['text_member'] != "") {
      ?>
        <input type="hidden" id="member" value="<?php echo $_GET['text_member']; ?>">

        <br>
        <br>

        <fieldset style="border: 1px solid silver;border: 1px outset rgb(33, 2, 2);margin: 0 1px;border-style:outset;border-color:FFFFCC;padding: 3.625em .625em .75em; background-color:rgb(204, 204, 204);" class="field_set">
          <table style="border:3;border-color:ccc;background-color:#eee;" class='table_res table table-bordered table-hover' id='mytable' width='100%' border='0'>
            <thead>
            </thead>
            <tbody>
            </tbody>
          </table>
          <center><button id='but_save' class="btn btn-success">บันทึก</button></center>
        </fieldset>
        <br>
        <center> <button class="btn btn-primary" id="but_fine">ตรวจสอบค่าปรับ</button>
          <center>
          <?php
        }
          ?>

          <script>
            $(document).ready(function() {
              $('#confirm_ret').prop('disabled', true);
              $('#confirm_ret').ready(function() {
                if ($('#check').val() != '') {
                  $('#confirm_ret').prop('disabled', false);
                }
              });
            });

            $(document).ready(function() {
              $('.field_set').hide();
            });

            function check_table_res() {
              if ($('.field_set tbody tr').length == 1) {
                $('.field_set').hide();
              }
            }

            var count_book = 0;
            var vals = [];
            var member = "";

            $('.unturn').click(function() {
              var un_same = $(this).parent().find('.text-success').html();
              if (un_same != 'คืนแล้ว') {
                member = $('#member').val();
                var namebook = $(this).parent().find('.namebook').val()
                $('.book').val(namebook);
              }
            })

            $('.field_set').on('click', '#but_save', function() {
              book_ajax_save(vals, member);
            })

            var lastValue = '';

            setInterval(function() {
              if ($(".book").val() != lastValue) {
                lastValue = $(".book").val();
                book_ajax(lastValue);
              }
              if ($(".book").val().length == 3) {
                $(".book").val()=="";
              }
            }, 500);

            function book_ajax_save(vals, member) {
              $.ajax({
                url: 'ajax_return_save.php',
                type: 'post',
                data: {
                  book: vals,
                  member: member,
                },
                success: function(response) {
                //   console.log(response);
                   location.reload();
                //   ajax_fine_check(member);
                }
              });
            }

            // function ajax_fine_check(member) {
            // $.ajax({
            //     url: 'ajax_fine_check.php',
            //     type: 'post',
            //     data: {member: member},
            //     success: function (response) {
            //       location.reload();
            //     }
            // });
            // }

            his_book = [];

            function book_ajax(valBook) {
              $.ajax({
                url: 'ajax_return.php?',
                type: 'post',
                data: {
                  book: valBook,
                  member: member,
                },
                success: function(response) {
                    console.log(response)
                  if (response != "") {
                    if (jQuery.inArray(response, his_book) == -1) {
                      append_book(valBook, response);
                      his_book.push(response);
                    }
                    $('.field_set').show();
                  }
                }
              });
            }

            var count_table = 0;

            function append_book(valBook, nameBook) {
              vals.push(valBook);
              if (count_table == 0 && count_book != null && nameBook != null) {
                var stack = "";
                stack += "<tr>";
                stack += "<th width = '20%'>";
                stack += "<b>Barcode";
                stack += "</th>";
                stack += "<th width = '50%'>";
                stack += "<b>ชื่อหนังสือ";
                stack += "</th>";
                stack += "<th width = '10%'>";
                stack += "";
                stack += "</th>";
                stack += "</tr>";
                $('.table_res thead').append(stack);

                stack = "<tr>";
                stack += "<input type='hidden' name='namebook' value='" + nameBook + "'>";
                stack += "<input type='hidden' name='vals' value='" + valBook + "'>";
                stack += "<td>";
                stack += valBook;
                stack += "</td>";
                stack += "<td>";
                stack += nameBook;
                stack += "</td>";
                stack += "<td>";
                stack += "<center><a class='btn btn-danger del_book'>ลบ</a></center>";
                stack += "</td>";
                stack += "</tr>";
                stack += "";

                $('.table_res tbody').append(stack);

                count_book++;
              } else if (count_table != 0) {
                var stack = "";
                stack += "<tr>";
                stack += "<input type='hidden' name='namebook' value='" + nameBook + "'>";
                stack += "<input type='hidden' name='vals' value='" + valBook + "'>";
                stack += "<td>";
                stack += valBook;
                stack += "</td>";
                stack += "<td>";
                stack += nameBook;
                stack += "</td>";
                stack += "<td>";
                stack += '<center><a class="btn btn-danger del_book">ลบ</a></center>';
                stack += "</td>";
                stack += "</tr>";
                $('.table_res tbody').append(stack);
                count_book++;
              }
              count_table++;
            }

            $('.table_res').on('click', '.del_book', function() {
              check_table_res();
              var select = $(this);
              var select_par = $(this).parent().parent().parent();
              var select_input_name = $(this).parent().parent().parent().find('input[name=namebook]');
              var select_input_val = $(this).parent().parent().parent().find('input[name=vals]');
              var item_name = select_input_name.val();
              var item_val = select_input_val.val();

              his_book = jQuery.grep(his_book, function(value) {
                return value != item_name;
              });

              vals = jQuery.grep(vals, function(value) {
                return value != item_val;
              });

              select_par.remove();
            });


            $('#but_fine').click(function() {
              url = "/lib/view/librarian/fine/fine.php?text_member=" + $('#member').val() + "&menu=1";
              window.location.href = url;
            })

            $('.unturn').hover(function() {
              $('.unturn').css('cursor', 'pointer');
              $(this).css('text-decoration', 'underline');
            }, function() {
              $(this).css('text-decoration', 'none');
            });
          </script>

          <style>
            .unturn {
              color: blue;
            }
          </style>