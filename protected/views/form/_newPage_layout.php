<?php if ($_POST['update'] == 0) {?>
<div class="form-box" id="page<?php echo ($_GET['pid'] + 1);?>">
<?php }?>
	<?php
	$array = array(
		"type" => "newPage",
		"value" => ($_GET['pid'] + 1),
		"title" => $_POST['title'],
		"caption" => $_POST['caption']
	);
	$json = json_encode($array);
	?>
	<input type="hidden" id="hide-<?php echo ($_GET['pid'] + 1);?>" name="forms[]" value='<?php echo $json; ?>' />
	<div class="form-box-label">分頁(<span class="this-page"><?php echo ($_GET['pid'] + 1);?></span>/<span class="tot-page"><?php echo ($_GET['pid'] + 1);?></span>)</div>	
	<div id="page<?php echo ($_GET['pid'] + 1);?>-group">
		<div class="title-group">
			<h1><?php echo $_POST['title'];?><?php if($_POST['required'] == 1){ echo '<span class="required-form">*</span>'; } ?></h1>
			<h3><?php echo $_POST['caption'];?></h3>
		</div>
		<div class="ojb-group">
			
		</div>
		<div class="form-group">
				<label>本頁結束之後</label>
				<div class="btn-group page-over">
					<?php
					$array = array(
						"type" => "pageOver",
						"page" => ($_GET['pid'] + 1),
						"value" => "end"
					);
					$json = json_encode($array);
					?>					
					<input id="page<?php echo ($_GET['pid'] + 1);?>-over" type="hidden" name="forms[]" value='<?php echo $json; ?>' />	
					<button id="type-list" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
					<span id="page<?php echo ($_GET['pid'] + 1);?>-over-select">提交表單</span> <span class="caret"></span>
					</button>
				  	<ul class="page-over-dropdown-menu dropdown-menu" role="menu" data-page="<?php echo ($_GET['pid'] + 1);?>">
						<li class="page<?php echo ($_GET['pid'] + 1);?>-over-selected" ><a class="page-over-selected" data-value="next">下一頁</a></li>
						<?php 
						for ($i=1; $i <= ($_GET['pid'] + 1); $i++) { 
						?>
					  		<li class="page<?php echo ($_GET['pid'] + 1);?>-over-selected" ><a class="page-over-selected" data-value="<?php echo $i;?>">第<?php echo $i;?>頁</a></li>
						<?php 
						} ?>						
						<li class="page<?php echo ($_GET['pid'] + 1);?>-over-selected" ><a class="page-over-selected" data-value="end">提交表單</a></li>
					</ul>
				</div>					
			</div>
	</div>	
	<button type="button" class="btn btn-default btn-sm select-btn" data-page="<?php echo ($_GET['pid'] + 1);?>">
	  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
	</button>
	<button type="button" class="btn btn-default btn-sm setting-btn" data-objid="<?php echo ($_GET['pid'] + 1);?>" data-type="newPage" >
	  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
	</button>	
	<button type="button" class="btn btn-default btn-sm rm-oj" data-objid="page<?php echo ($_GET['pid'] + 1);?>" data-page="1"  data-type="newPage">
		<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
	</button>	
<?php if ($_POST['update'] == 0) {?>
</div>
<?php }?>