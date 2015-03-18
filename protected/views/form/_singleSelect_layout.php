<?php
$select = explode("&",$_POST['select']);
$ojbArray = array();
foreach ($select as $value) {
	$r++;
	$text = explode("=",$value);
	$ojbArray[$r] = urldecode($text[1]);
}
if ($_POST['update'] == 0){	
	$objectId = md5(time()."singleSelect".rand(0,99));
}else{
	$objectId = $_POST['objid'];
}
?>
<?php if ($_POST['update'] == 0) {?>
<div class="form-group singleSelect-group object-group" id="<?php echo $objectId; ?>">
<?php }?>
	<?php
	$array = array(
		"type" => "singleSelect",
		"value" => $_GET['pid'],
		"title" => $_POST['title'],
		"caption" => $_POST['caption'],
		"select" => $ojbArray,
		"other" => $_POST['other'],
		"required" => $_POST['required'],
		"id" => $objectId

	);
	$json = json_encode($array);
	?>
	<input type="hidden" id="hide-<?php echo $objectId; ?>" name="forms[]" value='<?php echo $json; ?>' />
	<div><label><?php echo $_POST['title'];?><?php if($_POST['required'] == 1){ echo '<span class="required-form">*</span>'; } ?></label></div>
	<div><small><?php echo $_POST['caption'];?></small></div>
	<?php 
	foreach ($ojbArray as $key => $ojbText) {
		if(!empty($ojbText)){
	?>
		<div><input type="radio" name="<?php echo $objectId; ?>" class="radios" value="<?php echo $key; ?>" disabled><?php echo $ojbText; ?></div>
	<?php 
		}
	}
	if($_POST['other'] == 1){ ?>
		<div class="singleSelect-other-box">
			<input type="radio" name="optionsRadios"  class="radios singleSelect-other-radio" value="other" disabled>
			<input size="60" maxlength="70" class="form-control singleSelect-other-text" placeholder="其他" type="text" disabled>
		</div>
	<?php } ?>
	<div class="setting-btn-group">
		<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $objectId; ?>"  data-type="singleSelect">
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="<?php echo $objectId; ?>" data-page="1">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>		
	</div>	
<?php if ($_POST['update'] == 0) {?>	
</div>
<?php }?>