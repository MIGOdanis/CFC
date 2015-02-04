<style type="text/css">
	#import{
		margin-top: 10px;
		margin-bottom: 10px;
	}
</style>
<div class="page-header">
  <h1>匯入LBS</h1>
</div>
<div id="import">
	<form enctype="multipart/form-data" action="import" method="POST">
		<div class="form-group">
			<span>地址欄位請用,號分開</span>
			<textarea class="form-control" rows="15" name="address"></textarea>
		</div>
		<div class="form-group">
		<div class="type-box"><b>群組</b></div>
		<span>
			<select name="group">
				<?php foreach ($LbsGroup as $value) {?>
					<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
				<?php }?>
			</select>		
		</span>
		</div>
		<button type="subtim" class="btn btn-primary">送出</button>
	</form>
</div>