<style type="text/css">
	.dashboard{
		overflow: hidden;
		/*height: 120px;*/
		padding-top: 10px;
		padding-bottom: 10px;
	}
	.item{
		float: left;
		padding-left: 10px;
		padding-right: 20px;
		text-align: right;	
		width: auto;
		border-right: 1px solid #eee	
	}
	.page{
		margin-top: 20px;
		margin-bottom: 20px;
	}
	.report-ans, .report-chart{
		float: left;
	}
	.report-item{
		overflow: hidden;
		width: 100%;
		border-bottom:  1px solid #eee;
		padding:15px;
	}
	.report{
		padding-top: 15px;
	}
	.report-chart{
		width: 45%;
	}
	.report-ans{
		width: 45%;
	}
	.last-item{
		border-right: 0px;
	}
	.hide-page{
		display: none;
	}	
</style>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<div>
	<?php

	?>
	<h1><?php echo $model->title; ?></h1>
	<h4>填表時間<?php echo date("Y-m-d",$model->star_time); ?> ~ <?php echo date("Y-m-d",$model->end_time); ?></h4>
	<div class="dashboard">
		<div class="item">
			<h4>填表樣本數</h4>
			<h6>　</h6>
			<h1 class="item-nub"><?php echo $model->fill_count; ?></h1>
		</div>
		<div class="item">
			<h4>填寫者年齡區間</h4>
			<h6>20歲以下(占:<?php echo round(($userYearArray[0] / $model->fill_count) * 100,2);?>%)</h6>
			<h1 class="item-nub"><?php echo $userYearArray[0] ?></h1>
		</div>
		<div class="item">
			<h4>填寫者年齡區間</h4>
			<h6>20~29歲(占:<?php echo round(($userYearArray[1] / $model->fill_count) * 100,2);?>%)</h6>
			<h1 class="item-nub"><?php echo $userYearArray[1] ?></h1>
		</div>
		<div class="item">
			<h4>填寫者年齡區間</h4>
			<h6>30~39歲(占:<?php echo round(($userYearArray[2] / $model->fill_count) * 100,2);?>%)</h6>
			<h1 class="item-nub"><?php echo $userYearArray[2] ?></h1>
		</div>
		<div class="item">
			<h4>填寫者年齡區間</h4>
			<h6>40~49歲(占:<?php echo round(($userYearArray[3] / $model->fill_count) * 100,2);?>%)</h6>
			<h1 class="item-nub"><?php echo $userYearArray[3] ?></h1>
		</div>
		<div class="item last-item">
			<h4>填寫者年齡區間</h4>
			<h6>50歲以上(占:<?php echo round(($userYearArray[4] / $model->fill_count) * 100,2);?>%)</h6>
			<h1 class="item-nub"><?php echo $userYearArray[4] ?></h1>
		</div>								
	</div>
</div>
<a class="btn btn-default" href="report?id=<?php echo $_GET['id'];?>&report=1" role="button">下載RowData</a>
<div class="ans">
<?php 
// print_r($question); exit;
foreach ($question as $q1) { ?>
	<div class="page">
	<div class="page-header">
	  <h3><?php echo $q1['pageTitle'] . "( 分頁" . $q1['pageIndex'] . ")"; ?> </h3>
	</div>	
	<?php 
	foreach ($q1['object'] as $key => $object) {
		if($object['type'] != "html"){
	?>
		<div class="report">
			<div><?php echo $object['title']; ?></div>
			<?php  
			if(!empty($objectAns[$key])){ 
				if($object['type'] == "tableSelect"){
					$ansArray = array();
					foreach ($objectAns[$key] as $ans) {
						if(!empty($ans)){
							foreach ($ans as $value) {
								$ansArray[$value]++;
							}
						}
					}					
				}elseif($object['type'] == "multiSelect"){
					$ansArray = array();
					foreach ($objectAns[$key] as $ans) {
						if(!empty($ans)){
							foreach ($ans as $value) {
								$ansArray[$value]++;
							}
						}
					}
				}else{
					$ansArray = array();
					foreach ($objectAns[$key] as $ans) {
						$ansArray[$ans]++;
					}
				}
			}
			?>
			<div class="report-item <?php echo $key; ?>">
				<div class="report-ans">
					<ul>
						<?php foreach ($ansArray as $ansName => $ansCount) {?>	
							<li><?php echo $ansName ." : " . $ansCount; ?></li>
						<?php }?>
					</ul>					
				</div>
				<div class="report-chart">
				    <script type="text/javascript">
						google.load("visualization", "1", {packages:["corechart"]});
						google.setOnLoadCallback(
							function() {
								var data = google.visualization.arrayToDataTable([
										['Ans', 'Count'],
										<?php foreach ($ansArray as $ansName => $ansCount) {?>
											["<?php echo $ansName; ?>",<?php echo $ansCount; ?>],
										<?php }?>

									]);

								var options = {
								  title: "<?php echo $object['title']; ?>",
								  pieHole: 0.4,
								};

								var chart = new google.visualization.PieChart(document.getElementById("chart-<?php echo $key; ?>"));
								chart.draw(data, options);
					     	}							
						);
						
				    </script>						
					<div id="chart-<?php echo $key; ?>">
					</div>
				</div>
			</div>
			<?php }	?>
		</div>
	<?php }	?>
	</div>
<?php } ?>
</div>