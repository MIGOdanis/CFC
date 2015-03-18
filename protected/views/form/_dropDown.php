<?php
$update = 0;
if(isset($_POST['data'])){
	$data = json_decode($_POST['data']);
	$update = 1;
}
?>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/jquery-ui.min.js"></script>
<h3>增加下拉選單</h3>
<div class="form-group">
	<label>標題</label>
	<input size="60" maxlength="70" class="form-control" placeholder="標題" id="input-title" type="text" required 
		data-toggle="popover" title="必填欄位" data-content="這是必填欄位" data-placement="top"  value="<?php echo ($update)? $data->title : ""; ?>"
	>
</div>
<div class="form-group">
	<label>說明文字</label>
	<input size="60" maxlength="70" class="form-control" placeholder="說明文字" id="input-caption" type="text" value="<?php echo ($update)? $data->caption : ""; ?>">	
</div>
<div class="form-group">
	<label>下拉選單</label>
	<small>*未填寫的選單文字將被忽略</small>
	<form id="single-select-input-form">
		<div id="single-select-input-group">
			<?php
			if($update){
				foreach ($data->option as $option) {
					$r++;
			?>
			<div class="single-select-input-box">
				<input size="60" maxlength="70" class="form-control single-select-input-text" placeholder="選單文字" name="ssname[]" type="text" value="<?php echo $option; ?>">
				<div class="drop-down-warp">
					<select name="warp[]" class="drop-down-warp-Ojb form-control">
						<option value="next" <?php echo ($data->warpArray->$r == "next")? "selected='selected'" : "" ;?>>下一頁</option>
						<?php 
						for ($i=1; $i <= $_GET['pageCount']; $i++) { 
						?>
					  		<option value="<?php echo $i;?>" <?php echo($data->warpArray->$r == $i)? "selected='selected'" : "" ;?> >第<?php echo $i;?>頁</option>
						<?php 
						} ?>
						<option value="end" <?php echo($data->warpArray->$r == "end")? "selected='selected'" : "" ;?>>提交表單</option>
					</select>
				</div>				
				<button type="button" class="btn btn-default btn-sm single-select-input-remove-btn" data-page="1">
				  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>			
			</div>	
			<?php 
				}
			}else{
			?>
			<div class="single-select-input-box">
				<input size="60" maxlength="70" class="form-control single-select-input-text" placeholder="選單文字" name="ssname[]" type="text" value="<?php echo $option; ?>">
				<div class="drop-down-warp">
					<select name="warp[]" class="drop-down-warp-Ojb form-control">
						<option value="next">下一頁</option>
						<?php 
						for ($i=1; $i <= $_GET['pageCount']; $i++) { 
						?>
					  		<option value="<?php echo $i;?>">第<?php echo $i;?>頁</option>
						<?php 
						} ?>
						<option value="end">提交表單</option>
					</select>
				</div>				
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
				<input size="60" maxlength="70" class="form-control single-select-input-text" placeholder="選單文字" name="ssname[]" type="text" >
				<div class="drop-down-warp">
					<select name="warp[]" class="drop-down-warp-Ojb form-control">
						<option value="next">下一頁</option>
						<?php 
						for ($i=1; $i <= $_GET['pageCount']; $i++) { 
						?>
					  		<option value="<?php echo $i;?>">第<?php echo $i;?>頁</option>
						<?php 
						} ?>
						<option value="end">提交表單</option>
					</select>
				</div>
				<button type="button" class="btn btn-default btn-sm single-select-input-remove-btn" data-page="1">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>	
			</div>				
		</div>		
	</div>	
	<div class="form-group">
		<label class="checkbox-inline">
			<input type="checkbox" id="input-warp" value="1" <?php if($data->warp){ echo "checked"; }?>>
			依照選擇至指定頁面
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
		var warp = 0;

		checkWarp();

		function checkWarp(){
			if($("#input-warp").prop("checked")){
				warp = 1;
				$(".drop-down-warp").show();
			}else{
				warp = 0;
				$(".drop-down-warp").hide();
			}			
		}


		$("#input-warp").click(function() {
			checkWarp();
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
		
		$(".single-select-add-btn").click(function() {
			$("#single-select-input-group").html( $("#single-select-input-group").html() + $(".single-select-input-temp").html());
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
				option:$("#single-select-input-form").serialize(),
				warp:warp,
				update:<?php echo $update; ?>, 
				objid:"<?php echo $_POST['objid']; ?>",
				required:required
			}
			if($("#input-title").val().length > 0){
				$.ajax({
					type: 'POST',
					url:"getLayout?type=dropDown&pid=<?php echo $_GET['pid']; ?>",
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