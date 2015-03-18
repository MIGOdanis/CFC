<?php
$update = 0;
if(isset($_POST['data'])){
	$data = json_decode($_POST['data']);
	$update = 1;
}
?>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/jquery-ui.min.js"></script>
<h3><?php echo ($update)? "修改" : "新增"; ?>表格按鈕</h3>
<div class="form-group">
	<label>標題</label>
	<input size="60" maxlength="70" class="form-control" placeholder="標題" id="input-title" type="text" required 
		data-toggle="popover" title="必填欄位" data-content="這是必填欄位" data-placement="top"  value="<?php echo ($update)? $data->title : ""; ?>"
	>
</div>
<div class="form-group">
	<label>說明文字</label>
	<input size="60" maxlength="70" class="form-control" placeholder="說明文字" id="input-caption" type="text"  value="<?php echo ($update)? $data->caption : ""; ?>">	
</div>
<div class="form-group column-input-group">
	<label>欄 (橫向)</label>
	<form id="single-select-input-form">
		<div id="single-select-input-group">
			<?php
			if($update){
				foreach ($data->column as $column) {
			?>
				<div class="single-select-input-box">
					<input size="60" maxlength="70" class="form-control single-select-input-text" placeholder="顯示文字" name="column[]" type="text"  value="<?php echo $column; ?>">				
					<button type="button" class="btn btn-default btn-sm single-select-input-remove-btn" data-page="1">
					  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>			
				</div>	
			<?php 
				}
			}else{
			?>		
				<div class="single-select-input-box">
					<input size="60" maxlength="70" class="form-control single-select-input-text" placeholder="顯示文字" name="column[]" type="text" >				
					<button type="button" class="btn btn-default btn-sm single-select-input-remove-btn" data-page="1">
					  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>			
				</div>
			<?php }?>				
		</div>	
	</form>
	<div class="single-select-input-box-add single-select-add-btn">
		<input size="60" maxlength="70" class="form-control single-select-add-btn" placeholder="按一下這裡新增項目" type="text" disabled>
		<div class="single-select-input-temp">
			<div class="single-select-input-box">
				<input size="60" maxlength="70" class="form-control single-select-input-text" placeholder="顯示文字" name="column[]" type="text" >
				<button type="button" class="btn btn-default btn-sm single-select-input-remove-btn" data-page="1">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>	
			</div>				
		</div>		
	</div>				
</div>
<div class="form-group row-input-group">
	<label>列 (直向)</label>
	<form id="single-select-input-form">
		<div id="single-select-input-group">
			<?php
			if($update){
				foreach ($data->row as $row) {
			?>		
				<div class="single-select-input-box">
					<input size="60" maxlength="70" class="form-control single-select-input-text" placeholder="顯示文字" name="row[]" type="text"  value="<?php echo $row; ?>" >				
					<button type="button" class="btn btn-default btn-sm single-select-input-remove-btn" data-page="1">
					  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>			
				</div>
			<?php 
				}
			}else{
			?>	
				<div class="single-select-input-box">
					<input size="60" maxlength="70" class="form-control single-select-input-text" placeholder="顯示文字" name="row[]" type="text" >				
					<button type="button" class="btn btn-default btn-sm single-select-input-remove-btn" data-page="1">
					  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>			
				</div>
			<?php }?>				
		</div>	
	</form>
	<div class="single-select-input-box-add single-select-add-btn">
		<input size="60" maxlength="70" class="form-control single-select-add-btn" placeholder="按一下這裡新增項目" type="text" disabled>
		<div class="single-select-input-temp">
			<div class="single-select-input-box">
				<input size="60" maxlength="70" class="form-control single-select-input-text" placeholder="顯示文字" name="row[]" type="text" >
				<button type="button" class="btn btn-default btn-sm single-select-input-remove-btn" data-page="1">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>	
			</div>				
		</div>		
	</div>				
</div>
<div class="form-group">
	<label class="checkbox-inline">
		<input type="checkbox" id="input-required" value="1" <?php if($data->required){ echo "checked"; }?>>
		此欄位必填
	</label>
</div>
<div class="modal-footer">
	<input class="btn btn-primary" id="getLayout" type="submit" name="yt0" data-page="<?php echo $_GET['pid']; ?>" value="<?php echo ($update)? "修改" : "新增"; ?>">
</div>
<script type="text/javascript">
	$(function() {



		var warp;

		$("#input-warp").click(function() {
			if($("#input-warp").prop("checked")){
				warp = 1;
				$(".drop-down-warp").show();
			}else{
				warp = 0;
				$(".drop-down-warp").hide();
			}
		});

		function initSortable(){
			$( ".column-input-group #single-select-input-group" ).sortable({
				connectWith: ".column-input-group #single-select-input-group",
				dropOnEmpty: false
			});		
			$( ".row-input-group #single-select-input-group" ).sortable({
				connectWith: ".row-input-group #single-select-input-group",
				dropOnEmpty: false
			});					
		}

		function initKeysup(){
			$(".single-select-input-text").keyup(function() {
				$(this).attr("value",$(this).val());
			});
		}

		function initWarpSelect(){
			$(".drop-down-warp-Ojb").change(function() {
				var warpSelect = $(this).val();
				$("option",this).removeAttr("selected");
				$("option",this).each(function() {
					if ($(this).val() == warpSelect) {
						$(this).attr("selected", "selected");
					}
				});
			});
		}

		initSortable();
		initKeysup();
		initWarpSelect();
		
		$(".single-select-input-text").keyup(function() {
			$(this).attr("value",$(this).val());
		});
		
		$(".column-input-group .single-select-add-btn").click(function() {
			$(".column-input-group #single-select-input-group").html( $(".column-input-group #single-select-input-group").html() + $(".column-input-group .single-select-input-temp").html());
			initKeysup();
			initWarpSelect();
		});

		$(".row-input-group .single-select-add-btn").click(function() {
			$(".row-input-group #single-select-input-group").html( $(".row-input-group #single-select-input-group").html() + $(".row-input-group .single-select-input-temp").html());
			initKeysup();
			initWarpSelect();
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
				column:$(".column-input-group #single-select-input-form").serialize(),
				row:$(".row-input-group #single-select-input-form").serialize(),
				update:<?php echo $update; ?>, 
				objid:"<?php echo $_POST['objid']; ?>",
				required:required
			}
			if($("#input-title").val().length > 0){
				$.ajax({
					type: 'POST',
					url:"getLayout?type=tableSelect&pid=<?php echo $_GET['pid']; ?>",
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