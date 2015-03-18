<div class="form-group multiText-group object-group <?php if($object->required == 1){ echo 'required-check'; } ?>" id="<?php echo $object->id; ?>" data-type="<?php echo $object->type; ?>">
	<?php
	$array = array(
		"type" => "multiText",
		"value" => $object->page,
		"title" => $object->title,
		"caption" => $object->caption,
		"required" => $object->required,
		"id" => $object->id
	);
	$json = json_encode($array);
	?>
	<?php if($update){?>
	<input type="hidden" id="hide-<?php echo $object->id; ?>" name="forms[]" value='<?php echo $json; ?>' />
	<?php } ?>
	<div><label><span class="index"></span> <?php echo $object->title;?> <?php if($object->required == 1){ echo '<span class="required-form">必填*</span>'; } ?></label></div>
	<div><small><?php echo $object->caption;?></small></div>
	<textarea class="form-control" rows="3" <?php if($object->required == 1){ echo 'placeholder="必填"'; } ?><?php if(!$update){?> name="<?php echo $object->id; ?>" <?php } ?>></textarea>
	<?php if($update){?>
	<div class="setting-btn-group">
		<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $object->id; ?>"  data-type="multiText">
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="<?php echo $object->id; ?>" data-page="1">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>		
	</div>
	<?php } ?>
</div>