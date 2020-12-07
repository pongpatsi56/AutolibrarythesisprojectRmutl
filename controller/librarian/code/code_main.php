<?php

    include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
    
?>

<section class="container main-container ">
    <div class="row" style="padding-top: 20px;padding-bottom:130px; background-color: #eee;">
        <div class="col-md-12">

            <a href="/lib/view/librarian/add.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
            &nbsp;&nbsp;<b style="font-size: 25px;">ตั้งค่าเขตข้อมูล</b>
            <br><br>
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <form action="" method="get">
                    <input type="text" name="search_text" class="form-control">
                    <div class="col-md-12">
                        <br>
                    </div>
                    <center>
                        <div class="col-md-6">
                            <button type="submit" value="1" class="btn btn-primary" name="menu">ค้นหาเขตข้อมูล</button>
                </form>
            </div>
            <div class="col-md-6">
                <form action="" method="get">
                    <button type="submit" value="2" class="btn btn-primary" name="menu">สร้างเขตข้อมูล</button>
                </form>
            </div>
        </div>
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
        <br>

    <?php
    }
    ?>

    <br>
    <br>
    <?php
    if (isset($_GET['menu'])) {
        if ($_GET['menu'] == 1) {
            include $_SERVER['DOCUMENT_ROOT'] . "/lib/controller/librarian/code/code_find.php";
        } elseif ($_GET['menu'] == 2) {
            include $_SERVER['DOCUMENT_ROOT'] . "/lib/controller/librarian/code/code_new.php";
        } elseif ($_GET['menu'] == 3) {
            include $_SERVER['DOCUMENT_ROOT'] . "/lib/controller/librarian/code/code_edit.php";
        }
    }
    ?>
    </div>
    </div>
    </div>
    </div>
    </div>
    <footer>
      
       
      
            </div>
        </div>
    </footer>
 
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