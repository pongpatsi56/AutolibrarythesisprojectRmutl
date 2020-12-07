<?php require_once "layout/head.php";?>
<link href="css/site.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" type="text/css" rel="stylesheet">

<body>
    <section class="container main-container">
        <div class="row" style="padding-bottom: 10px; background-color: #FFFFFF;">
            <!-- <div class="row">
            <img src="https://webs.rmutl.ac.th/assets/upload/logo/website_logo_th_20170905132018.jpg" alt="โลโก้เว็บไซต์ ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" class="img-responsive" />
        </div> -->
            <!-- main menu -->

            <div id="warpper">
                <div class="subnavigate" >
                    <div class="ct">
                        <!-- navigative -->
                        <div class="left navi">
                            <h1 >สืบค้น</h1>
                        </div>
                        <!-- search box -->
                        <div class="right">
                        </div>
                    </div>
                </div>
            </div>

            <div id="sidebar">
                <div class="section">
                    <div class="section-title">เครื่องมือในการค้นหา</div>
                    <div class="section-content" style=" padding-top:5px;">
                        <p><a href="#" onclick="gosearch('basic')" class="default-a">การสืบค้นขั้นพื้นฐาน</a></p>
                        <p><a href="#" onclick="gosearch('advance')" class="default-a">การสืบค้นขั้นสูง</a></p>
                        <!-- <p><a href="#" onclick="gosearch('alphabeticsearch')" class="default-a">การสืบค้นตามลำดับตัวอักษร</a></p> -->
                    </div>
                </div>
            </div>
            <form>
                <div id="content">

                    <body onload="gosearch('basic');">
                </div>
            </div>
         
            </div>  

    <div class="row" >
    <span class="footer-divider"></span>
    </div> 
    <div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #eee;">
            <footer>
                            <div class="col-md-14">
                               
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-12" id="vertical-line">
                                    <div class="col-md-12">
                                        <img src="https://webs.rmutl.ac.th/assets/upload/logo/web_footer_20170911140318.png" class="rmutl-web-logo-footer img-responsive">
                                    </div>
                                    <div class="col-md-12 footer-about-text text-center">
                                        ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา<br>
                                        <span class="footer-span-comment">"มทร.ล้านนา"</span>
                                    </div>
                                    <div class="col-md-12 text-center">

                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-12">
                                    <div class="list-text-footer row">
                                        <div class="col-md-4">
                                            <ul>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <ul>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <ul>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="address-text-fooster col-md-12">
                                        ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา : 128 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่ 50300<br>
                                        โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183 </div>
                                    <div class="address-text-fooster col-md-12" style="margin-top: 8px;">
                                        <div id=ipv6_enabled_www_test_logo></div>
                                        <script language="JavaScript" type="text/javascript">
                                            //var Ipv6_Js_Server = (("https:" === document.location.protocol) ? "https://" : "http://");
                                            //document.write(unescape("%3Cscript src='" + Ipv6_Js_Server + "www.ipv6forum.com/ipv6_enabled/sa/SA1.php?id=5070' type='text/javascript'%3E%3C/script%3E"));
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </footer>
                        <div class="credit" style="text-align:center; color: #fff;margin-top: 50px;margin-bottom: 15px;">
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



                   
</body>

</html>
<script src="/lib/script/search.js"></script>
