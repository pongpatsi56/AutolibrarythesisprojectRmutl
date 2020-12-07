window.dataLayer = window.dataLayer || [];
function gtag() {
  dataLayer.push(arguments);
}
gtag("js", new Date());
gtag("config", "UA-87588904-9");

function gosearch(type) {
  // alert(type);
  $.ajax({
    url: "controller/search/SearchContent.php",
    data: {
      searchtype: type
    },
    type: "POST",
    success: function(data) {
      console.log(data);
      $("#content").html(data);
    },
    error: function(e) {
      console.log(e);
      alert("something wrong!");
    }
  });
}
function Basic_go() {
  var getNtt = $("#text_resurce").val();
  var getNtk = $("#type_resource").val();
  window.location.replace(
    "/lib/controller/search/Result.php?Ntk=" +
      getNtk +
      "&Ntt=" +
      getNtt +
      "&nPage=1" +
      "&perPage=15"
  );
  // $.ajax({
  //     url: "controller/search/Result.php?Ntk=" + getNtk + "?Ntt=" + getNtt,
  //     type: "GET",
  //     // cache: false,
  //     success: function(data){
  //         console.log(data);
  //         $("#bodycontainer").html(data);

  //     },error:function(e){
  //         console.log(e);
  //         alert("something wrong!");
  //     }
  // });
}
function Advan_go() {
  var getNtt = $("#text_resurce").val();
  var getNtk = $("#type_resource").val();
  var getSType = $("#source_type").val();
  var getLocate = $("#source_locate").val();
  var getyearstart = $("#year_start").val();
  var getyearend = $("#year_end").val();
  window.location.replace(
    "/lib/controller/search/Result.php?Ntk=" +
      getNtk +
      "&Ntt=" +
      getNtt +
      "&Stype=" +
      getSType +
      "&Local=" +
      getLocate +
      "&Yrst=" +
      getyearstart +
      "&Yren=" +
      getyearend +
      "&nPage=1" +
      "&perPage=15"
  );
}
function Alpha_go() {
  var getNtt = $("#text_resurce").val();
  var getNtk = $("#type_resource").val();
  window.location.replace(
    "/lib/controller/search/Result.php?Ntk=" +
      getNtk +
      "&Ntt=" +
      getNtt +
      "&nPage=1" +
      "&perPage=15"
  );
}

function do_addcart(ident) {
  $.ajax({
    url: "/lib/model/session/add_cart.php",
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
  // window.location.reload();
}

$(document).on("change", "#perPage", function(e) {
  var getperPage = $("#perPage").val();
  var pathname = window.location.search;
  var result = pathname.split("nPage=");
  window.location.replace(
    "/lib/controller/search/Result.php" +
      result[0] +
      "nPage=1&perPage=" +
      getperPage
  );
  console.log(result);
});

var input = document.getElementById("text_resurce");
if (input) {
  input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      document.getElementById("btnsearch").click();
    }
  });
}

var presslogin = document.getElementById("password");
if (presslogin) {
  presslogin.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      document.getElementById("btn-modal-login").click();
    }
  });
}
$("#cartmodal").on("click", function() {
  var myModal = $("#modal-show");
  // myModal.modal();
});
$(document).on("click", "#btn-modal-login", function() {
  $(".lds-ring").show();
  $("#valid").hide();
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
      if (data["IsResult"] == true) {
        window.location.reload();
      } else {
        $(".lds-ring").hide();
        $("#valid")
          .hide()
          .html(data["ermsg"])
          .fadeIn();
      }
    },
    error: function(e) {
      console.log(e);
      alert("something wrong");
    }
  });
});
