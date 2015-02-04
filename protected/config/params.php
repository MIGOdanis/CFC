<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'My Yii Blog',
	// this is used in error pages
	'adminEmail'=>'webmaster@example.com',
	// number of posts displayed per page
	'postsPerPage'=>10,
	// maximum number of comments that can be displayed in recent comments portlet
	'recentCommentCount'=>10,
	// maximum number of tags that can be displayed in tag cloud portlet
	'tagCloudCount'=>20,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
	// the copyright information displayed in the footer section
	'baseUrl' => 'http://127.0.0.1/cloud',

	'userGroup' => array('1'=>'網站管理員','2'=>'產品','3'=>'BD','4'=>'業務','5'=>'行銷'),
	'msgTarget' => array('RootCompany'=>'管理員','AdAgency'=>'經銷商','Advertiser'=>'廣告主','MdAgency'=>'代理商','Site'=>'網站主'),
	'msgType' => array('1'=>'全部','2'=>'CF','3'=>'MF'),

	'uploadFolder' => dirname(__FILE__)."/../../../upload/"
);
