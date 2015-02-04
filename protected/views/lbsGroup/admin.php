<SCRIPT TYPE="text/javascript">	
	$(function() {
		$(".pager").attr("class"," ");
		$(".pagination .first,.pagination .last").hide();
	})
</SCRIPT>

<div class="page-header">
  <h1>LBS群組管理</h1>
</div>
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
<a class="btn btn-default" href="create">新增群組設定</a>
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
		'name',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
			'deleteConfirmation'=>"js:'確定是否要刪除此項目?'",
		),
	),
)); ?>
