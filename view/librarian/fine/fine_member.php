
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

      <label class="control-label col-sm-1" for="pwd">ชื่อ:</label>
      <div class="col-sm-3">          
        <input type="text" class="form-control"  value="<?php echo $M_data['FName']; ?>" id="check" disabled>
      </div>
      <label class="control-label col-sm-1" for="pwd">นามสกุล:</label>
      <div class="col-sm-3">          
        <input type="text" class="form-control"  value="<?php echo $M_data['LName']; ?>" disabled>
      </div>
    </div><br>
    <br>
    <div class="form-group">
      <label class="control-label col-sm-1" for="pwd">คณะ:</label>
      <div class="col-sm-3">          
        <input type="text" class="form-control"  value="<?php echo $M_data['Faculty']; ?>" disabled>
      </div>
      <label class="control-label col-sm-1" for="pwd">สาขา:</label>
      <div class="col-sm-3">          
        <input type="text" class="form-control"  value="<?php echo $M_data['Major']; ?>" disabled>
      </div>
    </div><br>
    <br>
    <div class="form-group">
      <label class="control-label col-sm-1" for="pwd">เบอร์โทร:</label>
      <div class="col-sm-3">          
        <input type="text" class="form-control"  value="<?php echo $M_data['Tel']; ?>" disabled>
      </div>
      <label class="control-label col-sm-1" for="pwd">อีเมล:</label>
      <div class="col-sm-3">          
        <input type="text" class="form-control"  value="<?php echo $M_data['Email']; ?>" disabled>
      </div>
    </div><br>
    <br>
    <div class="form-group">
      <label class="control-label col-sm-1" for="pwd">ที่อยู่:</label>
      <div class="col-sm-3"> 
        <textarea class="form-control" disabled><?php echo $M_data['Address']; ?></textarea><br><br>
</fieldset>
<br>
<br>
			