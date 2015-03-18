<?php
$update = 0;
if(isset($_POST['data'])){
	$data = json_decode($_POST['data']);
	$update = 1;
}
?>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/ss-theam/jquery-ui.css">

<h3><?php echo ($update)? "修改" : "新增"; ?>日期與時間</h3>
<div class="form-group">
	<label>標題</label>
	<input size="60" maxlength="70" class="form-control" placeholder="標題" id="input-title" type="text" required 
		data-toggle="popover" title="必填欄位" data-content="這是必填欄位" data-placement="top"  value="<?php echo ($update)? $data->title : ""; ?>"
	>
</div>
<div class="form-group">
	<label>說明文字</label>
	<input size="60" maxlength="70" class="form-control" placeholder="說明文字" id="input-caption" type="text" value="<?php echo ($update)? $data->caption : ""; ?>" >	
</div>

<div class="form-group">
	<label class="checkbox-inline">
		<input type="checkbox" id="show-date" value="1" <?php if($data->date){ echo "checked"; }?>>
		顯示日期
	</label>
</div>
<div class="form-group">
	<label class="checkbox-inline">
		<input type="checkbox" id="show-time" value="1" <?php if($data->time){ echo "checked"; }?>>
		顯示時間
	</label>
</div>

<div class="form-group date-group">
	<label>日期</label>
		<input type="text" id="day" name="date" value="<?php echo date("Y-m-d"); ?>">
	<p class="text-danger"></p>
</div>

<div class="form-group time-group">
	<label>時間</label>
		<div class="time-select-group">
			<select name="<?php echo $objectId; ?>" class="dropDownListOjb">
				<option>小時</option>
				<?php for ($i=1; $i <= 24 ; $i++) { ?>
			  		<option><?php echo $i; ?></option>
				<?php } ?>
			</select>
			:
			<select name="<?php echo $objectId; ?>" class="dropDownListOjb">
				<option>分鐘</option>
				<?php for ($i=1; $i <= 60 ; $i++) { ?>
			  		<option><?php echo $i; ?></option>
				<?php } ?>
			</select>						
		</div>
	<p class="text-danger"></p>
</div>

<div class="modal-footer">
	<input class="btn btn-primary" id="getLayout" type="submit" name="yt0" data-page="<?php echo $_GET['pid']; ?>" value="<?php echo ($update)? "修改" : "新增"; ?>">
</div>
<script type="text/javascript">
	$(function() {
		var date = 0;

		checkDate();

		function checkDate(){
			if($("#show-date").prop("checked")){
				date = 1;
				$(".date-group").show();
			}else{
				date = 0;
				$(".date-group").hide();
			}			
		}

		$("#show-date").click(function() {
			checkDate();
		});

		var time = 0;

		checkTime();

		function checkTime(){
			if($("#show-time").prop("checked")){
				time = 1;
				$(".time-group").show();
			}else{
				time = 0;
				$(".time-group").hide();
			}			
		}

		$("#show-time").click(function() {
			checkTime();
		});

		$("#getLayout").click(function() {
			if($("#input-title").val().length > 0){
				$.ajax({
					type: 'POST',
					url:"getLayout?type=dateAndTime&pid=<?php echo $_GET['pid']; ?>",
					data: { 
						title:$("#input-title").val(), 
						caption : $("#input-caption").val(), 
						date:date,
						time:time,
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
						initSortableOfForm();


						$( ".datepick" ).datepicker({
							defaultDate: "+0d",
							// maxDate: "today",
							minDate: "2014-12-01",
							changeMonth: true,
							numberOfMonths: 1,
							dateFormat:"yy-mm-dd",
							onClose: function( selectedDate ) {
								$( "#end_day" ).datepicker( "option", "minDate", selectedDate );
							}
						});

						
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