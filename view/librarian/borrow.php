<?php session_start();?>
<br><br><br>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
?>
<section class="container">
  <div class="row" style="padding-top: 20px;padding-bottom: 200px; background-color: #eee;">
    <div class="col-md-12">

      <a href="../librarian/librarian.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
      &nbsp;&nbsp;<b style="font-size: 25px;">ยืม</b>
      <br>

      <div class="col-md-12">
        <form method="get">
          <div class="col-md-12">

            <fieldset style="border: 1px solid silver;margin: 0 2px;border-style:outset;border-color:FFFFCC;padding: .625em .625em .75em;margin: 0 290px; background-color:#CCC;">
              <div class="col-md-12">


                <div class="col-md-1">
                </div>
                <label class="control-label col-sm-2" for="pwd">สมาชิก:</label>

                <div class="col-md-6">
                  <input type="text" class="form-control" name="text_member" id="text_member" autocomplete="off" placeholder="กรุณาระบุรหัสสมาชิกให้ถูกต้องและครบถ้วน">
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
              <input type="text" class="form-control" name="text_member_find" id="text_member_find" autocomplete="off" placeholder="กรุณาระบุคำที่ต้องการค้นหา">
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
        <br>
      <?php
      }
      ?>
      <br>
      <br>
      <br>
      <br>

      <?php
      @session_start();

      $path = $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
      include($path);
      if (isset($_GET['menu'])) {
        if ($_GET['menu'] == 2) {
          $path = $_SERVER['DOCUMENT_ROOT'] . "/lib/controller/librarian/findmember.php";
        } elseif ($_GET['menu'] == 1) {
          $path = $_SERVER['DOCUMENT_ROOT'] . "/lib/view/librarian/findID.php";
        }
      }
      include($path);
      include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";
      ?>

      <script>
        $(document).ready(function() {
          $('#confirm').prop('disabled', true);
          $('#confirm').ready(function() {
            if ($('#check').val() != '') {
              $('#confirm').prop('disabled', false);
            }
          });
        });

        $(document).ready(function() {
          $('#btn_book').prop('disabled', true);
          $('#btn_book').ready(function() {
            if ($('#FName').val() != '') {
              $('#btn_book').prop('disabled', false);
            }
          });
        });

        $(document).ready(function() {
          $('#text_book').prop('disabled', true);
          $('#text_book').ready(function() {
            if ($('#FName').val() != '') {
              $('#text_book').prop('disabled', false);
            }
          });
        });
      </script>


    </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  <footer>
    <div class="row">
      <span class="footer-divider"></span>
    </div>
    <div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #eee;">
      <div class="col-md-4 col-sm-12" id="vertical-line">
        <div class="col-md-12">
          <img src="https://webs.rmutl.ac.th/assets/upload/logo/web_footer_20170911140318.png" class="rmutl-web-logo-footer img-responsive">
        </div>
        <div class="col-md-12 footer-about-text text-center">
          ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา<br>
          <span class="footer-span-comment">"มทร.ล้านนา"</span>
        </div>

      </div>
      <div class="col-md-8 col-sm-12">
        <div class="list-text-footer row">

          <div class="address-text-fooster col-md-12">
            ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา : 128 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่ 50300<br>
            โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183 </div>

        </div>
      </div>
    </div>
  </footer>
  <div class="row" style=" background-color: #eee;">
    <div class="credit" style="text-align:center; color: #eee;margin-top: 15px;margin-bottom: 15px;">
      <p style="color: #666; font-family: 'kanit';">ออกแบบและพัฒนาโดย <a href="https://arit.rmutl.ac.th/" target="_blank">สำนักวิทยบริการและเทคโนโลยีสารสนเทศ</a> <a href="https://www.rmutl.ac.th/" target="_blank">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</a></p>
    </div>
</section>
<input type="hidden" id="service_base_url" value="https://library.rmutl.ac.th/">
<script src="https://library.rmutl.ac.th/assets/js/jquery.dcjqaccordion.min.js" type="text/javascript"></script>
<script src="https://library.rmutl.ac.th/assets/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="https://library.rmutl.ac.th/assets/js/home.min.js" type="text/javascript"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-87588904-9"></script>
<script src="/lib/script/search.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments)
  };
  gtag('js', new Date());

  gtag('config', 'UA-87588904-9');
</script>