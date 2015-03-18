<div class="form-group html-group object-group" id="<?php echo $object->id; ?>">
	<?php
	$array = array(
		"type" => "html",
		"html" => $object->html,
		"id" => $object->id
	);
	$json = json_encode($array);
	$html = urldecode($object->html);
	?>
	<?php if($update){?>
	<input type="hidden" id="hide-<?php echo $object->id; ?>" name="forms[]" value='<?php echo $json; ?>' />
	<?php } ?>
	<div id="html-body">
		<?php echo $html ;?>
	</div>
	<?php if($update){?>
	<div class="setting-btn-group">
		<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $object->id; ?>"  data-type="html">
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="<?php echo $object->id; ?>" data-page="1">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>		
	</div>	
	<?php } ?>
</div>