<?php 
require '_set_menu.php';
if(isset($mapping[$this->id])){
	$this->authMapping = $mapping[$this->id];
}
$this->menu = $menu;
$this->beginContent('/layouts/main');
$this->ignoreController = $naviItem;
?>
<div id="left-navi">
	<a href="<?php echo Yii::app()->createUrl("user/repassword?id=" . Yii::app()->user->id); ?>">
		<div id="user-info">
			<div id="user-info-text">
				<div id="user-nickname">
					<?php echo Yii::app()->user->nickname;?>
				</div>				
				<div id="user-name">
					<?php echo Yii::app()->user->username;?>
				</div>
			</div>
			<div id="logout">
			<?php echo CHtml::link('<img src="' . Yii::app()->params['baseUrl'] .'/assets/image/icon/logout.png">',array('site/logout')); ?>
			</div>					
		</div>
	</a>
	<?php 
	if(isset($mapping[$this->id])){
		$this->widget('MenuWidget', array('item' => $this->menu[$this->authMapping]['action'] , 'action' => $this->action->id, 'controller'=>$this->id ));
	}
	?>
</div>
<div id="contents">
	<?php echo $content; ?>
</div>
<?php $this->endContent(); ?>