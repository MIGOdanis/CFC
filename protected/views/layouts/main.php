<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie10 lt-ie9 lt-ie8 lt-ie7 ie6" lang="zh"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie10 lt-ie9 lt-ie8 ie7" lang="zh"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie10 lt-ie9 ie8" lang="zh"> <![endif]-->
<!--[if IE 9]> <html class="lt-ie10 ie9" lang="zh"> <![endif]-->
<!--[if gt IE 9]> <html class="gt-ie9" lang="zh"> <![endif]-->
<!--[if !IE]><!--> <html class="modern" lang="zh"> <!--<![endif]-->
	<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"> 
	<meta charset="utf-8">
	<title>CFC 域動雲</title>
	<link rel="SHORTCUT ICON" href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/image/cfd.png">
	<link href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/css/main.css" rel="stylesheet">
	<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
	</head>
	<body>
		<div id="main">
			<div id="head">
				<div id="navibar">
					<div id="logo">
						<img src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/image/logo.png">
					</div>
					<?php
					if(Yii::app()->user->id > 0){
						
						$this->widget('NaviWidget', array('item'=>$this->menu, 'ignoreController'=>$this->ignoreController, 'controller'=>$this->authMapping ));
					}
					?>
				</div>
			</div>		
			<?php echo $content; ?>
		</div>
		<script type="text/javascript">
		$( document ).ready(function() {
			$('#left-navi').height($(document).height()+21);
			$(window).resize(function(){ 
				$('#left-navi').height($(document).height()+21);
			});
		});
		</script>		
	</body>
</html>