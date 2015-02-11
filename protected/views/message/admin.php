<div class="page-header">
  <h1>訊息管理</h1>
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
	$('#yiiCGrid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<a class="btn btn-default" href="create">發布新訊息</a>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'yiiCGrid',
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
		array(
			'name'=>'title',
			'type' =>'raw',
			'value'=>'CHtml::link($data->title, array("message/view","id"=>$data->id))',
		),	
		array(
			'name'=>'publish_id',
			'value'=>'$data->user->nick_name',
			'htmlOptions'=>array('width'=>'100'),
			'filter'=>false,
		),	
		array(
			'name'=>'type',
			'value'=>'Yii::app()->params["msgType"][$data->type]',
			'htmlOptions'=>array('width'=>'80'),
			'filter'=>false,
		),		
		array(
			'name'=>'active_time',
			'value'=>'date("Y-m-d",$data->active_time)',
			'htmlOptions'=>array('width'=>'100'),
			'filter'=>false,
		),					
		array(
			'name'=>'active',
			'value'=>'($data->active == 0)? "停用中" : "啟用中"',
			'htmlOptions'=>array('width'=>'90'),
			'filter'=>false,
		),	
		array(
			'name'=>'creat_time',
			'value'=>'date("Y-m-d H:i",$data->creat_time)',
			'htmlOptions'=>array('width'=>'150'),
			'filter'=>false,
		),			
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{activate}{deactivate}{delete}',
			'deleteConfirmation'=>"js:'確定是否要刪除此項目?'",
			'htmlOptions'=>array('width'=>'70'),
			'buttons'=>array
			(
				'activate'=>array(
						'label'=>'啟用',
						'url'=>'Yii::app()->createUrl("message/active", array("id"=>$data->id))',
						'click'=>"function() {
							if(!confirm('是否啟用?')) return false;
							var th = this,
								afterDelete = function(){};
							jQuery('#yiiCGrid').yiiGridView('update', {
								type: 'POST',
								url: jQuery(this).attr('href'),
								success: function(data) {
									jQuery('#yiiCGrid').yiiGridView('update');
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
						'url'=>'Yii::app()->createUrl("message/active", array("id"=>$data->id))',
						'click'=>"function() {
							if(!confirm('是否停用?')) return false;
							var th = this,
								afterDelete = function(){};
							jQuery('#yiiCGrid').yiiGridView('update', {
								type: 'POST',
								url: jQuery(this).attr('href'),
								success: function(data) {
									jQuery('#yiiCGrid').yiiGridView('update');
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
