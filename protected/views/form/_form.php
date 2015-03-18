<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/bootstrap/validator/js/validator.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/ss-theam/jquery-ui.css">
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/tinymce/tinymce.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/css/form.css">
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/form.js"></script>
<div class="form">
<style type="text/css">
	.single-select-input-box{
		height: 30px;
		background: url("<?php echo Yii::app()->params['baseUrl']; ?>/assets/image/icon/select.png?t=123");
		background-repeat: no-repeat;
		background-position: left;
		padding-left: 20px;
		margin-bottom: 10px;
	}
	.modal-footer{
		margin-top: 20px;
	}
</style>
<script type="text/javascript">
	var active = 2;
</script>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'site-setting-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<?php 
	$err = $form->errorSummary($model);
	if(!empty($err)):?>
	<div class="alert alert-danger" role="alert">
		<span class="sr-only">錯誤:</span>
		<?php echo $err; ?>
	</div>	
	<?php endif;?>

	<?php 
	$this->renderPartial('_form_setting',array(
		'form'=> $form,
		'model'=> $model,
	));
	?>
 
	<div id="temps">
		<input type="hidden" id="pageCount" value='1' />	
		<div class="form-box" id="page1">
			<?php
			$array = array(
				"type" => "headerPage"
			);
			$json = json_encode($array);
			?>
			<input type="hidden" name="forms[]" value='<?php echo $json; ?>' />	
			<div class="form-box-label">首頁(1/<span class="tot-page">1</span>)</div>
			<h1 id="headerTitle">
				<?php
				$array = array(
					"type" => "headerTitle"
				);
				$json = json_encode($array);
				?>
				<input type="hidden" name="forms[]" value='<?php echo $json; ?>' />
			</h1>
			<h3 id="headerCaption">
				<?php
				$array = array(
					"type" => "headerCaption"
				);
				$json = json_encode($array);
				?>
				<input type="hidden" name="forms[]" value='<?php echo $json; ?>' />				
			</h3>
			<div id="page1-group">
				<div class="title-group">
				</div>
				<div class="ojb-group">
					
				</div>
				<div class="form-group">
					<label>本頁結束之後</label>
					<div class="btn-group page-over">
						<?php
						$array = array(
							"type" => "pageOver",
							"page" => 1,
							"value" => "end"
						);
						$json = json_encode($array);
						?>					
						<input id="page1-over" type="hidden" name="forms[]" value='<?php echo $json; ?>' />	
						<button id="type-list" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
						<span id="page1-over-select">提交表單</span> <span class="caret"></span>
						</button>
					  	<ul class="page-over-dropdown-menu dropdown-menu" role="menu" data-page="1">
							<li class="page1-over-selected" ><a class="page-over-selected" data-value="next">下一頁</a></li>
							<li class="page1-over-selected" ><a class="page-over-selected" data-value="end">提交表單</a></li>
						</ul>
					</div>					
				</div>			
			</div>
			<button type="button" class="btn btn-default btn-sm select-btn" data-page="1">
			  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			</button>
		</div>
	</div>

	<div class="modal fade" id="modal">
		<div class="modal-dialog">
			<div class="modal-content" id="modal-content">

			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '儲存',array('class' => 'btn btn-primary')); ?>
	</div>	
<?php $this->endWidget(); ?>

</div><!-- form -->