<br>
           <br>   <br>
           <?php
$username = $_SESSION['user_status']['Username'];
$result = $conn->query("SELECT * FROM member WHERE Username = '$username' ");
$num = mysqli_num_rows($result);
if ($num != 0) {
    while ($showdata = mysqli_fetch_assoc($result)) {?>

    <div hidden class="StatusBox alert alert-success alert-dismissible fade in">
        <span id="msgBox"></span>
        <input hidden type="button" id="close_box" class="close" value="&times;">
    </div>
    <fieldset style="border: 2px solid silver;margin: 0 2px;padding: .625em .625em 5.75em; background-color: #eee;">
				<legend style="width: auto;padding:0 5px 0 5px;">รายละเอียดสมาชิก</legend>
			
    <div class="form-group">
    <form action="" method="post"  >
        <div id="" class="col-sm-12" >
            <label  class="control-label col-sm-2"  for="pwd">ชื่อจริง:</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" value="<?php echo $showdata['FName'] ?>" id="FName" name="FName" disabled="disabled">
            </div>
            <div  class="col-sm-2" >
            <input type="button" class="btn btn-primary btn-sm" value="เปลี่ยน" id="chnFName">
            </div>
            <div  class="col-sm-4" >
            <input style="display:none;" type="button"  value="บันทึก" id="savFName" onclick="save_fname()">
            <input style="display:none;" type="button" value="ยกเลิก" id="unsFName"></div>
     </div>
        </div>
        <br>
           <br>
           <br>
           <div id="" class="col-sm-12" >
            <label   class="control-label col-sm-2"  for="pwd">นามสกุล:</label>
            <div class="col-sm-6">
            <input type="text"  class="form-control" value="<?php echo $showdata['LName'] ?>" id="LName" name="LName" disabled="disabled">
            </div>
            <div  class="col-sm-2" >
           <input type="button" class="btn btn-primary btn-sm" value="เปลี่ยน" id="chnLName">
           </div>
            <div  class="col-sm-4" >
            <input style="display:none;" type="button" value="บันทึก" id="savLName" onclick="save_lname()">
            <input style="display:none;" type="button" value="ยกเลิก" id="unsLName">
        </div>
        </div>
        <br>
           <br>
           
           <br>
           <br>
        <div id="" class="col-sm-12" >
            <label  class="control-label col-sm-2"   for="pwd">อีเมล์:</label>
            <div class="col-sm-6">
            <input type="text"  class="form-control" value="<?php echo $showdata['Email'] ?>" id="Email" name="Email" disabled="disabled">
            </div>
            <div  class="col-sm-2">
            <input type="button" class="btn btn-primary btn-sm"  value="เปลี่ยน" id="chnEmail">
            </div>
            <div  class="col-sm-4" >
            <input style="display:none;" type="button" value="บันทึก" id="savEmail" onclick="save_email()">
            <input style="display:none;" type="button" value="ยกเลิก" id="unsEmail">
        </div>
    </form>
</div>
<?php

    }
} else {
    echo '<h2>ไม่สามารถแก้ไขข้อมูลได้</h2>';
}

?>
<script type="text/javascript">
    var fname = $("#FName").val();
    var lname = $("#LName").val();
    var email = $("#Email").val();
    $(document).on("click", "#chnFName", function() {
        $("#FName").prop('disabled', false);
        $(this).hide();
        $("#savFName").show();
        $("#unsFName").show();
    });
    $(document).on("click", "#chnLName", function() {
        $("#LName").prop('disabled', false);
        $(this).hide();
        $("#savLName").show();
        $("#unsLName").show();
    });
    $(document).on("click", "#chnEmail", function() {
        $("#Email").prop('disabled', false);
        $(this).hide();
        $("#savEmail").show();
        $("#unsEmail").show();
    });

    $("#unsFName").click(function() {
        $("#FName").val(fname);
        $("#FName").prop('disabled', true);
        $(this).hide();
        $("#savFName").hide();
        $("#chnFName").show();
    });
    $("#unsLName").click(function() {
        $("#LName").val(lname);
        $("#LName").prop('disabled', true);
        $(this).hide();
        $("#savLName").hide();
        $("#chnLName").show();
    });
    $("#unsEmail").click(function() {
        $("#Email").val(email);
        $("#Email").prop('disabled', true);
        $(this).hide();
        $("#savEmail").hide();
        $("#chnEmail").show();
    });

    $("#close_box").click(function() {
        $('.StatusBox').hide();
    });

    function save_fname() {
        var get_fname = $("#FName").val();
        $.ajax({
            url: "member_Menu/go_save.php",
            data: {
                FName: get_fname,
            },
            type: "POST",
            success: function(data) {
                console.log(data);
                fname = get_fname;
                $("#msgBox").html(data);
                $("#FName").prop('disabled', true);
                $("#unsFName").hide();
                $("#savFName").hide();
                $("#chnFName").show();
                $("#close_box").show();
                $(".StatusBox").show();
            },
            error: function(e) {
                alert("มีข้อผิดพลาดบางอย่าง");
            }
        });
    }

    function save_lname() {
        var get_lname = $("#LName").val();
        $.ajax({
            url: "member_Menu/go_save.php",
            data: {
                LName: get_lname,
            },
            type: "POST",
            success: function(data) {
                console.log(data);
                lname = get_lname;
                $("#msgBox").html(data);
                $("#LName").prop('disabled', true);
                $("#unsLName").hide();
                $("#savLName").hide();
                $("#chnLName").show();
                $("#close_box").show();
                $(".StatusBox").show();
            },
            error: function(e) {
                alert("มีข้อผิดพลาดบางอย่าง");
            }
        });
    }

    function save_email() {
        var get_email = $("#Email").val();
        $.ajax({
            url: "member_Menu/go_save.php",
            data: {
                Email: get_email,
            },
            type: "POST",
            success: function(data) {
                console.log(data);
                email = get_email;
                $("#msgBox").html(data);
                $("#Email").prop('disabled', true);
                $("#unsEmail").hide();
                $("#savEmail").hide();
                $("#chnEmail").show();
                $("#close_box").show();
                $(".StatusBox").show();
            },
            error: function(e) {
                alert("มีข้อผิดพลาดบางอย่าง");
            }
        });
    }
</script>