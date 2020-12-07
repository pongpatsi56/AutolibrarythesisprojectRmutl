<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
?>
<link rel="stylesheet" href="http://localhost:8080/lib/assets/js/dist/css/bootstrap/zebra_datepicker.min.css" type="text/css">
<script src="http://localhost:8080/lib/assets/js//dist/zebra_datepicker.min.js"></script>
<br>
<br>
<br>
<section class="container">
  <div class="row" style="padding-top: 20px;padding-bottom: 10px; background-color: #eee;">
    <div class="col-md-6">
      <a href="/lib/view/librarian/librarian.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
      &nbsp;&nbsp;<b style="font-size: 25px;">เพิ่มข่าวสารประชาสัมพันธ์</b>
    </div>
    <div class="col-md-6"><button type="submit" onclick="window.location.href='shownewall.php'" class="pull-right btn btn-primary">เรียกดู</button>
    </div>
    <br>
    <br>
    <br>

    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <form action="newconnext.php" method="post" enctype="multipart/form-data">


            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">หัวข้อ</label>
                <textarea type="text" name="text_Title" id="text_Title" class="form-control" autocomplete="off"></textarea>
              </div>
            </div>
            <br>
            <div class="col-md-12">
            </div>
            <div class="col-md-12">
              <div class="form-group" id="textauthor">
                <label class="bmd-label-floating">รายละเอียด</label>
                <textarea type="text" name="text_Story" cols="40" rows="4" id="text_Story" class="form-control" autocomplete="off"></textarea>

              </div>
            </div>
            <div class="col-md-12">
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating">วันที่</label>
                <input type="date" class="form-control" name="start_date1" id="start_date1">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>รูปภาพ</label>
                <input class="form-control" type="file" name="img">
              </div>
            </div>

            <br>
            <br>
            <br>
            </span>
            <div class="col-md-12">
              <center>

                <br>
                <br>
                <div class="form-group">
                  <button type="submit" class="btn btn-success" onclick="if (!confirm('บันทึกในฐานข้อมูล?')) { return false }">บันทึก</button>
                </div>
            </div>
          </form>
          <?php
          include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";
          ?>

          <footer>
            <div class="row">

            </div>
            <div class="row">
              <br>
              <br>
              <br>
              <br>

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
            <div class="credit" style="text-align:center; color: #eee; margin-top: 15px;margin-bottom: 15px;">
              <p style="color: #666; font-family: 'kanit';">ออกแบบและพัฒนาโดย <a href="https://arit.rmutl.ac.th/" target="_blank">สำนักวิทยบริการและเทคโนโลยีสารสนเทศ</a> <a href="https://www.rmutl.ac.th/" target="_blank">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</a></p>
            </div>
          </div>
</section>
<input type="hidden" id="service_base_url" value="https://library.rmutl.ac.th/">
<script src="https://library.rmutl.ac.th/assets/js/jquery.dcjqaccordion.min.js" type="text/javascript"></script>
<script src="https://library.rmutl.ac.th/assets/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="https://library.rmutl.ac.th/assets/js/home.min.js" type="text/javascript"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-87588904-9"></script>
<script src="/lib/script/search.js"></script>
<script>
  $('#start_date1').Zebra_DatePicker({
    format: 'Y-m-d',
    todayBtn: "linked"
  });
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments)
  };
  gtag('js', new Date());

  gtag('config', 'UA-87588904-9');
</script>
<input type="hidden" id="service_base_url" value="https://library.rmutl.ac.th/">
<script src="https://library.rmutl.ac.th/assets/js/jquery.dcjqaccordion.min.js" type="text/javascript"></script>
<script src="https://library.rmutl.ac.th/assets/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="https://library.rmutl.ac.th/assets/js/home.min.js" type="text/javascript"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-87588904-9"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments)
  };
  gtag('js', new Date());

  gtag('config', 'UA-87588904-9');
</script>