<?php
/**
 * 首頁
 * 
 * 網站首頁。
 * 
 * @author	KeaNy
 * @date	2013.3
 * @spend	1 hour
 * --------------------
 * 首頁套版
 *
 * @author	KeaNy
 * @date	2013.8.5
 * @spend	1 hour
 *  ---------------------
 * 首頁套版 v1
 *
 * @author    Danis
 * @date        2013.8.26
 * @spend     1 week
 *  ---------------------
 * 首頁套版 v2
 *
 * @author    Danis
 * @date        2013.9.02
 * @spend     1 Week 
 * ------------------
 * 加上頁面標題，修改取得熱門話題的語法
 *
 * @author KeaNy
 * @date 2013.9.26
 * @spend 5 min
 * ------------------
 * 版面調整、assets檔案引用順序調整
 *
 * @author Denny
 * @date 2013.10.04
 * @spend 5 min
 * ----------------
 * 首頁優惠區塊改靜態頁面生成
 *
 * @author Danis
 * @date 2013.10.15
 * @spend 5 min
 * ----------------
 * 首頁主題區塊改靜態頁面生成
 *
 * @author Danis
 * @date 2013.10.16
 * @spend 5 min
 * ----------------
 * 首頁熱門話題靜態頁面生成
 *
 * @author Danis
 * @date 2013.10.16
 * @spend 5 min
 * ----------------
 * 首頁公告靜態頁面生成
 *
 * @author Danis
 * @date 2013.10.16
 * @spend 5 min
 * ----------------
 * 首頁活動靜態頁面生成
 *
 * @author Danis
 * @date 2013.10.16
 * @spend 15 min
 * ----------------
 * 移除超連結
 *
 * @author KeaNy
 * @date 2013.10.17
 * @spend 1 min
 * ----------------
 * 修改顯示人數的變數
 *
 * @author KeaNy
 * @date 2013.10.21
 * @spend 1 min
 * ----------------
 * 調整樣式、修改連結
 *
 * @author Denny
 * @date 2013.11.04
 * @spend 5 min
 * ----------------
 * 修正了解更多按鈕
 *
 * @author Danis
 * @date 2013.11.7
 * @spend 1 min
 * ----------------
 * 修正店家刊登資料按鈕
 *
 * @author Danis
 * @date 2013.11.7
 * @spend 5 min
 * -------------------
 * 修改廣告widget參數
 *
 * @author Danis 
 * @date 2013.11.20
 * @spend 3 min 
 * ----------------
 * 修正搜尋類別值
 * 
 * @author Danis
 * @date 2013.12.2
 * @spend 3 min
 * -----------------
 * 首頁ie修正css置入
 *
 * @author Denny
 * @date 2013.12.02
 * @spend 1 min
 * ------------------
 * 新增臉書按讚後詢問視窗
 *
 * @author Danis
 * @date 2013.12.31
 * @spend 10 min
 * ------------------
 * RWD改版
 *
 * @author Denny
 * @date 2014.1.15
 * @spend 10 min
 * ------------------
 * 搜尋新增活動
 *
 * @author KeaNy
 * @date 2014.3.25
 * @spend 1 min
 * ------------------
 * 調整版面
 *
 * @author KeaNy
 * @date 2014.3.26
 * @spend 1 min
 * ------------------
 * 首頁header新增"全部"按鈕
 *
 * @author Danis
 * @date 2014.4.29
 * @spend 5 min
 * ------------------
 * 搜尋表單改為另外載入
 *
 * @author KeaNy
 * @date 2014.5.27
 * @spend 5 min
 */
$cs = Yii::app()->getClientScript();
$cs->registerCssFile("/assets/css/components/animations.css");
$cs->registerCssFile("/assets/css/plugins/icheck/polaris/polaris.css");
$cs->registerCssFile("/assets/css/type/index.css");
$cs->registerCssFile("/assets/css/type/index-xs.css", "screen and (max-width: 767px)");
$cs->registerScriptFile("/assets/js/plugins/jquery.icheck.min.js");
$cs->registerScriptFile("/assets/js/components/search_autocomplete.js");
$cs->registerScriptFile("/assets/js/components/index.js");

$this->pageTitle = Yii::app()->name;
?>

<!--[if lt IE 9]>
	<link href="/assets/css/type/index-ie8.css" rel="stylesheet">
<![endif]-->

<header class="hidden-xs">
	<div class="header-bg">
		<div class="subject container">			
			<div class="slogan">
				<h2><img src="/assets/images/index/header-title.png"></h2>
				<h3>已有 <strong><?php echo number_format($userCount); ?></strong> 人體驗眾多優惠</h3>
				<?php echo CHtml::link('<img src="/assets/images/index/header-btn.png">', array('/about/'),array("class"=>"btn")); ?>
			</div><!-- .header-input -->
			
			<div class="header-input">
				<?php $this->renderPartial('_search_form'); ?>
			</div><!-- /.header-input -->
		</div><!-- /.subject -->
	</div><!-- /.header-bg -->
</header>

<!-- #main-content -->
<div id="main-content" class="container">	
		<!-- #category -->
		<?php $this->widget('HotCategoryWidget'); ?>
		<!-- /.category-list -->
		<div class="category-banner col-md-2 col-sm-2 col-xs-12">
			<ul class="list-unstyled">
				<li class="top"><?php $this->widget('AdWidget', array('positionId' => 2)); ?></li>
				<li><?php $this->widget('AdWidget', array('positionId' => 4)); ?></li>
			</ul>
		</div>
	</div>
	<!-- /#category -->
	<!-- #info-list -->
	<div id="info-list" class="row section">		
		<!-- #left-col -->
		<div id="left-col" class="col-md-8 col-sm-8 col-xs-12">
			<div class="row section">		
				<!-- #forum -->
				<?php $this->widget('TopicsWidget'); ?>
				<!-- /#forum -->
				<!-- #discount -->
				<?php $this->widget('PreferentialWidget'); ?>
				<!-- /#discount -->
			</div>
			<!-- 活動 -->
			<?php $this->widget('ActivityWidget'); ?>
		</div>
		<!-- /#left-col -->
		
		<!-- #right-col -->
		<div id="right-col" class="col-md-4 col-sm-4 col-xs-12">					
			<div id="banner-main" class="section">
				<?php $this->widget('AdWidget', array('positionId' => 3)); ?>
			</div>
			<div id="fb" class="section hidden-xs">
				<?php $this->widget('FansWidget'); ?>
			</div>
			
			<div class="section">
				<?php echo CHtml::link('店家刊登資料', array('register/company'),array("class"=>"btn-kuru btn btn-lg btn-block")); ?>
			</div>
			<!-- 公告 -->
			<?php $this->widget('BulletinWidget'); ?>
			<!-- /#site-news -->
		</div>
		<!-- /#right-col -->
	</div>
	<!-- /#info-list -->
</div>
<!-- /#main-content -->
<!-- #fb-like-modal.modal -->
<div id="fb-like-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="wellcome-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h3 class="text-center text-danger">參加按讚拿好禮活動</h3>
				<h4>感謝您在我們粉絲團「按讚」，目前正在進行「按讚拿好禮」的活動，您是否要參加活動拿好禮呢？</h4>
				<br>
				<p class="text-center">
					<?php echo CHtml::link('參加', array('site/fblikechk'), array('class'=>'btn btn-kuru btn-lg')); ?>
					<a href="#" class="no btn btn-default btn-lg">不參加</a>
				</p>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>