<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Yii::app()->params['googleApiKey'];?>&sensor=false"></script>

<style type="text/css">
.ui-progressbar {
	position: relative;
}
.progress-label {
	position: absolute;
	left: 47%;
	top: 4px;
	font-weight: bold;
	text-shadow: 1px 1px 0 #fff;
}
#addressList {
	margin-top: 20px;
	
	overflow: hidden;
}
#addressList div{
	float: left;
}
#arrow {
	width: 10%;
	text-align: center;
	font-size: 30px;
	padding-top: 250px;
}
#status{
	text-align: center;
}
#addressList .addressList {
	width: 45%;
}
#addressList div select{
	width: 90%;
}
#completeList{
	text-align: right;
}
#subject {
	font-size: 20px;
}
#mail {
	margin-top: 15px;
}
#mail #body{
	border: solid 1px;
}
.box-title {
	width: 100%;
}
#import{
	margin-top: 10px;
	margin-bottom: 15px;
}
</style>
<script language="Javascript">
	var progressbar,
		progressLabel,
		status,
		geocoder,
		latLng,
		waitSen = 800,
		totProgress;
$(function() {
	$("#body_text").hide()
	//參數設定
	progressbar = $( "#progressbar" );
	progressLabel = $( ".progress-label" );
	status = "wait";
	geocoder = new google.maps.Geocoder();
	latLng;
	totProgress = $('#wait option').length;

	//jqui 宣告進度條
	progressbar.progressbar({
		value: false,
		change: function() {
			progressLabel.text( progressbar.progressbar( "value" ) + "%" );
		},
		complete: function() {
			progressLabel.text( "計算完畢!" );
		}
	});

	//監聽開始或暫停鈕
	$( "#start" ).click(function() {
		if(status == "start"){
			status = "stop";
			$( "#status" ).html("暫停中");
			$( "#start" ).val("繼續");
		}else{
			$( "#status" ).html("計算中");
			$( "#start" ).val("暫停");
			status = "start";
			updateLatLng();
		}
	});

	updateListTot();
});

//修改進度條
function progress() {
	newValue = (1 - ($('#wait option').length / totProgress)) * 100;
	progressbar.progressbar( "value", Math.round(newValue) );
}

function updateLatLng() {
	if(status == "start"){
		if($('#wait option').length > 0){
			var address = $('#wait option:first').data("address"),
				cd = CheckData(address);
		}else{
			$( "#status" ).html("已完成");
			$( "#start" ).hide();
		}
	}
}

function updateListTot() {
	var totComplete = $('#complete option').length - 1,
		totFail = $('#fail option').length - 1,
		totWait = $('#wait option').length,
		times = totWait * waitSen;

	$( "#totWait" ).html(totWait);
	$( "#totComplete" ).html(totComplete);
	$( "#totFail" ).html(totFail);
	$( "#times" ).html(Math.round((times / 1000) / 60) +  "分鐘");
}

function saveData(address, lat, lng) {
	var data = {
		ajax : 1,
		address: address,
		group_id : <?php echo $group->id; ?>,
		lat : lat,
		lng : lng
	};	
	$.post('newData', data, function (data) {
		if(data.data.error == true){
			gotoComplete();
		}else{
			gotoFail();
		}
	});
}

function CheckData(address) {
	var data = {
		ajax : 1,
		group_id : <?php echo $group->id; ?>,
		address: address,
	};	
	$.post('checkData', data, function (data) {
		if(data.data.error == true){
			gotoSkip();
		}else{
			geocoder.geocode({
				'address': '台灣' + address
			}, function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					saveData(address,results[0].geometry.location.lat(),results[0].geometry.location.lng());	
				} else {
					console.log(results);
					gotoFail("地址錯誤");
				}
			});
		}
	});
}

function gotoFail(msg){
	var obj = $('#wait option:first');
	var newOption = "<option value='" + obj.val() + "'>" + obj.text() + " Error : " + msg +"</option>";
	obj.remove();
	$("#fail").append(newOption);
	progress();
	updateListTot();
	setTimeout("updateLatLng()",waitSen);
}

function gotoComplete(){
	var obj = $('#wait option:first');
	var newOption = "<option value='" + obj.val() + "'>" + obj.text() + "</option>";
	obj.remove();
	$("#complete").append(newOption);
	progress();
	updateListTot();
	setTimeout("updateLatLng()",waitSen);
}

function gotoSkip(){
	var obj = $('#wait option:first');
	var newOption = "<option value='" + obj.val() + "'>" + obj.text() + "(已有資料-不計算)</option>";
	obj.remove();
	$("#complete").append(newOption);
	progress();
	updateListTot();
	setTimeout("updateLatLng()",100);
}
</script>
<div class="page-header">
  <h1>匯入LBS</h1>
  <small>請點選開始</small>
</div>
<div id="import">
	<div>計算序列 : <span id="totWait"></span></div>
	<div>傳送完成 : <span id="totComplete"></span></div>
	<div>傳送失敗 : <span id="totFail"></span></div>
	<div>剩餘時間 : <span id="times"></span></div>
	<div>使用群組 : <span id="group"><?php echo $group->name;?></span></div>

	<div id="progressbar"><div class="progress-label">等待開始...</div></div>

	<div id="addressList">
		<div id="waitList" class="addressList">
			<div class="box-title">計算序列</div>
			<select disabled="disabled" multiple="multiple" size="29" id="wait">
				<?php
					if(isset($model)){
						foreach($model AS $row){
							echo '<option value ="' . $row . '" data-address="' . $row . '" >' . $row . '</option>';
						}
					}
				?>
			</select>
		</div>
		<div id="arrow">
		<div id="status" class="box-title">等待開始中</div>
		<input type="button" id="start" value="開始">
		</div>
		<div id="completeList" class="addressList">
			<select disabled="disabled" multiple="multiple" size="15" id="complete">
				<option>計算完成序列</option>
			</select>
			<select disabled="disabled" multiple="multiple" size="15" id="fail">
				<option>計算失敗序列</option>
			</select>
		</div>
	</div>
</div>