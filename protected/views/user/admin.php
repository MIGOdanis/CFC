<div class="page-header">
  <h1>管理後台使用者</h1>
</div>
<SCRIPT TYPE="text/javascript">	
	$(function() {
		$(".pager").attr("class"," ");
		$(".pagination .first,.pagination .last").hide();
	})
</SCRIPT>
<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#site-setting-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<a class="btn btn-default" href="create">新增後台使用者</a>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'site-setting-grid',
	'itemsCssClass' => 'table table-bordered table-striped',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'summaryText'=>'共 {count} 筆資料，目前顯示第 {start} 至 {end} 筆',
	'emptyText'=>'沒有資料',
	'pager' => array(
		'nextPageLabel' => '»',
		'prevPageLabel' => '«',
		'firstPageLabel' => ' ',
		'lastPageLabel'=> ' ',
		'header' => ' ',
		'htmlOptions' => array('class'=>'pagination'),
		'hiddenPageCssClass' => '',
		'selectedPageCssClass' => 'active',
		'previousPageCssClass' => '',
		'nextPageCssClass' => ''
	),
	'template'=>'{pager}{items}{pager}',
	'columns'=>array(
		'username',
		'nick_name',
		array(
			'name'=>'active',
			'value'=>'($data->active == 0)? "停用中" : "啟用中"',
		),		
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{activate}{deactivate}{delete}',
			'deleteConfirmation'=>"js:'確定是否要刪除此項目?'",
			'htmlOptions'=>array('width'=>'80'),
			'buttons'=>array
			(
				'activate'=>array(
						'label'=>'啟用',
						'url'=>'Yii::app()->createUrl("activity/active", array("id"=>$data->id))',
						'click'=>"function() {
							if(!confirm('是否啟用?')) return false;
							var th = this,
								afterDelete = function(){};
							jQuery('#activity-grid').yiiGridView('update', {
								type: 'POST',
								url: jQuery(this).attr('href'),
								success: function(data) {
									jQuery('#activity-grid').yiiGridView('update');
									afterDelete(th, true, data);
								},
								error: function(XHR) {
									return afterDelete(th, false, XHR);
								}
							});
							return false;
						}",						
						'imageUrl'=> Yii::app()->params['baseUrl'] . '/assets/image/icon/layouts_icon_activate.jpg',
						'visible'=> '$data->active == 0',
				),
				'deactivate'=>array(
						'label'=>'停用',
						'url'=>'Yii::app()->createUrl("activity/active", array("id"=>$data->id))',
						'click'=>"function() {
							if(!confirm('是否停用?')) return false;
							var th = this,
								afterDelete = function(){};
							jQuery('#activity-grid').yiiGridView('update', {
								type: 'POST',
								url: jQuery(this).attr('href'),
								success: function(data) {
									jQuery('#activity-grid').yiiGridView('update');
									afterDelete(th, true, data);
								},
								error: function(XHR) {
									return afterDelete(th, false, XHR);
								}
							});
							return false;
						}",
						'imageUrl'=> Yii::app()->params['baseUrl'] . '/assets/image/icon/poll_deactivate.jpg',
						'visible'=> '$data->active == 1',
				),			
			),			
		),
	),
)); ?>
