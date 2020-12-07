<?php
$member = (isset($_GET['text_member']) ? $_GET['text_member'] : "");

$sql = "SELECT * FROM member WHERE ID = '$member'  ";
$q_data = $conn->query($sql);
$data = $q_data->fetch_assoc();

@$username = $_SESSION['Username'];

?>
<fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em;">
  <legend style="width: auto;padding:0 5px 0 5px;">รายละเอียดสมาชิก</legend>
  <br>
  <input type="hidden" class="member" value="<?php echo $member; ?>">
  <input type="hidden" class="username" value="<?php echo $username; ?>">

  <div class="form-group">
    <label class="control-label col-sm-1" for="pwd">ชื่อ:</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" value="<?php echo $data['FName']; ?>" disabled id="FName">
    </div>
    <label class="control-label col-sm-1" for="pwd">นามสกุล:</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" value="<?php echo $data['LName']; ?>" disabled>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-1" for="pwd">คณะ:</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" value="<?php echo $data['Faculty']; ?>" disabled>
      </div><br>
      <br><br>

      <div class="form-group">
        <label class="control-label col-sm-1" for="pwd">สาขา:</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" value="<?php echo $data['Major']; ?>" disabled>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-1" for="pwd">เบอร์โทร:</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" value="<?php echo $data['Tel']; ?>" disabled>
          </div>
          <label class="control-label col-sm-1" for="pwd">อีเมล:</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" value="<?php echo $data['Email']; ?>" disabled>
          </div>
          <br>
          <br><br>

          <div class="form-group">
            <label class="control-label col-sm-1" for="pwd">ที่อยุ่:</label>
            <div class="col-sm-3">
              <textarea class="form-control" disabled><?php echo $data['Address']; ?></textarea><br><br>
</fieldset>


<fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em;">
  <legend style="width: auto;padding:0 5px 0 5px;">หนังสือที่ยืม</legend>
  <br>
  <div class="form-group">

    <label class="control-label col-sm-1" for="pwd">หนังสือ:</label>
    <div class="col-md-3">
      <input type="text" class="form-control" name="text_book" id="text_book">
    </div>
    <br>
    <br>
  </div>
  <br>

  <br>
  <?php
  @$book = $_GET['text_book'];

  ?>

  <center>
    <table id="table_res">
      <thead>
      </thead>
      <tbody>
        <tr>
          <td id="appendBook0"></td>
          <td id="appendBook1"></td>
          <td id="appendBook2"></td>
          <td id="appendBookDel" class="appendBookDel"></td>
        </tr>
      </tbody>
    </table>
    <br>
    </div>

    <br><br>


</fieldset>
</div>


<center>
  <div class="col-sm-12">
    <br>
    <br>
    <br>
    <button type="submit" class="btn btn-success confirm">บันทึก</button>
    <br>
  </div>

  </div>
  </div>
  </div>
</center>

<script>
  function find_book(id) {
    $.ajax({
      url: 'findBook.php?key=' + id,
      type: 'get',
      success: function(response) {
        var arr_data = JSON.parse(response);
        cre_text(arr_data, id);
      }
    });
  }

  function savebook(bookVal, member, username) {
    var jsonString = JSON.stringify(bookVal);
    $.ajax({
      url: 'savebook.php',
      type: 'post',
      data: {
        data: jsonString,
        member: member,
        username: username
      },
      success: function(response) {
        // console.log(response);
        alert("ยืมสำเร็จ");
        location.reload();
      }
    });
  }

  var member = $('.member').val();
  var username = $('.username').val();

  function check_status(bookVal) {
    $.ajax({
      url: 'check_status.php',
      type: 'post',
      data: {
        data: bookVal
      },
      success: function(response) {
        var arr_item = JSON.parse(response);
        if (arr_item.length != 0) {
          alert_cant(arr_item);
        } else {
          savebook(bookVal, member, username);
        }
      }
    });
  }

  function alert_cant(obj) {
    stack = "";
    stack += "ไม่สามารถยืมได้เนื่องจากรายการมีหนังสือที่ไม่ว่าง";
    alert(stack);
  }

  var his_select_text_book = [];

  $('#text_book').keyup(function() {
    var select = $('#text_book').val();
    if (select.length == 3 && $.inArray(select, his_select_text_book) < 0) {
      table_check();
      find_book(select);
      his_select_text_book.push(select);
      $('#text_book').val('');
    } else if (select.length == 3 && $.inArray(select, his_select_text_book) >= 0) {
      $('#text_book').val('');
    }
  });


  var k = 0;
  var keep = [];
  var bookVal = [];

  Object.size = function(obj) {
    var size = 0,
      key;
    for (key in obj) {
      if (obj[key].length != 0) size++;
    }
    return size;
  };

  function cre_text(code, id) {
    var size = Object.size(code[id]);
    var i = 0;
    if (size != 0) {
      bookVal.push(id);
    }
    if (size == 3) {
      for (key in code[id]) {
        if (key == "Author") {
          $('#appendBook' + i).append('<tr class="text' + k + '"><td><input type="text" name="booktext[]" class="form-control" value="' + code[id][key]['#a'] + '" id="text' + k + '" disabled></td></tr>');
        } else if (key == "Publication") {
          $('#appendBook' + i).append('<tr class="text' + k + '"><td><input type="text" name="booktext[]" class="form-control" value="' + code[id][key]['#b'] + '" id="text' + k + '" disabled></td></tr>');
        } else if (key == "Title") {
          $('#appendBook' + i).append('<tr class="text' + k + '"><td><input type="text" name="booktext[]" class="form-control" value="' + code[id][key]['#a'] + '" id="text' + k + '" disabled></td></tr>');
        }
        i++;
      }
    }

    if (size != 3 && size != 0) {
      var temp_code = [];
      for (key in code[id]) {
        temp_code.push(key);
      }
      if ($.inArray('Author', temp_code) < 0) {
        $('#appendBook' + 0).append('<tr class="text' + k + '"><td><input type="text" name="booktext[]" class="form-control" value="' + code[id]['Title']['#a'] + '" id="text' + k + '" disabled></td></tr>');
        $('#appendBook' + 1).append('<tr class="text' + k + '"><td><input type="text" name="booktext[]" class="form-control" value="-" id="text' + k + '" disabled></td></tr>');
        $('#appendBook' + 2).append('<tr class="text' + k + '"><td><input type="text" name="booktext[]" class="form-control" value="' + code[id]['Publication']['#b'] + '" id="text' + k + '" disabled></td></tr>');
      } else if ($.inArray('Publication', temp_code) < 0) {
        $('#appendBook' + 0).append('<tr class="text' + k + '"><td><input type="text" name="booktext[]" class="form-control" value="' + code[id]['Title']['#a'] + '" id="text' + k + '" disabled></td></tr>');
        $('#appendBook' + 1).append('<tr class="text' + k + '"><td><input type="text" name="booktext[]" class="form-control" value="' + code[id]['Author']['#a'] + '" id="text' + k + '" disabled></td></tr>');
        $('#appendBook' + 2).append('<tr class="text' + k + '"><td><input type="text" name="booktext[]" class="form-control" value="-" id="text' + k + '" disabled></td></tr>');
      } else if ($.inArray('Title', temp_code) < 0) {
        $('#appendBook' + 0).append('<tr class="text' + k + '"><td><input type="text" name="booktext[]" class="form-control" value="-" id="text' + k + '" disabled></td></tr>');
        $('#appendBook' + 1).append('<tr class="text' + k + '"><td><input type="text" name="booktext[]" class="form-control" value="' + code[id]['Author']['#a'] + '" id="text' + k + '" disabled></td></tr>');
        $('#appendBook' + 2).append('<tr class="text' + k + '"><td><input type="text" name="booktext[]" class="form-control" value="' + code[id]['Publication']['#b'] + '" id="text' + k + '" disabled></td></tr>');
      }
    }
    if (size != 0) {
      $('#appendBookDel').append('<tr class="text' + k + '"><td><button id="text' + k + '" class="btn btn-danger del " type="button" >ยกเลิก</button></tr>');
      keep.push(k);
    }
    k++;
  }

  $('#appendBookDel').on('click', '.del', function() {
    var select = $(this);
    var myid = $(this).attr('id').substr(4);
    var parent = select.parent().parent().parent().parent().find('.text' + myid);
    $(parent).remove();
    his_select_text_book[myid] = "";
    bookVal[myid] = "";
    var tbody_count = $('#table_res tbody tr').length;
    if (tbody_count == 1) {
      $('#table_res thead tr').remove();
    }

  });


  $('.confirm').click(function() {
    username
    check_status(bookVal);
  });

  function table_check() {
    head = $('#table_res thead tr').length;
    stack = "";
    stack += "<tr>";
    stack += "<th>";
    stack += "<label class='control-label ' for='pwd'>ชื่อเรื่อง</label>";
    stack += "</th>";
    stack += "<th>";
    stack += "<label class='control-label ' for='pwd'>ผู้เขียน</label>";
    stack += "</th>";
    stack += "<th>";
    stack += "<label class=control-label  for=pwd>สำนักพิมพ์</label>";
    stack += "</th>";
    stack += "</tr>";
    if (head == 0) {
      $('#table_res thead').append(stack);
    }
  }
</script>