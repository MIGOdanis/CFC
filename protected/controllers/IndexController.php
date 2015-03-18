<?php
require dirname(__FILE__).'/facebook-php-sdk-v4-4.0-dev/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequest;

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

	public function actionGetCookie()
	{
		print_r($_COOKIE);
		exit;
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

	public function actionForm($id)
	{
		$this->layout = "column_list";

		//查看表單
		$criteria = new CDbCriteria;
		$criteria->addCondition("id=".$id);
		$criteria->addCondition("active = 1");
		$model=Forms::model()->find($criteria);

		// if($model===null)
		// 	throw new CHttpException(404,'The requested page does not exist.');

		if($model!==null){
			//unset(Yii::app()->session["formUser"]);
			
			if(isset($_POST['FormsUser'])){

				$criteria = new CDbCriteria;
				$criteria->addCondition("mail = '" . $_POST['FormsUser']['mail'] ."'");
				$checkFormUser=FormsUser::model()->find($criteria);

				if($checkFormUser===null){
					//建立使用者資料
					$formUser=new FormsUser();
					$formUser->attributes=$_POST['FormsUser'];
					$formUser->years = strtotime($_POST['FormsUser']['years']);
					
					if($formUser->gender == 0)
						$formUser->gender = "";

					if(isset($_COOKIE['uuid']))
						$formUser->uuid = $_COOKIE['uuid'];

					// print_r($_POST['FormsUser']);exit;

					if(isset(Yii::app()->session["fbId"]) && !empty(Yii::app()->session["fbId"]))
						$formUser->fb_id = Yii::app()->session["fbId"];

					// print_r($formUser); exit;

					if($formUser->save()){
						Yii::app()->session["formUser"] = $formUser->id;
					}
				}else{

					//更新使用者資料
					if(isset(Yii::app()->session["fbId"]) && !empty(Yii::app()->session["fbId"]))
						$checkFormUser->fb_id = Yii::app()->session["fbId"];

					$checkFormUser->attributes=$_POST['FormsUser'];
					$checkFormUser->years = strtotime($_POST['FormsUser']['years']);
					
					if(isset($_COOKIE['uuid']))
						$checkFormUser->uuid = $_COOKIE['uuid'];

					$checkFormUser->save();

					$formUser = $checkFormUser;
					Yii::app()->session["formUser"] = $formUser->id;
				}

			}else{
				$formUser = 0;

				if(isset(Yii::app()->session["formUser"]) && Yii::app()->session["formUser"] > 0){
					$formUser = FormsUser::model()->findByPk(Yii::app()->session["formUser"]);
				}else{
					$formUser=new FormsUser();
				}			
			}
		

			if($formUser->id > 0 && isset($_POST['formStart']) && !empty($_POST['formStart'])){
				 
				$ans = array();
				
				if(isset($_POST['ans'])){
					$ans = json_decode($_POST['ans'],true);
				}

				$pageIndex = $_POST['page'];
				$page = json_decode($model->question);

				if(!empty($page->$pageIndex->object)){
					foreach ($page->$pageIndex->object as $key => $value) {
						
						if($value->type == "dropDown" && $value->warp == 1){
							$page->$pageIndex->pageOver = $_POST['hide-'.$key.'-dropWarp'];
							//echo 'hide-'.$key.'-dropWarp'; exit;
						}

						$val = $_POST[$key];

						if($value->type  == "singleSelect"){
							if($_POST[$key] == "other")
								$val = $_POST[$key . "-other"];
						}

						if($value->type  == "dateAndTime"){
							if($value->date)
								$val = $_POST[$key . "-d"];
							if($value->time)
								$val .= $_POST[$key . "-h"] . $_POST[$key . "-i"];					
						}

						//print_r($value->type);
						if($value->type  == "tableSelect" && !empty($_POST[$key . "-1"])){
							$r = 0;
							foreach ($value->row as $row) {
								$r++;
								$ans[$pageIndex][$key][$r] = $_POST[$key . "-" . $r];

							}
						}elseif($value->type  == "multiSelect" && !empty($_POST[$key])){
							$r = 0;
							// print_r($ms); exit;
							foreach ($_POST[$key] as $ms) {
								$r++;
								if(!empty($ms)){
									if($ms == "other"){
										//secho $_POST[$key . "-other"]; exit;
										$ans[$pageIndex][$key][] = $_POST[$key . "-other"];
									}else{
										$ans[$pageIndex][$key][] = $ms;
									}
								}
								//echo $ms;
							}
							//print_r($ans[$pageIndex][$key]); exit;
						}else{
							if($value->type  != "html")
							$ans[$pageIndex][$key] = $val;
						}

					}
				}
				
				$ans = json_encode($ans);

				//最後一頁
				if($page->$pageIndex->pageOver == "end"){
					Yii::app()->session['page'.$model->id."last"] = "end";

					if(!isset(Yii::app()->session[$model->id."lastSave"]) && Yii::app()->session[$model->id."lastSave"] == 0){
						$ansSave = new FormsAns();
						$ansSave->ans = $ans;
						$ansSave->form_id = $model->id;
						$ansSave->user_id = $formUser->id;
						$ansSave->creat_time = time();
						if($ansSave->save()){
							//填表量增加
							$model->fill_count = $model->fill_count + 1;
							$model->save();
						}
						Yii::app()->session[$model->id."lastSave"] = time();
					}
					//print_r($ans); exit;

				//下一頁
				}elseif($page->$pageIndex->pageOver == "next"){
					Yii::app()->session['page'.$model->id."last"] = $pageIndex + 1;
				
				//其他(指定頁面)
				}else{
					Yii::app()->session['page'.$model->id."last"] = $page->$pageIndex->pageOver;
				
				}


				//print_r(Yii::app()->session['page'.$model->id."last"]); exit;

			}else{

				//FaceBook SDK 4.0
				FacebookSession::setDefaultApplication("840361439355895", "2efea510c4f20c2911308fdeb0dbabc3");
				$helper = new FacebookRedirectLoginHelper("http://events.doublemax.net/CFC/index/form?id=".$id,"840361439355895", "2efea510c4f20c2911308fdeb0dbabc3");
				 // see if a existing session exists
				if (isset(Yii::app()->session["fb_token"])) {
				    // create new session from saved access_token
				    $fbToken = new FacebookSession(Yii::app()->session["fb_token"]);

				    // validate the access_token to make sure it's still valid
				    try {
				        if (!$fbToken->validate()) {
				            $fbToken = null;
				        }
				    } catch (Exception $e) {
				        // catch any exceptions
				        $fbToken = null;
				    }
				}

				if (!isset($fbToken) || $fbToken === null) {
				    // no session exists

				    try {
				        $fbToken = $helper->getSessionFromRedirect();
				    } catch(FacebookRequestException $ex) {
				        // When Facebook returns an error
				        // handle this better in production code
				        print_r($ex);
				    } catch(Exception $ex) {
				        // When validation fails or other local issues
				        // handle this better in production code
				        print_r($ex);
				    }
				}

				// see if we have a session
				if (isset($fbToken)) {
					// User logged in, get the AccessToken entity.
					$accessToken = $fbToken->getAccessToken();
					// Exchange the short-lived token for a long-lived token.
					$longLivedAccessToken = $accessToken->extend();
					// Now store the long-lived token in the database
					$fbResponse = (new FacebookRequest($fbToken, 'GET', '/me?fields=id,name,email,birthday,gender'))->execute()->getGraphObject();
					Yii::app()->session["fb_token"] = $fbToken->getToken();
					if(isset($_GET['code']))
						$this->redirect("http://events.doublemax.net/CFC/index/form?id=".$id);

					$fbResponse = $fbResponse->asArray();

					//確認FB用戶(待移動至MOD)
					$criteria = new CDbCriteria;
					$criteria->addCondition("mail = '" . $fbResponse['email'] ."'");
					$criteria->addCondition("fb_id = '" . $fbResponse['id'] ."'");
					$checkFormUserByFB = FormsUser::model()->find($criteria);

					if($checkFormUserByFB === null){
						//新用戶by FB
						$formUser->name = $fbResponse['name'];
						$formUser->mail = $fbResponse['email'];
						$formUser->years = date("Y-m-d" , strtotime($fbResponse['birthday']));
						$formUser->gender = ($fbResponse['gender'] == "male")? 1 : 0;
					}else{

						//舊用戶by FB
						$formUser->name = $checkFormUserByFB->name;
						$formUser->mail = $checkFormUserByFB->mail;
						$formUser->years = date("Y-m-d" , $checkFormUserByFB->years);
						$formUser->gender = $checkFormUserByFB->gender;					
						$formUser->phone = $checkFormUserByFB->phone;
					}

					//收下Token
					Yii::app()->session["fbId"] = $fbResponse['id'];
					
				} else {

					//資料收取的範圍
					$scope = array('user_about_me','email','user_birthday');
					$fbLink = $helper->getLoginUrl($scope);
				}

			}
		}

		if(isset(Yii::app()->session[$model->id."lastSave"]) && Yii::app()->session[$model->id."lastSave"] != 0)
			Yii::app()->session['page'.$model->id."last"] = "end";

		if(isset($_POST['FormsUser']) && !empty($_POST['FormsUser']['years']))
			$formUser->years = $_POST['FormsUser']['years'];

		$this->render('../form/view',array(
			'model' => $model,
			'formUser' => $formUser,
			'fbLink' => $fbLink,
			'fbResponse' => $fbResponse,
			'ans' => $ans
		));
	}

}