<?php 
$defaultLat = 25.03354;
$defaultLng = 121.56413;
if(isset($model[0]->lat) && !empty($model[0]->lat)){
	$defaultLat = $model[0]->lat;
	$defaultLng = $model[0]->lng;
}

?>
<style type="text/css">
	html, body, #content, #main, #map-canvas{
		height: 100% !important;
		padding: 0px;
		width: 100%;
	}
	#select{
		position: absolute;
		z-index: 999999999;
		right: 5px;
		top: 45px;
	}
	#import{
		position: absolute;
		z-index: 999999999;
		right: 5px;
		top: 5px;
	}	
	#infoBox-con{
		width: 300px;
		height: 150px;
	}
	#title{
		font-size: 15px;
		font-weight: bold;
	}
	#on-update{
		position: absolute;
		z-index: 999999999;
		left: 47%;
		bottom: 180px;
		width: 120px;
		font-size: 20px;
		font-weight: bold;
		text-align: center;	
		border-radius: 5px;	
		display: none;		
	}
	#on-after-update{
		position: absolute;
		z-index: 999999999;
		left: 47%;
		bottom: 180px;
		width: 120px;
		font-size: 20px;
		font-weight: bold;
		text-align: center;	
		border-radius: 5px;	
		display: none;			
	}
	#contents{
		height: 90% !important;
		padding: 0px !important;
		position: relative;
	}
	.navbar-nav.navbar-right:last-child{
		margin-right: 0px !important;
	}
</style>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo Yii::app()->params['googleApiKey'];?>&sensor=false"></script>
<script>
	var map,
		infoBox,
		msgStatus = "onReady",
		data = "<?php echo $lbs; ?>",
		dataArray = data.split(","),
		idArray = [],
		circleArray = [],
		geocoder = new google.maps.Geocoder(),
		newMarker = null,
		newLat,
		newLng,
		newAdderss,
		markersArray = [];

	//initialize()
	function initialize() {
		var mapOptions = {
			zoom: 11,
			center: new google.maps.LatLng(<?php echo $defaultLat;?>, <?php echo $defaultLng;?>)
		};
		map = new google.maps.Map(document.getElementById('map-canvas'),
		mapOptions);
		<?php if(isset($_GET['id']) && $_GET['id'] > 0): ?>
			for(var key in dataArray){ 
				addMarker(dataArray[key]);
			}

			infoBox = new google.maps.InfoWindow();
		
			google.maps.event.addListener(map, 'click', function(e) {
				if(newMarker != null){
					newMarker.setMap(null);
				}
				newMarker = new google.maps.Marker({
					position: e.latLng,
					title: e.latLng.toString(),
					map: map,
					icon: '../assets/image/flag.png'
				});
				createMessageContentNew(e,newMarker);
			});		
		<?php endif; ?>	
	}
	google.maps.event.addDomListener(window, 'load', initialize);
	<?php if(isset($_GET['id']) && $_GET['id'] > 0): ?>
	function addMarker(data) {
		var lbs = data.split("@")
			lat = lbs[0],
			lng = lbs[1],
			latlng = new google.maps.LatLng(lat, lng),
			marker = new google.maps.Marker({
				position: latlng,
				title: lbs[2],
				map: map,
				draggable:true,
				id: lbs[3],
				lbs : lbs
			});
		addCircle(lbs);
		google.maps.event.addListener(marker, 'click', function(e) {
			infoBox.setContent(createMessageContent(lbs));
			infoBox.open(map, this);
			if(newMarker != null){
				newMarker.setMap(null);
			}			
		});	

		google.maps.event.addListener(marker, 'dragend', function(e){
			msgStatus = "onUpdate";
			msgUpdateFadeIn();
			var id = this.id;
			var index = idArray.indexOf(id);
			updateCircle(circleArray[index],e);
			updateAddress(e,id,this);		
		});

		markersArray.push(marker);
		idArray.push(lbs[3]);
	}	

	function msgUpdateFadeIn(){
		$("#on-update").fadeToggle(1100, function() {
			if(msgStatus == "onUpdate"){
				msgUpdateFadeIn();
			}else{
				$("#on-update").hide();
			}
		});
	}	

	function updateCircle(circle,e){
		circle.setCenter(e.latLng);
	}

	function msgAfterUpdateFadeIn(){
		$("#on-after-update").fadeToggle(1100, function(){
			$("#on-after-update").fadeOut(1100);
			msgStatus = "onReady";
		});
	}

	function addCircle(data){
		var populationOptions = {
			strokeColor: "#FF0000",
			strokeOpacity: 0.5,
			strokeWeight: 1,
			fillColor: "#FF0000",
			fillOpacity: 0.10,
			map: map,
			center: new google.maps.LatLng(data[0], data[1]),
			radius: 500
		};
		cityCircle = new google.maps.Circle(populationOptions);
		circleArray.push(cityCircle);
	}


	function createMessageContent(data) {
		var html = '<div id="infoBox-con"><div id="title">'+data['2']+'</div><div id="lat">'+data['0']+'</div><div id="lng">'+data['1']+'</div><div id="del"><a class="btn btn-default" onclick="delLBS(\''+data['3']+'\')">刪除座標</a></div></div>'
		return html;
	}

	function createMessageContentNew(e,nmaker) {

		var html;
		geocoder.geocode({
			'latLng': e.latLng,
		}, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				
				var	address = newAdderss =results[0].formatted_address,
					lat = newLat = results[0].geometry.location.lat(),
					lng = newLng = results[0].geometry.location.lng();	


				infoBox.setContent('<div id="infoBox-con"><div id="title">'+address+'</div><div id="lat">'+lat+'</div><div id="lng">'+lng+'</div><div id="del"><a class="btn btn-default" onclick="addLBS()">增加座標</a></div></div>');
			} else {
				console.log(results);
				infoBox.setContent('無法取得位置');
			}
		});	
		
		infoBox.open(map, nmaker);
	}

	function addLBS(){
		if(confirm("確定新增這個座標?")){
			msgStatus = "onUpdate";
			msgUpdateFadeIn();
			var data = {
				ajax : 1,
				address : newAdderss,
				lat : newLat,
				lng : newLng,
				group_id : <?php echo $_GET['id']; ?>
			};	
			$.post('newData', data, function (data) {
				if(data.data.error == true){
					var str = newLat+"@"+newLng+"@"+newAdderss+"@"+data.data.id
					addMarker(str);
					msgStatus = "afterUpdate";
					msgAfterUpdateFadeIn();		
					if(newMarker != null){
						newMarker.setMap(null);
					}			
				}else{
					alert("新增失敗")
				}
			});
		}else{
			return false;
		}		
		console.log(id);
	}

	function delLBS(id){
		if(confirm("確定移除這個座標?")){
			var data = {
				ajax : 1,
				id: id,
			};	
			$.post('delLBS', data, function (data) {
				if(data.data.error == true){
					delMarker(id);
				}else{
					alert("移除失敗!請嘗試從列表中刪除")
				}
			});
		}else{
			return false;
		}		
		console.log(id);
	}

	function updateAddress(e,id, marker){
		geocoder.geocode({
			'latLng': e.latLng,
		}, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				console.log(results[0].formatted_address);
				var data = {
					ajax : 1,
					id: id,
					address : results[0].formatted_address,
					lat : results[0].geometry.location.lat(),
					lng : results[0].geometry.location.lng()
				};	
				$.post('updateLBS', data, function (data) {
					if(data.data.error == true){
						msgStatus = "afterUpdate";
						msgAfterUpdateFadeIn();
						marker.lbs[0] = results[0].geometry.location.lat();
						marker.lbs[1] = results[0].geometry.location.lng();
						marker.lbs[2] = results[0].formatted_address;
						infoBox.setContent(createMessageContent(marker.lbs));
						infoBox.open(map, marker);						
					}else{
						alert("移除失敗!請嘗試從列表中刪除")
					}
				});				
			} else {
				console.log(results);
				alert("更新失敗");
			}
		});
	}



	function delMarker(id){
		var index = idArray.indexOf(id);
		markersArray[index].setMap(null);
		circleArray[index].setMap(null);
		idArray.splice(index,1);
		markersArray.splice(index,1);
		circleArray.splice(index,1);
	}
	<?php endif; ?>	
</script>
<div id="select">
	<select name="group" onchange="javascript:window.location=this.value">
		<?php if(!isset($_GET['id']) || $_GET['id'] < 0): ?>
			<option value="">選擇LBS群組</option>	
		<?php endif; ?>	
		<?php foreach ($LbsGroup as $value) {?>
			<option value="index?id=<?php echo $value->id; ?>"
				<?php if($_GET['id'] == $value->id){ echo 'selected="selected"'; }?>><?php echo $value->name; ?></option>
		<?php }?>
	</select>
</div>
<div id="import">
<ul class="nav navbar-nav navbar-right">
	<li id="fat-menu" class="dropdown">
		 	<button class="btn btn-default dropdown-toggle" type="button" id="drop" data-toggle="dropdown" aria-expanded="true">
				LBS操作　　			
				<span class="caret"></span>
			</button>
		<ul class="dropdown-menu" role="menu" aria-labelledby="drop">
			<li role="presentation"><a role="menuitem" tabindex="-1" href="import">匯入LBS資料</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="exportIndex">匯出LBS資料</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="../lbsGroup/admin">管理群組</a></li>
		</ul>
	</li>
</ul>					
</div>
<div id="on-update" class="bg-primary">LBS更新中..</div>
<div id="on-after-update" class="bg-success">更新完成!!</div>
<div id="map-canvas"></div>