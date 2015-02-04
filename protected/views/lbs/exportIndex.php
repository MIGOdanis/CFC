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
<div class="page-header">
  <h1>LBS群組匯出</h1>
</div>
<div>
	<select name="group" onchange="javascript:window.location=this.value">
	<?php if(!isset($_GET['LbsLatlng']['group_id']) || $_GET['LbsLatlng']['group_id'] > 0): ?>
		<option value="">請選擇</option>	
	<?php endif; ?>		
		<?php foreach ($LbsGroup as $value) {?>
			<option value="exportIndex?LbsLatlng[group_id]=<?php echo $value->id; ?>"
				<?php if($_GET['LbsLatlng']['group_id'] == $value->id){ echo 'selected="selected"'; }?>><?php echo $value->name; ?></option>
		<?php }?>
	</select>
	<p>
</div>
<?php if(isset($_GET['LbsLatlng']['group_id'])  && $_GET['LbsLatlng']['group_id'] > 0): ?>
<div>
	<a class="btn btn-default" href="export?id=<?php echo $_GET['LbsLatlng']['group_id'];?>">匯出群組</a>
</div>
<?php else: ?>
<div>
	請選擇一個群組匯出
</div>
<?php endif; ?>	
<SCRIPT TYPE="text/javascript">	
	$(function() {
		$(".pager").attr("class"," ");
		$(".pagination .first,.pagination .last").hide();
	})
</SCRIPT>
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
		'address',
		'lat',
		'lng',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
			'deleteConfirmation'=>"js:'確定是否要刪除此項目?'",
		),
	),
)); ?>