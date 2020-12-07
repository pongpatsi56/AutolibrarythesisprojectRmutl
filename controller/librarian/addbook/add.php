
  <?php
  include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
  ?>
      <br>
      <br>
      <br>
      <section class="container">
  <div class="row" style="padding-top: 20px;paddingbottom: 200px; background-color: #eee;">
  <div class="col-md-12">
  <a  href="/lib/view/librarian/add.php" ><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40' ></i></a><br><br><br>
  <link type="text/css" rel="stylesheet" href="/lib/css/jquery.autocomplete.css" />
  <!-- <link type="text/css" rel="stylesheet" href="/lib/css/modal.css" /> -->

  <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/lib/controller/librarian/addbook/call_temp.php";
    include($path);

  //echo $_SERVER['SERVER_ADDR'];

  for ($i=0; $i < mysqli_num_rows($data) ; $i++) {
      $res[$i] = $data->fetch_assoc();
  }

  $sql_data_name = "SELECT NAME,Field FROM field";
  $raw_data_name = $conn->query($sql_data_name);
  foreach ($raw_data_name as $key => $value) {
    $data_name[] = $raw_data_name->fetch_assoc();
  }

  ?>

  <html>
  <form action="" method="GET" >
  <div class="col-sm-4">
  <select name="temp_name" class="form-control"  >
  <option value="1">โปรดเลือกรูปแบบระเบียน</option>
  <?php
  for ($i=0;$i < mysqli_num_rows($data) ; $i++){
  ?>
    <option value="<?php echo($res[$i]['Name']) ?>"><?php echo $res[$i]['Name'] ?></option>
  <?php
  }
  ?>
  </select>
  </div>
  <div class="col-sm-6">
  <button type="submit" name="call"  class="btn btn-primary"  >เรียกใช้</button>

  </form>

  </div>
  <?php

  if(isset($_GET['call'])&&$_GET['temp_name']!=1){

    $sql_leader = "SELECT Leader FROM temp_leader WHERE Temp = '{$_GET['temp_name']}'";
    $data_leader   =  $conn->query($sql_leader);
    $res_leader   =  $data_leader->fetch_assoc();





    $sql_tag    = "SELECT Tag FROM temp_tag WHERE Temp = '{$_GET['temp_name']}'";
    $data_tag   =  $conn->query($sql_tag);
      for ($i=0; $i < mysqli_num_rows($data_tag) ; $i++) {
        $res_tag[$i]   =  $data_tag->fetch_assoc();
      }
    $stack_tag = "";
    foreach ($res_tag as $key => $value) {
      $stack_tag .= "Field = '".$res_tag[$key]['Tag']."' OR ";
    }
    $stack_tag = substr($stack_tag,0,strlen($stack_tag)-3);

    $sql_field  = "SELECT Name FROM field WHERE $stack_tag";
    $data_field   =  $conn->query($sql_field);
    for ($i=0; $i < mysqli_num_rows($data_field) ; $i++) {
      $res_field[$i]   =  $data_field->fetch_assoc();
    }

    $sql_inc1   = "SELECT Tag,Indicator FROM temp_indicator1 WHERE Temp = '{$_GET['temp_name']}' ";
    $data_inc1  =  $conn->query($sql_inc1);
      for ($i=0; $i < mysqli_num_rows($data_tag) ; $i++) {
        $res_inc1[$i]   =  $data_inc1->fetch_assoc();
      }

    $sql_inc2   = "SELECT Tag,Indicator FROM temp_indicator2 WHERE Temp = '{$_GET['temp_name']}'";
    $data_inc2   =  $conn->query($sql_inc2);
      for ($i=0; $i < mysqli_num_rows($data_tag) ; $i++) {
        $res_inc2[$i]   =  $data_inc2->fetch_assoc();
      }

    $stack_inc = "";
    foreach ($res_inc1 as $key => $value) {
      $stack_inc .= "(Code = '".$res_inc1[$key]['Indicator']."' AND Field = '".$res_tag[$key]['Tag']."') OR ";
    }
    foreach ($res_inc2 as $key => $value) {
      $stack_inc .= "(Code = '".$res_inc2[$key]['Indicator']."' AND Field = '".$res_tag[$key]['Tag']."') OR ";
    }
    $stack_inc = substr($stack_inc,0,strlen($stack_inc)-3);
    $sql_inc  = "SELECT Description FROM indicator WHERE $stack_inc";
    $data_inc   =  $conn->query($sql_inc);
    for ($i=0; $i < mysqli_num_rows($data_inc) ; $i++) {
      $res_inc[$i]   =  $data_inc->fetch_assoc();
    }


    $sql_sub    = "SELECT Tag,Subfield FROM temp_subfield WHERE Temp = '{$_GET['temp_name']}'";
    $data_sub   =  $conn->query($sql_sub);
      for ($i=0; $i < mysqli_num_rows($data_tag) ; $i++) {
        $res_sub[$i]   =  $data_sub->fetch_assoc();
      }

    $stack_sub = "";
    foreach ($res_sub as $key => $value) {
      $stack_sub .= "(Code = '".$res_sub[$key]['Subfield']."' AND Field = '".$res_tag[$key]['Tag']."') OR ";
    }
    $stack_sub = substr($stack_sub,0,strlen($stack_sub)-3);
    $sql_sub  = "SELECT Description FROM subfield WHERE $stack_sub";
    $data_sub   =  $conn->query($sql_sub);
    for ($i=0; $i < mysqli_num_rows($data_sub) ; $i++) {
      $res_dsub[$i]   =  $data_sub->fetch_assoc();
    }

  foreach ($res_tag as $key => $value) {
    if(isset($res_field[$key]['Name'])){
    }
    else{
      $res_field[$key]['Name'] = "no info";
    }
    if(isset($res_inc[$key]['Description'])){
    }
    else{
      $res_inc[$key]['Description'] = "no info";
    }
    if(isset($res_dsub[$key]['Description'])){
    }
    else{
      $res_dsub[$key]['Description'] = "no info";

    }

  }

  $date = date('ymd');

  ?>
  <br>
  <br>
  <br>
  <br>
  <div class="col-sm-12">
    <label>marc leader : <?php echo $res_leader['Leader']; ?></label>
    <form  action="/lib/controller/librarian/addbook/savebook.php" method="POST">
      <input type="hidden" name="leader" value="<?php echo $res_leader['Leader']; ?>">
      <table>
      <thead>
        <tr>
          <th>Tag</th>
          <th>Indicater1</th>
          <th>Indicater2</th>
          <th>Field</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <form id="form_user">
            <?php
              foreach ($res_tag as $key => $value) {
            ?>
            <th>
              <input type="text" class="tag form-control" name="tag[]" value="<?php echo($res_tag[$key]['Tag'])  ?>" title = "<?php echo($res_field[$key]['Name'])  ?>" />
            </th>
            <?php
              if( $res_tag[$key]['Tag'] == $res_inc1[$key]['Tag'] ){
            ?>
            <th>
              <input type="text" class="inc1 form-control" name="inc1[]" value="<?php echo($res_inc1[$key]['Indicator']) ?>" title = "<?php echo($res_inc[$key]['Description']) ?>" />
            </th>
  <?php
  }
  if( $res_tag[$key]['Tag'] == $res_inc2[$key]['Tag'] ){
  ?>
  <th><input type="text" class="inc2 form-control" name="inc2[]" value="<?php echo($res_inc2[$key]['Indicator']) ?>" title = "<?php echo($res_inc[$key]['Description']) ?>" /></th>
  <?php
  }
  if( $res_tag[$key]['Tag'] == $res_sub[$key]['Tag'] ){
    ?>
    <th><input type="text" class="sub form-control" name="sub[]" value="<?php
    echo($res_sub[$key]['Subfield']);
    if($res_tag[$key]['Tag']=='008'){
      echo($date);
    }
    ?>" title = "<?php echo($res_dsub[$key]['Description']) ?>" /></div>
    <th><button type="button" class="btn btn-primary btn-sm <?php echo (($res_tag[$key]['Tag'] == "008") ? "exampleModal1" : "exampleModal2" ); ?>">Edit</button>
  </button></th>

  </th></form></tr>

    <?php
    }
    else{

    }
  }
  ?>
  </table>
  <br>
  <br>
  <center>

  <button type="submit" name="save"  class="btn btn-success">บันทึก</button> </center>
  </form>
      <?php


  }


  include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";
  ?>

  <!-- modal1 -->
  <div class="modal fade modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div  style="  background-color: #FAFAD2;" >
        <div class="modal-header">
          <h2 class="modal-title " id="exampleModalLabel">Edit</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <tr>วันที่เอาเข้าระเบียน
              <input type="text" class="date_file form-control"></tr>
              <br>
            <tr>ประเภทของปีที่พิมพ์/สถานะของสิ่งพิมพ์
              <select class = "select type_date form-control " >
                        <option value="b">(b)No dates given; B.C. date involved</option>
                        <option value="c">(c)Continuing resource currently published</option>
                        <option value="d">(d)Continuing resource ceased publication</option>
                        <option value="e">(e)Detailed date</option>
                        <option value="i">(i)Inclusive dates of collection</option>
                        <option value="k">(k)Range of years of bulk of collection</option>
                        <option value="m">(m)Multiple dates</option>
                        <option value="n">(n)Dates unknown</option>
                        <option value="p">(p)Date of distribution/release/issue and production/recording session when different</option>
                        <option value="q">(q)Questionable date</option>
                        <option value="r">(r)Reprint/reissue date and original date</option>
                        <option value="s">(s)Single known date/probable date</option>
                        <option value="t">(t)Publication date and copyright date</option>
                        <option value="u">(u)Continuing resource status unknown</option>
              </select></tr>
              <br>
            <tr>ปีที่เริ่มพิมพ์
              <input type="text" class="start_date form-control"></tr>
              <br>
            <tr>ปีที่สิ้นสุดการพิมพ์
              <input type="text" class="end_date form-control"></tr>
              <br>
            <tr>สถานที่พิมพ์/ผลิต
              <select class = "select location_make form-control" >
                        <option value="xx#">(xx#)No place, unknown, or undetermined</option>
                        <option value="vp#">(vp#)Various places</option>
              </select>
              <br>
            <tr>การลงรายการหลัก
              <input type="text" class="entry_convention form-control"></tr>
              <br>
            <tr>ภาษา
            <div class="row">
            <div class="col-md-5">
              <select class = "select language form-control" >
                        <option value="###">(###")No information provided</option>
                        <option value="zxx">(zxx)No linguistic content</option>
                        <option value="mul">(mul)Multiple languages</option>
                        <option value="sgn">(sgn)Sign languages</option>
                        <option value="und">(und)Undetermined</option>
                        <option value="lan">(lan)Have Info</option>
              </select> </div>
              <div class="col-md-7">
              <input type="text" class="language form-control"></tr> </div>
              </div>
              <br>
            <tr>ระเบียบที่มีการแก้ไข
              <select class = "select modified_record form-control" >
                        <option value="#">(#)Not modified</option>
                        <option value="d">(d)Dashed-on information omitted</option>
                        <option value="o">(o)Completely romanized/printed cards romanized</option>
                        <option value="r">(r)Completely romanized/printed cards in script</option>
                        <option value="s">(s)Shortened</option>
                        <option value="x">(x)Missing characters</option>
              </select>
              <br>
            <tr>แหล่งที่มาของข้อมูลทางบรรณานุกรม
              <select class = "select cataloging_source form-control" >
                        <option value="#">(#)National bibliographic agency</option>
                        <option value="c">(c)Cooperative cataloging program</option>
                        <option value="d">(d)Other</option>
                        <option value="u">(u)Unknown</option>
              </select>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="saveEdit btn btn-success" id="save">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal2 -->

  <div class="modal fade modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style=" background-color: #FAFAD2 ; ">
        <div class="modal-header" style=" background-color: #FAFAD2; ">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <tr><label for="">tag</label></tr>
                <tr><input type="text" class="tag_value2  form-control"></tr>
                <br>
            <tr><label for="">indicator1</label></tr>
                <tr><input type="text" class="inc1_value2  form-control"></tr>
                <br>
            <tr><label for="">indicator1</label></tr>
                <tr><input type="text" class="inc2_value2  form-control"></tr>
                <br>
            <tr><th  style=" background-color: #FAFAD2; "><label for="">subfield</label></th></tr>
            <tr><th style=" background-color: #FAFAD2; "><p id="sub_append"  style="padding-bottom: 30px; width:100%;  "></p></th></tr>
                

          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="saveEdit2 btn btn-success">Save changes</button>
        </div>+
      </div>
    </div>
  </div>

  </div>


  <script>


  function callajax1(deptid,obj) {
  $.ajax({
      url: 'getSub.php?key='+deptid,
      type: 'post',
      success: function (response) {
          en_data = response;
          // console.log(en_data);
          decode(en_data,obj);
      }
  });
  }


    function cre_subtext(code,name,obj) {
      var myModal = $('.modal2');
      var res_code = code.split("*");
      res_code.pop();
      var res_name = name.split("*");
      res_name.pop();
      var check = obj.parent().parent().find('.tag').val()
      if (check == '960') {
        var stack = "";
        stack += "<input class='btn btn-default' type='file' name='img' >";
        $('#sub_append').append(stack);
      }
      else{
        for (let i = 0; i < res_code.length; i++) {
          $('#sub_append').append('<tr class="delete" ><th class="delete "><label class="delete " for="">'+res_name[i]+'('+res_code[i].replace("#", "$")+')'+'</label>'); 
          $('#sub_append').append('<input class="delete choice_sup " rel="txt'+i+'" type="checkbox" name="'+res_code[i].replace("#", "$")+'">');
          $('#sub_append').append('<input class="delete text_sup " id="txt'+i+'" type="text" value=""></th></tr>');
        }
      }

        myModal.modal();
        $('.choice_sup').change(function(){
          $(".text_sup").prop("disabled", !$(this).is(':checked')); 
        });

        $(document).ready(function(){
          $('.text_sup').prop('disabled', true);
        });

        $('.choice_sup').change(function(){
          var relate = $(this).attr("rel");
          if($(this).is(":checked")){
            $(".text_sup#"+relate).removeAttr("disabled");
          } 
          else{
            $(".text_sup#"+relate).attr("disabled","disabled");
          }
        });

          res_code = "";
          res_name = "";    
          de_data_name = "";
          de_data_code = "";
    }

  var de_data_name = "";
  var de_data_code = "";


  function decode(en_data,obj) {
    var arr_data = JSON.parse(en_data);
    var count = 0;

    for(var key in arr_data) if(arr_data.hasOwnProperty(key)) count++;
    for(var i = 1; i < count; i++) {
      de_data_code += arr_data[i][0]+"*";
      de_data_name += arr_data[i][1]+"*";
    }
    cre_subtext(de_data_code,de_data_name,obj);
  }

  var selector;

  $('.exampleModal2').click(function(){
    $('.delete').remove();

    selector = $(this);
    var selector_parent = selector.parent().parent();
    var tag_value = selector_parent.find('.tag').val();
    var inc1_value = selector_parent.find('.inc1').val();
    var inc2_value = selector_parent.find('.inc2').val();
    var sub_value = selector_parent.find('.sub').val();
    var sub_obj = selector_parent.find('.sub');
    // console.log(sub_obj);
    $('.tag_value2').val(tag_value)
    $('.inc1_value2').val(inc1_value)
    $('.inc2_value2').val(inc2_value)
    // $('.sub_value2').val(sub_value)
    callajax1(tag_value,sub_obj);
  })

  $('.exampleModal1').click(function(){
    selector = $(this);
    var selector_parent = selector.parent().parent();
    var tag_value = selector_parent.find('.tag').val();
    var inc1_value = selector_parent.find('.inc1').val();
    var inc2_value = selector_parent.find('.inc2').val();
    var sub_value = selector_parent.find('.sub').val();
    $('.tag_value1').val(tag_value)
    $('.inc1_value1').val(inc1_value)
    $('.inc2_value1').val(inc2_value)
    $('.sub_value1').val(sub_value)

    var date_file = sub_value.substr(0,6);
    $('.date_file').val(date_file)

    var type_date = sub_value.substr(6,1);
    if(type_date == 'b' || type_date == 'c' || type_date == 'd' || type_date == 'e' || type_date == 'i' || type_date == 'k' || type_date == 'm' || type_date == 'n' || type_date == 'p' || type_date == 'q' || type_date == 'r' || type_date == 's' || type_date == 't' || type_date == 'u'){
      $('.select .type_date').val(type_date);
    }

    var start_date = sub_value.substr(7,4);
    $('.start_date').val(start_date)

    var end_date = sub_value.substr(11,4);
    $('.end_date').val(end_date)

    var location_make = sub_value.substr(15,3);
    if(location_make == 'xx#' || location_make == 'vp#'){
      $('.select .location_make').val(location_make);
    }
    // var frequency = sub_value.substr(18,1);
    // $('.frequency').val(frequency)

    // var regularity = sub_value.substr(19,1);
    // $('.regularity').val(regularity)

    // var type_resource = sub_value.substr(21,1);
    // $('.type_resource').val(type_resource)

    // var form_original = sub_value.substr(22,1);
    // $('.form_original').val(form_original)

    // var form_item = sub_value.substr(23,1);
    // $('.form_item').val(form_item)

    // var nature_entire_work = sub_value.substr(24,1);
    // $('.nature_entire_work').val(nature_entire_work)

    // var nature_contents = sub_value.substr(25,3);
    // $('.nature_contents').val(nature_contents)

    // var goverment_pub = sub_value.substr(28,1);
    // $('.goverment_pub').val(goverment_pub)

    // var conference_pub = sub_value.substr(29,1);
    // $('.conference_pub').val(conference_pub)

    // var original_alphabet = sub_value.substr(33,1);
    // $('.original_alphabet').val(original_alphabet)

    var entry_convention = sub_value.substr(34,1);
    $('.entry_convention').val(entry_convention)

    var language = sub_value.substr(35,3);
    if(language == '###' || language == 'zxx' || language == 'mul' || language == 'sgn' || language == 'und'){
      $('.select.language').val(language);
    }
    else if(language.length==0){
      $('.select.language').val('###');
    }
    else{
      $('.select.language').val('lan');
      $('.form-control.language').val(language);
    }
    
    var modified_record = sub_value.substr(38,1);
    if(modified_record == '#' || modified_record == 'd' || modified_record == 'o' || modified_record == 'r' || modified_record == 's' || modified_record == 'x'){
      $('.select .modified_record').val(modified_record);
    }

    var cataloging_source = sub_value.substr(39,1);
    if(cataloging_source == '#' || cataloging_source == 'c' || cataloging_source == 'd' || cataloging_source == 'u'){
      $('.select .cataloging_source').val(cataloging_source);
    }

    var myModal = $('.modal1');

    myModal.modal();
    
  })

  $('.saveEdit2').click(function(){
    var sel = $(this);
    var sel_par = sel.parent().parent();
    var new_value = [];
    var sub_val = [];
    var sub_pos = [];
    var sub_tolal = '';

        new_value[0] = sel_par.find('.tag_value2').val();
        new_value[1] = sel_par.find('.inc1_value2').val();
        new_value[2] = sel_par.find('.inc2_value2').val();
        count_sub = sel_par.find('.text_sup');

        $('input:checked').each(function() {
          rel = $(this).attr('rel');
          num = rel.substring(3);
          sub_pos.push($(this).attr('name'));
          sub_val.push(sel_par.find('#txt'+num).val());
        });
        $.each(sub_pos, function( key, value ) {
          sub_tolal += sub_pos[key]+'='+sub_val[key]+'/';
        });
        
    here = selector.parent().parent().find('.sub');
    $('.modal2').modal('toggle');
    $(here).val(sub_tolal.substring(0,sub_tolal.length-1));

  })

  $('.saveEdit').click(function(){
    var sel = $(this);
    var sel_par = sel.parent().parent();
    var new_value = [];
    var len = [];
    var sub_tolal = '';

        new_value[0] = sel_par.find('.date_file').val();
        new_value[1] = sel_par.find('.type_date').val();
        new_value[2] = sel_par.find('.start_date').val();
        new_value[3] = sel_par.find('.end_date').val();
        new_value[4] = sel_par.find('.location_make').val();
        new_value[5] = "                ";
        new_value[6] = sel_par.find('.entry_convention').val();
        new_value[7] = sel_par.find('.select.language').val();
        new_value[8] = sel_par.find('.form-control.language').val();
        new_value[9] = sel_par.find('.modified_record').val();
        new_value[10] = sel_par.find('.cataloging_source').val();
        $.each(new_value, function( key, value ) {
          length = new_value[key].length
          if(key==0){
            for ( length ; length < 6; length++) {
              new_value[key] = new_value[key]+" ";
            }
          }
          else if(key==1||key==5||key==9||key==10||key==6){
            for ( length ; length < 1; length++) {
              new_value[key] = new_value[key]+" ";
            }
          }
          else if(key==2||key==3){
            for ( length ; length < 4; length++) {
              new_value[key] = new_value[key]+" ";
            }
          }
          else if(key==4||key==7||key==8){
            for ( length ; length < 3; length++) {
              new_value[key] = new_value[key]+" ";
            }
          }

          if(new_value[8]!="   "||key!=8){
            if(key==8){
              sub_tolal = sub_tolal.substring(0,sub_tolal.length-3);
              sub_tolal += new_value[key];
            }
            else{
              sub_tolal += new_value[key];
            }
          }
          else if(new_value[8]=="   "&&key==8&&new_value[7]=="lan"){
            sub_tolal = sub_tolal.substring(0,sub_tolal.length-3);
            sub_tolal += "###";
            console.log('in');
          }
          len.push(new_value[key].length);
        });
    console.log(new_value);
    console.log(sub_tolal.length);
    console.log(len);

    here = selector.parent().parent().find('.sub');
    $('.modal1').modal('toggle');

    $(here).val(sub_tolal);
  })

  $('#save').on('click', function() {
          var mix_val = ""
          mix_val =  $('.date_file.form-control').val()
          mix_val += $('.select.REC_STAT').val()
          mix_val += $('.select.REC_TYPE').val()
          mix_val += $('.select.BIB_LEVEL').val()
          mix_val += $('.select.ARC_CTRL').val()
          mix_val += $('.select.CHAR_ENC').val()
          mix_val += $('.select.IND_CNT').val()
          mix_val += $('.select.SFLD_CNT').val()
          mix_val += $('.BASE_ADDRESS').val()
          mix_val += $('.select.ENC_LEVEL').val()
          mix_val += $('.select.CAT_FORM').val()
          mix_val += $('.select.LINKED_REC').val()
          mix_val += $('.LEN_FIELD').val()
          mix_val += $('.LEN_START').val()
          mix_val += $('.LINKED_IMPL').val()
          mix_val += $('.UNDIFIND').val()

          $('#leader').val(mix_val);
      });

  $('.select').change(function(){
    var classes = $('.select').attr('class').split(' ');
    for(var i=0; i<classes.length; i++){
      classes[i] = "." + classes[i];
    }
    $(classes[1]).filter(".form-control").val($(this).val());
  })

  </script>


  <br>
                  <br>
                  <br><br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                
                
                  
                
                  <div class="row">

                
      
                  <div class="container">
                  <div class="row">
                  <div class="col-md-14">
          <span class="footer-divider"></span>
      </div> 
                    
                      


                            
  
  <footer>

      <div class="row">
      
                  <div class="col-md-4 col-sm-12" id="vertical-line">
              <div class="col-md-12">
                  <img src="https://webs.rmutl.ac.th/assets/upload/logo/web_footer_20170911140318.png" class="rmutl-web-logo-footer img-responsive">
              </div>
              <div class="col-md-12 footer-about-text text-center">
                  ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา<br>
                  <span class="footer-span-comment">"มทร.ล้านนา"</span>
              </div>
              <div class="col-md-12 text-center">
              
              </div>
          </div>
          <div class="col-md-8 col-sm-12">
              <div class="list-text-footer row">
                  <div class="col-md-4">
                      <ul>
                                              </ul>
                  </div>
                  <div class="col-md-4">
                      <ul>
                                              </ul>
                  </div>
                  <div class="col-md-4">
                      <ul>
                                              </ul>
                  </div>
              </div>
              <div class="address-text-fooster col-md-12">
                  ห้องสมุด มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา : 128 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่ 50300<br>
                  โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183            </div>
              <div class="address-text-fooster col-md-12" style="margin-top: 8px;">
                  <div id=ipv6_enabled_www_test_logo></div>
                  <script language="JavaScript" type="text/javascript">
                      //var Ipv6_Js_Server = (("https:" === document.location.protocol) ? "https://" : "http://");
                      //document.write(unescape("%3Cscript src='" + Ipv6_Js_Server + "www.ipv6forum.com/ipv6_enabled/sa/SA1.php?id=5070' type='text/javascript'%3E%3C/script%3E"));
                  </script>
              </div>
          </div>
      </div> 
  </footer>
  <div class="credit" style="text-align:center; color: #eee;margin-top: 50px;margin-bottom: 15px;">
      <p style="color: #666; font-family: 'kanit';">ออกแบบและพัฒนาโดย <a href="https://arit.rmutl.ac.th/" target="_blank">สำนักวิทยบริการและเทคโนโลยีสารสนเทศ</a> <a href="https://www.rmutl.ac.th/" target="_blank">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</a></p>
  </div>
  </section>
  <input type="hidden" id="service_base_url" value="https://library.rmutl.ac.th/">
    <script src="https://library.rmutl.ac.th/assets/js/jquery.dcjqaccordion.min.js" type="text/javascript" ></script>
      <script src="https://library.rmutl.ac.th/assets/js/owl.carousel.min.js" type="text/javascript" ></script>
      <script src="https://library.rmutl.ac.th/assets/js/home.min.js" type="text/javascript" ></script>
      
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-87588904-9"></script>
  <script src="/lib/script/search.js"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments)};
    gtag('js', new Date());

    gtag('config', 'UA-87588904-9');
  </script>

                    
  </body>

  </html>
