<?php
include_once "../../layout/head.php";
include_once "../../include/connect.php";
require_once "../../helper/url_helper.php";
function query_data($sql)
{
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

$getnametype = (isset($_GET['Status']) && $_GET['Status'] != 'ALL') ? " AND Status = " . $_GET['Status'] : '';
$getkeywords = isset($_GET['keywords']) ? $_GET['keywords'] : '';
$getkeytype = (isset($_GET['keytype']) && $_GET['keytype'] != 'ALL') ? " AND " . $_GET['keytype'] . " LIKE '%" . $getkeywords . "%'" : " AND (User_ID like '%$getkeywords%' OR Name like '%$getkeywords%' OR Username like '%$getkeywords%' OR FName like '%$getkeywords%' OR LName like '%$getkeywords%')";
$sql = "SELECT *
FROM userstatus u
    left JOIN permission p ON u.status = p.Per_ID
    LEFT JOIN 
    (SELECT ID, Username, FName, LName
    FROM librarian
UNION
    SELECT ID, Username, FName, LName
    FROM member) AS result ON u.User_ID = result.ID
    WHERE IsDelete = 0" . $getkeytype . $getnametype;


$result = query_data($sql);
$total = count($result);
$s_name = query_data("SELECT * FROM permission");

$max_user_id = query_data("SELECT max(ID) as ID FROM userstatus");
$this_user_id = isset($max_user_id) ? $max_user_id[0]['ID'] + 1 : '0';

/////// pagination //////////
$Num_Rows = isset($result) ? count($result) : null;
$Per_Page = 20;
$Page = isset($_GET["nPage"]) ? $_GET["nPage"] : 1;
$paginate = "&nPage=" . '1' . "&perPage=" . $Per_Page;

$Prev_Page = $Page - 1;
$Next_Page = $Page + 1;

$Page_Start = (($Per_Page * $Page) - $Per_Page);
$pagi_data = query_data($sql);


if ($Num_Rows <= $Per_Page) {
    $Num_Pages = 1;
} else if (($Num_Rows % $Per_Page) == 0) {
    $Num_Pages = ($Num_Rows / $Per_Page);
} else {
    $Num_Pages = ($Num_Rows / $Per_Page) + 1;
    $Num_Pages = (int) $Num_Pages;
}
/////////////////////////////

?>
        <script>
            var keep_default_value = '';

            function edit_attr(id) {
                keep_default_value = $("#stat" + id).val();
                $("#stat" + id).prop('disabled', false);
                $("#btn_edit" + id).hide();
                $("#btn_conf" + id).show();
                $("#btn_canl" + id).show();
                for (let i = 0; i < 20; i++) {
                    if (i != id) {
                        $("#btn_edit" + i).prop('disabled', true);
                    }
                }
            }

            function conf_attr(userid, oldstatus, id) {
                var status = $("#stat" + id).val()
                if (status == keep_default_value) {
                    canl_attr(id);
                } else {
                    var r = confirm("ต้องการ'บันทึก'ข้อมูล?");
                    if (r == true) {
                        $.ajax({
                            url: "save_edit.php",
                            data: {
                                user: userid,
                                oldstat: oldstatus,
                                stat: status
                            },
                            type: "POST",
                            success: function(data) {
                                console.log(data);
                                window.location.reload();
                            },
                            error: function(e) {
                                alert("มีข้อผิดพลาดบางอย่าง");
                            }
                        });
                    }
                }
            }

            function canl_attr(id) {
                $("#stat" + id).val(keep_default_value).prop('disabled', 'disabled');
                $("#btn_edit" + id).show();
                $("#btn_conf" + id).hide();
                $("#btn_canl" + id).hide();
                for (let i = 0; i < 20; i++) {
                    $("#btn_edit" + i).prop('disabled', false);
                }
            }

            function del_user(userid) {
                var r = confirm("ต้องการ'ลบ'ผู้ใช้?");
                if (r == true) {
                    $.ajax({
                        url: "delete_user.php",
                        data: {
                            user: userid
                        },
                        type: "POST",
                        success: function(data) {
                            console.log(data);
                            alert('ลบผู้ใช้สำเร็จ');
                            window.location.reload();
                        },
                        error: function(e) {
                            alert("มีข้อผิดพลาดบางอย่าง");
                        }
                    });
                }
            }
        </script>
        <style type="text/css">
            /* class สำหรับแถวส่วนหัวของตาราง */
            .tr_head {
                background-color: #eee;
                color: #050505;
            }

            /* class สำหรับแถวแรกของรายละเอียด */
            .tr_odd {
                background-color: #fff;
            }

            /* class สำหรับแถวสองของรายละเอียด */
            .tr_even {
                background-color: #ddd;
            }
            span {
                font-weight: bold;
                font-style: italic;
            }
        </style>
<div class="container main-container">
<div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #eee;">
        <div class="col-md-12">
            <div class="container">
                <ul class="nav nav-tabs">
                 
                    <li><a href="../librarian/librarian.php" style="padding:5px;"><img src='/lib/iconimg/left-arrow (3).png'.png' width='40' height='36'></i></a></li>
                    <?php if (isset($_SESSION['user_status']) && $_SESSION['user_status']['Status'] == 0) {
                    ?>
                        <li class="active"><a data-toggle="tab" href="#adminmanage"><b>จัดการผู้ใช้</b></a></li>
                    <?php } ?>
                    <li <?= (isset($_SESSION['user_status']) && $_SESSION['user_status']['Status'] != 0) ? "class='active'" : "" ?>><a data-toggle="tab" href="#adduser_onlyone"><b>เพิ่มผู้ใช้แบบเดี่ยว</b></a></li>
                    <li><a data-toggle="tab" href="#adduser_import"><b>เพิ่มผู้ใช้แบบหมู่(Import File)</b></a></li>
                    <!-- <li><a data-toggle="tab" href="#adduser"><b>เพิ่มผู้ใช้</b></a></li> -->
                </ul>
            </div><br />
            <div class="tab-content">
                <?php if (isset($_SESSION['user_status']) && $_SESSION['user_status']['Status'] == 0) { ?>
                <div id="adminmanage" class="tab-pane fade in active">
                    <?php
                    if (count($result) != 0) {
                    ?>
                        <form method="get">
                            &nbsp;ค้นหา&nbsp;
                            <select name="Status" id="Status" class="btn btn-white">
                                <option value="ALL" <?= (isset($_GET['Status']) && $_GET['Status'] == "ALL") ? " selected" : "" ?>>ทั้งหมด</option>
                                <option value="0" <?= (isset($_GET['Status']) && $_GET['Status'] == "0") ? " selected" : "" ?>>admin</option>
                                <option value="1" <?= (isset($_GET['Status']) && $_GET['Status'] == "1") ? " selected" : "" ?>>บรรณาลักษณ์</option>
                                <option value="2" <?= (isset($_GET['Status']) && $_GET['Status'] == "2") ? " selected" : "" ?>>นักศึกษา</option>
                            </select>
                            &nbsp;จาก&nbsp;
                            <select name="keytype" id="keytype" class="btn btn-white">
                                <option value="ALL" <?= (isset($_GET['keytype']) && $_GET['keytype'] == "ALL") ? " selected" : "" ?>>ทั้งหมด</option>
                                <option value="User_ID" <?= (isset($_GET['keytype']) && $_GET['keytype'] == "User_ID") ? " selected" : "" ?>>รหัสประจำตัว</option>
                                <option value="FName" <?= (isset($_GET['keytype']) && $_GET['keytype'] == "FName") ? " selected" : "" ?>>ชื่อ</option>
                                <option value="LName" <?= (isset($_GET['keytype']) && $_GET['keytype'] == "LName") ? " selected" : "" ?>>สกุล</option>
                                <option value="Username" <?= (isset($_GET['keytype']) && $_GET['keytype'] == "Username") ? " selected" : "" ?>>ชื่อผู้ใช้</option>
                            </select>
                            &nbsp;:&nbsp;
                            <input type="text" name="keywords" id="keywords" class="btn btn-white" value="<?= (isset($_GET['keywords'])) ? $_GET['keywords'] : "" ?>">&nbsp;
                            <input type="submit" class="btn btn-primary" value="ค้นหา">
                            <input type="reset" class="btn btn-default" value="ล้างค่า">
                        </form>
                        <br>
                        <table id="mytable" width="100%" border="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-warning">
                                        <center> ลำดับ </center>
                                    </th>
                                    <th width="15%">
                                        ชื่อ
                                    </th>
                                    <th width="15%">
                                        สกุล
                                    </th>
                                    <th scope="col">
                                        ชื่อผู้ใช้
                                    </th>
                                    <th scope="col">
                                        <center> กลุ่มผู้ใช้</center>
                                    </th>
                                    <th scope="col" class=" bg-warning text-dark">
                                        คำอธิบายกลุ่มผู้ใช้
                                    </th>
                                    <th width="7%" class=" bg-success text-white">
                                        <center> ใช้งานได้ </center>
                                    </th>
                                    <th width="10%" class=" bg-info text-white">
                                        <center> แก้ไข</center>
                                    </th>
                                    <th scope="col" class="bg-danger text-white">
                                        <center> ลบ</center>
                                    </th>
                                </tr>
                            </thead>
                            <?php
                            $no = 1;
                                foreach (array_slice($result, $Page_Start, $Per_Page) as $run => $data) {
                                // echo '<pre>';
                                // print_r($data);
                                // print_r($s_name);
                                echo "<tr>";
                                echo "<td>";
                            ?><center>
                                    <div class="text-warning"> <?php echo $Page_Start + $no; ?>
                                        <?php echo "</td><td>"; ?>
                                        <div class="text-primary"> <?php echo $data["FName"]; ?>
                                            <?php echo "</td><td>"; ?>
                                            <div class="text-primary"> <?php echo $data["LName"]; ?>
                                                <?php echo "</td><td>";
                                                echo $data["Username"];
                                                echo "</td>";
                                                ?>
                                                <td>
                                                    <center> <select class="btn btn-white" name="status" id="stat<?= $no ?>" disabled="disabled">
                                                            <?php foreach ($s_name as $key => $value) {
                                                            ?>
                                                                <option value="<?= $value['Per_ID'] ?>" <?= ($data['Status'] == $value['Per_ID']) ? " selected" : "" ?>><?= $value['Name'] ?></option>
                                                            <?php
                                                            } ?>
                                                        </select>
                                                </td>
                                                <td class="text-warning">
                                                    <?= $data['Description'] ?>
                                                </td>
                                                <td>
                                                    <center> <i <?= $data['IsBan'] == 0 ? "class='fas fa-check-circle' style='color: 82c91e;'" : "class='fas fa-times-circle' style='color: de524d;' title='ผู้ใช้นี้ถูกระงับสิทธิ์'"; ?>></i> </center>
                                                </td>
                                                <td>
                                                    <center> <input type="button" class='btn btn-sm btn-link' id="btn_edit<?= $no ?>" onclick="edit_attr('<?= $no ?>')" value="แก้ไข">
                                                        <input type="button" class='btn btn-sm btn-success' id="btn_conf<?= $no ?>" onclick="conf_attr('<?= $data['User_ID'] ?>','<?= $data['Status'] ?>','<?= $no ?>')" style="display:none" value="ตกลง">
                                                        <input type="button" class='btn btn-sm btn-defualt' id="btn_canl<?= $no ?>" onclick="canl_attr('<?= $no ?>')" style="display:none" value="ยกเลิก">
                                                </td>
                                                <td>
                                                    <center> <input type="button" class="btn btn-sm btn-danger " onclick="del_user('<?= $data['User_ID'] ?>','<?= $no ?>')" value="ลบ"></center>
                                                </td>
                                                </tr>
                                            <?php
                                            $no++;
                                        }
                                            ?>
                        </table>
                            <div class="pagination-wrapper">
                                <div class="pagination">
                                    <span class="prev page-numbers">Page :</span>
                                    <?php
                                    if ($Prev_Page) {
                                        echo "<a class='prev page-numbers'href='manageuser.php?&nPage=$Prev_Page&perPage=$Per_Page'>prev</a>";
                                    }

                                    for ($i = 1; $i <= $Num_Pages; $i++) {
                                        if ($i != $Page) {
                                            echo " <a class='page-numbers' href='manageuser.php?&nPage=$i&perPage=$Per_Page'>$i</a>";
                                        } else {
                                            echo "<span aria-current='page' class='page-numbers current'> $i </span>";
                                        }
                                    }
                                    if ($Page != $Num_Pages) {
                                        echo "<a class='next page-numbers' href='manageuser.php?&nPage=$Next_Page&perPage=$Per_Page'>next</a>";
                                    }
                                    ?>
                                </div>
                            </div>
                    <?php
                    } else {
                    ?>
                        <a href="manageuser.php">
                            <h2><i class="fas fa-arrow-circle-left"></i><b>NOT FOUND</b></h2>
                        </a>
                    <?php
                    } ?>
                </div>
                <?php } ?>
                <div id="adduser_onlyone" class="tab-pane fade <?= (isset($_SESSION['user_status']) && $_SESSION['user_status']['Status'] != 0) ? "in active" : "" ?>">
                    <form id="add_single_user">
                        <fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em;">
                            <legend style="width: auto;padding:0 5px 0 5px;margin-bottom: 5px;">กรอกข้อมูลสมาชิก</legend>
                            <div class="col-md-6"></div>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-sm-1" for="pwd">ID:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" value="<?= $this_user_id ?>" id="run_user_id" name="run_user_id" disabled>
                                </div>
                                <label class="control-label col-sm-1" for="pwd">รหัสผู้ใช้:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="รหัสนักศึกษา/เลขบัตรประจำตัวประชาชน" required>
                                    <span id='valid_id_msg'></span>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-sm-1" for="pwd">ชื่อผู้ใช้:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="new_username" name="new_username" required>
                                    <span id='valid_user_msg'></span>
                                </div>
                                <label class="control-label col-sm-1" for="pwd">รหัสผ่าน:</label>
                                <div class="col-sm-3">
                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="รหัสผ่านสำหรับเข้าสู่ระบบ(password)" required>
                                </div>
                                <label class="control-label col-sm-1" for="pwd">ยืนยันรหัสผ่าน:</label>
                                <div class="col-sm-3">
                                    <input type="password" class="form-control" id="new_repeat_password" name="new_repeat_password" placeholder="กรอกรหัสผ่านสำหรับเข้าสู่ระบบอีกครั้ง(repeat-password)">
                                    <span id='validate_msg'></span>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-sm-1" for="pwd">ชื่อ:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="FName" name="FName" placeholder="ชื่อจริง" required>
                                </div>
                                <label class="control-label col-sm-1" for="pwd">นามสกุล:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="LName" name="LName" placeholder="นามสกุลจริง" required>
                                </div>
                                <label class="control-label col-sm-1" for="pwd">คณะ:</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="Facul" id="Facul">
                                        <option value="บริหารธุรกิจและศิลปศาสตร์" selected>บริหารธุรกิจและศิลปศาสตร์</option>
                                        <option value="วิทยาศาสตร์และเทคโนโลยีการเกษตร">วิทยาศาสตร์และเทคโนโลยีการเกษตร</option>
                                        <option value="วิศวกรรมศาสตร์">วิศวกรรมศาสตร์</option>
                                        <option value="ศิลปกรรมและสถาปัตยกรรมศาสตร์">ศิลปกรรมและสถาปัตยกรรมศาสตร์</option>
                                        <option value="วิทยาลัยเทคโนโลยีและสหวิทยาการ">วิทยาลัยเทคโนโลยีและสหวิทยาการ</option>
                                    </select>
                                    <!-- <input type="text" class="form-control" id="Facul" name="Facul"> -->
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-sm-1" for="pwd">สาขาวิชา:</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="Major" id="Major">
                                        <option value="ระบบสารสนเทศทางธุรกิจ">ระบบสารสนเทศทางธุรกิจ</option>
                                        <option value="การจัดการธุรกิจระหว่างประเทศ">การจัดการธุรกิจระหว่างประเทศ</option>
                                        <option value="บริหารธุรกิจ">บริหารธุรกิจ</option>
                                        <option value="บัญชี">บัญชี</option>
                                        <option value="ภาษาอังกฤษเพื่อการสื่อสารสากล">ภาษาอังกฤษเพื่อการสื่อสารสากล</option>
                                        <option value="การท่องเที่ยวและการบริการ">การท่องเที่ยวและการบริการ</option>
                                    </select>
                                    <!-- <input type="text" class="form-control" id="Major" name="Major"> -->
                                </div>

                                <label class="control-label col-sm-1" for="pwd">เบอร์มือถือ:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="tel" name="tel" placeholder="เบอร์มือถือที่สามารถติดต่อได้" required>
                                </div>
                                <label class="control-label col-sm-1" for="pwd">อีเมล์:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="mail" name="mail" placeholder="example@email.com" required>
                                    <span id='valid_email_msg'></span>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-sm-1" for="pwd">ที่อยู่:</label>
                                <div class="col-sm-3">
                                    <textarea class="form-control" id="addr" name="addr"></textarea>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div style="margin-left: 45%;">
                                        <input type="submit" class="btn btn-success" style="position: absolute;top: 50%;" id="submit_add_user" value="ลงทะเบียน">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                        </fieldset>
                    </form>
                </div>
                <div id="adduser_import" class="tab-pane fade">
                    <form id="upload_csv" method="post" enctype="multipart/form-data">
                        <fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em;">
                            <legend style="width: auto;padding:0 5px 0 5px;margin-bottom: 5px;">เพิ่มผู้ใช้แบบหลายรายการโดยการอัพโหลดไฟล์ .csv</legend>
                            <div class="col-md-6"></div>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="pwd">ดาวน์โหลดไฟล์แบบฟอร์มเทมเพลต:</label>
                                <div class="col-sm-3">
                                    <a href="../../assets/download/AddUserTemplate.csv" class="btn btn-primary" download>ดาวน์โหลดฟอร์ม</a>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="pwd">อัพโหลดไฟล์แบบฟอร์มที่เพิ่มข้อมูลแล้ว:</label>
                                <div class="col-sm-3">
                                    <input type="file" class="btn btn-white" name="book_file" style="border-width: 1px;border-color: #b1a5a5;display: inline;width:300;background-color: white;" />
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div style="margin-left: 45%;">
                                        <input type="submit" class="btn btn-success" style="position: absolute;top: 50%;" name="upload" id="upload" value="อัพโหลด">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                        </fieldset>
                    </form>
                </div>
            </div>

            <script language="javascript">
                window.onload = function() {
                    var a = document.getElementById('mytable'); // อ้างอิงตารางด้วยตัวแปร a
                    for (i = 0; i < a.rows.length; i++) { // วน Loop นับจำนวนแถวในตาราง
                        if (i > 0) { // ตรวจสอบถ้าไม่ใช่แถวหัวข้อ
                            if (i % 2 == 1) { // ตรวจสอบถ้าไม่ใช่แถวรายละเอียด
                                a.rows[i].className = "tr_odd"; // กำหนด class แถวแรก
                            } else {
                                a.rows[i].className = "tr_even"; // กำหนด class แถวที่สอง
                            }
                        } else { // ถ้าเป็นแถวหัวข้อกำหนด class
                            a.rows[i].className = "tr_head";
                        }
                    }
                }
            </script>
            <script>
                $('#Facul').on('change', function() {
                    var val = $(this).val();
                    var stack = '';
                    if (val == 'บริหารธุรกิจและศิลปศาสตร์') {
                        stack += '<option value="ระบบสารสนเทศทางธุรกิจ">ระบบสารสนเทศทางธุรกิจ</option>';
                        stack += '<option value="การจัดการธุรกิจระหว่างประเทศ">การจัดการธุรกิจระหว่างประเทศ</option>';
                        stack += '<option value="บริหารธุรกิจ">บริหารธุรกิจ</option>';
                        stack += '<option value="บัญชี">บัญชี</option>';
                        stack += '<option value="ภาษาอังกฤษเพื่อการสื่อสารสากล">ภาษาอังกฤษเพื่อการสื่อสารสากล</option>';
                        stack += '<option value="การท่องเที่ยวและการบริการ">การท่องเที่ยวและการบริการ</option>';
                    } else if (val == 'วิทยาศาสตร์และเทคโนโลยีการเกษตร') {
                        stack += '<option value="เทคโนโลยีสารสนเทศ">เทคโนโลยีสารสนเทศ</option>';
                        stack += '<option value="วิทยาการคอมพิวเตอร์">วิทยาการคอมพิวเตอร์</option>';
                        stack += '<option value="วิทยาศาสตร์และเทคโนโลยีการอาหาร">วิทยาศาสตร์และเทคโนโลยีการอาหาร</option>';
                        stack += '<option value="เครื่องจักรกลเกษตร">เครื่องจักรกลเกษตร</option>';
                        stack += '<option value="ธุรกิจอาหารและโภชนาการ">ธุรกิจอาหารและโภชนาการ</option>';
                        stack += '<option value="เกษตรศาสตร์">เกษตรศาสตร์</option>';
                    } else if (val == 'วิศวกรรมศาสตร์') {
                        stack += '<option value="วิศวกรรมเครื่องกล">วิศวกรรมเครื่องกล</option>';
                        stack += '<option value="วิศวกรรมเหมืองแร่">วิศวกรรมเหมืองแร่</option>';
                        stack += '<option value="วิศวกรรมเกษตรและชีวภาพ">วิศวกรรมเกษตรและชีวภาพ</option>';
                        stack += '<option value="วิศวกรรมคอมพิวเตอร์">วิศวกรรมคอมพิวเตอร์</option>';
                        stack += '<option value="วิศวกรรมไฟฟ้า">วิศวกรรมไฟฟ้า</option>';
                        stack += '<option value="วิศวกรรมอิเล็กทรอนิกส์และระบบควบคุมอัตโนมัติ">วิศวกรรมอิเล็กทรอนิกส์และระบบควบคุมอัตโนมัติ</option>';
                        stack += '<option value="วิศวกรรมโยธา">วิศวกรรมโยธา</option>';
                        stack += '<option value="วิศวกรรมสิ่งแวดล้อม">วิศวกรรมสิ่งแวดล้อม</option>';
                        stack += '<option value="วิศวกรรมอุตสาหการ">วิศวกรรมอุตสาหการ</option>';
                        stack += '<option value=" วิศวกรรมแม่พิมพ์"> วิศวกรรมแม่พิมพ์</option>';
                    } else if (val == 'ศิลปกรรมและสถาปัตยกรรมศาสตร์') {
                        stack += '<option value="เซรามิก">เซรามิก</option>';
                        stack += '<option value="เทคโนโลยีการพิมพ์และบรรจุภัณฑ์">เทคโนโลยีการพิมพ์และบรรจุภัณฑ์</option>';
                        stack += '<option value=" ออกแบบสื่อสาร"> ออกแบบสื่อสาร</option>';
                        stack += '<option value=" ออกแบบอุตสาหกรรม"> ออกแบบอุตสาหกรรม</option>';
                        stack += '<option value=" สิ่งทอและเครื่องประดับ"> สิ่งทอและเครื่องประดับ</option>';
                        stack += '<option value=" ทัศนศิลป์"> ทัศนศิลป์</option>';
                        stack += '<option value=" สถาปัตยกรรม"> สถาปัตยกรรม</option>';
                        stack += '<option value=" สถาปัตยกรรมภายใน"> สถาปัตยกรรมภายใน</option>';
                    } else if (val == 'วิทยาลัยเทคโนโลยีและสหวิทยาการ') {
                        stack += '<option value=" การผลิตและนวัตกรรมอาหาร"> การผลิตและนวัตกรรมอาหาร</option>';
                        stack += '<option value=" วิศวกรรมเมคคาทรอนิกส์"> วิศวกรรมเมคคาทรอนิกส์</option>';
                    }
                    $('#Major').html(stack);
                });
            </script>
        </div>
    </div>
    <footer>
        <div class="row">
            <span class="footer-divider"></span>
        </div>
        <div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #eee;">
            <div class="col-md-4 col-sm-12" id="vertical-line">
                <div class="col-md-12">
                    <img src="<?=$url_path?>assets/upload/logo/web_footer_20170911140318.png" class="rmutl-web-logo-footer img-responsive">
                </div>
                <div class="col-md-12 footer-about-text text-center">
                    ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา<br>
                    <span class="footer-span-comment">"มทร.ล้านนา"</span>
                </div>

            </div>
            <div class="col-md-8 col-sm-12">
                <div class="list-text-footer row">

                    <div class="address-text-fooster col-md-12">
                        ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา : 128 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่ 50300<br>
                        โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183 </div>

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
            <script src="<?=$url_path?>assets/js/jquery.dcjqaccordion.min.js" type="text/javascript"></script>
            <script src="<?=$url_path?>assets/js/owl.carousel.min.js" type="text/javascript"></script>
            <script src="<?=$url_path?>assets/js/home.min.js" type="text/javascript"></script>

            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-87588904-9"></script>
            <script src="/lib/script/search.js"></script>
            <script src="/lib/script/manageuser.js"></script>
            <script src="/lib/assets/js/validate.min.js"></script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments)
                };
                gtag('js', new Date());

                gtag('config', 'UA-87588904-9');
            </script>

            <?php
            include_once "../../layout/End.php";
