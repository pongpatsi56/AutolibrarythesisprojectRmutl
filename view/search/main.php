<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
?>
<style type="text/css">
/* class สำหรับแถวส่วนหัวของตาราง */
.tr_head{
    background-color:#eee;
    color:#050505;
}
/* class สำหรับแถวแรกของรายละเอียด */
.tr_odd{
    background-color:#fff;
}
/* class สำหรับแถวสองของรายละเอียด */
.tr_even{
    background-color:#ddd;
}
</style>
<br><br><br>
<section class="container">
<div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #eee;">
<div class="col-md-12">
<a  href="JavaScript:window.history.go(-1)"><img src='/lib/iconimg/left-arrow.png' width='30' height='30' ></i></a><br><br><br>
<div class="col-md-12"><form   method ="GET"  >Mode
                  &nbsp;&nbsp;
                     <select  name="sel_page" id="sel_page" class="btn btn-white  ">
                  <option value = '20'<?=(isset($_GET['sel_page']) && $_GET['sel_page'] == "20") ? " selected" : ""?> >20</option>
                  <option value = '50'<?=(isset($_GET['sel_page']) && $_GET['sel_page'] == "50") ? " selected" : ""?>>50</option>
                  <option value = '100'<?=(isset($_GET['sel_page']) && $_GET['sel_page'] == "100") ? " selected" : ""?>>100</option>
                  </select>
                  &nbsp;&nbsp;&nbsp;&nbsp;

                  <select name="type" id="type" class="btn btn-white ">
                  <option value = 'ID'<?=(isset($_GET['type']) && $_GET['type'] == "ID") ? " selected" : ""?>>ID</option>
                  <option value = 'Title'<?=(isset($_GET['type']) && $_GET['type'] == "Title") ? " selected" : ""?>>Title</option>
                  <option value = 'Author'<?=(isset($_GET['type']) && $_GET['type'] == "Author") ? " selected" : ""?>>Author</option>
                  <option value = 'Subject'<?=(isset($_GET['type']) && $_GET['type'] == "Subject") ? " selected" : ""?>>Subject</option>
                  <option value = 'Tag'<?=(isset($_GET['type']) && $_GET['type'] == "Tag") ? " selected" : ""?>>Tag</option>
                  <option value = 'ISBN'<?=(isset($_GET['type']) && $_GET['type'] == "ISBN") ? " selected" : ""?>>ISBN/ISSN</option>
                  <option value = 'Publisher'<?=(isset($_GET['type']) && $_GET['type'] == "Publisher") ? " selected" : ""?>>Publisher</option>
                  <option value = 'JournalTitle'<?=(isset($_GET['type']) && $_GET['type'] == "JournalTitle") ? " selected" : ""?>>Journal Title</option>
                  </select>

                &nbsp;  &nbsp;
                            <input type="text" name="text_search" id="text_search" class="btn btn-white " autocomplete="off" value="<?=(isset($_GET['text_search'])) ? $_GET['text_search'] : ""?>">

                        &nbsp;
                <button type="submit" class="btn btn-primary" >search</button>



                  </form>


<br>
                    <table  id="mytable"  width="100%" border="0">
        <thead>
            <tr>
                <th  scope="col" >Title</th>
                <th  scope="col" >Author</th>
                <th  scope="col" >Publisher</th>
               <!-- <th>Call Number</th>
                <th>Location</th> -->
            </tr>
        </thead>
        <tbody>
            <tr>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/controller/search/main.php";
?>

</tbody>
    </table>
</div>
</div>
<div class="col-md-4">
</div>
<div class="col-md-5">

 <?php
page_navi($total, (isset($_GET['page1'])) ? $_GET['page1'] : 1, $e_page, $_GET);
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";
?>
 <script language="javascript">
window.onload = function () {
      var a=document.getElementById('mytable'); // อ้างอิงตารางด้วยตัวแปร a
      for(i=0;i<a.rows.length;i++){ // วน Loop นับจำนวนแถวในตาราง
          if(i>0){  // ตรวจสอบถ้าไม่ใช่แถวหัวข้อ
              if(i%2==1){   // ตรวจสอบถ้าไม่ใช่แถวรายละเอียด
                  a.rows[i].className="tr_odd";     // กำหนด class แถวแรก
              }else{
                  a.rows[i].className="tr_even";  // กำหนด class แถวที่สอง
              }
          }else{ // ถ้าเป็นแถวหัวข้อกำหนด class
              a.rows[i].className="tr_head";
          }
      }
}
</script>
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
