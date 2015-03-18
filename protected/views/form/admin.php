<div class="page-header">
  <h1>管理問券</h1>
</div>
<SCRIPT TYPE="text/javascript">	
	$(function() {
		$(".pager").attr("class"," ");
		$(".pagination .first,.pagination .last").hide();
	})
</SCRIPT>
<?php
function transActive($active){
	$activeArray = array("停用中","啟用中","待發佈");
	return $activeArray[$active];
}

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
<a class="btn btn-default" href="create">建立新問券</a>
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
			'value'=>'CHtml::link($data->title, array("form/view","id"=>$data->id))',
		),	
		array(
			'name'=>'fill_count',
			'value'=>'$data->fill_count',
			'htmlOptions'=>array('width'=>'100'),
			'filter'=>false,
		),
		array(
			'name'=>'creat_by',
			'value'=>'$data->user->nick_name',
			'htmlOptions'=>array('width'=>'100'),
			'filter'=>false,
		),	
		array(
			'name'=>'star_time',
			'value'=>'date("Y-m-d",$data->star_time)',
			'htmlOptions'=>array('width'=>'100'),
			'filter'=>false,
		),
		array(
			'name'=>'end_time',
			'value'=>'date("Y-m-d",$data->end_time)',
			'htmlOptions'=>array('width'=>'100'),
			'filter'=>false,
		),					
		array(
			'name'=>'active',
			'value'=>'transActive($data->active)',
			'htmlOptions'=>array('width'=>'90'),
		),		
		array(
			'name'=>'creat_time',
			'value'=>'date("Y-m-d H:i",$data->creat_time)',
			'htmlOptions'=>array('width'=>'150'),
			'filter'=>false,
		),			
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{activate}{deactivate}{view}',
			'htmlOptions'=>array('width'=>'70'),
			'buttons'=>array
			(
				'view' => array(
					'url'=>'Yii::app()->createUrl("form/report", array("id"=>$data->id))',
					'visible'=> '$data->fill_count > 1',
				),
				'activate'=>array(
						'label'=>'啟用',
						'url'=>'Yii::app()->createUrl("form/active", array("id"=>$data->id))',
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
				'activate'=>array(
						'label'=>'啟用',
						'url'=>'Yii::app()->createUrl("form/active", array("id"=>$data->id))',
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
						'visible'=> '$data->active == 2',
				),				
				'deactivate'=>array(
						'label'=>'停用',
						'url'=>'Yii::app()->createUrl("form/active", array("id"=>$data->id))',
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
