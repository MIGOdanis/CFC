<?php
$update = 0;
if(isset($_POST['data'])){
	$data = json_decode($_POST['data']);
	$update = 1;
}
?>
<h3>以數字表示程度 1-10</h3>
<div class="form-group">
	<label>標題</label>
	<input size="60" maxlength="70" class="form-control" placeholder="標題" id="input-title" type="text" required 
		data-toggle="popover" title="必填欄位" data-content="這是必填欄位" data-placement="top" value="<?php echo ($update)? $data->title : ""; ?>"
	>
</div>
<div class="form-group">
	<label>說明文字</label>
	<input size="60" maxlength="70" class="form-control" placeholder="說明文字" id="input-caption" type="text" value="<?php echo ($update)? $data->caption : ""; ?>" >	
</div>
<div class="ntl-text-input-group">
	<div class="form-group"><label>1,10 代表意義<label></div>
	<div class="form-group">
		<label>1 :</label>
		<input size="60" maxlength="70" class="form-control" placeholder="1:代表意義" id="input-fristSTR" type="text" value="<?php echo ($update)? $data->fristSTR : ""; ?>" >	
	</div>
	<div class="form-group">
		<label>10 :</label>
		<input size="60" maxlength="70" class="form-control" placeholder="10:代表意義" id="input-lastSTR" type="text" value="<?php echo ($update)? $data->lastSTR : ""; ?>" >	
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
		$("#getLayout").click(function() {
			if($("#input-title").val().length > 0){
				var required;
				if($("#input-required").prop("checked")){
					required = 1;
				}else{
					required = 0;
				}
				$.ajax({
					type: 'POST',
					url:"getLayout?type=numberToLevel&pid=<?php echo $_GET['pid']; ?>",
					data: {
						title:$("#input-title").val(),
						caption : $("#input-caption").val(),
						required:required,
						fristSTR:$("#input-fristSTR").val(),
						lastSTR:$("#input-lastSTR").val(),
						update:<?php echo $update; ?>, 
						objid:"<?php echo $_POST['objid']; ?>"
					},
					success:function(html){
						<?php if($update == 0){ ?>
							$("#page<?php echo $_GET['pid']; ?>-group .ojb-group").html($("#page<?php echo $_GET['pid']; ?>-group .ojb-group").html() + html);
						<?php }else{ ?>
							$("#<?php echo $_POST['objid']; ?>").html(html);
						<?php } ?>
						$('#modal-content').html("");
						$('#modal').modal('hide');
						initrmoj();
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