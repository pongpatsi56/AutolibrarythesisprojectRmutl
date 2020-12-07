
<?php 

$member = $_GET['text_member'];

$sql = "SELECT * FROM member WHERE ID = '$member'  ";
$q_data = $conn->query($sql);
$M_data = $q_data->fetch_assoc();
?>
<fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em;">
				<legend style="width: auto;padding:0 5px 0 5px;">รายละเอียดสมาชิก</legend>
				<br>
<div class="form-group">
      <label class="control-label col-sm-1" for="pwd" style="font-family:kanit;">ชื่อ:</label>
      <div class="col-sm-3">          
        <input type="text" class="form-control" style="font-family:kanit;"  value="<?php echo $M_data['FName']; ?>" id="check" disabled>
      </div>
      <label class="control-label col-sm-1" for="pwd" style="font-family:kanit;">นามสกุล:</label>
      <div class="col-sm-3">          
        <input type="text" class="form-control" style="font-family:kanit;"  value="<?php echo $M_data['LName']; ?>" disabled>
      </div>
    </div><br>
    <br>
    <div class="form-group">
      <label class="control-label col-sm-1" for="pwd" style="font-family:kanit;">คณะ:</label>
      <div class="col-sm-3">          
        <input type="text" class="form-control" style="font-family:kanit;" value="<?php echo $M_data['Faculty']; ?>" disabled>
      </div>
      <label class="control-label col-sm-1" for="pwd "style="font-family:kanit;">สาขา:</label>
      <div class="col-sm-3">          
        <input type="text" class="form-control" style="font-family:kanit;" value="<?php echo $M_data['Major']; ?>" disabled>
      </div>
    </div><br>
    <br>
    <div class="form-group">
      <label class="control-label col-sm-1" for="pwd"style="font-family:kanit;">เบอร์โทร:</label>
      <div class="col-sm-3">          
        <input type="text" class="form-control"  style="font-family:kanit;"value="<?php echo $M_data['Tel']; ?>" disabled>
      </div>
      <label class="control-label col-sm-1" for="pwd"style="font-family:kanit;">อีเมล:</label>
      <div class="col-sm-3">          
        <input type="text" class="form-control" style="font-family:kanit;" value="<?php echo $M_data['Email']; ?>" disabled>
      </div>
    </div><br>
    <br>
    <div class="form-group">
      <label class="control-label col-sm-1" for="pwd" style="font-family:kanit;">ที่อยุ่:</label>
      <div class="col-sm-3"> 
        <textarea class="form-control" style="font-family:kanit;"disabled><?php echo $M_data['Address']; ?></textarea><br><br>
</div>
</div>
</fieldset> 
<br>
<br>

 