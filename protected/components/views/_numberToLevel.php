<div class="form-group numberToLevel-group object-group <?php if($object->required == 1){ echo 'required-check'; } ?>" id="<?php echo $object->id; ?>" data-type="<?php echo $object->type; ?>">
	<?php
	$array = array(
		"type" => "numberToLevel",
		"value" => $object->page,
		"title" => $object->title,
		"caption" => $object->caption,
		"fristSTR" => $object->fristSTR,
		"lastSTR" => $object->lastSTR,
		"required" => $object->required,
		"id" => $object->id
	);
	$json = json_encode($array);
	?>
	<?php if($update){?>
	<input type="hidden" id="hide-<?php echo $object->id; ?>" name="forms[]" value='<?php echo $json; ?>' />
	<?php }?>
	<div><label><span class="index"></span> <?php echo $object->title;?> <?php if($object->required == 1){ echo '<span class="required-form">必填*</span>'; } ?></label></div>
	<div><small><?php echo $object->caption;?></small></div>
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
			<td><?php echo $object->fristSTR; ?></td>
			<td><input type="radio" class="radios" name="<?php echo $object->id; ?>" value="1"></td>
			<td><input type="radio" class="radios" name="<?php echo $object->id; ?>" value="2"></td>
			<td><input type="radio" class="radios" name="<?php echo $object->id; ?>" value="3"></td>
			<td><input type="radio" class="radios" name="<?php echo $object->id; ?>" value="4"></td>
			<td><input type="radio" class="radios" name="<?php echo $object->id; ?>" value="5"></td>
			<td><input type="radio" class="radios" name="<?php echo $object->id; ?>" value="6"></td>
			<td><input type="radio" class="radios" name="<?php echo $object->id; ?>" value="7"></td>
			<td><input type="radio" class="radios" name="<?php echo $object->id; ?>" value="8"></td>
			<td><input type="radio" class="radios" name="<?php echo $object->id; ?>" value="9"></td>
			<td><input type="radio" class="radios" name="<?php echo $object->id; ?>" value="10"></td>
			<td><?php echo $object->lastSTR; ?></td>
		</tr>		
	</table>
	</div>
	<?php if($update){?>
	<div class="setting-btn-group">
		<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $object->id; ?>"  data-type="numberToLevel">
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="<?php echo $object->id; ?>" data-page="1">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>
	</div>
	<?php } ?>
</div>