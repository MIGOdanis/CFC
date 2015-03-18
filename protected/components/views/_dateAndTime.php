<div class="form-group dateAndTime-group object-group" id="<?php echo $object->id; ?>">
	<?php
	$array = array(
		"type" => "dateAndTime",
		"id" => $object->id,
		"title" => $object->title,
		"caption" => $object->caption,
		"required" => $object->required,
		"date" => $object->date,
		"time" => $object->time,
	);
	$json = json_encode($array);
	?>
	<?php if($update){?>
	<input type="hidden" id="hide-<?php echo $object->id; ?>" name="forms[]" value='<?php echo $json; ?>' />
	<?php } ?>
	<div><label><span class="index"></span> <?php echo $object->title;?></label></div>
	<div><small><?php echo $object->caption;?></small></div>
	
	<?php if($object->date == 1){ ?>
	<div class="form-group">
		<h4>日期</h4>
			<input type="text" id="day-<?php echo $object->id; ?>" class="datepick" name="<?php echo $object->id; ?>-d" value="<?php echo date("Y-m-d"); ?>">
		<p class="text-danger"></p>
	</div>
	<?php }?>
	<?php if($object->time == 1){ ?>
	<div class="form-group">
		<h4>時間</h4>
			<div class="time-select-group">
				<select name="<?php echo $object->id; ?>-h" class="dropDownListOjb">
					<option>小時</option>
					<?php for ($i=1; $i <= 24 ; $i++) { ?>
				  		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php } ?>
				</select>
				:
				<select name="<?php echo $object->id; ?>-i" class="dropDownListOjb">
					<option>分鐘</option>
					<?php for ($i=1; $i <= 60 ; $i++) { ?>
				  		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php } ?>
				</select>						
			</div>
		<p class="text-danger"></p>
	</div>
	<?php }?>
	<?php if($update){?>
	<div class="setting-btn-group">
		<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $object->id; ?>"  data-type="dateAndTime" >
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="<?php echo $object->id; ?>" data-page="1">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>
	</div>
	<?php } ?>
</div>