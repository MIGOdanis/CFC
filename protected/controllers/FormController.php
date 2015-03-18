<?php

class FormController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // performs access control for CRUD operations
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

	public function transFromText($json,$r)
	{
		return array(
			"display" => (isset($json->display) && $json->display == 0)? 0 : 1 ,
			"id" => $json->id,
			"type" => $json->type,
			"page" => $r,
			"title" => $json->title,
			"caption" => $json->caption,
			"required" => $json->required
		);
	}

	public function transFromSelect($json,$r)
	{
		return array(
			"display" => (isset($json->display) && $json->display == 0)? 0 : 1 ,
			"id" => $json->id,
			"type" => $json->type,
			"page" => $r,
			"title" => $json->title,
			"caption" => $json->caption,
			"select" => (array)$json->select,
			"other" => $json->other,
			"required" => $json->required
		);
	}

	public function transFromTableSelect($json,$r)
	{
		return array(
			"display" => (isset($json->display) && $json->display == 0)? 0 : 1 ,
			"id" => $json->id,
			"type" => $json->type,
			"page" => $r,
			"title" => $json->title,
			"caption" => $json->caption,
			"column" => (array)$json->column,
			"row" => (array)$json->row,
			"required" => $json->required
		);
	}

	public function transFromDropDown($json,$r)
	{
		return array(
			"display" => (isset($json->display) && $json->display == 0)? 0 : 1 ,
			"id" => $json->id,
			"type" => $json->type,
			"page" => $r,
			"title" => $json->title,
			"caption" => $json->caption,
			"option" => (array)$json->option,
			"warp" => $json->warp,
			"warpArray" => (array)$json->warpArray,
			"required" => $json->required
		);
	}

	public function transFromNumberToLevel($json,$r)
	{
		return array(
			"display" => (isset($json->display) && $json->display == 0)? 0 : 1 ,
			"id" => $json->id,
			"type" => $json->type,
			"page" => $r,
			"title" => $json->title,
			"caption" => $json->caption,
			"fristSTR" => $json->fristSTR,
			"lastSTR" => $json->lastSTR,
			"required" => $json->required
		);
	}

	public function transFromDateAndTime($json,$r)
	{
		return array(
			"display" => (isset($json->display) && $json->display == 0)? 0 : 1 ,
			"id" => $json->id,
			"type" => $json->type,
			"page" => $r,
			"title" => $json->title,
			"caption" => $json->caption,
			"required" => $json->required,
			"date" => $json->date,
			"time" => $json->time,
		);
	}

	public function transFromHtml($json,$r)
	{
		return array(
			"display" => (isset($json->display) && $json->display == 0)? 0 : 1 ,
			"id" => $json->id,
			"type" => $json->type,
			"page" => $r,
			"html" => $json->html,
		);
	}

	public function transJsonsToArray($data)
	{
		$temp = array();
		foreach ($data as $value) {
			$json = json_decode($value);
	
			//處理分頁
			if(isset($json->type) && ($json->type  == "headerPage" || $json->type  == "newPage")){
				$r++;
				if($json->type  == "headerPage"){
					$temp[$r] = array(
						"pageIndex" => $r,
						"pageTitle" => $_POST['Forms']['title'],
						"pageCaption" => $_POST['Forms']['caption'],
						"display" => ($json->display === 0)? 0 : 1,
					);
				}else{

					$temp[$r] = array(
						"pageIndex" => $r,
						"pageTitle" => $json->title,
						"pageCaption" => $json->caption,
						"display" => ($json->display === 0)? 0 : 1,
					);
					//print_r($temp[$r]); exit;		
				}
			}else{
				//處理各類型的type

				//處理文字表單
				if($json->type  == "singleText" || $json->type  == "multiText")
					$temp[$r]["object"][$json->id] = $this->transFromText($json,$r);

				//處理選擇表單
				if($json->type  == "singleSelect" || $json->type  == "multiSelect")
					$temp[$r]["object"][$json->id] = $this->transFromSelect($json,$r);

				//處理表格選擇表單
				if($json->type  == "tableSelect")
					$temp[$r]["object"][$json->id] = $this->transFromTableSelect($json,$r);

				//處理下拉
				if($json->type  == "dropDown")
					$temp[$r]["object"][$json->id] = $this->transFromDropDown($json,$r);

				//處理1~10
				if($json->type  == "numberToLevel")
					$temp[$r]["object"][$json->id] = $this->transFromNumberToLevel($json,$r);

				//處理日期時間
				if($json->type  == "dateAndTime")
					$temp[$r]["object"][$json->id] = $this->transFromDateAndTime($json,$r);

				//處理日期時間
				if($json->type  == "pageOver")
					$temp[$r]["pageOver"] = $json->value;

				//處理日期時間
				if($json->type  == "html")
					$temp[$r]["object"][$json->id] = $this->transFromHtml($json,$r);
				
			}			
		}		

		//print_r($temp); exit;
		return $temp;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Forms();

		// Uncomment the following line if AJAX validation is needed
		// $this->performsAjaxValidation($model);

		if(isset($_POST['Forms']))
		{
			$model->attributes=$_POST['Forms'];
			$temp = $this->transJsonsToArray($_POST['forms']);
			$model->question = json_encode($temp);
			$model->active = 2;
			$model->creat_by = Yii::app()->user->id;
			$model->creat_time = time();
			$model->fill_count = 0;
			$model->star_time = strtotime($_POST['Forms']['star_time']);
			$model->end_time = strtotime($_POST['Forms']['end_time'] . "23:59:59");

			if($model->save()){
				$this->redirect(array('admin'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function transUserYears($userYearArray,$years){
		
		if($years < 20){
			
			$userYearArray[0]++;
		}elseif($years >= 20 && $years <= 29){
			
			$userYearArray[1]++;
		}elseif($years >= 30 && $years <= 39){
			
			$userYearArray[2]++;
		}elseif($years >= 40 && $years <= 49){
			
			$userYearArray[3]++;
		}elseif($years > 50){
			
			$userYearArray[4]++;
		}else{
			
			$userYearArray[0]++;
		}
		
		return $userYearArray;
	}

	public function export($formsAns,$forms)
	{
		$array=array(1=>array($forms->title));
		$question = json_decode($forms->question,true);
		$ojTitle = array();
		$ojKey = array();
		$ojTitle[] = "填表人名稱";
		$ojTitle[] = "填表人出生日期";
		$ojTitle[] = "填表人郵件";
		$ojTitle[] = "填表人性別";
		$ojTitle[] = "填表人聯絡電話";		
		foreach ($question as $q1) {
			foreach ($q1['object'] as $key => $object) {
				$ojTitle[] = $object['title'];
				$ojKey[] = $key;
			}
		}

		$array[] = $ojTitle;

		

		foreach ($formsAns as $ans) {
			$ansArray = array();
			$ansRow = array();
			$json = json_decode($ans->ans,true);
			foreach ($json as $row1) {
				foreach ($row1 as $key => $row2) {
					$ansRow[$key] = $row2;
					if(is_array($ansRow[$key]))
						$ansRow[$key] =  implode(", ", $ansRow[$key]);
				}
			}
			//print_r($ansRow); exit;
			$ansArray[] = $ans->formUser->name;
			$ansArray[] = date("Y-m-d",$ans->formUser->years);
			$ansArray[] = $ans->formUser->mail;
			$ansArray[] = ($ans->formUser->gender == 1) ? "Male" : "Female" ;
			$ansArray[] = $ans->formUser->phone;
			foreach ($ojKey as $key) {
				$ansArray[] = (!empty($ansRow[$key])) ? $ansRow[$key] : "";
			}
			
			$array[] = $ansArray;

		}
		// print_r($array); exit;
		Yii::import('ext.phpexcel.JPhpExcel');
		$xls=new JPhpExcel;
		$xls->addArray($array);
		$xls->generateXML('報表'.date('Ymd-His'),false);		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionReport($id)
	{
		
		$model = $this->loadModel($id);
		$question = json_decode($model->question,true);

		$criteria = new CDbCriteria; 
		$criteria->addCondition("form_id = " . $id);
		$criteria->with = "formUser";
		$FormsAns = FormsAns::model()->findAll($criteria);

		if($_GET['report'] == 1){
			$this->export($FormsAns,$model);
			Yii::app()->end();
		}

		$ans = array();
		$objectAns = array();
		$ansPeople = array();
		$userYearArray = array(0,0,0,0,0,0);

		$formYear = date("Y",$model->creat_time);

		//把答案排序到以題目編號為主鍵的陣列
		foreach ($FormsAns as $value) {

			$userYear = date("Y",$value->formUser->years);
			$years = $formYear - $userYear;

			$userYearArray = $this->transUserYears($userYearArray,$years);

			$json = json_decode($value->ans,true);

			if(!empty($json)){
				foreach ($json as $row1) {
					foreach ($row1 as $key => $row2) {
						$ans[$key][] = $row2;
					}
				}
			}
		}

		foreach ($question as $q1) {
			foreach ($q1['object'] as $key => $object) {
				if($object['type'] != "html")
					$objectAns[$key] = $ans[$key];
			}
		}

		//print_r($objectAns); exit;

		$this->render('report',array(
			'model'=>$model,
			'objectAns' => $objectAns,
			'question' => $question,
			'userYearArray' => $userYearArray
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionSelectType($pid)
	{
		$this->renderPartial('_select',array(
			'pid'=>$pid,
		)); 
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdateType()
	{
		$this->renderPartial('_update',array(
			'type'=> $_POST['type'],
		)); 
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionTypes()
	{
		$page = array(
			"newPage" => "_newPage",
			"singleText" => "_singleText",
			"multiText" => "_multiText",
			"singleSelect" => "_singleSelect",
			"multiSelect" => "_multiSelect",
			"dropDown" => "_dropDown",
			"numberToLevel" => "_numberToLevel",
			"tableSelect" => "_tableSelect",
			"dateAndTime" => "_dateAndTime",
			"html" => "_html"
		);
		$this->renderPartial($page[$_GET['type']]); 
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionGetLayout()
	{
		$page = array(
			"newPage" => "_newPage_layout",
			"singleText" => "_singleText_layout",
			"multiText" => "_multiText_layout",
			"singleSelect" => "_singleSelect_layout",
			"multiSelect" => "_multiSelect_layout",
			"dropDown" => "_dropDown_layout",
			"numberToLevel" => '_numberToLevel_layout',
			"tableSelect" => "_tableSelect_layout",
			"dateAndTime" => "_dateAndTime_layout",
			"html" => "_html_layout"
		);
		$this->renderPartial($page[$_GET['type']]); 
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
		// $this->performsAjaxValidation($model);

		if(isset($_POST['Forms']))
		{
			$model->attributes=$_POST['Forms'];
			$model->star_time = strtotime($_POST['Forms']['star_time']);
			$model->end_time = strtotime($_POST['Forms']['end_time'] . "23:59:59");			
			$temp = $this->transJsonsToArray($_POST['forms']);
			//print_r($temp); exit;
			$model->question = json_encode($temp);
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

		$model=new Forms('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Forms']))
			$model->attributes=$_GET['Forms'];


		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);

		// Yii::app()->session['page'.$model->id."last"] = ""; exit;

		if(isset($_POST) && !empty($_POST)){
			$ans = array();
			
			if(isset($_POST['ans'])){
				$ans = json_decode($_POST['ans'],true);
			}

			$pageIndex = $_POST['page'];
			$page = json_decode($model->question);

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

				if($value->type  == "tableSelect" && !empty($_POST[$key])){
					$r = 0;
					foreach ($value->row as $row) {
						$r++;
						$ans[$pageIndex][$key][$r] = $_POST[$key . "-" . $r];
					}
				}elseif($value->type  == "multiSelect" && !empty($_POST[$key])){
					$r = 0;
					// print_r($_POST[$key][$r]); exit;
					foreach ($_POST[$key] as $ms) {
						$r++;
						if(!empty($_POST[$key][$r])){
							if($_POST[$key][$r] == "other"){
								//secho $_POST[$key . "-other"]; exit;
								$ans[$pageIndex][$key][] = $_POST[$key . "-other"];
							}else{
								$ans[$pageIndex][$key][] = $_POST[$key][$r];
							}
						}
					}
				}else{
					if($value->type  != "html")
					$ans[$pageIndex][$key] = $val;
				}

			}
			
			$ans = json_encode($ans);


			if($page->$pageIndex->pageOver == "end"){
				Yii::app()->session['page'.$model->id."last"] = "end";
			}elseif($page->$pageIndex->pageOver == "next"){
				Yii::app()->session['page'.$model->id."last"] = $pageIndex + 1;
			}else{
				Yii::app()->session['page'.$model->id."last"] = $page->$pageIndex->pageOver;
			}
			//print_r(Yii::app()->session['page'.$model->id."last"]); exit;

		}

		$this->render('view',array(
			'model'=>$model,
			'ans' => $ans
		));	
	}

	public function loadModel($id)
	{
		$model=Forms::model()->findByPk($id);

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}