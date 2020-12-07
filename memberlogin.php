  
   <?php  
if(!session_id()){session_start();};
$url = explode("/",$_SERVER['REQUEST_URI']);
$url = count($url)-3;
$url_path = "";
for ($i=0; $i < $url; $i++) { 
    $url_path .= "../";
}
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
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
		<script src="https://library.rmutl.ac.th/assets/js/jquery.min.js" type="text/javascript" ></script>
		<script src="https://library.rmutl.ac.th/assets/js/bootstrap.min.js" type="text/javascript" ></script>
		<script src="https://library.rmutl.ac.th/assets/js/application.min.js" type="text/javascript" ></script>
	
        <!--[if lt IE 9]>
            <script src="https://library.rmutl.ac.th/assets/js/respond.min.js"></script>
            <script src="https://library.rmutl.ac.th/assets/js/html5shiv.min.js"></script>
        <![endif]-->
       


<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Free  Template by devbanban.com</title>

<!-- Bootstrap -->
<!-- Latest compiled and minified CSS -->


<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<style type="text/css">
#btn{
	width:100%;
}

</style>

    
        <div id="fb-root"></div>
                
        <nav class="navbar navbar-inverse navbar-fixed-top topbar">
            <div class="container">
                <div class="row">
                    <div class="navbar-header">
                    </div>
                    <form >
                        <div class="pull-right topbar-lang">
                        <ul class="nav navbar-nav">
                        <?php
                        if (isset($_SESSION['user_status']) != null) {
                            ?><button class="btn  btn-xs" ><a href="#"><?php echo $_SESSION['user_status']['FName'] . ' ' . $_SESSION['user_status']['LName']; ?></i></button></a>
                            <button class="btn  btn-xs btn-info"><a href="<?php echo $url_path ?>controller/login/userlogout.php" >ล็อกเอาท์</i></button></a><?php
                        } else {
                            ?><button class="btn btn-xs btn-info"><a href="<?php echo $url_path ?>view/login/login.php" >ล็อกอิน</i></button></a><?php
                        }?>
                        <button  class="btn   btn-xs btn-warning"><a href="index.php" >ไทย</i></button></a>
                        <button class="btn  btn-xs btn-warning"><a href="index-en.php" >English</i></button></a>
                                <br>
                                <br>
                                </ul >
                                </div>
                                 
                        <form class="pull-right search" id="search_form" name="search-form" method="get" >

                        <ul class="nav navbar-nav">
                                                                <li>
                                        <a href="/lib/index.php"  >
                                            <span class='fas fa-home'></span>&nbsp;หน้าแรก                                        </a>
                                    </li> 
                                    <li>
                                        <a href="search.php"  >
                                            <span class='fas fa-search'></span>&nbsp;ค้นหา                                       </a>
                                    </li> 
                                    
                                    <li>
                                        <a href="<?php echo $url_path ?>/view/login/login.php"  >
                                            <span class='fas fa-user'></span>&nbsp;สมาชิก                                     </a>
                                    </li> 
                                    </ul>
                        </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    <br>
    <br>
    <br>
		<section class="container">
<div class="row" style="padding-top: 20px;padding-bottom: 30px; background: lightblue url(q1.jpg) ;">
<div class="col-md-12" >
<a href="/lib/index.php" class="btn btn-danger"><i class='far fa-arrow-alt-circle-left' style='font-size:20px'></i>&nbsp;BACK</a><br><br><br>

      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
              
                </div>
                <div class="card-body">
                  <form action="member1.php" method="post" enctype="multipart/form-data">
                    <div class="row"> </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">ID</label>
                          <input type="text" name="text_ID"  class="form-control"  autocomplete = "off">
                        </div>
                      </div>
                      <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">FName</label>
                          <input type="text" name="text_FName"   class="form-control"  autocomplete = "off">
                        </div>
                      </div>
                      <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">LName</label>
                          <input type="text" name="text_LName"  class="form-control" autocomplete = "off">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                        <label class="bmd-label-floating">Faculty</label>
                      <SELECT  type=text Name="text_Faculty" class="form-control"  id="text_Faculty"  >
                      <option value="">คณะ ---------------------------------------------------------</option>
                      <option value="วิศวกรรมศาสตร์">คณะวิศวกรรมศาสตร์</option>
                      <option value="บริหารธุรกิจ">คณะบริหารธุรกิจและศิลปศาสตร์</option>
                      <option value="สถาปัตยกรรมศาสตร์">คณะศิลปกรรมและสถาปัตยกรรมศาสตร์ร์</option>
                       </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                        <label class="bmd-label-floating">Major</label>
                      <SELECT  type=text Name="text_Major"class="form-control"  id="text_Major"  >
                      <option value="" >คณะวิศวกรรมศาสตร์ ---------------------------------------</option>
                      <option value="วิศวกรรมคอมพิวเตอร์">สาขาวิชาวิศวกรรมคอมพิวเตอร์</option>
                      <option value="วิศวกรรมไฟฟ้า">สาขาวิชาวิศวกรรมไฟฟ้า </option>
                      <option value="วิศวกรรมเครื่องกล">สาขาวิชาวิศวกรรมเครื่องกล</option>
                      <option value="วิศวกรรมโยธา">สาขาวิชาวิศวกรรมโยธา</option>
                      <option value="วิศวกรรมอุตสาหการ">สาขาวิชาวิศวกรรมอุตสาหการ</option>
                      <option value="วิศวกรรมอิเล็กทรอนิกส์">สาขาวิชาวิศวกรรมไฟฟ้าวิศวกรรมอิเล็กทรอนิกส์ </option>
                      <option value="วิศวกรรมอิเล็กทรอนิกส์และโทรคมนาคม">สาขาวิชาวิศวกรรมอิเล็กทรอนิกส์และโทรคมนาคม</option>
                      <option value="วิศวกรรมอาหาร">สาขาวิชาวิศวกรรมอาหาร</option>
                      <option value="วิศวกรรมเหมืองแร่">สาขาวิชาวิศวกรรมเหมืองแร่</option>
                      <option value="" >คณะบริหารธุรกิจและศิลปศาสตร์ -------------------------</option>
                      <option value="การจัดการ">สาขาวิชาการจัดการ</option>
                      <option value="การบัญชี">สาขาวิชาการบัญชี</option>
                      <option value="การตลาด">สาขาวิชาการตลาด</option>
                      <option value="บริหารธุรกิจ">สาขาวิชาบริหารธุรกิจ</option>
                      <option value="ระบบสารสนเทศทางธุรกิจ">สาขาวิชาระบบสารสนเทศทางธุรกิจ</option>
                      <option value="ภาษาอังกฤษเพื่อการสื่อสารสากล">สาขาวิชาภาษาอังกฤษเพื่อการสื่อสารสากล</option>
                      <option value="การท่องเที่ยวและการโรงแรม">สาขาวิชาการท่องเที่ยวและการโรงแรม</option>
                      <option value="" >คณะศิลปกรรมและสถาปัตยกรรมศาสตร์ ----------------</option>
                      <option value="ออกแบบสิ่งทอ">สาขาวิชาออกแบบสิ่งทอ</option>
                      <option value="เซรามิก">สาขาวิชาเซรามิก</option>
                      <option value="สิ่งทอและเครื่องประดับ">สาขาวิชาสิ่งทอและเครื่องประดับ</option>
                      <option value="สถาปัตยกรรม">สาขาวิชาสถาปัตยกรรม</option>
                      <option value="เทคโนโลยีสถาปัตยกรรม">สาขาวิชาเทคโนโลยีสถาปัตยกรรม</option>
                      <option value="ออกแบบสื่อสาร">สาขาวิชาออกแบบสื่อสาร</option>
                      <option value="เทคโนโลยีการพิมพ์และออกแบบบรรจุภัณฑ์">สาขาวิชาเทคโนโลยีการพิมพ์และออกแบบบรรจุภัณฑ์</option>
                       </select>
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text" name="text_Username" class="form-control">
                        </div>
                      </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="text" name="text_Password" class="form-control"  id="text_Password" >
                        </div>
                      </div>      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tel</label>
                          <input type="text" name="text_Tel" class="form-control" id="text_Tel" >
                        </div>
                      </div>      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="text" name="text_Email" class="form-control" id="text_Email" >
                        </div>
                      </div>      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Address</label>
                          <input type="text" name="text_Address" class="form-control" id="text_Address" >
                        </div>
                      </div>      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Status</label>
                          <SELECT  type="text" name="text_Status" class="form-control" id="text_Status"  >
                      <option value="2">2</option>
                       </select>
                        </div>
                      </div>  
                      <div class="col-md-6">
                      <div class="form-group">
                          <label  >รูปภาพ</label>
                          <input class="btn btn-default" type="file" name="img"   >
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="row">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-success">Submit</button>
                  </form>
</body>
</html>