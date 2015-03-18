<div class="form-group multiSelect-group object-group <?php if($object->required == 1){ echo 'required-check'; } ?>" id="<?php echo $object->id; ?>" data-type="<?php echo $object->type; ?>">
	<?php
	$array = array(
		"type" => "multiSelect",
		"value" => $object->page,
		"title" => $object->title,
		"caption" => $object->caption,
		"select" => $object->select,
		"other" => $object->other,
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
	<?php
	$i =0;
	foreach ($object->select as $key => $ojbText) {
		if(!empty($ojbText)){
			$i++;
	?>
		<div><input type="checkbox" name="<?php echo $object->id; ?>[]" class="checkboxs" value="<?php echo $ojbText; ?>" <?php if($update){?> disabled <?php } ?>><?php echo $i. ". " . $ojbText; ?></div>
	<?php 
		}
	}
	if($object->other == 1){ ?>
		<div class="multiSelect-other-box">
			<input type="checkbox" name="<?php echo $object->id; ?>[]"  class="checkboxs multiSelect-other-checkbox" value="other" <?php if($update){?> disabled <?php } ?>>
			<input size="60" maxlength="70" name="<?php echo $object->id; ?>-other" class="form-control multiSelect-other-text" placeholder="其他" type="text" <?php if($update){?> disabled <?php } ?>>
		</div>
	<?php } ?>
	<?php if($update){?>
	<div class="setting-btn-group">
		<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $object->id; ?>"   data-type="multiSelect">
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="<?php echo $object->id; ?>" data-page="1">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>
	</div>	
	<?php }?>	
</div>