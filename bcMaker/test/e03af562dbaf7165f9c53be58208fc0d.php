<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#"
xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

<title>MobiForce影音廣告</title>
<style type="text/css">
	body{
		margin: 0px;
		overflow:hidden;
		width: 800px;
		height: 600px;
	}
	#mian{
		overflow:hidden;
		width: 800px;
		height: 600px;
		position: relative;
	}
	#video{
		width: 800px;
		height: 600px;
	}
	#bottom-bar{
		width: 760px;
		height: 30px;
		position: absolute;
		top: 570px;
		left: 40px;
	}
	#more{
		border: solid #fff 1px;
		color: #fff;
		margin-top: 5px;
		height: 20px;
		width: 70px;
		text-align: center;
		line-height: 20px;
		font-size: 15px;
		text-decoration:none;
	}	
	a:link{
		text-decoration:none;
	}
</style>
</head>
<body>
	<div id="main">
		<div id="video">
			<iframe src="http://events.doublemax.net/ytb_player/players/8_6_full_t/player.php?ytb_id=asdasdas&p=<?php echo $_GET['link'];?>&banner=dasdasdasd" framespacing="0" frameborder="no" scrolling="no" width="800" height="600" id="player"></iframe>
		</div>
		<div id="bottom-bar">
		<a href="http://ads.doublemax.net/delivery/?click&p=<?php echo $_GET['link'];?>&dest=dasdsadasdasd" target="_blank" id="link_but"></a>
			<div id="more">
				了解更多
			</div>
		</a>
		</div>
	</div>
</body>
</html>