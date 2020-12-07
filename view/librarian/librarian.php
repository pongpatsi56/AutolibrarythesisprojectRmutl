<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
$FName1 = $_SESSION['user_status']['FName'];
$sql = "SELECT * FROM member WHERE FName='$FName1'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>

<section class="container main-container">
    <div class="row" style="padding-top: 20px;padding-bottom: 150px; ">
   
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-3">
                    <br>
                    <br>
                   
                    <center><img src="/lib/img/no-pic.jpg" width="150px" height="170px" style=";border-style:outset;border-width:2px;">
                        <br>
                        <button class="btn btn-link" style=" font-family:kanit;"><?php echo $_SESSION['user_status']['FName'] . ' ' . $_SESSION['user_status']['LName']; ?></button>
                        
                </div>
                <div class="col-md-4">
                    <br>
                    <br>
                  
                    <a href="all_in/all_in.php"><img src='/lib/iconimg/file-b.png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="all_in/all_in.php"><b style=" font-family:kanit;">ทำรายการยืม-คืน</b></a>

                </div>
                
                <div class="col-md-4">
                    <br>
                    <br>
                   

                    <a href="reserve.php"><img src='/lib/iconimg/test (2).png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="reserve.php"><b style=" font-family:kanit;">การจองทรัพยากร</b></a>

                </div>

                <div class="col-md-4">
                    <br>
                    <br>
                   

                    <a href="buy/buy.php"><img src='/lib/iconimg/clipboard (2).png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="buy/buy.php"><b style=" font-family:kanit;">ทำรายการซื้อทรัพยากร</b></a>

                </div>
                <!--<div class="col-md-3"></div>-->

                <!--<div class="col-md-3"></div>-->
                <div class="col-md-4">
                    <br>
                    <br>
                  
                    <a href="add.php"><img src='/lib/iconimg/test (3).png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="add.php"><b style=" font-family:kanit;">ทำรายการเพิ่มทรัพยากร</b></a>

                </div>
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <br>
                    <br>
                   
                    <a href="/lib/view/report/reporting.php"><img src='/lib/iconimg/report (1).png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/lib/view/report/reporting.php"><b style=" font-family:kanit;">ออกรายงาน</b></a>

                </div>
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <br>
                    <br>
                   
                    <a href="/lib/new/newadd.php"><img src='/lib/iconimg/newspaper.png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/lib/new/newadd.php"><b style=" font-family:kanit;">ข่าวประชาสัมพันธ์</b></a></a>
                    

                </div>
                <?php 
                //if (isset($_SESSION['user_status']) && $_SESSION['user_status']['Status'] == 0) {
                    // print_r($_SESSION['user_status']);
                    ?>
                    <div class="col-md-3"></div>
                <div class="col-md-4">
                    <br>
                    <br>
                 
                    <a href="../usermanagement/manageuser.php"><img src='/lib/iconimg/teamwork.png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="../usermanagement/manageuser.php"><b style=" font-family:kanit;">สมาชิก</b></a>

                </div>
                <?php 
                //}
                ?>
                       <div class="col-md-3"></div>
                <div class="col-md-4">
                    <br>
                    <br>
                   
                    <a href="/lib/view/historylog/showlog.php"><img src='/lib/iconimg/faq.png' width='90' height='90'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/lib/view/historylog/showlog.php"><b style=" font-family:kanit;">ประวัติการแก้ไข</b></a></a>
                </div>
               
            </div>
        </div>
    </div>
    <footer>
    <div class="row" >
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
        <div class="col-md-8 col-sm-12" >
            <div class="list-text-footer row" >
        
            <div class="address-text-fooster col-md-12" >
                ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา : 128 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่ 50300<br>
                โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183            </div>
   
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
	<script src="https://library.rmutl.ac.th/assets/js/jquery.dcjqaccordion.min.js" type="text/javascript" ></script>
		<script src="https://library.rmutl.ac.th/assets/js/owl.carousel.min.js" type="text/javascript" ></script>
		<script src="https://library.rmutl.ac.th/assets/js/home.min.js" type="text/javascript" ></script>
		
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-87588904-9"></script>
<script src="/lib/script/search.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-87588904-9');
</script>

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