<?php
$targets = explode(":", $model->target);
$targetArray = array();
foreach ($targets as $value) {
	$targetArray[] = Yii::app()->params['msgTarget'][$value];
}
?>
<style type="text/css">
	.label{
		margin-right: 5px;
		margin-left: 5px;
	}
  #msgContent img{
    max-width: 550px;
  }
</style>
<div class="page-header">
  <h3><?php echo $model->title;?></h3>
  <small>顯示日期 : <?php echo date("Y-m-d",$model->active_time);?></small><br>
  <small>
  	發布對象 : 
  	<?php 
  		foreach ($targetArray as $value) {
  			echo '<span class="label label-primary">' . $value . '</span>';
  		}
  	?>
  </small><br>
  <small>發布帳號 : <?php echo $model->user->username;?> (<?php echo $model->user->nick_name;?>)</small><br>
  <small>發布平台 : <?php echo Yii::app()->params["msgType"][$model->type];?></small><br>
</div>
<div id="msgContent">
  <?php echo $model->content;?>
</div>