<?php

class IndexController extends Controller
{
	public function actionIndex()
	{
		if(isset($_GET['target']) || isset($_GET['type'])){
			$this->actionMsg();
			Yii::app()->end();
		}else{

			if(!Yii::app()->user->id)
				$this->redirect("site/login");

			$this->render('index');

		}
	}

	public function actionMsg()
	{
		
		if(isset($_GET['target']) && !empty($_GET['target'])){

			$this->layout = "column_list";

			$model=new Message('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Message']))
				$model->attributes=$_GET['Message'];

			$this->render('msg',array(
				'model' => $model,
				'target' => $_GET['target']
			));
		}
	}

	public function actionView($id)
	{
		if(isset($_GET['target']) && !empty($_GET['target'])){
			$model = Message::model()->getMsgByTargetAndId($_GET['target'],$id);
			$this->renderPartial('_modal',array(
				'model' => $model,
			));  
		}     
		Yii::app()->end();
	}	
}