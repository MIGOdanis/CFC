<div class="page-header">
  <h1>修改密碼</h1>
  <small><?php echo $model->username;?></small>
</div>
<?php echo $this->renderPartial('_form_repassword', array('model'=>$model)); ?>