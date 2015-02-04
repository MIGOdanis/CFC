<div class="page-header">
  <h1>設定權限</h1>
  <p class="help-block">勾選賦予使用者<?php echo $model->username;?>的權限設定</p>
</div>
<?php
require dirname(__FILE__).'/../layouts/_set_menu.php';
?>
<form id="site-setting-form" action="" method="post">
	<?php foreach ($fullMenu as $key => $value) {?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo $value['title'];?></h3>
		</div>
		<div class="panel-body">
			<?php 
			foreach ($value['action'] as $action) {
			$inputValue = $action['controller'] . "/" . implode("&",$action['action']);
			?>
				<label class="checkbox-inline">
			  		<input type="checkbox" name="auth[]" value="<?php echo $inputValue;?>" <?php if(in_array($inputValue,$userAuth)){ echo "checked"; }?>>
			  		<?php echo $action['title'];?>
				</label>	
			<?php }?>
		</div>
	</div>
	<?php }?>


	<div class="form-group buttons">
		<input class="btn btn-primary" type="submit" name="yt0" value="修改">
	</div>

</form>