<?php
 include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
 include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
 include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/datehelper.php";
 $GETID=$_GET['Bibitem'];
 $sql = "SELECT * FROM news WHERE ID='$GETID'";
 $sql3 = "SELECT * FROM news ORDER BY Date1  DESC  LIMIT 0,8";
 $result3= $conn->query($sql3);
 $result= $conn->query($sql);
 $row = $result->fetch_assoc();

?>
     
                
       

        <section class="container main-container">
                        <div class="row">
                <img src="https://webs.rmutl.ac.th/assets/upload/logo/website_logo_th_helf_20170905132116.jpg" alt="โลโก้เว็บไซต์ สวส.มทร.ล้านนา แนะนำบริการ : ยืมต่อด้วยตนเอง (Online Renewal Sevice) | ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" class="img-responsive" />
            </div>
          




<div class="row" style="margin-top: 15px; margin-bottom: 15px;">
    <div class="col-lg-9 col-md-9 col-ms-9">

<ol class="breadcrumb" style="margin-bottom: 0px" itemscope itemtype="http://schema.org/BreadcrumbList">
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
   
<div class="row">
    <div class="col-md-12">
        <h1 class="post_title_head"><?php echo $row['Title']; ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <p class="text_normal"> เผยแพร่เมื่อ : <?php 
        
        $day_con = convert_datethai_monthdot($row['Date1']);
        echo $day_con; ?> 
        
    </div>
</div>



<hr style="margin-top: 9px;">
    <div class="row">
        <div class="col-md-12">
            <a id="post_thumbnail" href="https://webs.rmutl.ac.th/assets/upload/images/2019/07/post_thumbnail_2019070810154654260.jpg" title="สวส.มทร.ล้านนา แนะนำบริการ : ยืมต่อด้วยตนเอง (Online Renewal Sevice)">
            <img src="../imgnew/<?php echo $row['img']; ?>" width="830px" height="400px" style="border:1px solid black" >
            </a>

        </div>
    </div>
    <br>
<div class="row top15">
    <div class="col-md-12">
        <p><strong><span style="font-size:18px;">รายล่ะเอียด :&nbsp;</span></strong><a><?php echo $row['Story']; ?></a></p>
    </div>
</div>

    <div class="row top15">
        <div class="col-md-12">
                           
                        </div>
    </div>

    <div class="col-md-12">
      
    </div> 


<div class="row">
    <div class="col-md-12">
        <div style="margin-top:10px;">
            <div style="margin-right:5px;" class="pull-left fb-share-button" data-href="https://library.rmutl.ac.th/news/11123-สวสมทรล้านนา-แนะนำบริการ-บริการ-ยืมต่อด้วยตนเอ" data-layout="button_count"></div>
            <div style="margin-top:5px;">
            </div>
        </div>
    </div>
</div>

<hr>
<div class="fb-comments" data-width="100%" data-href="https://library.rmutl.ac.th/news/11123-สวสมทรล้านนา-แนะนำบริการ-บริการ-ยืมต่อด้วยตนเอ" data-numposts="5"></div>
<input id="fb_url" value="https://library.rmutl.ac.th/news/11123-สวสมทรล้านนา-แนะนำบริการ-บริการ-ยืมต่อด้วยตนเอ" type="hidden">
<input id="post_idx" value="11123" type="hidden">
</div>
<div class="col-lg-3 col-md-3 col-ms-3">
    
    <div class="panel" style="display: block">
        <div class="panel-header-rmutl">
       
            <span class="big-header-link">ข่าวล่าสุด</span> 
         
         </div>
         <div class="panel-body-rmutl">
             <ul class="last_post_link nav nav-stacked">
   
                         <?php
                             if ($result3 && $result3->num_rows > 0) {
                                 while ($row = $result3->fetch_assoc()) {
                                 ?>
 
                       <ul class="link-rmutl nav nav-pills nav-stacked">
 <li >
                                             <a href="shownew.php?Bibitem=<?=$row['ID'] ?>">
 
                                             <i class=" mr10"><?php echo $row['Title']; ?></i>                                 </a>
                                     </li>
                                                                  
                                                                 </ul>       
 
                                                                 <?php
                                 }
                             }
                             ?>    </a>
                     </li>
        </div>
    </div>

  
        <div class="text-center mb15" id="facebook_page"></div>
        
        </div>
</div>
<footer>
    <div class="row" >
        
    </div> 
    <div class="row" >
   
 
    <span class="footer-divider"></span>
    </div> 
    <div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #BEBEBE;">
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
<div class="row" style=" background-color: #BEBEBE;">
<div class="credit" style="text-align:center; color: #eee;margin-top: 15px;margin-bottom: 15px;">
    <p style="color: #666; font-family: 'kanit';">ออกแบบและพัฒนาโดย <a href="https://arit.rmutl.ac.th/" target="_blank">สำนักวิทยบริการและเทคโนโลยีสารสนเทศ</a> <a href="https://www.rmutl.ac.th/" target="_blank">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</a></p>
</div>
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
<input type="hidden" id="service_base_url" value="https://library.rmutl.ac.th/">
	<script src="https://library.rmutl.ac.th/assets/js/jquery.dcjqaccordion.min.js" type="text/javascript" ></script>
		<script src="https://library.rmutl.ac.th/assets/js/owl.carousel.min.js" type="text/javascript" ></script>
		<script src="https://library.rmutl.ac.th/assets/js/home.min.js" type="text/javascript" ></script>
		
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-87588904-9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-87588904-9');
</script>
</body>
</html>