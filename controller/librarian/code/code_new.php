
<?php
 include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/head.php";
?>
 <div class="row"style="padding-top: 15px;padding-bottom:130px; background-color: #eee;" >
 <div class="col-sm-12">
    <fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em; background-color: #eee;" >
				<legend style="width: auto;padding:0 5px 0 5px;">สถานะหนังสือ</legend>
				<br>
             <div class="col-sm-12">
                    <fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em; background-color: #eee;" >
				<legend style="width: auto;padding:0 5px 0 5px;">เขตข้อมูล</legend>
				<br>
             <div class="col-sm-6">
            <label class="control-label"> รหัส:</label>
              <input type="text" class="form-control field code" name="field" autocomplete="off"/>
            </div>
            <div class="col-sm-6"> 
            <label class="control-label">ชื่อ:</label>
               <input type="text" class="form-control field name" name="field_name" autocomplete="off" />
            </div>
             <br> 
            <br> 
            <br>
            </fieldset>
            </div>
            <br> 
            <br> 
            <br>
            <br>
            <br>
            <div class="col-sm-12">
            <fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em; background-color: #eee;">
				<legend style="width: auto;padding:0 5px 0 5px;">ตัวบงชี้</legend>
			
				<div class="col-sm-12">
                <table id="indicator" class="col-sm-12"> 
                
                
<thead >
        <tr>
            <th><b>รหัส</b></th>
            <th><b>ชื่อ</b></th>
            <th><b>ตำแหน่ง</b></th>
 
        </tr>
</thead>
<tbody> 
        <tr>
            <th><input type="text"  name="inc_code"  class="form-control inc code" autocomplete="off" /><div class="append_ap"></div></th> 
            <th><input type="text"   name="inc_des" style='width: 365;' class="form-control inc des" autocomplete="off"/><div class="append_ap"></div></th> 
            <th><input type="text"  name="inc_order"  style='width: 400;' class="form-control inc order" autocomplete="off"/><div class="append_ap"></div></th>
            
            <th>&nbsp;&nbsp;&nbsp;&nbsp;<button onClick="temp_addInc()" class=" btn btn-primary" type="button">เพิ่ม</button></th>
        </tr>
        <br><input type="hidden" name="stack" value="1" >
</table>


            <!-- <div id="indicator">
        
                <label class="control-label col-sm-1"> โค้ด:</label>
                        <div class="col-sm-3"> 
                            <input type="text" class="form-control inc code" name="inc_code">
                        </div>
                            <label class="control-label col-sm-1"> ลักษณะ:</label>
                        <div class="col-sm-3"> 
                            <input type="text" class="form-control inc des" name="inc_des">
                        </div>
                        <div class="col-sm-43"> 
                            <br>
                            <br>
                            <br>
</div>
                            <label class="control-label col-sm-1"> ใบสั่ง:</label>
                        <div class="col-sm-3"> 
                            <input type="text" class="form-control inc order" name="inc_order">
                        </div>
                      
                        <div class="col-sm-3">
                            <button onClick="temp_addInc()" type="button" class=" btn btn-primary">+</button>
                        </div>
                        <br>
                        <br>
                        <br>
            </div> -->
            
            </fieldset>
            
           
            <fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em; background-color: #eee;">
				<legend style="width: auto;padding:0 5px 0 5px;">เขตข้อมูลย่อย</legend>
			
                        <div class="col-sm-12">
                        <table id="subfield" class="col-sm-12"> 
                        
<thead >
        <tr>
            <th><b>รหัส</b></th>
            <th><b> ชื่อ</b></th>
 
        </tr>
</thead>
<tbody> 
        <tr>
            <th><input type="text"  name="sub_code"   style='width: 200;' class="form-control sub code" autocomplete="off" /><div class="append_ap"></div></th> 
            <th><input type="text"   name="sub_name"   style='width: 757;' class="form-control sub name" autocomplete="off"/><div class="append_ap"></div></th> 
            
            <th>&nbsp;&nbsp;&nbsp;&nbsp;<button onClick="temp_addSub()" class=" btn btn-primary" type="button">เพิ่ม</button></th>
        </tr>
        <br>
       
</table>

            </fieldset>
    <br>
    <br>
    <br>
    <center>
            <button type="submit" class="btn btn-success btn_save">บันทึก</button>
            <br>
    <br>
    <br>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
var Ri=0;
var Rs=0;

function temp_addInc() {
    var stack = "";
        stack += "<tr>";
            stack += "<th class='inc find"+Ri+"'><input type='text' class='form-control inc code' name='inc_code"+Ri+"' /></th>";
            stack += "<th class='inc find"+Ri+"'><input type='text' class='form-control inc des' name='inc_des"+Ri+"'></th>";
            stack += "<th class='inc find"+Ri+"'><input type='text' class='form-control inc order' name='inc_order"+Ri+"'></th>";
            stack += "<th class='inc find"+Ri+"'>&nbsp;&nbsp;&nbsp;<button type='button' class='btn_del btn btn-link' id='"+Ri+"'>ลบ</button></th>";
        stack += "</tr>";
  $('#indicator tbody').append(stack)
  Ri++;

}

function temp_addSub() {
    var stack = "";
        stack += "<tr>";
            stack += "<th class='sub find"+Rs+"'><input type='text' class='form-control sub code' name='sub_code"+Rs+"' /></th>";
            stack += "<th class='sub find"+Rs+"'><input type='text'  style='width: 757;' class='form-control sub name' name='sub_name"+Rs+"'></th>";
            stack += "<th class='sub find"+Rs+"'>&nbsp;&nbsp;&nbsp;<button type='button' class='btn_del btn btn-link' id='"+Rs+"'>ลบ</button></th>";
        stack += "</tr>";

        $('#subfield tbody').append(stack)
  Rs++;

}''

$('#subfield').on('click','.btn_del', function() {
            var select = $(this);
            var myid = $(this).attr('id');
            var html = select.parent().parent().parent().find('.sub.find'+myid+'');
            $(html).remove();
});

$('#indicator').on('click','.btn_del', function() {
            var select = $(this);
            var myid = $(this).attr('id');
            var html = select.parent().parent().parent().find('.inc.find'+myid+'');
            $(html).remove();
});


$(".btn_save").click(function(){
    var main_save = [];
    var temp = [];

    main_save.push([$("input[name='field']").val(),$("input[name='field_name']").val()])
    // main_save.push(temp);

    $('.inc.code').each(function(){
        temp.push([
            $(this).val(),
            $(this).parent().parent().find('.des').val(),
            $(this).parent().parent().find('.order').val()
        ]);
    });
    main_save.push(temp);
    temp = [];
    $('.sub.code').each(function(){
        temp.push([
            $(this).val(),
            $(this).parent().parent().find('.name').val()
        ]);
    });
    main_save.push(temp);

    console.log(main_save);

    ajax_save(main_save);
  });

    function cal_null(arr) {
        $(arr).each(function(){
            for (let j = 0; j < 3; j++) {
                var k=0;
                arr[j].forEach(element => {
                    if (element==""||element.length==0) {
                        arr[j].splice(k,1);
                    }
                    k++
                });
            }
        })
    }


  function ajax_save(main_save) {
    $.ajax({
            url: 'saveCode.php',
            type: 'post',
            data : { 
                data : main_save
            } ,
            success: function (response) {
                // console.log(response)
                alert('บันทึกสำเร็จ');
                location.reload();               
            }
        });
    }

</script>