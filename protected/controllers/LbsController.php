<?php

class LbsController extends Controller
{
	
public function actionIndex()
	{
		
		$LbsGroup = LbsGroup::model()->findAll();
		if(isset($_GET['id'])){
			$criteria = new CDbCriteria;      
			$criteria->addCondition("group_id = " . $_GET['id']);		
			$model = LbsLatlng::model()->findAll($criteria);
			$lbsArray = array();
			foreach ($model as $row) {
				$lbsArray[] = $row->lat . "@" . number_format($row->lng, 7) . "@" . $row->address . "@" . $row->id;
			}
			$lbs = implode(",",$lbsArray);			
		}
		$this->render('index',array(
			'model'=>$model,
			'lbs'=>$lbs,
			"LbsGroup" => $LbsGroup
		));
	}

	public function actionDelLBS()
	{
		if(isset($_POST['ajax'])){
			$model = LbsLatlng::model()->deleteByPk((int)$_POST['id']);
			if($model){
				$data = array(
					'error' => true
				);
			}else{
				$data = array(
					'error' => false
				);				
			}
			header('Content-type: application/json');
			echo CJSON::encode(array(
				"data" => $data
			));
			
		}
		Yii::app()->end();
	}	
	public function actionupdateLBS()
	{
		if(isset($_POST['ajax'])){
			$model = LbsLatlng::model()->findByPk((int)$_POST['id']);
			$model->lat = $_POST['lat'];
			$model->lng = $_POST['lng'];
			$model->address = $_POST['address'];
			if($model->save()){
				$data = array(
					'error' => true
				);
			}else{
				$data = array(
					'error' => false
				);				
			}
			header('Content-type: application/json');
			echo CJSON::encode(array(
				"data" => $data
			));
			
		}
		Yii::app()->end();
	}	

	//座標匯入-------
	public function actionImport()
	{
		$LbsGroup = LbsGroup::model()->findAll();
		if(isset($_POST['address'])){
			$address = explode (",", $_POST['address']);
			$group = LbsGroup::model()->findByPk((int)$_POST['group']); 
			$this->render("transform",array(
				"model" => $address,
				"group" => $group
			));
		}else{
			$this->render("import",array(
				"LbsGroup" => $LbsGroup
			));
		}	
	}
	

	public function actionCheckData()
	{
		if(isset($_POST['ajax'])){
			
			$criteria = new CDbCriteria;      
			$criteria->addCondition("address LIKE '".$_POST['address']."'");
			$criteria->addCondition("group_id = '".$_POST['group_id']."'");
			$model = LbsLatlng::model()->find($criteria);
			
			if($model->id){
				$msg = true;
			}else{
				$msg = false;
			}

			$data = array(
				'error' => $msg
			);
			header('Content-type: application/json');
			echo CJSON::encode(array(
				"data" => $data
			));
			
		}
		Yii::app()->end();
	}

	public function actionNewData()
	{
		if(isset($_POST['ajax'])){
			$model = new LbsLatlng();
			$model->address = $_POST['address'];
			$model->lat = $_POST['lat'];
			$model->lng = $_POST['lng'];
			$model->group_id = $_POST['group_id'];
			if($model->save()){
				$msg = true;
				$id = $model->id;
			}else{
				$msg = false;
				$id = 0;
			}

			$data = array(
				'error' => $msg,
				'id' => $id
			);
			header('Content-type: application/json');
			echo CJSON::encode(array(
				"data" => $data
			));
			
		}
		Yii::app()->end();
	}

	public function actionExportIndex()
	{
		$LbsGroup = LbsGroup::model()->findAll();
		$model=new LbsLatlng('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LbsLatlng']))
			$model->attributes=$_GET['LbsLatlng'];

		//print_r($model); exit;
		$this->render('exportIndex',array(
			'model'=>$model,
			"LbsGroup" => $LbsGroup
		));
	}

	public function actionExport($id)
	{
		$LbsGroup = LbsGroup::model()->findAll();
		$criteria = new CDbCriteria;      
		$criteria->addCondition("group_id = " . $id);		
		$model = LbsLatlng::model()->findAll($criteria);
		$lbsArray = array();
		foreach ($model as $row) {
			//$lbsArray[] = $row->lat . "@" . number_format($row->lng, 7);
			$lbsArray[] = $row->address;
		}
		$lbs = implode(",",$lbsArray);
		$this->render('export',array(
			'lbs'=>$lbs,
			"LbsGroup" => $LbsGroup
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionExportDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('exportIndex'));
	}

	public function loadModel($id)
	{
		$model=LbsLatlng::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}	
}