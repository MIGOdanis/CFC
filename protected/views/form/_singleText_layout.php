<?php
if ($_POST['update'] == 0){	
	$objectId = md5(time()."singleText".rand(0,99));
}else{
	$objectId = $_POST['objid'];
}
?>
<?php if ($_POST['update'] == 0) {?>
<div class="form-group singleText-group object-group" id="<?php echo $objectId; ?>">
<?php }?>
	<?php
	$array = array(
		"type" => "singleText",
		"value" => $_GET['pid'],
		"title" => $_POST['title'],
		"caption" => $_POST['caption'],
		"required" => $_POST['required'],
		"id" => $objectId
	);
	$json = json_encode($array);
	?>
	<input type="hidden" id="hide-<?php echo $objectId; ?>" name="forms[]" value='<?php echo $json; ?>' />
	<div><label><?php echo $_POST['title'];?><?php if($_POST['required'] == 1){ echo '<span class="required-form">*</span>'; } ?></label></div>
	<div><small><?php echo $_POST['caption'];?></small></div>
	<input class="form-control" type="text" <?php if($_POST['required'] == 1){ echo 'placeholder="必填"'; } ?>>
	<div class="setting-btn-group">
		<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $objectId; ?>" data-type="singleText">
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="<?php echo $objectId; ?>" data-page="1">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>	
	</div>
<?php if ($_POST['update'] == 0) {?>	
</div>
<?php }?>