  <?php 
    include $_SERVER['DOCUMENT_ROOT']."/lib/layout/head.php"; 
    ?>
  

  <br><br><br>
  <section class="container">
    <div class="row" style="padding-top: 20px;padding-bottom: 350px; background-color: #eee;">
      <section class="container">
        <div class="col-md-12">
          <a href="../librarian.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
          &nbsp;&nbsp;<b style="font-size: 25px;">ค่าปรับ</b>
          <div class="col-md-12">
            <fieldset style="border: 1px solid silver;margin: 0 2px;border-style:outset;border-color:FFFFCC;padding: .625em .625em .75em;margin: 0 320px; background-color:#CCC;">
              <form method="get">
                <div class="col-md-12">
                  <label class="control-label col-sm-2" for="pwd">สมาชิก:</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="text_member" id="text_member" autocomplete="off" placeholder="กรุณาใส่รหัสประจำตัวให้ต้อง">
                  </div>
                  <button type="submit" class="btn btn-primary" name="menu" value="1">ค้นหา</button>
                </div>
              </form>
              <div class="col-md-12">
                <br>
              </div>
              <form method="get">
                <div class="col-md-12">
                  <label class="control-label col-sm-2" for="pwd">ค้นหา:</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" name="text_member_find" id="text_member_find" autocomplete="off">
                  </div>
                  <button type="submit" class="btn btn-primary" name="menu" value="2">ค้นหา</button>
                </div>
              </form>
            </fieldset>
          </div>
          <div class="col-md-12">
            <br>
          </div>
        </div>

        <!-- </section> -->

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
            $path = $_SERVER['DOCUMENT_ROOT'] . "/lib/view/librarian/fine/fine_member.php";
          } elseif ($_GET['menu'] == 2) {
            $path = $_SERVER['DOCUMENT_ROOT'] . "/lib/view/librarian/fine/fine_people.php";
          }
          include($path);
          $path = $_SERVER['DOCUMENT_ROOT'] . "/lib/view/librarian/fine/fine_table.php";
          include($path);
        }

        include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";

        ?>

        <!-- modal1 -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">รายการค่าปรับ</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <table id="friendsoptionstable" class="table table-striped">
                  <thead>
                    <tr>
                      <th width="80%">ทรัพยากร</th>
                      <th width="20%">ค่าปรับ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $total = 0;

                    for ($i = 0; $i < count($data_main); $i++) {
                      for ($j = 0; $j < count($data_book); $j++) {
                        if ($data_main[$i]['Book'] == $data_book[$j]['Barcode']) {
                          for ($k = 0; $k < count($data_book); $k++) {
                            if ($data_main[$i]['ID'] == $data_fine[$k]['Borrow_ID']) {
                              ?><tr><?php
                                              if ($data_book[$j]['Barcode'] == $data_main[$i]['Book'] && $data_main[$i]['Due_Status'] == 0) {
                                                $data_book_already_cut = calsub_arr($data_book[$j]['Subfield'], 245);
                                                ?><td><?php echo $data_book_already_cut['Title']['#a']; ?></td><?php
                                                                                                                          }
                                                                                                                          if ($data_fine[$k]['Borrow_ID'] == $data_main[$i]['ID'] && $data_main[$i]['Due_Status'] == 0) {
                                                                                                                            if ($data_fine[$k]['Type'] == 1) {
                                                                                                                              ?><td class="amount"><?php echo $data_fine[$k]['Amount']; ?></td><?php
                                                                                                                                                                                                            $total = $total + $data_fine[$k]['Amount'];
                                                                                                                                                                                                          } elseif ($data_fine[$k]['Type'] == 2) {
                                                                                                                                                                                                            $sql = "SELECT * FROM databib WHERE Barcode = " . $data_book[$j]['Barcode'] . " ";
                                                                                                                                                                                                            $res = $conn->query($sql);
                                                                                                                                                                                                            $data_temp = calsub_arr($res, [365]);
                                                                                                                                                                                                            ?><td class="amount"><?php echo number_format($data_temp[$data_book[$j]['Barcode']]['Price']['#b'], 2); ?></td><?php
                                                                                                                                                                                                                                                                                                                                          $total = $total + $data_temp[$data_book[$j]['Barcode']]['Price']['#b'];
                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                      }
                                                                                                                                                                                                                                                                                                                                      ?></tr><?php
                                                                                                                                                                                                                                                                                                                                                      }
                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                  }
                                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                              }
                                                                                                                                                                                                                                                                                                                                              ?>
                    </tr>
                    <tr>
                      <td>รวม</td>
                      <td><?php echo number_format($total, 2, '.', ''); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary saveEdit">ชำระเงิน</button>
              </div>
            </div>
          </div>
        </div>


        <script>
          $('#myModal').click(function() {
            var myModal = $('#exampleModal');
            myModal.modal();
          })

          var str = "";

          $('.saveEdit').click(function() {
            ajax_payment();
            $('#myModal').modal('toggle');
            location.reload();
          })

          $(document).ready(function() {
            str = [];
            $('.namebook').each(function() {
              str.push($(this).parent().find('.namebook').val());
            })
          });

          function ajax_payment() {
            $.ajax({
              url: 'fine_ajax_payment.php',
              type: 'post',
              data: {
                book: str
              },
              success: function(response) {
                console.log(response)
              }
            });
          }

          function check_table_fine() {
            if ($('.table_fine tbody tr').length == 1) {
              $('.table_fine').hide();
              $('.append_found').append('ไม่มีข้อมูลค่าปรับ');
            }
          }
        </script>