$("#new_password, #new_repeat_password").on("keyup", function () {
  if ($("#new_password").val() == $("#new_repeat_password").val()) {
    $("#validate_msg").html("รหัสผ่านตรงกัน").css("color", "green");
  } else $("#validate_msg").html("รหัสผ่านไม่ตรงกัน").css("color", "red").css();
});

$("#new_username").on("keyup", function () {
  var check_username = $("#new_username").val();
  if (check_username == "") {
    $("#valid_user_msg").html("กรุณากรอกชื่อผู้ใช้").css("color", "red");
  } else {
    $.ajax({
      url: "check_exists.php",
      dataType: "json",
      data: {
        check: "user",
        username: check_username,
      },
      type: "POST",
      success: function (res) {
        // console.log(res);
        if (res == "0") {
          $("#valid_user_msg")
            .html("สามารถใช้ชื่อผู้ใช้นี้ได้")
            .css("color", "green");
        } else if (res == "1") {
          $("#valid_user_msg").html("มีชื่อผู้ใช้นี้แล้ว").css("color", "red");
        }
      },
      error: function (e) {
        console.log(e);
      },
    });
  }
});
$("#user_id").on("keyup", function () {
  var check_id = $("#user_id").val();
  if (check_id == "") {
    $("#valid_id_msg").html("กรุณากรอกรหัสผู้ใช้").css("color", "red");
  } else {
    $.ajax({
      url: "check_exists.php",
      dataType: "json",
      data: {
        check: "id",
        id: check_id,
      },
      type: "POST",
      success: function (res) {
        // console.log(res);
        if (res == "0") {
          $("#valid_id_msg")
            .html("สามารถใช้รหัสผู้ใช้นี้ได้")
            .css("color", "green");
        } else if (res == "1") {
          $("#valid_id_msg").html("มีรหัสผู้ใช้นี้แล้ว").css("color", "red");
        }
      },
      error: function (e) {
        console.log(e);
      },
    });
  }
});
$("#mail").on("keyup", function () {
  var check_email = $("#mail").val();
  if (check_email == "") {
    $("#valid_email_msg").html("กรุณากรอกอีเมล์").css("color", "red");
  } else {
    $.ajax({
      url: "check_exists.php",
      dataType: "json",
      data: {
        check: "email",
        email: check_email,
      },
      type: "POST",
      success: function (res) {
        // console.log(res);
        if (res == "0") {
          $("#valid_email_msg")
            .html("สามารถใช้อีเมล์นี้ได้")
            .css("color", "green");
        } else if (res == "1") {
          $("#valid_email_msg").html("มีอีเมล์นี้แล้ว").css("color", "red");
        }
      },
      error: function (e) {
        console.log(e);
      },
    });
  }
});

$("#add_single_user").on("submit", function (e) {
    e.preventDefault();
  var uid = $("#user_id").val();
  var usn = $("#new_username").val();
  var pwd = $("#new_password").val();
  var fnm = $("#FName").val();
  var lnm = $("#LName").val();
  var fac = $("#Facul").val();
  var maj = $("#Major").val();
  var tel = $("#tel").val();
  var mal = $("#mail").val();
  var adr = $("#addr").val();
  if ((uid != "") & (usn != "") & (pwd != "") & (mal != "") & (tel != "")) {
    $.ajax({
      url: "add_single_user.php",
      dataType: "json",
      data: {
        user_id: uid,
        new_username: usn,
        new_password: pwd,
        FName: fnm,
        LName: lnm,
        Facul: fac,
        Major: maj,
        tel: tel,
        mail: mal,
        addr: adr,
      },
      type: "POST",
      success: function (res) {
        console.log(res);
        if (res == "1") {
          alert("บันทึกสำเร็จ!");
          setTimeout(function () {
            window.location.reload();
          }, 2000);
        }
      },
      error: function (e) {
        console.log(e);
        alert("something wrong!");
      },
    });
  } else {
    alert("โปรดกรอกข้อมูลให้ครบถ้วน");
  }
});

// $(function () {
//   var validateForm = $("#add_single_user");
//   if (validateForm.length) {
//     validateForm.validate({
//       rules: { new_username: { required: true } },
//       messages: { new_username: { required: "กรุณากรอกชื่อผู้ใช้" } },
//     });
//   }
// });

$("#upload_csv").on("submit", function (e) {
  e.preventDefault(); //form will not submitted
  $.ajax({
    url: "add_user.php",
    method: "POST",
    data: new FormData(this),
    contentType: false, // The content type used when sending data to the server.
    cache: false, // To unable request pages to be cached
    processData: false, // To send DOMDocument or non processed data file it is set to false
    success: function (data) {
      //  console.log(data)
      alert("บันทึกสำเร็จ");
      location.reload();
    },
  });
});
