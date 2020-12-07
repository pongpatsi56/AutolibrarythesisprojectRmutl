<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
?>
<style>
    .lds-ring {
        display: inline-block;
        position: relative;
        width: 0px;
        height: 0px;
    }

    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 23px;
        height: 23px;
        /* margin: 20px; */
        margin-left: 95px;
        margin-top: 20px;
        border: 5px solid #989898;
        border-radius: 50%;
        animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: #989898 transparent transparent transparent;
    }

    .lds-ring div:nth-child(1) {
        animation-delay: -0.45s;
    }

    .lds-ring div:nth-child(2) {
        animation-delay: -0.3s;
    }

    .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }

    @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<div class="container" style="padding-top:100px">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="background-color:#c1baba85;border-style:outset;border-width:4px;border-color:FFFFCC;">
            <div>
                <span style="display:none" class="lds-ring">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </span>
                <h3 align="center" style=" font-family:kanit;"><span class='fas fa-user' > </span> RMUTL </h3>
            </div>
            <form name="formlogin" action="" method="POST" id="login" class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="username" id="username" class="form-control" name="username" placeholder="Username" value="">
                        <span align="center" hidden class="text-danger col-sm-12" id="validuser"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="password" id='password' class="form-control" name="password" placeholder="Password" value="">
                    </div>
                    <span align="center" hidden class="text-danger col-sm-12" id="validpass"></span>
                    <span align="center" hidden class="text-danger col-sm-12" id="valid"></span>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="button" class="btn btn-primary" id="btn" style=" font-family:kanit;" value="ล็อกอิน">
                        <!-- <button type="submit" class="btn btn-primary" id="btn">
                            <span class='fas fa-lock'> </span>
                            Login </button> -->
                    </div>
                </div>
                <center>
                    <p align="center" style=" font-family:kanit;"> หากไม่สามารถเข้าใช้งานได้ กรุณาติดต่อเจ้าหน้าที่บริการ<br>ตอบคำถามและช่วยค้นคว้า Tel 0-5392-1444 ต่อ 1330-4</p>
            </form>
        </div>
    </div>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    var typeuser = <?= isset($_SESSION['user_status']) ? json_encode($_SESSION['user_status']) : '0'; ?>;
    console.log(typeuser);
    if (typeuser != '0') {
        if (typeuser['Status'] == 2) {
            window.location = "/lib/view/member/member.php";
        }
        if (typeuser['Status'] == 1 || typeuser['Status'] == 0) {
            window.location = "/lib/view/librarian/librarian.php";
        }
    }

    function validate() {
        var user = document.getElementById("username").value;
        var pass = document.getElementById("password").value;
        var IsResult = true;
        if ((user == "") || (user == "Username")) {
            $("#validuser").hide().html('โปรดระบุชื่อผู้ใช้').fadeIn();
            IsResult = false;
        }
        if ((pass == "") || (pass == "Password")) {
            $("#validpass").hide().html('โปรดระบุรหัสผ่าน').fadeIn();
            IsResult = false;
        }
        return IsResult;
    }
    $(document).on("click", "#btn", function() {
        $(".lds-ring").show();
        $("#validuser").hide();
        $("#validpass").hide();
        $("#valid").hide();
        if (validate()) {
            var user = $("#username").val();
            var pass = $("#password").val();
            $.ajax({
                url: "/lib/controller/login/UserLogin.php",
                data: {
                    username: user,
                    password: pass
                },
                dataType: "json",
                type: "POST",
                success: function(data) {
                    console.log(data);
                    if (data['IsResult'] == true) {
                        if (data['Status'] == 2) {
                            window.location = "/lib/view/member/member.php";
                        }
                        if (data['Status'] == 1 || data['Status'] == 0) {
                            window.location = "/lib/view/librarian/librarian.php";
                        }
                    } else {
                        $(".lds-ring").hide();
                        $("#valid").hide().html(data['ermsg']).fadeIn();
                    }
                },
                error: function(e) {
                    console.log(e);
                    alert("something wrong");
                }
            });
        } else {
            $(".lds-ring").hide();
        }
    });

    var inputuser = document.getElementById("username");
    inputuser.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("password").focus();
        }
    });

    var input = document.getElementById("password");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("btn").click();
        }
    });
</script>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";
?>