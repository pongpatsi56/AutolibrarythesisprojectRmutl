
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
$ID1 = $_GET['Bibitem'];
$result = $conn->query("SELECT * FROM listbuy WHERE ID = '$ID1' ");
$num = mysqli_num_rows($result);
if ($num != 0) {
    while ($showdata = mysqli_fetch_assoc($result)) { 

?>
<script> 
function setdefult(set1) {
    if (set1 == 'book' ) {
                // $("#enddate").hide();

                $("#textgroup1").show();
                $("#textgroup2").hide();
                $("#stext_Title").show();
                $("#textauthor").show();
                $("#text_Publisher").show();
                $("#text_Price").show();
                $("#text_From1").show();
                $("#text_year1").show();
                $("#start_date1").show();
                // $("#startquarter").hide();
            } else if(set1 == 'journal'){
              $("#textgroup1").hide();
              $("#textgroup2").show();
                $("#stext_Title").show();
                $("#textauthor").show();
                $("#text_Publisher").show();
                $("#text_Price").show();
                $("#text_From1").show();
                $("#text_year1").show();
                $("#start_date1").show();
            }
    
}
$(document).on("change","#text_category",function() {
        var x = $("#text_category").val();
        console.log(x);
        if (x == 'book' ) {
                // $("#enddate").hide();

                $("#textgroup1").show();
                $("#textgroup2").hide();
                $("#stext_Title").show();
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
                $("#stext_Title").show();
                $("#textauthor").show();
                $("#text_Publisher").show();
                $("#text_Price").show();
                $("#text_From1").show();
                $("#text_year1").show();
                $("#start_date1").show();
            }

});

  </script>

<body  onload="setdefult('<?=$showdata['category'] ?>')">
<section class="container main-container">
<div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #eee;">
   <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary" >
                <form action="editconnext.php" method="post" enctype="multipart/form-data" >
              <input type="hidden" name="ID" id="" value = "<?=$ID1 ?>">
            <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">ประเภท</label>
                          <SELECT  type="text" Name="text_category" class="form-control"  id="text_category"   value="<?=$showdata['category'] ?>">
       
                      <option value="book" <?=$showdata['category']=='book'?" selected":"" ?>>หนังสือ</option>
                      <option value="journal" <?=$showdata['category']=='journal'?" selected":"" ?>>วารสาร</option>
					
                       </select>
                          </div>
                          </div>
            <div class="col-md-6">      
            <div class="form-group"  >         
                <div id="textgroup1">
						  <label class="bmd-label-floating">หมวด</label>
                      <SELECT  type="text" Name="text_group1" class="form-control"  id="text_group1" value="<?=$showdata['group1'] ?>" >
                      <option value="000  เบ็ดเตล็ดหรือความรู้ทั่วไป" <?=$showdata['group1']=='000  เบ็ดเตล็ดหรือความรู้ทั่วไป'?" selected":"" ?>> 000  เบ็ดเตล็ดหรือความรู้ทั่วไป</option>
                      <option value="100  ปรัชญา" <?=$showdata['group1']=='100  ปรัชญา'?" selected":"" ?>> 100  ปรัชญา</option>
                      <option value="200  ศาสนา" <?=$showdata['group1']=='200  ศาสนา'?" selected":"" ?>> 200   ศาสนา</option>
					  <option value="300  สังคมศาสตร์" <?=$showdata['group1']=='300  สังคมศาสตร์'?" selected":"" ?>>300  สังคมศาสตร์</option>
                      <option value="400  ภาษาศาสตร์" <?=$showdata['group1']=='400  ภาษาศาสตร์'?" selected":"" ?>>400  ภาษาศาสตร์</option>
                      <option value="500  วิทยาศาสตร์" <?=$showdata['group1']=='500  วิทยาศาสตร์'?" selected":"" ?>>500  วิทยาศาสตร์</option>
					  <option value="600  วิทยาศาสตร์ประยุกต์ หรือเทคโนโลยี" <?=$showdata['group1']=='600  วิทยาศาสตร์ประยุกต์ หรือเทคโนโลยี'?" selected":"" ?>>600 วิทยาศาสตร์ประยุกต์ หรือเทคโนโลยี</option>
                      <option value="700  ศิลปกรรมและการบันเทิง" <?=$showdata['group1']=='700  ศิลปกรรมและการบันเทิง'?" selected":"" ?>>700  ศิลปกรรมและการบันเทิง </option>
                      <option value="800  วรรณคดี " <?=$showdata['group1']=='800  วรรณคดี'?" selected":"" ?>>800  วรรณคดี  </option>
					  <option value="900  ประวัติศาสตร์" <?=$showdata['group1']=='900  ประวัติศาสตร์'?" selected":"" ?>>900  ประวัติศาสตร์</option>
                       </select>
                       </div>
                <div hidden id="textgroup2">
                       <label class="bmd-label-floating">ฉบับ</label>
                      <input type="text" name="text_group2"  id="text_group2" class="form-control"  autocomplete = "off" value="<?=$showdata['group1'] ?>">
                    
                       </select>
                       </div>
                       </div>
                       </div>
              <div class="col-md-6">               
                <div class="form-group"  >
                          <label class="bmd-label-floating" >ชื่อหนังสือ</label>
                          <input type="text" name="text_Title"  id="text_Title" class="form-control"  autocomplete = "off" value="<?=$showdata['Title'] ?>">
                          </div>
                          </div>
						  <br>
              <div class="col-md-6">               
                <div class="form-group" id="textauthor" >
                          <label class="bmd-label-floating" >ชื่อผู้แต่ง</label>
                          <input type="text" name="text_author" id="text_author"  class="form-control"  autocomplete = "off" value="<?=$showdata['Author'] ?>" >
		
              </div>
                       </div>
              <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">สำนักพิมพ์</label>
                          <input type="text" name="text_Publisher"  id="text_Publisher" class="form-control"  autocomplete = "off" value="<?=$showdata['Publisher'] ?>">
                          </div>
                          </div>
						  <br>
              <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">ราคา</label>
                          <input type="text" name="text_Price"  id="text_Price" class="form-control"  autocomplete = "off" value="<?=$showdata['Price'] ?>">
                          </div>
                       </div>
              <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">จำนวน</label>
                          <input type="text" name="text_Quantiny" id="text_Quantiny"  class="form-control"  autocomplete = "off" value="<?=$showdata['Quantiny'] ?>">
                          </div>
                       </div>
						  <br>
              <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">จาก</label>
                          <input type="text" name="text_From1"  id="text_From1" class="form-control"  autocomplete = "off" value="<?=$showdata['From1'] ?>">
                          </div>
                       </div>
              <div class="col-md-6">               
                <div class="form-group">
                          <label class="bmd-label-floating">ปีที่พิมพ์</label>
                          <input type="text" name="text_year1" id="text_year1"  class="form-control"  autocomplete = "off" value="<?=$showdata['year1'] ?>">
                          </div>
                       </div>
              <div class="col-md-6">           
                <div class="form-group">
              <label class="bmd-label-floating">วันที่ซื้อ</label>
                            <input type="date" class="form-control" name="start_date1" id="start_date1" value="<?=$showdata['Date1'] ?>"> 
                       
                            </div>
                       </div>
                       <div class="col-md-6">
                      <div class="form-group">
                          <label  >รูปภาพ</label>
                          <input class="btn btn-default" type="file" name="img" value="<?=$showdata['img'] ?>" >
                        </div>
                      </div>
              
                            <br>
                            <br>
                            <br>
                        </span>
                        <div class="col-md-12">           
                        <center>    
                        <label  >แนะนำ</label>
                      <input class="btn btn-default" name="recommend"  id="rank_recommend"  type="checkbox" value="1"<?=$showdata['recommend']==1?" checked":""?>>
               
                            <br>
                            <br>
                <div class="form-group">
                          <button type="submit" class="btn btn-success" onclick="if (!confirm('แก้ไขข้อมูล?')) { return false }">Submit</button>
                          </div>
                       </div>
                  </form>
                  </body>
<?php
}
} else {
    echo '<h2>ไม่สามารถแก้ไขข้อมูลได้</h2>';
}

?>





<?php
 include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";
 ?>