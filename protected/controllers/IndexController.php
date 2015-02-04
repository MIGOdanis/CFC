<?php

class IndexController extends Controller
{
	//public $layout = 'column1';	
	public function actionIndex()
	{
		if(!Yii::app()->user->id)
			$this->redirect("site/login");

		$this->render('index');
	}
}