<?php

class UserController extends Controller
{
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		
		return $this->checkUserAuth();
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * Manages all models.
	 */
	public function actionRepassword($id)
	{
		$model=User::model()->findByPk($id);
		if(isset($_POST['User']['password'])){
			if($model->validatePassword($_POST['User']['password'])){
				$model->scenario ='resetpassword';
				$model->repeat_password = $_POST['User']['repeat_password'];
				$model->new_password =  $_POST['User']['new_password'];
				if($model->validate()){
					$model->password = $model->hashPassword($_POST['User']['new_password']);
					if ($model->save()) {
						$this->redirect(array('index/index'));
					}
				}
			}else{
				$model->addError('password','錯誤的帳號或密碼。');
			}
		}

		// $model->password = $model->hashPassword($_POST['User']['new_password']);
		// if ($model->save()) {
		// 	$this->redirect(array('admin'));
		// }	
			
		$this->render('repassword',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User('register');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->repeat_password = $_POST['User']['repeat_password'];
			$model->active = 1;
			$model->creat_time = time();
			
			if (!empty($_POST['User']['password']) && ($_POST['User']['repeat_password'] == $_POST['User']['password'])){
				$model->password = $model->hashPassword($_POST['User']['password']);
				if($model->save()){
					$this->redirect(array('admin'));
				}
			}else{
				$model->addError('repeat_password','密碼輸入錯誤');
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionSetPassword($mail,$newPassword)
	{
		$criteria=new CDbCriteria;
		$criteria->addCondition("username = '" . $mail ."'");

		$model=User::model()->find($criteria);

		if($model!==null)
		{
			$model->password = $model->hashPassword($newPassword);
			if($model->save()){
				$this->redirect(array('index/index'));
			}else{
				echo "更換失敗";
			}
		}else{
			echo "ID不存在";
		}

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if ($model->save()) {
				$this->redirect(array('admin'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}