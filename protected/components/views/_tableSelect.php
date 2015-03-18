<div class="form-group tableSelect-group object-group <?php if($object->required == 1){ echo 'required-check'; } ?>" id="<?php echo $object->id; ?>" data-type="<?php echo $object->type; ?>">
	<?php
	$array = array(
		"id" => $object->id,
		"type" => "tableSelect",
		"title" => $object->title,
		"caption" => $object->caption,
		"column" => $object->column,
		"required" => $object->required,
		"row" => $object->row
	);
	$json = json_encode($array);
	?>
	<?php if($update){?>
	<input type="hidden" id="hide-<?php echo $object->id; ?>" name="forms[]" value='<?php echo $json; ?>' />
	<?php }?>
	<div><label><span class="index"></span> <?php echo $object->title;?> <?php if($object->required == 1){ echo '<span class="required-form">必填*</span>'; } ?></label></div>
	<div><small><?php echo $object->caption;?></small></div>
	<div>
	<table class="tableSelect-table">
		<tr>
			<th></th>
			<?php foreach ($object->column as $th) {?>
				<th><div class="tableSelect-column-text"><?php echo $th; ?></div></th>
			<?php }?>
		</tr>
		<?php foreach ($object->row as $key => $tr) {?>
			<tr>
				<td><div class="tableSelect-row-text"><?php echo $tr; ?></div></td>
				<?php foreach ($object->column as $th) {?>
					<td><input type="radio" class="radios" name="<?php echo $object->id."-".$key; ?>" value="<?php echo $th . "," . $tr;?>"></td>
				<?php }?>
			</tr>
		<?php }?>		
	</table>
	</div>
	<?php if($update){?>
	<div class="setting-btn-group">
		<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $object->id; ?>"   data-type="tableSelect">
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="<?php echo $object->id; ?>" data-page="1">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>
	</div>	
	<?php } ?>
</div>