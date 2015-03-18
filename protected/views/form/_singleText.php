<?php
$update = 0;
if(isset($_POST['data'])){
	$data = json_decode($_POST['data']);
	$update = 1;
}
?>
<h3><?php echo ($update)? "修改" : "新增"; ?>單行文字</h3>
<div class="form-group">
	<label>標題</label>
	<input size="60" maxlength="70" class="form-control" placeholder="標題" id="input-title" type="text" required 
		data-toggle="popover" title="必填欄位" data-content="這是必填欄位" data-placement="top" value="<?php echo ($update)? $data->title : ""; ?>">
</div>
<div class="form-group">
	<label>說明文字</label>
	<input size="60" maxlength="70" class="form-control" placeholder="說明文字" id="input-caption" type="text" value="<?php echo ($update)? $data->caption : ""; ?>">	
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
					url:"getLayout?type=singleText&pid=<?php echo $_GET['pid']; ?>",
					data: { title:$("#input-title").val(), caption : $("#input-caption").val(), required:required, update:<?php echo $update; ?>, objid:"<?php echo $_POST['objid']; ?>"},
					success:function(html){
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