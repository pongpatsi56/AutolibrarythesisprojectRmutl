<?php
 include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
 include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
 $GETID=$_GET['Bibitem'];
$sql2 = "SELECT * FROM listbuy WHERE ID='$GETID'";
$sql1 = "SELECT * FROM listbuy WHERE recommend='1' AND ID='$GETID' ";
$result2= $conn->query($sql2);
$result1= $conn->query($sql1);
$row = $result2->fetch_assoc();
$NEWCOUNT = $row["Count"]+1;
$sql1 = "UPDATE listbuy SET  Count=$NEWCOUNT WHERE ID=$GETID ";
$conn->query($sql1);

function query_data($sql){
    global $conn;
    $getdata = mysqli_query($conn, $sql);
    $data = array();
    if (mysqli_num_rows($getdata) != 0) {
        while ($row = mysqli_fetch_assoc($getdata)) {
            array_push($data, $row);
        }
    }
    return $data;
}
?>
<link href="../css/site.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" type="text/css" rel="stylesheet">
<body>
    <section class="container main-container">
    
        
       
        <div class="row">
        <div id="warpper">
     
        <div class="subnavigate">
	                <div class="ct">
                    <!-- navigative -->
		                <div class="left navi">
                        <h1>Bib item</h1>
                        </div>
		            <!-- search box -->
                    <div class="right">
                            <div id="searchwrapper2">  
                            <form action="../controller/search/Result.php" method="GET">
                                <input name="Ntt" id="Ntt" type="text" class="btn btn-white" style="padding:unset;border:1px solid darkgray;">
                                &nbsp;
                                <span style="display:none;"></span>
                                <select name="Ntk" id="Ntk" class="btn btn-white" style="padding:unset; border:1px solid darkgray;">
                                    <option value="KEYWORD" selected>ทั้งหมด</option>
                                    <option value="TITLE">ชื่อเรื่อง</option>
                                    <option value="AUTHOR">ชื่อผู้แต่ง</option>
                                    <option value="SUBJECT">หัวเรื่อง</option>
                                    <option value="TAGS">แท็ก</option>
                                    <option value="ISBNISSN">ISBN/ISSN</option>
                                    <option value="PUBLISHER">สำนักพิมพ์</option>
                                    <option value="JOURNALTITLE">ชื่อวารสาร</option>
                                    <input type="hidden" name="nPage" value="1">
                                    <input type="hidden" name="perPage" value="15">
                                </select>
                                &nbsp;<input type="submit" id="btnsearch" value="สืบค้น" title="สืบค้น" class="btn btn-info" style="padding: 1px 6px;font-size: 14px;border: 0.5px;">
                            </form>
                        </div>                                                        
                    </div>
				    </div>
                </div>
        </div>

    
    
        <div id="sidebar" style=" background-color: #eee;">
            
      
        <div class="box-facet">
                    <div class="box-facet-hearder">ฃื่อผู้แต่ง</div>
                        <div class="box-facet-GridItemStyle" >
                        <span>&nbsp;<a >&nbsp;<?php echo $row['category']; ?></a><br></span>
                        <br>
                        <br>
                        </div>
                </div>
                
       
        <div class="box-facet">
                    <div class="box-facet-hearder">สำนักพิมพ์</div>
                        <div class="box-facet-GridItemStyle">
                        <span>&nbsp;<a ><?php echo $row['Publisher']; ?></a></span>
                        <br>
                        <br>
                        <br>
                        </div>
                </div>
                <div class="box-facet">
                    <div class="box-facet-hearder">Review</div>
                    <div class="box-facet-GridItemStyle">
                        <span>&nbsp;<a >คนเข้ามาดู[<?php echo $row['Count']; ?>]</a> </span> <br
<?php 

if(mysqli_num_rows($result1) == 1) {
    ?>
    <FONT Size = "2" > &nbsp; แนะนำ + </FONT>
<?php
}
?>
<br>
                        <br>
                        <br>
                        </div>
                </div>

                
        </div>
        <div id="content" >
            <div class="col-md-6">
            <div class="BookResult">
            <table>
                                    <tbody>
                                        <tr>
                                
                                            <td width="100" height="100" valign="top">
                                                <!-- <script type="text/javascript">
                                                GetImg('b00124898','http://autolib.rmutl.ac.th/bookcover/124898/124898-fc-t.gif');
                                                </script> -->
                                              
                                                <div class="col-md-3" >
                                                <img width="145px" height="160px"   src="../img/<?php echo $row['img']; ?>" alt="image">
                                                </div>
                                               
                                            </td>
                                            
                                            <td valign="top">
                                                <table>
                                                    <tbody style="font-size: 12px;">
                                                        <tr>
                                                            <td width="100" valign="top" class="BookLabel">&nbsp;&nbsp;ประเภทแหล่งที่มา</td>
                                                            <td>
                                                            <p>&nbsp;<?php echo $row['category']; ?></p></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100" valign="top" class="BookLabel" style="padding-top: 7px;">&nbsp;&nbsp;ชื่อเรื่อง</td>
                                                            <td >
                                                            <p>&nbsp;<?php echo $row['Title']; ?></p></td>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100" valign="top" class="BookLabel">&nbsp;&nbsp;สำนักพิมพ์</td>
                                                            <td><p>&nbsp;<?php echo $row['Publisher']; ?></p></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100" valign="top" class="BookLabel">&nbsp;&nbsp;สาขาห้องสมุด</td>
                                                            <td>&nbsp;ห้องสมุดมทร.ล้านนา ลำปาง</td>
                                                        </tr>
                                                    </tbody>
                                                    
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                    
                                </table>     
                                           
            </div>
        </div>
        </div>
    </div>
    
    <div class="row">
</div>
    <footer>
    
    <div class="row" style=" background-color: #eee;">
    <div class="col-md-14">
        <span class="footer-divider"></span>
    </div> 
    </div> 
    <div class="row footer">
                <div class="col-md-4 col-sm-12" id="vertical-line">
            <div class="col-md-12">
                <img src="https://webs.rmutl.ac.th/assets/upload/logo/web_footer_20170911140318.png" class="rmutl-web-logo-footer img-responsive">
            </div>
            <div class="col-md-12 footer-about-text text-center">
                ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา<br>
                <span class="footer-span-comment">"มทร.ล้านนา"</span>
            </div>
            <div class="col-md-12 text-center">
                <div class="socicons">
                                        
                          

                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="list-text-footer row">
          
            <div class="address-text-fooster col-md-12" >
            
                ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา : 128 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่ 50300<br>
                โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183            </div>
            <div class="address-text-fooster col-md-12" style="margin-top: 8px; " >
                <div id=ipv6_enabled_www_test_logo ></div>
  
</footer>
<div class="row"  style=" background-color: #eee;">
<div class="credit" style="text-align:center; color: #fff;margin-top: 15px;margin-bottom: 15px;">
    <p style="color: #666; font-family: 'kanit';" >ออกแบบและพัฒนาโดย <a href="https://arit.rmutl.ac.th/" target="_blank">สำนักวิทยบริการและเทคโนโลยีสารสนเทศ</a> <a href="https://www.rmutl.ac.th/" target="_blank">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</a></p>
</div>

</body>
</html>
<!-- <script src="/lib/script/search.js"></script> -->