<style type="text/css">
	.form-group{
		margin-top: 10px;
	}
</style>
<div class="page-header">
  <h1>LBS群組匯出</h1>
</div>
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
	<a class="btn btn-default" href="exportIndex?LbsLatlng[group_id]=<?php echo $_GET['id'];?>">回到列表</a>
</div>	
<div class="form-group">
	<textarea class="form-control" rows="15" name="address"><?php echo $lbs; ?></textarea>
</div>

