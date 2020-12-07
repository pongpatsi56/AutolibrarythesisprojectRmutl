<?php
            include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
            include $_SERVER['DOCUMENT_ROOT'] . "/lib/include/connect.php";
            include $_SERVER['DOCUMENT_ROOT'] . "/lib/helper/datehelper.php";

            $GETID = $_GET['Bibid'];
            echo "<input type='hidden' id='get_Bib_ID' value='{$GETID}'>";
        
    //         // $databib = querydata("SELECT Barcode FROM databib WHERE Barcode = '$GETID'");
    //         $sql2 = "SELECT * FROM listbuy WHERE ID='$GETID'";
    //         $sql1 = "SELECT * FROM listbuy WHERE recommend='1' AND ID='$GETID' ";

    //         $sql = "SELECT * FROM databib WHERE Field IN (960,961,962) AND Barcode = $GETID ORDER BY Barcode DESC ";
    //         $data = $conn->query($sql);
    //         for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
    //             $data_book[$i] = $data->fetch_assoc();
    //         }

    //         $data_main = [];
    //         for ($i=0; $i < count($data_book) ; $i++) {
    //             if ($data_book[$i]['Field']=='245') {
    //                 for ($j=0; $j < count($data_book) ; $j++) { 
    //                     if ($data_book[$j]['Field']=='960') {
    //                         for ($k=0; $k < count($data_book) ; $k++) { 
    //                             if ($data_book[$k]['Field']=='961') {
    //                                 for ($l=0; $l < count($data_book) ; $l++) { 
    //                                     if ($data_book[$l]['Field']=='962') {
    //                                         if ($data_book[$i]['Barcode']==$data_book[$j]['Barcode']&&$data_book[$i]['Barcode']==$data_book[$k]['Barcode']&&$data_book[$i]['Barcode']==$data_book[$l]['Barcode']) {
    //                                             $data_main[$data_book[$i]['Barcode']]['245']=$data_book[$i];
    //                                             $data_main[$data_book[$i]['Barcode']]['960']=$data_book[$j];
    //                                             $data_main[$data_book[$i]['Barcode']]['961']=$data_book[$k];
    //                                             $data_main[$data_book[$i]['Barcode']]['962']=$data_book[$l];
    //                                         }
    //                                     }
    //                                 }
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    // // echo '<pre>';
    // // print_r($data_book);

    //         $result2 = $conn->query($sql2);
    //         $result1 = $conn->query($sql1);
    //         $row = $result2->fetch_assoc();
    //         $NEWCOUNT = $row["Count"] + 1;
    //         $sql1 = "UPDATE listbuy SET  Count=$NEWCOUNT WHERE ID=$GETID ";
    //         $conn->query($sql1);

    ?>

        <link href="../css/site.css" rel="stylesheet" type="text/css" />
        <link href="../css/style.css" type="text/css" rel="stylesheet">

    <body>
            <section class="container main-container">
            <div class="row" style="padding-bottom: 10px; background-color: #FFFFFF;">

            <!-- <div class="row">
                <img src="https://webs.rmutl.ac.th/assets/upload/logo/website_logo_th_20170905132018.jpg" alt="โลโก้เว็บไซต์ ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา" class="img-responsive" />
            </div> -->
            <!-- main menu -->

        

            <div id="warpper">
                <div class="subnavigate">
                    <div class="ct">
                        <!-- navigative -->
                        <div class="left navi">
                            
                        </div>
                        <!-- search box -->
                        <div class="right">
                            <div id="searchwrapper2">
                                <form action="../../controller/search/Result.php" method="GET">
                                    <input name="Ntt" id="Ntt" type="text" class="btn btn-white" style="padding:unset;border:1px solid darkgray;">
                                    &nbsp;
                                    <span style="display:none;"></span>
                                    <select name="Ntk" id="Ntk" class="btn btn-white" style="padding:unset; border:1px solid darkgray;font-family:kanit;">
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
            <!---- body ---->


            <div id="sidebar">
                <!-- <div class="box-facet">
                    <div class="box-facet-hearder">คำค้น</div>
                    <div class="box-facet-GridItemStyle">
                        <span><b>555555555</b><br></span>
                        <br>
                        <br>
                    </div>
                </div>


                <div class="box-facet">
                    <div class="box-facet-hearder">ฃื่อผู้แต่ง</div>
                    <div class="box-facet-GridItemStyle">
                        <span>&nbsp;<a>&nbsp;<?php echo $row['category']; ?></a><br></span>
                        <br>
                        <br>
                    </div>
                </div>


                <div class="box-facet">
                    <div class="box-facet-hearder">สำนักพิมพ์</div>
                    <div class="box-facet-GridItemStyle">
                        <span>&nbsp;<a></a></span>
                        <br>
                        <br>
                    </div>
                </div> -->
                <div class="box-facet">
                    <div class="box-facet-hearder">Statistics</div>
                    <div class="box-facet-GridItemStyle">
                        <span class="show_view"  >&nbsp;จำนวนผู้เยี่ยมชมเข้ามาดู </span> <br>
                        <FONT Size="2" > &nbsp; แนะนำ + </FONT>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>


            </div>
            <div id="content3" style="float:left">
                
                    <div class="BookResult">
                        <table>
                            <tbody>
                                <tr>
    
                                    <td width="100" height="100" valign="top">
                                        <!-- <script type="text/javascript">
                                                    GetImg('b00124898','http://autolib.rmutl.ac.th/bookcover/124898/124898-fc-t.gif');
                                                    </script> -->

                                        <div class="show_img">
                                        </div>

                                    </td>

                                    <td valign="top">
                                  
<nav style=" margin-bottom: 0px; " class="navbar navbar-light">
                                        <ul style=" border-left-width: 1px; margin-left: 10px; " class="nav nav-pills">
                                            <li class="active"><a data-toggle="pill" href="#detail_item" style="font-family:kanit;background-color: #185d1d;">รายละเอียด</a></li>
                                            <li><a data-toggle="pill" href="#marc21" style="font-family:kanit;background-color: #185d1d;">บรรณานุกรม</a></li>
                                            <li><a data-toggle="pill" href="#item_tab" style="font-family:kanit;background-color: #185d1d;">รายการ</a></li>
                                        </ul>
                                    </nav>
                                    <div class="tab-content">
                                        <div id="detail_item" style=" margin-left: 10px; " class="tab-pane fade in active">
                                            <table>
                                                <tbody style="font-size: 12px;">
                                                    <tr>
                                                        <td width="100" valign="top" style="color: #3e161c;" class="BookLabel">&nbsp;&nbsp;ประเภทแหล่งที่มา</td>
                                                        <td>
                                                            <p class="show_category">&nbsp;</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100" valign="top"  class="BookLabel " style="color: #3e161c;">&nbsp;&nbsp;ชื่อเรื่อง</td>
                                                        <td>
                                                            <p class="show_Title" >&nbsp;</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100" valign="top"  class="BookLabel " style="color: #3e161c;">&nbsp;&nbsp;ชื่อผู้แต่ง</td>
                                                        <td>
                                                            <p class="show_au" >&nbsp;</p>
                                                        </td>
                                                    </tr>
                                                    <tr>  	
                                                        <td width="100" valign="top" style="color: #3e161c;" class="BookLabel">&nbsp;&nbsp;สำนักพิมพ์</td>
                                                        <td>
                                                            <p class="show_pub">&nbsp;</p>
                                                        </td>
                                                    </tr>
                                                    <!--<tr>-->
                                                    <!--    <td width="100" valign="top" style="color: #3e161c;" class="BookLabel">&nbsp;&nbsp;สาขาห้องสมุด</td>-->
                                                    <!--    <td class='show_location'>&nbsp;<td>-->
                                                    <!--</tr>-->
                                                </tbody>
                                            </table>
                                        </div>

                                        <div id="marc21" class="tab-pane fade" style="margin-left:10px;">
                                            <table class="table_marc table">
                                                <thead>
                                                    <tr>
                                                        <th width='300px' style="color: #3e161c;" class="BookLabel">เขตข้อมูล</th>
                                                        <th width='100px' style="color: #3e161c;" class="BookLabel">ตัวบ่งชี้ 1</th>
                                                        <th width='100px' style="color: #3e161c;" class="BookLabel">ตัวบ่งชี้ 2</th>
                                                        <th width='500px' style="color: #3e161c;" class="BookLabel">เขตข้อมูลย่อย</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="font-size: 12px;">
                                                </tbody>
                                            </table>
                                        </div>

                                        <div id="item_tab" class="tab-pane fade" style="margin-left:10px;">
                                            <div class="div_item_tab" style="font-size: 12px;">

                                            </div>
                                        </div>
                                    </div>
                                        
                        </td>
                        </tr>
                        </tbody>
                        </table>

                    </div>
                </div>
                

            </div>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table_item">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            
            
            <footer>

                <div class="row">
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

                            <div class="address-text-fooster col-md-12">

                                ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา : 128 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่ 50300<br>
                                โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183 </div>
                            <div class="address-text-fooster col-md-12" style="margin-top: 8px; ">
                                <div id=ipv6_enabled_www_test_logo></div>

            </footer>

            <div class="credit" style="text-align:center; color: #fff;margin-top: 15px;margin-bottom: 15px;">
                <p style="color: #666; font-family: 'kanit';">ออกแบบและพัฒนาโดย <a href="https://arit.rmutl.ac.th/" target="_blank">สำนักวิทยบริการและเทคโนโลยีสารสนเทศ</a> <a href="https://www.rmutl.ac.th/" target="_blank">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</a></p>
            </div>

    </body>

    

    </html>
    <!-- <script src="/lib/script/search.js"></script> -->

    <script>

        var Bib_ID = $('#get_Bib_ID').val();
        var data_index = {};

        Object.size = function(obj) {
            var size = 0,
                key;
            for (key in obj) {
                if (obj[key].length != 0) size++;
            }
            return size;
        };

        $(document).ready(function(){
            $.ajax({
                url: "/lib/view/showbook/ajax_find_databib.php",
                type: 'post',
                data: {
                    Bib_ID : Bib_ID,
                },
                success: function(response) {
                    // console.log(response);
                    data_index = JSON.parse(response);
                    console.log(data_index);
                    show_detail()
                }
            });
        })

        function show_detail(){
            var stack = "";
            // console.log(data_index);
            var check_showcate = 0;
            for(i in data_index['marc']){
                stack = "";
                if(i=='960'){
                    if (data_index['marc']['960']['sub']!="") {
                        stack += "<img width='180px' height='190px' src='/lib/img/"
                        stack += data_index['marc']['960']['sub'];
                    }
                    else{
                        stack += "Noimgbook.jpg";
                    }
                    stack += "' alt='image'>";
                    $('.show_img').append(stack);
                }
            
                    if(i=='964'){
                        stack = "";
                        for (i in data_index['marc']['964']['sub']) {
                            if (i=='#a') {
                                stack += "Mixed";
                            }
                            else if(i=='#b'){
                                stack += "Article";
                            }
                            else if(i=='#c'){
                                stack += "Book";
                            }
                            else if(i=='#d'){
                                stack += "Computer File";
                            }
                            else if(i=='#e'){
                                stack += "Map";
                            }
                            else if(i=='#f'){
                                stack += "Music";
                            }
                            else if(i=='#g'){
                                stack += "Serial";
                            }
                            else if(i=='#h'){
                                stack += "Visual";
                            }
                        }
                        check_showcate = 1;
                        $('.show_category').append(stack);
                    }
                
                    if(i=='245'){
                    stack = "";
                        if (data_index['marc']['245']['sub']!="") {
                            stack += data_index['marc']['245']['sub'];
                        }
                        else{
                            stack += "-";
                        }
                        $('.show_Title').append(stack);
            
                        stack = "";
                        if (data_index['marc']['260']['sub']!="") {
                            for (i in data_index['marc']['260']['sub']['Publication']) {
                                stack += data_index['marc']['260']['sub']['Publication'][i];
                            }
                        }
                        else{
                            stack += "-";
                        }
                        $('.show_pub').append(stack);
                    }
            
            
            // stack = "";
            // if (data_index['marc']['951']['sub']!="") {
            //     for (i in data_index['marc']['951']['sub']) {
            //         stack += data_index['marc']['951']['sub'][i];
            //     }
            // }
            // else{
            //     stack += "-";
            // }
            // $('.show_location').append(stack);
            
                if(i=='100'){
                    stack = "";
                    if (data_index['marc']['100']['sub']!="") {
                        temp_au = data_index['marc']['100']['sub'].split('/');
                        console.log(temp_au)
                        if(typeof temp_au !="string"){
                            stack += temp_au['0'].substr(3,temp_au['0'].length);
                        }
                        else{
                            stack += data_index['marc']['100']['sub'].substr(3,data_index['marc']['100']['sub'].length);
                        }
                        
                    }
                    else{
                        stack += "-";
                    }
                    check_au = 1;
                    $('.show_au').append(stack);
                }
            

                if(i=='962'){
                    stack = "";
                    if (data_index['marc']['962']['sub']!="") {
                        stack += "("+data_index['marc']['962']['sub']+")";
                    }
                    else{
                        stack += "-";
                    }
                    $('.show_view').append(stack);
                } 
            }
            
            if(check_showcate==0){
                $('.show_category').append("-");
            }
            
            stack = "";
            // var arr_data_index = data_index['marc'];
            // var run_ = 0;
            // for (i in data_index['marc']) {
            //     arr_data_index[run_][i]=data_index['marc'][i]
            //     run_++
            // }
            // console.log(arr_data_index)

            // for (i in arr_data_index[marc]) {
            //     var obj_key1 =null;
            //     var obj_key2 =null;
            //     for (key in arr_data_index[i]) {
            //         obj_key1 = key;
            //     }
            //     for (key in arr_data_index[i+1]) {
            //         obj_key2 = key;
            //     }
            //     if (obj_key1>obj_key2) {
            //         temp_data_index = arr_data_index[i];
            //         arr_data_index[i] = arr_data_index[i+1];
            //         arr_data_index[i+1] = temp_data_index;
            //     }
            // }
            //     console.log(arr_data_index)
            
            
            for (i in data_index['marc']) {
                if (i.substr(0,1)=="0") {
                // console.log(i)
                stack += "<tr>";
                    stack += "<td>";
                        stack += i;
                    stack += "</td>";
                    stack += "<td>";
                        stack += data_index['marc'][i]['inc1'];
                    stack += "</td>";
                    stack += "<td>";
                        stack += data_index['marc'][i]['inc2'];
                    stack += "</td>";
                    stack += "<td>";
                    var cut = "";
                    
                    if (typeof data_index['marc'][i]['sub'] == 'string') {
                        for (let j = 0; j < data_index['marc'][i]['sub'].length; j++) {
                            if (cut=="") {
                                cut = data_index['marc'][i]['sub'].replace("#","$");
                                cut = cut.replace("=", "");
                                cut = cut.replace("/", "");
                            }
                            else{
                                cut = cut.replace("#","$");
                                cut = cut.replace("=", "");
                                cut = cut.replace("/", "");
                            }
                        }
                        marc_array = ['245'];
                        if (cut.substr(0,1)=='$') {
                            stack_cut = cut.substr(0,2);
                            stack += "<span class='text-danger'>"+stack_cut+"</span>"+cut.substr(2,cut.length);
                        }
                        else if(jQuery.inArray(i, marc_array) !== -1&&cut.substr(0,1)!='$'){
                            stack += "<span class='text-danger'>$a</span>"+cut;
                        }
                        else{
                            stack += cut;
                        }
                        
                    }
                    else{
                        var str_sub = "";
                        for (key in data_index['marc'][i]['sub']) {
                            if (typeof data_index['marc'][i]['sub'][key] == 'object') {
                                for (key2 in data_index['marc'][i]['sub'][key]) {
                                    str_sub += "<span class='text-danger'>"+key2+"</span>"+data_index['marc'][i]['sub'][key][key2]+" ";
                                    str_sub = str_sub.replace("#","$");
                                }
                            }
                            else{
                                str_sub += "<span class='text-danger'>"+key+"</span>"+data_index['marc'][i]['sub'][key]+" ";
                                str_sub = str_sub.replace("#","$");
                            }

                        }
                        stack += str_sub;
                    }
                    stack += "</td>";
                stack += "</tr>";
                }
                // console.log(stack)
            }
            for (i in data_index['marc']) {
                if (i.substr(0,1)!="0") {
                // console.log(i)
                stack += "<tr>";
                    stack += "<td>";
                        stack += i;
                    stack += "</td>";
                    stack += "<td>";
                        stack += data_index['marc'][i]['inc1'];
                    stack += "</td>";
                    stack += "<td>";
                        stack += data_index['marc'][i]['inc2'];
                    stack += "</td>";
                    stack += "<td>";
                    var cut = "";
                    
                    if (typeof data_index['marc'][i]['sub'] == 'string') {
                        for (let j = 0; j < data_index['marc'][i]['sub'].length; j++) {
                            if (cut=="") {
                                cut = data_index['marc'][i]['sub'].replace("#","$");
                                cut = cut.replace("=", "");
                                cut = cut.replace("/", "");
                            }
                            else{
                                cut = cut.replace("#","$");
                                cut = cut.replace("=", "");
                                cut = cut.replace("/", "");
                            }
                        }
                        marc_array = ['245'];
                        if (cut.substr(0,1)=='$') {
                            stack_cut = cut.substr(0,2);
                            stack += "<span class='text-danger'>"+stack_cut+"</span>"+cut.substr(2,cut.length);
                        }
                        else if(jQuery.inArray(i, marc_array) !== -1&&cut.substr(0,1)!='$'){
                            stack += "<span class='text-danger'>$a</span>"+cut;
                        }
                        else{
                            stack += cut;
                        }
                        
                    }
                    else{
                        var str_sub = "";
                        for (key in data_index['marc'][i]['sub']) {
                            if (typeof data_index['marc'][i]['sub'][key] == 'object') {
                                for (key2 in data_index['marc'][i]['sub'][key]) {
                                    str_sub += "<span class='text-danger'>"+key2+"</span>"+data_index['marc'][i]['sub'][key][key2]+" ";
                                    str_sub = str_sub.replace("#","$");
                                }
                            }
                            else{
                                str_sub += "<span class='text-danger'>"+key+"</span>"+data_index['marc'][i]['sub'][key]+" ";
                                str_sub = str_sub.replace("#","$");
                            }

                        }
                        stack += str_sub;
                    }
                    stack += "</td>";
                stack += "</tr>";
                }
                // console.log(stack)
            }

            $('.table_marc tbody').append(stack);

            stack = "";
            for ( i in data_index['barcode']) {
                stack += "<div class='row'>"
                    stack += "<div class='col-md-4 BookLabel' valign='top' style='padding-top:7px;color: #3e161c;'>&nbsp;&nbsp;";
                        stack += "Barcode";
                    stack += "</div>";
                    stack += "<div class='col-md-6' style='padding-top:7px;'>";
                        stack += data_index['barcode'][i]['Barcode'];
                    stack += "</div>";
                stack += "</div>";
                stack += "<div class='row'>"
                console.log(data_index['barcode'][i]['Barcode'])
                    stack += "<div class='col-md-4 BookLabel' valign='top' style='padding-top:7px;color: #3e161c;'>&nbsp;&nbsp;";
                        stack += "Copy";
                    stack += "</div>";
                    stack += "<div class='col-md-6' style='padding-top:7px;'>";
                    if (data_index['barcode'][i]['Copy']=="") {
                        stack += "-";
                    }
                    else{
                        stack += data_index['barcode'][i]['Copy'];
                    }
                    stack += "</div>";
                stack += "</div>";
                stack += "<div class='row'>"
                    stack += "<div class='col-md-4 BookLabel' valign='top' style='padding-top:7px;color: #3e161c;'>&nbsp;&nbsp;";
                        stack += "Call Numer";
                    stack += "</div>";
                    stack += "<div class='col-md-6' style='padding-top:7px;'>";
                    var check_050 = 0;
                    for (j in data_index['marc']) {
                        if (j=='050') {
                            stack += data_index['marc']['050']['sub']['#b'];
                            check_050 = 1;
                        }
                    }
                    if (check_050 == 0) {
                        stack += "-";
                    }
                    stack += "</div>";
                stack += "</div>";
                stack += "<div class='row'>"
                    stack += "<div class='col-md-4 BookLabel' valign='top' style='padding-top:7px;color: #3e161c;'>&nbsp;&nbsp;";
                        stack += "สถานะ";
                    stack += "</div>";
                    stack += "<div class='col-md-6' style='padding-top:7px;'>";
                    for ( j in data_index['status']) {
                        if( data_index['barcode'][i]['Barcode'] == data_index['status'][j]['Barcode'] ){
                            if (data_index['status'][j]['Status']=="0") {
                                stack += "พร้อมใช้งาน";
                            }
                            else{
                                stack += "ไม่สามารถใช้งานได้";
                            }
                            break;
                        }
                    }
                    stack += "</div>";
                stack += "</div>";
            stack += "<hr>";
                
            }
            $('.div_item_tab').append(stack);
        }

    </script>