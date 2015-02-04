<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<!-- Bootstrap core CSS -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<div>
	<select name="group" onchange="javascript:window.location=this.value">
		<?php foreach ($LbsGroup as $value) {?>
			<option value="../search/export?id=<?php echo $value->id; ?>"
				<?php if($_GET['id'] == $value->id){ echo 'selected="selected"'; }?>><?php echo $value->name; ?></option>
		<?php }?>
	</select>
	<p>
</div>
<div>
	<a class="btn btn-default" href="index?LbsLatlng[group_id]=<?php echo $_GET['id'];?>">回到列表</a>
</div>	
<div class="form-group">
	<textarea class="form-control" rows="15" name="address"><?php echo $lbs; ?></textarea>
</div>

