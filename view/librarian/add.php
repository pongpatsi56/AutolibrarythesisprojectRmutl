<?php
session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
?>

<br>
<br>
<br>
<section class="container">
    <div class="row" style="padding-top: 20px;padding-bottom: 400px; background-color: #eee;">

        <div class="col-md-12">
            <a href="../librarian/librarian.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
            &nbsp;&nbsp;<b style="font-size: 25px;">เพิ่มทรัพยากรลงในฐานข้อมูล</b><br><br><br>
            <div class="col-md-4">
                <br>
                <br>
                <br>
                <a onclick="open_CreTemp()"><img src='/lib/iconimg/file1.png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="open_CreTemp()"><b style=" font-family:kanit;">เทมเพลต</b></a>

            </div>
            <div class="col-md-4">
                <br>
                <br>
                <br>

                <a onclick="open_Add()"><img src='/lib/iconimg/template.png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="open_Add()"><b style=" font-family:kanit;">จัดการข้อมูลสารสนเทศ</b></a>
            </div>
            <div class="col-md-4">
                <br>
                <br>
                <br>

                <a onclick="open_CreCode()"><img src='/lib/iconimg/technical-support.png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="open_CreCode()"><b style=" font-family:kanit;">ตั้งค่าเขตข้อมูล</b></a>



            </div>
            <div class="col-md-4">
                <br>
                <br>
                <br>
                <a onclick="open_Edit()"><img src='/lib/iconimg/faq.png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="open_Edit()"><b style=" font-family:kanit;">แก้ไขบรรณานุกรม</b></a>

            </div>
        </div>
    </div>
    </div>

    <script src="/lib/script/template.js"></script>
    <div class="col-md-12">
        <br>
        <br>
    </div>

    <footer>

        <div class="row" style=" background-color: #eee;">
            <span class="footer-divider"></span>
        </div>
        <div class="row" style=" background-color: #eee;">
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

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";
?>