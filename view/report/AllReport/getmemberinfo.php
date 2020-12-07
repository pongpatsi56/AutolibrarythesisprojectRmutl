<?php
include "../../../include/connect.php";
$getkeyword = $_POST['meminfo'];
$gettype = $_POST['memtype'];
if ($gettype == 'Member') {
    $sql = mysqli_query($conn, "SELECT ID,FName,LName,Faculty,Major,Email FROM member WHERE member.ID LIKE '%$getkeyword%' OR member.FName LIKE '%$getkeyword%' OR member.LName LIKE '%$getkeyword%'");
    $num = mysqli_num_rows($sql);
    if ($num != 0) { ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">รหัส</div>
                <div class="col-md-3">ชื่อ - สกุล</div>
                <div class="col-md-2">คณะวิชา</div>
                <div class="col-md-2">สาขาวิชา</div>
                <div class="col-md-2">อีเมล์</div>
                <div class="col-xs-1"></div>
            </div>
            <tbody>
                <?php
                        while ($data = mysqli_fetch_assoc($sql)) {
                            $stack = '<div class="row">';
                            $stack .= '<div class="col-md-2">' . $data['ID'] . '</div>';
                            $stack .= '<div class="col-md-3">' . $data['FName'] . ' ' . $data['LName'] . '</div>';
                            $stack .= '<div class="col-md-2">' . $data['Faculty'] . '</div>';
                            $stack .= '<div class="col-md-2">' . $data['Major'] . '</div>';
                            $stack .= '<div class="col-md-2">' . $data['Email'] . '</div>';
                            $idenuser = "'" . $data['ID'] . "','" . $data['FName'] . ' ' . $data['LName'] . "'";
                            $stack .= '<div class="col-xs-1 btn btn-success btn-sm" onclick="pickuser(' . $idenuser . ')">เลือก</div>';
                            $stack .= '</div>';
                            echo $stack;
                        }
                        echo '</tbody></div>';
                    } else {
                        echo '<h3>ไม่พบข้อมูลสมาชิก</h3>';
                    }
                }
                if ($gettype == 'Staff') {
                    $sql = mysqli_query($conn, "SELECT ID,FName,LName,Email FROM librarian WHERE librarian.ID LIKE '%$getkeyword%' OR librarian.FName LIKE '%$getkeyword%' OR librarian.LName LIKE '%$getkeyword%'");
                    if (mysqli_num_rows($sql)) { ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">รหัส</div>
                        <div class="col-md-3">ชื่อ - สกุล</div>
                        <div class="col-md-4">อีเมล์</div>
                        <div class="col-xs-1"></div>
                    </div>
            <?php while ($data = mysqli_fetch_assoc($sql)) {
                        $stack = '<div class="row">';
                        $stack .= '<div class="col-md-3">' . $data['ID'] . '</div>';
                        $stack .= '<div class="col-md-3">' . $data['FName'] . ' ' . $data['LName'] . '</div>';
                        $stack .= '<div class="col-md-4">' . $data['Email'] . '</div>';
                        $idenuser = "'" . $data['ID'] . "','" . $data['FName'] . ' ' . $data['LName'] . "'";
                        $stack .= '<div class="col-xs-1 btn btn-success btn-sm" onclick="pickuser(' . $idenuser . ')">เลือก</div>';
                        $stack .= '</div>';
                        echo $stack;
                    }
                    echo '</div>';
                } else {
                    echo '<h3>ไม่พบข้อมูลบุคลากร</h3>';
                }
            }

            ?>