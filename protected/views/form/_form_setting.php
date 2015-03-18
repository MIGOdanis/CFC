<div class="form-box">
	<div class="form-box-label">問卷基本設定</div>

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'title'); ?></label>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>70 , "class"=>"form-control" , "placeholder"=>"標題")); ?>
		<p class="text-danger"><?php echo $form->error($model,'title'); ?></p>
	</div>

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'caption'); ?></label>
		<p class="help-block">問卷摘要，非必填</p>
		<textarea name="Forms[caption]" rows="3" class="form-control" id="Forms_caption"><?php echo (isset($_POST['Forms']['caption'])) ? $_POST['Forms']['caption'] : $model->caption;?></textarea>
		<p class="text-danger"><?php echo $form->error($model,'caption'); ?></p>
	</div>	

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'over_content'); ?></label>
		<p class="help-block">結束頁訊息</p>
		<textarea name="Forms[over_content]" rows="3" class="form-control" id="Forms_over_content"><?php echo (isset($_POST['Forms']['over_content'])) ? $_POST['Forms']['over_content'] : $model->over_content;?></textarea>
		<p class="text-danger"><?php echo $form->error($model,'over_content'); ?></p>
	</div>

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'star_time'); ?></label>
		<?php $model->star_time = ($model->isNewRecord)? date("Y-m-d") : date("Y-m-d" , $model->star_time); ?>
		<?php echo $form->textField($model,'star_time',array('size'=>60,'maxlength'=>70 , "class"=>"form-control" , "placeholder"=>"標題")); ?>
		<p class="text-danger"><?php echo $form->error($model,'star_time'); ?></p>
	</div>

	<div class="form-group">
		<label><?php echo $form->labelEx($model,'end_time'); ?></label>
		<?php $model->end_time = ($model->isNewRecord)? date("Y-m-d") : date("Y-m-d" , $model->end_time); ?>
		<?php echo $form->textField($model,'end_time',array('size'=>60,'maxlength'=>70 , "class"=>"form-control" , "placeholder"=>"標題")); ?>
		<p class="text-danger"><?php echo $form->error($model,'end_time'); ?></p>
	</div>	

	<div class="form-group">
		<label class="checkbox-inline">
	  		<input type="checkbox" name="Forms[progress]" value="1" <?php if($model->progress){ echo "checked"; }?>>
	  		顯示進度條
		</label>
	</div>	
	<script type="text/javascript">
		$(function() {
			$( "#Forms_end_time , #Forms_star_time" ).datepicker({
				defaultDate: "+0d",
				// maxDate: "today",
				minDate: "today",
				changeMonth: true,
				numberOfMonths: 1,
				dateFormat:"yy-mm-dd",
				onClose: function( selectedDate ) {
					$( "#Forms_end_time" ).datepicker( "option", "minDate", selectedDate );
				}
			});
		})


	</script>		
</div>	