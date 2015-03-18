<?php
$update = 0;
if(isset($_POST['data'])){
	$data = json_decode($_POST['data']);
	$update = 1;
}
?>
<h3><?php echo ($update)? "修改" : "新增"; ?>新分頁</h3>
<div class="form-group">
	<label>分頁標題</label>
	<input size="60" maxlength="70" class="form-control" placeholder="分頁標題" id="input-title" type="text" value="<?php echo ($update)? $data->title : ""; ?>">
</div>
<div class="form-group">
	<label>分頁說明</label>
	<textarea id="input-caption" rows="3" class="form-control" placeholder="分頁說明"><?php echo ($update)? $data->caption : ""; ?></textarea>
</div>
<div class="modal-footer">
	<input class="btn btn-primary" id="getLayout" type="submit" name="yt0" data-page="<?php echo $_GET['pid']; ?>" value="<?php echo ($update)? "修改" : "新增"; ?>">
</div>
<script type="text/javascript">
	$(function() {
		$("#getLayout").click(function() {
			var pc = parseInt($('#pageCount').val());
			$.ajax({
				type: 'POST',
				url:"getLayout?type=newPage&pid=<?php echo ($update)? $data->value - 1 : '"+pc+"' ; ?>",
				data: { title:$("#input-title").val(), caption : $("#input-caption").val(), update:<?php echo $update; ?>},
				success:function(html){
					<?php if($update == 0){ ?>
						$("#temps").html($("#temps").html() + html);
					<?php }else{ ?>
						$("#page<?php echo $data->value; ?>-group .title-group").remove();
						var ojb = $("#page<?php echo $data->value; ?>-group .ojb-group").html();
						$("#page<?php echo $data->value; ?>").html(html);
						$("#page<?php echo $data->value; ?>-group .ojb-group").html(ojb);
					<?php } ?>					
					$('#modal-content').html("");
					$('#modal').modal('hide');
					$('#pageCount').attr("value",parseInt($('#pageCount').val())+1);
					$(".tot-page").html($('#pageCount').val());
					initrmoj();
					updatePOS();
				}
			})
	        .fail(function(e) {
	            if(e.status == 403){
	                window.location.reload();
	            }
	        });
			return false;//阻止a标签
		});
	})
</script>