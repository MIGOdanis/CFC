<div class="form-group dropDown-group object-group <?php if($object->required == 1){ echo 'required-check'; } ?>" id="<?php echo $object->id; ?>" data-type="<?php echo $object->type; ?>">
	<?php
	$array = array(
		"type" => "dropDown",
		"value" => $object->page,
		"title" => $object->title,
		"caption" => $object->caption,
		"option" => $object->option,
		"warp" => $object->warp,
		"warpArray" => $object->warpArray,
		"required" => $object->required,
		"id" => $object->id

	);
	$json = json_encode($array);

	$warpArray = (array)$object->warpArray;
	$wa = array();
	foreach ($warpArray as $value) {
		$wa[] = $value;
	}
	?>
	<?php if($update){?>
	<input type="hidden" id="hide-<?php echo $object->id; ?>" name="forms[]" value='<?php echo $json; ?>' />
	<?php }?>
	<div><label><span class="index"></span> <?php echo $object->title;?> <?php if($object->required == 1){ echo '<span class="required-form">必填*</span>'; } ?></label></div>
	<div><small><?php echo $object->caption;?></small></div>
	<div>
		<?php if($object->warp == 1){?>
			<input type="hidden" id="hide-<?php echo $object->id; ?>-dropWarp" name="hide-<?php echo $object->id; ?>-dropWarp" value="" />
		<?php }?>
		<select name="<?php echo $object->id; ?>" class="dropDownListOjb">
			<option >請選擇一個項目</option>
			<?php 
			foreach ($object->option as $key => $ojbText) {
				$i++;
				if(!empty($ojbText)){
			?>
		  		<option value="<?php echo $ojbText;?>" data-warp="<?php echo $wa[$i -1];?>" >
		  		<?php 
		  		echo $ojbText;
		  		if($object->warp == 1){
			  		if($wa[$i -1] == "next"){
			  			echo ($update) ? "=> 下一頁" : " (前往下一頁)";
			  		}elseif($warpArray[$i] == "end"){
			  			echo ($update) ? "提交表單": " (提交表單)";
			  		}else{
			  			echo ($update) ? "=> 第" . $wa[$i -1] . "頁" : " (前往第" . $wa[$i -1] . "頁)";
			  		}
			  	}
			  	//echo $warpArray[$i]; exit;
		  		?>
		  		</option>
			<?php 
				}
			} ?>
		</select>
	</div>
	<?php if($update){?>
	<div class="setting-btn-group">
		<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $object->id; ?>"   data-type="dropDown">
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="<?php echo $object->id; ?>" data-page="1">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>
	</div>	
	<?php }?>
</div>