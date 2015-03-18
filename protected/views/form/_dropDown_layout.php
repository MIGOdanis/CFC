<?php
$option = explode("&",$_POST['option']);
$ojbArray = array();
$warpArray = array();
foreach ($option as $value) {
	$text = explode("=",$value);
	if(strstr($text[0],"warp") !== false){
		$w++;
		$warpArray[$w] = urldecode($text[1]);
	}else{
		$r++;
		$ojbArray[$r] = urldecode($text[1]);	
	}
	
}

if ($_POST['update'] == 0){	
	$objectId = md5(time()."multiText".rand(0,99));
}else{
	$objectId = $_POST['objid'];
}
?>
<?php if ($_POST['update'] == 0) {?>
<div class="form-group dropDown-group object-group" id="<?php echo $objectId; ?>">
<?php }?>
	<?php
	$array = array(
		"type" => "dropDown",
		"value" => $_GET['pid'],
		"title" => $_POST['title'],
		"caption" => $_POST['caption'],
		"option" => $ojbArray,
		"warp" => $_POST['warp'],
		"warpArray" => $warpArray,
		"id" => $objectId,
		"required" => $_POST['required']

	);
	$json = json_encode($array);
	?>
	<input type="hidden" id="hide-<?php echo $objectId; ?>" name="forms[]" value='<?php echo $json; ?>' />
	<div><label><?php echo $_POST['title'];?><?php if($_POST['required'] == 1){ echo '<span class="required-form">*</span>'; } ?></label></div>
	<div><small><?php echo $_POST['caption'];?></small></div>
	<div>
		<select name="<?php echo $objectId; ?>" class="dropDownListOjb">
			<option>請選擇一個項目</option>
			<?php 
			foreach ($ojbArray as $key => $ojbText) {
				$i++;
				if(!empty($ojbText)){
			?>
		  		<option>
		  		<?php 
		  		echo $ojbText;

		  		if($_POST['warp'] == 1){
			  		if($warpArray[$i] == "next"){
			  			echo "=> 下一頁";
			  		}elseif($warpArray[$i] == "end"){
			  			echo "=> 提交表單";
			  		}else{
			  			echo "=> 第".$warpArray[$i]."頁";
			  		}
			  	}
		  		?>
		  		</option>
			<?php 
				}
			} ?>
		</select>
	</div>

	<div class="setting-btn-group">
		<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $objectId; ?>"   data-type="dropDown">
		  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
		</button>
		<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="<?php echo $objectId; ?>" data-page="1">
			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
		</button>
	</div>	
<?php if ($_POST['update'] == 0) {?>	
</div>
<?php }?>