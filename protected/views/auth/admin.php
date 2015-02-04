<div class="page-header">
  <h1>管理後台使用者權限</h1>
  <p class="help-block">請先選擇使用者</p>
</div>
<SCRIPT TYPE="text/javascript">	
	$(function() {
		$(".pager").attr("class"," ");
		$(".pagination .first,.pagination .last").hide();
	})
</SCRIPT>
<style type="text/css">
	tbody td{
		line-height: 35px !important;
	}
</style>
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
			'header'=>'設定',
			'type'=>'raw',
			'value'=> 'CHtml::link("設定",array("auth/update","id"=>$data->id),array("class"=>"btn btn-default"))',
			'htmlOptions'=>array('width'=>'55')
		),			
	),
)); ?>
