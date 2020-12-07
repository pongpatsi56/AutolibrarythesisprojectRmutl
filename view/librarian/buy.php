<?php

include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
?>
<script> 
$(document).on("change","#text_category",function() {
        var x = $("#text_category").val();
        console.log(x);
        if (x == 'book' ) {
                // $("#enddate").hide();

                $("#textgroup1").show();
                $("#textgroup2").hide();
                $("#text_Title").show();
                $("#text_Title2").hide();
                $("#textauthor").show();
                $("#text_Publisher").show();
                $("#text_Price").show();
                $("#text_From1").show();
                $("#text_year1").show();
                $("#start_date1").show();
                // $("#startquarter").hide();
            } else if(x == 'journal'){
              $("#textgroup1").hide();
              $("#textgroup2").show();
                $("#text_Title").hide();
                $("#text_Title2").show();
                $("#textauthor").show();
                $("#text_Publisher").show();
                $("#text_Price").show();
                $("#text_From1").show();
                $("#text_year1").show();
                $("#start_date1").show();
            }

});
  </script>
  <br>
  <br>
  <br>
<section class="container ">
<div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #eee;">
<div class="col-md-6">
<a href="../librarian/librarian.php" ><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40' ></i></a>
</div>
<div class="col-md-6"><button type="submit"  onclick="window.location.href='listbuy.php?&nPage=1&perPage=10'" class="pull-right btn btn-primary">เรียกดู</button>
</div>
<br>
<br>
<br>

<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
<form action="buyconnext.php" method="post" enctype="multipart/form-data">
              
            <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">ประเภท</label>
                          <SELECT  type="text" Name="text_category" class="form-control"  id="text_category"  >
       
                      <option value="book">หนังสือ</option>
                      <option value="journal">วารสาร</option>
					
                       </select>
                          </div>
                          </div>
            <div class="col-md-6">      
            <div class="form-group"  >         
                <div id="textgroup1">
						  <label class="bmd-label-floating">หมวด</label>
                      <SELECT  type="text" Name="text_group1" class="form-control"  id="text_group1"  >
                      <option value="000  เบ็ดเตล็ดหรือความรู้ทั่วไป"> 000  เบ็ดเตล็ดหรือความรู้ทั่วไป</option>
                      <option value="100  ปรัชญา"> 100  ปรัชญา</option>
                      <option value="200  ศาสนา"> 200   ศาสนา</option>
					  <option value="300  สังคมศาสตร์">300  สังคมศาสตร์</option>
                      <option value="400  ภาษาศาสตร์">400  ภาษาศาสตร์</option>
                      <option value="500  วิทยาศาสตร์">500  วิทยาศาสตร์</option>
					  <option value="600  วิทยาศาสตร์ประยุกต์ หรือเทคโนโลยี">600 วิทยาศาสตร์ประยุกต์ หรือเทคโนโลยี</option>
                      <option value="700  ศิลปกรรมและการบันเทิง">700  ศิลปกรรมและการบันเทิง </option>
                      <option value="800  วรรณคดี ">800  วรรณคดี  </option>
					  <option value="900  ประวัติศาสตร์">900  ประวัติศาสตร์</option>
                       </select>
                       </div>
                <div hidden id="textgroup2">
                       <label class="bmd-label-floating">ฉบับ</label>
                      <input type="text" name="text_group2"  id="text_group2" class="form-control"  autocomplete = "off">
                    
                       </select>
                       </div>
                       </div>
                       </div>
              <div class="col-md-6">               
                <div class="form-group"  >
                 <div id="text_Title">
                          <label class="bmd-label-floating" >ชื่อหนังสือ</label>
                          <input type="text" name="text_Title"  id="text_Title" class="form-control"  autocomplete = "off">
                          </div>
                  <div hidden id="text_Title2">
                          <label class="bmd-label-floating" >ชื่อวารสาร</label>
                          <input type="text" name="text_Title2"  id="text_Title2" class="form-control"  autocomplete = "off">
                          </div>
                          </div>
                          </div>
						  <br>
              <div class="col-md-6">               
                <div class="form-group" id="textauthor" >
                          <label class="bmd-label-floating" >ชื่อผู้แต่ง</label>
                          <input type="text" name="text_author" id="text_author"  class="form-control"  autocomplete = "off">
		
              </div>
                       </div>
              <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">สำนักพิมพ์</label>
                          <input type="text" name="text_Publisher"  id="text_Publisher" class="form-control"  autocomplete = "off">
                          </div>
                          </div>
						  <br>
              <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">ราคา</label>
                          <input type="text" name="text_Price"  id="text_Price" class="form-control"  autocomplete = "off">
                          </div>
                       </div>
              <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">จำนวน</label>
                          <input type="text" name="text_Quantiny" id="text_Quantiny"  class="form-control"  autocomplete = "off">
                          </div>
                       </div>
						  <br>
              <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">จาก</label>
                          <input type="text" name="text_From1"  id="text_From1" class="form-control"  autocomplete = "off">
                          </div>
                       </div>
              <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">ปีที่พิมพ์</label>
                          <input type="text" name="text_year1" id="text_year1"  class="form-control"  autocomplete = "off">
                          </div>
                       </div>
              <div class="col-md-6">           
                <div class="form-group">
              <label class="bmd-label-floating">วันที่ซื้อ</label>
                            <input type="date" class="form-control" name="start_date1" id="start_date1">
                            </div>
                       </div>
                       <div class="col-md-6">
                      <div class="form-group">
                          <label  >รูปภาพ</label>
                          <input class="btn btn-default" type="file" name="img"   >
                        </div>
                      </div>
                      <input type="hidden" name="IDU"  id="IDU" value="<?=$_SESSION['user_status']['User_ID'] ?>">
                            <br>
                            <br>
                            <br>
                        </span>
                        <div class="col-md-12">           
                        <center>    
                        <label  >แนะนำ</label>
                      <input class="btn btn-default" name="rank_recommend"  id="rank_recommend" VALUE="1" type="checkbox">
                     
                            <br>
                            <br>
                <div class="form-group">
                          <button type="submit" class="btn btn-success" onclick="if (!confirm('บันทึกในฐานข้อมูล?')) { return false }">บันทึก</button>
                          </div>
                       </div>
                  </form>
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
<?php
 include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";
?>