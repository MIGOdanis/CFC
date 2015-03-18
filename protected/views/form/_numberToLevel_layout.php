<?php
if ($_POST['update'] == 0){	
	$objectId = md5(time()."multiText".rand(0,99));
}else{
	$objectId = $_POST['objid'];
}
?>
<?php if ($_POST['update'] == 0) {?>
<div class="form-group numberToLevel-group object-group" id="<?php echo $objectId; ?>">
<?php }?>
	<?php
	$array = array(
		"type" => "numberToLevel",
		"value" => $_GET['pid'],
		"title" => $_POST['title'],
		"caption" => $_POST['caption'],
		"fristSTR" => $_POST['fristSTR'],
		"lastSTR" => $_POST['lastSTR'],
		"id" => $objectId,
		"required" => $_POST['required']
	);
	$json = json_encode($array);
	?>
	<input type="hidden" id="hide-<?php echo $objectId; ?>" name="forms[]" value='<?php echo $json; ?>' />
	<div><label><?php echo $_POST['title'];?><?php if($_POST['required'] == 1){ echo '<span class="required-form">*</span>'; } ?></label></div>
	<div><small><?php echo $_POST['caption'];?></small></div>
	<div>
	<table class="ntl-table">
		<tr>
			<td></td>
			<td>1</td>
			<td>2</td>
			<td>3</td>
			<td>4</td>
			<td>5</td>
			<td>6</td>
			<td>7</td>
			<td>8</td>
			<td>9</td>
			<td>10</td>
			<td></td>
		</tr>
		<tr>
			<td><?php echo $_POST["fristSTR"]; ?></td>
			<td><input type="radio" name="ntl-<?php echo $objectId; ?>" value=""></td>
			<td><input type="radio" name="ntl-<?php echo $objectId; ?>" value=""></td>
			<td><input type="radio" name="ntl-<?php echo $objectId; ?>" value=""></td>
			<td><input type="radio" name="ntl-<?php echo $objectId; ?>" value=""></td>
			<td><input type="radio" name="ntl-<?php echo $objectId; ?>" value=""></td>
			<td><input type="radio" name="ntl-<?php echo $objectId; ?>" value=""></td>
			<td><input type="radio" name="ntl-<?php echo $objectId; ?>" value=""></td>
			<td><input type="radio" name="ntl-<?php echo $objectId; ?>" value=""></td>
			<td><input type="radio" name="ntl-<?php echo $objectId; ?>" value=""></td>
			<td><input type="radio" name="ntl-<?php echo $objectId; ?>" value=""></td>
			<td><?php echo $_POST["lastSTR"]; ?></td>
		</tr>		
	</table>
	</div>
	<div class="setting-btn-group">
		<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $objectId; ?>"  data-type="numberToLevel">
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="<?php echo $objectId; ?>" data-page="1">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>
	</div>
<?php if ($_POST['update'] == 0) {?>	
</div>
<?php }?>