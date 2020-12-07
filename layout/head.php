<?php
if (!session_id()) {
    @session_start();
};

// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = count($url) - 3;
$url_path = "";
for ($i = 0; $i < $url; $i++) {
    $url_path .= "../";
}

?>
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

    <meta property="og:site_name" content="ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" />
    <meta property="og:url" content="http://localhost:8080/" />
    <meta property="og:title" content="ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" />
    <meta property="og:locale" content="th_TH" />
    <meta property="og:description" content="ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" />
    <meta property="og:image" content="<?=$url_path?>assets/upload/logo/website_main_logo_20170911140405.jpg" />
    <meta property="og:image:width" content="560" />
    <meta property="og:image:height" content="420" />
    <meta property="og:type" content="website" />

    <link href="<?=$url_path?>css/site.css" rel="stylesheet" type="text/css" />
    <link href="<?=$url_path?>css/style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="<?=$url_path?>assets/fontawesome-free-5.8.1-web/css/all.css">
    <link rel="canonical" href="http://localhost:8080/">
    <link href="<?=$url_path?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=$url_path?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=$url_path?>assets/css/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=$url_path?>assets/css/style_gray.min.css" rel="stylesheet" type="text/css" />

    <link href="<?=$url_path?>assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=$url_path?>assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <script src="<?=$url_path?>assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="<?=$url_path?>assets/js/application.min.js" type="text/javascript"></script>
    <script src="<?=$url_path?>assets/js/jquery.dcjqaccordion.min.js" type="text/javascript"></script>


<link rel="stylesheet" href="<?=$url_path?>assets/js/dist/css/bootstrap/zebra_datepicker.min.css" type="text/css">
<script src="<?=$url_path?>assets/js//dist/zebra_datepicker.min.js"></script>

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
    <!-- <script src="http://localhost:8080/lib/assets/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
    <!-- <script src="http://localhost:8080/lib/assets/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
    <script src="<?=$url_path?>assets/js/bootstrap.min.js" type="text/javascript"></script>


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
    ?><li><a style="color:DFE0D4; " id="btngologin" href=""><b><?php echo $_SESSION['user_status']['FName'] . ' ' . $_SESSION['user_status']['LName']; ?></b></i></li></a>
                           <li><a style="color: F97A2D;" href="" id="btngologout"><b>ล็อกเอาท์</b></i> </li></a><?php

} else {
    ?><li><a style="color: F97A2D;" href="" id="btngologout"><b>ล็อกอิน</b></i> </li></a><?php

                                                                                                                                                                                                                                    } ?>
                            <br>
                            <br>
                        </ul>
                    </div>

                    <form class="pull-right search" id="search_form" name="search-form" method="get">

                        <ul class="nav navbar-nav">
                            <li>
                                <a href="<?php echo $url_path ?>index.php">
                                    <span class='fas fa-home'></span>&nbsp;หน้าแรก </a>
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
    <script>
        $(document).on("click", "#btngologin", function() {
            $.ajax({
                url: "/lib/view/login/JSlogin.php",
                dataType: "json",
                success: function(data) {
                    console.log(data)
                    if (data == 1 || data == 0) {
                        window.location = '/lib/view/librarian/librarian.php'
                    } else if (data == 2) {
                        window.location = '/lib/view/member/member.php'
                    } else {
                        window.location = '/lib/view/login/login.php'
                    }
                },
                error: function(e) {
                    console.log(e);
                    alert("something wrong");
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
    
    <style>
    a{
	    cursor:pointer;
	}
    </style>