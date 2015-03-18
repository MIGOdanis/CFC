<?php
$update = 0;
if(isset($_POST['data'])){
	$data = json_decode($_POST['data']);
	$update = 1;
}
?>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/jquery-ui.min.js"></script>

<script type="text/javascript">
	var tinymce_editor;
	tinymce.init({
 	relative_urls : false,
    selector: "#html",
	language : 'zh_TW',
	toolbar: " undo redo | forecolor fontsizeselect | bold italic underline strikethrough | sharemaps | alignleft aligncenter alignright | bullist numlist | link unlink | image jbimages | preview ",
	plugins: [
		" fullscreen textcolor advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks code fullscreen ",
		"insertdatetime media table contextmenu paste jbimages"
	]
 });
</script>
<h3>HTML區塊</h3>
<div class="html-group">
	<label>HTML區塊</label>
	<textarea rows="20" id="html"><?php echo ($update)?  urldecode($data->html) : ""; ?></textarea>		
</div>
<div class="modal-footer">
	<input class="btn btn-primary" id="getLayout" type="submit" name="yt0" data-page="<?php echo $_GET['pid']; ?>" value="<?php echo ($update)? "修改" : "新增"; ?>">
</div>
<script type="text/javascript">
	$(function() {
		$("#getLayout").click(function() {
			var data = {
				html:tinymce.activeEditor.getContent(),
				update:<?php echo $update; ?>, 
				objid:"<?php echo $_POST['objid']; ?>"
			}

			$.ajax({
				type: 'POST',
				url:"getLayout?type=html&pid=<?php echo $_GET['pid']; ?>",
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