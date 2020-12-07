<style>
    .font13 {
        font-size: 13px;
    }

    .tdhei34 {
        height: 34px;
    }
</style>
<?php
include_once "../../include/connect.php";
$gettype = $_POST['searchtype'];
if ($gettype == 'basic') {
    ?>
    <table class="table">
        <tbody>
            <tr class="section">
                <td class="section-title">คำค้น</td>
                <td class="section-title" style="display: table-cell;width: -webkit-fill-available;">ประเภท</td>
            </tr>
            <tr>
                <td style="width: 500px;">
                    <input type="text" id="text_resurce" class="btn btn-white" style="border:1px solid darkgray;width: -webkit-fill-available;">
                </td>
                <td>
                    <select name="type_resource" id="type_resource" class="btn btn-white" style="border:1px solid darkgray;width: -webkit-fill-available;height: 34px;">
                        <option value="KEYWORD">ทั้งหมด</option>
                        <option value="TITLE">ชื่อเรื่อง</option>
                        <option value="AUTHOR">ชื่อผู้แต่ง</option>
                        <option value="ISBNISSN">ISBN/ISSN</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" onclick="Basic_go()" id="btnsearch" class="btn btn-info" value="ค้นหา">
                    <button type="reset" class="btn btn-default">ล้างค่า</button>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
<?php
} elseif ($gettype == 'advance') {
    $datalocal = array();
    $num = 0;
    $localdata = mysqli_query($conn, "SELECT Subfield FROM databib WHERE Field = 951 GROUP BY Subfield");
    if (mysqli_num_rows($localdata)) {
        while ($result = mysqli_fetch_assoc($localdata)) {
            $tempvalue = explode("#a=", $result['Subfield']);
            $datalocal[$num] = $tempvalue[1];
            $num++;
        }
    }
    ?>
    <table class="table">
        <tbody>
            <tr class="section">
                <td class="section-title">คำค้น</td>
                <td class="section-title" style="display: table-cell;width: -webkit-fill-available;">ประเภท</td>
            </tr>
            <tr>
                <td style="width: 500px;">
                    <input type="text" id="text_resurce" class="btn btn-white" style="border:1px solid darkgray;width: -webkit-fill-available;" placeholder="โปรดระบุ">
                </td>
                <td>
                    <select name="type_resource" id="type_resource" class="btn btn-white" style="border:1px solid darkgray;width: -webkit-fill-available;height: 34px;">
                        <!-- <option value="KEYWORD">ทั้งหมด</option> -->
                        <option value="TITLE">ชื่อเรื่อง</option>
                        <option value="AUTHOR">ชื่อผู้แต่ง</option>
                        <option value="ISBNISSN">ISBN/ISSN</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr class="section">
                <td class="section-title tdhei34">จำกัดการสืบค้น</td>
                <td></td>
            </tr>
            <tr class="font13">
                <td style="vertical-align: middle;padding-left: 15px;">
                    ประเภทแหล่งที่มา
                </td>
                <td>
                    <select name="source_type" id="source_type" class="btn btn-white" style="border:1px solid darkgray;width: -webkit-fill-available; height: 34px;">
                        <option selected value="true">ทุกประเภท</option>
                        <option value="">-</option>
                        <option value="">-</option>
                    </select>
                </td>
            </tr>

            <tr class="font13">

                <td style="vertical-align: middle;padding-left: 15px;">
                    สาขาห้องสมุด
                </td>
                <td>
                    <select name="source_locate" id="source_locate" class="btn btn-white" style="border:1px solid darkgray;width: -webkit-fill-available; height: 34px;">
                        <option selected value="">ทุกสาขา</option>
                        <?php foreach ($datalocal as $locate) {
                                ?>
                            <option value="<?= $locate ?>"><?= $locate ?></option>
                        <?php
                            }
                            ?>
                    </select>
                </td>
            </tr>
            <!-- <tr class="font13">
                    <td style="vertical-align: middle;padding-left: 15px;">
                    ภาษา	
                    </td>
                    <td>
                            <select name="" id="" class="btn btn-white" style="border:1px solid darkgray;width: -webkit-fill-available; height: 34px;">
                                <option selected value="">ทุกภาษา</option>
                                <option value="">-</option>
                                <option value="">-</option>
                            </select>
                    </td>
                </tr> -->
            <tr class="font13">
                <td style="vertical-align: middle;padding-left: 15px;">
                    ปีที่เริ่ม
                </td>
                <td>
                    <input type="text" id="year_start" class="btn btn-white" style="border:1px solid darkgray;width: -webkit-fill-available;" placeholder="โปรดระบุ">
                </td>
            </tr>
            <tr class="font13">
                <td style="vertical-align: middle;padding-left: 15px;">
                    ปีที่สิ้นสุด
                </td>
                <td>
                    <input type="text" id="year_end" class="btn btn-white" style="border:1px solid darkgray;width: -webkit-fill-available;" placeholder="โปรดระบุ">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" onclick="Advan_go()" class="btn btn-info" value="ค้นหา">
                    <button type="reset" class="btn btn-default">ล้างค่า</button>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
<?php
} elseif ($gettype == 'alphabeticsearch') { ?>
    <p>การสืบค้นตามลำดับตัวอักษร คือ การสืบค้นคำหรือข้อความที่ต้องการตามลำดับตัวอักษรจาก ชื่อเรื่อง ชื่อผู้แต่ง หัวเรื่อง และชื่อวารสาร</p>
    <table class="table">
        <tbody>
            <tr class="section">
                <td class="section-title">คำค้น</td>
                <td class="section-title" style="display: table-cell;width: -webkit-fill-available;">ประเภท</td>
            </tr>
            <tr>
                <td style="width: 500px;">
                    <input type="text" class="btn btn-white" style="border:1px solid darkgray;width: -webkit-fill-available;">
                </td>
                <td>
                    <select name="" id="" class="btn btn-white" style="border:1px solid darkgray;width: -webkit-fill-available;height: 34px;">
                        <option value="">ชื่อเรื่อง</option>
                        <option value="">ชื่อผู้แต่ง</option>
                        <option value="">ISBN/ISSN</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" onclick="Alpha_go()" class="btn btn-info" value="ค้นหา">
                    <button type="reset" class="btn btn-default">ล้างค่า</button>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
<?php
}
?>