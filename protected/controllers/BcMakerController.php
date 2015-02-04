<?php

class BcMakerController extends Controller
{
	public function actionAdmin()
	{
		$this->render('admin');
	}
	public function actionGetNameList()
	{
		$array = scandir(".");
		$listArray = array();
		foreach($array as $row){
			$file = "./".$row;
			$row = iconv("BIG5", "UTF-8",$row);
			
			//回根目錄
			if($row != "." && $row != ".." && is_dir(urldecode($file))){

				if(isset($_GET['term'])){
					$term = iconv("BIG5", "UTF-8",$_GET['term']);
					if (strpos($row, $term) !== false){
						$listArray[] = $row;
					}
				}else{
					$listArray[] = $row;
				}
			}
		}
		
		header('Content-type: application/json');
		echo json_encode($listArray);
		Yii::app()->end();
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}