<?php
$user = Yii::app()->user;
//設置映射
$mapping = array(
	"user" => "user",
	"auth" => "user",
	"siteSetting" => "siteSetting",
	"lbs" => "business",
	"lbsGroup" => "business",
	"bcMaker" => "business",
	"business" => "business",
);
$fullMenu = array();
//設置選單 
$fullMenu = array(	
	"business" => array(
		"title" => "業務雲",
		"defaultUrl" => "lbs/index",
		"action" => array(
			array("title" => "LBS資料庫", "remark" => "神奇的 LBS 資料庫", "url"=>"lbs/index", "controller" => "lbs", "action" => array("index", "checkData", "newData", "import", "delLBS", "updateLBS","exportIndex","export","exportDelete")),
			array("title" => "LBS群組設定", "remark" => "hide", "url"=>"lbsGroup/admin", "controller" => "lbsGroup", "action" => array("admin", "update", "create", "delete")),		
			array("title" => "CF蓋板產生器", "remark" => "快速產生CF蓋板", "url"=>"bcMaker/admin", "controller" => "bcMaker", "action" => array("admin", "update", "create", "delete")),		
		)
	),	
	"siteSetting" => array(
		"title" => "網站設定",
		"defaultUrl" => "siteSetting/admin",
		"action" => array(
			array("title" => "網站參數設定", "remark" => "設定網站基本參數", "url"=>"siteSetting/admin", "controller" => "siteSetting", "action" => array("admin", "update", "create", "active", "view", "delete")),
		)
	),	
	"user" => array(
		"title" => "使用者管理",
		"defaultUrl" => "user/admin",
		"action" => array(
			array("title" => "管理使用者", "remark" => "管理後台使用者名冊", "url"=>"user/admin", "controller" => "user", "action" => array("admin", "update", "create", "active", "delete")),
			array("title" => "管理使用者權限", "remark" => "管理後台使用者的操作權限", "url"=>"auth/admin","controller" => "auth", "action" => array("admin", "update")),
			array("title" => "修改密碼(僅限管員)", "remark" => "修改方式請洽技術人員", "url"=>"user/setPassword","controller" => "user", "action" => array("setPassword")),
		
			// array("title" => "修改密碼", "remark" => "修改我的密碼", "url"=>"user/repassword?id=".$user->id,"controller" => "user", "action" => array("repassword")),
		)
	),
);

$menu = array();
$ignoreController = array();
$naviItem = array();

foreach ($user->auth as $key => $controller) {
	$ignoreController[] = $key;

	if(!in_array($mapping[$key], $naviItem))
		$naviItem[] = $mapping[$key];

}

foreach ($fullMenu as $key => $value) {	
	if(!isset($menu[$key])){
		$fullArray = $value;

		$menu[$key] = array(
			"title" => $fullArray['title'],
			"defaultUrl" => $fullArray['defaultUrl'],
		);

		foreach ((array)$fullArray['action'] as $action) {
			if(isset($user->auth[$action['controller']])){
				foreach ($user->auth[$action['controller']] as $inAuth) {
					if(in_array($action['controller'], $ignoreController) && in_array($inAuth, $action['action'])){
						$menu[$key]['action'][] = $action;	
						break;
					}
				}
			}
		};
		$menu[$key]['defaultUrl'] = $menu[$key]['action'][0]['url'];
	}
}
//print_r($menu);exit;
// print_r($user->auth);
// print_r($menu);exit;