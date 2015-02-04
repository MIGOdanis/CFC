<?php
class SiteController extends Controller
{
	public $layout = 'column1';
		
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// 驗證碼
			'captcha' => Yii::app()->params['captcha'],
		);
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
	/**
	 * 登入狀態判斷
	 */	
	public function loginCheck()
	{
		//已登入判斷	
		if (isset(Yii::app()->user->company_id)){
			$this->redirect(array('/company-admin'));
		}elseif (!Yii::app()->user->isGuest){
			//重新導向
			if(isset($_GET['redirect'])){
				$this->redirect(array($_GET['redirect']));
			}		
			$this->redirect(array('/member-admin'));
		}
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if(Yii::app()->user->id > 0)
			$this->redirect(Yii::app()->homeUrl);

		$model=new LoginForm;

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
            $_POST['LoginForm']['username'] = trim($_POST['LoginForm']['username']);
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
		
	/**
	 * 登出並轉回首頁
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout(false);
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/**
	 * 首頁
	 */
	public function actionIndex()
	{
		$this->layout = '';
		//$userCount = User::model()->count("level = 0") + Yii::app()->params['siteSetting']['number_of_people'];
		$this->render('index', array(
			'userCount' => $userCount
		));
	}
	
}