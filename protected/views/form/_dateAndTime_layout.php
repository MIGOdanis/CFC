<?php
if ($_POST['update'] == 0){	
	$objectId = md5(time()."multiText".rand(0,99));
}else{
	$objectId = $_POST['objid'];
}
?>
<?php if ($_POST['update'] == 0) {?>
<div class="form-group dateAndTime-group object-group" id="<?php echo $objectId; ?>">
<?php }?>
	<?php
	$array = array(
		"type" => "dateAndTime",
		"value" => $_GET['pid'],
		"title" => $_POST['title'],
		"caption" => $_POST['caption'],
		"date" =>  $_POST['date'],
		"time" =>  $_POST['time'],
		"id" => $objectId
	);
	$json = json_encode($array);
	?>
	<input type="hidden" id="hide-<?php echo $objectId; ?>" name="forms[]" value='<?php echo $json; ?>' />
	<div><label><?php echo $_POST['title'];?></label></div>
	<div><small><?php echo $_POST['caption'];?></small></div>
	
	<?php if($_POST['date'] == 1){ ?>
	<div class="form-group">
		<h4>日期</h4>
			<input type="text" id="day-<?php echo $objectId; ?>" class="datepick" name="date" value="<?php echo date("Y-m-d"); ?>">
		<p class="text-danger"></p>
	</div>
	<?php }?>
	<?php if($_POST['time'] == 1){ ?>
	<div class="form-group">
		<h4>時間</h4>
			<div class="time-select-group">
				<select name="<?php echo $objectId; ?>" class="dropDownListOjb">
					<option>小時</option>
					<?php for ($i=1; $i <= 24 ; $i++) { ?>
				  		<option><?php echo $i; ?></option>
					<?php } ?>
				</select>
				:
				<select name="<?php echo $objectId; ?>" class="dropDownListOjb">
					<option>分鐘</option>
					<?php for ($i=1; $i <= 60 ; $i++) { ?>
				  		<option><?php echo $i; ?></option>
					<?php } ?>
				</select>						
			</div>
		<p class="text-danger"></p>
	</div>
	<?php }?>
	<div class="setting-btn-group">
		<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $objectId; ?>"  data-type="dateAndTime" >
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="<?php echo $objectId; ?>" data-page="1">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>
	</div>
<?php if ($_POST['update'] == 0) {?>	
</div>
<?php }?>