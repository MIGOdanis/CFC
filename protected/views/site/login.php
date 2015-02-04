<style type="text/css">
	.close-to-right{
		float: right;
		width: 40%;
	}
	.login-input-label{
		width: 20%;
	}
	.login-button-group{
		margin-right: 30px !important;
	}
	.cclog{
		width: 150px;
		height: 150px;
		margin-top: 15px;
		margin-bottom: 15px;
		margin-left:auto !important;
		margin-right:auto !important;
	}
</style>
<!-- article -->
<div class="cclog">
<img width="150" height="150"  src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/image/cclogo.png">
</div>
<div class="">
	<!-- #login -->
	<div id="login">

		<!-- <div class="col-md-7 col-sm-7"> -->

			<?php $this->renderPartial('_login_form', array('model'=>$model)); ?>
		
		<!-- </div> --><!-- /.col-md-7 -->

		<!-- <div class="col-md-4 col-sm-4 close-to-right">

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">無法登入?</h3>
				</div>
				<div class="panel-body">
					<ul>
						<li><?php echo CHtml::link('忘記密碼請按此', array('login/forgot-pw')); ?></li>
					</ul>
				</div>
			</div>

		</div> --><!-- /.col-md-4 -->

	</div><!-- /#login -->
	
</div>