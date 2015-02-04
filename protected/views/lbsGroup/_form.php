<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-setting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '儲存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->