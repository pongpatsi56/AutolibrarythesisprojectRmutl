<?php
include_once "../../layout/head.php";
include_once "../../helper/datehelper.php";
date_default_timezone_set('asia/bangkok');
$date_now = date("Y-m-d");
$datetimes_now = date("Y-m-d H:i:s");
$datenow = convert_datethai_monthdot($date_now);

?>
<style>
	.table {
		font-size: 12px;
		font-family: sans-serif;
	}

	thead {
		background-color: lightgray;
	}

	td {
		background-color: #f5f5f5;
	}
</style>
<br>
<br>
<br>
<section class="container">
	<div class="row" style="padding-top: 20px;padding-bottom: 30px; background-color: #eee;">
		<div class="col-md-12">
			<a href="../librarian/librarian.php"><img src='/lib/iconimg/left-arrow (3).png' width='40' height='40'></i></a>
			&nbsp;&nbsp;<b style="font-size: 25px;">ทำรายการจองทรัพยากร</b>
			<br>
			<br>
			<fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em;">
				<legend style="width: auto;padding:0 5px 0 5px;">รหัสสมาชิก</legend>
				<br>
				<div class="col-md-6">
					<label for="pwd">รหัสสมาชิก:</label>
					<input type="text" class="btn btn-white" id="text_member" required>
					<input type="button" class="btn btn-primary" id="gosearch" value="สืบค้นสมาชิก">
					<input type="button" class="btn btn-default" onclick="clear_data()" value="เคลียร์">
				</div>
				<div class="col-md-6"></div>
				<br>
				<br>
				<br>
				<div class="form-group">
					<label class="control-label col-sm-1" for="pwd">ชื่อ:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" value="" disabled id="FName">
					</div>
					<label class="control-label col-sm-1" for="pwd">นามสกุล:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" value="" disabled id="LName">
					</div>
					<label class="control-label col-sm-1" for="pwd">คณะ:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" value="" disabled id="Facul">
					</div>
				</div>
				<br>
				<br>
				<div class="form-group">
					<label class="control-label col-sm-1" for="pwd">สาขาวิชา:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" value="" disabled id="Major">
					</div>

					<label class="control-label col-sm-1" for="pwd">เบอร์มือถือ:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" value="" disabled id="tel">
					</div>
					<label class="control-label col-sm-1" for="pwd">อีเมล์:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" value="" disabled id="mail">
					</div>
				</div>
				<br>
				<br>
				<div class="form-group">
					<label class="control-label col-sm-1" for="pwd">ที่อยู่:</label>
					<div class="col-sm-3">
						<textarea class="form-control" disabled id="addr"></textarea>
					</div>
				</div>
				<br>
				<br>
			</fieldset>
			<br>
			<fieldset style="border: 2px solid silver;margin: 0 2px;padding: .35em .625em .75em;">
				<legend style="width: auto;padding:0 5px 0 5px;">จองทรัพยากร</legend>
				<br>
				<div class="col-md-6">
					<label for="pwd">บาร์โค้ด:</label>&nbsp;
					<input type="text" class="btn btn-white" id="text_resource" required>&nbsp;
					<input type="button" class="btn btn-primary" id="searh_res" value="สืบค้นทรัพยากร">
				</div>
				<div class="col-md-6"></div>
				<br>
				<br>
				<br>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">ชื่อเรื่อง:</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" value="" disabled id="resource_name">
					</div>
				</div>
				<br>
				<br>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">ประเภททรัพยากร:</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" value="" disabled id="resource_type">
					</div>
				</div>
				<br>
				<br>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">วันที่จอง:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" value="<?= $datenow ?>" disabled>
						<input type="hidden" value="<?= $datetimes_now ?>" id="start_reserve_date">
					</div>
					<label class="control-label col-sm-2" for="pwd">วันที่คาดว่าจะได้รับ:</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" value="" disabled id="get_date_show">
						<input type="hidden" value="" id="get_date">
					</div>
				</div>
				<br>
				<br>
				<div class="form-group">
					<div class="col-sm-2"></div>
					<div class="col-sm-3">
						<input type="button" class="btn btn-success" id="gosave_resv" value="บันทึก">
						&nbsp;
						<input type="button" class="btn btn-default" onclick="clear_res()" value="เคลียร์">
					</div>
				</div>
				<br>
				<br>
				<table class="table table-bordered table-hover">
					<thead class="thead-light">
						<tr>
							<th>
								ลำดับ
							</th>
							<th>
								รหัสสมาชิก
							</th>
							<th>
								ชื่อสมาชิก
							</th>
							<th>
								วันที่จอง - เวลาจอง
							</th>
							<!-- <th>
								หมายเหตุ
							</th> -->
						</tr>
					</thead>
					<tbody id="tbody">
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tbody>
				</table>
			</fieldset>
		</div>
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . "/lib/layout/End.php";
		?>
		<script src="/lib/script/reservations.js"></script>