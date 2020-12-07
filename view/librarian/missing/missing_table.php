    <?php


        if(isset($_GET['text_member'])){

            $member=$_GET['text_member'];

            $sql = "SELECT * FROM borrowandreturn WHERE Member = '$member' AND ( Due_Status IS NULL OR Due_Status = 0 ) ";
            $data = $conn->query($sql);
            $row = $data->num_rows;

            for ($i=0; $i < $row ; $i++) { 
                $data_main[$i] = $data->fetch_assoc();
            }

            $stack = "(";
            for ($i=0; $i < $row ; $i++) { 
                $stack .= "'".$data_main[$i]['Librarian']."',";
            }
            $stack = substr($stack,0,strlen($stack)-1);
            $stack .= ")";

            $sql_lib = "SELECT FName,LName,Username FROM librarian WHERE Username IN $stack ";
            $data = $conn->query($sql_lib);
            for ($i=0; $i < $row ; $i++) { 
                $data_lib[$i] = $data->fetch_assoc();
            }

            $sql_member = "SELECT FName,LName FROM member WHERE ID = '$member' ";
            $data = $conn->query($sql_member);
            $data_member = $data->fetch_assoc();

            $stack = "(";
            for ($i=0; $i < $row ; $i++) { 
                $stack .= "'".$data_main[$i]['Book']."',";
            }
            $stack = substr($stack,0,strlen($stack)-1);
            $stack .= ")";

            $sql_lib = "SELECT databib.Subfield,databib.Barcode,rfidandstatus.status as Status,borrowandreturn.Due,borrowandreturn.member 
            FROM borrowandreturn 
            JOIN rfidandstatus ON borrowandreturn.Book=rfidandstatus.Barcode 
            JOIN databib ON borrowandreturn.Book=databib.Barcode 
            WHERE databib.Field = '245'
            AND databib.Barcode IN $stack
            AND borrowandreturn.member = '$member'";
            $data = $conn->query($sql_lib);
            for ($i=0; $i < $row ; $i++) { 
                $data_book[$i] = $data->fetch_assoc();
            }


        ?>
        <div class="form-group">
            <fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em;">
                <legend style="width: auto;padding:0 5px 0 5px;">สถานะหนังสือ</legend>
                <br>
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
            <table class="table table-bordered table-hover table_res" id="mytable"  width="100%" border="2"  style="font-family:kanit;" >
                <thead>
                    <tr>
                        <th width = "15%" class=" bg-success text-white">ผู้ให้ยืม</th>
                        <th width = "20%">สมาชิก</th>
                        <th width = "25%">ทรัพยากร</th>
                        <th width = "10%">ยืมวันที่</th>
                        <th width = "10%">กำหนดคืน</th>
                        <th width = "10%">วันที่คืน</th>
                        <th width = "10%" class="bg-danger text-white"  >สถานะ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(isset($row)){
                        for ($i=0; $i < $row; $i++) {
                ?>
                    <tr>
                        <?php
                            for ($u=0; $u < count($data_lib) ; $u++) {
                                if($data_lib[$u]['Username']==$data_main[$i]['Librarian']){
                                    ?><td><?php echo $data_lib[$u]['FName']." ".$data_lib[$u]['LName']; ?></td><?php
                                }
                            }
                        ?>
                        <td><?php echo $data_member['FName']." ".$data_member['LName']; ?></td>
                        <?php
                            for ($u=0; $u < count($data_book) ; $u++) { 
                                if($data_book[$u]['Barcode']==$data_main[$i]['Book']){
                                    if ($data_book[$u]!="") {
                                        $data_book_already_cut = calsub_arr($data_book[$u]['Subfield'],245);
                                    }
                                    ?><td class="unturn" ><?php echo  $data_book_already_cut['Title']['#a']; ?></td>
                                    <input type="hidden" class="namebook" value="<?php echo $data_book[$u]['Barcode'];?>">
                                    <input type="hidden" class="Borrow_ID" value="<?php echo $data_main[$i]['ID'];?>">
                                    <?php
                                break;
                                }
                            }
                        ?>
                        <td>
                            <?php 
                            $day_con = convert_datethai_monthdot($data_main[$i]['Borrow']);
                            echo $day_con; 
                            ?>
                        </td>
                        <td>
                            <?php 
                                $day_con = convert_datethai_monthdot($data_main[$i]['Returns']);
                                echo $day_con; 
                            ?>
                        </td>
                        <td>
                            <?php 
                                $day_con = convert_datethai_monthdot($data_main[$i]['Due']);
                                echo $day_con; 
                            ?>
                        </td>
                        <?php
                            for ($u=0; $u < count($data_book) ; $u++) { 
                                if ($data_book[$u]['Barcode']==$data_main[$i]['Book']) {
                                    if($data_book[$u]['Status']==0){
                                        ?><td class="text-danger"><?php echo "คืนแล้ว"; ?></td><?php
                                        break;
                                    }
                                    elseif ($data_book[$u]['Status']==9) {
                                        ?><td class="text-danger">
                                        <select class="changeStat btn btn-white btn-sm">
                                            <option value="0">ยังไม่ได้คืน</option>
                                            <option value="1" selected>สูญหาย</option>
                                        </select>
                                        </td><?php     
                                        break;
                                    }
                                    elseif ($data_book[$u]['Status']==1&&$data_main[$i]['Due']!=0) {
                                        ?><td class="text-danger"><?php echo "คืนแล้ว"; ?></td><?php     
                                        break;
                                    }
                                    elseif ($data_book[$u]['Status']==1&&$data_main[$i]['Due']==0) {
                                        ?><td class="text-danger">
                                            <select class="changeStat btn btn-white btn-sm">
                                                    <option value="0">ยังไม่ได้คืน</option>
                                                    <option value="1">สูญหาย</option>
                                            </select>
                                        </td><?php
                                        break;
                                    }
                                }
                            }
                        print_r($data_book[$i]['Status']);
                            for ($u=0; $u < count($data_book) ; $u++) {
                                if ($data_book[$u]['Barcode']==$data_main[$i]['Book']) {
                                    if ($data_book[$u]['Status']==1||$data_book[$u]['Status']==9) {
                                        ?><td><button class="edit_staus">แก้ไข</button></td><?php
                                    }
                                    else {
                                        ?><td></td><?php
                                    }
                                }
                            }
                        ?>
                    </tr>
                <?php 
                        }
                    }

            }
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