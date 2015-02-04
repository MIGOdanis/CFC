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

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'name'); ?></label>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128 , "class"=>"form-control" , "placeholder"=>"參數名稱")); ?>
		<p class="text-danger"><?php echo $form->error($model,'name'); ?></p>
	</div>

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'key'); ?></label>
		<?php echo $form->textField($model,'key',array('size'=>60,'maxlength'=>128 , "class"=>"form-control" , "placeholder"=>"關聯值" )); ?>
		<p class="text-danger"><?php echo $form->error($model,'key'); ?></p>
	</div>
	<div class="form-group">
		<label><?php echo $form->labelEx($model,'value'); ?></label>
		<?php echo $form->textField($model,'value',array('size'=>60,'maxlength'=>128 , "class"=>"form-control" , "placeholder"=>"參數")); ?>
		<p class="text-danger"><?php echo $form->error($model,'value'); ?></p>
	</div>	

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '儲存',array('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->