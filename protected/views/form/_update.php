<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">修改</h4>
</div>
<div class="modal-body">
	<?php
		$page = array(
			"newPage" => "_newPage",
			"singleText" => "_singleText",
			"multiText" => "_multiText",
			"singleSelect" => "_singleSelect",
			"multiSelect" => "_multiSelect",
			"dropDown" => "_dropDown",
			"numberToLevel" => "_numberToLevel",
			"tableSelect" => "_tableSelect",
			"dateAndTime" => "_dateAndTime",
			"html" => "_html"
		);
		$this->renderPartial($page[$type]); 	
	?>
</div>
