function showcart() {
  window.open(
    "/lib/view/search/show_cart.php",
    " ",
    "scrollbars=yes,top=30,left=100,width=1000,height=600"
  );
}

function confirm_cart() {
  window.location.assign("/lib/model/session/confirm.php");
}
function clear_cart() {
  var r = confirm("You Sure?");
  if (r == true) {
    window.location.assign("/lib/model/session/clearcart.php");
  }
}

// function confirm() {
//   var chk_confirm = window.location.assign('/lib/model/session/confirm.php');
//   if (chk_confirm) {
//     alert('บันทึกสำเร็จ ... '); window.location = '/lib/view/search/main.php';
//   } else {
//     alert('ไม่พบข้อมูลหนังสือที่ต้องการจอง'); window.location = '/lib/view/search/main.php';
//   }
//   window.close();
// }

function addcart(numisbn) {
  $.ajax({
    url: "/lib/model/session/add_cart.php",
    data: {
      ISBN: numisbn
    },
    type: "GET",
    success: function(data) {
      console.log(data);
      if (data.IsResult == true) {
        window.location = "/lib/view/search/main.php";
      }
    },
    error: function(e) {
      alert("มีข้อผิดพลาดบางอย่าง");
    }
  });
}

function do_addcart(ident, title, author) {
  $.ajax({
    url: "/lib/model/session/add_cart.php",
    data: {
      ident: ident,
      author: author,
      title: title
    },
    type: "POST",
    success: function(data) {
      console.log(data);
      window.location.reload();
    },
    error: function(e) {
      alert("something wrong!");
    }
  });
}
function do_delcart(ident) {
  $.ajax({
    url: "/lib/model/session/remove_cart.php",
    data: {
      ident: ident
    },
    type: "POST",
    success: function(data) {
      console.log(data);
      window.location.reload();
    },
    error: function(e) {
      alert("something wrong!");
    }
  });
}
function do_clrcart() {
  var r = confirm("ต้องการเคลียร์ข้อมูลหรือไม่?");
  if (r) {
    $.ajax({
      url: "/lib/model/session/clearcart.php",
      success: function(res) {
        console.log(res);
        window.location.reload();
      },
      error: function(e) {
        console.log(e);
        alert("something wrong!");
      }
    });
  }
  // window.location.reload();
}
function cancel_rsvt(id, book, rsvt, reciv) {
  var r = confirm("ต้องการยกเลิกการจองหรือไม่?");
  if (r) {
    $.ajax({
      url: "/lib/model/ReservationModel.php",
      dataType: "json",
      data: {
        id: id,
        book: book,
        rsvt: rsvt,
        reciv: reciv
      },
      type: "POST",
      success: function(res) {
        console.log(res);
        alert(res);
        window.location.reload();
      },
      error: function(e) {
        console.log(e);
        alert("something wrong!");
      }
    });
  }
  // window.location.reload();
}
$(document).on("click", "#gosearch", function() {
  var idmember = $("#text_member").val();
  $.ajax({
    url: "/lib/model/ReservationModel.php",
    dataType: "json",
    data: {
      idmem: idmember
    },
    type: "POST",
    success: function(data) {
      console.log(data);
      if (data === null) {
        alert("ไม่พบข้อมูลสมาชิก");
        clear_data();
      } else {
        $("#FName").val(data["FName"]);
        $("#LName").val(data["LName"]);
        $("#Facul").val(data["Faculty"]);
        $("#Major").val(data["Major"]);
        $("#tel").val(data["Tel"]);
        $("#mail").val(data["Email"]);
        $("#addr").val(data["Address"]);
      }
    },
    error: function(e) {
      console.log(e);
      alert("something wrong!");
    }
  });
});
$(document).on("click", "#searh_res", function() {
  var barcode = $("#text_resource").val();
  $.ajax({
    url: "/lib/model/ReservationModel.php",
    dataType: "json",
    data: {
      bcode: barcode
    },
    type: "POST",
    success: function(res) {
      console.log(res);
      if (res === false) {
        alert("ไม่พบข้อมูลทรับยากร");
      } else {
        $("#resource_name").val(res["name"]);
        $("#resource_type").val(res["type"]);
        $("#get_date_show").val(res["rcvdateshow"]);
        $("#get_date")
          .val(res["rcvdate"])
          .hide();
        $("#tbody").html(res["datatable"]);
        $("#text_resource").val("");
      }
    },
    error: function(e) {
      console.log(e);
      alert("ไม่พบข้อมูลทรับยากร");
        $("#text_resource").val("");
    }
  });
});
$(document).on("click", "#gosave_resv", function() {
  if (!$("#text_member").val()) {
    alert("โปรดกรอกข้อมูลสมาชิก");
  } else if (!$("#text_resource").val()) {
    alert("โปรดกรอกข้อมูลหนังสือ");
  } else {
    var userid = $("#text_member").val();
    var datapost = [
      {
        barcode: $("#text_resource").val(),
        reciv: $("#get_date").val()
      }
    ];
    $.ajax({
      url: "/lib/model/session/confirm.php",
      data: {
        id: userid,
        datacart: datapost
      },
      type: "POST",
      success: function(res) {
        console.log(res);
        alert(res);
        clear_res();
      },
      error: function(e) {
        console.log(e);
        alert("something wrong!");
      }
    });
  }
});
var enterpress = document.getElementById("text_member");
if (enterpress) {
  enterpress.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      document.getElementById("gosearch").click();
    }
  });
}
var enterres = document.getElementById("text_resource");
if (enterres) {
  enterres.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      document.getElementById("searh_res").click();
    }
  });
}

function clear_data() {
  $("#FName").val("");
  $("#LName").val("");
  $("#Facul").val("");
  $("#Major").val("");
  $("#tel").val("");
  $("#mail").val("");
  $("#addr").val("");
}

function clear_res() {
  $("#text_resource").val("");
  $("#resource_name").val("");
  $("#resource_type").val("");
  $("#get_date_show").val("");
  $("#get_date").val("");
  $("#tbody").html("<td>-</td><td>-</td><td>-</td><td>-</td>");
}
