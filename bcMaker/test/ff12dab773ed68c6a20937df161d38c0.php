<!DOCTYPE html>
<html class="modern" lang="zh">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"> 
		<meta charset="utf-8">
		<title>廣告Code測試[大蓋]</title>
		<style type="text/css">
		body{
			margin: 0px;
			cursor: pointer;
		}
		#main{
			width: 800px;
			height: 600px;
			overflow: hidden;
			background-image: url("ssdfsdfsd");
		}
		#video{
			margin-top: 130px;
			margin-left: 297px;
		}
		#but{
			width: 169px;
			height: 68px;
			margin-left:auto;
			margin-right: auto;
			margin-top: 15px;
		}
		#but_out{
			width: 495px;
			float: right;
		}
		#but a{
			float: left;
		}		
		</style>
	</head>
	<body>
		<div id="main">
			<div>
				<div id="video">
						<iframe src="http://events.doublemax.net/ytb_player/players/8_6_bg/player.php?ytb_id=q34234234234&p=<?php echo $_GET['link'];?>" framespacing="0" frameborder="no" scrolling="no" width="495" height="280" id="player"></iframe>
				</div>
				<div id="but_out">
					<div id="but">
						<a href="http://ads.doublemax.net/delivery/?click&p=<?php echo $_GET['link'];?>&dest=sdfsdfsdfsdfsdf" target="_blank" id="link_but"></a>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
	document.addEventListener("click", function(e){
	    var lnk = document.getElementById("link_but");
 		lnk.click();
	});
	</script>
</html>