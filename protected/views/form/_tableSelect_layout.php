<?php
$column = explode("&",$_POST['column']);
$columnArray = array();
foreach ($column as $value) {
	$text = explode("=",$value);
		$c++;
		$columnArray[$c] = urldecode($text[1]);		
}

$row = explode("&",$_POST['row']);
$rowArray = array();
foreach ($row as $value) {
	$text = explode("=",$value);
		$r++;
		$rowArray[$r] = urldecode($text[1]);		
}
//print_r($columnArray); exit;
if ($_POST['update'] == 0){	
	$objectId = md5(time()."multiText".rand(0,99));
}else{
	$objectId = $_POST['objid'];
}
?>
<?php if ($_POST['update'] == 0) {?>
<div class="form-group tableSelect-group object-group" id="<?php echo $objectId; ?>">
<?php }?>
	<?php
	$array = array(
		"type" => "tableSelect",
		"value" => $_GET['pid'],
		"title" => $_POST['title'],
		"caption" => $_POST['caption'],
		"column" => $columnArray,
		"row" => $rowArray,
		"required" => $_POST['required'],
		"id" => $objectId

	);
	$json = json_encode($array);
	?>
	<input type="hidden" id="hide-<?php echo $objectId; ?>" name="forms[]" value='<?php echo $json; ?>' />
	<div><label><?php echo $_POST['title'];?><?php if($_POST['required'] == 1){ echo '<span class="required-form">*</span>'; } ?></label></div>
	<div><small><?php echo $_POST['caption'];?></small></div>
	<div>
	<table class="tableSelect-table">
		<tr>
			<th></th>
			<?php foreach ($columnArray as $th) {?>
				<th><div class="tableSelect-column-text"><?php echo $th; ?></div></th>
			<?php }?>
		</tr>
		<?php foreach ($rowArray as $key => $tr) {?>
			<tr>
				<td><div class="tableSelect-row-text"><?php echo $tr; ?></div></td>
				<?php foreach ($columnArray as $th) {?>
					<td><input type="radio" name="<?php echo $objectId."-".$key; ?>" value=""></td>
				<?php }?>
			</tr>
		<?php }?>		
	</table>
	</div>

	<div class="setting-btn-group">
		<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $objectId; ?>"   data-type="tableSelect">
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="<?php echo $objectId; ?>" data-page="1">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>
	</div>	
</div>