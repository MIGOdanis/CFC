<?php
$update = 0;
if(isset($_POST['data'])){
	$data = json_decode($_POST['data']);
	$update = 1;
}
?>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/jquery-ui.min.js"></script>
<h3>增加複選按鈕</h3>
<div class="form-group">
	<label>標題</label>
	<input size="60" maxlength="70" class="form-control" placeholder="標題" id="input-title" type="text" required 
		data-toggle="popover" title="必填欄位" data-content="這是必填欄位" data-placement="top" value="<?php echo ($update)? $data->title : ""; ?>"
	>
</div>
<div class="form-group">
	<label>說明文字</label>
	<input size="60" maxlength="70" class="form-control" placeholder="說明文字" id="input-caption" type="text"  value="<?php echo ($update)? $data->caption : ""; ?>">	
</div>
<div class="form-group">
	<label>複選按鈕</label>
	<small>*未填寫的按紐文字將被忽略</small>
	<form id="single-select-input-form">
		<div id="single-select-input-group">
			<?php
			if($update){
				foreach ($data->select as $row) {
			?>
				<div class="single-select-input-box">
					<input type="checkbox" value="" disabled>
					<input size="60" maxlength="70" class="form-control single-select-input-text" placeholder="按鈕文字" name="ssname[]" type="text" value="<?php echo $row; ?>" >
					<button type="button" class="btn btn-default btn-sm single-select-input-remove-btn" data-page="1">
					  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>			
				</div>	
			<?php 
				}
			}else{
			?>	
			<div class="single-select-input-box">
				<input type="checkbox" value="" disabled>
				<input size="60" maxlength="70" class="form-control single-select-input-text" placeholder="按鈕文字" name="ssname[]" type="text" >
				<button type="button" class="btn btn-default btn-sm single-select-input-remove-btn" data-page="1">
				  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>			
			</div>
			<?php }?>						
		</div>	
	</form>
	<div class="single-select-input-box-add single-select-add-btn">
		<input type="checkbox" value="" disabled>
		<input size="60" maxlength="70" class="form-control single-select-add-btn" placeholder="按一下這裡新增項目" type="text" disabled>
		<div class="single-select-input-temp">
			<div class="single-select-input-box">
				<input type="checkbox" value="" disabled>
				<input size="60" maxlength="70" class="form-control single-select-input-text" placeholder="按鈕文字" name="ssname[]" type="text" >
				<button type="button" class="btn btn-default btn-sm single-select-input-remove-btn" data-page="1">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>	
			</div>				
		</div>	
	</div>
	<div class="single-select-input-box-other single-select-other">
		<input type="checkbox" value="" disabled>
		<input size="60" maxlength="70" class="form-control single-select-other-btn" placeholder="其他" type="text" disabled>	
	</div>	
	<div class="form-group">
		<label class="checkbox-inline">
			<input type="checkbox" id="input-other" value="1" <?php if($data->other){ echo "checked"; }?>>
			顯示其他項目
		</label>
	</div>	
	<div class="form-group">
		<label class="checkbox-inline">
			<input type="checkbox" id="input-required" value="1" <?php if($data->required){ echo "checked"; }?>>
			此欄位必填
		</label>
	</div>	
</div>
<div class="modal-footer">
	<input class="btn btn-primary" id="getLayout" type="submit" name="yt0" data-page="<?php echo $_GET['pid']; ?>" value="<?php echo ($update)? "修改" : "新增"; ?>">
</div>
<script type="text/javascript">
	$(function() {
		var other;

		checkChecked();

		function checkChecked(){
			if($("#input-other").prop("checked")){
				other = 1;
				$(".single-select-other").show();
			}else{
				other = 0;
				$(".single-select-other").hide();
			}			
		}

		$("#input-other").click(function() {
			checkChecked();
		});


		function initSortable(){
			$( "#single-select-input-group" ).sortable({
				connectWith: "#single-select-input-group",
				dropOnEmpty: false
			});			
		}

		function initKeysup(){
			$(".single-select-input-text").keyup(function() {
				$(this).attr("value",$(this).val());
			});
		}

		initSortable();
		initKeysup();
		
		$(".single-select-input-text").keyup(function() {
			$(this).attr("value",$(this).val());
		});
		
		$(".single-select-add-btn").click(function() {
			$("#single-select-input-group").html( $("#single-select-input-group").html() + $(".single-select-input-temp").html());
			initKeysup();
		});

		$(".single-select-input-remove-btn").live("click",function() {
			$(this).parent().remove();
		});

		$("#getLayout").click(function() {
			var required;
			if($("#input-required").prop("checked")){
				required = 1;
			}else{
				required = 0;
			}				
			var data = {
				title:$("#input-title").val(),
				caption : $("#input-caption").val(),
				select:$("#single-select-input-form").serialize(),
				other:other,
				update:<?php echo $update; ?>, 
				objid:"<?php echo $_POST['objid']; ?>",
				required:required
			}
			if($("#input-title").val().length > 0){
				$.ajax({
					type: 'POST',
					url:"getLayout?type=multiSelect&pid=<?php echo $_GET['pid']; ?>",
					data: data,
					success:function(html){
						//console.log(html);
						<?php if($update == 0){ ?>
							$("#page<?php echo $_GET['pid']; ?>-group .ojb-group").html($("#page<?php echo $_GET['pid']; ?>-group .ojb-group").html() + html);
						<?php }else{ ?>
							$("#<?php echo $_POST['objid']; ?>").html(html);
						<?php } ?>
						$('#modal-content').html("");
						$('#modal').modal('hide');
						initrmoj();
						initSortableOfForm();
					}
				})
		        .fail(function(e) {
		            if(e.status == 403){
		                window.location.reload();
		            }
		        });
	    	}else{
	    		$("#input-title").parent().addClass("has-error");
	    		$('#input-title').popover('show')
	    	}
			return false;//阻止a标签		
		});
	})
</script>