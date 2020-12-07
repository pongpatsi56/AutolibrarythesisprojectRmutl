

   

function callajax1() {

    var deptid = $('#text1').val();
    $.ajax({
        url: 'getTag.php?key=' + deptid,
        type: 'post',
        success: function (response) {
            $('.append_ap').html(response);
        }
    });
}

function toselect(obj) { 
    var selector_text = $(obj).text();
    $('#text1').val(selector_text)
    $('.append_ap').html('');
}

function toselect2(obj) { 
    var selector_text2 = $(obj).text();
    $('#text4').val(selector_text2)
    $('.append2_ap').html('');
}

function toselect3(obj) { 
    var selector_text2 = $(obj).text();
    $('#text2').val(selector_text2)
    $('.append2_ap').html('');
}

function toselect4(obj) { 
    var selector_text2 = $(obj).text();
    $('#text3').val(selector_text2)
    $('.append2_ap').html('');
}

function callajax2(deptid) {
    // console.log(deptid);
    $.ajax({
        url: 'getSubfield.php',
        type: 'post',
        data: { depart: deptid },
        success: function (response) {
            $('.append2_ap').html(response);  
        }
    });
}

function callajax3(deptid) {
    // console.log(deptid);
    $.ajax({
        url: 'getIndicator.php',
        type: 'post',
        data: { depart: deptid },
        success: function (response) {
            $('.append3_ap').html(response);  
        }
    });
}

function callajax4(deptid) {
    // console.log(deptid);
    $.ajax({
        url: 'getIndicator2.php',
        type: 'post',
        data: { depart: deptid },
        success: function (response) {
            $('.append4_ap').html(response);  
        }
    });
}

function temp_addInput(value) {
  value = (value + 1);
  document.getElementById("divInput"+value).innerHTML='<textarea name="task[]" rows="4" cols="50"></textarea><div id="divInput'+(value+1)+'"><button type="button" onClick="temp_addInput('+value+')">+</button></div>';
   
 }

 $("#text1").on('keyup', function () {
    callajax1();
});
$("#text2").on('keyup', function () {
    callajax3($('#text1').val());
});
$("#text3").on('keyup', function () {
    callajax4($('#text1').val());
});
$("#text4").on('keyup', function () {
    callajax2($('#text1').val());
});
