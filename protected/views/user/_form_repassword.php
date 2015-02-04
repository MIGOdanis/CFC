<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-setting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php 
	$model->password = "";
	$err = $form->errorSummary($model);
	if(!empty($err)):?>
	<div class="alert alert-danger" role="alert">
		<span class="sr-only">錯誤:</span>
		<?php echo $err; ?>
	</div>	
	<?php endif;?>

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'password'); ?></label>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128 , "class"=>"form-control" , "placeholder"=>"密碼" )); ?>
		<p class="text-danger"><?php echo $form->error($model,'password'); ?></p>
	</div>

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'new_password'); ?></label>
		<?php echo $form->passwordField($model,'new_password',array('size'=>60,'maxlength'=>128 , "class"=>"form-control" , "placeholder"=>"新密碼" )); ?>
		<p class="text-danger"><?php echo $form->error($model,'new_password'); ?></p>
	</div>

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'repeat_password'); ?></label>
		<?php echo $form->passwordField($model,'repeat_password',array('size'=>60,'maxlength'=>128 , "class"=>"form-control" , "placeholder"=>"確認帳號")); ?>
		<p class="text-danger"><?php echo $form->error($model,'repeat_password'); ?></p>
	</div>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '儲存',array('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->