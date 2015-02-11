<?php
$targets = explode(":", $model->target);
?>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/tinymce/tinymce_config.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/ss-theam/jquery-ui.css">
<script>
var tinymce_editor; 
</script>
<script>
$(function() {
	$( "#day" ).datepicker({
		defaultDate: "+0d",
		// maxDate: "today",
		minDate: "2014-12-01",
		changeMonth: true,
		numberOfMonths: 1,
		dateFormat:"yy-mm-dd",
		onClose: function( selectedDate ) {
			$( "#end_day" ).datepicker( "option", "minDate", selectedDate );
		}
	});
});
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

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'title'); ?></label>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>70 , "class"=>"form-control" , "placeholder"=>"標題")); ?>
		<p class="text-danger"><?php echo $form->error($model,'title'); ?></p>
	</div>
	<div class="form-group">
		<label><?php echo $form->labelEx($model,'content'); ?></label>
		<textarea name="Message[content]" rows="20" id="Message_content">
			<?php echo (isset($_POST['content'])) ? $_POST['content'] : $model['content'];?>
		</textarea>
		<p class="text-danger"><?php echo $form->error($model,'content'); ?></p>
	</div>

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'target'); ?></label>
		<?php foreach (Yii::app()->params['msgTarget'] as $key => $target) {	?>
			<label class="checkbox-inline">
		  		<input type="checkbox" name="target[]" value="<?php echo $key;?>" <?php if(in_array($key, $targets)){ echo "checked"; }?>>
		  		<?php echo $target;?>
			</label>	
		<?php }?>
		<p class="text-danger"><?php echo $form->error($model,'target'); ?></p>
	</div>

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'type'); ?></label>
		<?php echo $form->dropDownList($model,'type',Yii::app()->params['msgType']); ?>
		<p class="text-danger"><?php echo $form->error($model,'type'); ?></p>
	</div>

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'active_time'); ?></label>
		<input type="text" id="day" name="active_time" value="<?php echo ($model->isNewRecord) ? date("Y-m-d") : date("Y-m-d",$model->active_time)?>">
		<p class="text-danger"><?php echo $form->error($model,'active_time'); ?></p>
	</div>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '儲存',array('class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->