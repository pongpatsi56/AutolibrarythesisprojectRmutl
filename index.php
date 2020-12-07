
<?php if (!session_id()) {
    session_start();
};
    require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/url_helper.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/calsubfield.php";
    
    $sql3 = "SELECT * FROM news ORDER BY Date1  DESC  LIMIT 0,5";
    $result3 = $conn->query($sql3);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</title>
    <meta name="description" content="ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" />
    <meta name="keywords" content="ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" />
    <meta name="author" content="มทร.ล้านนา" />
    <link rel="shortcut icon" href="<?=$url_path?>assets/images/favicon_20170911140318.ico" />
    <link type="text/css" rel="stylesheet" href="css/css_layout.css">
    <meta property="og:site_name" content="ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" />
    <meta property="og:url" content="http://localhost:8080/" />
    <meta property="og:title" content="ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" />
    <meta property="og:locale" content="th_TH" />
    <meta property="og:description" content="ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" />
    <meta property="og:image" content="<?=$url_path?>assets/upload/logo/website_main_logo_20170911140405.jpg" />
    <meta property="og:image:width" content="560" />
    <meta property="og:image:height" content="420" />
    <meta property="og:type" content="website" />


    <link rel="stylesheet" href="<?=$url_path?>assets/fontawesome-free-5.8.1-web/css/all.css">
    <link rel="canonical" href="http://localhost:8080/">
    <link href="<?=$url_path?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=$url_path?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=$url_path?>assets/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=$url_path?>assets/css/style_gray.min.css" rel="stylesheet" type="text/css" />

    <link href="<?=$url_path?>assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=$url_path?>assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <script src="<?=$url_path?>assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="<?=$url_path?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=$url_path?>assets/js/application.min.js" type="text/javascript"></script>
    <style>
        div.a {
            white-space: nowrap;
            width: 50px;
            overflow: hidden;
            text-overflow: clip;
            border: 1px solid #000000;
        }

        p.b {
            white-space: nowrap;
            width: 130px;
            overflow: hidden;
            text-overflow: ellipsis;

        }

        div.c {
            white-space: nowrap;
            width: 50px;
            overflow: hidden;
            text-overflow: "----";
            border: 1px solid #000000;
        }
    </style>
    <!--[if lt IE 9]>
            <script src="https://library.rmutl.ac.th/assets/js/respond.min.js"></script>
            <script src="https://library.rmutl.ac.th/assets/js/html5shiv.min.js"></script>
        <![endif]-->

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <!-- Optional theme -->
    <link rel="stylesheet" href="<?=$url_path?>assets/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="<?=$url_path?>assets/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</title>
    <meta name="description" content="ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" />
    <meta name="keywords" content="ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" />
    <meta name="author" content="มทร.ล้านนา" />
    <link rel="shortcut icon" href="https://webs.rmutl.ac.th/assets/upload/logo/favicon_20170911140318.ico" />

    <meta property="og:site_name" content="ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" />
    <meta property="og:url" content="https://library.rmutl.ac.th/" />
    <meta property="og:title" content="ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" />
    <meta property="og:locale" content="th_TH" />
    <meta property="og:description" content="ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" />
    <meta property="og:image" content="https://webs.rmutl.ac.th/assets/upload/logo/website_main_logo_20170911140405.jpg" />
    <meta property="og:image:width" content="560" />
    <meta property="og:image:height" content="420" />
    <meta property="og:type" content="website" />


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="canonical" href="https://library.rmutl.ac.th/">
    <link href="https://library.rmutl.ac.th/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://library.rmutl.ac.th/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://library.rmutl.ac.th/assets/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="https://library.rmutl.ac.th/assets/css/style_gray.min.css" rel="stylesheet" type="text/css" />

    <link href="https://library.rmutl.ac.th/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="https://library.rmutl.ac.th/assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <script src="https://library.rmutl.ac.th/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="https://library.rmutl.ac.th/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://library.rmutl.ac.th/assets/js/application.min.js" type="text/javascript"></script> -->

</head>

<body>
    <div id="fb-root"></div>

    <nav class="navbar navbar-inverse navbar-fixed-top topbar">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="https://library.rmutl.ac.th/" class="topbar-main-link">
                        ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา </a>
              
    <style type="text/css">
        #btn {
            width: 100%;
        }
    </style>


    <div id="fb-root"></div>

    <nav class="navbar navbar-inverse navbar-fixed-top topbar">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                </div>
                <form>
                    <div class="pull-right ">
                        <ul class="nav navbar-nav">
                        <?php
if (isset($_SESSION['user_status']) != null) {
    ?><li><a style="color:#DFE0D4; " id="btngologin" href=""><b><?php echo $_SESSION['user_status']['FName'] . ' ' . $_SESSION['user_status']['LName']; ?></b></i></li></a>
                           <li><a style="color:#F97A2D; " href="" id="btngologout" ><b >ล็อกเอาท์</b></i> </li></a><?php

} else {
    ?><li ><a style="color: #F97A2D;" href="" id="btngologout"><b >ล็อกอิน</b></i> </li></a><?php

}?>
                            <br>
                            <br>
                        </ul>
                    </div>

                    <form class="pull-right search" id="search_form" name="search-form" method="get">



                        <ul class="nav navbar-nav">
                            <li>
                                <a href="<?php echo $url_path ?>index.php" style="color:F97A2D; ">
                                    <span class='fas fa-home' ></span>&nbsp;หน้าแรก </a>
                            </li>
                            <li>
                                <a href="<?php echo $url_path ?>search.php">
                                    <span class='fas fa-search'></span>&nbsp;สืบค้น </a>
                            </li>

                            <li>
                                <a id="btngologin" href="">
                                    <span class='fas fa-user'></span>&nbsp;บริการสมาชิก </a>
                            </li>
                        </ul>
                    </form>
            </div>
        </div>
        </div>
        </div>
        </div>
    </nav>

    <section class="container main-container">
        <div class="row">
            <img src="<?=$url_path?>assets/upload/logo/website_logo_th_20170905132018.jpg" alt="โลโก้เว็บไซต์ ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" class="img-responsive" />
        </div>





        <!-- main menu -->

        </div> <input type="hidden" id="check_welcome" value="0">

        <script type="text/javascript">
        

            function getURL() {
                if (document.getElementById('TI').checked) {
                    //Search Title
                    var searchStr = document.getElementById('searchterm').value;
                    var Title = "TI ("
                    var closetag = ")"
                    var searchFull1 = Title.concat(searchStr);
                    var searchFull = searchFull1.concat(closetag);
                    document.getElementById('searchterm').value = searchFull;
                } else if (document.getElementById('AU').checked) {
                    //Search Author
                    var searchStr = document.getElementById('searchterm').value;
                    var Author = "AU ("
                    var closetag = ")"
                    var searchFull1 = Author.concat(searchStr);
                    var searchFull = searchFull1.concat(closetag);
                    document.getElementById('searchterm').value = searchFull;
                }

                if (document.getElementById('defaultdb').value == "JN") {
                    //Search Title
                    var searchStr = document.getElementById('searchterm').value;
                    var Title = "PT Academic Journal AND ("
                    var closetag = ")"
                    var searchFull1 = Title.concat(searchStr);
                    var searchFull = searchFull1.concat(closetag);
                    document.getElementById('searchterm').value = searchFull;
                }
            }
            $(document).on("click", "#btngologin", function() {
                $.ajax({
                    url: "/lib/view/login/JSlogin.php",
                    dataType: "json",
                    success: function(data) {
                        console.log(data)
                        if (data == 1) {
                            window.location = '/lib/view/librarian/librarian.php'
                        } else if (data == 2) {
                            window.location = '/lib/view/member/member.php'
                        } else {
                            window.location = '/lib/view/login/login.php'
                        }
                    },
                    error: function(e) {
                        console.log(e)
                    }
                });
            });

            $("#btngologout").click(function() {
                $.ajax({
                    url: "/lib/controller/login/userlogout.php",
                    success: function(data) {
                        console.log(data);
                        window.location = "/lib/view/login/login.php"
                    },
                    error: function(e) {
                        console.log(e)
                    }
                });

            });

            

        </script>

        <div class="row" style="padding-top: 7px;padding-bottom: 2px; background-color: #c5aaaa;">
            <div class="col-md-12">
                <div class="col-md-3" >
                </div>
                <div style=" width: 130px;" class="col-md-2 ">
                    <b>
                        <font size="5" class="kanit ">สืบค้นด่วน</font>
                    </b>
                </div>
                <div class="col-md-4">
                    <form>
                        <input id="text_resurce" type="text" class="form-control" placeholder="พิมพ์ชื่อหนังสือ/ชื่อผู้เเต่ง/ISBN เพื่อค้นหา" value="" style="margin-bottom: 5px">
                        <input type="hidden" id="type_resource" value="KEYWORD">
                </div>
                <div class="col-md-2">
                    <button type="button" style="font-family:kanit;" onclick="Basic_go()" class=" btn btn-info  btn-round btn-just-icon"> <i class="material-icons">ค้นหา</i></button> <br>
                </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-md-3" >
                <div class="row">
                    <div class="panel-header-rmutl">
                        <span class="big-header-link">RMUTL</span>
                    </div>
                    <div class="embed-responsive embed-responsive-16by9" >
                        <iframe src="https://www.youtube.com/embed/lETGun4XtXM" allowfullscreen>
                        </iframe>
                    </div>
                    <div class="panel-header-rmutl" >
                        <a href="/lib/new/shownewall.php" title="บทความ"><span class="big-header-link">ข่าวล่าสุด</span> <span class="sub-header-link">ลิงค์</span>
                            <i class="fas fa-angle-double-right" ></i>
                        </a>
                    </div>
                    <?php
                    if ($result3 && $result3->num_rows > 0) {
                        while ($row = $result3->fetch_assoc()) {
                            ?>
                            <ul class="link-rmutl nav nav-pills nav-stacked" >
                                <li>
                                    <a href="new/shownew.php?Bibitem=<?= $row['ID'] ?>">
                                        <i class=" mr10" ><?php echo $row['Title']; ?></i> </a>
                                </li>
                            </ul>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
           

            <div class="col-md-9">
                <nav class="navbar navbar-light">
                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="pill" href="#Types" style="font-family:kanit;">หนังสือใหม่</a></li>
                        <li><a data-toggle="pill" href="#Language" style="font-family:kanit;">เปิดดูมากที่สุด</a></li>
                        <li><a data-toggle="pill" href="#Collection" style="font-family:kanit;">แนะนำให้อ่าน</a></li>


                    </ul>
                </nav>

                <div class="tab-content">
                    <div id="Types" class="tab-pane fade in active">
                       
                    </div>

                    <div id="Language" class="tab-pane fade">
                    </div>
                    <div id="Collection" class="tab-pane fade">
                    </div>
                </div>

            </div>








            <br>
            <br>

            <div class="row">

            </div>

            <div class="container">
                <div class="row">

                    <nav class="navbar navbar-light" style="background-color: #eee; ">







                        <h5 class="links-line" style="padding-top: 20px;"><span>ฐานข้อมูลอ้างอิงงานวิจัยต่างประเทศ</span></h5>
                        <div id="carousel1" class="owl-carousel-95 nxt" style="display: block; opacity: 1;">
                            <div class="item text-center">
                                <a href="https://search.proquest.com/autologin" title="ProQuest ProQuest">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912151551.gif" alt="ProQuest ProQuest" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="http://eds.a.ebscohost.com/ehost/search/basic?vid=0&sid=257b038a-d38c-4925-9e49-f07b3b639f8f%40sessionmgr4009" title="EBSCOhost EBSCOhost">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912151725.jpg" alt="EBSCOhost EBSCOhost" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="https://search.ebscohost.com/Community.aspx?authtype=ip&ugt=62E771363C0635173766357632353E2228E367D36713699367E326E330133603&stsug=AiXkfwxxMdS-mDoKVQ3qm_Dqh0vMelbC14PI6hy1K6D-yDSY4LjFP0yQ5EBxHJLhdckG8NQOYzXsmS788rPIhTUrMnaReTEwhuo9smm7BxnseeqPhQkLpu1hma1q" title="EBSCOhost EBSCOhost">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912151900.jpg" alt="EBSCOhost EBSCOhost" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="http://www.emeraldinsight.com/" title="Emerald Emerald">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912152313.gif" alt="Emerald Emerald" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="https://search.proquest.com/abicomplete" title="ABI/NIFORM ABI/NIFORM">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912152157.jpg" alt="ABI/NIFORM ABI/NIFORM" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="https://link.springer.com/" title="Springer Springer">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912152418.jpg" alt="Springer Springer" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="http://eds.a.ebscohost.com/ehost/search/basic?vid=0&sid=857d3310-f0ab-43ec-9a6d-544977fe122e%40sessionmgr4007" title="EBSCOhost EBSCOhost">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912152527.jpg" alt="EBSCOhost EBSCOhost" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="http://dcms.thailis.or.th/dcms/basic.php" title="Thailis Thailis">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912152630.jpg" alt="Thailis Thailis" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="http://dl.acm.org/dl.cfm" title=" ACM Digital Library  ACM Digital Library">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912151033.jpg" alt=" ACM Digital Library  ACM Digital Library" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="http://apps.webofknowledge.com/WOS_GeneralSearch_input.do?product=WOS&search_mode=GeneralSearch&SID=N2A1AEBjhMuwpH81dpj&preferencesSaved=" title="ISI Web of Knowledge ISI Web of Knowledge">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912151628.jpg" alt="ISI Web of Knowledge ISI Web of Knowledge" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="http://eds.a.ebscohost.com/ehost/search/basic?vid=0&sid=0cbdccbf-0179-4ebe-b6a2-ea41e7a2171b%40sessionmgr4009" title="Wilson Web Wilson Web">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912151738.jpg" alt="Wilson Web Wilson Web" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="http://dric.nrct.go.th/index.php" title="IR-Web IR-Web">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912151850.png" alt="IR-Web IR-Web" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="http://ieeexplore.ieee.org/Xplore/home.jsp" title="IEEE Xplore Digital Library IEEE Xplore Digital Library">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912152041.gif" alt="IEEE Xplore Digital Library IEEE Xplore Digital Library" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="http://pubs.acs.org/" title="ACS Publications ACS Publications">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912152138.jpg" alt="ACS Publications ACS Publications" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="http://www.sciencedirect.com/" title="ScienceDirect ScienceDirect">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912152241.gif" alt="ScienceDirect ScienceDirect" class="img-responsive" />
                                </a>
                            </div>
                            <div class="item text-center">
                                <a href="http://dric.nrct.go.th/index.php" title="RL NRCT RL NRCT">
                                    <img src="<?=$url_path?>assets/upload/link/42_20170912152512.jpg" alt="RL NRCT RL NRCT" class="img-responsive" />
                                </a>
                            </div>
                        </div>
                        <div class="mb15" style="padding-top: 20px;"></div>
                        <input type="hidden" id="last_tab" value="1">
                        <footer>
                            <div class="col-md-14">
                                <span class="footer-divider"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-12" id="vertical-line">
                                    <div class="col-md-12">
                                        <img src="<?=$url_path?>assets/upload/logo/web_footer_20170911140318.png" class="rmutl-web-logo-footer img-responsive">
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
    <input type="hidden" id="service_base_url" value="<?=$url_path?>index.php">
    <script src="<?=$url_path?>assets/js/jquery.dcjqaccordion.min.js" type="text/javascript"></script>
    <script src="<?=$url_path?>assets/js/owl.carousel.min.js" type="text/javascript"></script>
    <script src="<?=$url_path?>assets/js/home.min.js" type="text/javascript"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-87588904-9"></script>
    <script src="/lib/script/search.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments)
        };
        gtag('js', new Date());

        gtag('config', 'UA-87588904-9');

        var data_index =[];

        $(document).ready(function(){
                $.ajax({
                    url: "/lib/ajax_find_index.php",
                    success: function(response) {
                        // console.log(response);
                        data_index = JSON.parse(response);
                        console.log(data_index);
                        append_new();
                        append_view();
                        append_rec();


                    }
                });
            })

        function append_new(){
            var stack = "";
            for (let i = 0; i < data_index['new'].length; i++) {
                for (j in data_index['main']) {
                    if (j==data_index['new'][i]) {
                        stack += "<div class='col-md-2'><br><br>";
                            stack += "<center>";
                            console.log(data_index['new'][i])
                                stack += "<a href='view/showbook/bibitem.php?Bibid="+data_index['new'][i]+"'> <img src='img/";
                                if (data_index['main'][j]['960']['sub']!="") {
                                    stack += data_index['main'][j]['960']['sub'];
                                }
                                else{
                                    stack += "Noimgbook.jpg";
                                    
                                }
                                stack += "' width='120px' height='150px' style='border:1px solid black' >";
                                stack += "<p class='b' style='font-family:kanit;' title='"+data_index['main'][j]['245']['sub']+"' >"+data_index['main'][j]['245']['sub']+"</p>";
                                stack += "</a>";
                            stack += "</center>";
                        stack += "</div>";
                    }
                }
            }
            $('#Types').append(stack);
        }

        function append_view(){
            var stack = "";
            for (let i = 0; i < data_index['view'].length; i++) {
                for (j in data_index['main']) {
                    if (j==data_index['view'][i]) {
                        stack += "<div class='col-md-2'><br><br>";
                            stack += "<center>";
                                stack += "<a href='view/showbook/bibitem.php?Bibid="+data_index['view'][i]+"'> <img src='img/";
                                if (data_index['main'][j]['960']['sub']!="") {
                                    stack += data_index['main'][j]['960']['sub'];
                                }
                                else{
                                    stack += "Noimgbook.jpg";
                                    
                                }
                                stack += "' width='120px' height='150px' style='border:1px solid black' >";
                                stack += "<p class='b' style='font-family:kanit;' title='"+data_index['main'][j]['245']['sub']+"' >"+data_index['main'][j]['245']['sub']+"</p>";
                                stack += "</a>";
                            stack += "</center>";
                        stack += "</div>";
                    }
                }
            }
            $('#Language').append(stack);
        }
        function append_rec(){
            var stack = "";
            for (let i = 0; i < data_index['rec'].length; i++) {
                for (j in data_index['main']) {
                    if (j==data_index['rec'][i]) {
                        stack += "<div class='col-md-2'><br><br>";
                            stack += "<center>";
                                stack += "<a href='view/showbook/bibitem.php?Bibid="+data_index['rec'][i]+"'> <img src='img/";
                                if (data_index['main'][j]['960']['sub']!="") {
                                    stack += data_index['main'][j]['960']['sub'];
                                }
                                else{
                                    stack += "Noimgbook.jpg";
                                    
                                }
                                stack += "' width='120px' height='150px' style='border:1px solid black' >";
                                stack += "<p class='b' style='font-family:kanit;' title='"+data_index['main'][j]['245']['sub']+"' >"+data_index['main'][j]['245']['sub']+"</p>";
                                stack += "</a>";
                            stack += "</center>";
                        stack += "</div>";
                    }
                }
            }
            $('#Collection').append(stack);
        }


    </script>



</body>

</html>
</body>

</html>