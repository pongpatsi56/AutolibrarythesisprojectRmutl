<style>
    /***********************************badge*************************************/
    a:hover .badge {
        background-color: #dddddd;
    }

    /********************************************************************************/


    ul.v_meu {
        list-style-type: none;
        margin: 3px;
        padding: 1px;
        background-color: #afaeae;
        border: 2px solid #555;
        font-family: 'kanit', sans-serif;
        font-size: 15px;
        border-radius: 15px;
    }

    li a {
        display: block;
        color: #000;
        padding: 8px 16px;
        text-decoration: none;
    }

    li {
        border-bottom: 2px solid #555;
    }

    li:last-child {
        border-bottom: none;
    }

    li a.active {
        background-color: #2b2a28;
        color: white;
        border-radius: 15px 15px 0px 0px;
    }

    li a:hover:not(.active) {
        background-color: #f7f4f4;
        color: black;
    }
</style>
<br>
<br>
<center><img src="<?= isset($row['img']) && $row['img'] != "" ? "../../imgmember/" . $row['img'] : "../../img/no-pic.jpg"; ?>" width="150px" height="170px" style=";border-style:outset;border-width:2px;">
    <button class="btn btn-link"> <?php echo $row['FName'] . '  ' . $row['LName']; ?></button>

    <br>
    <br>
    <ul style="border:1px solid black">
        <div class="panel-header-rmutl">

            <span class="big-header-link">MENU</span> <span class="sub-header-link">เมนู</span>

        </div>
        <li><a href="member.php?Menu=brwnrt">รายการยืมและกำหนดส่ง <div class="badge"><?= $countbnr['num'] = $countbnr['num'] == '0' ? '' : $countbnr['num'] ?></div></a></li>
        <li><a href="member.php?Menu=reserv">รายการจอง <div class="badge"><?= $countrsvt['num'] = $countrsvt['num'] == '0' ? '' : $countrsvt['num'] ?></div></a></li>
        <li><a href="member.php?Menu=finebk">รายการค่าปรับ <div class="badge"><?= $countfnbk['num'] = $countfnbk['num'] == '0' ? '' : $countfnbk['num'] ?></div></a></li>
        <!-- <li><a href="#">รายการขอยืมข้ามสาขา</a></li> -->
        <!-- <li><a href="member.php?Menu=missd">รายการแจ้งหาย <div class="badge">99+</div></a></li> -->
        <!-- <li><a href="#">รายการบล็อก</a></li> -->
        <li><a href="member.php?Menu=brwnrt_his">ประวัติการยืมคืน <div class="badge"><?= $countbnr_his['num'] = $countbnr_his['num'] == '0' ? '' : $countbnr_his['num'] ?></div></a></li>
        <!-- <li><a href="#">แท็ก</a></li> -->
        <!-- <li><a href="#">ทรัพยากรของฉัน</a></li> -->
        <!-- <li><a href="#">My Reviews</a></li> -->
        <!-- <li><a href="#">แนะนำทรัพยากรฯ</a></li> -->
        <li><a href="member.php?Menu=edit_profile">แก้ไขข้อมูลส่วนตัว </a></li>