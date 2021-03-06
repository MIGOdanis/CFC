<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $authMapping;
	public $ignoreController;
	
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function beforeAction($action){
		

		return true;
	}

	public function checkUserAuth(){
		$auth = array();
		if($this->id == "user")
				$auth[] = "repassword";
		if(Yii::app()->user->id > 0 && isset(Yii::app()->user->auth[$this->id])){
			$auth = Yii::app()->user->auth[$this->id];
			
		}else{
			if(Yii::app()->user->id > 0)
				throw new CHttpException(403,'The requested page does not exist.');
		}

		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=> $auth,
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	// Toggle active
	public function actionActive($id)
	{
		$model=$this->loadModel($id);
        $model->scenario = 'active';
		$model->active = ($model->active == 1) ? 0 : 1;
		if($model->save())
			echo 1;
			if(isset($_GET['redirect']))
				$this->redirect(array($_GET['redirect']));
		else
			echo 'Error';
	}

	/**
	 * 上傳圖片(縮圖)
	 * 
	 * @param array $image 檔案欄位
	 * @param array('width','height') $resize 縮圖大小 ***不進行縮圖可設置為 false ***
	 * @param string $upload_folder 上傳目錄(沒有時自動建立)
	 * @param string $filename 縮圖後名稱
	 * @param boolean $o_img 是否存留原圖
	 * @param string $o_name 原圖名稱
	 * @param int $filesize 大小限制 (單位mb)
	 *	宣告範例
	 * 	$this->upload_image_resize(
	 *		$_FILES['file'],
	 *		array('width'=>200,'height'=>200),
	 *		Yii::getPathOfAlias('upload') . '/user/' . Yii::app()->user->id,
	 *		"m_profile_image",
	 *		true,
	 *		"o_profile_image",
	 * 		2
	 * 	);
	 */
	public function upload_image_resize($image,$resize,$upload_folder,$filename,$o_img=false,$o_name=o_image,$filesize=2,$corp=false)
	{
		if(empty($image['tmp_name']))
			return;

		if($image['size']/1024000 > $filesize)
			return "您的圖檔超過大小限制 (" . $filesize . " MB)";

        if(!is_dir($upload_folder)){
            mkdir($upload_folder, 0777, true);
        }
		//根據不同格式取得圖檔
		switch (strtolower($image['type'])) {
			case 'image/jpg':
			case 'image/jpeg':
			case 'image/pjpeg':
				$src = @imagecreatefromjpeg($image['tmp_name']);
				if(!$src){
					return "您的圖檔原始格式可能不是JPG";
				}
				break;
			case 'image/png':
				$outputType = "png";
				$src = imagecreatefrompng($image['tmp_name']);
				break;
			// case 'image/gif':
			// 	$src = imagecreatefromgif($image['tmp_name']);
			// 	break;
			default:
				return "不支援您的圖檔格式(支援JPG格式)";
		}
		
		// 取得來源圖片長寬
		$src_w = imagesx($src);
		$src_h = imagesy($src);
		if( ($src_w > $resize['width'] || $src_h > $resize['height']) && $resize !== false){
			//裁圖計算區域
			if($corp){
				if($src_w > $src_h){
					$corp_x =intval (($src_w - $src_h) / 2)  ;
					$corp_y = 0;
					$src_w = $src_h;
				}else{
					$corp_y = intval(($src_h - $src_w) / 2)  ;
					$corp_x = 0;
					$src_h = $src_w;
				}
			}
			//自動縮圖
			if($src_w > $src_h){
				$percent =  $resize['width'] / $src_w;
				$new_w = $src_w * $percent;
				$new_h = $src_h * $percent;
			}else{
				$percent = $resize['height'] / $src_h;
				$new_w = $src_w * $percent;
				$new_h = $src_h * $percent;
			}

			$thumb = imagecreatetruecolor($new_w,$new_h);

			if($outputType == "png"){
				//產生透明背景
				imagecolorallocatealpha($thumb , 0 , 0 , 0 ,127);
				//關閉混合模式，以便透明顏色能覆蓋原畫布
				imagealphablending($thumb ,false);
				imagecopyresampled($thumb, $src, 0, 0, 0, 0,$new_w,$new_h, $src_w, $src_h);
				//產生透明色背景的png圖片
				imagesavealpha($thumb, true);
				ImagePng($thumb,$upload_folder."/".$filename);
			}else{
				$white = imagecolorallocate($thumb, 255, 255, 255);
				imagefill($thumb,0,0,$white);
				if($corp){
					imagecopyresampled($thumb, $src, 0, 0, $corp_x ,$corp_y,$resize['width'],$resize['height'], $src_w, $src_h);
				}else{
					//開啟裁圖在第5第6個值放置$corp_x ,$corp_y  $dst_x, $dst_y設置為0 $new_w,$new_h設置為$resize['width'],$resize['height']
					imagecopyresampled($thumb, $src, 0, 0, 0, 0,$new_w,$new_h, $src_w, $src_h);
				}

				imagejpeg($thumb,$upload_folder."/".$filename);
			}
			
		}else{
			copy($image['tmp_name'],$upload_folder."/".$filename);
		}
		
		if($o_img)
			copy($image['tmp_name'],$upload_folder."/".$o_name); 
		
		return true;
	}	
}