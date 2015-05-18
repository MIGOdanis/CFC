<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/bootstrap/validator/js/validator.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/ss-theam/jquery-ui.css">
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/tinymce/tinymce.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/css/form.css">
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/form.js"></script>
<style type="text/css">
	.single-select-input-box{
		height: 30px;
		background: url("<?php echo Yii::app()->params['baseUrl']; ?>/assets/image/icon/select.png?t=123");
		background-repeat: no-repeat;
		background-position: left;
		padding-left: 20px;
		margin-bottom: 10px;
	}
	.hide-page{
		display: none;
	}
</style>
<script type="text/javascript">
	var active = <?php echo $model->active; ?>;
	$(function(){
		updateTC();
	})
</script>
<div class="form">

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

	$pages = json_decode($model->question);
	$count = count((array)$pages);
	?>
 
	<div id="temps">
		<input type="hidden" id="pageCount" value='<?php echo $count;?>' />	
		<?php
		// print_r($pages); exit;
		foreach ($pages as $value) {

		$array = array(
			"type" => "newPage",
			"value" => $value->pageIndex,
			"title" =>  $value->pageTitle,
			"caption" => $value->pageCaption,
			"display" => $value->display
		);
		$json = json_encode($array);
		?>
			<div class="form-box <?php if($value->display == 0){ echo "hide-page"; }?>" id="page<?php echo $value->pageIndex;?>">
				<input type="hidden" id="hide-<?php echo $value->pageIndex;?>" name="forms[]" value='<?php echo $json;?>'>
				<div class="form-box-label">分頁(<span class="this-page"><?php echo $value->pageIndex;?></span>/<span class="tot-page"><?php echo $count;?></span>)</div>	
				<div id="page<?php echo $value->pageIndex;?>-group">
					<div class="title-group">
						<h1><?php echo $value->pageTitle;?></h1>
						<h3><?php echo $value->pageCaption;?></h3>
					</div>
					<div class="ojb-group">
						<?php
							if(!empty($value->object)){
								foreach ($value->object as $object) {
									$this->widget('FormWidget', 
										array(
											'object'=>$object,
											'update' => 1
										)
									);
								}
							}
						?>
					</div>
					<div class="form-group">
							<label>本頁結束之後</label>
							<div class="btn-group page-over">		
								<?php
								$array = array(
									"type" => "pageOver",
									"page" => $value->pageIndex,
									"value" => $value->pageOver
								);
								$json = json_encode($array);
								?>										
								<input id="page<?php echo $value->pageIndex;?>-over" type="hidden" name="forms[]" value='<?php echo $json;?>'>	
								<button id="type-list" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
								<span id="page<?php echo $value->pageIndex;?>-over-select">
								<?php
									if($value->pageOver == "next"){
										echo "下一頁";
									}elseif($value->pageOver == "end"){
										echo "提交表單";
									}else{
										echo "第" . $value->pageOver . "頁";
									}
								?>
								</span><span class="caret"></span>
								</button>
							  	<ul class="page-over-dropdown-menu dropdown-menu" role="menu" data-page="<?php echo $value->pageIndex;?>">
									<li class="page<?php echo $value->pageIndex;?>-over-selected" ><a class="page-over-selected" data-value="next">下一頁</a></li>
									<?php 
									for ($i=1; $i <= $count; $i++) { 
									?>
								  		<li class="page<?php echo $value->pageIndex;?>-over-selected" ><a class="page-over-selected" data-value="<?php echo $i;?>">第<?php echo $i;?>頁</a></li>
									<?php 
									} ?>						
									<li class="page<?php echo $value->pageIndex;?>-over-selected" ><a class="page-over-selected" data-value="end">提交表單</a></li>
							  	</ul>
							</div>					
						</div>
				</div>	
				<button type="button" class="btn btn-default btn-sm select-btn" data-page="<?php echo $value->pageIndex;?>">
				  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
				<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo $value->pageIndex;?>" data-type="newPage">
				  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</button>	
				<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="page<?php echo $value->pageIndex;?>" data-page="<?php echo $value->pageIndex;?>" data-type="newPage">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>	
			</div>
		<?php
		} 
		?>
	</div>

	<div class="modal fade" id="modal">
		<div class="modal-dialog">
			<div class="modal-content" id="modal-content">

			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '儲存',array('class' => 'btn btn-primary')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->